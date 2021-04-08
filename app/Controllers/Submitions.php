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
    public function SubmitionList(){
        $this->load->library('pagination');

        $data['SubmitionRecords'] = $this->user_model->getAllSubmitions();

        $this->global['pageTitle'] = ' Submision List';
        $this->loadViews("Submitions", $this->global, $data, NULL);
    }
    public function SubmitionNotificationList(){
        $this->load->library('pagination');

        $data['SubmitionNotificationRecords'] = $this->user_model->getNotificationsSubmitions();

        $this->global['pageTitle'] = ' Submision List';
        $this->loadViews("Submitions", $this->global, $data, NULL);
    }
    function addNewSubmitions()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('SectionID', 'Section', 'trim|required|numeric');
        $this->form_validation->set_rules('SubmitionName', 'Submition Name', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('UserID','Users Id', 'trim|required|numeric');
        $this->form_validation->set_rules('SubmitDate',"Submition Date");
        if ($this->form_validation->run() == FALSE) {
            $this->addNew();
        } else {
            $SectionID = $this->input->post('SectionID');
            $SubmitionName = $this->input->post('SubmitionName');
            $UserID = $this->input->post('UserID');
            $SubmitDate = $this->input->post('SubmitionDate');
            $SubmitionInfo = array(
                'SectionID' => $SectionID,
                'SubmitionName' => $SubmitionName,
                'UserID' => $UserID,
                'SubmitDate' => $SubmitionDate
            );
            $this->load->model('submitions_model');
            $result = $this->user_model->addUser($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            redirect('SubmitionListing');
        }
    
    }
    function editOldSubmition($SubmitionId = null){
        if ($SubmitionId == null) {
            redirect('SubmitionListing');
        }

        $data['roles'] = $this->user_model->getRoles();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);

        $this->global['pageTitle'] = ' Edit User';
        $this->loadViews("editOld", $this->global, $data, NULL);
    }
    function editSubmition()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('SectionID');

        $this->form_validation->set_rules('SubmitionName', 'Submition Name', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('UserID','Users Id', 'trim|required|numeric');
        $this->form_validation->set_rules('SubmitDate',"Submition Date");
        if ($this->form_validation->run() == FALSE) {
            $this->EditOldSubmition();
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
    function sendEmail($SubmitionID){
        $email = \Config\Services::email();
        $email->setFrom('your@example.com', 'no reply');
        $email->setTo(this->submitions_model->getUserSubmitionEmail($SubmitionID));
        $email->setSubject('New User Submition');
        $email->setMessage('User have Submit their Submition /n Please comment the submition within 14 days /n');

        $email->send();
    }
}
?>