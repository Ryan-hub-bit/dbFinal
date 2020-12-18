<?php 
echo "Your user id is: ".$_SESSION['user_id']."<br>";
echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
echo "Your keyword is: ".$_SESSION['keyword']."<br>";
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="/css/w2.css">
<body>

<div class="container">

  <header>
    <h2><a href="#">UMovies</a></h2>
   
  </header>

  <div class="cover">
    <h1>Discover what's out there.</h1>
    <form  class="flex-form" action = "homeCpy.php" method = "post">
      <input type="uid" placeholder="Your User ID">
      <input type="submit" value="Login"> 
    </form>
  </div>

</div>

</body>
</html>