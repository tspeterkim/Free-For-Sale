<?php
class Register extends CI_Controller{
    public function index()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean|callback_email_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_pconfirm');
        $this->form_validation->set_rules('firstname','firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'lastname', 'trim|required|xss_clean');
        
        $this->form_validation->set_message('pconfirm','Passwords Must Match!');
        $this->form_validation->set_message('required','Please fill out everything!');
        
        if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup');
		}
		else
		{
            $this->register_user();
            $data['firstname'] = $this->input->post('firstname');
			$this->load->view('registersuccess',$data);
		}

        
    }
    
    public function pconfirm()
    {
        $pw1 = $this->input->post('password');
        $pw2 = $this->input->post('passwordconfirmation');
        if($pw1 == $pw2)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public function email_check()
    {
        $email = $this->input->post('email');
        $query = $this->db->query("SELECT * FROM users WHERE email='".$email."' LIMIT 1");
        
        
        if($query->num_rows() == 0)
        {
            //Is it a ucla email?
            if (strpos($email,'ucla.edu') !== false) 
            {
                return TRUE; 
            }
            else
            {
                $this->form_validation->set_message('email_check','It must be a UCLA Email!');
                return FALSE;
            }
        }
        else
        {
            $this->form_validation->set_message('email_check','Email already exists!');
            return FALSE;
        }
    }
    
    public function register_user()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $firstname = $this->input->post('firstname');  
        $lastname = $this->input->post('lastname');
        $data = array(
            'email' => $email,
            'password' => $password,
            'firstname' => $firstname,
            'lastname' => $lastname
        );
        $this->db->insert('users',$data);
    }

}
?>