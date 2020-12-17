<?php
    include "session.php";
    session_start();
    if($_POST['user_id'] != '' || $_POST['user_id'] != null) {
        $_SESSION['user_id'] = $_POST['user_id'];
    } 
    // echo "Your session id is: ".$_SESSION['user_id'];
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
        <title>dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/home.css">
        <!-- <link rel="stylesheet" href="/Users/liukun/Desktop/class/database/finaldb/font-awesome-4.7.0/css/font-awesome.min.css"> -->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <!-- <h2><a href="#">UMovies</a></h2> -->
            <!-- <div class = "menu-bar"> -->
                <nav>
                    <ul class = "nav_links">
                         <li class = "active"><a href = "#">Home</a></li>
                       <li><a href = "#">Searching</a>
                        <div class = "sub-menu-1">
                            <ul>
                                <li>
                                    <a href = "#">ByMovieID</a>
                                </li>
                                <li>
                                <a href = "#">ByMovieTitle</a>
                                </li>   
                                <li>
                                <a href = "#">ByMovieCondition</a>
                                </li>  
                            </ul>
                        </div>
                    </li>
                       <li><a href = "#"><i class = "fa fa-user"></i>Favorite List</a></li>
                       <li><a href = "#"><i class = "fa fa-user"></i>Recommendation List</a></li>
                       
                       </ul>
                       
                    </nav>
                    <!-- <a class = "cta" href = "#"><button>Logout</button></a> -->
            <!-- </div> -->
        </header>

    </body>
</html>
<!-- <!DOCTYPE html>
<html>
<body>

<h1>HomePage</h1>

<h2>Searching by Movie ID</h2>
<form action="SearchById.php" method="post">
    Movie_id: <input type="text" name="movie_id"><br>
         <input type="Submit">
</form>
<h2>Searching by Title</h2>
<form action="SearchByTitlePages.php?page=1" method="post">
    Keyword: <input type="text" name="keyword"><br>
             <input type = "hidden" value = "false" name = "flag">
             <input type="Submit">
</form>
<h2> Searching by Category</h2>
<form action="SearchByCatagory.php" method="post">
       Budget: <input type="number" name="budget_low_bound" value = "0"> - 
               <input type="number" name="budget_high_bound" value = "1000000000"><br>
      Revenue: <input type="number" name="revenue_low_bound" value = "0"> - 
               <input type="number" name="revenue_high_bound" value = "1000000000"><br>
      Popularity:<input type="number" name="popularity_low_bound" value = "0"> - 
               <input type="number" name="popularity_high_bound" value = "20"><br>
      Running Time(min):<input type="number" name="runTime_low_bound" value = "0"> - 
               <input type="number" name="runTime_high_bound" value = "400"><br>  
      Adult <input type="checkbox" name="isAdult" value = "adult"><br>
      imdb250 <input type="checkbox" name="isImdb250" value = "imdb250"><br>
      <label>Genre</label><br>
      <div>
    <input type="checkbox" id="action" name="action"
         checked>
    <label for="action">Action</label>
    </div>

    <div>   
    <input type="checkbox" id="crime" name="crime">
    <label for="crime">Crime</label>
    </div>
    <div>   
    <input type="checkbox" id="drama" name="drama">
    <label for="drama">Drama</label>
    </div>
      <input type="Submit">
</form>
<h2> My Favorite List</h2>
<button id="favoriteList">Favorite List</button>
<h2> Recommendation List</h2>
<button id="recommendationList">Recommendation List</button><br>
<hr>
<button id="back">Back</button> &nbsp;
<button id="logout">Logout</button>

<script type="text/javascript">
    document.getElementById("favoriteList").onclick = function () {
        location.href = "test.php";
    };
    document.getElementById("recommendationList").onclick = function () {
        location.href = "test.php";
    };
    document.getElementById("back").onclick =function() {
        location.href = "login.php";
    };
    document.getElementById("logout").onclick =function() {
        location.href = "login.php";
    };
</script>
</body>
</html> -->