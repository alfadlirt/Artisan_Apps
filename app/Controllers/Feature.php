<?php 
namespace App\Controllers;
use App\Models\FeatureModel;

class Feature extends BaseController
{
	protected $FeatureModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->FeatureModel = new FeatureModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new FeatureModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('ftr_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('ftr_desc', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
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
		return view('Feature/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('Feature/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
            'ftr_name' => 'required|is_unique['.$this->FeatureModel->table.'.ftr_name]',
            'ftr_desc' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'ftr_name' => $this->request->getPost('ftr_name'),
					'ftr_desc' => $this->request->getPost('ftr_desc'),
				],
				'validation' => $this->validator
			];
			
            echo view('Feature/Create', $data);
        } else {
			$id = $this->generateID($this->FeatureModel->table,$this->FeatureModel->primaryKey);
			//dd($id);
			$this->FeatureModel->insert([
				'ftr_id'=> $id,
				'ftr_name'=> $this->request->getPost('ftr_name'),
				'ftr_desc'=> $this->request->getPost('ftr_desc'),
				'status' => 'Y',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->FeatureModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Feature/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'ftr_id' => $id
        ];
        
		$data = [
			'data' => $this->FeatureModel->where($condition)->first()
		];
		return view('Feature/Edit', $data);
	}

	public function detail($id)
	{
		$condition = [
            'ftr_id' => $id
        ];
        
		$data = [
			'data' => (object)$this->FeatureModel->where($condition)->first()
		];

		return view('Feature/Detail', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->FeatureModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->FeatureModel->update($id,[
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
            'ftr_name' => 'required|is_unique['.$this->FeatureModel->table.'.ftr_name,ftr_name,'.$this->request->getPost('ftr_name').']',
            'ftr_desc' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'ftr_name' => $this->request->getPost('ftr_name'),
					'ftr_desc' => $this->request->getPost('ftr_desc'),
				],
				'validation' => $this->validator
			];
			
            echo view('Feature/Edit', $data);
        } else {
			$this->FeatureModel->update($this->request->getPost('ftr_id'),[
				'ftr_name'=> $this->request->getPost('ftr_name'),
				'ftr_desc'=> $this->request->getPost('ftr_desc'),
				'modified_by' => 'system'//$session->get('user_id')
			]);
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Feature/Index");
        }
    }
}
