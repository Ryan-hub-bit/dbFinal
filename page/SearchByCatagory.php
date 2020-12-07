<?php
include "session.php";
session_start();
echo "Your user id is: ".$_SESSION['user_id']."<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
$_SESSION['keyword'] = $_POST['keyword'];
echo "Your keyword is: ".$_SESSION['keyword']."<br>";
?>

<head>
  <title> Movie List </title>
</head>

<body>

  <h1> Movie List </h1>

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
$keyword = $_SESSION['keyword'];
$sql = "SELECT * FROM db.mDetail WHERE title Like '" .$keyword."'";
// $sql = "SELECT* FROM db.mDetail";
$result = $conn ->query($sql);
if($result -> num_rows > 0) {
    echo "<table id = 'movie'><tr><th>movie_id</th><th>title</th><th>tagline</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["movie_id"] ." ". "<button>". " add " . "</button>". "</td><td>" . $row["title"]. "</td><td>" .$row["tagline"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
echo "<button id='back'>Back</button>";
$user_id = $_SESSION['user_id'];
$conn -> close();
?>
<script type="text/javascript">
    document.getElementById("back").onclick = function () {
        location.href = "home.php";
        $_SESSION['keyword'] = '';
        // $_SESSION['user_id'] = $user_id; 
    };
</script>
</body>