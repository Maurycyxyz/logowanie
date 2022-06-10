<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>logowanie</title>
</head>
<body>
    <form action="index.php" method="post">
        login: <input type="text" name="login"> <br>
        hasło: <input type="password" name="haslo"> <br>
        <input type="submit" value="zaloguj">
    </form>
    <?php
    session_start();
        if(empty($_POST['login']) || empty($_POST['haslo'])){
            echo "<span style='color: red'>uzupełni pola</span>";
        }else{
            $login = $_POST['login'];
            $haslo = sha1($_POST['haslo']);
            $_SESSION["username"] = $login;
            $con = mysqli_connect("localhost","root","","logowanie") or die("błąd połaczenia z bazą");
            $sql = "SELECT login, haslo FROM dane_logowania WHERE login='$login'";
            $dane = mysqli_query($con, $sql);
            $wynik = mysqli_fetch_array($dane);
            $db_login = $wynik['login'];
            $db_haslo = $wynik['haslo'];
            if($login == $db_login && $haslo==$db_haslo){
                header('Location:strona.php');
            }else{
                echo "<span style='color: red'>coś poszło nie tak</span>";
            }
            mysqli_close($con);
        }
    ?>
</body>
</html>