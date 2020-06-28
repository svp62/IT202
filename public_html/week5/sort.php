
<?php
include("styles.css");

?>



<?php
$filter = "";
if(isset($_POST["filter"])){
    $filter = $_POST["filter"];
}
?>
<form method="POST">
	<div>
    
    <input type="submit" value="Ascending"/>
	<input type="submit" value="Descending"/>
	</div>
</form>
<?php
if(isset($filter)) {

    require("functions.php");
    
	$query = file_get_contents("filter_table.sql");
    if (isset($query) && !empty($query)) {
        try {
            $stmt = getDB()->prepare($query);
            
            $stmt->execute([":filter"=>$filter]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>


<?php if(isset($results) && count($results) > 0):?>
    <p>we have results below.</p>
    <ul>
        
        <?php foreach($results as $row):?>
            <li>
                <?php echo get($row, "title")?>
			
                <?php echo get($row, "description");?>
                <!--<a href="delete.php?thingId=<?php echo get($row, "id");?>">Delete</a> -->
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>we don't have any results.</p>
<?php endif;?>