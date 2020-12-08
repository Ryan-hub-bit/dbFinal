<?php
    include "session.php";
    session_start();
    if($_POST['user_id'] != '' || $_POST['user_id'] != null) {
        $_SESSION['user_id'] = $_POST['user_id'];
    } 
    echo "Your session id is: ".$_SESSION['user_id'];
?> 

<!DOCTYPE html>
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
</html>