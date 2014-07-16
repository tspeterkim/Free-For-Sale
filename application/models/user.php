<?php
class User extends CI_Model{

    public function login($email,$password)
    {
        $query = $this->db->query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."' LIMIT 1");
        
        if($query->num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
        
    }
    
}
?>