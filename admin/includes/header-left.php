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
    <p><?php echo $_SESSION['email']; ?></p>
    <div class="sidebar-menu">
      <a href="../dahsboard.php" class="sidebar-item">Dashboard</a>
      <a href="#" class="sidebar-item">Education</a>
      <a href="#" class="sidebar-item">Experience</a>
      <a href="#" class="sidebar-item">Projects</a>
      <a href="#" class="sidebar-item">Skills</a>
      <a href="#" class="sidebar-item">Users</a>
    </div>
    <a href="logout.php">Logout</a>
  </div>

  <div class="main-wrapper">
    
    <div style="max-width: 1500px; margin: auto; padding: 0 1%;">
  
