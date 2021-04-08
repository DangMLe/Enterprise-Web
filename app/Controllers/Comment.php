<?php
public function add($post_id) {
    // if nothing posted redirect
    if (!$this->input->post()) {
        redirect(site_url());
    }

    // TODO: save comment in database
    $this->form_validation->set_rules($this->comment_model->rules);
    if ($this->form_validation->run() == true) {
        // Store the success message in flash data
        $this->session->set_flashdata('message', 'Ok! TODO save the comment.');
        // Redirect back to posts page
        redirect('posts/'.$post_id, 'refresh');
    } else {
        // Store the error message in flash data
        $this->session->set_flashdata('message', validation_errors());
        // Redirect back to posts page
        redirect('posts/'.$post_id, 'refresh');
    }
}
?>
