<?php
include "session.php";
session_start();
echo "Your user id is: ".$_SESSION['user_id']."<br>";
$_SESSION['keyword'] = $_POST['keyword'];
echo "Your keyword is: ".$_SESSION['keyword']."<br>";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html",charset=utf-8>
        <title> Movie List </title>
    </head>
<body>

<h1>Movie List</h1>
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

// echo "<script type='text/javascript'>history.go(-1)</script>";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

$keyword = $_SESSION['keyword'];
$pagesize = 15;
// need to write PL/sql
$sql = "SELECT count(*) from db.mDetail WHERE tagline <> ''";
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
// $rs = mysqli_query("SELECT  * FROM mDetail order by movie_id desc limit $offset, $pagesize");
$sql = "SELECT * FROM db.mDetail WHERE tagline <> '' order by movie_id asc limit $offset, $pagesize";
$rs = $conn ->query($sql);
if($myrow = $rs->fetch_array(MYSQLI_ASSOC))
{
    $i=0;
    ?>
    <table id = 'movie'>
        <tr>
            <th>
                movie_id
            </th>
            <th>
              title
            </th>
            <th>
               tagline
            </th>
        </tr>
        <?php
            do{
                $i++;
                ?>
                <tr>
                    <th><?=$myrow["movie_id"]?></th>
                    <th><?=$myrow["title"]?></th>
                    <th><?=$myrow["tagline"]?></th>
                </tr>
                <?php
            }
            while($myrow = $rs->fetch_array(MYSQLI_ASSOC));
            echo "</table>";
        }
            echo "<div> total page:".$pages." page(".$page."/".$pages.")";
            echo "&nbsp;";
            $first=1;
            $prev = $page - 1;
            $next = $page + 1;
            $last = $pages;
            if($page > 1) {
                echo "<a href ='assignPage.php?page=".$first."'>First</a>";
                echo "&nbsp;";
                echo "<a href ='assignPage.php?page=".$prev."'> Previous</a>";
                echo "&nbsp";
            }

            if($page < $pages) {
                echo "<a href ='assignPage.php?page=".$next."'> Next</a>";
                echo "&nbsp;";
                echo "<a href ='assignPage.php?page=".$last."'> Last</a>";
                echo "&nbsp;";

            }
                    ?>
                
        </body>
        </html>

