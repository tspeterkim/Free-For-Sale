<?php
class Home extends CI_Controller{
    public function index()
    {
        //1. Load Logo...should be static
        $this->load->view('logo');
        
        //Depending if logged in, display appropriate header content
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
        $this->load->view('sidepanel');
        $this->load->view('products');
        
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $query = $this->db->query("SELECT * FROM interests INNER JOIN products ON products.ID=interests.productID AND interests.userID='".$session_data['id']."' INNER JOIN users ON products.userID=users.ID ORDER BY interests.timestamp ASC");
            $data['products'] = $query->result_array();
            
            
            $query = $this->db->query("SELECT * FROM products INNER JOIN users on products.userID=users.ID AND products.userID ='".$session_data['id']."'");
            $data['myproducts'] = $query->result_array();
            
            /*
            $query = $this->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$id."' ORDER BY interests.timestamp ASC");
            */
            /*
            foreach ($query->result_array() as $row){
                $q2 = $this->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$row['ID']."' ORDER BY interests.timestamp ASC");
            }
            */
            //$data['hc'] = $this->Home;
            /*
            $query = $this->db->query("SELECT * FROM users INNER JOIN products ON products.userID='".$session_data['id']."' INNER JOIN interests ON interests.userID='".$session_data['id']."' ORDER BY interests.timestamp ASC");
            $data['interests'] = $query->result_array();*/
             
            $this->load->view('chat',$data);
        }

    }
    
    public function update_interests()
    {
        $session_data = $this->session->userdata('logged_in');
        $query = $this->db->query("SELECT * FROM interests INNER JOIN products ON products.ID=interests.productID AND interests.userID='".$session_data['id']."' ORDER BY interests.timestamp ASC");
        foreach ($query->result() as $row){
            echo '<li><img class="chat_products_images" src="'.$row->imglocation.'" /></li>';
        }
        
    }
    
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('home','refresh');
    }
    
    public function search()
    {
    
    }
    
    public function find_user_by_productid($id)
    {
        $query = $this->db->query("SELECT * FROM users where ID=".$id." LIMIT 1");
        return $query->result();
    }
    
    public function categories()
    {
        $type = $this->input->post('type');
        $query = '';
        if($type == 0)  //Recents
        {
            $query = $this->db->query("SELECT products.ID AS pid, products.userID, products.description, products.price, products.imglocation, users.firstname, users.lastname FROM products INNER JOIN users ON products.userID=users.ID ORDER BY products.timestamp DESC LIMIT 0,20");
            
            echo '<div id="product_typetitle_div">Recents</div>';
            
        }
        else if($type == 1) //Clothing
        {
            echo '<div id="product_typetitle_div">Clothing</div>';
        }
        else if($type == 2) //Textbooks
        {
            echo '<div id="product_typetitle_div">Textbooks</div>';
        }
        else if($type == 3) //Electronics
        {
            echo '<div id="product_typetitle_div">Electronics</div>';
        }
        else if($type == 4) //Furnitures/Appliances
        {
            echo '<div id="product_typetitle_div">Furnitures/Appliances</div>';
        }
        else if($type == 5) //Apartments
        {
            echo '<div id="product_typetitle_div">Apartments</div>';
        }
        else if($type == 6) //Misc
        {
            echo '<div id="product_typetitle_div">Misc</div>';
        }
        else if($type == 7) //Free
        {
            echo '<div id="product_typetitle_div">Freebies</div>';
        }
        //Display the items
        foreach ($query->result() as $row){
            echo '
            <div class="products_single_divs">
            <a href="'.base_url("index.php/profile/byid/".$row->userID).'" class="products_bywho_links">'.$row->firstname.' '.$row->lastname.'</a>
            <span class="products_description_spans">'.$row->description.'</span>
            <a class="products_preview_links" href="'.site_url('home/product/'.$row->pid).'"><img class="products_images" src="'.$row->imglocation.'" /></a>
            <span class="products_price_spans">$'.$row->price.'</span>
            </div>';
        }
    }
    
    function product($id)
    {
        $query = $this->db->query("SELECT * FROM products INNER JOIN users ON users.ID=products.userID AND products.ID='".$id."'");
        $row = $query->row();
        echo '
        <div class="preview_divs">
            <img class="preview_images" src="'.$row->imglocation.'" />
            <div id="preview_div_'.$id.'" class="preview_info_divs">
                <a href="'.base_url("index.php/profile/byid/".$row->userID).'" class="products_bywho_links">'.$row->firstname.' '.$row->lastname.'</a>
                <div class="preview_description_divs">'.$row->description.'</div>
                <div class="preview_price_divs">$'.$row->price.'</div>';
        
        
        
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $query = $this->db->query("SELECT * FROM interests WHERE userID='".$session_data['id']."' AND productID='".$id."'");
            $q2 = $this->db->query("SELECT * FROM products WHERE ID='".$id."' AND userID='".$session_data['id']."'");
            if($q2->num_rows > 0){
                echo '<div class="preview_ownstuff_divs">This is yours</div>';
            }else{
                if ($query->num_rows() > 0){    //Already interested
                    echo '<button class="preview_interest_buttons">Uninterest...</button>';
                }else{
                    echo '<button class="preview_interest_buttons">Interest!</button>';
                }
            }
            
            //$session_data = $this->session->userdata('logged_in');
            //$data['firstname'] = $session_data['firstname'];
            
        }
        else
        {
            echo '<button class="preview_interest_buttons" disabled>Interest!</button>';
            echo '<span class="login_first_spans">Please '.anchor('login/','Log In',array('class'=>'preview_login_links')).' First</span>';
        }
        
        echo '
                <ol class="preview_waitlists">';
        
        $query = $this->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$id."' ORDER BY interests.timestamp ASC");
        if ($query->num_rows() > 0) //If interests exists...
        {
            foreach ($query->result() as $row){
                if($session_data['id']==$row->ID){
                    echo '<li>You</li>';
                }else{
                    echo '<li>'.$row->firstname.' '.$row->lastname.'</li>';
                }
            }
        }
        else    //If no interests
        {
            echo '<span class="preview_emptywl_spans">The waitlist is empty. You can be the first!</span>';
        }
        
        echo '
                    
                </ol>
            </div>
        </div>';
    }
    
    function interest($action)
    {
        $pid = $this->input->post('pid');
        $session_data = $this->session->userdata('logged_in');
        
        if($action == 1)  //Interest
        {
            $data = array(
               'productID' => $pid ,
               'userID' => $session_data['id']
            );
            $this->db->insert('interests', $data); 
        }    
        else if($action == 0)   //Not interest
        {
            $this->db->delete('interests', array('userID' => $session_data['id'],'productID' => $pid));
        }
        
        //Update waitlist
        $query = $this->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$pid."' ORDER BY interests.timestamp ASC");
        if ($query->num_rows() > 0) //If interests exists...
        {
            foreach ($query->result() as $row){
                if($session_data['id']==$row->ID){
                    echo '<li>You</li>';
                }else{
                    echo '<li>'.$row->firstname.' '.$row->lastname.'</li>';
                }
            }
        }
        else    //If no interests
        {
            echo '<span class="preview_emptywl_span">The waitlist is empty. You can be the first!</span>';
        }
        
    }
}
?>