<?php 
namespace App\Controllers;
use App\Models\PaymentModel;

class Payment extends BaseController
{
	protected $PaymentModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->PaymentModel = new PaymentModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new PaymentModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('pym_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('Payment/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Payment/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
			'pym_name' => 'required',
			'pym_on_name' => 'required',
			'pym_number' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'pym_name' => $this->request->getPost('pym_name'),
					'pym_on_name' => $this->request->getPost('pym_on_name'),
					'pym_number' => $this->request->getPost('pym_number')
				],
				'validation' => $this->validator
			];
			
            echo view('Payment/Create', $data);
        } else {
			$this->PaymentModel->save([
				'pym_name'=> $this->request->getPost('pym_name'),
				'pym_on_name'=> $this->request->getPost('pym_on_name'),
				'pym_number'=> $this->request->getPost('pym_number'),
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Payment/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'pym_id' => $id
        ];
        
		$data = [
			'data' => $this->PaymentModel->where($condition)->first()
		];
		return view('Payment/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'pym_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->PaymentModel->where($condition)->first()
		];

		return view('Payment/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->PaymentModel->find($id)['status'] == 1 ? 0 : 1;
				$this->PaymentModel->update($id,[
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
			'pym_name' => 'required',
			'pym_on_name' => 'required',
			'pym_number' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'pym_name' => $this->request->getPost('pym_name'),
					'pym_on_name' => $this->request->getPost('pym_on_name'),
					'pym_number' => $this->request->getPost('pym_number')
				],
				'validation' => $this->validator
			];
			
            echo view('Payment/Create', $data);
        } else {
			$this->PaymentModel->update($this->request->getPost('pym_id'),[
				'pym_name'=> $this->request->getPost('pym_name'),
				'pym_on_name'=> $this->request->getPost('pym_on_name'),
				'pym_number'=> $this->request->getPost('pym_number'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Payment/Index");		
        }
    }
}
