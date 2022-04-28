<body>
<?php include('includes/header.php'); ?>
<?php if (!is_user_logged_in()) {?>
<h2>Admin log in</h2>
<?php
      echo_login_form('/plants', $session_messages);
      ?>
<?php }?>
</body>

</html>
