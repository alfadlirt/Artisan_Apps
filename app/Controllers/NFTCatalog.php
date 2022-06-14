<?php 
namespace App\Controllers;
use App\Models\NFTCatalogModel;

class NFTCatalog extends BaseController
{
	protected $NFTCatalogModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->NFTCatalogModel = new NFTCatalogModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new NFTCatalogModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('nft_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('NFTCatalog/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('NFTCatalog/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
            'nft_name' => 'required|is_unique['.$this->NFTCatalogModel->table.'.nft_name]'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'nft_name' => $this->request->getPost('nft_name'),
				],
				'validation' => $this->validator
			];
			
            echo view('NFTCatalog/Create', $data);
        } else {
			$files = $this->request->getFiles();

			$imgContent = file_get_contents($files['photo']->getTempName());
			
			$slug = url_title($this->request->getPost('nft_name'), '-', true);
			
			$id = $this->generateID($this->NFTCatalogModel->table,$this->NFTCatalogModel->primaryKey);
			//dd($id);
			$this->NFTCatalogModel->insert([
				'nft_catalog_id'=> $id,
				'nft_name'=> $this->request->getPost('nft_name'),
				'slug'=> $slug,
				'link'=> $this->request->getPost('link'),
				'status' => 'Y',
				'photo' => (isset($imgContent)) ? $imgContent : '',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->NFTCatalogModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/NFTCatalog/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'nft_catalog_id' => $id
        ];
        
		$data = [
			'data' => $this->NFTCatalogModel->where($condition)->first()
		];
		return view('NFTCatalog/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'nft_catalog_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->NFTCatalogModel->where($condition)->first()
		];

		return view('NFTCatalog/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->NFTCatalogModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->NFTCatalogModel->update($id,[
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
		$input = $this->validate([
            'nft_name' => 'required|is_unique['.$this->NFTCatalogModel->table.'.nft_name]'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'nft_name' => $this->request->getPost('nft_name'),
				],
				'validation' => $this->validator
			];
			
            echo view('NFTCatalog/Edit', $data);
        } else {
			$files = $this->request->getFiles();

			$imgContent = file_get_contents($files['photo']->getTempName());
			
			$slug = url_title($this->request->getPost('nft_name'), '-', true);
			
			$this->NFTCatalogModel->update($this->request->getPost('nft_catalog_id'),[
				'nft_name'=> $this->request->getPost('nft_name'),
				'slug'=> $slug,
				'link'=> $this->request->getPost('link'),
				'modified_by' => 'system'//$session->get('user_id')
			]);

			if(isset($imgContent)){
				$this->NFTCatalogModel->update($this->request->getPost('nft_catalog_id'),[
					'photo'=> $imgContent
				]);
			}
			//dd($this->NFTCatalogModel->getInsertID());
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/NFTCatalog/Index");
        }
    }
}
