<!DOCTYPE html>
<html lang="en">

<?php
ini_set('display_errors', 1);

//make edit id variable with hidden input id
$edit_id = $_GET['edit_id'];

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, "SELECT * FROM plants WHERE (id = $edit_id); ");
$records = $result->fetchAll();
//$tags = exec_sql_query($db, 'SELECT * FROM tags WHERE (id = $edit_id); ');
//$tagrecords = $tags->fetchAll();
?>

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
<?php foreach($records as $record) { ?>
<form>
    <div class = "editform">
    <input type = "hidden" name="edit_id" value="<?php echo htmlspecialchars($record['id']); ?>">
    <label for="plant_name">Plant Name: </label>
    <input type="text" id="plant_name" name="name" value="<?php echo htmlspecialchars($record['plant_name']); ?>">
    <label for="species_name">Species Name: </label>
    <input type="text" id="species_name" name="species" value="<?php echo htmlspecialchars($record['species_name']); ?>">
    <label for="plant_id">Plant ID: </label>
    <input type="text" id="plant_id" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
    <label for="file_id">Photo ID: </label>
    <input type="text" id="file_id" name="file" value="<?php echo htmlspecialchars($record['file_name']); ?>">
    </div>
</form>
<?php }?>
<?php //foreach($tagrecords as $tag) { ?>
<form>
    <div class = "editform">
    <input type="text" id="file_id" name="file">
    </div>
</form>
<?php // }?>
</body>
