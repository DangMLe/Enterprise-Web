<?php
   Class Files_model extends Model{
       function GetSubmitionsFile($SubmitionID){
            $this->db->select('SubmitionFiles.*');
            $this->db->from('SubmitionFiles');
            $this->db->where('Files.SubmitionID',$SubmitionID);
            $query = $this->db->get();

            $result = $query->result();
            return $result;
        }
       function addFile($FileInfo){
        $this->db->trans_start();
        $this->db->insert('SubmitionFiles', $FileInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
        }
        function addBatchFiles($FileData){
            if ($userData) {
                $this->db
                    ->insert_batch('SubmitionFiles', $FileData);
                return true;
            } else {
                return false;
            }
        }
        function deleteFile($FileID)
        {
            $this->db->where('SubmitionFiles',$FileID);
            $this->db->delete('SubmitionFiles');
            return true;
        }
   } 
?>