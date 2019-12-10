
  <?php
  session_start();
  require_once('helpers.php');
  
  if (logged_in()) {
    header('Location: ../index.php');
    exit;    
  }
  
  $name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  # $query = "CREATE * FROM users WHERE name='$name' AND password='$password';";
  $query = "INSERT INTO `inject_demodb`.`users` (`name`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password', 'consumer');";

  require_once('connectdb.php');
  $db = connectdb();
  $result = mysqli_multi_query($db, $query);
  if ($result) {
    $result = mysqli_use_result($db);
  }
  if (!isset($_SESSION['reg_success'])) {
    $_SESSION['reg_success'] = true;
  }
  mysqli_close($db);


  header('Location: ../index.php');
  ?>