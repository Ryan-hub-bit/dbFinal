<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html",charset=utf-8>
    </head>
<body>

<h1>assignPage</h1>

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
echo "Connected successfully";

$pagesize = 400;
$sql = "SELECT count(*) from db.mDetail";
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
$sql = "SELECT * FROM db.mDetail order by movie_id desc limit $offset, $pagesize";
$rs = $conn ->query($sql);
if($myrow = $rs->fetch_array(MYSQLI_ASSOC))
{
    $i=0;
    ?>
    <table border = "0" width = "80%">
        <tr>
            <th width = "50%" bgcolor = "#E0E0E0">
                <p align = "center" valign=""> movie_id
            </th>
            <th width = "50%" bgcolor = "#E0E0E0">
                <p align = "center" valign=""> title
            </th>
            <th width = "50%" bgcolor = "#E0E0E0">
                <p align = "center" valign=""> tagline
            </th>
        </tr>
        <?php
            do{
                $i++;
                ?>
                <tr>
                    <th width = "50%"><?=$myrow["movie_id"]?></th>
                    <th width = "50%"><?=$myrow["title"]?></th>
                    <th width = "50%"><?=$myrow["tagline"]?></th>
                </tr>
                <?php
            }
            while($myrow = $rs->fetch_array(MYSQLI_ASSOC));
            echo "</table>";
        }
            echo "<div> total page:".$pages." page(".$page."/".$pages.")";
            $first=1;
            $prev = $page - 1;
            $next = $page + 1;
            $last = $pages;
            if($page > 1) {
                echo "I am in";
                echo "<a href ='assignPage.php?page=".$first."'>First</a>";
                echo "<a href ='assignPage.php?page=".$prev."'> Previous</a>";
            }

            if($page < $pages) {
                echo "<a href ='assignPage.php?page=".$next."'> Next</a>";
                echo "<a href ='assignPage.php?page=".$last."'> Last</a>";

            }
                // for($i = 1; $i < $pages; $i++) {
                //     echo "<a href = 'assignPage.php?page=".$i."'>[".$i."]</a>";
                //     echo "[".$page."]";
                //     for($i = $page + 1; $i <= $pages; $i++)
                //     {
                //          echo "<a href = 'assignPage.php?page=".$i."'>[".$i."]</a>";
                //          echo "</div>";
                //     }
                // }
                    ?>
                
        </body>
        </html>

<!-- 　//计算记录偏移量
　$offset=$pagesize*($page - 1);
　//读取指定记录数
　$rs=mysql_query("select * from myTable order by id desc limit $offset,$pagesize",$conn);
　if ($myrow = mysql_fetch_array($rs))
　{
　　$i=0;
　　?＞
</body>
</html>
＜html＞

＜?php
　$conn=mysql_connect("localhost","root","");
　//设定每一页显示的记录数
　$pagesize=1;
　mysql_select_db("mydata",$conn);
　//取得记录总数$rs，计算总页数用
　$rs=mysql_query("select count(*) from tb_product",$conn);
　$myrow = mysql_fetch_array($rs);
　$numrows=$myrow[0];
　//计算总页数

　$pages=intval($numrows/$pagesize);
　if ($numrows%$pagesize)
　　$pages++;
　//设置页数
　if (isset($_GET['page'])){
　　$page=intval($_GET['page']);
　}
　else{
　　//设置为第一页 
　　$page=1;
　}
　//计算记录偏移量
　$offset=$pagesize*($page - 1);
　//读取指定记录数
　$rs=mysql_query("select * from myTable order by id desc limit $offset,$pagesize",$conn);
　if ($myrow = mysql_fetch_array($rs))
　{
　　$i=0;
　　?＞
　　＜table border="0" width="80%"＞
　　＜tr＞
　　　＜td width="50%" bgcolor="#E0E0E0"＞
　　　　＜p align="center"＞movie_id＜/td＞
　　　　＜td width="50%" bgcolor="#E0E0E0"＞
　　　　＜p align="center"＞发布时间＜/td＞
　　＜/tr＞
　　＜?php
　　　do {
　　　　$i++;
　　　　?＞
　　＜tr＞
　　　＜td width="50%"＞＜?=$myrow["news_title"]?＞＜/td＞
　　　＜td width="50%"＞＜?=$myrow["news_cont"]?＞＜/td＞
　　＜/tr＞
　　　＜?php
　　　}
　　　while ($myrow = mysql_fetch_array($rs));
　　　　echo "＜/table＞";
　　}
　　echo "＜div align='center'＞共有".$pages."页(".$page."/".$pages.")";
　　for ($i=1;$i＜ $page;$i++)
　　　echo "＜a href='fenye.php?page=".$i."'＞[".$i ."]＜/a＞ ";
　　　echo "[".$page."]";
　　　for ($i=$page+1;$i＜=$pages;$i++)
　　　　echo "＜a href='fenye.php?page=".$i."'＞[".$i ."]＜/a＞ ";
　　　　echo "＜/div＞";
　　　?＞
＜/body＞
＜/html＞ -->
