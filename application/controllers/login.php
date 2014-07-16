<?php
class Login extends CI_Controller{
    public function index()
    {
        $this->load->helper(array('form'));
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['firstname'] = $session_data['firstname'];
            $this->load->view('controlpanel',$data);
        }
        else
        {
            $this->load->view('login');
        }
        
    }
}

?>