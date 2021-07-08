<?php 
  require_once("conn.php");
  require_once("utils.php");
  session_start();
  $username = NULL;
  $user = NULL;

  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }
  $sql = sprintf("SELECT * FROM rich_blog_artcle WHERE is_deleted IS NULL order by created_At DESC limit 5");
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }
  $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Who's blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <link rel="stylesheet" href="content-styles.css" type="text/css">
  <link rel="stylesheet" type="text/css" href="style.css">
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
      <?php if (!empty($username)) { ?>
        <a href="manage.php" class="navbar__option">管理後台</a>
        <a href="logout.php" class="navbar__option">登出</a>
      <?php } else { ?>
        <a href="login.php" class="navbar__option">登入</a>
        <a href="register.php" class="navbar__option">註冊新會員</a>
      <?php } ?>
    </div>
  </nav>
  <div class="wrapper">
    <h2 class="wrapper__title">存放技術之地</h2>
    <div class="wrapper__desc">Welcome to my blog</div>
  </div>
  <main class="posts">
    <?php while($row = $result->fetch_assoc()) { 
      ?>
    <div class="post">
      <div class="post__container">
        <div>
          <h3 class="post__title"><?php echo escape($row['title']) ?></h3>
        </div>
        <div class="post__info">
          <span class="post__info--username"><?php echo '作者：@' . escape($row['username']) ?></span>
          <span><?php echo escape($row['created_at']) ?></span>
        </div>
        <div class="post__content ck-content"><?php echo $row['content'] ?></div>
        <a href="post.php?id=<?php echo escape($row['id']) ?>"><button class="readmore__btn">READ MORE</button></a>
      </div>
    </div>
    <?php } ?>
  </main>
  <footer class="footer">
      Copyright © 2020 Who's Blog All Rights Reserved.
  </footer>
</body>
</html>
