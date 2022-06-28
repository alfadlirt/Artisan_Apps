<?php 
namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\ProductDetailModel;
use App\Models\ProductPicModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
	protected $ProductModel;
	protected $ProductDetailModel;
	protected $ProductPicModel;
	protected $CategoryModel;
	protected $userid;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->ProductModel = new ProductModel();
		$this->ProductDetailModel = new ProductDetailModel();
		$this->ProductPicModel = new ProductPicModel();
		$this->CategoryModel = new CategoryModel();
		$session = session();
		$this->userid = $session->get('user_id');
	}

	public function index()
	{
		$condition = [
            'slr_id' => $this->userid
        ];


		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new ProductModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->where($condition)->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->where($condition)->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->where($condition)
				->orLike('prd_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('status', ($searchData['status']!='0'?$searchData['status']:''), ($searchData['status']!='0'?'both':'none'))
				->paginate($pagesize);
			}
		}

		$data = [
			'datalist' => $paginateData,
			'pager' => $builder->pager,
			'searchform' => $searchData,
			'nomor' => nomor($this->request->getVar('page'), $pagesize)
		];
		//dd($data);
		return view('Product/Index', $data);
	}
	
	public function New()
	{
		$condition = [
            'status' => 1
        ];
		$data = [
			'category' => $this->CategoryModel->where($condition)->findAll(),
			'data' => null
		];
		return view('Product/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
			'name' => 'required',
			'ktg_id' => 'required',
			'description' => 'required',
			'variationdata' => 'required'
        ]);
		if (!$input) {
			$data = [
				'data' => [
					'name' => $this->request->getPost('name'),
					'ktg_id' => $this->request->getPost('ktg_id'),
					'description' => $this->request->getPost('description'),
					'variationdata' => $this->request->getPost('variationdata')
				],
				'validation' => $this->validator
			];
			
            echo view('Product/Create', $data);
        } else {
			$detailwrapped = json_decode($this->request->getVar('variationdata'));
			$price_min = 0;
			$price_max = 0;
			
			for ($i = 0; $i < count($detailwrapped); $i++) {
				if($i == 0){
					$price_min = $detailwrapped[$i]->Price;
					$price_max = $detailwrapped[$i]->Price;
				}
				else{
					if($detailwrapped[$i]->Price<$price_min){
						$price_min = $detailwrapped[$i]->Price;
					}
					else if($detailwrapped[$i]->Price>$price_max){
						$price_max = $detailwrapped[$i]->Price;
					}
				}
			}

			$display_price = $price_min . ' - ' . $price_max;

			$this->ProductModel->save([
				'name'=> $this->request->getPost('name'),
				'slug'=> url_title($this->request->getPost('name'), '-', true),
				'slr_id'=> $this->userid,
				'ktg_id'=> $this->request->getPost('ktg_id'),
				'description'=> $this->request->getPost('description'),
				'is_discount' => 0,
				'global_price_min' => $price_min,
				'global_price_max' => $price_max,
				'display_price' => $display_price,
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);

			$inserted = $this->ProductModel->getInsertID();

			for ($i = 0; $i < count($detailwrapped); $i++) {
				$this->ProductDetailModel->save([
					'prd_id' => $inserted,
					'variation_name' => $detailwrapped[$i]->NamaVariasi,
					'price' => $detailwrapped[$i]->Price,
					'discount_price' => $detailwrapped[$i]->Price,
					'stock' => $detailwrapped[$i]->Qty,
					'status' => 1
				]);
			}
			$files = $this->request->getFiles();
			$imgContent = file_get_contents($files['mainpic']->getTempName());

			$this->ProductPicModel->save([
				'prd_id' => $inserted,
				'pic_data' => $imgContent,
				'is_main_pic' => 1
			]);

			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Product/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'prd_id' => $id
        ];
     
		$condition2 = [
            'status' => 1
        ];

		$data = [
			'category' => $this->CategoryModel->where($condition2)->findAll(),
			'data' => $this->ProductModel->where($condition)->first(),
			'variation' => $this->ProductDetailModel->where($condition)->findAll()
		];
		return view('Product/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'prd_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->ProductModel->where($condition)->join($this->CategoryModel->table, $this->ProductModel->table.'.ktg_id = '.$this->CategoryModel->table.'.ktg_id', 'left')->first(),
			'variation' => $this->ProductDetailModel->where($condition)->findAll()
		];
		//dd($data);
		return view('Product/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->ProductModel->find($id)['status'] == 1 ? 0 : 1;
				$this->ProductModel->update($id,[
					'status'=> $status,
					'modified_by' => 'system'//$session->get('user_id')
				]);

				echo json_encode('success');
			}
			catch(Exception $e){
				echo json_encode('failed');
			}
		}
    }

	public function update()
    {
		//dd($this->request->getPost());
		$input = $this->validate([
			'name' => 'required',
			'ktg_id' => 'required',
			'description' => 'required',
			'variationdata' => 'required'
        ]);
		if (!$input) {
			$data = [
				'data' => [
					'name' => $this->request->getPost('name'),
					'ktg_id' => $this->request->getPost('ktg_id'),
					'description' => $this->request->getPost('description'),
					'variationdata' => $this->request->getPost('variationdata')
				],
				'validation' => $this->validator
			];
			
            echo view('Product/Create', $data);
        } else {
			$detailwrapped = json_decode($this->request->getVar('variationdata'));
			$price_min = 0;
			$price_max = 0;
			
			$condition = [
				'prd_id' => $this->request->getPost('prd_id')
			];

			$oldVariation = $this->ProductDetailModel->where($condition)->findAll();
			$newVariation = [];

			$updateVariation = [];
			$addVariation = [];
			$deleteVariation = [];

			for ($i = 0; $i < count($detailwrapped); $i++) {
				if($i == 0){
					$price_min = $detailwrapped[$i]->Price;
					$price_max = $detailwrapped[$i]->Price;
				}
				else{
					if($detailwrapped[$i]->Price<$price_min){
						$price_min = $detailwrapped[$i]->Price;
					}
					else if($detailwrapped[$i]->Price>$price_max){
						$price_max = $detailwrapped[$i]->Price;
					}
				}

				$item = [
					'prd_dtl_id' => $detailwrapped[$i]->IdVariasi,
					'prd_id' => $this->request->getPost('prd_id'),
					'variation_name' => $detailwrapped[$i]->NamaVariasi,
					'price' => $detailwrapped[$i]->Price,
					'stock' => $detailwrapped[$i]->Qty,
				];

				array_push($newVariation, $item);
			}

			//Delete Variation & Delete Variation
			foreach($oldVariation as $oldEntry) {
				$foundDelete = true;
				$foundUpdate = false;

				$itemUpdate;

				foreach($newVariation as $newEntry) {
					if($newEntry['prd_dtl_id'] == $oldEntry['prd_dtl_id']){
						$foundDelete = false;
						$foundUpdate = true;
						$itemUpdate = $newEntry;
					}
				}
				if($foundDelete){
					array_push($deleteVariation, $oldEntry);
				}
				if($foundUpdate){
					array_push($updateVariation, $itemUpdate);
				}
			}
			//Add Variation
			foreach($newVariation as $newEntry) {
				$found = true;
				foreach($oldVariation as $oldEntry) {	
					if($newEntry['prd_dtl_id'] == $oldEntry['prd_dtl_id']){
						$found = false;
					}
				}
				if($found){
					array_push($addVariation, $newEntry);
				}
			}

			$display_price = $price_min . ' - ' . $price_max;

			$this->ProductModel->update($this->request->getPost('prd_id'),[
				'name'=> $this->request->getPost('name'),
				'slug'=> url_title($this->request->getPost('name'), '-', true),
				'ktg_id'=> $this->request->getPost('ktg_id'),
				'description'=> $this->request->getPost('description'),
				'is_discount' => 0,
				'global_price_min' => $price_min,
				'global_price_max' => $price_max,
				'display_price' => $display_price,
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);

			foreach($addVariation as $entry) {	
				$this->ProductDetailModel->save([
					'prd_id' => $this->request->getPost('prd_id'),
					'variation_name' => $entry['variation_name'],
					'price' => $entry['price'],
					'discount_price' => $entry['price'],
					'stock' => $entry['stock'],
					'status' => 1
				]);
			}

			foreach($updateVariation as $entry) {	
				$this->ProductDetailModel->update($entry['prd_dtl_id'],[
					'variation_name' => $entry['variation_name'],
					'price' => $entry['price'],
					'discount_price' => $entry['price'],
					'stock' => $entry['stock']
				]);
			}

			foreach($deleteVariation as $entry) {	
				$this->ProductDetailModel->update($entry['prd_dtl_id'],[
					'status' => 0
				]);
			}

			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Product/Index");		
        }
    }
}
