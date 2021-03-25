<html lang="en-us">
    <head>
        <title>Bookmarks</title>
        <link rel = "stylesheet" type = "text/css" href = "styles.css">
    </head>
    <body>
    <h1>Karl BookMarx</h1>
    <h3> &nbsp;&nbsp;&nbsp;&nbsp;<em><span style='font-size:1.25em;'>W</span></em>elcome to Karl BookMarx. This site allows you
        to collect bookmarks of your favourite sites. Below is a list of the most
        popular sites visited by our users.<br><br>
        Login to view and manage your personal bookmarks.
    </h3><hr><br>


    <?php
    session_start();
    if (isset($_SESSION['errmsg'])){
        echo '<div id = "errmsg9">Invalid username/password</div>';
    }
    else if(isset($_SESSION['errmsg1'])){
        echo '<div id = "errmsg9">Username is taken</div>';
    }
    ?>


    <form id="login" style="text-align: center" method="post" action="login.php" name = "login">
        <label for="username">Username: </label><input type="text" id="username" name = "username" maxlength="20"
                                                       style="margin-right: 80px; width: 150px; align-content: center; border-radius: 5px; font-size: 12px; border-width: thick; border-color: blueviolet;
                                                       color: rgb(192, 98, 236); font-weight: bold; background-color: rgb(39, 12, 85);"/><br><br>
        <label for="password">Password: </label><input type="password" id="password" name = "password" maxlength="15"
                                                       style="margin-right: 78px;width: 150px; align-content: center; border-radius: 5px; font-size: 12px; border-width: thick; border-color: blueviolet;
                                                       color: rgb(192, 98, 236); font-weight: bold; background-color: rgb(39, 12, 85);"/><br><br>
        <button id="signIn" name="signIn">Sign In</button>
        <button id="signUp" name="signUp">Sign Up</button>
    </form><br>

    <hr><br><br>
    <h3>Top sites</h3>
    <?php
    session_start();
    $db_user = "root";
    $db_pw = "7r46QGmp";
    $server = "localhost";
    $db = "bookmarks";
    $conn = new mysqli($server, $db_user, $db_pw, $db);
    ?>

    <?php unset($_SESSION['errmsg']); unset($_SESSION['errmsg1']); ?>
     </body>
</html>