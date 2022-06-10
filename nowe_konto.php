<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>nowe konto</title>
</head>
<body>
    <form action="./nowe_konto.php" method="post">
        <input type="text" name="login"><br>
        <input type="password" name="haslo"><br>
        <input type="submit" value="nowe konto">
    </form>
    <?php
    session_start();
        if(empty($_POST['login']) || empty($_POST['haslo'])){
            echo "<span style='color: red'>uzupełni pola</span>";
        }else{
            $login = $_POST['login'];
            $haslo = sha1($_POST['haslo']);
            if(strlen($login)>20){
                echo "<span style='color: red'>login ma wiecej niż 20 znaków</span>";
            }else{
                $con = mysqli_connect("localhost","root","","logowanie") or die("błąd połaczenia z bazą");
                $sql = "SELECT login, haslo FROM dane_logowania WHERE login='$login'";
                $dane = mysqli_query($con, $sql);
                $wynik = mysqli_fetch_array($dane);
                $db_login = $wynik['login'];
                if($login == $db_login){
                    echo"<span style='color: red'>ten login jest już zajęty</span>";
                }else{
                    $_SESSION["username"] = $login;
                    $sql = "INSERT INTO `dane_logowania` (`id`, `login`, `haslo`) VALUES (NULL, '$login','$haslo')";
                    if(mysqli_query($con,$sql)){
                        header('Location:strona.php');
                    }else{
                        echo "<span style='color: red'>coś poszło nie tak</span>";
                    }

                }
                mysqli_close($con);
            }
        }
    ?>
</body>
</html>
