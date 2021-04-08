public function add($post_id){
    $post_data = array(
        'post_id' => $post_id, 
        'username'  => $this->input->post('username'),
        'email'     => $this->input->post('email'),
        'comment'   => $this->input->post('comment')
    );

        $this->db->insert('comments', $post_data);

        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }
        return false;
} 
