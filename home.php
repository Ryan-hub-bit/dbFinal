<?php
    include "session.php";
    session_start();
    $_SESSION['user_id'] = $_POST['user_id'];
    echo "Your session id is: ".$_SESSION['user_id'];
?> 

<!DOCTYPE html>
<html>
<body>

<h1>HomePage</h1>

<h2>Searching by Movie ID</h2>
<form action="test.php" method="post">
    movie_id: <input type="text" name="movie_id"><br>
         <input type="Submit">
</form>
<h2>Searching by Title and Tagline</h2>
<form action="test.php" method="post">
    KeyWord: <input type="text" name="movie_id"><br>
             <input type="Submit">
</form>
<h2> Searching by Category</h2>
<form action="test.php" method="post">
    movie_id: <input type="text" name="movie_id"><br>
         <input type="Submit">
</form>
<h2> My Favorite List</h2>
<button id="FavoriteList">Favorite List</button>
<h2> Recommendation List</h2>
<button type="button">Recommendation List</button>

<script type="text/javascript">
    document.getElementById("FavoriteList").onclick = function () {
        location.href = "test.php";
    };
</script>
</body>
</html>