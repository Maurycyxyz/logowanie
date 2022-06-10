<?php
session_start();
$_SESSION["username"];
?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>

        table,td,th{
            border-collapse: collapse;
            border: 1px solid blue;
        }

    </style>
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    $name = $_SESSION["username"];
    echo "jesteś zalogowany jako $name <br>";
        $con = mysqli_connect("localhost","root","","logowanie") or die("błąd połączenia");
        $sql = "SELECT login, haslo FROM dane_logowania";
        $dane = mysqli_query($con,$sql);
        echo"lista użytkowników <br>";
        echo"<table>";
        echo"<th>login</th><th>haslo zaszyfrowane sha1</th>";
        while($wynik = mysqli_fetch_array($dane)){
            $db_login= $wynik['login'];
            $db_haslo= $wynik['haslo'];
            echo"<tr><td>$db_login</td><td>$db_haslo</td></tr>";
        }
        echo "</table>";
        mysqli_close($con);
    ?>
    <br>
    <form method='post' action='stop.php'>
        <input class="logout" type='submit' value='Wyloguj się'/>
    </form>
</body>
</html>
