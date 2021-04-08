<?php
public function index($post_id) {
    $this->data['message'] = $this->session->flashdata('message');
    $this->load->view('posts', $this->data);
}

--echo $message; 
--post view
?>
