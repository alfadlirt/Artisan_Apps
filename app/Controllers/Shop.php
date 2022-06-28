<?php 
namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\ProductDetailModel;
use App\Models\ProductPicModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\ExpeditionModel;
use App\Models\PaymentModel;
use App\Models\CustomerAdrModel;
use App\Models\CustomerModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\LoginLogModel;
use App\Models\SellerModel;
use App\Models\VoucherModel;

class Shop extends BaseController
{
	protected $ProductModel;
	protected $ProductDetailModel;
	protected $ProductPicModel;
	protected $CategoryModel;
	protected $CartModel;
	protected $ExpeditionModel;
	protected $PaymentModel;
	protected $CustomerAdrModel;
	protected $CustomerModel;
	protected $TransactionModel;
	protected $TransactionDetailModel;
	protected $LoginLogModel;
	protected $SellerModel;
	protected $VoucherModel;

	public function __construct()
	{
		helper('rownumber_helper');
		helper(['form', 'url']);
		$this->ProductModel = new ProductModel();
		$this->ProductDetailModel = new ProductDetailModel();
		$this->ProductPicModel = new ProductPicModel();
		$this->CategoryModel = new CategoryModel();
		$this->CartModel = new CartModel();
		$this->ExpeditionModel = new ExpeditionModel();
		$this->PaymentModel = new PaymentModel();
		$this->CustomerAdrModel = new CustomerAdrModel();
		$this->CustomerModel = new CustomerModel();
		$this->TransactionModel = new TransactionModel();
		$this->TransactionDetailModel = new TransactionDetailModel();
		$this->LoginLogModel = new LoginLogModel();
		$this->SellerModel = new SellerModel();
		$this->VoucherModel = new VoucherModel();
		$session = session();
		$this->userid = $session->get('user_id');
	}

