<?php
session_start();
require_once 'database.php';

$query1 = $db->query('CREATE TABLE IF NOT EXISTS admins (id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
imie VARCHAR(30) NOT NULL,
nazwisko VARCHAR(30) NOT NULL,
nick VARCHAR(30) NOT NULL,
haslo VARCHAR(500) NOT NULL,
email VARCHAR(30) NOT NULL UNIQUE)');
$query1->execute();

$query2 = $db->query('CREATE TABLE IF NOT EXISTS klient (id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
imie VARCHAR(30) NOT NULL,
nazwisko VARCHAR(30) NOT NULL,
adres VARCHAR(30) NOT NULL,
nr_tel INT NOT NULL,vip BOOL)');
$query2->execute();

$query3 = $db->query('CREATE TABLE IF NOT EXISTS wycena (id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
nr_wyceny VARCHAR(30) NOT NULL,
admin INT NOT NULL,
data DATE NOT NULL,
klientID INT NOT NULL,
sprzet VARCHAR(30) NOT NULL,
marka VARCHAR(30) NOT NULL,
model VARCHAR(30) NOT NULL,
zestaw VARCHAR(30) NOT NULL,
opis_usterki VARCHAR(90) NOT NULL,
nazwa VARCHAR(30) NOT NULL,
ilosc INT NOT NULL,
cena_podz INT NOT NULL,
cena_uslugi INT NOT NULL,
marza INT NOT NULL,
marza_zl INT NOT NULL,
rabat INT NOT NULL,
rabat_zl INT NOT NULL,
naleznosc INT NOT NULL,
naleznosc_suma INT NOT NULL,
zysk INT NOT NULL,
zysk_suma INT NOT NULL,
status VARCHAR(30) NOT NULL,
FOREIGN KEY (admin)
REFERENCES admins(id),
FOREIGN KEY (klientID)
REFERENCES klient(id)
)');
$query3->execute();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>

    <style>
        .error {
            position: relative;
        }

        .error-pojemnik {
            width: 400px;
            height: 30px;
            background-color: #a83a3a61;
            position: absolute;
            display: grid;
            justify-content: center;
            align-content: center;
            left: 350px;
            border: 1px solid #ce2a2a;
            border-radius: 12px;
            top: -250px;
            backdrop-filter: blur(10px);
            padding-left: 15px;
            padding-right: 15px;
            margin-left: 20px;
            box-shadow: 5px 5px 10px 5px #0000004f;
            transition: 1s;
        }
    </style>
</head>

<body>
    <div class="tlo"></div>

    <form action="zaloguj.php" method="post" class="form-panel-logowania">
        <!-- <div class="pojemnik-napis">
            <h1 class="napis-tlo">Quick Serwis</h1>
        </div> -->
        <div class="form">
            <div class="pojemnik-naglowek">
                <h2>Quick Serwis</h2>
                <span class="napis-naglowek">Zaloguj się</span>
            </div>
            <div class="pojemnik-input">
                <input class="login-input" type="text" name="login" required />
                <span class="login-span">Login</span>

                <input class="haslo-input" type="password" name="haslo" required />
                <span class="haslo-span">Hasło</span>
            </div>
            <div class="pojemnik-submit">
                <input type="submit" class="login-button" value="Zaloguj się" />

                <a href="rejestracja.php" class="rejestracja-button">Zarejestruj się</a>


                <!-- <?php
                        if (isset($_SESSION['e_email'])) {
                            echo '<div class="error">' .
                                '<div class="error-pojemnik">' . $_SESSION['e_email'] . '</div>' . '</div>';
                            unset($_SESSION['e_email']);
                        }
                        ?> -->

            </div>
            <div class="error">
                <?php
                if (isset($_SESSION['blad'])) echo
                '<div class="error-pojemnik">' . $_SESSION['blad'] . '</div>';
                ?>
            </div>

        </div>
    </form>

</body>

</html>