<?php
include "session.php";
session_start();
echo "Your user id is: " . $_SESSION['user_id'] . "<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
// $_SESSION['flag'] = $_POST['flag'];
// if ($_SESSION['flag'] === 'false') {
//   $_SESSION['keyword'] = $_POST['keyword'];
// }

// echo "Your keyword is: " . $_SESSION['keyword'] . "<br>";
?>

<head>
  <link rel="stylesheet" href="/css/SearchByTitle.css">
  <title> Movie List </title>
</head>

<body>

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
  $user_id = $_SESSION['user_id'];

  $result = $conn->query("CALL Recommend()");
  if ($result->num_rows > 0) {
    echo "<section>";
    echo "<h1> Recommendation Movies List for UserID = '" . $user_id . "'</h1>";
    echo "<div class = 'tbl-header'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'><thread><tr><th>movie id</th><th>title</th><th>genre</th><th>tagline</th><th>Recommendation scores</th></tr></thread></table>";
    echo "<div class = 'tbl-conteant'>";
    echo "<table cellpadding ='0' cellspacing = '0' border = '0'> <tbody>";
    while ($row = $result->fetch_assoc()) {
      //  echo "<tr><td>". $row["movie_id"] ." ". "<button id='".$i."'>". " add " . "</button>". "</td><td>" . $row["title"]. "</td><td>" .$row["tagline"]. "</td></tr>";
      echo "<tr><td>" . $row["movie_id"] . "</td><td>" . $row["title"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["tagline"] . "</td><td>" . $row["scores"] . "</td>";
  ?>


  <?php
      echo "</tr>";
    }
    echo "</tbody></table></div></section>";
  } else {
    echo "0 results";
  }
  echo "<div class = 'made-with-love'>";
  echo "<br><button id = 'back' class = 'button'>Back</button>";
  echo "<button id = 'logout' class= 'button'>logout</button>";
  echo "</div>";


  $conn->close()

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
    }).resize()
  </script>
</body>

</html>