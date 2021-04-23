<?php 

 include('db.php');
  
 if(isset($_POST['addFlight'])){

	$depature= mysqli_real_escape_string ($db, $_POST['depature']);
	$arrival = mysqli_real_escape_string ($db, $_POST['arrival']);
	$duration = mysqli_real_escape_string ($db, $_POST['duration']);


	$sql = "INSERT INTO `flights` SET
	`depature` = '$depature',
	 `arrival`='$arrival',
     `duration`='$duration'
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
            echo '<div class="alert alert-primary" role="alert">
            flight successfully addded
        </div>';
 
 };
 
}

 ?>
 <link rel="stylesheet" href="bootstrap.css">
 <form  method="post">

<div class="form-group">
    <label for="my-input">From (Depature)</label>
    <input id="my-input" class="form-control" type="text" name="depature">

    <label for="my-input">To (Arrival)</label>
    <input id="my-input" class="form-control" type="text" name="arrival">

    <label for="my-input">Duration (Minutes)</label>
    <input id="my-input" class="form-control" type="text" name="duration">
    <button type="submit" name="addFlight" call_user_method></i> Add Flight</button>


</div>






</form>