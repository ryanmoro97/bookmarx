<?php

session_start();
$db_user = "root";
$db_pw = "7r46QGmp";
$server = "localhost";
$db = "bookmarks";
$conn = new mysqli($server, $db_user, $db_pw, $db);

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
    else{
        //username available -- register user
        mysqli_query($conn,"INSERT INTO `login` (`username`, `password`) VALUES ('$username', '$password')");
        setcookie("username", $username);
        header('Location: userpage.php');
        exit;
    }
}





