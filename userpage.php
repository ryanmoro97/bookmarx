<html>
<head>
    <title>Bookmarks</title>
    <link rel = "stylesheet" type = "text/css" href = "../shared/styles/styles.css">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src = "user.js"></script>
</body>
    <button id="logout" name="logout">Logout</button>
    <h1>Karl BookMarx</h1>

    <h3 style="text-align: center "> &nbsp;&nbsp;&nbsp;&nbsp;<em><span style='font-size:1.25em;'>W</span></em>elcome <?php echo htmlspecialchars($_COOKIE["username"])?> !
    </h3><hr><br>

    <h3>Your bookmarks</h3>
    <div id = "bm">
    <?php
    session_start();
//    echo "local:" . $_SESSION
    $db_user = "root";
    $db_pw = "7r46QGmp";
    $server = "localhost";
    $db = "bookmarks";
    $username = $_COOKIE['username'];
    $conn = new mysqli($server, $db_user, $db_pw, $db);
    $bookmarks_query = mysqli_query($conn,"SELECT bookmark FROM bookmarks WHERE username = '".$username."'");
    while($row = mysqli_fetch_row($bookmarks_query)){
        foreach ($row as $key => $value){
            echo "<a name = 'bookmark' id = '$value' href = ".$value." target='_blank'><u>$value</u></a><br><br>";
        }
    }
    ?>
    </div>
    <div id="editBookmarks"></div>


    <button id="add">Add</button>
    <button id="edit">Edit</button>
    <div id = "editBtns">
        <div class = "btn"><button id = "editLink">Edit Link</button></div>
        <div class = "btn"><button id = "deleteLink">Delete</button></div>
        <div class = "btn"><button id = "Cancel">Cancel</button></div>
    </div>




</html>

