<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel = "stylesheet"
        type = "text/css"
        href = "public/styles/theme.css"
        media = "all"/>

  <title>Playful Plants Project</title>
</head>

<body>
<h1>Playful Plants Project</h1>
<nav>
    <ul>
      <li><a href="/">About</a></li>
      <li><a href="/plants">Admin Plants</a></li>
      <li><a href="/consumer-plants">Consumer Plants</a></li>
      <li><a href="/log-in">Log in</a></li>
    </ul>
</nav>
<?php if (!is_user_logged_in()) {?>
<h2>Admin log in</h2>
<?php echo password_login($db, $messages, $username, $password)?>
<form>
<div class="field">
<label for="username">Username:</label>
<input type="text" id="username" name="username">
</div>
<div class="field">
<label for="password">Password:</label>
<input type="text" id="password" name="password">
</div>
<div class = "submit">
<input id="login" type="submit" name="login" value="Log in" />
</div>
</form>
<?php }?>
</body>

</html>
