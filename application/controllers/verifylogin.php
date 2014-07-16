<?php
class Verifylogin extends CI_Controller{    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user','',TRUE);
        
    }
    public function index(){
        //$this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('home','refresh'); //as oppose to home
        }
        
    }
    public function check_database($password)
    {
        $email = $this->input->post('email');
        $result = $this->user->login($email, $password);
        
        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->ID,
                    'email' => $row->email,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname
                );
                $this->session->set_userdata('logged_in',$sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database','Invalid username or password');
            return FALSE;
        }
    }
}
?>