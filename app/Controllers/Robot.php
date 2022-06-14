<?php 
namespace App\Controllers;
use App\Models\RobotModel;

class Robot extends BaseController
{
	protected $RobotModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->RobotModel = new RobotModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new RobotModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('rbt_code', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('rbt_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('rbt_desc', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('status', ($searchData['status']!='0'?$searchData['status']:''), ($searchData['status']!='0'?'both':'none'))
				->paginate($pagesize);
				//->builder->getCompiledSelect();
				//dd($paginateData);
				
			}
		}

		$data = [
			'datalist' => $paginateData,
			'pager' => $builder->pager,
			'searchform' => $searchData,
			'nomor' => nomor($this->request->getVar('page'), $pagesize)
		];
		//dd($data);
		return view('Robot/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Robot/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
            'rbt_code' => 'required|is_unique['.$this->RobotModel->table.'.rbt_code]',
            'rbt_name' => 'required|is_unique['.$this->RobotModel->table.'.rbt_name]',
            'rbt_desc' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'rbt_code' => $this->request->getPost('rbt_code'),
					'rbt_name' => $this->request->getPost('rbt_name'),
					'rbt_desc' => $this->request->getPost('rbt_desc'),
				],
				'validation' => $this->validator
			];
			
            echo view('Robot/Create', $data);
        } else {
			$id = $this->generateID($this->RobotModel->table, $this->RobotModel->primaryKey);
			//dd($id);
			$this->RobotModel->save([
				'rbt_id'=> $id,
				'rbt_code'=> $this->request->getPost('rbt_code'),
				'rbt_name'=> $this->request->getPost('rbt_name'),
				'rbt_desc'=> $this->request->getPost('rbt_desc'),
				'status' => 'Y',
				'nft_generated' => 'N',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Robot/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'rbt_id' => $id
        ];
        
		$data = [
			'data' => $this->RobotModel->where($condition)->first()
		];
		return view('Robot/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'rbt_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->RobotModel->where($condition)->first()
		];

		return view('Robot/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->RobotModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->RobotModel->update($id,[
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
            'rbt_code' => 'required|is_unique['.$this->RobotModel->table.'.rbt_code,rbt_code,'.$this->request->getPost('rbt_code').']',
            'rbt_name' => 'required|is_unique['.$this->RobotModel->table.'.rbt_name,rbt_name,'.$this->request->getPost('rbt_name').']',
            'rbt_desc' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'identifier' => $this->request->getPost('rbt_identifier'),
					'rbt_code' => $this->request->getPost('rbt_code'),
					'rbt_name' => $this->request->getPost('rbt_name'),
					'rbt_desc' => $this->request->getPost('rbt_desc'),
				],
				'validation' => $this->validator
			];
			
            echo view('Robot/Edit', $data);
        } else {
			$this->RobotModel->update($this->request->getPost('rbt_identifier'),[
				'rbt_code'=> $this->request->getPost('rbt_code'),
				'rbt_name'=> $this->request->getPost('rbt_name'),
				'rbt_desc'=> $this->request->getPost('rbt_desc'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Robot/Index");
        }
    }
}
