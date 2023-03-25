<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  header( 'Location: educations.php' );
  die();
  
}

if( isset( $_POST['school_name'] ) )
{

  if( $_POST['school_name'] )
  {
    $query = 'UPDATE educations SET
      school_name = "'.mysqli_real_escape_string( $connect, $_POST['school_name'] ).'",
      location = "'.mysqli_real_escape_string( $connect, $_POST['location'] ).'",
      level_of_education = "'.mysqli_real_escape_string( $connect, $_POST['level_of_education'] ).'",
      field = "'.mysqli_real_escape_string( $connect, $_POST['field'] ).'",
      start_date = "'.mysqli_real_escape_string( $connect, $_POST['start_date'] ).'",
      end_date = "'.mysqli_real_escape_string( $connect, $_POST['end_date'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been updated' );
    
  }

  header( 'Location: educations.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM educations
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: educations.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header-left.php' );

?>

<h2>Edit Education</h2>

<form method="post">

  <label for="user">User:</label>

<?php
      $q = 'SELECT first, last FROM users WHERE id = '.$_SESSION['id'].' LIMIT 1';
      $res = mysqli_query($connect, $q);
      $user = mysqli_fetch_assoc($res);
  ?>
  <input id="user" name="user_id" value="<?=$user['first'].' '.$user['last'];?>" disabled>
    
    
  <br>

  <label for="school_name">School Name:</label>
  <input type="text" name="school_name" id="school_name" value="<?php echo htmlentities( $record['school_name'] ); ?>">
    
  <br>

  <label for="location">Location:</label>
  <input type="text" name="location" id="location" value="<?php echo htmlentities( $record['location'] ); ?>">
  
  <br>

  <label for="level_of_education">Level of Education:</label>
  <input type="text" name="level_of_education" id="level_of_education" value="<?php echo htmlentities( $record['level_of_education'] ); ?>">

  <br>

  <label for="field">Field:</label>
  <input type="text" name="field" id="field" value="<?php echo htmlentities( $record['field'] ); ?>">
    
  <br>
  
  <label for="start_date">Start Date:</label>
  <input type="date" name="start_date" id="start_date" value="<?php echo htmlentities( $record['start_date'] ); ?>">
    
  <br>

  <label for="end_date">End Date:</label>
  <input type="date" name="end_date" id="end_date" value="<?php echo htmlentities( $record['end_date'] ); ?>">
  
  <br>

  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="5"><?php echo htmlentities( $record['content'] ); ?></textarea>
  
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

  <input type="submit" value="Edit Education">
  
</form>



<p><a href="educations.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>