<?php
include "session.php";
session_start();
echo "Your user id is: ".$_SESSION['user_id']."<br>";
$_SESSION['movie_id'] = $_POST['movie_id'];
 echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
?>

<head>
  <title> Movie List </title>
</head>

<body>

  <h1> Movie List</h1>

<style type="text/css">
#movie
  {
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:100%;
  border-collapse:collapse;
  }

#movie td, #movie th 
  {
  font-size:1em;
  border:1px solid #98bf21;
  padding:3px 7px 2px 7px;
  }

#movie th 
  {
  font-size:1.1em;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
  background-color:#A7C942;
  color:#ffffff;
  }

#movie tr.alt td 
  {
  color:#000000;
  background-color:#EAF2D3;
  }
</style>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "rootroot";


// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
$movie_id = $_SESSION['movie_id'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM db.mDetail WHERE movie_id = '" .$movie_id."'";
// $sql = "SELECT* FROM db.mDetail";
$result = $conn ->query($sql);
if($result -> num_rows > 0) {
    echo "<table id = 'movie'><tr><th>movie_id</th><th>title</th><th>tagline</th></tr>";
    $i = 0;
    while($row = $result->fetch_assoc()) {
         echo "<tr><td>". $row["movie_id"] ." ". "<button id='add'>". " add " . "</button>". "</td><td>" . $row["title"]. "</td><td>" .$row["tagline"]. "</td></tr>";
        $_SESSION['watched_movie']['.$i.'] = $row["movie_id"];
        $_SESSION['num']['.$i.'] = $i;
        echo $_SESSION['watched_movie']['.$i.'];
        $i++;
        ?>
        

        <?php
          $_SESSION['num'][$i] = $i; 
    }
    echo "</table>";
} else {
    echo "0 results";
}
echo "<button id='back'>Back</button>";

if(array_key_exists('sure', $_POST)) {
  insert();
}
function insert(){
  for($i = 0; $i < 15; $i++) {
    echo $_SESSION['watched_movie']['.$i.'];
    if($_SESSION['watched_movie']['.$i.'] === $i) {
      echo " " .$_SESSION['num'][$i]. "i" .$i. "<br>"; 
      $sql = sprintf("INSERT INTO db.watchedMovies(user_id,watched_movie_id) VALUES(?, ?);",$_SESSION['num'][$i],$_SESSION['watched_movie'][$i]);
      global $conn;
      $conn ->query($sql);
    }
  }
  echo "successfully insertion";
}
$conn -> close();
?>

<!-- <button id = "sure" onClick = "insert()">sure</button> -->
<form method = "post">
  <input type = "submit" name="sure" class = "button" value = "sure"/>
</form>

<p id = "test">test</p>

<script type="text/javascript">
    document.getElementById("back").onclick = function () {
        location.href = "home.php";
        $_SESSION['movie_id'] = '';
        
        // $_SESSION['user_id'] = $user_id;  
    };
    for(var i = 0; i < 15; i++) {
      document.getElementById(i).onclick = function (){
        
        // $_SESSION['num']['i'] = 'i';
        document.getElementById("test").innerHTML = "successful";
    };
    }
    
</script>
</body>