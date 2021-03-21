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
        function GetSubmitionInfo($UserInfo){
            $this->db->select('Submitions.*, Sections.*, SubmitFiles.*,Comments.*');
            $this->db->from('Submitions');
            $this->db->join('Sections','Submitions.SectionID=Sections.SectionID');
            $this->db->join('SubmitFiles','Users.DepartmentID=Departments.DepartmentID');
            $this->db->where('UserID',$UserInfo);
            $query = $this->db->get();
    
            $result = $query->result();
            return $result;
        }
        function deleteSubmition($SubmitionID){
            
        }
        //get contribution in a YEAR
        //
    }
?>