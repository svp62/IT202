
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
    
    <button type="submit" name="asc_sort" id="asc_sort" class="button" value="1">Sort</button>
	</div>
</form>
<?php

if(isset($_POST['asc_sort']) && !empty($_POST['asc_sort']) && $_POST['asc_sort']==1)
{
     $query = "SELECT * FROM Survey ORDER BY title ASC";
	 
	 
	 try {
            $stmt = getDB()->prepare($query);
            
            $stmt->execute([":filter"=>$filter]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

}else{

    $query = "SELECT * FROM Survey ORDER BY title DESC";
	
	try {
            $stmt = getDB()->prepare($query);
            
            $stmt->execute([":filter"=>$filter]);
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
}

echo $query;

?>



<?php if(isset($results) && count($results) > 0):?>
    <p>we have results below.</p>
    <ul>
        
        <?php foreach($results as $row):?>
            <li>
                <?php echo get($row, "title")?>
			
                <?php echo get($row, "description");?>
                
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <p>we don't have any results.</p>
<?php endif;?>