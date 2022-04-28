<?php
ini_set('display_errors', 1);

$detail_id = $_GET['detail_id'];

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result = exec_sql_query($db, "SELECT * FROM plants WHERE (id = $detail_id); ");
$records = $result->fetchAll();
?>

<body>
<?php include('includes/header.php'); ?>
<?php foreach($records as $record) { ?>
<form>
  <input type = "hidden" name="detail_id" value="<?php echo htmlspecialchars($record['id']); ?>">
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
Source: <cite>Playful Plants Project</cite>
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
</body>

</html>
