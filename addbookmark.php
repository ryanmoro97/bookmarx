<?php
$db_user = "root";
$db_pw = "7r46QGmp";
$server = "bookmarkdb";
$db = "bookmarks";
$username = $_COOKIE['username'];
if(isset($_POST['bookmark'])){
    $bookmark = $_POST['bookmark'];
    $conn = new mysqli($server, $db_user, $db_pw, $db);
    $bookmarks_query = mysqli_query($conn,"INSERT INTO `bookmarks` (`username`, `bookmark`) VALUES ('$username', '$bookmark')");
    echo "submitted";
}
else{
    echo "invalid bookmark";
}





