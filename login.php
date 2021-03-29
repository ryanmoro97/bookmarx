<?php

session_start();
$db_user = "root";
$db_pw = "7r46QGmp";
$server = "bookmarkdb";
$db = "bookmarks";
$conn = new mysqli($server, $db_user, $db_pw, $db);


console_log("starting");
echo mysqli_connect_error();
if ($conn->connect_error) {
    echo "dicks";
}

if(isset($_POST['username'], $_POST['password'])) {
    //check if credentials are entered
    $username = $_POST['username'];
    $password = $_POST['password'];
    $credentials_query = mysqli_query($conn, "SELECT * FROM login WHERE username = '" . $username . "' AND password='" . $password . "' ");
}
else{
    // error, username/pw not set
    $_SESSION['errmsg'] = true;
    header("Location: main.php");
    exit;
}

if(isset($_POST['signIn'])){
    // check login credentials
    if(mysqli_num_rows($credentials_query) == 1){
        // valid - login to user page
        console_log("valid");
        setcookie("username", $username);
        header('Location: userpage.php');
        exit;
    }
    else{
        // invalid - return to main page - display error msg
        $_SESSION['errmsg'] = true;
        header("Location: main.php");
        exit;
    }
}
else if(isset($_POST['signUp'])){
    // check if username is taken .. register user

    $username_taken = mysqli_query($conn, "SELECT * FROM login WHERE username = '" . $username . "' ");
    echo "tites: " . mysqli_num_rows($username_taken) ;
    if(mysqli_num_rows($username_taken) == 1) {
        //username is taken
        $_SESSION['errmsg1'] = true;
        header("Location: main.php");
        exit;
    }
    else if($username == ""){
        $_SESSION['errmsg2'] = true;
        header("Location: main.php");
        exit;
    }
    else if($password == ""){
        $_SESSION['errmsg3'] = true;
        header("Location: main.php");
        exit;
    }
    else{
        //username available -- register user
        mysqli_query($conn,"INSERT INTO `login` (`username`, `password`) VALUES ('$username', '$password')");
        setcookie("username", $username);
        header('Location: userpage.php');
        exit;
    }
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}





