<html>
<head>
    <title>Bookmarks</title>
    <link rel = "stylesheet" type = "text/css" href = "styles.css">
    <script src = "user.js"></script>
</head>
<body>
    <h1>Karl BookMarx</h1>

    <h3 style="text-align: center "> &nbsp;&nbsp;&nbsp;&nbsp;<em><span style='font-size:1.25em;'>W</span></em>elcome <?php echo htmlspecialchars($_COOKIE["username"])?> !
    </h3><hr><br>

    <h3>Your bookmarks</h3>
    <?php
    session_start();
    $db_user = "root";
    $db_pw = "7r46QGmp";
    $server = "localhost";
    $db = "bookmarks";
    $username = $_COOKIE['YOUR COOKIE NAME'];
    $conn = new mysqli($server, $db_user, $db_pw, $db);
    $bookmarks_query = mysqli_query($conn,"SELECT * FROM bookmarks WHERE username = '".$username."'");
    while($row = mysqli_fetch_row($bookmarks_query)){
        foreach ($row as $key => $value){
            echo "value: " . $value . ".... ";
        }
    }
    ?>
    <div contenteditable="true">Bookmark1</div>
    <div contenteditable="true">Bookmark2</div>
    <div contenteditable="false">Bookmark3</div>
    <div >Bookmark4</div>

    <button id="add">Add</button>
    <button id="edit">Edit</button>
<!-- edit needs to allow deletion -->


</body>
</html>

