<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->model();
    }
}
?>