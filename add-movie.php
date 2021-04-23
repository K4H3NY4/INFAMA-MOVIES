<?php 

 include('db.php');
 

 
 if(isset($_POST['addTask'])){

	$title = mysqli_real_escape_string ($db, $_POST['title']);
	$length= mysqli_real_escape_string ($db, $_POST['length']);

	

$cover_photo = $_FILES['poster']['name'];
$covertmpname = $_FILES['poster']['tmp_name'];
$folder = 'uploads/';
$file_name_extension= explode(".",$_FILES['poster']['name']);
$new_file_name = date('Y').date('m').date('d').time().rand(1000,9999).".".$file_name_extension[1];
$folder="uploads/"."posters";

if(!is_dir($folder)){
mkdir($folder,0777,true);
$folder = $folder."/".$new_file_name;
}else{
$folder = $folder."/".$new_file_name;
}



move_uploaded_file($covertmpname,  $folder);

$poster =mysqli_real_escape_string($db,$folder);



	$sql = "INSERT INTO `movies` SET
	`title` = '$title',
	 `length`='$length',
	 `poster`='$poster' 
	    ";
	  
	
	$db->query($sql);
	if($db->error){
	
	   echo $db->error;
	}else{
 
        echo '<div class="alert alert-primary" role="alert">
        movie successfully addded
    </div>';
 };
 
}


 ?>

<link rel="stylesheet" href="bootstrap.css">


			<form method="post" enctype="multipart/form-data" >
            title
            <input class="form-control" type="text" name="title">
		length
        <input class="form-control" type="text" name="length">

											<input class="uploadButton-input" name="poster" type="file" required  id="upload" multiple/>
									
		
					<button type="submit" name="addTask" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Post a Task</button>
			

			</div>
			<!-- Row / End -->
</form>
		