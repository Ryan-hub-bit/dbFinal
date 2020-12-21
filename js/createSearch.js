<script type="text/javascript">
    document.getElementById("movieID").onclick = function() {
        var element = document.getElementById("d1");
        element.removeChild(element.lastChild);
        element.removeChild(element.lastChild);
        var head = document.createElement("h1");
        var node = document.createTextNode("ENTER MOVIE ID");
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
        element.removeChild(element.lastChild);
        var head = document.createElement("h1");
        var node = document.createTextNode("ENTER MOVIE TITLE");
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
        i.setAttribute('type', "search");
        i.setAttribute('placeholder', "Search.......");
        i.setAttribute('autoFocus', "requrired");
        i.setAttribute('name', "keyword")


        var flag = document.createElement("input");
        flag.setAttribute('type', "hidden");
        flag.setAttribute('value', "false");
        flag.setAttribute('name', "flag");
        flag.setAttribute('id', "flag")


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
    document.getElementById("generalSearch").onclick = function() {


        var element = document.getElementById("d1");
        element.removeChild(element.lastChild);
        // element.removeChild(element.lastChild);
        var f = document.createElement("form");
        f.setAttribute('id', "f3");
        f.setAttribute('method', "post");
        f.setAttribute('action', "homeCpy.php");
        // var info = document.getElementById("drop2").val();
        // var str;
        // if (document.getElementById('drop2') != null) {
        //     str = document.getElementById("drop2").value;
        // }
        // if (str === "Economy") {
        //     f.setAttribute('action', "");
        // } else if (str == "Detail") {
        //     alert("fdsfa");
        //     f.setAttribute('action', "SearchByTitlePagesCpy.php?page=1");
        // } else if (str === "Type") {
        //     location.href = "favorite.php?page=1";
        // } else if (str === "Rating") {
        //     location.href = "favorite.php?page=1";
        // }

        var head = document.createElement("h1");
        var node = document.createTextNode("GENERAL SEARCH");
        head.appendChild(node);

        var div1 = document.createElement("div");
        div1.className = "row";
        div1.appendChild(head);


        var l = document.createElement("label");
        l.setAttribute('for', "keyword");
        l.setAttribute('value', "search BY mid");
        l.innerHTML = "Keyword:";

        var flag = document.createElement("input");
        flag.setAttribute('type', "hidden");
        flag.setAttribute('value', "false");
        flag.setAttribute('name', "flag");

        var divl1 = document.createElement("div");
        divl1.className = "col-25";
        divl1.appendChild(l);

        var i = document.createElement("input");
        i.setAttribute('id', "keyword");
        i.setAttribute('type', "search");
        i.setAttribute('placeholder', "Search.......");
        i.setAttribute('autoFocus', "requrired");
        i.setAttribute('name', "keyword");

        var divI1 = document.createElement("div");
        divI1.className = "col-75";
        divI1.appendChild(i);


        var div2 = document.createElement("div");
        div2.className = "row";
        div2.appendChild(divl1);
        div2.appendChild(divI1);
        div2.appendChild(flag);

        var ll = document.createElement("label");
        ll.setAttribute('for', "drop1");
        ll.setAttribute('value', "search BY mid");
        ll.innerHTML = "Genres:";

        var divl2 = document.createElement("div");
        divl2.className = "col-25";
        divl2.appendChild(ll);

        var d = document.createElement("input");
        d.setAttribute('type', 'search');
        d.setAttribute('list', "genres");
        d.setAttribute('name', "drop1");
        d.setAttribute('id', "drop1");


        var datalist = document.createElement("datalist");
        datalist.setAttribute('id', "genres");

        var option1 = document.createElement("option");
        option1.setAttribute('value', "Crime")

        var option2 = document.createElement("option");
        option2.setAttribute('value', "Action")

        var option3 = document.createElement("option");
        option3.setAttribute('value', "Comedy")

        var option4 = document.createElement("option");
        option4.setAttribute('value', "Drama")

        var option5 = document.createElement("option");
        option5.setAttribute('value', "War")

        datalist.appendChild(option1);
        datalist.appendChild(option2);
        datalist.appendChild(option3);
        datalist.appendChild(option4);
        datalist.appendChild(option5);

        var divI2 = document.createElement("div");
        divI2.className = "col-75";
        divI2.appendChild(d);
        divI2.appendChild(datalist);

        var div3 = document.createElement("div");
        div3.className = "row";
        div3.appendChild(divl2);
        div3.appendChild(divI2);

        var checkBox = document.createElement("input");
        checkBox.setAttribute('type', "checkbox");
        checkBox.setAttribute('id', "adult");
        checkBox.setAttribute('name', "adult");

        var label = document.createElement("label");
        label.setAttribute('for', "adult");
        label.setAttribute('value', "search BY mid");
        label.textContent = "Adult Movies";

        var div4 = document.createElement("div");
        div4.className = "row";
        div4.appendChild(checkBox);
        div4.appendChild(label);

        var l2 = document.createElement("label");
        l2.setAttribute('for', "runtime");
        l2.setAttribute('value', "search BY mid");
        l2.innerHTML = "Runtime(upper limit):";

        var divl3 = document.createElement("div");
        divl3.className = "col-40";
        divl3.appendChild(l2);

        var runTime = document.createElement("input");
        runTime.setAttribute('type', "text");
        runTime.setAttribute('id', "runtime");
        runTime.setAttribute('name', "runtime");

        var divI3 = document.createElement("div");
        divI3.className = "col-50";
        divI3.appendChild(runTime);

        // var l3 = document.createElement("label");
        // l3.setAttribute('for', "runTime");
        // l3.setAttribute('value', "runTIme");
        // l3.innerHTML = "Below";

        // var divl4 = document.createElement("div");
        // divl4.className = "col-25";
        // divl4.appendChild(l3);

        var div5 = document.createElement("div");
        div5.className = "row";
        div5.appendChild(divl3);
        div5.appendChild(divI3);
        //  div5.appendChild(divl4);
        var l4 = document.createElement("label");
        l4.setAttribute('for', "runTime");
        l4.setAttribute('value', "runTime");
        l4.textContent = "Please select the information you want to see:";

        var drop = document.createElement("input");
        drop.setAttribute('type', "text");
        drop.setAttribute('list', "info");
        drop.setAttribute('name', "drop2");
        drop.setAttribute('id', "drop2");

        var datalist2 = document.createElement("datalist");
        datalist2.setAttribute('id', "info");

        var option5 = document.createElement("option");
        option5.setAttribute('value', "Economy")

        var option6 = document.createElement("option");
        option6.setAttribute('value', "Detail")

        // var option7 = document.createElement("option");
        // option7.setAttribute('value',"Type")

        var option8 = document.createElement("option");
        option8.setAttribute('value', "Rating")


        datalist2.appendChild(option5);
        datalist2.appendChild(option6);
        // datalist2.appendChild(option7);
        datalist2.appendChild(option8);

        var div6 = document.createElement("div");
        div6.className = "row";
        div6.appendChild(l4);
        div6.appendChild(drop);
        div6.appendChild(datalist2);




        var s = document.createElement("input");
        s.setAttribute('type', "submit");
        // s.setAttribute('id', 's1');
        s.setAttribute('name', "submit");
        s.setAttribute('value', "Go");

        var div7 = document.createElement("div");
        div7.className = "row";
        div7.appendChild(s);
        // s.setAttribute('onclick', "searchByID");
        // s.setAttribute('name', "Go");

        // var i = document.createElement("input"); //input element, text
        // i.setAttribute('type', "text");
        // i.setAttribute('name', "username");
        // i.setAttribute('placeholder',"Search")

        // var s = document.createElement("input"); //input element, Submit button
        // s.setAttribute('type', "submit");
        // s.setAttribute('value', "Submit");
        var div = document.createElement("div")
        div.className = "search"
        div.appendChild(div6);
        div.appendChild(div1);
        div.appendChild(div2);
        div.appendChild(div3);
        div.appendChild(div4);
        div.appendChild(div5);

        div.appendChild(div7); // f.appendChild(checkBox);
        f.appendChild(div);
        // var divTotal = document.createElement("div");
        // divTotal.className = "search";
        // divTotal.append(div5);
        // divTotal.append(div6);
        // divTotal.appendChild(f);
        element.appendChild(f);
        // element.removeChild(element.lastChild);
    };
    document.getElementById("fList").onclick = function() {
        // alert("okay");
        location.href = "favorite.php?page=1";
    };
    document.getElementById("RList").onclick = function() {
        // alert("okay");
        location.href = "recommendations.php";
    };
</script>