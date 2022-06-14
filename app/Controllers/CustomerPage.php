<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;

class CustomerPage extends BaseController
{
    protected $adminModel;
    protected $userModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->userModel = new UserModel();
        //$this->email = \Config\Services::email();
    }

    public function index()
    {
        return view('CustomerPage/HomePage');
    }

    public function MyRobot()
    {
        return view('CustomerPage/MyRobot');
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

}
