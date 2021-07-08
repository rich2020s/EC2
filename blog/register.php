<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="login">
  <main class="login__card">
    <h1 class="login__card--title">Register</h1>
    <form class="login__form" action="handle_register.php" method="POST">
      <div class="login__card--desc">USERNAME</div>
      <input type="text" name="username" class="login__card--input">
      <div class="login__card--desc">PASSWORD</div>
      <input type="password" name="password" class="login__card--input password">
      <div class="login__card--desc">PASSWORD AGAIN</div>
      <input type="password" name="password" class="login__card--input password">
      <input type="submit" value="SIGN UP" class="submit__btn">
    </form>
  </main>
  <script type="text/javascript">
    const password = document.querySelectorAll('.password')
    const submitForm = document.querySelector('.submit__btn')
    submitForm.addEventListener('click', (e) => {
      if (password[0].value !== password[1].value) {
        e.preventDefault();
        alert('密碼不相同，請重新輸入')
      }
    })
  </script>
</body>
</html>
