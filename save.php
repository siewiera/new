<?php

session_start();
if (isset($_POST['nazwa'])) {

    require_once 'database.php';

    // $nr_serwisowy = filter_input(INPUT_POST, 'nr_serwisowy');
    $admin = filter_input(INPUT_POST, 'admin');
    $klientID = filter_input(INPUT_POST, 'klientID');
    $data = filter_input(INPUT_POST, 'data');
    $sprzet = filter_input(INPUT_POST, 'sprzet');
    $marka = filter_input(INPUT_POST, 'marka');
    $model = filter_input(INPUT_POST, 'model');
    $zestaw = filter_input(INPUT_POST, 'zestaw');
    $opis_usterki = filter_input(INPUT_POST, 'opis_usterki');
    $nazwa = filter_input(INPUT_POST, 'nazwa');
    $ilosc = filter_input(INPUT_POST, 'ilosc');
    $cena_podz = filter_input(INPUT_POST, 'cena_podz');
    $cena_uslugi = filter_input(INPUT_POST, 'cena_uslugi');
    $marza = filter_input(INPUT_POST, 'marza');
    $rabat = filter_input(INPUT_POST, 'rabat');
    $naleznosc = filter_input(INPUT_POST, 'naleznosc');
    $zysk = filter_input(INPUT_POST, 'zysk');
    $status = filter_input(INPUT_POST, 'status');


    $query = $db->prepare(
        'INSERT INTO wycena VALUES 
    (NULL, :admin, :klientID :data, :sprzet, :marka, :model, :zestaw, :opis_usterki, :nazwa, :ilosc, 
     :cena_podz, :cena_uslugi, :marza, :rabat,:naleznosc, :zysk, :status)'
    );



    // $query->bindValue(':nr_serwisowy', $nr_serwisowy, PDO::PARAM_STR);
    $query->bindValue(':admin', $admin, PDO::PARAM_STR);
    $query->bindValue(':klientID', $klientID, PDO::PARAM_STR);
    $query->bindValue(':data', $data, PDO::PARAM_STR);
    $query->bindValue(':sprzet', $sprzet, PDO::PARAM_STR);
    $query->bindValue(':marka', $marka, PDO::PARAM_STR);
    $query->bindValue(':model', $model, PDO::PARAM_STR);
    $query->bindValue(':zestaw', $zestaw, PDO::PARAM_STR);
    $query->bindValue(':opis_usterki', $opis_usterki, PDO::PARAM_STR);
    $query->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
    $query->bindValue(':ilosc', $ilosc, PDO::PARAM_INT);
    $query->bindValue(':cena_podz', $cena_podz, PDO::PARAM_INT);
    $query->bindValue(':cena_uslugi', $cena_uslugi, PDO::PARAM_INT);
    $query->bindValue(':marza', $marza, PDO::PARAM_INT);
    $query->bindValue(':rabat', $rabat, PDO::PARAM_INT);
    $query->bindValue(':naleznosc', $naleznosc, PDO::PARAM_INT);
    $query->bindValue(':zysk', $zysk, PDO::PARAM_INT);
    $query->bindValue(':status', $status, PDO::PARAM_STR);


    $query->execute();
} else {

    header('Location: test_wycena.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/style_wycena.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodanie serwisu</title>

</head>

<body>

    <div class="tlo"></div>
    <form class="pojemnik">
        <!-- <div class="pojemnik-napis">
            <h1 class="napis-tlo">Quick Serwis</h1>
        </div> -->
        <div class="pojemnik_serwis">
            <h2 class="napis-rejestracja">Pomyślnie wprowadzono wycene</h2>
            <div class="logowanie">
                <a href="wycena.php" class="a_button">Wróć do panelu</a>
            </div>
        </div>
    </form>
</body>

</html>