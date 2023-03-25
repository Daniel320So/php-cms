<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );
include ( 'includes/card.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM projects
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Project has been deleted' );
  
  header( 'Location: projects.php' );
  die();
  
}

include( 'includes/header-left.php' );

$query = 'SELECT *
  FROM projects
  WHERE user_id ='.$_SESSION['id'].'
  ORDER BY date DESC';
$result = mysqli_query( $connect, $query );

$projects = array();

// gets a list of projects, and sorts them into an array based on who the projects belongs to

while($project = mysqli_fetch_assoc($result))
{
  if(!isset($projects[$project['user_id']]))
  {
    $projects[$project['user_id']] = array();
  }
  
  array_push($projects[$project['user_id']],$project);
}

?>

<h2>Manage Projects</h2>

<?php 

  // Organizes projects based on which user they belong to

  $query = 'SELECT first,last,id FROM users WHERE id = "'.$_SESSION['id'].'" ORDER BY first, last, id;';
  $users = mysqli_query($connect, $query);
  while($user = mysqli_fetch_assoc($users))
  {

    ?>
    <h2><?=$user['first'].' '.$user['last']?></h2>
    <p><a href="projects_add.php?user_id=<?=$user['id']?>"><i class="fas fa-plus-square"></i> Add Project for <?=$user['first'].' '.$user['last']?></a></p>
    <?
    if(!isset($projects[$user['id']])) continue;
    ?>

    <div class="card-container ">

    <?php foreach( $projects[$user['id']] as $record ) {
        content_card (

          $record['id'], // item ID

          "projects", // Record type

          $record['title'], // Title

          $record['type'].'<br>'.$record['url'], // Type & url

          $record['photo'], // Thumbnail Link

          $record['content'], // body content (limi 200 characters)

          "projects_edit.php?id=".$record['id'], // "Edit" button link location

          "projects.php?cmd=delete&delete=".$record['id'], // "Delete" button link location

          "projects_photo.php?id=".$record['id'], // "Photo" button link location
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