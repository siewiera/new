<?php
session_start();

if (isset($_POST['email'])) {

    //Udana walidacja
    $wszystko_OK = true;

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    if ((strlen($imie) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_imie'] = "Wprowadź imię klienta! Min 3 znaki";
    }
    if ((strlen($nazwisko) < 3)) {
        $wszystko_OK = false;
        $_SESSION['e_nazwisko'] = "Wprowadź nazwisko klienta! Min 3 znaki";
    }
    //Sprawdź poprawnośc nickname'a
    $nick = $_POST['nick'];

    //Sprawdzenie długości nicka
    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
    }

    if (ctype_alnum($nick) == false) {
        $wszystko_OK = false;
        $_SESSION['e_nick'] = "Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
    }


    //Sprawdź poprawnośc adresu email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)) {
        $wszystko_OK = false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
    }

    //Sprawdź poprawnośc hasła
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];

    if ((strlen($haslo1) < 8) || (strlen($haslo2) > 20)) {
        $wszystko_OK = false;
        $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków!";
    }
    if ($haslo1 != $haslo2) {
        $wszystko_OK = false;
        $_SESSION['e_haslo'] = "Podane hasła nie są indentyczne!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $kod = 'kjkszpj';
    $password1 = $_POST['password1'];

    if ($password1 != $kod) {
        $wszystko_OK = false;
        $_SESSION['e_haslo3'] = "Wprowadź poprawy kod dostępu!";
    }

    //Czy zaakceptowano regulamin
    if (!isset($_POST['regulamin'])) {
        $wszystko_OK = false;
        $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu!";
    }


    //Zapamiętaj wprowadzone dane
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_imie'] = $imie;
    $_SESSION['fr_nazwisko'] = $nazwisko;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {

            //Czy email już istnieje
            $rezultat = $polaczenie->query("SELECT id FROM admins WHERE email='$email'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_maili = $rezultat->num_rows;

            if ($ile_takich_maili > 0) {
                $wszystko_OK = false;
                $_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail!";
            }

            //Czy nick jest już zarezerwowany
            $rezultat = $polaczenie->query("SELECT id FROM admins WHERE nick='$nick'");

            if (!$rezultat) throw new Exception($polaczenie->error);

            $ile_takich_nickow = $rezultat->num_rows;

            if ($ile_takich_nickow > 0) {
                $wszystko_OK = false;
                $_SESSION['e_nick'] = "Istnieje już konto o takim nicku!";
            }

            if ($wszystko_OK == true) {

                if ($polaczenie->query("INSERT INTO admins VALUES (NULL,'$imie','$nazwisko', '$nick','$haslo_hash','$email'  )")) {
                    $_SESSION['udanarejestracja'] = true;
                    header('Location: udana_rejestracja.php');
                } else {
                    throw new Exception($polaczenie->error);
                }
            }

            $polaczenie->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogoności i 
        prosimy o rejestrację w innym terminie!</span>';
        // echo '<br/> Informacja developerska: ' . $e;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/style.css" />
    <title>Rejestracja QS</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <style>
        form {
            position: relative;
            display: grid;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="tlo"></div>
    <form method="post">

        <a href="index.php" class="powrot_logowanie">Zaloguj się!</a>

        <div class="form-rejestracja">
            <div class="pojemnik-naglowek">
                <h2>Quick Serwis</h2>
                <span class="napis-naglowek">Zarejestruj się</span>
            </div>
            <div class="pojemnik-input-rejestracja">
                <input type="text" class="nickname-input" value="<?php
                                                                    if (isset($_SESSION['fr_nick'])) {
                                                                        echo $_SESSION['fr_nick'];
                                                                        unset($_SESSION['fr_nick']);
                                                                    }
                                                                    ?>" name="nick" required />
                <span class="nickname-span">Nickname</span>
                <?php
                if (isset($_SESSION['e_nick'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_nick'] . '</div>' . '</div>';
                    unset($_SESSION['e_nick']);
                }
                ?>

                <input type="text" class="email-input" value="<?php
                                                                if (isset($_SESSION['fr_email'])) {
                                                                    echo $_SESSION['fr_email'];
                                                                    unset($_SESSION['fr_email']);
                                                                }
                                                                ?>" name="email" required />
                <span class="email-span">E-mail</span>
                <?php
                if (isset($_SESSION['e_email'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_email'] . '</div>' . '</div>';
                    unset($_SESSION['e_email']);
                }
                ?>

                <input type="text" class="imie-input" value="<?php
                                                                if (isset($_SESSION['fr_imie'])) {
                                                                    echo $_SESSION['fr_imie'];
                                                                    unset($_SESSION['fr_imie']);
                                                                }
                                                                ?>" name="imie" required />
                <span class="imie-span">Imie</span>
                <?php
                if (isset($_SESSION['e_imie'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_imie'] . '</div>' . '</div>';
                    unset($_SESSION['e_imie']);
                }
                ?>


                <input type="text" class="nazwisko-input" value="<?php
                                                                    if (isset($_SESSION['fr_nazwisko'])) {
                                                                        echo $_SESSION['fr_nazwisko'];
                                                                        unset($_SESSION['fr_nazwisko']);
                                                                    }
                                                                    ?>" name="nazwisko" required />
                <span class="nazwisko-span">Nazwisko</span>
                <?php
                if (isset($_SESSION['e_nazwisko'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_nazwisko'] . '</div>' . '</div>';
                    unset($_SESSION['e_nazwisko']);
                }
                ?>

                <input type="password" class="haslo1-input" value="<?php
                                                                    if (isset($_SESSION['fr_haslo1'])) {
                                                                        echo $_SESSION['fr_haslo1'];
                                                                        unset($_SESSION['fr_haslo1']);
                                                                    }
                                                                    ?>" name="haslo1" required />
                <span class="haslo1-span">Twoje hasło</span>
                <?php
                if (isset($_SESSION['e_haslo'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_haslo'] . '</div>' . '</div>';
                    unset($_SESSION['e_haslo']);
                }
                ?>

                <input type="password" class="haslo2-input" value="<?php
                                                                    if (isset($_SESSION['fr_haslo2'])) {
                                                                        echo $_SESSION['fr_haslo2'];
                                                                        unset($_SESSION['fr_haslo2']);
                                                                    }
                                                                    ?>" name="haslo2" required />
                <span class="haslo2-span">Powtórz hasło</span>

                <input type="password" class="haslo3-input" name="password1" required />
                <span class="haslo3-span">Hasło dostępowe</span>
                <?php
                if (isset($_SESSION['e_haslo3'])) {
                    echo '<div class="error">' .
                        '<div class="error-pojemnik">' . $_SESSION['e_haslo3'] . '</div>' . '</div>';
                    unset($_SESSION['e_haslo3']);
                }
                ?>
            </div>

            <label class="label-box">
                <input type="checkbox" class="checkbox" name="regulamin" <?php
                                                                            if (isset($_SESSION['fr_regulamin'])) {
                                                                                echo "checked";
                                                                                unset($_SESSION['fr_regulamin']);
                                                                            }
                                                                            ?>>
                <span class="akceptacja-span">Akceptuję regulamin</span>
            </label>
            <?php
            if (isset($_SESSION['e_regulamin'])) {
                echo '<div class="error">' .
                    '<div class="error-pojemnik-reg">' . $_SESSION['e_regulamin'] . '</div>' . '</div>';
                unset($_SESSION['e_regulamin']);
            }
            ?>

            <div class="pojemnik-submit">
                <input type="submit" class="rejestracja-button" value="Zarejestruj się" />
            </div>
        </div>
    </form>
</body>

</html>