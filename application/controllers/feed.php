<?php
class Feed extends CI_Controller
{
	//$ipID = "";
    public function index()
    {
		//$query = $this->db->query("SELECT * FROM feeds");
		$query = $this->db->query("SELECT ID, message, latitude, longitude, likes, timestamp, 
									(likes / ( LN(TIMESTAMPDIFF(SECOND, feeds.timestamp, CURRENT_TIMESTAMP())) * POW(( 3959 * acos( cos( radians(37) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(-122) ) + sin( radians(37) ) * sin( radians( latitude ) ) ) ),2))) AS rank  
									FROM feeds
									ORDER BY rank DESC
									LIMIT 0,20");

        $data['feeds'] = $query->result_array();
		
		$ip = $this->get_client_ip();
		$query = $this->db->query("SELECT * FROM ips WHERE ip='".$ip."'");
		
		if($query->num_rows() > 0){	//Existing & Returning User
			$row = $query->row_array(); 
			$data['ipID'] = $row['ID'];
			//$ipID = $row['ID'];
		}else{	//New User
			$this->load->view('setup');
			/*
			$toinsert = array(
			   'ip' => $ip
			);		
			$this->db->insert('ips', $toinsert);
			$insert_id = $this->db->insert_id();			
			$data['ipID'] = $insert_id;
			//$ipID = $insert_id;
			*/
		}
		
        $this->load->view('feed',$data);
    }
    
	public function add_ip(){
		$latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
		$ip = $this->get_client_ip();
		
		$query = $this->db->query("SELECT * FROM ips WHERE ip='".$ip."'");
		if($query->num_rows() > 0){	//IP exists...
			$row = $query->row_array();
			$query = $this->db->query("SELECT * FROM ips WHERE ip='".$ip."' AND latitude='".$latitude."' AND longitude='".$longitude."'");	//but did the location change?
			if($query->num_rows() == 0){	//It did, so update it with the new location coordinates
				$data = array(
				   'latitude' => $latitude ,
				   'longitude' => $longitude
				);
				$this->db->update('ips', $data, "ID = ".$row['ID']);
				echo "Updated Record";
			}
		}else{	//IP Doesn't Exist.
			$data = array(
			   'ip' =>  $ip,
			   'latitude' => $latitude ,
			   'longitude' => $longitude
			);
			$this->db->insert('ips', $data);
			echo "Inserted New IP Record";
		}
	}
	
    public function add_feed($message)
    {
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $data = array(
           'message' => urldecode($message) ,
           'latitude' => $latitude ,
           'longitude' => $longitude
        );
        $this->db->insert('feeds', $data); 
    }
	
	public function spread_feed($id)
	{
		//$ip = $this->get_client_ip();
		$ip = $this->get_client_ip();
		$query = $this->db->query("SELECT * FROM ips WHERE ip='".$ip."'");
		$row = $query->row_array(); 
		$data = array(
			'ipID' => $row['ID'],
			'feedID' => $id
		);
		$this->db->insert('likes', $data); 
		
		$query = $this->db->query("UPDATE feeds SET likes=likes+1 WHERE ID='".$id."'");
	}
	
	public function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}
?>