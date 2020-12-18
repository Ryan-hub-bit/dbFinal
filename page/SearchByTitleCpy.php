<?php
include "session.php";
session_start();
echo "Your user id is: " . $_SESSION['user_id'] . "<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
$_SESSION['keyword'] = $_POST['keyword'];
echo "Your keyword is: " . $_SESSION['keyword'] . "<br>";
?>

<head>
<link rel="stylesheet" href="/css/SearchByID.css">
  <title> Movie List </title>
</head>

<body>

  <h1> Movie List </h1>

  <style type="text/css">
    #movie {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      width: 100%;
      border-collapse: collapse;
    }

    #movie td,
    #movie th {
      font-size: 1em;
      border: 1px solid #98bf21;
      padding: 3px 7px 2px 7px;
    }

    #movie th {
      font-size: 1.1em;
      text-align: left;
      padding-top: 5px;
      padding-bottom: 4px;
      background-color: #A7C942;
      color: #ffffff;
    }

    #movie tr.alt td {
      color: #000000;
      background-color: #EAF2D3;
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
  if (isset($_POST['add'])) {
    $movie_id = $_POST['add'];
    // $sql1 = "INSERT INTO db.watchedMovies(user_id,watched_movie_id) "
    $sql1 = sprintf("INSERT INTO db.watchedMovies(user_id,watched_movie_id) VALUES(%d, %d);", $user_id, $movie_id);
    if ($conn->query($sql1) === TRUE) {
      echo "add" . $movie_id . "successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      // echo "already in your list";
    }
  }
  if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
  }
  $sql = "SELECT * FROM db.mDetail WHERE title Like '%" . $keyword . "%'";
  // $sql = "SELECT* FROM db.mDetail";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // echo "<table id = 'movie'><tr><th>movie_id</th><th>title</th><th>tagline</th></tr>";
    echo "<section>";
    echo "<h1> Result List</h1>";
    echo "<div class = 'tbl-header'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'><thread><tr><th>movie_id</th><th>title</th><th>tagline</th><th>add to your favorite</th></tr></thread></table>";
    echo "<div class = 'tbl-conteant'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'> <tbody>";
    while ($row = $result->fetch_assoc()) {
      $tmp = $row["movie_id"];
      echo "<tr><td>" . $row["movie_id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["tagline"] . "</td><td>";
  ?>

      <form method="POST" action="SearchByTitle.php">
        <input value=<?php echo $tmp; ?> type="hidden" name="add">
        <input value=<?php echo $keyword; ?> type="hidden" name="keyword">
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
  echo "<button id='back'>Back</button><br>";
  echo "<button id='logout'>logout</button>";
  echo "</div>";
  $conn->close();
  ?>
  <script type="text/javascript">
    document.getElementById("back").onclick = function() {
      location.href = "home.php";
      $_SESSION['keyword'] = '';
      // $_SESSION['user_id'] = $user_id;
    };
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();
  </script>
</body>