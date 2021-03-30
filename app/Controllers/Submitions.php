<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Submitions extends BaseController{
    public function index()
    {
        return view('welcome_message');
    }
    public function __construct(){
        parent::__construct();
        $this->load->model('submitions-model');
    }

    //get users list
    public function userList(){
        $this->load->library('pagination');

        $data['SubmitionRecords'] = $this->user_model->getAllSubmitions();

        $this->global['pageTitle'] = ' User List';
        $this->loadViews("users", $this->global, $data, NULL);
    }
    function addNewSubmitions()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('SectionID', 'Section', 'trim|required|numeric');
        $this->form_validation->set_rules('SubmitonName', 'Submition Name', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('UserPassword', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('UserCPassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('Role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('UserGender', 'Gender', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('UserAge','Age','trim|required|numeric');
        $this->form_validation->set_rules('UserBDay','Birthday');
        $this->form_validation->set_rules('Department','Department', 'trim|required|numeric');
        $this->form_validation->set_rules('Avatar','Avatar');
        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('UserName'))));
            $email = strtolower($this->security->xss_clean($this->input->post('UserEmail')));
            $password = $this->input->post('UserPassword');
            $roleId = $this->input->post('Role');
            $gender = $this->input->post('UserGender');
            $age = $this->input->post('UserAge');
            $departmentId = $this->input->post('Department');
            $avatarUrl = $this->input->post('Avatar');
            $userInfo = array(
                'UserName'   => $name,
                'UserEmail' => $email,
                'UserPassword' => getHashedPassword($password),
                'RoleId' => $roleId,
                'UserGender' => $gender,
                'UserAge' => $age,
                'DepartmentID' => $departmentId,
                'UserImage' =>$avatarUrl
            );
            $this->load->model('user_model');
            $result = $this->user_model->addUser($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            redirect('userListing');
        }
    
    }
    function editOldUser($userId = null){
        if ($userId == null) {
            redirect('userListing');
        }

        $data['roles'] = $this->user_model->getRoles();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);

        $this->global['pageTitle'] = ' Edit User';
        $this->loadViews("editOld", $this->global, $data, NULL);
    }
    function editUser()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('UserName', 'User Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('UserEmail', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('UserPassword', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('UserCPassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('Role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('UserGender', 'Gender', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('UserAge','Age','trim|required|numeric');
        $this->form_validation->set_rules('UserBDay','Birthday');
        $this->form_validation->set_rules('Department','Department', 'trim|required|numeric');
        $this->form_validation->set_rules('Avatar','Avatar');
        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('UserName'))));
            $email = strtolower($this->security->xss_clean($this->input->post('UserEmail')));
            $password = $this->input->post('UserPassword');
            $roleId = $this->input->post('Role');
            $gender = $this->input->post('UserGender');
            $age = $this->input->post('UserAge');
            $departmentId = $this->input->post('Department');
            $avatarUrl = $this->input->post('Avatar');

            if (empty($password)) {
                $userInfo = array(
                'UserName'   => $name,
                'UserEmail' => $email,
                'RoleId' => $roleId,
                'UserGender' => $gender,
                'UserAge' => $age,
                'DepartmentID' => $departmentId,
                'UserImage' =>$avatarUrl);
            } else {
                $userInfo = array(
                    'UserName'   => $name,
                    'UserEmail' => $email,
                    'UserPassword' => getHashedPassword($password),
                    'RoleId' => $roleId,
                    'UserGender' => $gender,
                    'UserAge' => $age,
                    'DepartmentID' => $departmentId,
                    'UserImage' =>$avatarUrl
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
        $userId = $this->input->post('UserId');
        $result = $this->user_model->deleteUser($userId);
        if ($result > 0) {
            echo(json_encode(array('status' => TRUE)));
        } else {
            echo(json_encode(array('status' => FALSE)));
        }
    }

    function addNew()
    {
        $this->load->model('user_model');
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = ' Add New User';
        $this->loadViews("addNew", $this->global, $data, NULL);
    }
    function userProfile($userId){
        $this->getUserInfo($userId);
        $this->global['pageTitle'] = 'User Profile';
        $this->loadViews("Profile", $this->global, $data, NULL);
    }
    function uploadAvatar($userId)
    {
        $uploadResult = $this->upload(AVATAR_PATH);

        $result = $this->user_model->uploadAvatar($uploadResult['filename'], $userId);
        if ($result > 0 && !empty($uploadResult['filename'])) {
            $this->session->set_flashdata('success', 'Upload image successfully');
        } else {
            $error = empty($uploadResult['error']) ? 'Upload image failure' : $uploadResult['error'];
            $this->session->set_flashdata('error', $error);
        }
        redirect('profile');
    }
}
?>