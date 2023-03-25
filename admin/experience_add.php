<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['title'] ) )
{
  
  if( $_POST['title'] and $_POST['content'] )
  {
    
    $query = 'INSERT INTO experience (
        user_id,
        company,
        title,
        content,
        start_date,
        end_date
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_SESSION['id'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['company'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Experience has been added' );
    
  }
  
  header( 'Location: experience.php' );
  die();
  
}

include( 'includes/header-left.php' );

?>

<h2>Add Experience</h2>

<form method="post">

  <label for="user">User:</label>
  <?php
      $q = 'SELECT first, last FROM users WHERE id = '.$_SESSION['id'].' LIMIT 1';
      $res = mysqli_query($connect, $q);
      $user = mysqli_fetch_assoc($res);
  ?>
  <input id="user" name="user_id" value="<?=$user['first'].' '.$user['last'];?>" disabled>
  <br>

  <label for="company">Company:</label>
  <input type="text" name="company" id="company" required>
    
  <br>

  <label for="title">Title:</label>
  <input type="text" name="title" id="title" required>
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>
      
  <script>

  ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date" required>
  
  <br>

  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date" required>
  
  <br>
  
  <input type="submit" value="Add Experience">
  
</form>

<p><a href="experience.php"><i class="fas fa-arrow-circle-left"></i> Return to Experience List</a></p>


<?php

include( 'includes/footer.php' );

?>