<?php
session_start();

if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}
require_once 'database.php';

$klientQuery = $db->query('SELECT * FROM klient');
$klient = $klientQuery->fetchAll();

$nr_serw = $db->query('SELECT *FROM wycena');
$serw = $nr_serw->fetchAll();

if (isset($_POST['nazwisko'])) {

    $wszystko_OK = true;
    $id = trim($_POST['klientID']);
    $imie = trim(ucwords($_POST['imie']));
    $nazwisko = trim(ucwords($_POST['nazwisko']));
    $adres = trim(ucwords($_POST['adres']));
    $nr_tel = trim($_POST['nr_tel']);
    $vip = trim($_POST['vip']);


    if (!is_numeric($id)) {
        $wszystko_OK = false;
        $_SESSION['e_id'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_id2'] = "Wprowadź numer id klienta! Min 1 znak";
    } else if ((strlen($id) < 1)) {
        $wszystko_OK = false;
        $_SESSION['e_id'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_id2'] = "Wprowadź numer id klienta! Min 1 znak";
    } else {
        $_SESSION['ok_id'] = "<i class='icon-ok'></i>";
    }

    if ((strlen($imie) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_imie'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_imie2'] = "Wprowadź imię klienta! Min 3 znaki";
    } else {
        $_SESSION['ok_imie'] = "<i class='icon-ok'></i>";
    }

    if ((strlen($nazwisko) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_nazwisko'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_nazwisko2'] = "Wprowadź nazwisko klienta! Min 3 znaki";
    } else {
        $_SESSION['ok_nazwisko'] = "<i class='icon-ok'></i>";
    }

    if ((strlen($adres) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_adres'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_adres2'] = "Wprowadź adres! Min 3 znaki";
    } else {
        $_SESSION['ok_adres'] = "<i class='icon-ok'></i>";
    }

    if (!is_numeric($nr_tel)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_nr_tel2'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else if ((strlen($nr_tel) < 9) || (strlen($nr_tel) > 9)) {
        $wszystko_OK = false;
        $_SESSION['e_nr_tel'] = "<i class='icon-attention-alt'></i>";
        $_SESSION['e_nr_tel2'] = "Błędny nr telefonu! Nr składa się z 9 cyfr";
    } else {
        $_SESSION['ok_nr_tel'] = "<i class='icon-ok'></i>";
    }

    $_SESSION['fr_id'] = $id;
    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwisko;
    $_SESSION['fr_adres'] = $adres;
    $_SESSION['fr_nr_tel'] = $nr_tel;
    $_SESSION['fr_vip'] = $vip;

    if (isset($_POST['marka'])) {

        $sprzet = trim(ucwords($_POST['sprzet']));
        $marka = trim(ucwords($_POST['marka']));
        $model = trim(ucwords($_POST['model']));
        $zestaw = trim(ucwords($_POST['zestaw']));
        $opis = trim($_POST['opis_usterki']);

        if ((strlen($sprzet) < 3)) {
            $wszystko_OK = false;
            $_SESSION['e_sprzet'] = "<i class='icon-attention-alt'></i>";
            $_SESSION['e_sprzet2'] = "Wprowadź naprawiany sprzęt! Min 3 znaki";
        } else {
            $_SESSION['ok_sprzet'] = "<i class='icon-ok'></i>";
        }

        if ((strlen($marka) < 3)) {
            $wszystko_OK = false;
            $_SESSION['e_marka'] = "<i class='icon-attention-alt'></i>";
            $_SESSION['e_marka2'] = "Wprowadź markę sprzętu! Min 3 znaki";
        } else {
            $_SESSION['ok_marka'] = "<i class='icon-ok'></i>";
        }

        if ((strlen($model) < 3)) {
            $wszystko_OK = false;
            $_SESSION['e_model'] =
                "<i class='icon-attention-alt'></i>";
            $_SESSION['e_model2'] = "Wprowadź model sprzętu! Min 3 znaki";
        } else {
            $_SESSION['ok_model'] = "<i class='icon-ok'></i>";
        }

        if ((strlen($zestaw) < 3)) {
            $wszystko_OK = false;
            $_SESSION['e_zestaw'] = "<i class='icon-attention-alt'></i>";
            $_SESSION['e_zestaw2'] = "Wprowadź dołączone przedmioty! Min 3 znaki";
        } else {
            $_SESSION['ok_zestaw'] = "<i class='icon-ok'></i>";
        }

        if ((strlen($opis) < 3)) {
            $wszystko_OK = false;
            $_SESSION['e_opis'] = "<i class='icon-attention-alt'></i>";
            $_SESSION['e_opis2'] = "Wprowadź opis usterki! Min 3 znaki";
        } else {
            $_SESSION['ok_opis'] = "<i class='icon-ok'></i>";
        }

        //dane sprzętowe
        $_SESSION['fr_sprzet'] = $sprzet;
        $_SESSION['fr_marka'] = $marka;
        $_SESSION['fr_model'] = $model;
        $_SESSION['fr_zestaw'] = $zestaw;
        $_SESSION['fr_opis'] = $opis;

        $nr_wyceny = filter_input(INPUT_POST, 'nr_wyceny');
        $admin = $_SESSION['id'];
        $klientID = filter_input(INPUT_POST, 'klientID');
        $data = filter_input(INPUT_POST, 'data');
        $sprzet = filter_input(INPUT_POST, 'sprzet');
        $marka = filter_input(INPUT_POST, 'marka');
        $model = filter_input(INPUT_POST, 'model');
        $zestaw = filter_input(INPUT_POST, 'zestaw');
        $opis_usterki = filter_input(INPUT_POST, 'opis_usterki');
        // suma naleznosci wyceny
        $naleznosc_suma = $_POST['naleznosc_suma'];
        // suma zysku wyceny
        $zysk_suma = $_POST['zysk_suma'];


        // zmienna sesyjna nr wyceny
        $_SESSION['fr_nr_wyceny'] = $nr_wyceny;
        // zmienna sesyjna klientID
        $_SESSION['fr_klientID'] = $klientID;

        //dane płatnościowe 1

        $nazwa1 = $_POST['nazwa1'];
        $ilosc1 = $_POST['ilosc1'];
        $cena_podz1 = $_POST['cena_podz1'];
        $cena_uslugi1 = $_POST['cena_uslugi1'];
        $marza1 = $_POST['marza1'];
        $marza_zl1 = $_POST['marza_zl1'];
        $rabat1 = $_POST['rabat1'];
        $rabat_zl1 = $_POST['rabat_zl1'];
        $naleznosc1 = $_POST['naleznosc1'];
        $zysk1 = $_POST['zysk1'];
        $status1 = $_POST['status1'];

        $_SESSION['fr_nazwa1'] = $nazwa1;
        $_SESSION['fr_ilosc1'] = $ilosc1;
        $_SESSION['fr_cena_podz1'] = $cena_podz1;
        $_SESSION['fr_cena_uslugi1'] = $cena_uslugi1;
        $_SESSION['fr_marza1'] = $marza1;
        $_SESSION['fr_marza_zl1'] = $marza_zl1;
        $_SESSION['fr_rabat1'] = $rabat1;
        $_SESSION['fr_rabat_zl1'] = $rabat_zl1;
        $_SESSION['fr_naleznosc1'] = $naleznosc1;
        $_SESSION['fr_zysk1'] = $zysk1;
        $_SESSION['fr_status1'] = $status1;

        if (isset($_POST['nazwa2'])) {
            //dane płatnościowe 2

            $nazwa2 = $_POST['nazwa2'];
            $ilosc2 = $_POST['ilosc2'];
            $cena_podz2 = $_POST['cena_podz2'];
            $cena_uslugi2 = $_POST['cena_uslugi2'];
            $marza2 = $_POST['marza2'];
            $marza_zl2 = $_POST['marza_zl2'];
            $rabat2 = $_POST['rabat2'];
            $rabat_zl2 = $_POST['rabat_zl2'];
            $naleznosc2 = $_POST['naleznosc2'];
            $zysk2 = $_POST['zysk2'];
            $status2 = $_POST['status2'];

            $_SESSION['fr_nazwa2'] = $nazwa2;
            $_SESSION['fr_ilosc2'] = $ilosc2;
            $_SESSION['fr_cena_podz2'] = $cena_podz2;
            $_SESSION['fr_cena_uslugi2'] = $cena_uslugi2;
            $_SESSION['fr_marza2'] = $marza2;
            $_SESSION['fr_marza_zl2'] = $marza_zl2;
            $_SESSION['fr_rabat2'] = $rabat2;
            $_SESSION['fr_rabat_zl2'] = $rabat_zl2;
            $_SESSION['fr_naleznosc2'] = $naleznosc2;
            $_SESSION['fr_zysk2'] = $zysk2;
            $_SESSION['fr_status2'] = $status2;
        }

        if (isset($_POST['nazwa3'])) {
            //dane płatnościowe 3
            $nazwa3 = $_POST['nazwa3'];
            $ilosc3 = $_POST['ilosc3'];
            $cena_podz3 = $_POST['cena_podz3'];
            $cena_uslugi3 = $_POST['cena_uslugi3'];
            $marza3 = $_POST['marza3'];
            $marza_zl3 = $_POST['marza_zl3'];
            $rabat3 = $_POST['rabat3'];
            $rabat_zl3 = $_POST['rabat_zl3'];
            $naleznosc3 = $_POST['naleznosc3'];
            $zysk3 = $_POST['zysk3'];
            $status3 = $_POST['status3'];

            $_SESSION['fr_nazwa3'] = $nazwa3;
            $_SESSION['fr_ilosc3'] = $ilosc3;
            $_SESSION['fr_cena_podz3'] = $cena_podz3;
            $_SESSION['fr_cena_uslugi3'] = $cena_uslugi3;
            $_SESSION['fr_marza3'] = $marza3;
            $_SESSION['fr_marza_zl3'] = $marza_zl3;
            $_SESSION['fr_rabat3'] = $rabat3;
            $_SESSION['fr_rabat_zl3'] = $rabat_zl3;
            $_SESSION['fr_naleznosc3'] = $naleznosc3;
            $_SESSION['fr_zysk3'] = $zysk3;
            $_SESSION['fr_status3'] = $status3;
        }

        if (isset($_POST['nazwa4'])) {
            //dane płatnościowe 4
            $nazwa4 = $_POST['nazwa4'];
            $ilosc4 = $_POST['ilosc4'];
            $cena_podz4 = $_POST['cena_podz4'];
            $cena_uslugi4 = $_POST['cena_uslugi4'];
            $marza4 = $_POST['marza4'];
            $marza_zl4 = $_POST['marza_zl4'];
            $rabat4 = $_POST['rabat4'];
            $rabat_zl4 = $_POST['rabat_zl4'];
            $naleznosc4 = $_POST['naleznosc4'];
            $zysk4 = $_POST['zysk4'];
            $status4 = $_POST['status4'];

            $_SESSION['fr_nazwa4'] = $nazwa4;
            $_SESSION['fr_ilosc4'] = $ilosc4;
            $_SESSION['fr_cena_podz4'] = $cena_podz4;
            $_SESSION['fr_cena_uslugi4'] = $cena_uslugi4;
            $_SESSION['fr_marza4'] = $marza4;
            $_SESSION['fr_marza_zl4'] = $marza_zl4;
            $_SESSION['fr_rabat4'] = $rabat4;
            $_SESSION['fr_rabat_zl4'] = $rabat_zl4;
            $_SESSION['fr_naleznosc4'] = $naleznosc4;
            $_SESSION['fr_zysk4'] = $zysk4;
            $_SESSION['fr_status4'] = $status4;
        }

        if (isset($_POST['nazwa5'])) {
            //dane płatnościowe 5
            $nazwa5 = $_POST['nazwa5'];
            $ilosc5 = $_POST['ilosc5'];
            $cena_podz5 = $_POST['cena_podz5'];
            $cena_uslugi5 = $_POST['cena_uslugi5'];
            $marza5 = $_POST['marza5'];
            $marza_zl5 = $_POST['marza_zl5'];
            $rabat5 = $_POST['rabat5'];
            $rabat_zl5 = $_POST['rabat_zl5'];
            $naleznosc5 = $_POST['naleznosc5'];
            $zysk5 = $_POST['zysk5'];
            $status5 = $_POST['status5'];

            $_SESSION['fr_nazwa5'] = $nazwa5;
            $_SESSION['fr_ilosc5'] = $ilosc5;
            $_SESSION['fr_cena_podz5'] = $cena_podz5;
            $_SESSION['fr_cena_uslugi5'] = $cena_uslugi5;
            $_SESSION['fr_marza5'] = $marza5;
            $_SESSION['fr_marza_zl5'] = $marza_zl5;
            $_SESSION['fr_rabat5'] = $rabat5;
            $_SESSION['fr_rabat_zl5'] = $rabat_zl5;
            $_SESSION['fr_naleznosc5'] = $naleznosc5;
            $_SESSION['fr_zysk5'] = $zysk5;
            $_SESSION['fr_status5'] = $status5;
        }

        require_once 'database.php';

        if ($wszystko_OK == true) {
            $n = $_POST['n'];

            for ($i = 1; $i < $n + 1; $i++) {

                $nazwa[$i] = trim(ucwords($_POST['nazwa' . $i]));

                $ilosc = trim($_POST['ilosc' . $i]);
                $cena_podz = trim($_POST['cena_podz' . $i]);
                $cena_uslugi = trim($_POST['cena_uslugi' . $i]);
                $marza = trim($_POST['marza' . $i]);
                $marza_zl = trim($_POST['marza_zl' . $i]);

                $rabat = trim($_POST['rabat' . $i]);
                $rabat_zl = trim($_POST['rabat_zl' . $i]);

                $naleznosc = trim($_POST['naleznosc' . $i]);
                $zysk = trim($_POST['zysk' . $i]);
                $status = trim($_POST['status' . $i]);

                $query = $db->prepare("INSERT INTO wycena VALUES (NULL,:nr_wyceny, :admin, :data, :klientID, :sprzet, :marka, :model, :zestaw, 
                :opis_usterki, '$nazwa[$i]', '$ilosc', 
     '$cena_podz', '$cena_uslugi', '$marza', '$marza_zl', '$rabat', '$rabat_zl', '$naleznosc','$naleznosc_suma', '$zysk', '$zysk_suma', '$status')");

                $query->bindValue(':nr_wyceny', $nr_wyceny, PDO::PARAM_STR);
                $query->bindValue(':admin', $admin, PDO::PARAM_STR);
                $query->bindValue(':klientID', $klientID, PDO::PARAM_INT);
                $query->bindValue(':data', $data, PDO::PARAM_STR);
                $query->bindValue(':sprzet', $sprzet, PDO::PARAM_STR);
                $query->bindValue(':marka', $marka, PDO::PARAM_STR);
                $query->bindValue(':model', $model, PDO::PARAM_STR);
                $query->bindValue(':zestaw', $zestaw, PDO::PARAM_STR);
                $query->bindValue(':opis_usterki', $opis_usterki, PDO::PARAM_STR);

                $query->execute();
            }


            $_SESSION['save-wycena'] = true;
            header('Location: save-wycena.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_wycena.css" />
    <link rel="stylesheet" href="./css/fontello6/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello3/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello4/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello5/css/fontello.css" />
    <link rel="stylesheet" href="./css/fontello2/css/fontello.css" />

    <title>Wycena serwisu</title>
</head>

<body onselectstart="return false;">
    <div class="tlo"></div>
    <form class="form_serwis" method="post">

        <a href="dashboard.php" class="powrot_panel">Panel główny</a>
        <div class="napis_serwis">
            <h2>Wycena serwisu</h2>
        </div>

        <!-- <div class="logo">
            <div class="qs"><img src="photo/1.png" style="display: block; margin: auto" /></div>
        </div> -->

        <div class="naglowek_top">
            <div class="wycena_label">
                <input class="nr_label" type="text" name="nr_wyceny" id="nr_wyceny" value="W<?= $nr_serw->rowCount() + 101 ?>" required>
                <span class="nr_span">Nr wyceny</span>
            </div>

            <div class="wycena_label">
                <span class="admin_span_wyc2"><i class='icon-adult'></i></span>
                <?php echo '<input class="admin_label" type="text" id="admin" name="admin" value="' .
                    $_SESSION['imie'] . " " . $_SESSION['nazwisko'] . '" required>'
                ?>
                <span class="admin_span">Serwisant prowadzący</span>
            </div>

            <div class="wycena_label">
                <span class="data_span2"><i class='icon-calendar-inv'></i></span>
                <?php echo '<input class="data_label" type="date" name="data" id="data" value="' .
                    date('Y-m-d') . '" required>'
                ?> <span class="data_span">Data</span>
            </div>
        </div>
        <div class="panel_serwis">

            <div class="panel">
                <div class="baza" id="baza">
                    <input type="button" value="x" class="exit" id="exit">

                    <i class='icon-book' id="icon_book">
                        <div class="book" id="book">
                            <!-- tabela wszystkich klientów -->
                            <div class="tabela_klient">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="6">Ilość klientów w bazie:
                                                <input type='text' class='b_i' id='b_i' value='<?= $klientQuery->rowCount() ?>' style="border:none; background:transparent; box-shadow:none" disabled>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="header_ch"></th>
                                            <th class="header_id">Id</th>
                                            <th class="header_imie">Imie</th>
                                            <th class="header_nazwisko">Nazwisko</th>
                                            <th class="header_adres">Adres</th>
                                            <th class="header_nr_tel">Nr tel</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($klient as $value) {
                                            $i++;
                                            if ($value['vip'] == 0) {
                                                echo "<tr>
                                            <td class='b1_ch'><input type='checkbox' class='b_ch' id='b_ch$i'></td>
                                            <td class='b1_id'><input type='text' class='b_id' id='b_id$i' value='{$value['id']}' disabled></td>
                                            <td class='b1_imie'><input type='text' class='b_imie' id='b_imie$i' value='{$value['imie']}' disabled></td>
                                            <td class='b1_nazwisko'><input type='text' class='b_nazwisko' id='b_nazwisko$i' value='{$value['nazwisko']}' disabled></td>
                                            <td class='b1_adres'><input type='text' class='b_adres' id='b_adres$i' value='{$value['adres']}' disabled></td>
                                            <td class='b1_nr_tel'><input type='text' class='b_nr_tel' id='b_nr_tel$i' value='{$value['nr_tel']}' disabled></td>
                                            <td class='b1_vip'><input type='text' class='b_vip' id='b_vip$i' value='{$value['vip']}' disabled></td>
                                        </tr>";
                                            } else {
                                                echo "<tr>
                                            <td class='b1_ch'><input type='checkbox' class='b_ch2' id='b_ch$i'></td>
                                            <td class='b1_id'><input type='text' class='b_id2' id='b_id$i' value='{$value['id']}' disabled></td>
                                            <td class='b1_imie'><input type='text' class='b_imie2' id='b_imie$i' value='{$value['imie']}' disabled></td>
                                            <td class='b1_nazwisko'><input type='text' class='b_nazwisko2' id='b_nazwisko$i' value='{$value['nazwisko']}' disabled></td>
                                            <td class='b1_adres'><input type='text' class='b_adres2' id='b_adres$i' value='{$value['adres']}' disabled></td>
                                            <td class='b1_nr_tel'><input type='text' class='b_nr_tel2' id='b_nr_tel$i' value='{$value['nr_tel']}' disabled></td>
                                            <td class='b1_vip'><input type='text' class='b_vip2' id='b_vip$i' value='{$value['vip']}' disabled></td>
                                        </tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- dodawanie klienta - link -->
                            <div class="klient">
                                <div class="dodaj-klienta-label">
                                    <input type="button" class="dodaj_klienta" id="dodaj_klienta" value="Wybierz" onclick="baza_klient()">
                                </div>
                                <div class="klient-icon">
                                    <a href="klient.php" class="icon-user-add-1"></a>
                                </div>
                            </div>

                        </div>
                    </i>
                </div>
                <div class="dane_klienta" id="dane_klienta">
                    <div class="naglowek">
                        <h3 onclick="czysc_dane_klienta()">Dane klienta</h3>
                    </div>



                    <div class="dane_klienta_d" id="dane_klienta_d">
                        <div class="wycena_label" id="wycena_label1">
                            <input class="imie_label" type="text" name="imie" id="imie" value="<?php
                                                                                                if (isset($_SESSION['fr_imie'])) {
                                                                                                    echo $_SESSION['fr_imie'];
                                                                                                    unset($_SESSION['fr_imie']);
                                                                                                }
                                                                                                ?>" required>
                            <span class="imie_span">Imię</span>
                            <?php
                            if (isset($_SESSION['e_imie'])) {
                                echo '<div class="error2">' .
                                    '<ul class="error-pojemnik2">' . $_SESSION['e_imie']
                                    . '<li>'
                                    . '<ul class="error-pojemnik3">' . $_SESSION['e_imie2'] . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>';
                                unset($_SESSION['e_imie']);
                            }
                            if (isset($_SESSION['ok_imie'])) {
                                echo '<div class="ok2">' .
                                    '<div class="ok-pojemnik2">' . $_SESSION['ok_imie'] . '</div>' . '</div>';
                                unset($_SESSION['ok_imie']);
                            }
                            ?>
                        </div>
                        <div class="wycena_label" id="wycena_label1">
                            <input class=" nazwisko_label" type="text" name="nazwisko" id="nazwisko" value="<?php
                                                                                                            if (isset($_SESSION['fr_nazwisko'])) {
                                                                                                                echo $_SESSION['fr_nazwisko'];
                                                                                                                unset($_SESSION['fr_nazwisko']);
                                                                                                            }
                                                                                                            ?>" required>
                            <span class="nazwisko_span">Nazwisko</span>
                            <?php
                            if (isset($_SESSION['e_nazwisko'])) {
                                echo '<div class="error2">' .
                                    '<ul class="error-pojemnik2">' . $_SESSION['e_nazwisko']
                                    . '<li>'
                                    . '<ul class="error-pojemnik3">' . $_SESSION['e_nazwisko2'] . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>';
                                unset($_SESSION['e_nazwisko']);
                            }
                            if (isset($_SESSION['ok_nazwisko'])) {
                                echo '<div class="ok2">' .
                                    '<div class="ok-pojemnik2">' . $_SESSION['ok_nazwisko'] . '</div>' . '</div>';
                                unset($_SESSION['ok_nazwisko']);
                            }
                            ?>
                        </div>
                        <div class="wycena_label" id="wycena_label1">
                            <input class="adres_label" type="text" name="adres" id="adres" value="<?php
                                                                                                    if (isset($_SESSION['fr_adres'])) {
                                                                                                        echo $_SESSION['fr_adres'];
                                                                                                        unset($_SESSION['fr_adres']);
                                                                                                    }
                                                                                                    ?>" required>
                            <span class="adres_span">Adres</span>
                            <?php
                            if (isset($_SESSION['e_adres'])) {
                                echo '<div class="error2">' .
                                    '<ul class="error-pojemnik2">' . $_SESSION['e_adres']
                                    . '<li>'
                                    . '<ul class="error-pojemnik3">' . $_SESSION['e_adres2'] . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>';
                                unset($_SESSION['e_adres']);
                            }
                            if (isset($_SESSION['ok_adres'])) {
                                echo '<div class="ok2">' .
                                    '<div class="ok-pojemnik2">' . $_SESSION['ok_adres'] . '</div>' . '</div>';
                                unset($_SESSION['ok_adres']);
                            }
                            ?>
                        </div>
                        <div class="wycena_label">
                            <input class="nr_tel_label" type="text" name="nr_tel" id="nr_tel" value="<?php
                                                                                                        if (isset($_SESSION['fr_nr_tel'])) {
                                                                                                            echo $_SESSION['fr_nr_tel'];
                                                                                                            unset($_SESSION['fr_nr_tel']);
                                                                                                        }
                                                                                                        ?>" required>
                            <span class="nr_tel_span">Nr tel</span>
                            <?php
                            if (isset($_SESSION['e_nr_tel'])) {
                                echo '<div class="error2">' .
                                    '<ul class="error-pojemnik2">' . $_SESSION['e_nr_tel']
                                    . '<li>'
                                    . '<ul class="error-pojemnik3">' . $_SESSION['e_nr_tel2'] . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>';
                                unset($_SESSION['e_nr_tel']);
                            }
                            if (isset($_SESSION['ok_nr_tel'])) {
                                echo '<div class="ok2">' .
                                    '<div class="ok-pojemnik2">' . $_SESSION['ok_nr_tel'] . '</div>' . '</div>';
                                unset($_SESSION['ok_nr_tel']);
                            }
                            ?>
                        </div>
                        <div class="wycena_label">
                            <input class="klientID_label" type="text" name="klientID" id="klientID" value="<?php
                                                                                                            if (isset($_SESSION['fr_id'])) {
                                                                                                                echo $_SESSION['fr_id'];
                                                                                                                unset($_SESSION['fr_id']);
                                                                                                            }
                                                                                                            ?>" required>
                            <span class="klientID_span">Id</span>
                            <?php
                            if (isset($_SESSION['e_id'])) {
                                echo '<div class="error2">' .
                                    '<ul class="error-pojemnik2">' . $_SESSION['e_id']
                                    . '<li>'
                                    . '<ul class="error-pojemnik3">' . $_SESSION['e_id2'] . '</ul>'
                                    . '</li>'
                                    . '</ul>'
                                    . '</div>';
                                unset($_SESSION['e_id']);
                            }
                            if (isset($_SESSION['ok_id'])) {
                                echo '<div class="ok2">' .
                                    '<div class="ok-pojemnik2">' . $_SESSION['ok_id'] . '</div>' . '</div>';
                                unset($_SESSION['ok_id']);
                            }
                            ?>

                        </div>
                        <input type="text" class="vip_label" id="vip" name="vip" value="<?php
                                                                                        if (isset($_SESSION['fr_vip'])) {
                                                                                            echo $_SESSION['fr_vip'];
                                                                                            unset($_SESSION['fr_vip']);
                                                                                        }
                                                                                        ?>">
                        <i class="icon-diamond" id="icon-diamond"></i>
                    </div>
                </div>


                <div class="dane_sprzetowe" id="dane_sprzetowe">
                    <div class="naglowek">
                        <h3 onclick="czysc_dane_sprzetowe()">Dane sprzętowe</h3>
                    </div>
                    <div class="wycena_label">
                        <input class="sprzet_label" type="text" name="sprzet" id="sprzet" value="<?php
                                                                                                    if (isset($_SESSION['fr_sprzet'])) {
                                                                                                        echo $_SESSION['fr_sprzet'];
                                                                                                        unset($_SESSION['fr_sprzet']);
                                                                                                    }
                                                                                                    ?>" required>
                        <span class="sprzet_span">Sprzęt</span>
                        <?php
                        if (isset($_SESSION['e_sprzet'])) {
                            echo '<div class="error2">' .
                                '<ul class="error-pojemnik2">' . $_SESSION['e_sprzet']
                                . '<li>'
                                . '<ul class="error-pojemnik3">' . $_SESSION['e_sprzet2'] . '</ul>'
                                . '</li>'
                                . '</ul>'
                                . '</div>';
                            unset($_SESSION['e_sprzet']);
                        }
                        if (isset($_SESSION['ok_sprzet'])) {
                            echo '<div class="ok2">' .
                                '<div class="ok-pojemnik2">' . $_SESSION['ok_sprzet'] . '</div>' . '</div>';
                            unset($_SESSION['ok_sprzet']);
                        }
                        ?>
                    </div>
                    <div class="wycena_label">
                        <input class="marka_label" type="text" name="marka" id="marka" value="<?php
                                                                                                if (isset($_SESSION['fr_marka'])) {
                                                                                                    echo $_SESSION['fr_marka'];
                                                                                                    unset($_SESSION['fr_marka']);
                                                                                                }
                                                                                                ?>" required>
                        <span class="marka_span">Marka</span>
                        <?php
                        if (isset($_SESSION['e_marka'])) {
                            echo '<div class="error2">' .
                                '<ul class="error-pojemnik2">' . $_SESSION['e_marka']
                                . '<li>'
                                . '<ul class="error-pojemnik3">' . $_SESSION['e_marka2'] . '</ul>'
                                . '</li>'
                                . '</ul>'
                                . '</div>';
                            unset($_SESSION['e_marka']);
                        }
                        if (isset($_SESSION['ok_marka'])) {
                            echo '<div class="ok2">' .
                                '<div class="ok-pojemnik2">' . $_SESSION['ok_marka'] . '</div>' . '</div>';
                            unset($_SESSION['ok_marka']);
                        }
                        ?>
                    </div>
                    <div class="wycena_label">
                        <input class="model_label" type="text" name="model" id="model" value="<?php
                                                                                                if (isset($_SESSION['fr_model'])) {
                                                                                                    echo $_SESSION['fr_model'];
                                                                                                    unset($_SESSION['fr_model']);
                                                                                                }
                                                                                                ?>" required>
                        <span class="model_span">Model</span>
                        <?php
                        if (isset($_SESSION['e_model'])) {
                            echo '<div class="error2">' .
                                '<ul class="error-pojemnik2">' . $_SESSION['e_model']
                                . '<li>'
                                . '<ul class="error-pojemnik3">' . $_SESSION['e_model2'] . '</ul>'
                                . '</li>'
                                . '</ul>'
                                . '</div>';
                            unset($_SESSION['e_model']);
                        }
                        if (isset($_SESSION['ok_model'])) {
                            echo '<div class="ok2">' .
                                '<div class="ok-pojemnik2">' . $_SESSION['ok_model'] . '</div>' . '</div>';
                            unset($_SESSION['ok_model']);
                        }
                        ?>
                    </div>
                    <div class="wycena_label">
                        <input class="zestaw_label" type="text" name="zestaw" id="zestaw" value="<?php
                                                                                                    if (isset($_SESSION['fr_zestaw'])) {
                                                                                                        echo $_SESSION['fr_zestaw'];
                                                                                                        unset($_SESSION['fr_zestaw']);
                                                                                                    }
                                                                                                    ?>" required>
                        <span class="zestaw_span">Dołączono</span>
                        <?php
                        if (isset($_SESSION['e_zestaw'])) {
                            echo '<div class="error2">' .
                                '<ul class="error-pojemnik2">' . $_SESSION['e_zestaw']
                                . '<li>'
                                . '<ul class="error-pojemnik3">' . $_SESSION['e_zestaw2'] . '</ul>'
                                . '</li>'
                                . '</ul>'
                                . '</div>';
                            unset($_SESSION['e_zestaw']);
                        }
                        if (isset($_SESSION['ok_zestaw'])) {
                            echo '<div class="ok2">' .
                                '<div class="ok-pojemnik2">' . $_SESSION['ok_zestaw'] . '</div>' . '</div>';
                            unset($_SESSION['ok_zestaw']);
                        }
                        ?>
                    </div>
                    <div class="wycena_label">
                        <input class="opis_label" type="text" name="opis_usterki" id="opis" value="<?php
                                                                                                    if (isset($_SESSION['fr_opis'])) {
                                                                                                        echo $_SESSION['fr_opis'];
                                                                                                        unset($_SESSION['fr_opis']);
                                                                                                    }
                                                                                                    ?>" style="text-transform: none;" required>
                        <span class="opis_span">Opis usterki</span>
                        <?php
                        if (isset($_SESSION['e_opis'])) {
                            echo '<div class="error2">' .
                                '<ul class="error-pojemnik2">' . $_SESSION['e_opis']
                                . '<li>'
                                . '<ul class="error-pojemnik3">' . $_SESSION['e_opis2'] . '</ul>'
                                . '</li>'
                                . '</ul>'
                                . '</div>';
                            unset($_SESSION['e_opis']);
                        }
                        if (isset($_SESSION['ok_opis'])) {
                            echo '<div class="ok2">' .
                                '<div class="ok-pojemnik2">' . $_SESSION['ok_opis'] . '</div>' . '</div>';
                            unset($_SESSION['ok_opis']);
                        }
                        ?>
                    </div>
                    <!-- <input type="button" class="dalej_wycena" id="dalej_wycena" value="Dalej"> -->
                </div>

                <div class="podsumowanie_wycena" id="podsumowanie_wycena">
                    <div class="naglowek">
                        <h3>Podsumowanie wyceny</h3>
                    </div>
                    <div class="podsumowanie" id="podsumowanie">

                        <div class="pozycja1">
                            <div class="nr_pods1" id="nr_pods1"></div>
                            <div class="naleznosc_pods1" id="naleznosc_pods1"></div>
                        </div>
                        <div class="pozycja2">
                            <div class="nr_pods2" id="nr_pods2"></div>
                            <div class="naleznosc_pods2" id="naleznosc_pods2"></div>
                        </div>
                        <div class="pozycja3">
                            <div class="nr_pods3" id="nr_pods3"></div>
                            <div class="naleznosc_pods3" id="naleznosc_pods3"></div>
                        </div>
                        <div class="pozycja4">
                            <div class="nr_pods4" id="nr_pods4"></div>
                            <div class="naleznosc_pods4" id="naleznosc_pods4"></div>
                        </div>
                        <div class="pozycja5">
                            <div class="nr_pods5" id="nr_pods5"></div>
                            <div class="naleznosc_pods5" id="naleznosc_pods5"></div>
                        </div>

                    </div>
                    <div class="suma">
                        <div class="sum" id="sum1" name="sum"></div>
                        <input type="text" class="s_label" id='naleznosc_suma' name="naleznosc_suma">

                        <div class="zysk_q" id="zysk_q1" name="zysk_q"></div>
                        <input type="text" class="z_label" id='zysk_suma' name="zysk_suma">
                    </div>
                </div>
            </div>
            <div class="wycena" id="wycena">

                <div class="naglowek">
                    <h3 onclick="czysc_dane_platnosciowe()">Dane płatnościowe</h3>
                </div>

                <input type="button" class="dodaj" id="dodaj" value="+">

                <div class="wyc_poj">
                    <div class="wycena_pojemnik" id="wycena_pojemnik">
                        <div class="wycena_label">
                            <input class="nazwa_label" type="text" name="nazwa1" id="nazwa1" value="<?php
                                                                                                    if (isset($_SESSION['fr_nazwa1'])) {
                                                                                                        echo $_SESSION['fr_nazwa1'];
                                                                                                        unset($_SESSION['fr_nazwa1']);
                                                                                                    }
                                                                                                    ?>" required>
                            <span class="nazwa_span">Część/Usługa</span>
                        </div>
                        <div class="wycena_label">
                            <input class="ilosc_label" type="text" name="ilosc1" id="ilosc1" value="<?php
                                                                                                    if (isset($_SESSION['fr_ilosc1'])) {
                                                                                                        echo $_SESSION['fr_ilosc1'];
                                                                                                        unset($_SESSION['fr_ilosc1']);
                                                                                                    }
                                                                                                    ?>" required>
                            <span class="ilosc_span">Ilość</span>
                            <span class="ilosc_span2">szt</span>
                        </div>
                        <div class="wycena_label">
                            <input class="cena_label" type="text" name="cena_podz1" id="cena_podz1" value="<?php
                                                                                                            if (isset($_SESSION['fr_cena_podz1'])) {
                                                                                                                echo $_SESSION['fr_cena_podz1'];
                                                                                                                unset($_SESSION['fr_cena_podz1']);
                                                                                                            }
                                                                                                            ?>" required>
                            <span class="cena_span">Cena części</span>
                            <span class="cena_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <input class="cena_label" type="text" name="cena_uslugi1" id="cena_uslugi1" value="<?php
                                                                                                                if (isset($_SESSION['fr_cena_uslugi1'])) {
                                                                                                                    echo $_SESSION['fr_cena_uslugi1'];
                                                                                                                    unset($_SESSION['fr_cena_uslugi1']);
                                                                                                                }
                                                                                                                ?>" required>
                            <span class="cena_span">Cena usługi</span>
                            <span class="cena_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <input class="marza_label" type="text" name="marza1" id="marza1" value="<?php
                                                                                                    if (isset($_SESSION['fr_marza1'])) {
                                                                                                        echo $_SESSION['fr_marza1'];
                                                                                                        unset($_SESSION['fr_marza1']);
                                                                                                    }
                                                                                                    ?>" required>
                            <span class="marza_span">Marza</span>
                            <span class="marza_span2">%</span>

                            <input class="marza_label" type="text" name="marza_zl1" id="marza_zl1" required>
                            <span class="marza_zl_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <input class="rabat_label" type="text" name="rabat1" id="rabat1" value="<?php
                                                                                                    if (isset($_SESSION['fr_rabat1'])) {
                                                                                                        echo $_SESSION['fr_rabat1'];
                                                                                                        unset($_SESSION['fr_rabat1']);
                                                                                                    }
                                                                                                    ?>" required>
                            <span class="rabat_span">Rabat</span>
                            <span class="rabat_span2">%</span>

                            <input class="rabat_label" type="text" name="rabat_zl1" id="rabat_zl1" required>
                            <span class="rabat_zl_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <input class="naleznosc_label" type="text" name="naleznosc1" id="naleznosc1" value="0" required>
                            <span class="naleznosc_span">Należność</span>
                            <span class="naleznosc_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <input class="zysk_label" type="text" name="zysk1" id="zysk1" value="0" required>
                            <span class="zysk_span">Zysk</span>
                            <span class="zysk_span2">zł</span>
                        </div>
                        <div class="wycena_label">
                            <select class="status_label" name="status1" id="status1" required>
                                <option class="option_label">Do akceptacji</option>
                                <option class="option_label">W trakcie</option>
                                <option class="option_label">Zakończony</option>
                                <option class="option_label">Anulowany</option>
                            </select>
                            <span class="status_span">Status</span>
                        </div>
                        <div class="numeracja">
                            <div class="nr" id="numer1" name="numer1" value='1'>
                            </div>
                            <input type="text" class="n_label" id='n1' name="n" value='1'>
                        </div>
                        <div class="czysc_pozycje">
                            <input type="button" class="czysc_label" id="czysc_poz1" value="Czyść" onclick="czysc_pozycje_platnosciowe1()">
                        </div>
                    </div>
                    <!-- <div class="but_usun">
                        <input type="button" class="usun" id="usun1" value="-" onchange="usuwanie()">
                    </div> -->
                </div>
            </div>
            <div class="wycena_przycisk">
                <input type="submit" class="zapisz" id="zapisz" value="Zapisz">
            </div>

        </div>
    </form>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script>
        var style_border = "border-color: #14ce31; transition: border-left-color 0.5s ease-in-out, border-top-color 1s ease-in-out, border-right-color 0.5s ease-in-out;"
        var style_border_wh = "border-color: white; transition: border-left-color 0.5s ease-in-out, border-top-color 1s ease-in-out, border-right-color 0.5s ease-in-out;"
        var animacja = "animation: anim 2s ease-in-out alternate infinite;"

        setInterval(function() {

            var imie = document.getElementById('imie').value;
            var nazwisko = document.getElementById('nazwisko').value;
            var adres = document.getElementById('adres').value;
            var nr_tel = document.getElementById('nr_tel').value;
            var id = document.getElementById('klientID').value;
            var vip = document.getElementById('vip').value;

            if (imie.length >= 3 && nazwisko.length >= 3 && adres.length >= 3 &&
                nr_tel.length == 9 && id.length >= 1) {
                document.getElementById("dane_klienta").style.cssText = style_border;
            } else {
                document.getElementById("dane_klienta").style.cssText = style_border_wh;
            }

            if (vip == 1) {
                document.getElementById("icon-diamond").style.display = "flex";
                document.getElementById('imie').style.cssText = animacja;
                document.getElementById('nazwisko').style.cssText = animacja;
                document.getElementById('adres').style.cssText = animacja;
                document.getElementById('nr_tel').style.cssText = animacja;
                document.getElementById('klientID').style.cssText = animacja;
            } else {
                document.getElementById("icon-diamond").style.display = "none";
                document.getElementById('imie').style.animation = 'none';
                document.getElementById('nazwisko').style.animation = 'none';
                document.getElementById('adres').style.animation = 'none';
                document.getElementById('nr_tel').style.animation = 'none';
                document.getElementById('klientID').style.animation = 'none';
            }
            var sprzet = document.getElementById('sprzet').value;
            var marka = document.getElementById('marka').value;
            var model = document.getElementById('model').value;
            var zestaw = document.getElementById('zestaw').value;
            var opis = document.getElementById('opis').value;

            if (sprzet.length >= 3 && marka.length >= 3 && model.length >= 3 && zestaw.length >= 3 &&
                opis.length >= 3) {
                document.getElementById("dane_sprzetowe").style.cssText = style_border;
            } else {
                document.getElementById("dane_sprzetowe").style.cssText = style_border_wh;
            }

            var nazwa = document.getElementById('nazwa1').value;
            var ilosc = document.getElementById('ilosc1').value;
            var cena_podz = document.getElementById('cena_podz1').value;
            var cena_uslugi = document.getElementById('cena_uslugi1').value;
            var marza = document.getElementById('marza1').value;
            var rabat = document.getElementById('rabat1').value;
            var naleznosc = document.getElementById('naleznosc1').value;
            var zysk = document.getElementById('zysk1').value;
            var status = document.getElementById('status1').value;


            if (nazwa.length >= 3 && ilosc.length >= 1 && cena_podz.length >= 1 && cena_uslugi.length >= 1 &&
                marza.length >= 1 && rabat.length >= 1 && naleznosc.length >= 1 && zysk.length >= 1 && status.length >= 3) {
                document.getElementById("podsumowanie_wycena").style.cssText = style_border;
                document.getElementById("wycena_pojemnik").style.cssText = style_border +
                    "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";

                document.getElementById("wycena").style.cssText = style_border;
            } else {
                document.getElementById("wycena").style.cssText = style_border_wh;
                document.getElementById("wycena_pojemnik").style.cssText = style_border_wh +
                    "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";

                document.getElementById("podsumowanie_wycena").style.cssText = style_border_wh;

            }


            var exit = document.getElementById('exit');
            var dodaj_klienta = document.getElementById('dodaj_klienta');
            $('.icon-book').on('click', function(event) {
                $('.icon-book').removeClass('active_d');
                $(this).addClass('active_d');
                exit.style.display = "flex";
            });
            $('.exit').on('click', function(event) {
                $('.icon-book').removeClass('active_d');
                exit.style.display = "none";
            });


            var style_podsumowanie = "text-transform: capitalize; word-wrap:break-word;";

            var nr_pods1 = document.getElementById('nr_pods1').innerText;
            if (nr_pods1.length >= 23 && nr_pods1.length < 28) {
                document.getElementById('nr_pods1').style.cssText = style_podsumowanie + "font-size: 16px;";
            } else if (nr_pods1.length >= 28 && nr_pods1.length < 31) {
                document.getElementById('nr_pods1').style.cssText = style_podsumowanie + "font-size: 14px;";
            } else if (nr_pods1.length >= 31 && nr_pods1.length < 36) {
                document.getElementById('nr_pods1').style.cssText = style_podsumowanie + "font-size: 12px;";
            } else if (nr_pods1.length >= 36) {
                document.getElementById('nr_pods1').style.cssText = style_podsumowanie + "font-size: 10px;";
            } else {
                document.getElementById('nr_pods1').style.cssText = style_podsumowanie + "font-size: 18px;";
            }

            var nr_pods2 = document.getElementById('nr_pods2').innerText;
            if (nr_pods2.length >= 23 && nr_pods2.length < 28) {
                document.getElementById('nr_pods2').style.cssText = style_podsumowanie + "font-size: 16px;";
            } else if (nr_pods2.length >= 28 && nr_pods2.length < 31) {
                document.getElementById('nr_pods2').style.cssText = style_podsumowanie + "font-size: 14px;";
            } else if (nr_pods2.length >= 31 && nr_pods2.length < 36) {
                document.getElementById('nr_pods2').style.cssText = style_podsumowanie + "font-size: 12px;";
            } else if (nr_pods2.length >= 36) {
                document.getElementById('nr_pods2').style.cssText = style_podsumowanie + "font-size: 10px;";
            } else {
                document.getElementById('nr_pods2').style.cssText = style_podsumowanie + "font-size: 18px;";
            }

            var nr_pods3 = document.getElementById('nr_pods3').innerText;
            if (nr_pods3.length >= 23 && nr_pods3.length < 28) {
                document.getElementById('nr_pods3').style.cssText = style_podsumowanie + "font-size: 16px;";
            } else if (nr_pods3.length >= 28 && nr_pods3.length < 31) {
                document.getElementById('nr_pods3').style.cssText = style_podsumowanie + "font-size: 14px;";
            } else if (nr_pods3.length >= 31 && nr_pods3.length < 36) {
                document.getElementById('nr_pods3').style.cssText = style_podsumowanie + "font-size: 12px;";
            } else if (nr_pods3.length >= 36) {
                document.getElementById('nr_pods3').style.cssText = style_podsumowanie + "font-size: 10px;";
            } else {
                document.getElementById('nr_pods3').style.cssText = style_podsumowanie + "font-size: 18px;";
            }

            var nr_pods4 = document.getElementById('nr_pods4').innerText;
            if (nr_pods4.length >= 23 && nr_pods4.length < 28) {
                document.getElementById('nr_pods4').style.cssText = style_podsumowanie + "font-size: 16px;";
            } else if (nr_pods4.length >= 28 && nr_pods4.length < 31) {
                document.getElementById('nr_pods4').style.cssText = style_podsumowanie + "font-size: 14px;";
            } else if (nr_pods4.length >= 31 && nr_pods4.length < 36) {
                document.getElementById('nr_pods4').style.cssText = style_podsumowanie + "font-size: 12px;";
            } else if (nr_pods4.length >= 36) {
                document.getElementById('nr_pods4').style.cssText = style_podsumowanie + "font-size: 10px;";
            } else {
                document.getElementById('nr_pods4').style.cssText = style_podsumowanie + "font-size: 18px;";
            }

            var nr_pods5 = document.getElementById('nr_pods5').innerText;
            if (nr_pods5.length >= 23 && nr_pods5.length < 28) {
                document.getElementById('nr_pods5').style.cssText = style_podsumowanie + "font-size: 16px;";
            } else if (nr_pods5.length >= 28 && nr_pods5.length < 31) {
                document.getElementById('nr_pods5').style.cssText = style_podsumowanie + "font-size: 14px;";
            } else if (nr_pods5.length >= 31 && nr_pods5.length < 36) {
                document.getElementById('nr_pods5').style.cssText = style_podsumowanie + "font-size: 12px;";
            } else if (nr_pods5.length >= 36) {
                document.getElementById('nr_pods5').style.cssText = style_podsumowanie + "font-size: 10px;";
            } else {
                document.getElementById('nr_pods5').style.cssText = style_podsumowanie + "font-size: 18px;";
            }

        }, 100);


        const dodaj = document.querySelector('.dodaj');

        let i = 1;
        var sum = 0;
        var sum_us = 0;
        var zysk_qus = 0;
        document.getElementById('numer1').innerHTML = 1;;

        dodaj.addEventListener('click', e => {
            if (i <= 4) {
                i++;



                //tworzenie komponentów w divie wycena
                const wycena = document.querySelector('.wycena');

                const wyc_poj = document.createElement('div');
                wyc_poj.classList.add('wyc_poj');
                wyc_poj.setAttribute('id', 'wyc_poj' + i);



                const wycena_pojemnik = document.createElement('div');
                wycena_pojemnik.classList.add('wycena_pojemnik');
                wycena_pojemnik.setAttribute('id', 'wycena_pojemnik' + i);

                const but_usun = document.createElement('div');
                but_usun.classList.add('but_usun');

                const usun = document.createElement('input');
                usun.setAttribute('type', 'button');
                usun.classList.add('usun');
                usun.setAttribute('id', 'usun' + i);
                usun.value = '-';
                usun.setAttribute('onFocus', 'usuwanie()');

                const wycena_label = document.createElement('div');
                wycena_label.classList.add('wycena_label');

                const wycena_label1 = document.createElement('div');
                wycena_label1.classList.add('wycena_label');

                const wycena_label2 = document.createElement('div');
                wycena_label2.classList.add('wycena_label');

                const wycena_label3 = document.createElement('div');
                wycena_label3.classList.add('wycena_label');

                const wycena_label4 = document.createElement('div');
                wycena_label4.classList.add('wycena_label');

                const wycena_label5 = document.createElement('div');
                wycena_label5.classList.add('wycena_label');

                const wycena_label6 = document.createElement('div');
                wycena_label6.classList.add('wycena_label');

                const wycena_label7 = document.createElement('div');
                wycena_label7.classList.add('wycena_label');

                const wycena_label8 = document.createElement('div');
                wycena_label8.classList.add('wycena_label');

                //tworzenie inputów 
                var fr_nazwa2 = "<?php
                                    if (isset($_SESSION['fr_nazwa2'])) {
                                        echo $_SESSION['fr_nazwa2'];
                                        unset($_SESSION['fr_nazwa2']);
                                    }
                                    ?>";
                var fr_nazwa3 = "<?php
                                    if (isset($_SESSION['fr_nazwa3'])) {
                                        echo $_SESSION['fr_nazwa3'];
                                        unset($_SESSION['fr_nazwa3']);
                                    }
                                    ?>";
                var fr_nazwa4 = "<?php
                                    if (isset($_SESSION['fr_nazwa4'])) {
                                        echo $_SESSION['fr_nazwa4'];
                                        unset($_SESSION['fr_nazwa4']);
                                    }
                                    ?>";
                var fr_nazwa5 = "<?php
                                    if (isset($_SESSION['fr_nazwa5'])) {
                                        echo $_SESSION['fr_nazwa5'];
                                        unset($_SESSION['fr_nazwa5']);
                                    }
                                    ?>";

                //nazwa usługi/części
                const nazwa_label = document.createElement('input');
                nazwa_label.setAttribute('type', 'text');
                nazwa_label.classList.add('nazwa_label');
                nazwa_label.setAttribute('name', 'nazwa' + i);
                nazwa_label.setAttribute('id', 'nazwa' + i);
                if (i == 2) {
                    nazwa_label.value = fr_nazwa2;
                }
                if (i == 3) {
                    nazwa_label.value = fr_nazwa3;
                }
                if (i == 4) {
                    nazwa_label.value = fr_nazwa4;
                }
                if (i == 5) {
                    nazwa_label.value = fr_nazwa5;
                }
                nazwa_label.setAttribute("required", "");
                const nazwa_span = document.createElement('span');
                nazwa_span.classList.add('nazwa_span');
                nazwa_span.textContent = "Część/Usługa";


                var fr_ilosc2 = "<?php
                                    if (isset($_SESSION['fr_ilosc2'])) {
                                        echo $_SESSION['fr_ilosc2'];
                                        unset($_SESSION['fr_ilosc2']);
                                    }
                                    ?>";
                var fr_ilosc3 = "<?php
                                    if (isset($_SESSION['fr_ilosc3'])) {
                                        echo $_SESSION['fr_ilosc3'];
                                        unset($_SESSION['fr_ilosc3']);
                                    }
                                    ?>";
                var fr_ilosc4 = "<?php
                                    if (isset($_SESSION['fr_ilosc4'])) {
                                        echo $_SESSION['fr_ilosc4'];
                                        unset($_SESSION['fr_ilosc4']);
                                    }
                                    ?>";
                var fr_ilosc5 = "<?php
                                    if (isset($_SESSION['fr_ilosc5'])) {
                                        echo $_SESSION['fr_ilosc5'];
                                        unset($_SESSION['fr_ilosc5']);
                                    }
                                    ?>";

                const ilosc_label = document.createElement('input');
                ilosc_label.setAttribute('type', 'text');
                ilosc_label.classList.add('ilosc_label');
                ilosc_label.setAttribute('name', 'ilosc' + i);
                ilosc_label.setAttribute('id', 'ilosc' + i);
                ilosc_label.setAttribute("required", "");
                if (i == 2) {
                    ilosc_label.value = fr_ilosc2;
                }
                if (i == 3) {
                    ilosc_label.value = fr_ilosc3;
                }
                if (i == 4) {
                    ilosc_label.value = fr_ilosc4;
                }
                if (i == 5) {
                    ilosc_label.value = fr_ilosc5;
                }
                const ilosc_span = document.createElement('span');
                ilosc_span.classList.add('ilosc_span');
                ilosc_span.textContent = "Ilość";
                const ilosc_span2 = document.createElement('span');
                ilosc_span2.classList.add('ilosc_span2');
                ilosc_span2.textContent = "szt";


                var fr_cena_podz2 = "<?php
                                        if (isset($_SESSION['fr_cena_podz2'])) {
                                            echo $_SESSION['fr_cena_podz2'];
                                            unset($_SESSION['fr_cena_podz2']);
                                        }
                                        ?>";
                var fr_cena_podz3 = "<?php
                                        if (isset($_SESSION['fr_cena_podz3'])) {
                                            echo $_SESSION['fr_cena_podz3'];
                                            unset($_SESSION['fr_cena_podz3']);
                                        }
                                        ?>";
                var fr_cena_podz4 = "<?php
                                        if (isset($_SESSION['fr_cena_podz4'])) {
                                            echo $_SESSION['fr_cena_podz4'];
                                            unset($_SESSION['fr_cena_podz4']);
                                        }
                                        ?>";
                var fr_cena_podz5 = "<?php
                                        if (isset($_SESSION['fr_cena_podz5'])) {
                                            echo $_SESSION['fr_cena_podz5'];
                                            unset($_SESSION['fr_cena_podz5']);
                                        }
                                        ?>";
                const cena_label = document.createElement('input');
                cena_label.setAttribute('type', 'text');
                cena_label.classList.add('cena_label');
                cena_label.setAttribute('name', 'cena_podz' + i);
                cena_label.setAttribute('id', 'cena_podz' + i);
                cena_label.setAttribute("required", "");
                if (i == 2) {
                    cena_label.value = fr_cena_podz2;
                }
                if (i == 3) {
                    cena_label.value = fr_cena_podz3;
                }
                if (i == 4) {
                    cena_label.value = fr_cena_podz4;
                }
                if (i == 5) {
                    cena_label.value = fr_cena_podz5;
                }

                const cena_span = document.createElement('span');
                cena_span.classList.add('cena_span');
                cena_span.textContent = "Cena części";
                const cena_span2 = document.createElement('span');
                cena_span2.classList.add('cena_span2');
                cena_span2.textContent = "zł";


                var fr_cena_uslugi2 = "<?php
                                        if (isset($_SESSION['fr_cena_uslugi2'])) {
                                            echo $_SESSION['fr_cena_uslugi2'];
                                            unset($_SESSION['fr_cena_uslugi2']);
                                        }
                                        ?>";
                var fr_cena_uslugi3 = "<?php
                                        if (isset($_SESSION['fr_cena_uslugi3'])) {
                                            echo $_SESSION['fr_cena_uslugi3'];
                                            unset($_SESSION['fr_cena_uslugi3']);
                                        }
                                        ?>";
                var fr_cena_uslugi4 = "<?php
                                        if (isset($_SESSION['fr_cena_uslugi4'])) {
                                            echo $_SESSION['fr_cena_uslugi4'];
                                            unset($_SESSION['fr_cena_uslugi4']);
                                        }
                                        ?>";
                var fr_cena_uslugi5 = "<?php
                                        if (isset($_SESSION['fr_cena_uslugi5'])) {
                                            echo $_SESSION['fr_cena_uslugi5'];
                                            unset($_SESSION['fr_cena_uslugi5']);
                                        }
                                        ?>";
                const cena_label1 = document.createElement('input');
                cena_label1.setAttribute('type', 'text');
                cena_label1.classList.add('cena_label');
                cena_label1.setAttribute('name', 'cena_uslugi' + i);
                cena_label1.setAttribute('id', 'cena_uslugi' + i);
                cena_label1.setAttribute("required", "");
                if (i == 2) {
                    cena_label1.value = fr_cena_uslugi2;
                }
                if (i == 3) {
                    cena_label1.value = fr_cena_uslugi3;
                }
                if (i == 4) {
                    cena_label1.value = fr_cena_uslugi4;
                }
                if (i == 5) {
                    cena_label1.value = fr_cena_uslugi5;
                }
                const cena_span1 = document.createElement('span');
                cena_span1.classList.add('cena_span');
                cena_span1.textContent = "Cena usługi";
                const cena_span12 = document.createElement('span');
                cena_span12.classList.add('cena_span2');
                cena_span12.textContent = "zł";



                var fr_marza2 = "<?php
                                    if (isset($_SESSION['fr_marza2'])) {
                                        echo $_SESSION['fr_marza2'];
                                        unset($_SESSION['fr_marza2']);
                                    }
                                    ?>";
                var fr_marza3 = "<?php
                                    if (isset($_SESSION['fr_marza3'])) {
                                        echo $_SESSION['fr_marza3'];
                                        unset($_SESSION['fr_marza3']);
                                    }
                                    ?>";
                var fr_marza4 = "<?php
                                    if (isset($_SESSION['fr_marza4'])) {
                                        echo $_SESSION['fr_marza4'];
                                        unset($_SESSION['fr_marza4']);
                                    }
                                    ?>";
                var fr_marza5 = "<?php
                                    if (isset($_SESSION['fr_marza5'])) {
                                        echo $_SESSION['fr_marza5'];
                                        unset($_SESSION['fr_marza5']);
                                    }
                                    ?>";
                const marza_label = document.createElement('input');
                marza_label.setAttribute('type', 'text');
                marza_label.classList.add('marza_label');
                marza_label.setAttribute('name', 'marza' + i);
                marza_label.setAttribute('id', 'marza' + i);
                marza_label.setAttribute("required", "");
                if (i == 2) {
                    marza_label.value = fr_marza2;
                }
                if (i == 3) {
                    marza_label.value = fr_marza3;
                }
                if (i == 4) {
                    marza_label.value = fr_marza4;
                }
                if (i == 5) {
                    marza_label.value = fr_marza5;
                }
                const marza_span = document.createElement('span');
                marza_span.classList.add('marza_span');
                marza_span.textContent = "Marza";
                const marza_span2 = document.createElement('span');
                marza_span2.classList.add('marza_span2');
                marza_span2.textContent = "%";
                const marza_label1 = document.createElement('input');
                marza_label1.setAttribute('type', 'text');
                marza_label1.classList.add('marza_label');
                marza_label1.setAttribute('name', 'marza_zl' + i);
                marza_label1.setAttribute('id', 'marza_zl' + i);
                marza_label1.setAttribute("required", "");
                const marza_zl_span2 = document.createElement('span');
                marza_zl_span2.classList.add('marza_zl_span2');
                marza_zl_span2.textContent = "zł";



                var fr_rabat2 = "<?php
                                    if (isset($_SESSION['fr_rabat2'])) {
                                        echo $_SESSION['fr_rabat2'];
                                        unset($_SESSION['fr_rabat2']);
                                    }
                                    ?>";
                var fr_rabat3 = "<?php
                                    if (isset($_SESSION['fr_rabat3'])) {
                                        echo $_SESSION['fr_rabat3'];
                                        unset($_SESSION['fr_rabat3']);
                                    }
                                    ?>";
                var fr_rabat4 = "<?php
                                    if (isset($_SESSION['fr_rabat4'])) {
                                        echo $_SESSION['fr_rabat4'];
                                        unset($_SESSION['fr_rabat4']);
                                    }
                                    ?>";
                var fr_rabat5 = "<?php
                                    if (isset($_SESSION['fr_rabat5'])) {
                                        echo $_SESSION['fr_rabat5'];
                                        unset($_SESSION['fr_rabat5']);
                                    }
                                    ?>";
                const rabat_label = document.createElement('input');
                rabat_label.setAttribute('type', 'text');
                rabat_label.classList.add('rabat_label');
                rabat_label.setAttribute('name', 'rabat' + i);
                rabat_label.setAttribute('id', 'rabat' + i);
                rabat_label.setAttribute("required", "");
                if (i == 2) {
                    rabat_label.value = fr_rabat2;
                }
                if (i == 3) {
                    rabat_label.value = fr_rabat3;
                }
                if (i == 4) {
                    rabat_label.value = fr_rabat4;
                }
                if (i == 5) {
                    rabat_label.value = fr_rabat5;
                }
                const rabat_span = document.createElement('span');
                rabat_span.classList.add('rabat_span');
                rabat_span.textContent = "Rabat";
                const rabat_span2 = document.createElement('span');
                rabat_span2.classList.add('rabat_span2');
                rabat_span2.textContent = "%";
                const rabat_label1 = document.createElement('input');
                rabat_label1.setAttribute('type', 'text');
                rabat_label1.classList.add('marza_label');
                rabat_label1.setAttribute('name', 'rabat_zl' + i);
                rabat_label1.setAttribute('id', 'rabat_zl' + i);
                rabat_label1.setAttribute("required", "");
                const rabat_zl_span2 = document.createElement('span');
                rabat_zl_span2.classList.add('rabat_zl_span2');
                rabat_zl_span2.textContent = "zł";

                const naleznosc_label = document.createElement('input');
                naleznosc_label.setAttribute('type', 'text');
                naleznosc_label.classList.add('naleznosc_label');
                naleznosc_label.setAttribute('name', 'naleznosc' + i);
                naleznosc_label.setAttribute('id', 'naleznosc' + i);
                naleznosc_label.setAttribute("required", "");
                const naleznosc_span = document.createElement('span');
                naleznosc_span.classList.add('naleznosc_span');
                naleznosc_span.textContent = "Należność";
                const naleznosc_span2 = document.createElement('span');
                naleznosc_span2.classList.add('naleznosc_span2');
                naleznosc_span2.textContent = "zł";

                const zysk_label = document.createElement('input');
                zysk_label.setAttribute('type', 'text');
                zysk_label.classList.add('zysk_label');
                zysk_label.setAttribute('name', 'zysk' + i);
                zysk_label.setAttribute('id', 'zysk' + i);
                zysk_label.setAttribute("required", "");
                const zysk_span = document.createElement('span');
                zysk_span.classList.add('zysk_span');
                zysk_span.textContent = "Zysk";
                const zysk_span2 = document.createElement('span');
                zysk_span2.classList.add('zysk_span2');
                zysk_span2.textContent = "zł";

                const status_label = document.createElement('select');
                status_label.setAttribute('type', 'text');
                status_label.classList.add('status_label');
                status_label.setAttribute('name', 'status' + i);
                status_label.setAttribute('id', 'status' + i);
                status_label.setAttribute("required", "");
                const status_span = document.createElement('span');
                status_span.classList.add('status_span');
                status_span.textContent = "Status";
                const option_label1 = document.createElement('option');
                option_label1.classList.add('option_label');
                option_label1.textContent = "Do akceptacji";
                const option_label2 = document.createElement('option');
                option_label2.classList.add('option_label');
                option_label2.textContent = "W trakcie";
                const option_label3 = document.createElement('option');
                option_label3.classList.add('option_label');
                option_label3.textContent = "Zakończony";
                const option_label4 = document.createElement('option');
                option_label4.classList.add('option_label');
                option_label4.textContent = "Anulowany";

                const numeracja = document.createElement('div');
                numeracja.classList.add('numeracja');

                const nr = document.createElement('div');
                nr.classList.add('nr');
                nr.setAttribute('name', 'numer' + i);
                nr.setAttribute('id', 'numer' + i);
                nr.value = i;

                const n1 = document.createElement('input');
                n1.setAttribute('type', 'text');
                n1.classList.add('n_label');
                n1.setAttribute('name', 'n');
                n1.setAttribute('id', 'n' + i);
                n1.value = i;


                const czysc_pozycje = document.createElement('div');
                czysc_pozycje.classList.add('czysc_pozycje');

                const czysc_label = document.createElement('input');
                czysc_label.setAttribute('type', 'button');
                czysc_label.classList.add('czysc_label');
                czysc_label.setAttribute('id', 'czysc_poz' + i);
                czysc_label.value = "Czyść";
                czysc_label.setAttribute('onclick', 'czysc_pozycje_platnosciowe' + i + '()');



                wycena.appendChild(wyc_poj);
                wyc_poj.append(wycena_pojemnik);
                but_usun.appendChild(usun);
                wycena_pojemnik.append(wycena_label, wycena_label1, wycena_label2, wycena_label3,
                    wycena_label4, wycena_label5, wycena_label6, wycena_label7, wycena_label8);
                wycena_pojemnik.append(numeracja, czysc_pozycje, but_usun);

                wycena_label.appendChild(nazwa_label);
                wycena_label.appendChild(nazwa_span);

                wycena_label1.appendChild(ilosc_label);
                wycena_label1.appendChild(ilosc_span);
                wycena_label1.appendChild(ilosc_span2);

                wycena_label2.appendChild(cena_label);
                wycena_label2.appendChild(cena_span);
                wycena_label2.appendChild(cena_span2);

                wycena_label3.appendChild(cena_label1);
                wycena_label3.appendChild(cena_span1);
                wycena_label3.appendChild(cena_span12);

                wycena_label4.appendChild(marza_label);
                wycena_label4.appendChild(marza_span);
                wycena_label4.appendChild(marza_span2);
                wycena_label4.appendChild(marza_label1);
                wycena_label4.appendChild(marza_zl_span2);

                wycena_label5.appendChild(rabat_label);
                wycena_label5.appendChild(rabat_span);
                wycena_label5.appendChild(rabat_span2);
                wycena_label5.appendChild(rabat_label1);
                wycena_label5.appendChild(rabat_zl_span2);

                wycena_label6.appendChild(naleznosc_label);
                wycena_label6.appendChild(naleznosc_span);
                wycena_label6.appendChild(naleznosc_span2);

                wycena_label7.appendChild(zysk_label);
                wycena_label7.appendChild(zysk_span);
                wycena_label7.appendChild(zysk_span2);

                wycena_label8.appendChild(status_label);
                wycena_label8.appendChild(status_span);
                status_label.append(option_label1,
                    option_label2, option_label3, option_label4);
                // wycena_label8.appendChild(zysk_span2);

                numeracja.append(nr, n1);
                czysc_pozycje.appendChild(czysc_label);
                //numeracja pozycji 
                document.getElementById('numer' + i).innerHTML = i;



                var nazwa = document.getElementById('nazwa1').value;
                var ilosc = document.getElementById('ilosc1').value;
                var cena_podz = document.getElementById('cena_podz1').value;
                var cena_uslugi = document.getElementById('cena_uslugi1').value;
                var marza = document.getElementById('marza1').value;
                var rabat = document.getElementById('rabat1').value;
                var naleznosc = document.getElementById('naleznosc1').value;
                var zysk = document.getElementById('zysk1').value;
                var status = document.getElementById('status1').value;


            } else {
                alert('Osiągnieto max wierszy!');
            }
        });
        setInterval(function() {

            //zmienna sum przechowuje całkowita sume do zapłaty
            sum = parseFloat(document.getElementById('naleznosc1').value);
            //zmienna zysk_q przechowuje całkowity zysk z serwisu
            zysk_q = parseFloat(document.getElementById('zysk1').value);



            //zabarwienie ramki po wpisaniu poprawnej ilości znaków w okna
            // if (document.getElementById('nazwa' + i) !== null) {
            //     if (document.getElementById('nazwa' + i).value.length >= 3 && document.getElementById('cena_podz' + i).value.length >= 1 && document.getElementById('cena_uslugi' + i).value.length >= 1) {
            //         document.getElementById("wycena_pojemnik" + i).style.cssText = style_border +
            //             "box-shadow: 0px 0px 10px 0px #14ce31; transition: 1s ease-in-out";
            //     } else {
            //         document.getElementById("wycena_pojemnik" + i).style.cssText = style_border_wh +
            //             "box-shadow: 0px 0px 10px 0px white; transition: 1s ease-in-out";
            //     }
            // }
        }, 100);

        function usuwanie() {
            const usuwanie2 = document.querySelector('#usun2');
            if (document.getElementById('usun2') !== null) {

                usuwanie2.addEventListener('click', e => {
                    document.getElementById('nazwa2').value = "";
                    document.getElementById('ilosc2').value = 0;
                    document.getElementById('cena_podz2').value = 0;
                    document.getElementById('cena_uslugi2').value = 0;
                    document.getElementById('marza2').value = 20;
                    document.getElementById('rabat2').value = 0;
                    document.getElementById('naleznosc2').value = 0;
                    document.getElementById('zysk2').value = 0;
                    document.getElementById('status2').value = "Do akceptacji";
                    wyc_poj = document.querySelector('#wyc_poj2');
                    setTimeout(() => {
                        wyc_poj.remove();
                    }, 100);
                });
            }



            const usuwanie3 = document.querySelector('#usun3');

            if (document.getElementById('usun3') !== null) {
                usuwanie3.addEventListener('click', e => {
                    document.getElementById('nazwa3').value = "";
                    document.getElementById('ilosc3').value = 0;
                    document.getElementById('cena_podz3').value = 0;
                    document.getElementById('cena_uslugi3').value = 0;
                    document.getElementById('marza3').value = 20;
                    document.getElementById('rabat3').value = 0;
                    document.getElementById('naleznosc3').value = 0;
                    document.getElementById('zysk3').value = 0;
                    document.getElementById('status3').value = "Do akceptacji";
                    wyc_poj = document.querySelector('#wyc_poj3');
                    setTimeout(() => {
                        wyc_poj.remove();
                    }, 100);
                });
            }



            const usuwanie4 = document.querySelector('#usun4');
            if (document.getElementById('usun4') !== null) {
                usuwanie4.addEventListener('click', e => {
                    document.getElementById('nazwa4').value = "";
                    document.getElementById('ilosc4').value = 0;
                    document.getElementById('cena_podz4').value = 0;
                    document.getElementById('cena_uslugi4').value = 0;
                    document.getElementById('marza4').value = 20;
                    document.getElementById('rabat4').value = 0;
                    document.getElementById('naleznosc4').value = 0;
                    document.getElementById('zysk4').value = 0;
                    document.getElementById('status4').value = "Do akceptacji";
                    wyc_poj = document.querySelector('#wyc_poj4');
                    setTimeout(() => {
                        wyc_poj.remove();
                    }, 100);
                });
            }



            const usuwanie5 = document.querySelector('#usun5');
            if (document.getElementById('usun5') !== null) {
                usuwanie5.addEventListener('click', e => {
                    document.getElementById('nazwa5').value = "";
                    document.getElementById('ilosc5').value = 0;
                    document.getElementById('cena_podz5').value = 0;
                    document.getElementById('cena_uslugi5').value = 0;
                    document.getElementById('marza5').value = 20;
                    document.getElementById('rabat5').value = 0;
                    document.getElementById('naleznosc5').value = 0;
                    document.getElementById('zysk5').value = 0;
                    document.getElementById('status5').value = "Do akceptacji";
                    wyc_poj = document.querySelector('#wyc_poj5');
                    setTimeout(() => {
                        wyc_poj.remove();
                    }, 100);
                });

            }
        }
        setInterval(function() {

            // zmienna sum przechowuje całkowita sume do zapłaty
            sum = parseFloat(document.getElementById('naleznosc1').value);
            //zmienna zysk_q przechowuje całkowity zysk z serwisu
            zysk_q = parseFloat(document.getElementById('zysk1').value);

            if (document.getElementById('naleznosc2') !== null) {
                sum = parseFloat(document.getElementById('naleznosc2').value) + sum;
                sum = parseFloat(sum);
                zysk_q = parseFloat(document.getElementById('zysk2').value) + zysk_q;
                zysk_q = parseFloat(zysk_q);
            }
            if (document.getElementById('naleznosc3') !== null) {
                sum = parseFloat(document.getElementById('naleznosc3').value) + sum;
                sum = parseFloat(sum);
                zysk_q = parseFloat(document.getElementById('zysk3').value) + zysk_q;
                zysk_q = parseFloat(zysk_q);
            }
            if (document.getElementById('naleznosc4') !== null) {
                sum = parseFloat(document.getElementById('naleznosc4').value) + sum;
                sum = parseFloat(sum);
                zysk_q = parseFloat(document.getElementById('zysk4').value) + zysk_q;
                zysk_q = parseFloat(zysk_q);
            }
            if (document.getElementById('naleznosc5') !== null) {
                sum = parseFloat(document.getElementById('naleznosc5').value) + sum;
                sum = parseFloat(sum);
                zysk_q = parseFloat(document.getElementById('zysk5').value) + zysk_q;
                zysk_q = parseFloat(zysk_q);
            }


            // for (j = 2; j < i + 1; j++) {
            //     if (document.getElementById('naleznosc' + j) !== null) {
            //         sum += parseFloat(document.getElementById('naleznosc' + j).value);
            //         sum = parseFloat(sum);
            //         zysk_q += parseFloat(document.getElementById('zysk' + j).value);
            //         zysk_q = parseFloat(zysk_q);
            //     }

            // }

            document.getElementById('sum1').innerHTML = "Do zapłaty: " + sum + " zł";
            document.getElementById('zysk_q1').innerHTML = "Całkowity zysk: " + zysk_q + " zł";
            document.getElementById('naleznosc_suma').value = sum;
            document.getElementById('zysk_suma').value = zysk_q;


        }, 100);
    </script>
</body>

</html>