<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['skill_id'] ) )
{
  
  // checks for minimum content
  if( $_POST['skill_id'] and $_SESSION['id'] )
  {
    
    $query = 'INSERT INTO user_skills (
        user_id,
        skill_id,
        percent,
        description
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_SESSION['id'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['skill_id'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['percent'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Skill has been assigned' );
    
  }
  
  header( 'Location: skills.php' );
  die();
  
}

include( 'includes/header-left.php' );

?>

<h2>Add Skill</h2>

<form method="post">
  
<label for="user">User:</label>
  <?php
      $q = 'SELECT first, last FROM users WHERE id = '.$_SESSION['id'].' LIMIT 1';
      $res = mysqli_query($connect, $q);
      $user = mysqli_fetch_assoc($res);
  ?>
  <input id="user" name="user_id" value="<?=$user['first'].' '.$user['last'];?>" disabled>
  <br>

  <label for="skill_id">Skill:</label>
  <select id="skill_id" name="skill_id">
    <option selected disabled>Select a skill...</option>
    <?php
      $q = "SELECT name,id FROM skills";
      $res = mysqli_query($connect, $q);
      while($skill = mysqli_fetch_assoc($res))
      {
      ?>
      <option value="<?=$skill['id']?>"><?=$skill['name']?></option>
      <?php
      }
    ?>
  </select>
  <br>

  <label for="description">Description:</label>
  <input type="text" name="description" id="description">
    
  <br>

  <label for="percent">Percent:</label>
  <input type="number" name="percent" id="percent">
    
  <br>

  
  <input type="submit" value="Assign Skill">
  
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skill List</a></p>


<?php

include( 'includes/footer.php' );

?>