<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>PerfTimer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@1&family=Lato&family=Raleway:wght@300&family=Roboto+Condensed&display=swap" rel="stylesheet">

</head>

<style>

html * {
  font-size: 16px;
  line-height: 1.625;
  color: #65688A;
  font-family: Roboto Condensed, sans-serif;
}



/* font-family: 'Changa One', cursive;
font-family: 'Lato', sans-serif;
font-family: 'Raleway', sans-serif;
font-family: 'Roboto Condensed', sans-serif; */


.jumbotron-billboard .img {
    margin-bottom: 0px;
    opacity: 0.2;
    color: #fff;
    background: #000 url("img/learning-story.png") top center no-repeat;
    width: 100%;
    height: 100%;
    background-size: cover;
    overflow: hidden;
    position:absolute;
    top:0;
    left:0;
    z-index:1;
}
.jumbotron h2 {margin-top:0;}
.jumbotron {
  position:relative;
  padding-top:50px;
  padding-bottom:50px;
}
.jumbotron .container {
  position:relative;
  z-index:2;
}

@media screen and (max-width: 768px) {
  .jumbotron {
    padding-top:20px;
    padding-bottom:20px;
  }
}

</style>

<body>

<nav class="navbar navbar-default" style="background-color:#D5D2C7">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="color:#65688A">Performance Recording System</a>
    </div>
    <a href="logout.php?logout=1" style="color:#65688A">Logout</a>
  </div>
</nav>
