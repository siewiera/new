<?php

use function PHPSTORM_META\type;

session_start();
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['imie'])) {

    $wszystko_OK = true;

    $imie = trim(ucwords($_POST['imie']));
    $nazwisko = trim(ucwords($_POST['nazwisko']));
    $adres = trim(ucwords($_POST['adres']));
    $nr_tel = trim($_POST['nr_tel']);
    $vip = $_POST['vip'];

    if ((strlen($imie) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_imie'] = "Wprowadź imię klienta! Min 3 znaki";
    } else {
        $_SESSION['ok_imie'] = "<i class='icon-ok'></i>";
    }

    if ((strlen($nazwisko) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_nazwisko'] = "Wprowadź nazwisko klienta! Min 3 znaki";
    } else {
        $_SESSION['ok_nazwisko'] = "<i class='icon-ok'></i>";
    }

    if ((strlen($adres) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_adres'] = "Wprowadź adres! Min 3 znaki";
    } else {
        $_SESSION['ok_adres'] = "<i class='icon-ok'></i>";
    }

    if (!is_numeric($nr_tel)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else if ((strlen($nr_tel) < 9) || (strlen($nr_tel) > 9)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else {
        $_SESSION['ok_nr_tel'] = "<i class='icon-ok'></i>";
    }

    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwisko;
    $_SESSION['fr_adres'] = $adres;
    $_SESSION['fr_nr_tel'] = $nr_tel;

    if (isset($_POST['vip']) && $_POST['vip'] == 1) {
        $vip = 1;
    } else {
        $vip = 0;
    }


    if ($wszystko_OK == true) {
        require_once 'database.php';

        $imie = filter_input(INPUT_POST, 'imie');
        $nazwisko = filter_input(INPUT_POST, 'nazwisko');
        $adres = filter_input(INPUT_POST, 'adres');
        $nr_tel = filter_input(INPUT_POST, 'nr_tel');
        // $vip = filter_input(INPUT_POST, 'vip');


        $query = $db->prepare('INSERT INTO klient VALUES 
    (NULL, :imie, :nazwisko, :adres, :nr_tel, :vip)');

        $query->bindValue(':imie', $imie, PDO::PARAM_STR);
        $query->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
        $query->bindValue(':adres', $adres, PDO::PARAM_STR);
        $query->bindValue(':nr_tel', $nr_tel, PDO::PARAM_INT);
        $query->bindValue(':vip', $vip, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['save_klient'] = true;
        header('Location: save-klient.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/fontello2/css/fontello.css" />
    <link rel="stylesheet" href="./css/style_klient.css" />
    <title>Wprowadzenie klienta</title>
</head>

<body>
    <div class="tlo"></div>
    <form method="post" class="form_klient">


        <div class="napis_klient">
            <h2>Wprowadzenie klienta</h2>
        </div>

        <!-- <div class="logo">
            <div class="qs"><img src="photo/1.png" style="display: block; margin: auto" /></div>
        </div> -->


        <div class="panel_klient">
            <div class="dane_klienta" id="dane_klienta">
                <div class="naglowek_klient">
                    <h3>Dane klienta</h3>
                </div>
                <div class="klient_label">
                    <input class="imie_label" type="text" name="imie" id="imie" value="<?php
                                                                                        if (isset($_SESSION['fr_imie'])) {
                                                                                            echo $_SESSION['fr_imie'];
                                                                                            unset($_SESSION['fr_imie']);
                                                                                        }
                                                                                        ?>" required>
                    <span class="imie_span">Imię</span>
                    <?php
                    if (isset($_SESSION['e_imie'])) {
                        echo '<div class="error">' .
                            '<div class="error-pojemnik">' . $_SESSION['e_imie'] . '</div>' . '</div>';
                        unset($_SESSION['e_imie']);
                    }
                    if (isset($_SESSION['ok_imie'])) {
                        echo '<div class="ok">' .
                            '<div class="ok-pojemnik">' . $_SESSION['ok_imie'] . '</div>' . '</div>';
                        unset($_SESSION['ok_imie']);
                    }
                    ?>

                </div>
                <div class="klient_label">
                    <input class="nazwisko_label" type="text" name="nazwisko" id="nazwisko" value="<?php
                                                                                                    if (isset($_SESSION['fr_nazwisko'])) {
                                                                                                        echo $_SESSION['fr_nazwisko'];
                                                                                                        unset($_SESSION['fr_nazwisko']);
                                                                                                    }
                                                                                                    ?>" required>
                    <span class="nazwisko_span">Nazwisko</span>
                    <?php
                    if (isset($_SESSION['e_nazwisko'])) {
                        echo '<div class="error">' .
                            '<div class="error-pojemnik">' . $_SESSION['e_nazwisko'] . '</div>' . '</div>';
                        unset($_SESSION['e_nazwisko']);
                    }
                    if (isset($_SESSION['ok_nazwisko'])) {
                        echo '<div class="ok">' .
                            '<div class="ok-pojemnik">' . $_SESSION['ok_nazwisko'] . '</div>' . '</div>';
                        unset($_SESSION['ok_nazwisko']);
                    }
                    ?>

                </div>
                <div class="klient_label">
                    <input class="adres_label" type="text" name="adres" id="adres" value="<?php
                                                                                            if (isset($_SESSION['fr_adres'])) {
                                                                                                echo $_SESSION['fr_adres'];
                                                                                                unset($_SESSION['fr_adres']);
                                                                                            }
                                                                                            ?>" required>
                    <span class="adres_span">Adres</span>
                    <?php
                    if (isset($_SESSION['e_adres'])) {
                        echo '<div class="error">' .
                            '<div class="error-pojemnik">' . $_SESSION['e_adres'] . '</div>' . '</div>';
                        unset($_SESSION['e_adres']);
                    }
                    if (isset($_SESSION['ok_adres'])) {
                        echo '<div class="ok">' .
                            '<div class="ok-pojemnik">' . $_SESSION['ok_adres'] . '</div>' . '</div>';
                        unset($_SESSION['ok_adres']);
                    }
                    ?>

                </div>
                <div class="klient_label">
                    <input class="nr_tel_label" type="text" name="nr_tel" id="nr_tel" value="<?php
                                                                                                if (isset($_SESSION['fr_nr_tel'])) {
                                                                                                    echo $_SESSION['fr_nr_tel'];
                                                                                                    unset($_SESSION['fr_nr_tel']);
                                                                                                }
                                                                                                ?>" required>
                    <span class="nr_tel_span">Nr kontaktowy</span>
                    <?php
                    if (isset($_SESSION['e_nr_tel'])) {
                        echo '<div class="error">' .
                            '<div class="error-pojemnik">' . $_SESSION['e_nr_tel'] . '</div>' . '</div>';
                        unset($_SESSION['e_nr_tel']);
                    }
                    if (isset($_SESSION['ok_nr_tel'])) {
                        echo '<div class="ok">' .
                            '<div class="ok-pojemnik">' . $_SESSION['ok_nr_tel'] . '</div>' . '</div>';
                        unset($_SESSION['ok_nr_tel']);
                    }
                    ?>

                </div>
                <div class="klient_label">
                    <input class="vip_label" type="checkbox" name="vip" id="vip" value='1'>
                    <span class="vip_span">Vip</span>
                </div>
                <input type="submit" class="zapisz_klient" id="zapisz" value="Zapisz">

            </div>

        </div>
    </form>
    <!-- <script src="script.js"></script> -->


</body>

</html>