<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Website Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>

<body class="body-flex">

  <div class="sidebar">
    <div class="sidebar-left">
      <div class="sidebar-email">
        <p><?php echo $_SESSION['email']; ?></p>
      </div>
      <div class="sidebar-menu">
        <a href="./dashboard.php" class="sidebar-item">Dashboard</a>
        <a href="./educations.php" class="sidebar-item">Education</a>
        <a href="./experience.php" class="sidebar-item">Experience</a>
        <a href="./projects.php" class="sidebar-item">Projects</a>
        <a href="./skills.php" class="sidebar-item">Skills</a>
        <a href="./users.php" class="sidebar-item">Users</a>
      </div>
    </div>
    <div class="sidebar-right">
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="main-wrapper">
    <?php echo get_message(); ?>
    
    <div style="max-width: 1500px; margin: auto; padding: 0 1%;">
  
