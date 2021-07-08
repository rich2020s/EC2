<?php 
  require_once("conn.php");
  session_start();

  if (empty($_POST['username']) || empty($_POST['password'])) {
    die('資料有缺，請再試一次'. '<br>' . "<a href='login.php' style='color:black'>回上一頁</a>");
  }
  $username = $_POST['username'];
  $sql = sprintf("SELECT * FROM rich_blog_user WHERE username =?");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();
  if(!$result){
    die($conn->error);
  }
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    echo "帳號密碼錯誤，請再試一次";
    exit();
  }
  $row = $result->fetch_assoc();
  if (password_verify($_POST['password'], $row['password'])) {
    session_regenerate_id();
    $_SESSION['username'] = $row['username'];
    header('Location:index.php');
  } else {
    echo "帳號密碼錯誤，請再試一次";
  }
?>
