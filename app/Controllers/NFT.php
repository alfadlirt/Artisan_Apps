<?php 
namespace App\Controllers;
use App\Models\NFTModel;
use App\Models\RobotModel;

//require '../vendor/autoload.php';
 
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class NFT extends BaseController
{
	protected $NFTModel;
	protected $RobotModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->NFTModel = new NFTModel();
		$this->RobotModel = new RobotModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new RobotModel();

		$condition = [
            'status' => 'Y'
        ];

		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->where($condition)->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->where($condition)->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->where($condition)
				->Like('rbt_code', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('rbt_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('rbt_desc', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('nft_generated', ($searchData['status']!='0'?$searchData['status']:''), ($searchData['status']!='0'?'both':'none'))
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
		return view('NFT/Index', $data);
	}
	
	public function New()
	{
		$data = [
			'data' => null
		];
		return view('NFT/Create', $data);
	}

	public function Save()
	{
        $input = $this->validate([
            'nft_name' => 'required|is_unique['.$this->NFTModel->table.'.nft_name]',
            'nft_desc' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'nft_name' => $this->request->getPost('nft_name'),
					'nft_desc' => $this->request->getPost('nft_desc'),
				],
				'validation' => $this->validator
			];
			
            echo view('NFT/Create', $data);
        } else {
			$id = $this->generateID($this->NFTModel->table,$this->NFTModel->primaryKey);
			//dd($id);
			$this->NFTModel->insert([
				'nft_id'=> $id,
				'nft_name'=> $this->request->getPost('nft_name'),
				'nft_desc'=> $this->request->getPost('nft_desc'),
				'status' => 'Y',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->NFTModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/NFT/Index");		
        }
	}
	
	public function edit($id)
	{
		$condition = [
            'nft_id' => $id
        ];
        
		$data = [
			'data' => $this->NFTModel->where($condition)->first()
		];
		return view('NFT/Edit', $data);
	}

	public function detail($id)
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new NFTModel();
		$condition = [
            'rbt_id' => $id
        ];
		//dd($searchData);
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->select('*')->where($condition)->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder->select('*')->where($condition)->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->where($condition)
				->Like('nft_token', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('link', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->Like('is_registered', ($searchData['status']!='0'?$searchData['status']:''), ($searchData['status']!='0'?'both':'none'))
				->paginate($pagesize);
				//->builder->getCompiledSelect();

				//dd($paginateData);
			}
		}

		$rbtData = $this->RobotModel->select('rbt_name, rbt_id')->where('rbt_id', $id)->first();

		$data = [
			'rbtId' => $rbtData['rbt_id'],
			'rbtName' => $rbtData['rbt_name'],
			'datalist' => $paginateData,
			'pager' => $builder->pager,
			'searchform' => $searchData,
			'nomor' => nomor($this->request->getVar('page'), $pagesize)
		];
		
		return view('NFT/DetailNFT', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->NFTModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->NFTModel->update($id,[
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

	public function GetDetail(){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				$token = $this->request->getPost('token');
				$data = $this->NFTModel->select('link')->where('nft_token', $token)->first();
				$response = [
					'status' => 'success',
					'link' => $data['link']
				];
				echo json_encode($response);
			}
			catch(Exception $e){
				$response = [
					'status' => 'failed'
				];
				echo json_encode($response);
			}
		}
    }

	public function UpdateLink(){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				$token = $this->request->getPost('token');
				$link = $this->request->getPost('link');

				$this->NFTModel
					->where('nft_token', $token)
					->set([
						'link' => $link,
						'modified_by' => 'system'//$session->get('user_id')
						])
					->update();

				echo json_encode("success");
			}
			catch(Exception $e){
				echo json_encode("failed");
			}
		}
    }

	public function DeleteToken(){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				$token = $this->request->getPost('token');

				$this->NFTModel
					->where('nft_token', $token)
					->delete();

				echo json_encode("success");
			}
			catch(Exception $e){
				echo json_encode("failed");
			}
		}
    }

	public function GenerateToken(){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				$nitems = $this->request->getPost('nitems');
				$rbtid = $this->request->getPost('rbtid');
				$newUUID = '';
				try {
					for ($i = 0; $i < $nitems; $i++) {
						$newUUID = Uuid::uuid1()->toString();
						$this->NFTModel->insert([
							'nft_token'=> $newUUID,
							'rbt_id'=> $rbtid,
							'link'=> '',
							'is_registered' => 'N',
							'created_by' => 'system',//$updated,
							'modified_by' => 'system'//$session->get('user_id')
						]);
					}
	
					$this->RobotModel
					->where('rbt_id', $rbtid)
					->set([
						'nft_generated' => 'Y',
						'modified_by' => 'system'//$session->get('user_id')
						])
					->update();
	
					echo json_encode('success');
				} catch (UnsatisfiedDependencyException $e) {
					echo 'Caught exception: ' . $e->getMessage() . "\n";
					echo json_encode('failed');
				}
			}
			catch(Exception $e){
				echo json_encode('failed');
			}
		}
    }
}
