<!DOCTYPE html>
<html lang="en">

<?php
$db = open_sqlite_db('tmp/site.sqlite');
$result = exec_sql_query($db, 'SELECT * FROM plants;');
$records = $result->fetchAll();

//default feedback classes as hidden
$name_feedback = 'hidden';
$pname_feedback = 'hidden';
$sname_feedback = 'hidden';

//default insertion for add plant as false
$plant_added = false;

//making sticky variables for add form
$sticky_name = '';
$sticky_pname = '';
$sticky_sname = '';
$sticky_ec = '';
$sticky_es = '';
$sticky_phys = '';
$sticky_imag = '';
$sticky_rest = '';
$sticky_exp = '';
$sticky_wr = '';
$sticky_bp = '';
$sticky_edible = '';
$sticky_scent = '';
$sticky_tactile = '';
$sticky_visual = '';

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

//if add form is submitted take inputs into variables
if (isset($_POST['submit'])) {
  $form_valid = true;

  $name = $_POST['name'];
  $pname = $_POST['pname'];
  $sname = $_POST['sname'];
  $ec = empty($_POST['1'])? 0:1;
  $es = empty($_POST['2'])? 0:1;
  $phys = empty($_POST['3'])? 0:1;
  $imag = empty($_POST['4'])? 0:1;
  $rest = empty($_POST['5'])? 0:1;
  $exp = empty($_POST['6'])? 0:1;
  $wr = empty($_POST['7'])? 0:1;
  $bp = empty($_POST['8'])? 0:1;
  $edible = $_POST['edible'];
  $scent = $_POST['scent'];
  $tactile = $_POST['tactile'];
  $visual = $_POST['visual'];

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
  $result = exec_sql_query($db, "INSERT INTO plants (plant_name, species_name, is_exploratoryconstructive, is_exploratorysensory, is_physical, is_imaginative, is_restorative, is_expressive, is_withrules, is_bioplay, edible, scent, tactile, visualinterest) VALUES ('$pname', '$sname', '$ec', '$es', '$phys', '$imag', '$rest', '$exp', '$wr', '$bp', '$edible', '$scent', '$tactile', '$visual')");

  //plant has been added
  if ($result) {
  $plant_added = true;
  }

//if form didn't go through assign sticky values
} else {
  $sticky_name = $name;
  $sticky_pname = $pname;
  $sticky_sname = $sname;
  $sticky_ec = (empty($ec)? NULL:"checked");
  $sticky_es = (empty($es)? NULL:"checked");
  $sticky_phys = (empty($phys)? NULL:"checked");
  $sticky_imag = (empty($imag)? NULL:"checked");
  $sticky_rest = (empty($rest)? NULL:"checked");
  $sticky_exp = (empty($exp)? NULL:"checked");
  $sticky_wr = (empty($wr)? NULL:"checked");
  $sticky_bp = (empty($bp)? NULL:"checked");
  $sticky_edible = $edible;
  $sticky_scent = $scent;
  $sticky_tactile = $tactile;
  $sticky_visual = $visual;
}

//create sticky variables for filtering
$sticky_con = '';
$sticky_sens = '';
$sticky_ph = '';
$sticky_im = '';
$sticky_res = '';
$sticky_expr = '';
$sticky_rules = '';
$sticky_bio = '';
$sticky_namesort = NULL;
$sticky_snamesort = NULL;

//create variables for filtering/sorting
$con = NULL;
$sens = NULL;
$ph = NULL;
$im = NULL;
$res = NULL;
$expr = NULL;
$rules= NULL;
$bio = NULL;
$sortform = NULL;

//if filter/sort form is submitted assign inputs to variables
if (isset($_GET['search'])) {
  $con = $_GET['con'];
  $sens = $_GET['sens'];
  $ph = $_GET['ph'];
  $im = $_GET['im'];
  $res = $_GET['res'];
  $expr = $_GET['expr'];
  $rules= $_GET['rules'];
  $bio = $_GET['bio'];
  $sortform = $_GET["sortform"];
}

  //create variables for query parts
  $select_part = "SELECT * FROM plants ";
  $where_part = "";
  $order_part = "";
  $filter_part = array();

  //create sticky variables for filtering
  $sticky_con = (empty($con)? NULL:"checked");
  $sticky_sens = (empty($sens)? NULL:"checked");
  $sticky_ph = (empty($ph)? NULL:"checked");
  $sticky_im = (empty($im)? NULL:"checked");
  $sticky_res = (empty($res)? NULL:"checked");
  $sticky_expr = (empty($expr)? NULL:"checked");
  $sticky_rules = (empty($rules)? NULL:"checked");
  $sticky_bio = (empty($bio)? NULL:"checked");

  //create sticky variables for sorting
  if ($sortform == "byname") {
    $sticky_namesort = "selected";
  } else {
    $sticky_snamesort = "selected";
  }

  //add filters to array
  if ($con) {
    array_push($filter_part, "(is_exploratoryconstructive = 1)");
  }

  if ($sens) {
    array_push($filter_part, "(is_exploratorysensory = 1)");
  }

  if ($ph) {
    array_push($filter_part, "(is_physical = 1)");
  }

  if ($im) {
    array_push($filter_part, "(is_imaginative = 1)");
  }

  if ($res) {
    array_push($filter_part, "(is_restorative = 1)");
  }

  if ($expr) {
    array_push($filter_part, "(is_expressive = 1)");
  }

  if ($rules) {
    array_push($filter_part, "(is_withrules = 1)");
  }

  if ($bio) {
    array_push($filter_part, "(is_bioplay = 1)");
  }

  if (count($filter_part) != 0) {
    $where_part = " WHERE ". implode('OR', $filter_part);
  }

  //assign order by part
  if ($sticky_namesort == "selected") {
    $order_part = " ORDER BY " . "plant_name ASC;";
  }
  if ($sticky_snamesort == "selected") {
    $order_part = " ORDER BY " . "species_name ASC;";
  }

  //put query together
  $sql_query = $select_part . $where_part . $order_part;

  //execute query
  $records = exec_sql_query($db, $sql_query)->fetchAll();
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
      <li><a href="/plants">Plants</a></li>
    </ul>
