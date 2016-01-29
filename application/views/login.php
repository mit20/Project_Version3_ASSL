<?php
    
    $this->load->view('includes/header_view');
    
    $this->load->view('includes/login_navigation_view');

?>


<!-- Login Form -->
<section>


<?php 
    
echo form_open('main/login_validation');
    
echo validation_errors();
echo "<h2>Login";
echo "</h2>";

echo "<p>Email: ";
echo form_input('email', $this->input->post('email')); //second parameter is email that user types in, this will retain so user does not have to retype in the event there is an error and has to re-enter correct passwords.
echo "</p>";
    
echo "<p>Password: ";
echo form_password('password');
echo "</p>";  
    
echo "<p>";
echo form_submit('login_submit', 'Login');
    echo '<img src="/img/signin_button.png"/>';
echo "</p>";
    
echo form_close('');

?>
    <div id="create"><a href='<?php echo base_url()."logincontroller/registration"?>'>Create Account</a></div>
    
</section>

 

<?php

    $this->load->view('includes/footer_view');
   
?>