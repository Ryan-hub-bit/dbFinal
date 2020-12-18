<?php
    include "session.php";
    session_start();
    if($_POST['user_id'] != '' || $_POST['user_id'] != null) {
        $_SESSION['user_id'] = $_POST['user_id'];
    } 
    echo "Your session id is: ".$_SESSION['user_id'];
?> 
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DashBoard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/home.css" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <nav class="menu">
            <ul class="main-menu">
                <li><i class="fa fa-home"></i>Home</li>
                <li class="with-submenu">
                    <i class="fa fa-briefcase"></i>Searching<i class="fa fa-caret-down"></i>
                    <ul class="submenu">
                        <li>ByMovieID</li>
                        <li>ByMovieTitle</li>
                        <li>ByMovieCondition</li>
                    </ul>
                </li>
                <li><i class="fa fa-user"></i>Favorite List</li>
                <li>Recommendation</li>
                <!-- <li>Logout</li> -->
            </ul>
        </nav>
        <article>
            <h1>Searching By MovieID</h1>
            <div class="content">
            <form action="SearchById.php" method="post">
       Movie_id: <input type="text" name="movie_id"><br>
         <input type="Submit">
         </form>
              
            </div>
        </article>
    </div>
        
    </body>
<script type="text/javascript">
   
</script>
</html>