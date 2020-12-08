<?php
include "session.php";
session_start();
echo "Your user id is: ".$_SESSION['user_id']."<br>";
// $_SESSION['movie_id'] = $_POST['movie_id'];
//  echo "Your movie id is: ".$_SESSION['movie_id']."<br>";
$_SESSION['flag'] = $_POST['flag'];
if($_SESSION['flag'] === 'false') {
  $_SESSION['keyword'] = $_POST['keyword'];
}

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

#movie th, #movie td 
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
if(isset($_POST['add'])) { 
  $movie_id = $_POST['add'];
  // $sql1 = "INSERT INTO db.watchedMovies(user_id,watched_movie_id) "
  $sql1 = sprintf("INSERT INTO db.watchedMovies(user_id,watched_movie_id) VALUES(%d, %d);",$user_id, $movie_id);
  if($conn->query($sql1) === TRUE) {
    echo "add".$movie_id ."successfully"; 
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    // echo "already in your list";
  }
}

$pagesize = 20;
$sql = "SELECT count(*) FROM db.mDetail WHERE title Like '%" .$keyword."%' AND tagline <> ' '";
$rs = $conn ->query($sql);
 $myrow= mysqli_fetch_array($rs);
 $numrow = $myrow[0];
 $pages = intval($numrow/$pagesize);
 if($numrow % $pagesize) {
    $pages++;
 }
   
if(isset($_GET['page'])) {
    $page = intval($_GET['page']);
}
else{
    $page = 1;
}
$offset = $pagesize*($page - 1);

$sql = "SELECT * FROM db.mDetail WHERE title Like '%" .$keyword."%'";
// $sql = "SELECT* FROM db.mDetail";
$rs = $conn ->query($sql);
if($myrow = $rs->fetch_array(MYSQLI_ASSOC))
{
    $i=0;
    ?>
    <table id = 'movie'>
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
        </tr>
        <?php
            do{
                $i++;
                $tmp = $myrow["movie_id"];
                ?>
                <tr>
                 
                    <td><?=$myrow["movie_id"]?></td>
                    <td><?=$myrow["title"]?></td>
                    <td><?=$myrow["tagline"]?></td>
                    <td>
                      <form action="SearchByTitlePages.php?page=<?php echo $page;?>" method="post" >
                    <input value=<?php echo $tmp;?> type = "hidden" name="add"><br>
                    <input type="Submit"  value="add">
                      </form>
                     </td>
                </tr>
                <?php
            }
            while($myrow = $rs->fetch_array(MYSQLI_ASSOC));
            echo "</table>";
        }
        else {
          echo "0 result";
        }

        echo "<div> total page:".$pages." page(".$page."/".$pages.")";
        echo "&nbsp;";
        $first=1;
        $prev = $page - 1;
        $next = $page + 1;
        $last = $pages;
        if($page > 1) {
            echo "<a href ='SearchByTitlePages.php?page=".$first."'>First</a>";
            echo "&nbsp;";
            echo "<a href ='SearchByTitlePages.php?page=".$prev."'> Previous</a>";
            echo "&nbsp";
        }

        if($page < $pages) {
            echo "<a href ='SearchByTitlePages.php?page=".$next."'> Next</a>";
            echo "&nbsp;";
            echo "<a href ='SearchByTitlePages.php?page=".$last."'> Last</a>";
            echo "&nbsp;";

        }
        echo "<button id='back'>Back</button><br>";
        echo "<button id='logout'>logout</button>";
        $conn ->close();
 ?>



<script type="text/javascript">
    document.getElementById("back").onclick = function () {
        location.href = "home.php";
    };
    document.getElementById("logout").onclick = function(){
      location.href = "login.php";
    };
</script>
</body>
</html>