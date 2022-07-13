<?php
session_start();
require_once 'database.php';


// $tbl = $db->query("SELECT * FROM klient");
// $userQuery = $tbl->fetchAll();
// $tbl->execute();



// $imie = isset($_GET['imie_k']) ? strval($_GET['imie_k']) : 0;
// $imie = htmlspecialchars($imie);
// $query2 = $db->prepare("SELECT * FROM klient WHERE imie LIKE :imie_k");
// $query2->bindValue(':imie_k', $imie, PDO::PARAM_STR);
// $query2->execute();
// $userQuery2 = $query2->fetchAll();

// $nazwisko = isset($_GET['nazwisko']) ? strval($_GET['nazwisko']) : 0;
// $nazwisko = htmlspecialchars($nazwisko);
// $query3 = $db->prepare("SELECT * FROM klient WHERE imie LIKE :imie_k AND nazwisko LIKE :nazwisko");
// $query3->bindValue(':imie_k', $imie, PDO::PARAM_STR);
// $query3->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
// $query3->execute();
// $userQuery3 = $query3->fetchAll();


if (isset($_POST['nazwisko'])) {

    $wszystko_OK = true;
    $id = $_POST['id'];
    $imie = $_POST['imie_k'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $nr_tel = $_POST['nr_tel'];

    // $_SESSION['fr_imie'] = $imie;
    // $_SESSION['fr_nazwisko'] = $nazwisko;
    // $_SESSION['fr_adres'] = $adres;
    // $_SESSION['fr_nr_tel'] = $nr_tel;


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


    if ($wszystko_OK == true) {
        $_SESSION['save'] = true;
        header('Location: save.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_wycena_test.css" />
    <title>Wycena serwisu</title>
</head>

<body>
    <div class="tlo"></div>
    <form class="form_serwis" method="post">


        <div class="napis_serwis">
            <h2>Wycena serwisu</h2>
        </div>

        <!-- <div class="logo">
            <div class="qs"><img src="photo/1.png" style="display: block; margin: auto" /></div>
        </div> -->


        <div class="naglowek">
            <div class="wycena_label">
                <!-- <?php echo '<input class="admin_label" type="text" id="admin" name="admin" value="' .
                            $_SESSION['imie_a'] . '" required>'
                        ?> -->
                <input type="text" class="admin_label" id="admin" name="admin" value="Sebastian" required>
                <span class="admin_span">Serwisant</span>
            </div>
            <div class="wycena_label">
                <?php echo '<input class="data_label" type="text" name="data" id="data" value="' .
                    date('Y-m-d') . '" required>'
                ?> <span class="data_span">Data</span>
            </div>
        </div>
        <div class="panel_serwis">

            <!-- <div class="wycena_label">
                <?php echo '<input class="data_label" type="text" name="data" id="data" value="' .
                    $_SESSION['id'] . +.100 . '" required>'
                ?>
                <span class="imie_span">Nr serwisowy</span>
            </div> -->

            <form>
                <div class="dane_klienta" id="dane_klienta">
                    <div class="naglowek_klient">
                        <h3>Dane klienta</h3>
                    </div>
                    <div class="wycena_label">
                        <!-- <input class="imie_label" type="text" name="imie" id="imie" onchange="this.form.submit()" required> -->
                        <select class=" imie_label" name="imie_k" id="imie_k" onchange="this.form.submit()">
                            <optgroup label="Wybrano">
                                <option><?php
                                        if (!isset($_SESSION['imie_k'])) {
                                            echo $imie;
                                            unset($_SESSION['imie_k']);
                                        }
                                        ?></option disabled>
                            </optgroup>

                            <?php
                            foreach ($userQuery as $value) {

                                echo "<option>                           
                            {$value['imie']}                          
                                </option>";
                            }
                            ?>


                        </select>
                        <span class="imie_span">Imię</span>
                    </div>
                    <div class="wycena_label">
                        <select class="nazwisko_label" id="nazwisko" name="nazwisko" onchange="this.form.submit()">
                            <optgroup label="Wybrano">
                                <option><?php
                                        if (!isset($_SESSION['imie_k'])) {
                                            echo $nazwisko;
                                            unset($_SESSION['nazwisko']);
                                        } else {
                                            $nazwisko = "brak";
                                        }
                                        ?></option>
                            </optgroup>
                            <?php
                            foreach ($userQuery2 as $value) {

                                echo "<option>                           
                            {$value['nazwisko']}                           
                                </option>";
                            }
                            ?>
                        </select>
                        <!-- <input class=" nazwisko_label" type="text" name="nazwisko_k" id="nazwisko_k" required> -->
                        <span class="nazwisko_span">Nazwisko</span>
                    </div>
                    <div class="wycena_label">
                        <input class="adres_label" type="text" name="adres" id="adres" value='<?php
                                                                                                foreach ($userQuery3 as $value) {
                                                                                                    echo "{$value['adres']}";
                                                                                                }
                                                                                                ?>' required>
                        <span class="adres_span">Adres</span>
                    </div>
                    <div class="wycena_label">
                        <input class="nr_tel_label" type="text" name="nr_tel" id="nr_tel" value='<?php
                                                                                                    foreach ($userQuery3 as $value) {
                                                                                                        echo "{$value['nr_tel']}";
                                                                                                    }

                                                                                                    ?>' required>
                        <span class="nr_tel_span">Nr tel</span>
                    </div>
                    <div class="wycena_label">
                        <input class="klientID_label" type="text" name="klientID" id="klientID" value='<?php
                                                                                                        foreach ($userQuery3 as $value) {
                                                                                                            echo "{$value['id']}";
                                                                                                        }

                                                                                                        ?>' required>
                        <span class="klientID_span">Id</span>
                    </div>
                    <a href="http://localhost:8081/new/test_wycena.php" class="dalej_sprzet">Reset</a>
                </div>
            </form>

            <div class="dane_sprzetowe" id="dane_sprzetowe">
                <h3>Dane sprzętowe</h3>

                <div class="wycena_label">
                    <input class="sprzet_label" type="text" name="sprzet" id="sprzet" required>
                    <span class="sprzet_span">Sprzęt</span>
                </div>
                <div class="wycena_label">
                    <input class="marka_label" type="text" name="marka" id="marka" required>
                    <span class="marka_span">Marka</span>
                </div>
                <div class="wycena_label">
                    <input class="model_label" type="text" name="model" id="model" required>
                    <span class="model_span">Model</span>
                </div>
                <div class="wycena_label">
                    <input class="zestaw_label" type="text" name="zestaw" id="zestaw" required>
                    <span class="zestaw_span">Dołączono</span>
                </div>
                <div class="wycena_label">
                    <input class="opis_label" type="text" name="opis_usterki" id="opis" required>
                    <span class="opis_span">Opis usterki</span>
                </div>
                <!-- <input type="button" class="dalej_wycena" id="dalej_wycena" value="Dalej"> -->
            </div>
            <div class="wycena" id="wycena">

                <div class="naglowek_serwis">
                    <h3>Dane płatnościowe</h3>
                </div>
                <input type="button" class="dodaj" id="dodaj" value="+">

                <div class="wycena_pojemnik" id="wycena_pojemnik">

                    <div class="wycena_label">
                        <input class="nazwa_label" type="text" name="nazwa" id="nazwa" required>
                        <span class="nazwa_span">Część/Usługa</span>
                    </div>
                    <div class="wycena_label">
                        <input class="ilosc_label" type="text" name="ilosc" id="ilosc" value='1' required>
                        <span class="ilosc_span">Ilość</span>
                        <span class="ilosc_span2">szt</span>
                    </div>
                    <div class="wycena_label">
                        <input class="cena_label" type="text" name="cena_podz" id="cena_podz" required>
                        <span class="cena_span">Cena części</span>
                        <span class="cena_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="cena_label" type="text" name="cena_uslugi" id="cena_uslugi" required>
                        <span class="cena_span">Cena usługi</span>
                        <span class="cena_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="marza_label" type="text" name="marza" id="marza" value='20' required>
                        <span class="marza_span">Marza</span>
                        <span class="marza_span2">%</span>

                        <input class="marza_label" type="text" name="wylicz_marza" id="wylicz_marza" required>
                        <span class="marza_zl_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="rabat_label" type="text" name="rabat" id="rabat" value='0' required>
                        <span class="rabat_span">Rabat</span>
                        <span class="rabat_span2">%</span>

                        <input class="rabat_label" type="text" name="wylicz_rabat" id="wylicz_rabat" required>
                        <span class="rabat_zl_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="naleznosc_label" type="text" name="naleznosc" id="naleznosc" value="0" required>
                        <span class="naleznosc_span">Należność</span>
                        <span class="naleznosc_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <input class="zysk_label" type="text" name="zysk" id="zysk" value="0" required>
                        <span class="zysk_span">Zysk</span>
                        <span class="zysk_span2">zł</span>
                    </div>
                    <div class="wycena_label">
                        <select class="status_label" name="status" id="status" required>
                            <option>Do akceptacji</option>
                            <option>W trakcie</option>
                            <option>Zakończony</option>
                            <option>Anulowany</option>
                        </select>
                        <span class="status_span">Status</span>
                    </div>
                </div>

            </div>
            <div class="wycena_przycisk">
                <input type="submit" class="zapisz" id="zapisz" value="Zapisz">
            </div>

        </div>
    </form>
    <script src="script.js"></script>

    <script>
        // setInterval(function() {


        //     if (imie_k.length >= 3 && nazwisko_k.length >= 3) {
        //         document.getElementById("dalej_sprzet").style.display = "grid";

        //         const dalej_sprzet = document.querySelector('.dalej_sprzet');
        //         dalej_sprzet.addEventListener('click', function() {
        //             document.getElementById("dane_sprzetowe").style.display = "grid";

        //             document.getElementById("dane_klienta").style.display = "none";

        //         });
        //     } else {
        //         document.getElementById("dalej_sprzet").style.display = "none";

        //     }

        // }, 100);


        const dodaj = document.querySelector('.dodaj');
        const targetDiv = document.querySelector('.wycena');

        let nr = 1;
        dodaj.addEventListener('click', e => {

            var nazwa = document.getElementById('nazwa');
            var cena_podz = document.getElementById('cena_podz');
            var cena_uslugi = document.getElementById('cena_uslugi');
            var wylicz_marza = document.getElementById('wylicz_marza');
            var rabat = document.getElementById('rabat');
            var wylicz_rabat = document.getElementById('wylicz_rabat');
            var naleznosc = document.getElementById('naleznosc');
            var zysk = document.getElementById('zysk');
            if (nr <= 4) {
                nr++;
                const el = document.querySelector(".wycena_pojemnik");
                const clone = el.cloneNode(true);
                targetDiv.append(deep);

                nazwa.value = "";
                cena_podz.value = "";
                cena_uslugi.value = "";
                wylicz_marza.value = "";
                rabat.value = "";
                wylicz_rabat.value = "";
                naleznosc.value = "";
                zysk.value = "";


            } else {
                alert('Osiągnieto max wierszy!');
            }
        });
    </script>
</body>

</html>