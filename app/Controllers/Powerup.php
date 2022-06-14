<?php 
namespace App\Controllers;
use App\Models\PowerupModel;
use App\Models\RobotModel;

//require '../vendor/autoload.php';
 
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Powerup extends BaseController
{
	protected $PowerupModel;
	protected $RobotModel;
	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->PowerupModel = new PowerupModel();
		$this->RobotModel = new RobotModel();
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new PowerupModel();
		
		//dd($searchData);
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder->select('*')->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'&&$searchData['type']=='0'){
				$paginateData = $builder->select('*')->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->orLike('powerup_token', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->orLike('link', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->like('type', ($searchData['type']!='0'?$searchData['type']:''), ($searchData['type']!='0'?'both':'none'))
				->orLike('is_registered', ($searchData['status']!='0'?$searchData['status']:''), ($searchData['status']!='0'?'both':'none'))
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
		
		return view('Powerup/Index', $data);
	}

	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->PowerupModel->find($id)['status'] == 'Y' ? 'N' : 'Y';
				$this->PowerupModel->update($id,[
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
				$data = $this->PowerupModel->select('link, type')->where('powerup_token', $token)->first();
				$response = [
					'status' => 'success',
					'link' => $data['link'],
					'type' => $data['type']
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

	public function UpdateToken(){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				$token = $this->request->getPost('token');
				$type = $this->request->getPost('type');
				$link = $this->request->getPost('link');

				$this->PowerupModel
					->where('powerup_token', $token)
					->set([
						'link' => $link,
						'type' => $type,
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

				$this->PowerupModel
					->where('powerup_token', $token)
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
				$type = $this->request->getPost('type');
				$pts = $this->request->getPost('pts');
				$newUUID = '';
				try {
					for ($i = 0; $i < $nitems; $i++) {
						$newUUID = Uuid::uuid1()->toString();
						$this->PowerupModel->insert([
							'powerup_token'=> $newUUID,
							'type'=> $type,
							'pts'=> $pts,
							'link'=> '',
							'is_registered' => 'N',
							'created_by' => 'system',//$updated,
							'modified_by' => 'system'//$session->get('user_id')
						]);
					}
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

	public function TokenAuthentication()
    {
        $session = session();
        $token = $this->request->getVar('token');

        $array = ['nft_token' => $token, 'is_registered' => 'N'];

        $check = $this->nftModel->where($array)->first();
        
        if ($check) {
            $status = "success";
            $msg = "Token Valid!";
        }
        else{
            $status = "failed";
            $msg = "Token Not Valid!";
        }
        $data = [
            'data' => [
                'token' => $token
            ],
            'status' => $status,
            'msg' => $msg
        ];
        return view('Login/RedeemPass', $data);
    }
}
