<?php

include ('../conn.php');

 $sid = $_POST['sid'];
 $pracType = $_POST['pracType'];

$arr = array();


if($pracType=='1'){
$sql = "INSERT INTO practimings (`student_id`, `start`)
VALUES ('$sid', CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $sql)) {
  
    $sql2 = "SELECT * FROM practimings WHERE student_id=$sid ORDER BY `start` DESC LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);
    
    if (mysqli_num_rows($result2) > 0) {
      // output data of each row
      while($row2 = mysqli_fetch_assoc($result2)) {
    
            $time = date("d-M-Y H:i", strtotime($row2['start']));  
            $rowId = $row2['id'];

            array_push($arr,$time,$pracType,$rowId);
      }
    }

  
    echo json_encode($arr);

  

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

if($pracType=='2'){

    $sql = "UPDATE practimings SET `end`=CURRENT_TIMESTAMP WHERE id=$sid";

    if (mysqli_query($conn, $sql)) {



        $sql2ii = "SELECT * FROM practimings WHERE id=$sid";
        $result2ii = mysqli_query($conn, $sql2ii);
        
        if (mysqli_num_rows($result2ii) > 0) {
          // output data of each row
          while($row2ii = mysqli_fetch_assoc($result2ii)) {
        
                $time = date("d-M-Y H:i", strtotime($row2ii['end']));  
              
    
                array_push($arr,$time,$pracType,$sid);
          }
        }


      echo json_encode($arr);


    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      
  
}

if($pracType=='3'){

    $sql = "DELETE FROM practimings WHERE id=$sid";

if (mysqli_query($conn, $sql)) {
    array_push($arr,'deleted',$pracType,$sid);
    echo json_encode($arr);

} 


}



?>

