<!DOCTYPE html>
<html lang="en">

<?php
ini_set('display_errors', 1);

//make edit id variable with hidden input id
$edit_id = $_GET['edit_id'];

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, "SELECT * FROM plants WHERE (id = $edit_id); ");$records = $result->fetchAll();
$relationships = exec_sql_query($db, "SELECT tag_id FROM relationships WHERE (plant_id = $edit_id); ");
$relationshiprecords = $relationships->fetchAll();

//if ($record) {
//    $plant = $record['update_id'];
//}

//update values
if (isset($_GET["update-submit"])) {
    $plant_name = $_GET['name'];
    $species_name = $_GET['species'];
    $plant_id = $_GET['id'];
    $file_id = $_GET['file'];


$sql_query = "UPDATE plants SET
    plant_name = $plant_name,
    species_name = $species_name,
    id = $plant_id,
    file_name = $file_id
    WHERE (id = $edit_id); ";

$result = exec_sql_query($db, "UPDATE plants SET
plant_name = $plant_name,
species_name = $species_name,
id = $plant_id,
file_name = $file_id
WHERE (id = $edit_id); ");
}
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
<?php echo $sql_query ?>
<nav>
    <ul>
      <li><a href="/">About</a></li>
      <li><a href="/plants">Admin Plants</a></li>
      <li><a href="/consumer-plants">Consumer Plants</a></li>
      <li><a href="/log-in">Log in</a></li>
    </ul>
</nav>
<?php foreach($records as $record) { ?>
<form name="update" action="/edit">
    <div class = "editform">
    <input type = "hidden" name="edit_id" value="<?php echo htmlspecialchars($edit_id); ?>">
    <label for="plant_name">Plant Name: </label>
    <input type="text" id="plant_name" name="name" value="<?php echo htmlspecialchars($record['plant_name']); ?>">
    <label for="species_name">Species Name: </label>
    <input type="text" id="species_name" name="species" value="<?php echo htmlspecialchars($record['species_name']); ?>">
    <label for="plant_id">Plant ID: </label>
    <input type="text" id="plant_id" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
    <label for="file_id">Photo ID: </label>
    <input type="text" id="file_id" name="file" value="<?php echo htmlspecialchars($record['file_name']); ?>">
    </div>
<?php }?>
<p>Types of play the plant supports:</p>
<input type="checkbox" id="con" name="con" value="con">
<label for="con">Exploratory Constructive</label>
<input type="checkbox" id="sens" name="sens" value="sens">
<label for="sens">Exploratory Sensory</label>
<input type="checkbox" id="ph" name="ph" value="ph">
<label for="ph">Physical</label>
<input type="checkbox" id="im" name="im" value="im">
<label for="im">Imaginative</label>
<input type="checkbox" id="res" name="res" value="res">
<label for="res">Restorative</label>
<input type="checkbox" id="expr" name="expr" value="expr">
<label for="expr">Expressive</label>
<input type="checkbox" id="rules" name="rules" value="rules">
<label for="rules">With Rules</label>
<input type="checkbox" id="bio" name="bio" value="bio">
<label for="bio">Bio</label>
<p>Growing needs and characteristics:</p>
<input type="checkbox" id="perennial" name="perennial" value="perennial">
<label for="per">Perennial</label>
<input type="checkbox" id="annual" name="annual" value="annual">
<label for="annual">Annual</label>
<input type="checkbox" id="fulls" name="fulls" value="fulls">
<label for="fulls">Full Sun</label>
<input type="checkbox" id="partials" name="partials" value="partials">
<label for="partials">Partial Shade</label>
<input type="checkbox" id="fullsh" name="fullsh" value="fullsh">
<label for="fullsh">Full Shade</label>
<p><em>General classification:</em></p>
<input type="checkbox" id="shr" name="shr" value="shr">
<label for="shr">Shrub</label>
<input type="checkbox" id="gra" name="gra" value="gra">
<label for="gra">Grass</label>
<input type="checkbox" id="vin" name="vin" value="vin">
<label for="vin">Vine</label>
<input type="checkbox" id="tre" name="tre" value="tre">
<label for="tre">Tree</label>
<input type="checkbox" id="flo" name="flo" value="flo">
<label for="flo">Flower</label>
<input type="checkbox" id="gro" name="gro" value="gro">
<label for="gro">Groundcovers</label>
<input type="checkbox" id="oth" name="oth" value="oth">
<label for="oth">Other</label>
<div class="formsubmit">
    <input type="submit" value="Update" name="update-submit">
</div>
</form>
</body>
