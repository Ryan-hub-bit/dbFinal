<?php
include "session.php";
session_start();
// echo "Your user id is: ".$_SESSION['user_id']."<br>";
$_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
?>

<head>
  <title> Movie List </title>
  <link rel="stylesheet" href="/css/SearchByTitle.css">
</head>

<body>


  <?php
  ?>
  <?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "rootroot";
  $db = "db";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $db);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
  $movie_id = $_SESSION['movie_id'];
  $user_id = $_SESSION['user_id'];

  if (isset($_POST['add'])) {
    $movie_id = $_POST['add'];
    // $sql1 = "INSERT INTO db.watchedMovies(user_id,watched_movie_id) "
    // $sql1 = sprintf("INSERT INTO db.watchedMovies(user_id,watched_movie_id) VALUES(%d, %d);",$user_id, $movie_id);
    if ($conn->query("Call AddFavorite('" . $user_id . "',$movie_id)") === TRUE) {
      echo "<h1>Add   " . $movie_id . "    successfully</h1>";
    } else {
      echo "<h1> " . $movie_id . "    Already in your favorite list</h1> ";
      // echo "already in your list";
    }
  }
  $sql = "SELECT * FROM db.mDetail WHERE movie_id = '" . $movie_id . "'";
  // $sql = "SELECT* FROM db.mDetail";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "<section>";
    echo "<h1> Result List With MovieID = '" . $movie_id . "'</h1>";
    echo "<div class = 'tbl-header'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'><thread><tr><th>movie id</th><th>title</th><th>tagline</th><th>add to favorite</th></tr></thread></table>";
    echo "<div class = 'tbl-conteant'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'> <tbody>";
    while ($row = $result->fetch_assoc()) {
      $tmp = $row["movie_id"];
      //  echo "<tr><td>". $row["movie_id"] ." ". "<button id='".$i."'>". " add " . "</button>". "</td><td>" . $row["title"]. "</td><td>" .$row["tagline"]. "</td></tr>";
      echo "<tr><td>" . $row["movie_id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["tagline"] . "</td><td>";
  ?>

      <form method="POST" action="SearchByIdCpy.php">
        <input value=<?php echo $tmp; ?> type="hidden" name="add">
        <input type="submit" value="add">
      </form>
  <?php
      echo "</td></tr>";
    }
    echo "</tbody></table></div></section>";
  } else {
    echo "0 results";
  }
  echo "<div class = 'made-with-love'>";
  echo "<br><button id = 'back' class = 'button'>Back</button>";
  echo "<button id = 'logout' class= 'button'>logout</button>";
  echo "</div>";


  $conn->close();
  ?>


  <script type="text/javascript">
    document.getElementById("back").onclick = function() {
      location.href = "homeCpy.php";
    };
    document.getElementById("logout").onclick = function() {
      location.href = "login.php";
    };
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();
  </script>
</body>