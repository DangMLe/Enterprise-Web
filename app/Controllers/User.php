<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->model('user-model');
    }
    public function index(){

    }
    //get users list
    public function userList(){
        $this->load->library('pagination');

        $data['userRecords'] = $this->user_model->getAllUsers();

        $this->global['pageTitle'] = ' User List';
        $this->loadViews("users", $this->global, $data, NULL);
    }
    function addNewUser()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $gender = $this->input->post('gender');

            $userInfo = array(
                'email' => $email,
                'password' => getHashedPassword($password),
                'roleId' => $roleId,
                'name' => $name,
                'gender' => $gender,
                'mobile' => $mobile,
                'createdBy' => $this->vendorId,
                'createdDtm' => date('Y-m-d H:i:s'));

            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            redirect('userListing');
        }
        
    }
    function editUser()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|max_length[10]');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->editOld($userId);
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $gender = $this->input->post('gender');

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array(
                    'email' => $email,
                    'roleId' => $roleId,
                    'name' => $name,
                    'gender' => $gender,
                    'mobile' => $mobile,
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s'));
            } else {
                $userInfo = array(
                    'email' => $email,
                    'password' => getHashedPassword($password),
                    'roleId' => $roleId,
                    'name' => ucwords($name),
                    'gender' => $gender,
                    'mobile' => $mobile,
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );
            }

            $result = $this->user_model->editUser($userInfo, $userId);
            if ($result == true) {
                $this->session->set_flashdata('success', 'User updated successfully');
            } else {
                $this->session->set_flashdata('error', 'User updation failed');
            }
            redirect('userListing');
        }
    }
    function deleteUser()
    {
        $userId = $this->input->post('userId');
        $result = $this->user_model->deleteUser($userId);
        if ($result > 0) {
            echo(json_encode(array('status' => TRUE)));
        } else {
            echo(json_encode(array('status' => FALSE)));
        }
    }
    
}
?>