<?php
    $this->load->view('includes/header_view');
    $this->load->view('includes/login_navigation_view');
?>
  
  <!-------------------------------------------- Comments Section --------------------------------------------->
<section>
    
    <?php 

        echo form_open('main/data_submitted');

        echo validation_errors();

        echo form_label('Comment');
        echo "<div>";

        //Textarea
        $data_text = array(
            'name' => 'comment',
            'rows' => 10,
            'cols' => 80
        );

        echo form_textarea($data_text);
        echo "</div>";

        echo "<br>";  

        echo "<p>";
        echo form_submit('text_submit', 'Add Comment');
        echo "</p>";
    
     echo "<div>";
        if (isset($comment_box)) {
        echo "<label>Your Comment: </label><pre>" . $comment_box . "</pre>"; 
        }
    echo "</div>";

    echo form_close('');  
    
     echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
    ?>    
       
</section>





<?php 
    $this->load->view('includes/footer_view');    
?>