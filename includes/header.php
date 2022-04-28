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


<h1>Playful Plants Project</h1>
<nav>
    <ul>
      <li><a href="/">About</a></li>
      <?php if (is_user_logged_in()) {?>
      <li><a href="/plants">Plants</a></li>
      <?php }?>
      <?php if (!is_user_logged_in()) {?>
      <li><a href="/consumer-plants">Plants</a></li>
      <?php }?>
      <?php if (!is_user_logged_in()) {?>
        <li><a href="/log-in">Log in</a></li>
      <?php }?>
      <?php if (is_user_logged_in()) {?>
        <li><a href="<?php echo logout_url(); ?>">Log Out</a></li>
      <?php }?>
    </ul>
</nav>
