<?php 
  require_once("conn.php");
  session_start();

  if (empty($_POST['username']) || empty($_POST['password'])) {
    die('資料有缺，請再試一次'. '<br>' . "<a href='login.php' style='color:black'>回上一頁</a>");
  }
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $sql = sprintf("INSERT INTO rich_blog_user(username, password) values(?, ?)");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);
   $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  if ($result) {
    echo "註冊成功！" . "<br>" . "<a href='login.php'>請登入</a>";
  }
?>
