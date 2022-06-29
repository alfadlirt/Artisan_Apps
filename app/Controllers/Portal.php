<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CustomerModel;
use App\Models\SellerModel;
use App\Models\LoginLogModel;

class Portal extends BaseController
{
    protected $adminModel;
    protected $customerModel;
    protected $sellerModel;
    protected $loginLogModel;
    protected $session;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->customerModel = new CustomerModel();
        $this->sellerModel = new SellerModel();
        $this->loginLogModel = new LoginLogModel();
        $this->session = session();
        //$this->email = \Config\Services::email();
    }

    public function AdminLogin()
    {
        return view('Portal/AdminLogin');
    }

    public function SellerLogin()
    {
        return view('Portal/SellerLogin');
    }

    public function CustomerLogin()
    {
        return view('Portal/CustomerLogin');
    }

    public function CustomerRegister()
    {
        return view('Portal/CustomerRegister');
    }

    public function SellerRegister()
    {
        return view('Portal/SellerRegister');
    }

    public function authenticationCustomer()
    {
        
        $input_uname = $this->request->getVar('username');
        $input_password = $this->request->getVar('password');
        $array = ['usrname' => $input_uname, 'status' => 1];
        $check = $this->customerModel->where($array)->first();

        $data = [
			'username' => $input_uname,
		];
        
        if ($check) {
            $pass = $check['pswrd'];
            
            if (password_verify($input_password, $pass)) {
                $session_data = [
                    'user_id' => $check['cst_id'],
                    'user_name' => $check['f_name'].' '.$check['l_name'],
                    'user_username' => $check['usrname'],
                    'role' => $check['role'],
                    'profile_pic' => $check['pic'],
                    'logged_in' => true
                ];

                $this->loginLogModel->save([
                    'login_date'=> $updated = date("Y-m-d H:i:s"), 
                    'client'=> 'Jakarta', 
                    'cst_id'=> $check['cst_id']
                ]);

                $this->session->set($session_data);

                return redirect()->to(base_url() . "/");
                
            }
        }
        $this->session->setFlashdata('authresult', 'Username or Password Not Match!');
        return view('Portal/CustomerLogin', $data);
    }

    public function authenticationSeller()
    {
        $input_uname = $this->request->getVar('username');
        $input_password = $this->request->getVar('password');
        $array = ['usrname' => $input_uname, 'status' => 1];
        $check = $this->sellerModel->where($array)->first();

        $data = [
			'username' => $input_uname,
		];
        
        if ($check) {
            $pass = $check['pswrd'];
            
            if (password_verify($input_password, $pass)) {
                $session_data = [
                    'user_id' => $check['slr_id'],
                    'user_name' => $check['f_name'].' '.$check['l_name'],
                    'user_username' => $check['usrname'],
                    'role' => $check['role'],
                    'profile_pic' => $check['pic'],
                    'logged_in' => true
                ];

                $this->session->set($session_data);

                return redirect()->to(base_url("/dashboard-seller"));
                
            }
        }
        $this->session->setFlashdata('authresult', 'Username or Password Not Match!');
        return view('Portal/SellerLogin', $data);
    }

    public function authenticationAdmin()
    {
        $input_uname = $this->request->getVar('username');
        $input_password = $this->request->getVar('password');
        $array = ['usrname' => $input_uname, 'status' => 1];
        $check = $this->adminModel->where($array)->first();

        $data = [
			'username' => $input_uname,
		];
        
        if ($check) {
            $pass = $check['pswrd'];
            
            if (password_verify($input_password, $pass)) {
                $session_data = [
                    'user_id' => $check['adm_id'],
                    'user_name' => $check['f_name'].' '.$check['l_name'],
                    'user_username' => $check['usrname'],
                    'role' => $check['role'],
                    'profile_pic' => $check['pic'],
                    'logged_in' => true
                ];
                $this->session->set($session_data);

                return redirect()->to(base_url("/dashboard-admin"));
                
            }
        }
        $this->session->setFlashdata('authresult', 'Username or Password Not Match!');
        return view('Portal/AdminLogin', $data);
    }

    public function profile(){
        $condition = [
            'usr_id' => $this->session->get('user_id')
        ];
        
		$data = [
			'data' => (object)$this->adminModel->where($condition)->first()
		];
        
        return view('Profile', $data);
    }

    public function editModeProfile(){
        $condition = [
            'usr_id' => $this->session->get('user_id')
        ];
        
		$data = [
			'data' => $this->adminModel->where($condition)->first()
		];
        //dd($data);
        return view('EditProfile', $data);
    }

    public function updateProfile(){
        $id = $this->session->get('user_id');
        $updateType = $this->request->getPost('btnUpdate');
        $input;
        
        if($updateType=="pass"){
            $condition = [
                'usr_id' => $id
            ];
            
            $existingPass = $this->adminModel->where($condition)->first();
            $isOldPassValid = true;
            if($this->request->getPost('oldpass')){
                if(!password_verify($this->request->getPost('oldpass'), $existingPass['pswrd'])){
                    $validator_pass = "Old Password Not Match!";
                    $isOldPassValid = false;
                }
            }
            else{
                $validator_pass = "Old Password Required!";
                $isOldPassValid = false;
            }
            
            if(!$isOldPassValid){
                $data = [
                    'data' => [
                        'f_name' => $this->request->getPost('f_name'),
                        'l_name' => $this->request->getPost('l_name'),
                        'telp' => $this->request->getPost('telp'),
                        'email' => $this->request->getPost('email'),
                        'usrname' => $this->request->getPost('usrname')
                    ],
                    'validation' => $this->validator,
                    'validationOldPass' => $validator_pass
                ];
                //dd($data['data']);
                return view('EditProfile', $data);
            }
        }
		
        switch($updateType){
            case "pic":
                $input = $this->validate([
                    'picinput' => 'uploaded[picinput]'
                ]);
                break;
            case "data":
                $input = $this->validate([
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'telp' => 'required|min_length[10]',
                    'email' => 'required|valid_email',
                    'usrname' => 'required|is_unique['.$this->adminModel->table.'.usrname,usr_id,'.$id.']|min_length[10]'
                ]);
                break;
            case "pass":
                $input = $this->validate([
                    'newpass1' => 'required|min_length[8]',
                    'newpass2' => 'required|min_length[8]|matches[newpass1]',
                ]);
                break;
        }

        if (!$input) {
            $input_data = [];
            $validator_data;
			switch($updateType){
                case "pic":
                    break;
                case "data":
                    $input_data = [
                        'f_name' => $this->request->getPost('f_name'),
                        'l_name' => $this->request->getPost('l_name'),
                        'telp' => $this->request->getPost('telp'),
                        'email' => $this->request->getPost('email'),
                        'usrname' => $this->request->getPost('usrname')
                    ];
                    break;
                case "pass":
                    $input_data = [
                        'f_name' => $this->request->getPost('f_name'),
                        'l_name' => $this->request->getPost('l_name'),
                        'telp' => $this->request->getPost('telp'),
                        'email' => $this->request->getPost('email'),
                        'usrname' => $this->request->getPost('usrname'),
                        'oldpass' => $this->request->getPost('oldpass'),
                        'newpass1' => $this->request->getPost('newpass1'),
                        'newpass2' => $this->request->getPost('newpass2')
                    ];
                    break;
            }
			$data = [
				'data' => $input_data,
				'validation' => $this->validator
			];
			
            return view('EditProfile', $data);
        } else {
            switch($updateType){
                case "pic":
                    $files = $this->request->getFiles();
                    $imgContent = file_get_contents($files['picinput']->getTempName());
                    
                    $this->adminModel->update($id,[
                        'pic'=> $imgContent,
                        'modified_by' => $this->session->get('user_username')//'system'//$session->get('user_id')
                    ]);
                    break;
                case "data":
                    $this->adminModel->update($id,[
                        'f_name'=> $this->request->getPost('f_name'),
                        'l_name'=> $this->request->getPost('l_name'),
                        'telp'=> $this->request->getPost('telp'),
                        'email'=> $this->request->getPost('email'),
                        'usrname'=> $this->request->getPost('usrname'),
                        'modified_by' => $this->session->get('user_username')//'system'//$session->get('user_id')
                    ]);
                    break;
                case "pass":
                    $this->adminModel->update($id,[
                        'pswrd'=> password_hash($this->request->getPost('newpass1'), PASSWORD_DEFAULT),
                        'modified_by' => $this->session->get('user_username')//'system'//$session->get('user_id')
                    ]);
                    break;
            }
			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url('profile'));
        }
    }
    public function addCustomer()
	{
        $input = $this->validate([
			'f_name' => 'required',
            'l_name' => 'required',
            'telp' => 'required|min_length[10]',
            'email' => 'required|valid_email',
            'usrname' => 'required|is_unique['.$this->customerModel->table.'.usrname'.']|min_length[10]',
            'pass1' => 'required|min_length[8]',
            'pass2' => 'required|min_length[8]|matches[pass1]',
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
                    'pass1' => $this->request->getPost('pass1'),
                    'pass2' => $this->request->getPost('pass2')
				],
				'validation' => $this->validator
			];
			
            echo view('Portal/CustomerRegister', $data);
        } else {
			$this->customerModel->save([
				'f_name'=> $this->request->getPost('f_name'),
                'l_name'=> $this->request->getPost('l_name'),
                'telp'=> $this->request->getPost('telp'),
                'email'=> $this->request->getPost('email'),
                'usrname'=> $this->request->getPost('usrname'),
                'pswrd'=> password_hash($this->request->getPost('pass1'), PASSWORD_DEFAULT),
                'status'=> 1,
                'created_by' => 'system',//$session->get('user_id')
                'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('state', 1);
			return redirect()->to(base_url()."/login");
        }
	}
    public function addSeller()
	{
        $input = $this->validate([
            'shop_name' => 'required|is_unique['.$this->sellerModel->table.'.shop_name'.']',
            'shop_description' => 'required',
            'shop_address' => 'required',
			'f_name' => 'required',
            'l_name' => 'required',
            'telp' => 'required|min_length[10]',
            'email' => 'required|valid_email',
            'usrname' => 'required|is_unique['.$this->customerModel->table.'.usrname'.']|min_length[10]',
            'pass1' => 'required|min_length[8]',
            'pass2' => 'required|min_length[8]|matches[pass1]',
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
                    'shop_name' => $this->request->getPost('shop_name'),
                    'shop_description' => $this->request->getPost('shop_description'),
                    'shop_address' => $this->request->getPost('shop_address'),
					'f_name' => $this->request->getPost('f_name'),
                    'l_name' => $this->request->getPost('l_name'),
                    'telp' => $this->request->getPost('telp'),
                    'email' => $this->request->getPost('email'),
                    'usrname' => $this->request->getPost('usrname'),
                    'pass1' => $this->request->getPost('pass1'),
                    'pass2' => $this->request->getPost('pass2')
				],
				'validation' => $this->validator
			];
			
            echo view('Portal/SellerRegister', $data);
        } else {
			$this->sellerModel->save([
                'shop_name' => $this->request->getPost('shop_name'),
                'shop_description' => $this->request->getPost('shop_description'),
                'shop_address' => $this->request->getPost('shop_address'),
				'f_name'=> $this->request->getPost('f_name'),
                'l_name'=> $this->request->getPost('l_name'),
                'telp'=> $this->request->getPost('telp'),
                'email'=> $this->request->getPost('email'),
                'usrname'=> $this->request->getPost('usrname'),
                'pswrd'=> password_hash($this->request->getPost('pass1'), PASSWORD_DEFAULT),
                'status'=> 1,
                'created_by' => 'system',//$session->get('user_id')
                'modified_by' => 'system'//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('state', 1);
			return redirect()->to(base_url()."/seller/login");
        }
	}
    public function myaccount()
    {
        $id_cust = $this->session->get('user_id');
        if (isset($id_cust)) {
            $data = [
                'user_id' => $this->session->get('user_id'),
                'user_name' => $this->session->get('user_name'),
                'logged_in' => $this->session->get('logged_in'),
                'userdata' => $this->adminModel->getUser($this->session->get('user_id'))
            ];
            //dd($data);
            return view('Shop/MyAccount', $data);
        } else {
            return redirect()->to(base_url() . "/account/signin");
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url() . "/");
    }
    /*
    public function register()
    {
        return view('Shop/Register');
    }
    public function addregister()
    {
        $this->adminModel->save([
            'first_name' => $this->request->getVar('firstname'),
            'last_name' => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
            'no_telp' => $this->request->getVar('telp'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'status' => 0
        ]);
        $inserted = $this->adminModel->getInsertID();

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
        //dd($this->adminModel->isActive($id));

        $getactive = $this->adminModel->isActive($id);
        if ($getactive[0]->username == 1) {
            $this->adminModel->update($id, [
                'status' => 1
            ]);
            return view('Shop/VerificationPage');
        } else {
            return redirect()->to(base_url('/'));
        }
    }
    */
}
