<?php
    
    $this->load->view('includes/header_view');
    
    $this->load->view('includes/login_navigation_view');
?>


<!-- Login Form -->
<section class="loginform">


<?php 
    
echo form_open('main/reg_validation'); //function that will validate the registration
    
echo validation_errors(); 
echo "<h2>Create An Account";
echo "</h2>";
    
echo "<p>Email: ";
echo form_input('email', $this->input->post('email'));
echo "</p>";
    
echo "<p>Password: ";
echo form_password('password');
echo "</p>";
    
echo "<p>Confirm Password: ";
echo form_password('cpassword');
echo "</p>";
    
echo "<p>";
echo form_submit('registration_submit','Create Account');
echo "</p>";
    

echo form_close('');
    
?>
    
</section>

<?php
    $this->load->view('includes/footer_view');
   
?>