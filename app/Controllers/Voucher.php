<?php 
namespace App\Controllers;
use App\Models\VoucherModel;

class Voucher extends BaseController
{
	protected $VoucherModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->VoucherModel = new VoucherModel();
		$session = session();
		$this->userid = $session->get('user_id');
	}

	public function index()
	{
		
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new VoucherModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('vcr_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('Voucher/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Voucher/Create', $data);
	}

	public function Save()
	{
		//dd($this->request->getPost());
        $input = $this->validate([
			'vcr_code' => 'required',
			'vcr_name' => 'required',
			'discount' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'vcr_code' => $this->request->getPost('vcr_code'),
					'vcr_name' => $this->request->getPost('vcr_name'),
					'discount' => $this->request->getPost('discount')
				],
				'validation' => $this->validator
			];
			
            echo view('Voucher/Create', $data);
        } else {
			$this->VoucherModel->save([
				'vcr_code'=> $this->request->getPost('vcr_code'),
				'vcr_name'=> $this->request->getPost('vcr_name'),
				'discount'=> $this->request->getPost('discount'),
				'expired_date_start'=> date("Y-m-d", strtotime($this->request->getPost('date_start'))),
				'expired_date_end'=> date("Y-m-d", strtotime($this->request->getPost('date_end'))),
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->VoucherModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Voucher/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'vcr_id' => $id
        ];
        
		$data = [
			'data' => $this->VoucherModel->where($condition)->first()
		];
		return view('Voucher/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'vcr_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->VoucherModel->where($condition)->first()
		];

		return view('Voucher/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->VoucherModel->find($id)['status'] == 1 ? 0 : 1;
				$this->VoucherModel->update($id,[
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
			'vcr_code' => 'required',
			'vcr_name' => 'required',
			'discount' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'vcr_code' => $this->request->getPost('vcr_code'),
					'vcr_name' => $this->request->getPost('vcr_name'),
					'discount' => $this->request->getPost('discount')
				],
				'validation' => $this->validator
			];
			
            echo view('Voucher/Create', $data);
        } else {
			$this->VoucherModel->update($this->request->getPost('vcr_id'),[
				'vcr_code'=> $this->request->getPost('vcr_code'),
				'vcr_name'=> $this->request->getPost('vcr_name'),
				'discount'=> $this->request->getPost('discount'),
				'expired_date_start'=> date("Y-m-d", strtotime($this->request->getPost('date_start'))),
				'expired_date_end'=> date("Y-m-d", strtotime($this->request->getPost('date_end'))),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->VoucherModel->getInsertID());
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Voucher/Index");		
        }
    }
}
