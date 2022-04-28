<?php
ini_set('display_errors', 1);

$detail_id = $_GET['detail_id'];

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, "SELECT * FROM plants WHERE (id = $detail_id); ");
$records = $result->fetchAll();
$relationships = exec_sql_query($db, "SELECT * FROM relationships WHERE (plant_id = $detail_id); ");
$relationshiprecords = $relationships->fetchAll();
?>

<body>
<?php include('includes/header.php'); ?>
<?php foreach($records as $record) { ?>
<form method="get">
  <input type = "hidden" name="detail_id" value="<?php echo htmlspecialchars($detail_id); ?>">
</form>
<?php } ?>
<form action="/plants">
<input type="submit" value="Back to plants">
</form>
<div class = "detail">
<h2><?php echo htmlspecialchars($record['plant_name']); ?></h2>
<p><?php echo htmlspecialchars($record['species_name']); ?></p>
<div class = "detailimg">
<!-- Source: Playful Plants Project (from INFO2300 photo folder) -->
<?php $showfile = "public/images/".htmlspecialchars($record['file_name']).".jpg" ?>
<img src=<?php echo $showfile?>  alt=<?php echo htmlspecialchars($record['plant_name']); ?>>
</div>
<?php $tagarray = array();
foreach($relationshiprecords as $record) {
array_push($tagarray, $record['tag_id']);}?>
    <div class="hor">
    <h3>This plant supports:</h3>
    <div class="play">
    <div class="blurb">
    <?php if (in_array(1, $tagarray)) {?>
    <h4>Exploratory Constructive Play</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(2, $tagarray)) {?>
    <h4>Exploratory Sensory Play</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(3, $tagarray)) {?>
    <?php }?>
    <h4>Physical Play</h4>
    </div>
    <div class="blurb">
    <?php if (in_array(4, $tagarray)) {?>
    <?php }?>
    <h4>Imaginative Play</h4>
    </div>
    <div class="blurb">
    <?php if (in_array(5, $tagarray)) {?>
    <h4>Restorative Play</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(6, $tagarray)) {?>
    <h4>Expressive Play</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(7, $tagarray)) {?>
    <h4>Play with Rules</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(8, $tagarray)) {?>
    <h4>Bio Play</h4>
    <?php }?>
    </div>
    </div>
    <h3>Growing needs and characteristics:</h3>
    <div class = "play">
    <div class="blurb">
    <?php if (in_array(9, $tagarray)) {?>
    <h4>Perennial</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(10, $tagarray)) {?>
    <h4>Annual</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(11, $tagarray)) {?>
    <h4>Full Sun</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(12, $tagarray)) {?>
    <h4>Partial Sun</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(13, $tagarray)) {?>
    <h4>Full Shade</h4>
    <?php }?>
    </div>
    </div>
    <h3>General classification:</h3>
    <div class = "play">
    <div class="blurb">
    <?php if (in_array(14, $tagarray)) {?>
    <h4>Shrub</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(15, $tagarray)) {?>
    <h4>Grass</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(16, $tagarray)) {?>
    <h4>Vine</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(17, $tagarray)) {?>
    <h4>Tree</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(18, $tagarray)) {?>
    <h4>Flower</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(19, $tagarray)) {?>
    <h4>Groundcovers</h4>
    <?php }?>
    </div>
    <div class="blurb">
    <?php if (in_array(20, $tagarray)) {?>
    <h4>Other</h4>
    <?php }?>
    </div>
    </div>
    </div>
    </div>
</body>

</html>
