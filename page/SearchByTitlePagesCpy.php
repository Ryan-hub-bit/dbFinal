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

  $pagesize = 15;
  $sql = "SELECT count(*) FROM db.mDetail WHERE title Like '%" . $keyword . "%' AND tagline <> ' '";
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

  $sql = "SELECT * FROM db.mDetail WHERE title Like '%" . $keyword . "%'";
  // $sql = "SELECT* FROM db.mDetail";
  $rs = $conn->query($sql);
  if ($myrow = $rs->fetch_array(MYSQLI_ASSOC)) {
    $i = 0;
  ?>
    <section>
    <h1>MOVIE LIST WITH KEY = '<?php echo $keyword?>'</h1>
    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>Movie_id</th>
            <th>Title</th>
            <th>Tagline</th>
            <th>add to your favorite</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
     <tbody>
    <!-- <table id = 'movie'>
        <tr>
            <td>
                movie_id
            </td>
            <td>
              title
            </td>
            <td>
               tagline
            </td>
            <td>
              add to your favorite
            </td>
        </tr> -->
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
          <form action="SearchByTitlePagesCpy.php?page=<?php echo $page; ?>" method="post">
            <input value=<?php echo $tmp; ?> type="hidden" name="add"><br>
            <input type="Submit" value="add">
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
    echo "<a href ='SearchByTitlePagesCpy.php?page=" . $first . "'>First</a>";
    echo "&nbsp;";
    echo "<a href ='SearchByTitlePagesCpy.php?page=" . $prev . "'> Previous</a>";
    echo "&nbsp";
  }

  if ($page < $pages) {
    echo "<a href ='SearchByTitlePagesCpy.php?page=" . $next . "'> Next</a>";
    echo "&nbsp;";
    echo "<a href ='SearchByTitlePagesCpy.php?page=" . $last . "'> Last</a>";
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