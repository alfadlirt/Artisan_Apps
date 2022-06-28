<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		
	}
	public function index()
	{
		return view('Dashboard/Dashboard');
	}
	public function Seller()
	{
		return view('Dashboard/DashboardSeller');
	}
}