	public function index()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new ProductModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder
			->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])&&$searchData['status']=='0'){
				$paginateData = $builder
			->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')
			->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')
				->like('prd_name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->where('status', 1)
				->paginate($pagesize);
			}
		}

		$data = [
			'datalist' => $paginateData,
			'top2' => $builder->select('*')->limit(2)->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')->find(),
			'category' => $this->CategoryModel->findAll(),
			'pager' => $builder->pager,
			'searchform' => $searchData,
			'nomor' => nomor($this->request->getVar('page'), $pagesize)
		];
		//dd($data);
		return view('Shop/Index', $data);
	}
	
	public function ProductList()
	{
		$searchData = $this->request->getGet();
		$pagesize = (isset($searchData['pgsz'])?$searchData['pgsz']:10);

		$builder = new ProductModel();
		
		if (!isset($searchData)||sizeof($searchData)==0) {
			$paginateData = $builder
			->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')->paginate($pagesize);
		} else {
			if(!strlen($searchData['keyword'])){
				$paginateData = $builder
			->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')->paginate($pagesize);
			}
			else{
				$paginateData = $builder->select('*')
				->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')
				->like('name', (strlen($searchData['keyword'])?$searchData['keyword']:''), (strlen($searchData['keyword'])?'both':'none'))
				->where('status', 1)
				->paginate($pagesize);
			}
		}

		$data = [
			'datalist' => $paginateData,
			'category' => $this->CategoryModel->findAll(),
			'pager' => $builder->pager,
			'searchform' => $searchData,
			'nomor' => nomor($this->request->getVar('page'), $pagesize)
		];
		//dd($data);
		return view('Shop/ProductList', $data);
	}

	public function MyAccount()
	{
		$condition = [
			'cst_id' => $this->userid,
        ];
		$data = [
			'data' => $this->CustomerModel->where($condition)->first(),
			'log' => $this->LoginLogModel->where($condition)->findAll(),
			'address' => $this->CustomerAdrModel->where($condition)->findAll(),
			'state' => 0
		];
		//dd(password_hash('customer', PASSWORD_DEFAULT));
		return view('Shop/Account', $data);
	}

	public function getAddress()
	{
		$session = session();
		$condition = [
			'adr_id' => $this->request->getPost('addressid'),
			'cst_id' => $this->userid
        ];
        
        if ($this->request->isAJAX()) {
            header('Content-Type: application/json');
            $data = $this->CustomerAdrModel->where($condition)->first();
            echo json_encode($data);
        }
	}

	public function updateAddress()
	{
		$cust_id = $this->userid;
        $input = $this->validate([
			'adr_name' => 'required',
			'receipent' => 'required',
			'telp' => 'required',
			'address' => 'required',
			'notes' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'adr_name' => $this->request->getPost('adr_name'),
					'receipent' => $this->request->getPost('receipent'),
					'telp' => $this->request->getPost('telp'),
					'address' => $this->request->getPost('address'),
					'notes' => $this->request->getPost('notes')
				],
				'validation' => $this->validator,
				'log' => $this->LoginLogModel->where($condition)->findAll(),
				'address' => $this->CustomerAdrModel->where($condition)->findAll(),
				'state' => 2
			];
			
            echo view('Shop/Account', $data);
        } else {
			$this->CustomerAdrModel->update($this->request->getPost('address_id'),[
				'cst_id' => $cust_id,
				'adr_name' => $this->request->getPost('adr_name'),
				'receipent' => $this->request->getPost('receipent'),
				'telp' => $this->request->getPost('telp'),
				'address' => $this->request->getPost('address'),
				'notes' => $this->request->getPost('notes'),
				'is_main' => 1,
				'created_by' => $cust_id,//$updated,
				'modified_by' => $cust_id//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('state', 2);
			return redirect()->to(base_url()."/myaccount");
        }
	}

	public function addAddress()
	{
		$cust_id = $this->userid;
        $input = $this->validate([
			'adr_name' => 'required',
			'receipent' => 'required',
			'telp' => 'required',
			'address' => 'required',
			'notes' => 'required'
        ]);
		if (!$input) {
			//dd($this->validator);
			$data = [
				'data' => [
					'adr_name' => $this->request->getPost('adr_name'),
					'receipent' => $this->request->getPost('receipent'),
					'telp' => $this->request->getPost('telp'),
					'address' => $this->request->getPost('address'),
					'notes' => $this->request->getPost('notes')
				],
				'validation' => $this->validator,
				'log' => $this->LoginLogModel->where($condition)->findAll(),
				'address' => $this->CustomerAdrModel->where($condition)->findAll(),
				'state' => 3
			];
			
            echo view('Shop/Account', $data);
        } else {
			$this->CustomerAdrModel->save([
				'cst_id' => $cust_id,
				'adr_name' => $this->request->getPost('adr_name'),
				'receipent' => $this->request->getPost('receipent'),
				'telp' => $this->request->getPost('telp'),
				'address' => $this->request->getPost('address'),
				'notes' => $this->request->getPost('notes'),
				'is_main' => 1,
				'created_by' => $cust_id,//$updated,
				'modified_by' => $cust_id//$session->get('user_id')
			]);
			//dd($this->PaymentModel->getInsertID());
			session()->setFlashdata('state', 3);
			return redirect()->to(base_url()."/myaccount");
        }
	}

	public function updateProfile(){
        $id = $this->userid; //$this->session->get('user_id');
        $updateType = $this->request->getPost('btnUpdate');
        $input;
        $condition = [
			'cst_id' => $id
		];
        if($updateType=="pass"){
            
            
            $existingPass = $this->CustomerModel->where($condition)->first();
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
                    'validationOldPass' => $validator_pass,
					'log' => $this->LoginLogModel->where($condition)->findAll(),
					'address' => $this->CustomerAdrModel->where($condition)->findAll(),
					'state' => 1
                ];
                //dd($data['data']);
				session()->setFlashdata('state', 1);
                return view('Shop/Account', $data);
            }
        }
		
        switch($updateType){
            case "data":
                $input = $this->validate([
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'telp' => 'required|min_length[10]',
                    'email' => 'required|valid_email',
                    'usrname' => 'required|is_unique['.$this->CustomerModel->table.'.usrname,cst_id,'.$id.']|min_length[10]'
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
				'validation' => $this->validator,
				'log' => $this->LoginLogModel->where($condition)->findAll(),
				'address' => $this->CustomerAdrModel->where($condition)->findAll(),
				'state' => 1
			];
			
            return view('Shop/Account', $data);
        } else {
            switch($updateType){
                case "data":
                    $this->CustomerModel->update($id,[
                        'f_name'=> $this->request->getPost('f_name'),
                        'l_name'=> $this->request->getPost('l_name'),
                        'telp'=> $this->request->getPost('telp'),
                        'email'=> $this->request->getPost('email'),
                        'usrname'=> $this->request->getPost('usrname'),
                        'modified_by' => 'system'//$session->get('user_id')
                    ]);
                    break;
                case "pass":
                    $this->CustomerModel->update($id,[
                        'pswrd'=> password_hash($this->request->getPost('newpass1'), PASSWORD_DEFAULT),
                        'modified_by' => 'system'//$session->get('user_id')
                    ]);
                    break;
            }
			
			return redirect()->to(base_url('myaccount'));
        }
    }

	public function Cart()
	{
		$condition = [
            $this->CartModel->table.'.status' => 1,
			'cst_id' => $this->userid,
        ];
		$data = [
			'data' => $this->CartModel
			->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->CartModel->table.'.prd_id', 'left')
			->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->CartModel->table.'.prd_dtl_id', 'left')
			->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->CartModel->table.'.prd_id', 'left')
			->where($condition)->findAll()
		];
		//dd($data);
		return view('Shop/Cart', $data);
	}

	public function Checkout()
	{
		$condition = [
            $this->CartModel->table.'.status' => 1,
			'cst_id' => $this->userid,
        ];
		$data = [
			'data' => $this->CartModel
			->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->CartModel->table.'.prd_id', 'left')
			->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->CartModel->table.'.prd_dtl_id', 'left')
			->where($condition)->findAll(),
			'discount' => $this->request->getPost('voucher'),
			'expedition' => $this->ExpeditionModel->where([
				'status' => 1
			])->findAll(),
			'payment' => $this->PaymentModel->where([
				'status' => 1
			])->findAll(),
			'address' => $this->CustomerAdrModel->where([
				'cst_id' => $this->userid
			])->findAll()
		];
		//dd($data);
		return view('Shop/Checkout', $data);
	}

	public function AddOrder()
	{
		$condition = [
            $this->CartModel->table.'.status' => 1,
			'cst_id' => $this->userid,
        ];
		
		//dd($this->request->getPost());

        $input = $this->validate([
			'address_id' => 'valid_ddl',
			'payment_id' => 'valid_ddl',
			'expedition_id' => 'valid_ddl'
        ]);

  		

		if (!$input) {
			$data = [
				'val' => [
					'address_id' => $this->request->getPost('address_id'),
					'payment_id' => $this->request->getPost('payment_id'),
					'expedition_id' => $this->request->getPost('expedition_id')
				],
				'data' => $this->CartModel
				->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->CartModel->table.'.prd_id', 'left')
				->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->CartModel->table.'.prd_dtl_id', 'left')
				->where($condition)->findAll(),
				'discount' => $this->request->getPost('voucher'),
				'expedition' => $this->ExpeditionModel->where([
					'status' => 1
				])->findAll(),
				'payment' => $this->PaymentModel->where([
					'status' => 1
				])->findAll(),
				'address' => $this->CustomerAdrModel->where([
					'cst_id' => $this->userid
				])->findAll(),
				'validation' => $this->validator
			];
			
            echo view('Shop/Checkout', $data);
        } else {

			$condition = [
				$this->CartModel->table.'.status' => 1,
				'cst_id' => $this->userid,
			];

			$detailwrapped = $this->CartModel
				->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->CartModel->table.'.prd_id', 'left')
				->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->CartModel->table.'.prd_dtl_id', 'left')
				->where($condition)->findAll();
			
			

			$this->TransactionModel->save([
				'cst_id'=> $this->userid,
				'address'=> $this->request->getPost('address_id'),
				'expedition'=> $this->request->getPost('expedition_id'),
				'payment'=> $this->request->getPost('payment_id'),
				'discount'=> $this->request->getPost('discount'),
				'notes'=> $this->request->getPost('notes'),
				'total_paid_price'=> $this->request->getPost('subtotal'),
				'created_by' => $this->userid
			]);

			$inserted = $this->TransactionModel->getInsertID();

			foreach ($detailwrapped as $row) {
				$this->TransactionDetailModel->save([
					'trs_id' => $inserted,
					'prd_id' => $row['prd_id'],
					'prd_dtl_id' => $row['prd_dtl_id'],
					'qty' => $row['qty'],
					'original_price' => $row['price'],
					'subtotal' =>  $row['price']*$row['qty'],
					'created_by' => $this->userid
				]);
			}

			$this->CartModel
			->where($condition)
			->delete();
			
			return redirect()->to(base_url()."/order-placed/".$inserted);		
        }
	}
	
	public function OrderPlaced($id)
	{
		$data = [
			'data' => $this->TransactionDetailModel
			->join($this->TransactionModel->table, $this->TransactionModel->table.'.trs_id = '.$this->TransactionDetailModel->table.'.trs_id', 'left')
			->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->TransactionDetailModel->table.'.prd_id', 'left')
			->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->TransactionDetailModel->table.'.prd_dtl_id', 'left')
			->where([
				$this->TransactionDetailModel->table.'.trs_id' => $id
			])->findAll(),
			'transaction' => $this->TransactionModel
			->where([
				$this->TransactionModel->table.'.trs_id' => $id
			])->first()
		];
		//dd($data['transaction']);
		return view('Shop/OrderPlaced', $data);
	}

	public function MyOrder()
	{
		$condition2 = [
			'cst_id' => $this->userid
        ];
        
		$data = [
			'data' => $this->TransactionModel->where($condition2)->findAll()
		];
		//dd($data);
		return view('Shop/Order', $data);
	}

	public function MyOrderDetail($id)
	{
		$data = [
			'data' => $this->TransactionDetailModel
			->join($this->TransactionModel->table, $this->TransactionModel->table.'.trs_id = '.$this->TransactionDetailModel->table.'.trs_id', 'left')
			->join($this->ProductModel->table, $this->ProductModel->table.'.prd_id = '.$this->TransactionDetailModel->table.'.prd_id', 'left')
			->join($this->ProductDetailModel->table, $this->ProductDetailModel->table.'.prd_dtl_id = '.$this->TransactionDetailModel->table.'.prd_dtl_id', 'left')
			->where([
				$this->TransactionDetailModel->table.'.trs_id' => $id
			])->findAll(),
			'transaction' => $this->TransactionModel
			->where([
				$this->TransactionModel->table.'.trs_id' => $id
			])->first()
		];
		//dd($data['transaction']);
		return view('Shop/OrderDetail', $data);
	}

	public function CountCart()
    {
        $session = session();
        $id_cust = $this->userid;//$session->get('user_id');
        if ($this->request->isAJAX()) {
            header('Content-Type: application/json');
            $count = $this->CartModel->where('cst_id', $id_cust)->countAllResults();
            echo json_encode($count);
        }
    }

	public function detail($slug)
	{
		$condition1 = [
            'slug' => $slug
        ];

		$data = $this->ProductModel->where($condition1)
		->join($this->CategoryModel->table, $this->ProductModel->table.'.ktg_id = '.$this->CategoryModel->table.'.ktg_id', 'left')
		->join($this->ProductPicModel->table, $this->ProductPicModel->table.'.prd_id = '.$this->ProductModel->table.'.prd_id', 'left')
		->first();

		$condition2 = [
            $this->ProductDetailModel->table.'.prd_id' => $data['prd_id'],
			'status' => 1
        ];
        
		$data = [
			'data' => (object)$data,
			'variation' => $this->ProductDetailModel->where($condition2)->findAll(),
			'seller' => $this->SellerModel->where(['slr_id' => $data['slr_id']])->first()
		];
		//dd($data);
		return view('Shop/Detail', $data);
	}

	public function addtocart()
    {
        if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
            if (isset($this->userid)) {
                $productid = $this->request->getPost('productid');
                $detailid = $this->request->getPost('detailid');
                $qty = $this->request->getPost('qty');
                $custid = $this->userid;//$id_cust;

				$condition2 = [
					'prd_dtl_id' => $detailid,
					'cst_id' => $custid
				];

				$existingData = $this->CartModel->where($condition2)->first();
				$isExist = (isset($existingData))?true:false;

				if($isExist){
					$this->CartModel
					->where('cst_id', $custid)
					->where('prd_dtl_id', $detailid)
					->set([
						'qty' => $existingData['qty'] + $qty
						])
					->update();
				}
				else{
					$this->CartModel->save([
						'cst_id'=> $custid,
						'prd_id'=> $productid,
						'prd_dtl_id'=> $detailid,
						'qty'=> $qty,
						'status'=> 1,
						'created_by'=> 1,
					]);
				}
                
                echo json_encode('success');
            } else {
                echo json_encode('notloggedin');
            }
        }
    }

	public function deleteFromCart()
    {
        if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
            if (isset($this->userid)) {
                $cartid = $this->request->getPost('cartid');

				$condition = [
					'crt_id' => $cartid
				];

				$this->CartModel
				->where($condition)
				->delete();
                
                echo json_encode('success');
            } else {
                echo json_encode('notloggedin');
            }
        }
    }

	public function updateFromCart()
    {
        if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
            if (isset($this->userid)) {
                $cartid = $this->request->getPost('cartid');
				$qty = $this->request->getPost('qty');

				$condition = [
					'crt_id' => $cartid
				];

				$this->CartModel
					->where($condition)
					->set([
						'qty' => $qty
						])
					->update();
                
                echo json_encode('success');
            } else {
                echo json_encode('notloggedin');
            }
        }
    }

	public function generateVoucher()
    {
        if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
            if (isset($this->userid)) {
                $code = $this->request->getPost('code');

				$condition = [
					'vcr_code' => $code
				];

				$data = $this->VoucherModel
					->where($condition)
					->first();
				
				if(isset($data)){
					$item = [
						'status'=>'success',
						'data'=>$data['discount']
					];
					echo json_encode($item);	
				}
				else{
					$item = [
						'status'=>'notvalid',
						'data'=>''
					];
					echo json_encode($item);	
				}
            } else {
                echo json_encode('notloggedin');
            }
        }
    }


	public function delete($id){
		if ($this->request->isAJAX()) {
			header('Content-Type: application/json');
			try{
				
				$status = $this->ProductModel->find($id)['status'] == 1 ? 0 : 1;
				$this->ProductModel->update($id,[
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
		//dd($this->request->getPost());
		$input = $this->validate([
			'name' => 'required',
			'ktg_id' => 'required',
			'description' => 'required',
			'variationdata' => 'required'
        ]);
		if (!$input) {
			$data = [
				'data' => [
					'name' => $this->request->getPost('name'),
					'ktg_id' => $this->request->getPost('ktg_id'),
					'description' => $this->request->getPost('description'),
					'variationdata' => $this->request->getPost('variationdata')
				],
				'validation' => $this->validator
			];
			
            echo view('Shop/Create', $data);
        } else {
			$detailwrapped = json_decode($this->request->getVar('variationdata'));
			$price_min = 0;
			$price_max = 0;
			
			$condition = [
				'prd_id' => $this->request->getPost('prd_id')
			];

			$oldVariation = $this->ProductDetailModel->where($condition)->findAll();
			$newVariation = [];

			$updateVariation = [];
			$addVariation = [];
			$deleteVariation = [];

			for ($i = 0; $i < count($detailwrapped); $i++) {
				if($i == 0){
					$price_min = $detailwrapped[$i]->Price;
					$price_max = $detailwrapped[$i]->Price;
				}
				else{
					if($detailwrapped[$i]->Price<$price_min){
						$price_min = $detailwrapped[$i]->Price;
					}
					else if($detailwrapped[$i]->Price>$price_max){
						$price_max = $detailwrapped[$i]->Price;
					}
				}

				$item = [
					'prd_dtl_id' => $detailwrapped[$i]->IdVariasi,
					'prd_id' => $this->request->getPost('prd_id'),
					'variation_name' => $detailwrapped[$i]->NamaVariasi,
					'price' => $detailwrapped[$i]->Price,
					'stock' => $detailwrapped[$i]->Qty,
				];

				array_push($newVariation, $item);
			}

			//Delete Variation & Delete Variation
			foreach($oldVariation as $oldEntry) {
				$foundDelete = true;
				$foundUpdate = false;

				$itemUpdate;

				foreach($newVariation as $newEntry) {
					if($newEntry['prd_dtl_id'] == $oldEntry['prd_dtl_id']){
						$foundDelete = false;
						$foundUpdate = true;
						$itemUpdate = $newEntry;
					}
				}
				if($foundDelete){
					array_push($deleteVariation, $oldEntry);
				}
				if($foundUpdate){
					array_push($updateVariation, $itemUpdate);
				}
			}
			//Add Variation
			foreach($newVariation as $newEntry) {
				$found = true;
				foreach($oldVariation as $oldEntry) {	
					if($newEntry['prd_dtl_id'] == $oldEntry['prd_dtl_id']){
						$found = false;
					}
				}
				if($found){
					array_push($addVariation, $newEntry);
				}
			}

			$display_price = $price_min . ' - ' . $price_max;

			$this->ProductModel->update($this->request->getPost('prd_id'),[
				'name'=> $this->request->getPost('name'),
				'slug'=> url_title($this->request->getPost('name'), '-', true),
				'ktg_id'=> $this->request->getPost('ktg_id'),
				'description'=> $this->request->getPost('description'),
				'is_discount' => 0,
				'global_price_min' => $price_min,
				'global_price_max' => $price_max,
				'display_price' => $display_price,
				'status' => 1,
				'created_by' => 'system',//$updated,
				'modified_by' => 'system'//$session->get('user_id')
			]);

			foreach($addVariation as $entry) {	
				$this->ProductDetailModel->save([
					'prd_id' => $this->request->getPost('prd_id'),
					'variation_name' => $entry['variation_name'],
					'price' => $entry['price'],
					'discount_price' => $entry['price'],
					'stock' => $entry['stock'],
					'status' => 1
				]);
			}

			foreach($updateVariation as $entry) {	
				$this->ProductDetailModel->update($entry['prd_dtl_id'],[
					'variation_name' => $entry['variation_name'],
					'price' => $entry['price'],
					'discount_price' => $entry['price'],
					'stock' => $entry['stock']
				]);
			}

			foreach($deleteVariation as $entry) {	
				$this->ProductDetailModel->update($entry['prd_dtl_id'],[
					'status' => 0
				]);
			}

			session()->setFlashdata('message', 'Entry Updated Successfully!');
			session()->setFlashdata('messageStatus', 'Success');
			return redirect()->to(base_url()."/Shop/Index");		
        }
    }
}
