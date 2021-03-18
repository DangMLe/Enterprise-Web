<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	protected $UserID='';
	protected $UserName='';
	protected $UserPassword='';
	protected $Role='';
	protected $UserGender='';
	protected $UserAge='';
	protected $UserBday='';
	protected $UserEmail='';
	protected $Department='';

	public function globalSession(){
		$this->$UserID = $this->session->userdata('UserID');
		$this->$UserName = $this->session->userdata('UserName');
		$this->$UserPassword = $this->session->userdata('UserPassword');
		$this->$Role = $this->session->userdata('Role');
		$this->$UserGender = $this->session->userdata('UserGender');
		$this->$UserAge = $this->session->userdata('UserAge');
		$this->$UserBday = $this->session->userdata('UserBday');
		$this->$UserEmail = $this->session->userdata('UserEmail');
		$this->$Department = $this->session->userdata('Department');
	}

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
	}
}
