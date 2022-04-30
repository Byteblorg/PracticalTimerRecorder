<?php

include ('conn.php');
include ('header.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


 if(isset($_POST['email']) && isset($_POST['pwd'])){

  $email = $_POST['email'];
  $pwd = base64_encode($_POST['pwd']);


$sql = "  SELECT * FROM `trainers` T JOIN batches B ON B.trainer=T.id WHERE B.date=CURRENT_DATE AND T.email=? AND T.pwd=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $email, $pwd);


$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

    $batch= $row['batch'];
    $timeRequired= $row['timeRequired'];

    $_SESSION['loggedin']=1;
    
}


?>
<script>
//alert('You have logged in');


 </script>

 
<?php
 }else{

?>

<script>
alert('You need to login first');

 </script>

<?php
die();
 }

?>

<?php
 if($_SESSION['loggedin']!=1){
  header('Location: index.php');

 }else{
 }

?>


<div class="jumbotron jumbotron-billboard">
  <div class="img"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <h1>Practical Performance Timings</h1>

            </div>
        </div>
    </div>
</div>










<div class="container">

<div class="row">

<div class="col" style="text-align: center">
<button class="btn btn-primary" style="background-color:darkblue"  onclick="showHistory()">
View Timings  <i class="fa fa-bar-chart" style="color:white"></i>
</button>
</div>

<div class="col" style="text-align: center">

<button class="btn btn-primary" style="background-color:purple" onclick="showRecorder()"> 
Record Timing  <i class="fa fa-clock-o" style="color:white"></i>  
</button>

</div>

</div>



<br><br>


<section id='history' style="display:none">

<h3>
  <?php

echo 'Timing required for this batch '.floor( $timeRequired/60) . "mins " .  ($timeRequired % 60).'secs';


  ?>


</h3>

<table id="studentsTable" class="table table-striped" style="width:100%">
        <thead>
            <tr class="table-primary">
                <th>Student ID </th>
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Time Taken (mins)</th>


            </tr>
        </thead>
        <tbody>

        <?php

$sql0 = "SELECT * FROM `practimings` P JOIN students S ON S.studentId=P.student_id WHERE S.batch=?";
$stmt0 = $conn->prepare($sql0); 
$stmt0->bind_param("i", $batch);


$stmt0->execute();
$result0 = $stmt0->get_result();
while ($row0 = $result0->fetch_assoc()) {

 
?>

<tr>
                <td><?php echo $row0['student_id']?></td>
                <td><?php echo $row0['studentName']?></td>
                
                <td>
                <?php
                
                if($row0['start']!='0000-00-00 00:00:00'){
                echo date("d-M-Y H:i", strtotime($row0['start']));  
                }
                ?>

                </td>

                <td>
                <?php 
                
                if($row0['end']!='0000-00-00 00:00:00'){
                echo date("d-M-Y H:i", strtotime($row0['end']));  
                }
                
                ?>


                </td>


                
                <td>
                <?php 


                $ts1 = strtotime($row0['start']);
                $ts2 = strtotime($row0['end']);     
                $seconds_diff = $ts2 - $ts1;                            
                $time = ($seconds_diff/60);

if($seconds_diff>0){
              echo floor($seconds_diff/60) . ":" . $seconds_diff % 60;

if($seconds_diff<$timeRequired){

?>
<span>&nbsp;</span>

<i class="fa fa-thumbs-o-up fa-lg" style="color:green"></i>
<?php

}

}else{
  echo 'Not available';
}
                
                ?>


                </td>

         



              
            </tr>



<?php

    
}


?>

         
      
        </tbody>
       
 


</table>



</section>

<section id='record'  style="display:none">

<table id="studentsTable" class="table table-striped" style="width:100%">
        <thead>
            <tr class="table-primary">
                <th>Student ID </th>
                <th>Name</th>
                <th>Start</th>
                <th>Stop</th>

                <th>Delete</th>

            </tr>
        </thead>
        <tbody>

        <?php

$sql = "SELECT * FROM `students` WHERE batch=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $batch);


$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

 
?>

<tr>
                <td><?php echo $row['studentId']?></td>
                <td><?php echo $row['studentName']?></td>
                
                <td>

<button class="btn btn-success" id="<?php echo $row['studentId'] ?>" onclick="startTimer(<?php echo $row['studentId'] ?>,1,'01')">Start</button>
  
<span id="<?php echo $row['studentId'] ?>sTime"></span>


                </td>

                <td>


<button  class="btn btn-danger" id="<?php echo $row['studentId'] ?>del" style="display:none" onclick="startTimer(this.id,2,<?php echo $row['studentId'] ?>)">Stop</button>

<span id="<?php echo $row['studentId'] ?>eTime"></span>

                </td>

                <td>


<button  class="invalid" id="<?php echo $row['studentId'] ?>invalid" style="display:none" onclick="startTimer(this.id,3,<?php echo $row['studentId'] ?>)">Delete</button>



                </td>



              
            </tr>



<?php

    
}


?>

         
      
        </tbody>
       
 


</table>

</section>




</div>
</body>

</html>

<script>

  function showRecorder() {
  var x = document.getElementById("record");
  var y = document.getElementById("history");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";

  } else {
    x.style.display = "none";
    y.style.display = "block";

  }
}

function showHistory() {
  var x = document.getElementById("record");
  var y = document.getElementById("history");
  if (y.style.display === "none") {
    y.style.display = "block";
    x.style.display = "none";
  } else {
    y.style.display = "none";
    x.style.display = "block";
  }
}

function startTimer(sid,pracType,backupSID) {

 // alert(backupSID);

      $.ajax(
      {
        type: 'POST',
        url: 'ajax/startTimer.php',
        data: { 
          "sid": sid,
          "pracType":pracType 
          },
        success: function (response) {
           //alert(response);

           const myArr = JSON.parse(response);

          // alert(myArr[1]);

            if(myArr[1]==1){
             //   alert(sid);
              
             Swal.fire({
                      title: 'Timer Started',                   
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                    })

                const sTimeText = sid+'sTime';
          
                document.getElementById(sTimeText).innerHTML = myArr[0];
                document.getElementById(sid).style.display="none";

                document.getElementById(sid+'del').style.display="block";
                document.getElementById(sid+'del').id=myArr[2];


            }

            if(myArr[1]==2){
             //   alert(sid);

             Swal.fire({
                      title: 'Timer Stopped',                   
                      icon: 'warning',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                    })




                const eTimeText = backupSID+'eTime';
               // alert(eTimeText);
          
                document.getElementById(eTimeText).innerHTML = myArr[0];

                document.getElementById(sid).style.display="none";

                document.getElementById(backupSID+'invalid').style.display="block";
                document.getElementById(backupSID+'invalid').id=sid

            }

            if(myArr[1]==3){

              document.getElementById(sid).style.display="none";

              const collection = document.getElementsByClassName("invalid");

            //    alert(collection[0].id);
                var item = collection[0].id;

              document.getElementById(item).style.display="none";
              

                document.getElementById(backupSID).style.display="block";
                document.getElementById(backupSID+'sTime').style.display="none";
                document.getElementById(backupSID+'eTime').style.display="none";



                Swal.fire({
                      title: 'Deleted',                   
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Reload page'
                    }).then((result) => {
                      if (result.isConfirmed) {

                        location.reload();
                      }
                    })




            }
           

        },
        error: function (response) {
          alert(response);
        }
      }
      );

}


  $(document).ready(function() {
    $('#studentsTable').DataTable();    
} );
</script>