<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected $db;
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
	}

	public function generateID($tableName,$key){
		$identifier = "";
		$spacer = "";
		switch($tableName){
			case 'lst_robot':
				$identifier = "RBT";
				break;
			case 'lst_nft':
				$identifier = "NFT";
				break;
			case 'lst_powerup':
				$identifier = "PUP";
				break;
			case 'lst_user':
				$identifier = "USR";
				break;
			case 'lst_feature':
				$identifier = "FTR";
				break;
			case 'lst_catalog_nft':
				$identifier = "CTL";
				break;
		}

		$builder = $this->db->table($tableName);
		$builder->select($key);
		$builder->orderBy($key, 'DESC');
		$builder->limit(1);
		
		$query = $builder->get();
		
		if(!isset($query->getResultArray()[0][$key])){
			$lastNum = 0;
		}
		else{
			$lastNum = $query->getResultArray()[0][$key];
			$lastNum = str_replace($identifier,"", $lastNum);
			$lastNum = str_replace("0","", $lastNum);
		}

		$newNumber = $lastNum + 1;
		
		
		//RBT0000006
		switch(strlen($newNumber)){
			case 1:
				$spacer = "000000";
				break;
			case 2:
				$spacer = "00000";
				break;
			case 3:
				$spacer = "0000";
				break;
			case 4:
				$spacer = "000";
				break;
			case 5:
				$spacer = "00";
				break;
			case 6:
				$spacer = "0";
				break;
			case 7:
				$spacer = "";
				break;
		}
		$newID = $identifier . $spacer . $newNumber;
		return $newID;
	}

}
