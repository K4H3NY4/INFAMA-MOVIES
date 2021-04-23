<?php

require('db.php');
session_start();

$id = mysqli_real_escape_string($db, $_GET['id']);
$query = 'SELECT * FROM flights WHERE  id = '.base64_decode($id);
$result = mysqli_query($db,$query);
$project = mysqli_fetch_assoc($result);
$taskid = base64_decode($id);
mysqli_free_result($result);

$duration= mysqli_real_escape_string($db,$project['duration']);


$queryMovies = "SELECT * FROM `movies` where `length` <= $duration  ";
$resultMovies = mysqli_query($db,$queryMovies);
$movies =  mysqli_fetch_all($resultMovies, MYSQLI_ASSOC);




if(isset($_POST['first-movie'])){

	$movieId= mysqli_real_escape_string ($db, $_POST['movieId']);
	$movieLength = mysqli_real_escape_string ($db, $_POST['movieLength']);
    $acceptedLength = $duration  - $movieLength;
    $acceptedLength  = mysqli_real_escape_string($db,$acceptedLength);

    $movie1 = "SELECT * FROM movies WHERE  `id` =  $movieId ";
    $resultMovie1 = mysqli_query($db,$movie1);
    $movie1Details = mysqli_fetch_assoc($resultMovie1);
    $_SESSION['movie1'] = $movie1Details;
 
    $queryMovie2 = "SELECT * FROM `movies` where `length` <= $acceptedLength  and `id` != $movieId ";
    $resultMovie2 = mysqli_query($db,$queryMovie2);
    $movie2 =  mysqli_fetch_all($resultMovie2, MYSQLI_ASSOC);


    echo '

    <style>
    #first-movie{
        display:none;
    }
    
    </style>            
    <div  align="center">
    <section id="second-movie">

<h1 align="center">SELECT SECOND MOVIE </h1>
<div class="alert alert-primary" role="alert">
        Movie with title :<b>'.$movie1Details["title"].' </b> Has Been added to Watch List
    </div>
<br><br><br>

<div class="first-movie" align="center" >

    
    
    ';
  
 foreach ( $movie2 as $movies2 ):  

      echo '       
           
                                                     
                       
         <div class="col-3 bg-light" align="center" style="background-color: #fff;">
         <form  method="post" >  
        <div class="col-12"><img src=" '.$movies2["poster"].'" alt="" height="200" width="150"></div>
        <div class="col-12">Title: '.$movies2["title"].' </div>
        <input type="hidden" name="movieId2" value="'.$movies2["id"].'">
        <div class="col-12">Duration: '.$movies2["length"]. ' Minutes</div>
        <input type="hidden" name="movieLength2" value="'.$movies2["length"].'">
        <div class="col-12 "><button class="btn btn-primary" name="second-movie">ADD TO LIST</button></div>
        </form>
        </div>
     
                   ';       
     endforeach ;

     echo '            
     </div> ';
 


}


if(isset($_POST['second-movie'])){
        
    

    $movieId2= mysqli_real_escape_string ($db, $_POST['movieId2']); 
    $movieSelected2 = "SELECT * FROM movies WHERE  `id` =  $movieId2 ";
    $resultSelectedMovie2 = mysqli_query($db,$movieSelected2);
    $movie2Details = mysqli_fetch_assoc($resultSelectedMovie2);
    $_SESSION['movie2'] = $movie2Details;
     $movie1Details =$_SESSION['movie1'];

    echo '  
    <style>
    #first-movie{
        display:none !important;
    }
    
    </style> 
    <div  align="center">
    <section id="second-movie">

<h1 align="center">ALL SELECTED MOVIES </h1>
<div class="alert alert-primary" role="alert">
        Movie with title :<b>'.$movie2Details["title"].' </b> Has Been added to Watch List
    </div>
<br><br><br>

<div class="first-movie" align="center" >

    
    
    ';
    
// foreach ($movie2Details as $movie2Detail ):  

      echo '       
           
                                                     
                       
         <div class="col-3 bg-light" align="center" style="background-color: #fff;">
         <form  method="post" >  
        <div class="col-12"><img src=" '.$movie1Details["poster"].'" alt="" height="200" width="150"></div>
        <div class="col-12">Title: '.$movie1Details["title"].' </div>
        <input type="hidden" name="movieId2" value="'.$movie1Details["id"].'">
        <div class="col-12">Duration: '.$movie1Details["length"]. ' Minutes</div>
        <input type="hidden" name="movieLength2" value="'.$movie1Details["length"].'">
        <div class="col-12 "><button class="btn btn-primary" name="#">WATCH NOW</button></div>
        </form>
        </div>


                      
        <div class="col-3 bg-light" align="center" style="background-color: #fff;">
        <form  method="post" >  
       <div class="col-12"><img src=" '.$movie2Details["poster"].'" alt="" height="200" width="150"></div>
       <div class="col-12">Title: '.$movie2Details["title"].' </div>
       <input type="hidden" name="movieId2" value="'.$movie2Details["id"].'">
       <div class="col-12">Duration: '.$movie2Details["length"]. ' Minutes</div>
       <input type="hidden" name="movieLength2" value="'.$movie2Details["length"].'">
       <div class="col-12 "><button class="btn btn-primary" name="#">WATCH NOW</button></div>
       </form>
       </div>
     
                   ';       
 //    endforeach ;

     echo '            
     </div> 
     
     <style>
    #first-movie{
        display:none !important;
    }
    
    </style>
     
     ';
    
    





    
     
    }
    








?>

<link rel="stylesheet" href="bootstrap.css">
<script src="jquery.js"></script>

<style>
.col-12{
    background-color: #fff;
}

.first-movie{
    display: flex;
}

</style>

<section id="first-movie">

<h1 align="center">SELECT FIRST MOVIE </h1>
<br><br><br>

<div class="first-movie" align="center" >


<?php foreach ( $movies as $movie ):  ?>    
    <div class="col-3 bg-light" align="center" style="background-color: #fff;">                                                              
    <form  method="post"  >                  
     
        <div class="col-12"><img src="<?php echo $movie['poster']; ?>" alt="" height="200" width="150"></div>
         <div class="col-12">Title: <?php echo $movie['title']; ?></div>
        <input type="hidden" name="movieId" value="<?php echo $movie['id']; ?>">
        <div class="col-12">Duration: <?php echo $movie['length']; ?> Minutes</div>
        <input type="hidden" name="movieLength" value="<?php echo $movie['length']; ?> ">
         <div class="col-12 "><button class="btn btn-primary movie1 " name="first-movie" id="movie1" >ADD TO LIST</button></div>
   
    </form>
    </div>
                          
  <?php endforeach   ?>

</div>

</section>

<script>



</script>
