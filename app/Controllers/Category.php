<?php 
namespace App\Controllers;
use App\Models\CategoryModel;

class Category extends BaseController
{
	protected $CategoryModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->CategoryModel = new CategoryModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new CategoryModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('ktg_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('Category/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Category/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
			'ktg_name' => 'required',
			'icon_css' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'ktg_name' => $this->request->getPost('ktg_name'),
					'icon_css' => $this->request->getPost('icon_css')
				],
				'validation' => $this->validator
			];
			
            echo view('Category/Create', $data);
        } else {
			$this->CategoryModel->save([
				'ktg_name'=> $this->request->getPost('ktg_name'),
				'icon_css'=> $this->request->getPost('icon_css'),
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->CategoryModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Category/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'ktg_id' => $id
        ];
        
		$data = [
			'data' => $this->CategoryModel->where($condition)->first()
		];
		return view('Category/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'ktg_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->CategoryModel->where($condition)->first()
		];

		return view('Category/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->CategoryModel->find($id)['status'] == 1 ? 0 : 1;
				$this->CategoryModel->update($id,[
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
			'ktg_name' => 'required',
			'icon_css' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'ktg_name' => $this->request->getPost('ktg_name'),
					'icon_css' => $this->request->getPost('icon_css')
				],
				'validation' => $this->validator
			];
			
            echo view('Category/Edit', $data);
        } else {
			$this->CategoryModel->update($this->request->getPost('ktg_id'),[
				'ktg_name'=> $this->request->getPost('ktg_name'),
				'icon_css'=> $this->request->getPost('icon_css'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Category/Index");		
        }
    }
}
