<?php 
include('db.php');
/*** 

TASK

Most passengers on longer flights prefer to watch movies before reaching their destination.
One or two movies in most cases, however, there is a chance they may reach their
destination before the second movie ends. Build a feature that allows the selection of two
movies whose total duration equals the exact length of the flight.
Write a function that takes an integer $lengthofFlight and an array of integers,
$movieDuration. The function should return a boolean that indicates whether there are two
numbers in $movieDuration whose sum equals $lengthofFlight.
Consider the below:
◦ Assume a passenger will watch exactly two movies
◦ The same movie is not repeated
(all time is presented in minutes)


STEP TO ACHIEVE THE GOAL
select flight
add movie list
select one movie
calculate (flight time - movie 1)
suggest movie 2 where movie length is =( flight time - movie 1)







**/

//CONNECT DATABASE
        //done

echo 'hello';


//ADD FLIGHTS
    //done


//ADD MOVIES
    //done


//SELECT FLIGHT

//SELECT MOVIE 1



//CALCULATE (FLIGHT TIME - MOVIE 1)



//SUGGEST MOVIE 2

include('db.php');
 
$queryTasks = "SELECT * FROM `flights` ORDER by `id` DESC";
$resultTasks = mysqli_query($db,$queryTasks);
$tasks =  mysqli_fetch_all($resultTasks, MYSQLI_ASSOC);
mysqli_free_result($resultTasks);
mysqli_close($db);




?>
<link rel="stylesheet" href="bootstrap.css">

<table class="table table-striped table-borderless  ">
  <caption>...</caption>
  <thead>
    <tr>
      <th>From</th>
      <th>to</th>
      <th>Duration</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
                       <?php foreach ( $tasks as $task ):  ?>
                           <tr>
                                                    
                           
                                <td class="text-capitalize"><?php echo $task['depature']; ?></td>
                               <td class="text-capitalize"><?php echo $task['arrival']; ?></td>
                               <td class="text-capitalize"><?php echo $task['duration']; ?></td>
                            <td><a class="btn btn-sm btn-primary" href="flight.php?id=<?php echo  base64_encode($task['id']); ?>">Select</a></td>
                           </tr>
                       
                           </tr>
                          
                           <?php endforeach   ?>

                           
                       </tbody>
</table>