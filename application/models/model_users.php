<?php 

class Model_users extends CI_Model {
    
    public function log_in()
    {
        //Grabs the post data
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        
        //Query object - Get function gets from "users" table in my DB.
        $query = $this->db->get('users');  //get function pass from the users table
        
        if($query->num_rows() == 1){ //if valid credentials are entered then returns true
            return true;
        } else {
            return false;
        }
    }
    
    public function add_temp_users($key){
        
        //insert post data into the temp user db
        $data = array(
        
            'email' => $this->input->post('email'),
            'password'=> md5($this->input->post('password')),
            'key' => $key
            
        );
        
        $query = $this->db->insert('temp_users', $data); //receives 2 parameters table and arrays
        if ($query){
            return true;
        } else {
            return false;
        }
    }
    
    public function is_key_valid($key){ 
        
        $this->db->where('key', $key);
        $query = $this->db->get('temp_users');
        
        if ($query->num_rows() == 1){
            return true;
        } else return false;
    }
    
    public function adduser($key){
        
        $this->db->where('key', $key);
        $temp_user = $this->db->get('temp_users');  //this query is entire row in temp_users db
        
        //check if query is valid
        if ($temp_user){  //if temp_user has been selected then...
            $row = $temp_user->row();
            
            $data = array(
            
                'email' => $row->email,
                'password' => $row->password
            );
            
            //Check 
            $user_added = $this->db->insert('users', $data);  //inserting into user row and pass in the $data array
        } 
        
        if ($user_added){  //If the user was added then we'll delete it from the temp_users db.
            
            $this->db->where('key', $key);
            $this->db->delete('temp_users');
            return true;
            
        } return false;
        
    }
    
}

?>