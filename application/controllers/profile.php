<?php
class Profile extends CI_Controller{
    public function index()
    {
        //nothing...    
    }
    
    public function byid($id)
    {
        $this->load->view('logo');
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['firstname'] = $session_data['firstname'];
            $data['id'] = $session_data['id'];
            $this->load->view('controlpanel',$data);    
        }
        else
        {
            $this->load->view('virgin');
        }
        
        $query = $this->db->query("SELECT * FROM products WHERE userID='".$id."' ORDER BY timestamp DESC LIMIT 0,20");
        
        $data['products'] = $query->result_array();
        
        $query = $this->db->query("SELECT * FROM users WHERE ID='".$id."'");
        $row = $query->row();
        $data['name'] = $row->firstname.' '.$row->lastname;
        
        $this->load->view('profile',$data);
        
        $this->load->view('chat');
    }
}
?>