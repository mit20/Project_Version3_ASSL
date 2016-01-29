<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends CI_Controller{
    
    public function index()
    {
        $this->load->view('login'); 
    }
    
    public function registration()
    {
        $this->load->view('registration_view'); 
    }
    
    public function comments()
    {
        $this->load->view('comments_view'); 
    }
    
    public function logout(){
         $this->session->sess_destroy(); //this clears the current session and logs out
          $this->load->view('logout_view');
     }
}
?>