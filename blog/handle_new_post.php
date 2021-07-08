<?php
  require_once('conn.php');
  require_once('utils.php');
  session_start();

  $editor_data = $_POST[ 'content' ];
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  } else {
    header("Location:login.php");
    exit();
  }
  if (empty($_POST['content']) || empty($_POST['title'])) {
    die('資料有缺，請再試一次');
  }

  $sql = sprintf("INSERT INTO rich_blog_artcle(title, username, content) values(?,?,?)");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $_POST['title'], $username, $_POST['content']);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header('Location:manage.php');
?>
