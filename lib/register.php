
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
  echo "<pre>";
  var_dump($name);
  echo "</pre>";
  # $query = "CREATE * FROM users WHERE name='$name' AND password='$password';";
  $query = "INSERT INTO `inject_demodb`.`users` (`name`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password', 'consumer');";

  require_once('connectdb.php');
  $db = connectdb();
  $result = mysqli_multi_query($db, $query);
  if ($result) {
    $result = mysqli_use_result($db);
  }
  if ($result) {
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (isset($user['id'])) {
      $_SESSION['user_id'] = $user['id'];
    }
  }
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_error'] = true;
  }
  mysqli_close($db);


  header('Location: ../index.php');
  ?>