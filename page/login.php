<?php 
echo "Your user id is: ".$_SESSION['user_id']."<br>";
echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
echo "Your keyword is: ".$_SESSION['keyword']."<br>";
?>
<!DOCTYPE html>
<html>
<body>

<h1>Login</h1>

<h2>Login</h2>
<form action="home.php" method="post">
    user_id: <input type="text" name="user_id"><br>
         <input type="Submit">
</form>


</body>
</html>