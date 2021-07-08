<?php 
  require_once("conn.php");
  require_once("utils.php");
  session_start();
  $username = NULL;
  $user = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  } else {
    header("Location:login.php");
    exit();
  }
  if (empty($_GET['id'])) {
    die("缺乏資料，請重新嘗試");
  }
  $id = $_GET['id'];
  $sql = sprintf("SELECT * FROM rich_blog_artcle WHERE id = ? and username =? and is_deleted IS NULL");
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (empty($row)) {
    die('查無資料');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Who's blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
</head>
<body>
  <nav class="navbar">
    <div>
      <a href="index.php"><h1 class="navbar__blogname">Who's Blog</h1></a>
      <a href="post_list.php" class="navbar__option">文章列表</a>
      <a href="#" class="navbar__option">分類專區</a>
      <a href="#" class="navbar__option">關於我</a>
    </div>
    <div>
      <a href="manage.php" class="navbar__option">管理後台</a>
      <a href="logout.php" class="navbar__option">登出</a>
    </div>
  </nav>
  <div class="wrapper">
    <h2 class="wrapper__title">存放技術之地</h2>
    <div class="wrapper__desc">Welcome to my blog</div>
  </div>
  <main class="posts newpost">
    <div class="post newpost__container">
      <h1>發表文章：</h1>
      <form action="handle_update_post.php" method="POST">
        <input type="text" name="title" class="newpost__title" placeholder="請輸入文章標題" value="<?php echo escape($row['title'])?>">
        <textarea id="editor" placeholder="請輸入文章內容" name="content"></textarea>
        <input type="text"  name="id" value="<?php echo escape($row['id']) ?>" class="hiden">
        <input type="submit" value="送出文章" class="newpost__btn">
      </form>
    </div>
  </main>
  <footer class="footer">
      Copyright © 2020 Who's Blog All Rights Reserved.
  </footer>
  <script>
    ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .then( editor => {
        editor.setData('<?php echo $row['content'] ?>')
      } )
      .catch( error => {
          console.error( error );
      } );
  </script>
</body>
</html>
