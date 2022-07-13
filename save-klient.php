<?php

session_start();

if (!isset($_SESSION['save_klient'])) {
    header('Location: klient.php');
    exit();
} else {
    unset($_SESSION['save_klient']);
}

//Usuwanie zmiennych pamiętających wartości wpisane do formularza
if (isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
if (isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
if (isset($_SESSION['fr_adres'])) unset($_SESSION['fr_adres']);
if (isset($_SESSION['fr_nr_tel'])) unset($_SESSION['fr_nr_tel']);

//Usuwanie błędów rejestracji
if (isset($_SESSION['e_imie'])) unset($_SESSION['e_imie']);
if (isset($_SESSION['e_nazwisko'])) unset($_SESSION['e_nazwisko']);
if (isset($_SESSION['e_adres'])) unset($_SESSION['e_adres']);
if (isset($_SESSION['e_nr_tel'])) unset($_SESSION['e_nr_tel']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/style_wycena.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodanie klienta</title>

</head>

<body>

    <div class="tlo"></div>

    <form class="pojemnik">
        <div class="pojemnik-napis">
            <!-- <h1 class="napis-tlo">Quick Serwis</h1> -->
        </div>
        <div class="pojemnik_klient">
            <h2 class="napis-rejestracja">Pomyślnie dodano klienta</h2>
            <div class="logowanie">
                <a href="klient.php" class="a_button">Dodaj klienta</a>
                <a href="dashboard.php" class="a_button">Panel główny</a>
                <a href="wycena.php" class="a_button">Wycena</a>
            </div>
        </div>
    </form>
</body>

</html>