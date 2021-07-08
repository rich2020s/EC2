<?php
  require_once('conn.php');
  require_once('utils.php');
  session_start();
  $username = NULL;
  $user = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  } else {
    header('Location:login.php');
    exit();
  }
  if (empty($_GET['id'])) {
    die("資料有缺，請再試一次");
  }
  $id = $_GET['id'];
  $sql = sprintf("UPDATE rich_blog_artcle set is_deleted = 1 WHERE id =? and username = ?");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $id, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  header('Location:manage.php');
?>
