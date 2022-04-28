<!DOCTYPE html>
<html lang="en">

<?php

//ini_set('display_errors', 1);

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, 'SELECT * FROM plants; ');
$tags = exec_sql_query($db, 'SELECT * FROM tags; ');
$relationships = exec_sql_query($db, 'SELECT * FROM relationships; ');
$records = $result->fetchAll();
$tagrecords = $tags->fetchAll();
$relationshiprecords = $relationships->fetchAll();

//default feedback classes as hidden
$name_feedback = 'hidden';
$pname_feedback = 'hidden';
$sname_feedback = 'hidden';

//default insertion for add plant as false
$plant_added = false;

//making variables for add form inputs
$name = NULL;
$pname = NULL;
$sname = NULL;
$ec = NULL;
$es = NULL;
$phys = NULL;
$imag = NULL;
$rest = NULL;
$exp = NULL;
$wr = NULL;
$bp = NULL;
$edible = NULL;
$scent = NULL;
$tactile = NULL;
$visual = NULL;

//initializing form_valid as false
$form_valid = false;
$deleted = false;

//if add form is submitted take inputs into variables
if (isset($_POST['submit'])) {
  $form_valid = true;

  $name = $_POST['name'];
  $pname = $_POST['pname'];
  $sname = $_POST['sname'];
  $pid = $_POST['pid'];
  $ec = empty($_POST['1'])? 0:1;
  $es = empty($_POST['2'])? 0:1;
  $phys = empty($_POST['3'])? 0:1;
  $imag = empty($_POST['4'])? 0:1;
  $rest = empty($_POST['5'])? 0:1;
  $exp = empty($_POST['6'])? 0:1;
  $wr = empty($_POST['7'])? 0:1;
  $bp = empty($_POST['8'])? 0:1;
  $per = empty($_POST['9'])? 0:1;
  $ann = empty($_POST['10'])? 0:1;
  $fullsun = empty($_POST['11'])? 0:1;
  $partial = empty($_POST['12'])? 0:1;
  $fullshade = empty($_POST['13'])? 0:1;
  $shrub = empty($_POST['14'])? 0:1;
  $grass = empty($_POST['15'])? 0:1;
  $vine = empty($_POST['16'])? 0:1;
  $tree = empty($_POST['17'])? 0:1;
  $flower = empty($_POST['18'])? 0:1;
  $groundcovers = empty($_POST['19'])? 0:1;
  $other = empty($_POST['20'])? 0:1;


  //if inputs not added, form doesn't go through and feedback shows
  if (empty($name)) {
    $form_valid = false;
    $name_feedback = '';
  }

  if (empty($pname)) {
    $form_valid = false;
    $pname_feedback = '';
  }

  if (empty($sname)) {
    $form_valid = false;
    $sname_feedback = '';
  }
}

if ($form_valid) {
  //add inputs to database if form went through
  $result = exec_sql_query($db, "INSERT INTO plants (plant_name, species_name, file_name) VALUES ('$pname', '$sname', 'test')");

  if ($ec == 1) {
  $result = exec_sql_query($db, "INSERT INTO relationships (tag_id, plant_id) VALUES (1, $pid)");}

  //plant has been added
  if ($result) {
  $plant_added = true;
  }

//if form didn't go through assign sticky values
} else {
  $sticky_name = $name;
  $sticky_pname = $pname;
  $sticky_sname = $sname;
  $sticky_pid = $pid;
  $sticky_ec = (empty($ec)? NULL:"checked");
  $sticky_es = (empty($es)? NULL:"checked");
  $sticky_phys = (empty($phys)? NULL:"checked");
  $sticky_imag = (empty($imag)? NULL:"checked");
  $sticky_rest = (empty($rest)? NULL:"checked");
  $sticky_exp = (empty($exp)? NULL:"checked");
  $sticky_wr = (empty($wr)? NULL:"checked");
  $sticky_bp = (empty($bp)? NULL:"checked");
  $sticky_per = (empty($per)? NULL:"checked");
  $sticky_ann = (empty($ann)? NULL:"checked");
  $sticky_fullsun = (empty($fullsun)? NULL:"checked");
  $sticky_partial = (empty($partial)? NULL:"checked");
  $sticky_fullshade = (empty($fullshade)? NULL:"checked");
  $sticky_shrub = (empty($shrub)? NULL:"checked");
  $sticky_grass = (empty($grass)? NULL:"checked");
  $sticky_vine = (empty($vine)? NULL:"checked");
  $sticky_tree = (empty($tree)? NULL:"checked");
  $sticky_flower = (empty($flower)? NULL:"checked");
  $sticky_groundcovers = (empty($groundcovers)? NULL:"checked");
  $sticky_other = (empty($other)? NULL:"checked");
}

  //if delete button pressed, delete entry from plants
  if (isset($_GET['delete'])) {
    $deleted = true;

    $delete_id = $_GET['delete_id'];
    $result = exec_sql_query($db, "DELETE FROM plants WHERE id = '$delete_id'; ");
    $result = exec_sql_query($db, "DELETE FROM relationships WHERE plant_id = '$delete_id'; ");
  }

  //if edit button pressed, save id in variable
  if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit_id'];
  }

