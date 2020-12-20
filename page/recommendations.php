<?php
include "session.php";
session_start();
echo "Your user id is: " . $_SESSION['user_id'] . "<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
$_SESSION['flag'] = $_POST['flag'];
if ($_SESSION['flag'] === 'false') {
  $_SESSION['keyword'] = $_POST['keyword'];
}

echo "Your keyword is: " . $_SESSION['keyword'] . "<br>";
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


  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";
  $user_id = $_SESSION['user_id'];
  // $keyword = $_SESSION['keyword'];
  if (isset($_POST['delete'])) {
    $movie_id = $_POST['delete'];
    // $sql1 = "INSERT INTO db.watchedMovies(user_id,watched_movie_id) "
    $sql1 = sprintf("DELETE FROM db.watchedMovies where user_id = %d and watched_movie_id = %d;", $user_id, $movie_id);
    if ($conn->query($sql1) === TRUE) {
      echo "" . $movie_id . "successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      // echo "already in your list";
    }
  }

  $pagesize = 10;
  $sql = sprintf("SELECT count(*) FROM db.watchedMovies where user_id = %d;",$user_id);
  $rs = $conn->query($sql);
  $myrow = mysqli_fetch_array($rs);
  $numrow = $myrow[0];
  $pages = intval($numrow / $pagesize);
  if ($numrow % $pagesize) {
    $pages++;
  }

  if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
  } else {
    $page = 1;
  }
  $offset = $pagesize * ($page - 1);

  $sql = sprintf("SELECT db.mDetail.movie_id, db.mDetail.title, db.mDetail.tagline FROM db.watchedMovies,db.mDetail WHERE db.mDetail.movie_id = db.watchedMovies.watched_movie_id AND db.watchedMovies.user_id =%d order by db.watchedMovies.watched_movie_id desc limit %d offset %d;",$user_id,$pagesize, $offset);
  $rs = $conn->query($sql) or die("Error: ".mysqli_error($conn));;
  // $rs = $conn->query($sql);
  if ($myrow = $rs->fetch_array(MYSQLI_ASSOC)) {
    $i = 0;
  ?>
    <section>
    <h1>Favorite List of User'<?php echo $user_id?>'</h1>
    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>Movie_id</th>
            <th>Title</th>
            <th>Tagline</th>
            <th>Delete from your favorite</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
     <tbody>
 
    <?php
    do {
      $i++;
      $tmp = $myrow["movie_id"];
    ?>
 
      <tr>
        <td><?= $myrow["movie_id"] ?></td>
        <td><?= $myrow["title"] ?></td>
        <td><?= $myrow["tagline"] ?></td>
        <td>
          <form action="favorite.php?page=<?php echo $page; ?>" method="post" onsubmit= "setTimeout(function () { window.location.reload(); }, 10)">
            <input value=<?php echo $tmp;?> type="hidden" name="delete"><br>
            <input type="Submit" value="delete">
          </form>
      
        </td>
      </tr>
  <?php
    } while ($myrow = $rs->fetch_array(MYSQLI_ASSOC));
    echo "</tbody></table></div></section>";
  } else {
    echo "0 result";
  }
  echo "<div class = 'made-with-love'>";
  echo "<div> total page:" . $pages . " page(" . $page . "/" . $pages . ")";
  echo "&nbsp;";
  $first = 1;
  $prev = $page - 1;
  $next = $page + 1;
  $last = $pages;
  if ($page > 1) {
    echo "<a href ='favorite.php?page=" . $first . "'>First</a>";
    echo "&nbsp;";
    echo "<a href ='favorite.php?page=" . $prev . "'> Previous</a>";
    echo "&nbsp";
  }

  if ($page < $pages) {
    echo "<a href ='favorite.php?page=" . $next . "'> Next</a>";
    echo "&nbsp;";
    echo "<a href ='favorite.php?page=" . $last . "'> Last</a>";
    echo "&nbsp;";
  }
  echo "<button id='back'>Back</button><br>";
  echo "<button id='logout'>logout</button>";
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
    }).resize()
  </script>
</body>

</html>