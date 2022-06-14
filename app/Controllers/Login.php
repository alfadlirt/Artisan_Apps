<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\NFTModel;
use App\Models\RobotModel;

class Login extends BaseController
{
    protected $adminModel;
    protected $userModel;
    protected $userDetailModel;
    protected $nftModel;
    protected $robotModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->userModel = new UserModel();
        $this->userDetailModel = new UserDetailModel();
        $this->nftModel = new NFTModel();
        $this->robotModel = new RobotModel();
        //$this->email = \Config\Services::email();
    }

    public function index()
    {
        /*$session = session();
        $data = [
            'authresult' => $session->getFlashdata('authresult')
        ];*/

        //return view('User/Login', $data);
        return view('Login/CustomerLoginPage');
    }

    public function Admin()
    {
        /*$session = session();
        $data = [
            'authresult' => $session->getFlashdata('authresult')
        ];*/

        //return view('User/Login', $data);
        return view('Login/AdminLoginPage');
    }

    public function Redeem()
    {
        /*$session = session();
        $data = [
            'authresult' => $session->getFlashdata('authresult')
        ];*/

        //return view('User/Login', $data);
        return view('Login/RedeemPass');
    }

    public function Register()
    {
        $searchData = $this->request->getGet();
        if (isset($searchData['token'])) {
            $data = [
                'token' => $searchData['token'],
                'data' => null
            ];
            return view('Login/Register', $data);
        }
        return redirect()->to(base_url() . "/");
    }

    public function CreateAccount()
    {
        $input = $this->validate([
			'f_name' => 'required',
			'l_name' => 'required',
			'email' => 'required|valid_email',
            'username' => 'required|is_unique['.$this->userModel->table.'.usrname]|min_length[10]',
            'password1' => 'required|min_length[10]',
            'password2' => 'required|min_length[10]|matches[password1]'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
                'token' => $this->request->getPost('token'),
				'data' => [
                    'f_name' => $this->request->getPost('f_name'),
                    'l_name' => $this->request->getPost('l_name'),
                    'email' => $this->request->getPost('email'),
                    'username' => $this->request->getPost('username'),
                    'password1' => $this->request->getPost('password1'),
                    'password2' => $this->request->getPost('password2')
				],
				'validation' => $this->validator
			];
			
            return view('Login/Register', $data);
        } else {
			$id = $this->generateID($this->userModel->table,$this->userModel->primaryKey);
            $token = $this->request->getPost('token');
			//dd($id);
			$this->userModel->insert([
				'usr_id'=> $id,
				'f_name'=> $this->request->getPost('f_name'),
				'l_name'=> $this->request->getPost('l_name'),
				'email'=> $this->request->getPost('email'),
				'usrname'=> $this->request->getPost('username'),
				'pswrd'=> password_hash($this->request->getPost('password2'), PASSWORD_DEFAULT),
				'status' => 'Y',
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);
            
            $rbt = $this->nftModel->select('rbt_id')->where('nft_token', $token)->first();
            //dd($token);
            $this->userDetailModel->insert([
				'usr_id'=> $id,
				'nft_token'=> $token,
				'rbt_id'=> $rbt['rbt_id'],
				'power_pts'=> 0,
				'intelligence_pts'=> 0,
				'agility_pts'=> 0,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);

            $this->nftModel
					->where('nft_token', $token)
					->set([
						'is_registered' => 'Y',
						'modified_by' => 'system'//$session->get('user_id')
						])
					->update();

			//dd($this->AdminModel->getInsertID());
			session()->setFlashdata('message', 'Entry Saved Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/login");		
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

    public function Authentication()
    {
        $session = session();
        $input_uname = $this->request->getVar('username');
        $input_password = $this->request->getVar('password');

        $loginType = $this->request->getVar('loginType');

        $array = ['usrname' => $input_uname, 'status' => 'Y'];
        if($loginType == 'ADMIN'){
            $check = $this->adminModel->where($array)->first();
        }
        else{
            $check = $this->userModel->where($array)->first();
        }
        
        
        if ($check) {
            $pass = $check['pswrd'];
            //dd(password_hash($input_password, PASSWORD_DEFAULT), $pass);
            if (password_verify($input_password, $pass)) {
                //dd("tes");
                $session_data = [
                    'type' => $loginType,
                    'username' => $check['usrname'],
                    'name' => $check['f_name']." ".$check['f_name'],
                    'logged_in' => true
                ];
                $session->set($session_data);
                return redirect()->to(base_url() . "/");
            }
        }

        $data = [
            'data' => [
                'username' => $input_uname,
                'password' => $input_password,
            ],
            'errorMsg' => 'Username/Password Not Match!'
        ];

        if($loginType == 'ADMIN'){
            return view('Login/AdminLoginPage', $data);
        }
        else{
            return view('Login/CustomerLoginPage', $data);
        }

    }

    public function myaccount()
    {
        $session = session();
        $id_cust = $session->get('user_id');
        if (isset($id_cust)) {

            $data = [
                'user_id' => $session->get('user_id'),
                'user_name' => $session->get('user_name'),
                'logged_in' => $session->get('logged_in'),
                'userdata' => $this->userModel->getUser($session->get('user_id'))
            ];
            //dd($data);
            return view('Shop/MyAccount', $data);
        } else {
            return redirect()->to(base_url() . "/account/signin");
        }
    }
    public function Logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url() . "/");
    }
    /*
    public function register()
    {
        return view('Shop/Register');
    }
    public function addregister()
    {
        $this->userModel->save([
            'first_name' => $this->request->getVar('firstname'),
            'last_name' => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
            'no_telp' => $this->request->getVar('telp'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'status' => 0
        ]);
        $inserted = $this->userModel->getInsertID();

        $html_code = "<p>Hello, " . $this->request->getVar('firstname') . " Please verify your account before you can login to Space Tech Website </p><br><a href='" . base_url() . "/account/verification/" . $inserted . "'>CLICK THIS VERIFICATION</a>";
        $this->email->setFrom('alfadlirt@gmail.com', 'SPACE TECH');
        $this->email->setTo($this->request->getVar('email'));

        $this->email->setSubject('YOUR ACCOUNT VERIFICATION');

        $this->email->setMessage($html_code);

        if ($this->email->send()) {
            return redirect()->to(base_url('/account/accountcreated'));
        } else {
            echo 'GAGAL';
        }
    }

    public function accountcreated()
    {
        return view('Shop/AccountCreated');
    }

    public function verification($id)
    {
        //dd($this->userModel->isActive($id));

        $getactive = $this->userModel->isActive($id);
        if ($getactive[0]->username == 1) {
            $this->userModel->update($id, [
                'status' => 1
            ]);
            return view('Shop/VerificationPage');
        } else {
            return redirect()->to(base_url('/'));
        }
    }
    */
}
