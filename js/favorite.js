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