</nav>
<h2>Plant database</h2>
<div class="search">
<p><em>Filter the database by types of play the plant supports:</em></p>
<form>
<input type="checkbox" id="con" name="con" value="con"<?php if ($sticky_con == "checked") {?> checked <?php }?>>
<label for="con">Exploratory Constructive</label>
<input type="checkbox" id="sens" name="sens" value="sens"<?php if ($sticky_sens == "checked") {?> checked <?php }?>>
<label for="sens">Exploratory Sensory</label>
<input type="checkbox" id="ph" name="ph" value="ph"<?php if ($sticky_ph == "checked") {?> checked <?php }?>>
<label for="ph">Physical</label>
<input type="checkbox" id="im" name="im" value="im"<?php if ($sticky_im == "checked") {?> checked <?php }?>>
<label for="im">Imaginative</label>
<input type="checkbox" id="res" name="res" value="res"<?php if ($sticky_res == "checked") {?> checked <?php }?>>
<label for="res">Restorative</label>
<input type="checkbox" id="expr" name="expr" value="expr"<?php if ($sticky_expr == "checked") {?> checked <?php }?>>
<label for="expr">Expressive</label>
<input type="checkbox" id="rules" name="rules" value="rules"<?php if ($sticky_rules == "checked") {?> checked <?php }?>>
<label for="rules">With Rules</label>
<input type="checkbox" id="bio" name="bio" value="bio"<?php if ($sticky_bio == "checked") {?> checked <?php }?>>
<label for="bio">Bio</label>
<div class = "button">
<p><em>Sort the database:</em></p>
<form>
<select id="sortform" name="sortform">
  <option value="byname" name="byname" id="byname"<?php if ($sticky_namesort == "selected") {?> selected <?php }?>>By plant name</option>
  <option value="bysname" name="bysname" id="bysname"<?php if ($sticky_snamesort == "selected") {?> selected <?php }?>>By species name</option>
</select>
<div class="formsubmit">
<input id="submit" type="submit" name="search" value="Search" />
</div>
</div>
</form>
</div>
<ul>
  <?php foreach($records as $record) { ?>
  <li>
    <div class="plant">
    <div class="name">
    <h2><?php echo htmlspecialchars($record['plant_name']);?></h2>
    <h3><?php echo htmlspecialchars($record['species_name']);?></h3>
    <p><?php echo htmlspecialchars($record['id']);?></p>
    </div>
    <div class="hor">
    <div class="play">
    <div class="blurb">
    <h4>Exploratory Constructive Play</h4>
    <h5><?php if ($record['is_exploratoryconstructive'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Exploratory Sensory Play</h4>
    <h5><?php if ($record['is_exploratorysensory'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Physical Play</h4>
    <h5><?php if ($record['is_physical'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Imaginative Play</h4>
    <h5><?php if ($record['is_imaginative'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Restorative Play</h4>
    <h5><?php if ($record['is_restorative'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Expressive Play</h4>
    <h5><?php if ($record['is_expressive'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Play with Rules</h4>
    <h5><?php if ($record['is_withrules'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    <div class="blurb">
    <h4>Bio Play</h4>
    <h5><?php if ($record['is_bioplay'] == 1) {?>Yes<?php } else { ?>No<?php }?></h5>
    </div>
    </div>
    <div class="text">
    <div class="blurb">
    <h4>Visual</h4>
    <p><?php echo htmlspecialchars($record['visualinterest']);?></p>
    </div>
    <div class="blurb">
    <h4>Taste</h4>
    <p><?php echo htmlspecialchars($record['edible']);?></p>
    </div>
    <div class="blurb">
    <h4>Scent</h4>
    <p><?php echo htmlspecialchars($record['scent']);?></p>
    </div>
    <div class="blurb">
    <h4>Tactile</h4>
    <p><?php echo htmlspecialchars($record['tactile']);?></p>
    </div>
    </div>
    </div>
    </div>
  </li>
  <?php } ?>
</ul>
<?php if ($form_valid == false) {?>
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
</div>
<div class ="checkboxes">
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
<div class = "describe">
<label for="edible">What does it taste like?</label>
<textarea id="edible" name="edible"><?php echo htmlspecialchars($sticky_edible); ?></textarea>
<label for="scent">What does it smell like?</label>
<textarea id="scent" name="scent"><?php echo htmlspecialchars($sticky_scent); ?></textarea>
<label for="tactile">What does it feel like?</label>
<textarea id="tactile" name="tactile"><?php echo htmlspecialchars($sticky_tactile); ?></textarea>
<label for="visual">What does it look like?</label>
<textarea id="visual" name="visual"><?php echo htmlspecialchars($sticky_visual); ?></textarea>
</div>
</div>
<div class="submit">
<input id="submit" type="submit" name="submit" value="Submit" />
</div>
</form>
<?php }?>

<?php if ($plant_added == true) {?>
<p>Thank you <?php echo htmlspecialchars($name)?> for your plant submission!</p>
<?php }?>
</body>

</html>
