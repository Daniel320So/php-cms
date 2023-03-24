<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );
include( 'includes/card.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM educations
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Education has been deleted' );
  
  header( 'Location: educations.php' );
  die();
  
}

include( 'includes/header-left.php' );

$query = 'SELECT *
  FROM educations WHERE user_id = '.$_SESSION['id'].' ORDER BY id';
$result = mysqli_query( $connect, $query );

$educations = array();

// gets a list of educations, and sorts them into an array based on who the educations belongs to

while($education = mysqli_fetch_assoc($result))
{
  if(!isset($educations[$education['user_id']]))
  {
    $educations[$education['user_id']] = array();
  }
  
  array_push($educations[$education['user_id']],$education);
}

?>

<h2>Manage Educations</h2>

<?php 

  // Organizes educations based on which user they belong to

  $query = 'SELECT first,last,id FROM users WHERE id = "'.$_SESSION['id'].'" ORDER BY first, last, id;';
  $users = mysqli_query($connect, $query);
  while($user = mysqli_fetch_assoc($users))
  {

    ?>
    <h2><?=$user['first'].' '.$user['last']?></h2>
    <p><a href="educations_add.php?user_id=<?=$user['id']?>"><i class="fas fa-plus-square"></i> Add Education for <?=$user['first'].' '.$user['last']?></a></p>
    <?
    if(!isset($educations[$user['id']])) continue;
    ?>

    <div class="card-container ">

    <?php foreach( $educations[$user['id']] as $record ) {
        content_card (

          $record['id'], // item ID

          "educations", // Record type

          $record['school_name'], // School Name

          $record['level_of_education'].' in '.$record['field'].'<br>'.$record['start_date'].'-'.$record['end_date'], // Type & url

          null, // Thumbnail Link

          $record['content'], // body content (limi 200 characters)

          "educations_edit.php?id=".$record['id'], // "Edit" button link location

          "educations.php?cmd=delete&delete=".$record['id'], // "Delete" button link location
        );

    } 
    ?>
    </div>

    <?php
  }

?>

<?php

include( 'includes/footer.php' );

?>