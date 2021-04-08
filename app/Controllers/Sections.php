<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends BaseController{
    public function index()
    {
        return view('welcome_message');
    }
    public function __construct(){
        parent::__construct();
        $this->load->model('section_model');
    }
    public function userList(){
        $this->load->library('pagination');

        $data['userRecords'] = $this->user_model->getAllUsers();

        $this->global['pageTitle'] = ' User List';
        $this->loadViews("users", $this->global, $data, NULL);
    }
    function addSection()
    {
        $this->load->library('form_validation');
        
    }

}
?>