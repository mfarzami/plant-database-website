<!DOCTYPE html>
<html lang="en">

<?php
ini_set('display_errors', 1);

$detail_id = $_GET['detail_id'];

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, "SELECT * FROM plants WHERE (id = $detail_id); ");
$records = $result->fetchAll();
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
      <li><a href="/detail">Detail</a></li>
      <li><a href="/log-in">Log in</a></li>
    </ul>
</nav>
<?php foreach($records as $record) { ?>
<form>
  <input type = "hidden" name="detail_id" value="<?php echo htmlspecialchars($record['id']); ?>">
</form>
<?php } ?>

<div class = "detail">
<h2><?php echo htmlspecialchars($record['plant_name']); ?></h2>
<p><?php echo htmlspecialchars($record['species_name']); ?></p>
<div class = "detailimg">
<!-- Source: Playful Plants Project (from INFO2300 photo folder) -->
<?php $showfile = "public/images/".htmlspecialchars($record['file_name']).".jpg" ?>
<img src=<?php echo $showfile?>  alt=<?php echo htmlspecialchars($record['plant_name']); ?>>
</div>
Source: <cite>Playful Plants Project</cite>
</div>
<form action="/plants">
<input type="submit" value="Back to plants">
</form>
</body>

</html>
