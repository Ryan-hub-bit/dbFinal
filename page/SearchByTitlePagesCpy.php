<?php
include "session.php";
session_start();
// echo "Your user id is: " . $_SESSION['user_id'] . "<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
$_SESSION['flag'] = $_POST['flag'];
if ($_SESSION['flag'] === 'false') {
  $_SESSION['keyword'] = $_POST['keyword'];
}

// echo "Your keyword is: " . $_SESSION['keyword'] . "<br>";
?>

<head>
  <link rel="stylesheet" href="/css/SearchByTitle.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
  <link rel="stylesheet" href="minfile/quantumalert.css" />
  <script src="minfile/quantumalert.js"></script>
  <title> Movie List </title>
</head>

<body>

  <?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "rootroot";
  $db = "db";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password,$db);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // echo "Connected successfully";
  $user_id = $_SESSION['user_id'];
  $keyword = $_SESSION['keyword'];
  if (isset($_POST['add'])) {
    $movie_id = $_POST['add'];

    // $sql1 = "INSERT INTO db.watchedMovies(user_id,watched_movie_id) "
    // $sql1 = sprintf("INSERT INTO watchedMovies(user_id,watched_movie_id) VALUES(%d, %d);", $user_id, $movie_id);
    if ($conn->query("Call AddFavorite('".$user_id."',$movie_id)") === True) {
      echo "<h1>Add   " . $movie_id . "    successfully</h1>";
    } else {
      // echo "Error: " . $sql . "<br>" . $conn->error;
      echo "<h1> ". $movie_id . "    Already in your favorite list</h1> ";
      // echo "already in your list";
    }
  }

  $pagesize = 15;
  $sql = "SELECT count(*) FROM mDetail WHERE title Like '%" . $keyword . "%' AND tagline <> ''";
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

  // $sql = sprintf("SELECT * FROM db.mDetail WHERE title Like '%%%s%%' order by movie_id desc limit %d offset %d;", $keyword, $pagesize, $offset);
  // $sql = "SELECT * FROM db.mDetail WHERE title Like '%" . $keyword . "%'";

  // $sql = "SELECT* FROM db.mDetail";
  
  $rs = $conn->query("CALL SearchByTitle('".$keyword."',$pagesize,'".$offset."')");
  if ($myrow = $rs->fetch_array(MYSQLI_ASSOC)) {
    $i = 0;
  ?>
    <section>
      <h1>MOVIE LIST WITH KEY = '<?php echo $keyword ?>'</h1>
      <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>Movie id</th>
              <th>Title</th>
              <th>Tagline</th>
              <th>Genres</th>
              <th>add to favorite</th>
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
                <td><?= $myrow["genre"] ?></td>
                <td>
                  <form id="f2" action="SearchByTitlePagesCpy.php?page=<?php echo $page; ?>" method="post" target="framename"> 
                    <input value=<?php echo $tmp; ?> type="hidden" name="add"><br>
                    <input type="Submit" value="add">
                    
                    <!-- <button type="submit" value="add2" onclick="SendForm()"/> -->
                  </form>
                  <iframe name='frameFile' style='display: none;'></iframe>
                </td>
              </tr>
          <?php
            } while ($myrow = $rs->fetch_array(MYSQLI_ASSOC));
            echo "</tbody></table></div></section>";
          } else {
            echo "0 result";
          }
          // sleep(1);
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

</html>