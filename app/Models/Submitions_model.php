<?php
    class Submitions extends Model
    {
        function getSubmitionsDetails($SubmitionID) {
            $this->db->select('Submitions.*,SubmitFiles.*,FileTypes.FileType,Comments.Comment');
            $this->db->from('Submitions');
            $this->db->join('SubmitFiles','Submitions.FileID=SubmitFiles.FileID');
            $this->db->join('FileTypes','SubmitFiles.FileTypeID=FileTypes.FileTypeID');
            $this->db->join('Comments','Submitions.CommentID=Comments.CommentID');
            $this->db->where('SubmitionID',$SubmitionID);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        function getAllSubmitions(){
            $this->db->select('*');
            $this->db->from('Submitions');
            $query = $this->db->get();
            $result = $query->result();
            return $results;
        }
        function getNotificationsSubmitions(){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $this->db->query('SELECT * FROM Submitions WHERE SubmitDate <=?',[date('Y-m-d')]);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        function getUserSubmitionEmail($SubmitionID){
            $this->db->select('Submitions.UserID,User.UserEmail');
            $this->db->from('Submitions');
            $this->db->join('Users','Submitions.UserID=Users.UserID');
            $this->db->where('SubmitionID',$SubmitionID);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
        function addSubmition($SubmitionInfo){
            $this->db->trans_start();
            $this->db->insert('Submitions',$SubmitionInfo);
            $insert_id = $this->db->insert_id();

            $this->db->trans_complete();

            return $insert_id;
        }
        function addBatchSubmition($SubmitionData){
            if ($SubmitionData) {
                $this->db
                    ->insert_batch('Submitions', $SubmitionData);
                return true;
            } else {
                return false;
            }
        }
        function GetSubmitionInfo($SubmitionInfo){
            $this->db->select('Submitions.*, Sections.*,Comments.*');
            $this->db->from('Submitions');
            $this->db->join('Sections','Submitions.SectionID=Sections.SectionID');
            $this->db->join('Comments','Submitions.SectionID=Comments.SectionID');
            $this->db->where('SubmitionID',$SubmisionInfo);
            $query = $this->db->get();
    
            $result = $query->result();
            return $result;
        }

        
        function EditSubmationInfo($SubmitionInfo,$SubmitionID){
            $this->db->where('SubmitionsID',$SubmitionsID);
            $this->db->update('Submitions',$SubmisionInfo);
            return true;
        }
        function deleteSubmition($SubmitionID){
            $this->db->where('SubmitionID',$SubmitionID);
            $this->db->delete('Submitions');
            return true;
        }
    }
?>