$result = exec_sql_query($db, 'SELECT * FROM plants; ');
$tags = exec_sql_query($db, 'SELECT * FROM tags; ');
$relationships = exec_sql_query($db, 'SELECT * FROM relationships; ');
$records = $result->fetchAll();
$tagrecords = $tags->fetchAll();
$relationshiprecords = $relationships->fetchAll();
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
<h2>Plant database</h2>

<?php if ($deleted == true) { ?>
<p>The plant with id <?php echo htmlspecialchars($delete_id) ?> has been deleted!</p>
<?php } ?>
<?php if ($plant_added == true) {?>
<p>Thank you <?php echo htmlspecialchars($name)?> for your plant submission!</p>
<?php }?>
<ul>
<?php foreach($records as $record) { ?>
  <li>
    <div class="plant">
    <div class="name">
    <h2><?php echo htmlspecialchars($record['plant_name']);?></h2>
    <h3><?php echo htmlspecialchars($record['species_name']);?></h3>
    <p>Plant ID:<?php echo htmlspecialchars($record['id']);?></p>
    <p>Photo ID:<?php echo htmlspecialchars($record['file_name']);?></p>
    <div class="details">
    <form action ="/detail" method="get">
      <input type="hidden" name="detail_id" value="<?php echo htmlspecialchars($record['id']); ?>">
      <input type="submit" name="details" value="Details"/>
    </form>
    <form method="get" action="/edit">
      <input type="hidden" name="edit_id" value="<?php echo htmlspecialchars($record['id']); ?>">
      <input type="submit" name="edit" value="Edit"/>
    </form>
    <form method="get">
      <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($record['id']); ?>">
      <input type="submit" name="delete" value="Delete"/>
    </form>
    </div>
    </div>
    <div class="hor">
    <h3>This plant supports:</h3>
    <div class="play">
    <div class="blurb">
    <?php if ($record['tags.tag']=='EC') {?><h4>Exploratory Constructive Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='ES') {?>
    <h4>Exploratory Sensory Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='PHYS') {?>
    <h4>Physical Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='IMAG') {?>
    <h4>Imaginative Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='REST') {?>
    <h4>Restorative Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='EXP') {?>
    <h4>Expressive Play</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='WR') {?>
    <h4>Play with Rules</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='BP') {?>
    <h4>Bio Play</h4><?php }?>
    </div>
    </div>
    <h3>Growing needs and characteristics:</h3>
    <div class = "play">
    <div class="blurb">
    <?php if ($record['tags.tag']=='PER') {?>
    <h4>Perennial</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='AN') {?>
    <h4>Annual</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='SUN') {?>
    <h4>Full Sun</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='PS') {?>
    <h4>Partial Sun</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='SHADE') {?>
    <h4>Full Shade</h4><?php }?>
    </div>
    </div>
    <h3>General classification:</h3>
    <div class = "play">
    <div class="blurb">
    <?php if ($record['tags.tag']=='SHR') {?>
    <h4>Shrub</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='GRASS') {?>
    <h4>Grass</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='VINE') {?>
    <h4>Vine</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='TREE') {?>
    <h4>Tree</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='FLOW') {?>
    <h4>Flower</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='GC') {?>
    <h4>Groundcovers</h4><?php }?>
    </div>
    <div class="blurb">
    <?php if ($record['tags.tag']=='OTHER') {?>
    <h4>Other</h4><?php }?>
    </div>
    </div>
    </div>
    </div>
  </li>
  <?php } ?>
