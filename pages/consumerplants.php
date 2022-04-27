<!DOCTYPE html>
<html lang="en">

<?php

//ini_set('display_errors', 1);

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
$sticky_perennial = '';
$sticky_annual = '';
$sticky_fulls = '';
$sticky_partials = '';
$sticky_fullsh = '';
$sticky_shr = '';
$sticky_gra = '';
$sticky_vin = '';
$sticky_tre = '';
$sticky_flo = '';
$sticky_gro = '';
$sticky_oth = '';

//create variables for filtering/sorting
$perennial = NULL;
$sortform = NULL;
$annual = NULL;
$fulls = NULL;
$partials = NULL;
$fullsh = NULL;
$shr = NULL;
$gra = NULL;
$vin = NULL;
$tre = NULL;
$flo = NULL;
$gro = NULL;
$oth = NULL;
$sortform = NULL;

//if filter/sort form is submitted assign inputs to variables
if (isset($_GET['search'])) {
  $perennial = $_GET["perennial"];
  $sortform = $_GET["sortform"];
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
  $select_part = "SELECT
	plants.plant_name AS 'plant_name',
	plants.species_name AS 'species_name',
	plants.file_name AS 'file_name',
	relationships.plant_id AS 'plant_id',
	tags.tag AS 'tags.tag'
FROM
	relationships
	INNER JOIN plants ON (plants.id = relationships.plant_id)
	INNER JOIN tags ON (tags.id = relationships.tag_id) ";
  $where_part = "";
  $group_part = " GROUP BY plant_name ";
  $order_part = "";

  $filter_part = array();

  //create sticky variable for filtering
  if (isset($_GET['search'])) {
  $checked_button = $_GET["rbutton"];
  $sticky_perennial = $checked_button == 'perennial' ? 'checked':null;
  $sticky_annual = $checked_button == 'annual' ? 'checked':null;
  $sticky_fulls = $checked_button == 'fulls' ? 'checked':null;
  $sticky_partials = $checked_button == 'partials' ? 'checked':null;
  $sticky_fullsh = $checked_button == 'fullsh' ? 'checked':null;
  $sticky_shr = $checked_button == 'shr' ? 'checked':null;
  $sticky_gra = $checked_button == 'gra' ? 'checked':null;
  $sticky_vin = $checked_button == 'vin' ? 'checked':null;
  $sticky_tre = $checked_button == 'tre' ? 'checked':null;
  $sticky_flo = $checked_button == 'flo' ? 'checked':null;
  $sticky_gro = $checked_button == 'gro' ? 'checked':null;
  $sticky_oth = $checked_button == 'oth' ? 'checked':null;
  }

  //create sticky variables for sorting
  if ($sortform == "byname") {
    $sticky_namesort = "selected";
  } else {
    $sticky_snamesort = "selected";
  }

  //add filters to array
  if ($checked_button = 'perennial') {
    $filter_part = "(tags.tag = 'PER')";
  }

  if ($checked_button = 'annual') {
    $filter_part = "(tags.tag = 'AN')";
  }

  if ($checked_button = 'fulls') {
    $filter_part = "(tags.tag = 'SUN')";
  }

  if ($checked_button = 'partials') {
    $filter_part = "(tags.tag = 'PS')";
  }

  if ($checked_button = 'fullsh') {
    $filter_part = "(tags.tag = 'SHADE')";
  }

  if ($checked_button = 'shr') {
    $filter_part = "(tags.tag = 'SHR')";
  }

  if ($checked_button = 'gra') {
    $filter_part = "(tags.tag = 'GRASS')";
  }

  if ($checked_button = 'vin') {
    $filter_part = "(tags.tag = 'VINE')";
  }

  if ($checked_button = 'tre') {
    $filter_part = "(tags.tag = 'TREE')";
  }

  if ($checked_button = 'flo') {
    $filter_part = "(tags.tag = 'FLOW')";
  }

  if ($checked_button = 'gro') {
    $filter_part = "(tags.tag = 'GC')";
  }

  if ($checked_button = 'oth') {
    $filter_part = "(tags.tag = 'OTHER')";
  }

  $where_part = " WHERE ". htmlspecialchars($filter_part);

  //assign order by part
  if ($sticky_namesort == "selected") {
    $order_part = " ORDER BY " . "plant_name ASC;";
  }
  if ($sticky_snamesort == "selected") {
    $order_part = " ORDER BY " . "species_name ASC;";
  }

  //put query together
  $sql_query = $select_part . $where_part . $group_part . $order_part;

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
<?php echo htmlspecialchars($sql_query)?>
<?php echo htmlspecialchars($checked_button)?>
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
<p><em>Filter the database by growing needs and characteristics:</em></p>
<input type="radio" id="perennial" name="rbutton" value="perennial">
<label for="per">Perennial</label>
<input type="radio" id="annual" name="rbutton" value="annual">
<label for="annual">Annual</label>
<input type="radio" id="fulls" name="rbutton" value="fulls"<?php echo htmlspecialchars($sticky_fulls)?>>
<label for="fulls">Full Sun</label>
<input type="radio" id="partials" name="rbutton" value="partials">
<label for="partials">Partial Shade</label>
<input type="radio" id="fullsh" name="rbutton" value="fullsh">
<label for="fullsh">Full Shade</label>
<p><em>Filter the database by general classification:</em></p>
<input type="radio" id="shr" name="rbutton" value="shr">
<label for="shr">Shrub</label>
<input type="radio" id="gra" name="rbutton" value="gra">
<label for="gra">Grass</label>
<input type="radio" id="vin" name="rbutton" value="vin">
<label for="vin">Vine</label>
<input type="radio" id="tre" name="rbutton" value="tre">
<label for="tre">Tree</label>
<input type="radio" id="flo" name="rbutton" value="flo">
<label for="flo">Flower</label>
<input type="radio" id="gro" name="rbutton" value="gro">
<label for="gro">Groundcovers</label>
<input type="radio" id="oth" name="rbutton" value="oth">
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
    <?php $showfile = "public/images/".htmlspecialchars($record['file_name']).".jpg" ?>
    <img src=<?php echo $showfile?> alt=<?php echo htmlspecialchars($record['plant_name'])?> class="consumerpic">
    <div class="source">Source: <cite>Playful Plants Project</cite></div>
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
</ul>
</body>

</html>
