<?php

session_start();

if (!isset($_SESSION['save-wycena'])) {
    header('Location: wycena.php');
    exit();
} else {
    unset($_SESSION['save-wycena']);
}

//Usuwanie zmiennych pamiętających wartości wpisane do formularza - dane klienta
if (isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
if (isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
if (isset($_SESSION['fr_adres'])) unset($_SESSION['fr_adres']);
if (isset($_SESSION['fr_nr_tel'])) unset($_SESSION['fr_nr_tel']);
if (isset($_SESSION['fr_id'])) unset($_SESSION['fr_id']);

//Usuwanie błędów  - dane klienta
if (isset($_SESSION['e_imie'])) unset($_SESSION['e_imie']);
if (isset($_SESSION['e_nazwisko'])) unset($_SESSION['e_nazwisko']);
if (isset($_SESSION['e_adres'])) unset($_SESSION['e_adres']);
if (isset($_SESSION['e_nr_tel'])) unset($_SESSION['e_nr_tel']);
if (isset($_SESSION['e_id'])) unset($_SESSION['e_id']);


//Usuwanie zmiennych pamiętających wartości wpisane do formularza - dane sprzętowe
if (isset($_SESSION['fr_sprzet'])) unset($_SESSION['fr_sprzet']);
if (isset($_SESSION['fr_marka'])) unset($_SESSION['fr_marka']);
if (isset($_SESSION['fr_model'])) unset($_SESSION['fr_model']);
if (isset($_SESSION['fr_zestaw'])) unset($_SESSION['fr_zestaw']);
if (isset($_SESSION['fr_opis'])) unset($_SESSION['fr_opis']);

//Usuwanie błędów - dane sprzętowe
if (isset($_SESSION['e_sprzet'])) unset($_SESSION['e_sprzet']);
if (isset($_SESSION['e_marka'])) unset($_SESSION['e_marka']);
if (isset($_SESSION['e_model'])) unset($_SESSION['e_model']);
if (isset($_SESSION['e_zestaw'])) unset($_SESSION['e_zestaw']);
if (isset($_SESSION['e_opis'])) unset($_SESSION['e_opis']);

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

    <div class="pojemnik">
        <div class="pojemnik-napis">
        </div>
        <div class="pojemnik_klient">
            <h2 class="napis-rejestracja">Pomyślnie wprowadzono wycenę</h2>
            <div class="logowanie">
                <a href="klient.php" class="a_button">Dodaj klienta</a>
                <a href="dashboard.php" class="a_button">Panel główny</a>
                <a href="wycena.php" class="a_button">Wycena</a>
                <form action='podsumowanie_wyc.php' method='post'>
                    <input class='nr_wyceny3' name='nr_wyceny' value='<?php echo $_SESSION['fr_nr_wyceny'] ?>' style='display:none'>
                    <input class='klientID3' name='klientID' value='<?php echo $_SESSION['fr_klientID'] ?>' style='display:none'>
                    <!-- <a href="podsumowanie_wyc.php" class="a_button">Podsumowanie</a> -->
                    <input type='submit' class='a_button' value='Podsumowanie wyceny'>
                </form>
            </div>
        </div>
    </div>
</body>

</html>