</ul>
<h2>Add a plant</h2>
<form id="plant-form" method="post" novalidate>
<div class="formtext">
<p id="name_feedback" class="feedback <?php echo $name_feedback; ?>">Please tell us your name</p>
<div class="field">
<label for="name">Your name:</label>
<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($sticky_name); ?>">
</div>
<p id="pname_feedback" class="feedback <?php echo $pname_feedback; ?>">Please tell us the plant's name</p>
<div class="field">
<label for="pname">Plant name:</label>
<input type="text" id="pname" name="pname" value="<?php echo htmlspecialchars($sticky_pname); ?>">
</div>
<p id="sname_feedback" class="feedback <?php echo $sname_feedback; ?>">Please tell us the plant's species name</p>
<div class="field">
<label for="sname">Species name:</label>
<input type="text" id="sname" name="sname" value="<?php echo htmlspecialchars($sticky_sname); ?>">
</div>
<div class="field">
<label for="pid">Plant ID:</label>
<input type="text" id="pid" name="pid" value="<?php echo htmlspecialchars($sticky_pid); ?>">
</div>
</div>
<div class ="checkboxes">
<p>Playtypes:</p>
<div class ="checkbox">
<input type="checkbox" id="1" name="1" value="1"<?php if ($sticky_ec == "checked") {?> checked <?php }?>>
<label for="1">Supports Exploratory Constructive Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="2" name="2" value="2"<?php if ($sticky_es == "checked") {?> checked <?php }?>>
<label for="2">Supports Exploratory Sensory Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="3" name="3" value="3"<?php if ($sticky_phys == "checked") {?> checked <?php }?>>
<label for="3">Supports Physical Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="4" name="4" value="4"<?php if ($sticky_imag == "checked") {?> checked <?php }?>>
<label for="4">Supports Imaginative Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="5" name="5" value="5"<?php if ($sticky_rest == "checked") {?> checked <?php }?>>
<label for="5">Supports Restorative Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="6" name="6" value="6"<?php if ($sticky_exp == "checked") {?> checked <?php }?>>
<label for="6">Supports Expressive Play</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="7" name="7" value="7"<?php if ($sticky_wr == "checked") {?> checked <?php }?>>
<label for="7">Supports Play with Rules</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="8" name="8" value="8"<?php if ($sticky_bp == "checked") {?> checked <?php }?>>
<label for="8">Supports Bio Play</label>
</div>
<p>Growing needs and characteristics:</p>
<div class ="checkbox">
<input type="checkbox" id="9" name="9" value="9"<?php if ($sticky_per == "checked") {?> checked <?php }?>>
<label for="9">Perennial</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="10" name="10" value="10"<?php if ($sticky_ann == "checked") {?> checked <?php }?>>
<label for="10">Annual</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="11" name="11" value="11"<?php if ($sticky_fullshade == "checked") {?> checked <?php }?>>
<label for="11">Full Sun</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="12" name="12" value="12"<?php if ($sticky_partial == "checked") {?> checked <?php }?>>
<label for="12">Partial Shade</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="13" name="13" value="13"<?php if ($sticky_fullshade == "checked") {?> checked <?php }?>>
<label for="13">Full Shade</label>
</div>
<p>General classification:</p>
<div class ="checkbox">
<input type="checkbox" id="14" name="14" value="14"<?php if ($sticky_shrub == "checked") {?> checked <?php }?>>
<label for="14">Shrub</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="15" name="15" value="15"<?php if ($sticky_grass == "checked") {?> checked <?php }?>>
<label for="15">Grass</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="16" name="16" value="16"<?php if ($sticky_vine == "checked") {?> checked <?php }?>>
<label for="16">Vine</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="17" name="17" value="17"<?php if ($sticky_tree == "checked") {?> checked <?php }?>>
<label for="17">Tree</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="18" name="18" value="18"<?php if ($sticky_flower == "checked") {?> checked <?php }?>>
<label for="18">Flower</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="19" name="19" value="19"<?php if ($sticky_groundcovers == "checked") {?> checked <?php }?>>
<label for="19">Groundcovers</label>
</div>
<div class ="checkbox">
<input type="checkbox" id="20" name="20" value="20"<?php if ($sticky_other == "checked") {?> checked <?php }?>>
<label for="20">Other</label>
</div>
</div>
<p>Upload an image of the plant:</p>
<input type="file" name="upload">
<div class="submit">
<input id="submit" type="submit" name="submit" value="Submit" />
</div>
</form>
</body>

</html>
