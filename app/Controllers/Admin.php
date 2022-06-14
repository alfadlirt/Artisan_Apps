<?php 
namespace App\Controllers;
use App\Models\AdminModel;

class Admin extends BaseController
{
	protected $AdminModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->AdminModel = new AdminModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new AdminModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('usrname', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('Admin/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Admin/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
			'f_name' => 'required',
			'l_name' => 'required',
			'telp' => 'required|min_length[10]',
			'email' => 'required|valid_email',
            'usrname' => 'required|is_unique['.$this->AdminModel->table.'.usrname]|min_length[10]'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'f_name' => $this->request->getPost('f_name'),
					'l_name' => $this->request->getPost('l_name'),
					'telp' => $this->request->getPost('telp'),
					'email' => $this->request->getPost('email'),
					'usrname' => $this->request->getPost('usrname'),
				],
				'validation' => $this->validator
			];
			
            echo view('Admin/Create', $data);
        } else {
			$id = $this->generateID($this->AdminModel->table,$this->AdminModel->primaryKey);
			//dd($id);
			$this->AdminModel->insert([
				'adm_id'=> $id,
				'f_name'=> $this->request->getPost('f_name'),
				'l_name'=> $this->request->getPost('l_name'),
				'telp'=> $this->request->getPost('telp'),
				'email'=> $this->request->getPost('email'),
				'usrname'=> $this->request->getPost('usrname'),
				'pswrd'=> password_hash('heraioadmin', PASSWORD_DEFAULT),
				'status' => 'Y',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->AdminModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Admin/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'adm_id' => $id
        ];
        
		$data = [
			'data' => $this->AdminModel->where($condition)->first()
		];
		return view('Admin/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'adm_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->AdminModel->where($condition)->first()
		];

		return view('Admin/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->AdminModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->AdminModel->update($id,[
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
			'f_name' => 'required',
			'l_name' => 'required',
			'telp' => 'required|min_length[10]',
			'email' => 'required|valid_email',
            'usrname' => 'required|is_unique['.$this->AdminModel->table.'.usrname]|min_length[10]'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'f_name' => $this->request->getPost('f_name'),
					'l_name' => $this->request->getPost('l_name'),
					'telp' => $this->request->getPost('telp'),
					'email' => $this->request->getPost('email'),
					'usrname' => $this->request->getPost('usrname'),
				],
				'validation' => $this->validator
			];
			
            echo view('Admin/Edit', $data);
        } else {
			$this->AdminModel->update($this->request->getPost('adm_id'),[
				'f_name'=> $this->request->getPost('f_name'),
				'l_name'=> $this->request->getPost('l_name'),
				'telp'=> $this->request->getPost('telp'),
				'email'=> $this->request->getPost('email'),
				'usrname'=> $this->request->getPost('usrname'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Admin/Index");
        }
    }
}
