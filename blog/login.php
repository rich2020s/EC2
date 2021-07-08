<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="login">
  <main class="login__card">
    <h1 class="login__card--title">Log in</h1>
    <form class="login__form" action="handle_login.php" method="POST">
      <div class="login__card--desc">USERNAME</div>
      <input type="text" name="username" class="login__card--input">
      <div class="login__card--desc">PASSWORD</div>
      <input type="password" name="password" class="login__card--input">
      <input type="submit" value="SIGN IN" class="submit__btn">
    </form>
  </main>
</body>
</html>
