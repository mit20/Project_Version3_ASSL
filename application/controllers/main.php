<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller{
    
    public function index()
    {
        $this->load->view('home_view'); 
    }
    
    // Displays Photo Gallery 
	public function gallery() {
	
	$this->load->view('photo_gallery');
	}
    
    public function login_validation(){
		//this function does the validation and loads form validation library
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_credentials'); //the callback looks for the validate_credentials function in the Main controller
        $this->form_validation->set_rules('password', 'Password', 'required|md5|trim'); //takes password and encrypts to md5 value
        
        if ($this->form_validation->run()){  //Run function will return true if set_rules have been verified
            $data = array( //This array is passed into 
                'email' => $this->input->post('email'), //session variable - Grabs email that user enters and stores in session data.
                'logged_in' => 1  //checks to see if user is logged in
            );
            
            $this->session->set_userdata($data); //set_userdata adds data to session array - receives $data array
            redirect('main/gallery');
        }else {
            $this->load->view('login');  //If set_rules aren't verified then will take user to login page
        }
    }
    
    public function reg_validation(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');//sets rules pass in parameters - valid_email is codeigniter rule that checks email is valid. is_unique is a codeigniter rule that receives the DB parameter table name and field and checks to see if the email is unique.
        
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]'); //matches is a rule in CI that makes sure the password matches the confirmation password
        
        //generate random key and send email to the user and add them to the temp DB
        if ($this->form_validation->run()){
             
            $key = md5(uniqid()); //this create a random key that is encrypted with md5
            
            $this->load->library('email', array('mailtype'=>'html'));
            $this->load->model('model_users'); //loads the model
            
            $this->email->from('marlonitorres@gmail.com', "Marlon"); 
            
            $this->email->to($this->input->post('email')); //Email that is entered in form is sent to the user
            
            $this->email->subject("Please verify your account.");
            
            $message = "<p>Thanks for subscribing!</p>";
            $message .= "<p><a href='".base_url()."main/confirmed_user/$key' >Click here to verify your account</a></p>";
            
            $this->email->message($message);
            
            if ($this->model_users->add_temp_users($key)){
                if ($this->email->send()){
                        echo "The email has been sent.";
                }   else echo "Email could not be sent.";       
            } else echo "Unable to add user to the Database.";
        
        } else {
             $this->load->view('registration_view'); //if it doesn't pass then the registration view will load.
        }
    }
    
    public function validate_credentials(){
    
        $this->load->model('model_users'); //Load model
        
        if($this->model_users->log_in()){ //log_in is a method in the model_users model that evaluates if you can login with current credentials. If returns true the validate_credentials function will also return true and the form validation library will check for errors as well.
            return true;
        } else {  //if the validate_credentials returns false it will return an error message
            $this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
            return false;
        }
    }
    
    public function reg_user($key){  //this function checks to see if the key is valid
        $this->load->model('model_users'); //loads model_users model
        
        if ($this->model_users->is_key_valid($key)){ //if valid then add the user to users table 
            if ($this->model_users->adduser($key)){
                echo "User has been successfully added.";
            } echo "User has not been added to the database. Try again!";
            
        } else echo "Invalid Key";
    }
    
    public function data_submitted(){
        
        $data = array(
        
            'comment_box' => $this->input->post('comment')
        
        );
        
        $this->load->view('comments_view', $data);
    }
    
}