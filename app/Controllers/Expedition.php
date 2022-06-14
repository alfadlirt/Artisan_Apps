<?php 
namespace App\Controllers;
use App\Models\ExpeditionModel;

class Expedition extends BaseController
{
	protected $ExpeditionModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->ExpeditionModel = new ExpeditionModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new ExpeditionModel();
		
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
		return view('Expedition/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Expedition/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
			'exp_name' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'exp_name' => $this->request->getPost('exp_name')
				],
				'validation' => $this->validator
			];
			
            echo view('Expedition/Create', $data);
        } else {
			$this->ExpeditionModel->save([
				'exp_name'=> $this->request->getPost('exp_name'),
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->ExpeditionModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Expedition/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'exp_id' => $id
        ];
        
		$data = [
			'data' => $this->ExpeditionModel->where($condition)->first()
		];
		return view('Expedition/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'exp_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->ExpeditionModel->where($condition)->first()
		];

		return view('Expedition/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->ExpeditionModel->find($id)['status'] == 1 ? 0 : 1;
				$this->ExpeditionModel->update($id,[
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
			'exp_name' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'exp_name' => $this->request->getPost('exp_name')
				],
				'validation' => $this->validator
			];
			
            echo view('Expedition/Create', $data);
        } else {
			$this->ExpeditionModel->update($this->request->getPost('exp_id'),[
				'exp_name'=> $this->request->getPost('exp_name'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->ExpeditionModel->getInsertID());
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Expedition/Index");		
        }
    }
}
