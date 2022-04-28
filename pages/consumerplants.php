<?php

//ini_set('display_errors', 1);

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, 'SELECT * FROM plants;');
$records = $result->fetchAll();
$relationships = exec_sql_query($db, "SELECT * FROM relationships; ");
$relationshiprecords = $relationships->fetchAll();

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
  if (isset($_GET["search"])) {
  if (isset($_GET["rbutton"])) {
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

  //create sticky variables for sorting
  if ($sortform == "byname") {
    $sticky_namesort = "selected";
  } else {
    $sticky_snamesort = "selected";
  }

  //add filters to array
  if ($checked_button == 'perennial') {
    $filter_part = "(tags.tag = 'PER')";
  }

  if ($checked_button == 'annual') {
    $filter_part = "(tags.tag = 'AN')";
  }

  if ($checked_button == 'fulls') {
    $filter_part = "(tags.tag = 'SUN')";
  }

  else if ($checked_button == 'partials') {
    $filter_part = "(tags.tag = 'PS')";
  }

  if ($checked_button == 'fullsh') {
    $filter_part = "(tags.tag = 'SHADE')";
  }

  if ($checked_button == 'shr') {
    $filter_part = "(tags.tag = 'SHR')";
  }

  if ($checked_button == 'gra') {
    $filter_part = "(tags.tag = 'GRASS')";
  }

  if ($checked_button == 'vin') {
    $filter_part = "(tags.tag = 'VINE')";
  }

  if ($checked_button == 'tre') {
    $filter_part = "(tags.tag = 'TREE')";
  }

  if ($checked_button == 'flo') {
    $filter_part = "(tags.tag = 'FLOW')";
  }

  if ($checked_button == 'gro') {
    $filter_part = "(tags.tag = 'GC')";
  }

  if ($checked_button == 'oth') {
    $filter_part = "(tags.tag = 'OTHER')";
  }

  $where_part = " WHERE ". htmlspecialchars($filter_part);
}
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
}
?>

<body>
<?php include('includes/header.php'); ?>
<h2>Plant database</h2>
<div class="search">
<p><em>Filter the database by growing needs and characteristics:</em></p>
<form>
<input type="radio" id="perennial" name="rbutton" value="perennial" <?php if ($sticky_perennial == 'checked') {?>checked<?php }?>>
<label for="perennial">Perennial</label>
<input type="radio" id="annual" name="rbutton" value="annual"<?php if ($sticky_annual == 'checked') {?>checked<?php }?>>
<label for="annual">Annual</label>
<input type="radio" id="fulls" name="rbutton" value="fulls"<?php if ($sticky_fulls == 'checked') {?>checked<?php }?>>
<label for="fulls">Full Sun</label>
<input type="radio" id="partials" name="rbutton" value="partials"<?php if ($sticky_partials == 'checked') {?>checked<?php }?>>
<label for="partials">Partial Shade</label>
<input type="radio" id="fullsh" name="rbutton" value="fullsh"<?php if ($sticky_fullsh == 'checked') {?>checked<?php }?>>
<label for="fullsh">Full Shade</label>
<p><em>Filter the database by general classification:</em></p>
<input type="radio" id="shr" name="rbutton" value="shr"<?php if ($sticky_shr == 'checked') {?>checked<?php }?>>
<label for="shr">Shrub</label>
<input type="radio" id="gra" name="rbutton" value="gra"<?php if ($sticky_gra == 'checked') {?>checked<?php }?>>
<label for="gra">Grass</label>
<input type="radio" id="vin" name="rbutton" value="vin"<?php if ($sticky_vin == 'checked') {?>checked<?php }?>>
<label for="vin">Vine</label>
<input type="radio" id="tre" name="rbutton" value="tre"<?php if ($sticky_tre == 'checked') {?>checked<?php }?>>
<label for="tre">Tree</label>
<input type="radio" id="flo" name="rbutton" value="flo"<?php if ($sticky_flo == 'checked') {?>checked<?php }?>>
<label for="flo">Flower</label>
<input type="radio" id="gro" name="rbutton" value="gro"<?php if ($sticky_gro == 'checked') {?>checked<?php }?>>
<label for="gro">Groundcovers</label>
<input type="radio" id="oth" name="rbutton" value="oth"<?php if ($sticky_oth == 'checked') {?>checked<?php }?>>
<label for="oth">Other</label>
<div class = "button">
<p><em>Sort the database:</em></p>
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
    </div>
    <div class="details">
    <form action ="/detail" method="get">
      <input type="hidden" name="detail_id" value="<?php echo htmlspecialchars($record['id']); ?>">
      <input type="submit" name="details" value="Details"/>
    </form>
    <?php }?>
    </div>
    </div>
  </li>
</ul>
</body>

</html>
