<?php
// print_r($_POST);
// echo 'test@gmail.com';
// echo 'test1@gmail.com';
// echo 'test2@gmail.com';
// echo 'test3@gmail.com';
//echo base64_encode('Password123*');

include ('conn.php');
include ('header.php');
?>


<div class="jumbotron jumbotron-billboard">
  <div class="img"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <h2>Trainer Login</h2>
               

                <div class="container">
  

  <form action="landing.php" method="POST">

    <div class="form-group">
      <!-- <label for="email">Email:</label> -->
      <input type="email" class="form-control" id="email" placeholder="Enter email" required name="email">
    </div>
    <div class="form-group">
      <!-- <label for="pwd">Password:</label> -->
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" required name="pwd">
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


            </div>
        </div>
    </div>
</div>


<br>




</body>
</html>
