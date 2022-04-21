<!DOCTYPE html>
<html lang="en">

<?php
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
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
      <li><a href="/plants">Admin Plants</a></li>
      <li><a href="/consumer-plants">Consumer Plants</a></li>
      <li><a href="/log-in">Log in</a></li>
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
<p><em>Filter the database by growing needs and characteristics:</em></p>
<input type="checkbox" id="perennial" name="perennial" value="perennial"<?php if ($sticky_perennial == "checked") {?> checked <?php }?>>
<label for="per">Perennial</label>
<input type="checkbox" id="annual" name="annual" value="annual"<?php if ($sticky_annual == "checked") {?> checked <?php }?>>
<label for="annual">Annual</label>
<input type="checkbox" id="fulls" name="fulls" value="fulls"<?php if ($sticky_fulls == "checked") {?> checked <?php }?>>
<label for="fulls">Full Sun</label>
<input type="checkbox" id="partials" name="partials" value="partials"<?php if ($sticky_partials == "checked") {?> checked <?php }?>>
<label for="partials">Partial Shade</label>
<input type="checkbox" id="fullsh" name="fullsh" value="fullsh"<?php if ($sticky_fullsh == "checked") {?> checked <?php }?>>
<label for="fullsh">Full Shade</label>
<p><em>Filter the database by general classification:</em></p>
<input type="checkbox" id="shr" name="shr" value="shr"<?php if ($sticky_shr == "checked") {?> checked <?php }?>>
<label for="shr">Shrub</label>
<input type="checkbox" id="gra" name="gra" value="gra"<?php if ($sticky_gra == "checked") {?> checked <?php }?>>
<label for="gra">Grass</label>
<input type="checkbox" id="vin" name="vin" value="vin"<?php if ($sticky_vin == "checked") {?> checked <?php }?>>
<label for="vin">Vine</label>
<input type="checkbox" id="tre" name="tre" value="tre"<?php if ($sticky_tre == "checked") {?> checked <?php }?>>
<label for="tre">Tree</label>
<input type="checkbox" id="flo" name="flo" value="flo"<?php if ($sticky_flo == "checked") {?> checked <?php }?>>
<label for="flo">Flower</label>
<input type="checkbox" id="gro" name="gro" value="gro"<?php if ($sticky_gro == "checked") {?> checked <?php }?>>
<label for="gro">Groundcovers</label>
<input type="checkbox" id="oth" name="oth" value="oth"<?php if ($sticky_oth == "checked") {?> checked <?php }?>>
<label for="oth">Other</label>
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
    <!-- Source: Playful Plants Project (from INFO2300 photo folder) -->
    <img src="public/images/FL_05.jpg" alt="Temporary Image of Plant">
    Source: <cite>Playful Plants Project</cite>
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
    </div>
    </div>
  </li>
  <?php } ?>
</ul>
</body>

</html>
