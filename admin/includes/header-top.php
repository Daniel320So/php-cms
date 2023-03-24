<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Portfolio Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>

<body>

  <div class="header-wrapper">
    <div class="header-left">
      <h1 >Portfolio Admin</h1>
    
    <?php if(isset($_SESSION['id'])): ?>
        <h2> Dashboard </h2>
      </div>
      <div class="header-right">
        <p><?php echo $_SESSION['email']; ?></p>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
    </div>
  </div>

    <hr>
    
    <div style="max-width: 1500px; margin: auto; padding: 0 1%;">
  
