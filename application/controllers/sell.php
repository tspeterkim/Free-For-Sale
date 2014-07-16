<?php
class Sell extends CI_Controller{
    public function index()
    {
        $this->load->view('sell',array('error' => ' ' ));
    }
    
    public function check_length()
    {
        $desc = $this->input->post('description');
        if(strlen($desc) <= 200)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function add()
    {
        
        $this->form_validation->set_rules('description', 'Description','trim|required|xss_clean|callback_check_length');
        $checked = $this->input->post('free');
        if($checked == 1){
            $this->form_validation->set_rules('price', 'Price', 'trim|xss_clean');
        }else{
            $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
        }
        
        
        $this->form_validation->set_message('check_length','Description has to under 200 characters!');
        $this->form_validation->set_message('required','Please fill out everything!');
        
        if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('sell',array('error' => ' ' ));
		}
        else
        {
            $config['upload_path'] = './uploads/products/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size']	= '100';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';

            $this->load->library('upload', $config);
            $string = "image";
            //Perform upload.
            if($this->upload->do_upload($string))
            {
                $description = $this->input->post('description');
                $checked = $this->input->post('price');
                if((int) $checked == 1){
                    $price = 0;
                }else{
                    $price = $this->input->post('price');
                }
                //$price = $this->input->post('price');
                $tmp = $this->upload->data();
                $session_data = $this->session->userdata('logged_in');
                $userID = $session_data['id'];
                $data = array(
                    'description' => $description,
                    'price' => $price,
                    'imglocation' => base_url("uploads/products/".$tmp['file_name']),
                    'userID' => $userID
                );
                $this->db->insert('products',$data);
                $data['ID'] = $this->db->insert_id();
                $this->load->view('sellsuccess', $data);
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());

			     $this->load->view('sell', $error);
                $this->form_validation->set_message('','Something Went Wrong! Please Try Again');
            }
        }
        
    }
}
?>