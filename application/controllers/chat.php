<?php
class Chat extends CI_Controller{
    
    public function add_message($msg)
    {
        $tid = $this->input->post('talkingtoid');
        $session_data = $this->session->userdata('logged_in');
        $myid = $session_data['id'];
        
        if($tid != $myid){  //You are the buyer of the product
            $data = array(
                'message' => $msg ,
                'buyerID' => $myid ,
                'sellerID' => $tid ,
                'productID' => ''
            );

            $this->db->insert('chats', $data); 
        }else{  //You are the seller of the product
        
        }
        
        
    }
    
    
}

?>