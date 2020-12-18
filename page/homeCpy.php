<?php
include "session.php";
session_start();
if ($_POST['user_id'] != '' || $_POST['user_id'] != null) {
    $_SESSION['user_id'] = $_POST['user_id'];
}
echo "Welcome to Umovie, User " . $_SESSION['user_id'];
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-rjs lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DashBoard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/home.css" rel="stylesheet">
</head>

<body>
    <div id="d1" class="container">
        <nav class="menu">
            <ul class="main-menu">
                <li class="active"><i class="fa fa-home"></i>Home</li>
                <li class="with-submenu">
                    <i class="fa fa-briefcase"></i>Searching<i class="fa fa-caret-down"></i>
                    <ul class="submenu">
                        <li id="movieID">ByMovieID</li>
                        <li id="movieTitle">ByMovieTitle</li>
                        <li id="movieCondition">ByMovieCondition</li>
                    </ul>
                </li>
                <li><i class="fa fa-user"></i>Favorite List</li>
                <li>Recommendation</li>
                <!-- <li>Logout</li> -->
            </ul>
        </nav>
    </div>

</body>
<script type="text/javascript">
    document.getElementById("movieID").onclick = function() {
        var element = document.getElementById("d1");
        element.removeChild(element.lastChild);
        var head = document.createElement("h1");
        var node = document.createTextNode("ENTER MOVIE_ID");
        head.appendChild(node);
        var div = document.createElement("div");
        div.className = "search";
         div.appendChild(head);
        var f = document.createElement("form");
        f.setAttribute('id', "f1");
        f.setAttribute('method', "post");
        f.setAttribute('action', "SearchByIdCpy.php");

        var l = document.createElement("label");
        l.setAttribute('for', "search");
        l.setAttribute('value', "search BY mid");

        var i = document.createElement("input");
        i.setAttribute('id', "search");
        i.setAttribute('type', "search");
        i.setAttribute('placeholder', "Search.......");
        i.setAttribute('autoFocus', "requrired");
        i.setAttribute('name', "movie_id")


        var s = document.createElement("input");
        s.setAttribute('type', "submit");
        s.setAttribute('id', 's1');
        s.setAttribute('name', "submit");
        s.setAttribute('value', "Go")
        // s.setAttribute('onclick', "searchByID");
        // s.setAttribute('name', "Go");

        // var i = document.createElement("input"); //input element, text
        // i.setAttribute('type', "text");
        // i.setAttribute('name', "username");
        // i.setAttribute('placeholder',"Search")

        // var s = document.createElement("input"); //input element, Submit button
        // s.setAttribute('type', "submit");
        // s.setAttribute('value', "Submit");
        f.appendChild(l);
        f.appendChild(i);
        f.appendChild(s);
        div.appendChild(head);
        div.appendChild(f);
        element.appendChild(div);
        // element.removeChild(element.lastChild);
    };
    document.getElementById("movieTitle").onclick = function() {
        var element = document.getElementById("d1");
        element.removeChild(element.lastChild);
        // element.removeChild(element.lastChild);
        var head = document.createElement("h1");
        var node = document.createTextNode("ENTER MOVIE_TITLE");
        head.appendChild(node);
        var div = document.createElement("div");
        div.className = "search";
         div.appendChild(head);
        var f = document.createElement("form");
        f.setAttribute('id', "f2");
        f.setAttribute('method', "post");
        f.setAttribute('action', "SearchByTitlePagesCpy.php?page=1");

        var l = document.createElement("label");
        l.setAttribute('for', "search");
        l.setAttribute('value', "search BY mid");

        var i = document.createElement("input");
        i.setAttribute('id', "search");
        i.setAttribute('type', "text");
        i.setAttribute('placeholder', "Search.......");
        i.setAttribute('autoFocus', "requrired");
        i.setAttribute('name', "keyword")
        
        var flag = document.createElement("input");
        flag.setAttribute('type',"hidden");
        flag.setAttribute('value',"false");
        flag.setAttribute('name', "flag");


        var s = document.createElement("input");
        s.setAttribute('type', "submit");
        s.setAttribute('id', 's1');
        s.setAttribute('name', "submit");
        s.setAttribute('value', "Go")
        // s.setAttribute('onclick', "searchByID");
        // s.setAttribute('name', "Go");

        // var i = document.createElement("input"); //input element, text
        // i.setAttribute('type', "text");
        // i.setAttribute('name', "username");
        // i.setAttribute('placeholder',"Search")

        // var s = document.createElement("input"); //input element, Submit button
        // s.setAttribute('type', "submit");
        // s.setAttribute('value', "Submit");
        f.appendChild(l);
        f.appendChild(i);
        f.appendChild(s);
        f.appendChild(flag);
        div.appendChild(head);
        div.appendChild(f);
        element.appendChild(div);
    };
    // document.getElementById("favoriteList").onclick = function () {
    //     location.href = "test.php";
    // };
    // document.getElementById("recommendationList").onclick = function () {
    //     location.href = "test.php";
    // };
    // document.getElementById("back").onclick =function() {
    //     location.href = "login.php";
    // };
    // document.getElementById("logout").onclick =function() {
    //     location.href = "login.php";
    // };
</script>

</html>