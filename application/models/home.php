<?php
class Home extends CI_Model{
    public function get_waitlist_users_by_product_id($id){
        $query = $home_control->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$id."' ORDER BY interests.timestamp ASC");  
        return $query->result_array();
    }
}
?>