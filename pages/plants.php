<!DOCTYPE html>
<html lang="en">

<?php

ini_set('display_errors', 1);

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, 'SELECT * FROM plants; ');
$tags = exec_sql_query($db, 'SELECT * FROM tags; ');
$records = $result->fetchAll();
$tagrecords = $tags->fetchAll();

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
  $perennial = $_GET["perennial"];
  $annual = $_GET["annual"];
  $fulls = $_GET["fulls"];
  $partials = $_GET["partials"];
  $fullsh = $_GET["fullsh"];
  $shr = $_GET["shr"];
  $gra = $_GET["gra"];
  $vin = $_GET["vin"];
  $tre = $_GET["tre"];
  $flo = $_GET["flo"];
  $gro = $_GET["gro"];
  $oth = $_GET["oth"];
}

  //create variables for query parts
  $select_part = 'SELECT * FROM (plants
  INNER JOIN relationships ON
  (relationships.plant_id = plants.id)) INNER JOIN
  tags ON (relationships.tag_id = tags.id);';
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
  $sticky_perennial = (empty($perennial)? NULL:"checked");
  $sticky_annual = (empty($annual)? NULL:"checked");
  $sticky_fulls = (empty($fulls)? NULL:"checked");
  $sticky_partials = (empty($partials)? NULL:"checked");
  $sticky_fullsh = (empty($fullsh)? NULL:"checked");
  $sticky_shr = (empty($shr)? NULL:"checked");
  $sticky_gra = (empty($gra)? NULL:"checked");
  $sticky_vin = (empty($vin)? NULL:"checked");
  $sticky_tre = (empty($tre)? NULL:"checked");
  $sticky_flo = (empty($flo)? NULL:"checked");
  $sticky_gro = (empty($gro)? NULL:"checked");
  $sticky_oth = (empty($oth)? NULL:"checked");

  //create sticky variables for sorting
  if ($sortform == "byname") {
    $sticky_namesort = "selected";
  } else {
    $sticky_snamesort = "selected";
  }

  //add filters to array
  if ($con) {
    array_push($filter_part, "(tag_id = 1)");
  }

  if ($sens) {
    array_push($filter_part, "(tag_id = 2)");
  }

  if ($ph) {
    array_push($filter_part, "(tag_id = 3)");
  }

  if ($im) {
    array_push($filter_part, "(tag_id = 4)");
  }

  if ($res) {
    array_push($filter_part, "(tag_id = 5)");
  }

  if ($expr) {
    array_push($filter_part, "(tag_id = 6)");
  }

  if ($rules) {
    array_push($filter_part, "(tag_id = 7)");
  }

  if ($bio) {
    array_push($filter_part, "(tag_id = 8)");
  }

  if ($perennial) {
    array_push($filter_part, "(tag_id = 9)");
  }

  if ($annual) {
    array_push($filter_part, "(tag_id = 10)");
  }

  if ($fulls) {
    array_push($filter_part, "(tag_id = 11)");
  }

  if ($partials) {
    array_push($filter_part, "(tag_id = 12)");
  }

  if ($fullsh) {
    array_push($filter_part, "(tag_id = 13)");
  }

  if ($shr) {
    array_push($filter_part, "(tag_id = 14)");
  }

  if ($gra) {
    array_push($filter_part, "(tag_id = 15)");
  }

  if ($vin) {
    array_push($filter_part, "(tag_id = 16)");
  }

  if ($tre) {
    array_push($filter_part, "(tag_id = 17)");
  }

  if ($flo) {
    array_push($filter_part, "(tag_id = 18)");
  }

  if ($gro) {
    array_push($filter_part, "(tag_id = 19)");
  }

  if ($oth) {
    array_push($filter_part, "(tag_id = 20)");
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

  //if delete button pressed, delete entry from plants
  if (isset($_GET['delete'])) {
    $deleted = true;

    $delete_id = $_GET['delete_id'];
    $result = exec_sql_query($db, "DELETE FROM plants WHERE id = '$delete_id'; ");
    $result = exec_sql_query($db, "DELETE FROM tags WHERE plant_id = '$delete_id'; ");
  }

  //if edit button pressed, save id in variable
  if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit_id'];
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
<?php if ($deleted == true) { ?>
<p>The plant has been deleted!</p>
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
    <h4>Exploratory Constructive Play</h4>
    </div>
    <div class="blurb">
    <h4>Exploratory Sensory Play</h4>
    </div>
    <div class="blurb">
    <h4>Physical Play</h4>
    </div>
    <div class="blurb">
    <h4>Imaginative Play</h4>
    </div>
    <div class="blurb">
    <h4>Restorative Play</h4>
    </div>
    <div class="blurb">
    <h4>Expressive Play</h4>
    </div>
    <div class="blurb">
    <h4>Play with Rules</h4>
    </div>
    <div class="blurb">
    <h4>Bio Play</h4>
    </div>
    </div>
    <h3>Growing needs and characteristics:</h3>
    <div class = "play">
    <div class="blurb">
    <h4>Perennial</h4>
    </div>
    <div class="blurb">
    <h4>Annual</h4>
    </div>
    <div class="blurb">
    <h4>Full Sun</h4>
    </div>
    <div class="blurb">
    <h4>Partial Sun</h4>
    </div>
    <div class="blurb">
    <h4>Full Shade</h4>
    </div>
    </div>
    <h3>General classification:</h3>
    <div class = "play">
    <div class="blurb">
    <h4>Shrub</h4>
    </div>
    <div class="blurb">
    <h4>Grass</h4>
    </div>
    <div class="blurb">
    <h4>Vine</h4>
    </div>
    <div class="blurb">
    <h4>Tree</h4>
    </div>
    <div class="blurb">
    <h4>Flower</h4>
    </div>
    <div class="blurb">
    <h4>Groundcovers</h4>
    </div>
    <div class="blurb">
    <h4>Other</h4>
    </div>
    </div>
    </div>
  </div>
  </li>
  <?php } ?>
  <?php //} ?>
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
<?php }?>
</body>

</html>
