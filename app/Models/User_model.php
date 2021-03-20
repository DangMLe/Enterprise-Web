<?php
class User_model extends Model{
    //Get all the user account available on the database
    function getAllUsers(){
        $this->db->select('Users.*, Roles.RoleName, Departments.DepartmentName');
        $this->db->from('Users');
        $this->db->join('Roles','Users.RoleID=Roles.RoleID');
        $this->db->join('Departments','Users.DepartmentID=Departments.DepartmentID');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    //Add new user account to the database
    function addUser($userInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function addBatchUser($UserData){
        if ($userData) {
            $this->db
                ->insert_batch('tbl_users', $userData);
            return true;
        } else {
            return false;
        }
    }
    function GetUserInfo($UserInfo){
        $this->db->select('Users.*, Roles.RoleName, Departments.DepartmentName');
        $this->db->from('Users');
        $this->db->join('Roles','Users.RoleID=Roles.RoleID');
        $this->db->join('Departments','Users.DepartmentID=Departments.DepartmentID');
        $this->db->where('UserID',$UserInfo);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function GetUserSubmissions($UserInfo){
        $this->db->select('Submition.*, Sections.*');
        $this->db->from('Submition');
        $this->db->join('Sections','Submition.SectionID=Sections.SectionID');
        $this->db->where('UserID',$UserInfo);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    //Edit User from database
    function editUser($UserInfo,$UserID){
        $this->db->where('UserID',$UserID);
        $this->db->update('Users',$UserInfo);
        return true;
    }
    //Delete user from Database
    function deleteUser($UserID){
        $this->db->where('UserID',$UserID);
        $this->db->delete('Users');
        return true;
    }
    //Get Roles available on the database
    function getRoles(){
        $this->db->select('*');
        $this->db->from('Roles');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
}
?>