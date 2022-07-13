<?php
session_start();

require_once 'database.php';

$tbl = $db->query("SELECT * FROM serwis");
$userQuery = $tbl->fetchAll();
// $tbl->execute();

if (isset($_GET['status'])) {
    $status = isset($_GET['status']) ? strval($_GET['status']) : 0;
    $status = htmlspecialchars($status);
    $query2 = $db->prepare("SELECT * FROM serwis WHERE status LIKE :status");
    $query2->bindValue(':status', $status, PDO::PARAM_STR);
    $query2->execute(array('%' . $status . '%'));
    $userQuery = $query2->fetchAll();
}
if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $id = htmlspecialchars($id);
    $query1 = $db->prepare("SELECT * FROM serwis WHERE id LIKE :id");
    $query1->bindValue(':id', $id, PDO::PARAM_INT);
    $query1->execute();
    $userQuery = $query1->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Panel administracyjny</title>
    <meta name="description" content="Używanie PDO - odczyt z bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="./css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">

        <main>
            <form class="section_pokaz">

                <table>
                    <thead>
                        <tr>
                            <th colspan="3">Ilość serwisów w bazie: <?= $tbl->rowCount() ?></th>
                            <th colspan="1"><a href="http://localhost:8081/new/pokaz_serwis.php">All</a></th>
                            <th colspan="2">

                                <select class="status_label" name="status" id="status" onchange="this.form.submit()" required>
                                    <option>Szukaj</option>
                                    <option>Do akceptacji</option>
                                    <option>W trakcie</option>
                                    <option>Zakończony</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="10">Przeprowadzone serwisy</th>
                        </tr>
                        <tr>
                            <th class="header">
                                <!-- <input type="text" name="id"> -->

                            </th>
                            <th class="header">
                                <select>
                                    <?php
                                    foreach ($serwis2 as $admin) {

                                        echo "<option>                           
                                        {$admin['admin']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th class="header">
                                <select>
                                    <?php
                                    foreach ($serwis3 as $data) {

                                        echo "<option>                           
                                        {$data['data']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th class="header">
                                <!-- <input type="text" name="nazwa"> -->


                            </th>
                            <th class="header">
                                <input type="text" name="imie">
                                <!-- <select name="imie" onchange="this.form.submit()">
                                    <option>Szukaj</option>
                                    <?php
                                    foreach ($tbl as $value) {

                                        echo "<option>                           
                                        {$value['imie']}                           
                                        </option>";
                                    }
                                    ?>
                                </select> -->
                            </th>
                            <th class=" header">
                                <select>
                                    <?php
                                    foreach ($tbl as $value) {

                                        echo "<option>                           
                                        {$value['nazwisko']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th class="header">
                                <select>
                                    <?php
                                    foreach ($serwis7 as $podzespol) {

                                        echo "<option>                           
                                        {$podzespol['podzespol']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th class="header">
                                <select>
                                    <?php
                                    foreach ($serwis8 as $naleznosc) {

                                        echo "<option>                           
                                        {$naleznosc['naleznosc']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>
                            <th class="header">
                                <select>
                                    <?php
                                    foreach ($serwis9 as $zysk) {

                                        echo "<option>                           
                                        {$zysk['zysk']}                           
                                        </option>";
                                    }
                                    ?>
                                </select>
                            </th>

                            </th>
                        </tr>
                        <tr>
                            <th class="header">Id</th>
                            <th class="header">Admin</th>
                            <th class="header">Data</th>
                            <th class="header">Sprzet</th>
                            <th class="header">Marka</th>
                            <th class="header">Model</th>
                            <th class="header">Zestaw</th>
                            <th class="header">Opis usterki</th>
                            <th class="header">Nazwa</th>
                            <th class="header">Ilość</th>
                            <th class="header">Cena podz</th>
                            <th class="header">Cena usługi</th>
                            <th class="header">Marza</th>
                            <th class="header">Rabat</th>
                            <th class="header">Należność</th>
                            <th class="header">Zysk</th>
                            <th class="header">Status</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // while ($row = mysqli_fetch_array($userQuery)) {
                        //     echo "<tr>
                        //     //     <td class='b1'>{$row['id']}</td>
                        //     //     <td class='b1'>{$row['uzytkownik']}</td>
                        //     //     <td class='b1'>{$row['data']}</td>
                        //     //     <td class='b1'>{$row['nazwa']}</td>
                        //     //     <td class='b1'>{$row['imie']}</td>
                        //     //     <td class='b1'>{$row['nazwisko']}</td>
                        //     //     <td class='b1'>{$row['podzespol']}</td>
                        //     //     <td class='b1'>{$row['naleznosc']}</td>
                        //     //     <td class='b1'>{$row['zysk']}</td>
                        //     //     <td class='b1'>{$row['status']}</td>
                        //     //     </tr>";
                        // }
                        foreach ($userQuery as $value) {
                            echo "<tr>
                            <td class='b1'>{$value['id']}</td>
                            <td class='b1'>{$value['admin']}</td>
                            <td class='b1'>{$value['data']}</td>
                            <td class='b1'>{$value['sprzet']}</td>
                            <td class='b1'>{$value['marka']}</td>
                            <td class='b1'>{$value['model']}</td>
                            <td class='b1'>{$value['zestaw']}</td>
                            <td class='b1'>{$value['opis_usterki']}</td>
                            <td class='b1'>{$value['nazwa']}</td>
                            <td class='b1'>{$value['ilosc']}</td>
                            <td class='b1'>{$value['cena_podz']}</td>
                            <td class='b1'>{$value['cena_uslugi']}</td>
                            <td class='b1'>{$value['marza']}</td>
                            <td class='b1'>{$value['rabat']}</td>
                            <td class='b1'>{$value['naleznosc']}</td>
                            <td class='b1'>{$value['zysk']}</td>
                            <td class='b1'>{$value['status']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                foreach ($userQuery as $value) {

                    echo "<div class='serwis1'>
                    {$value['opis_usterki']}
                    {$value['status']}
                </div>";
                }
                ?>
                <!-- <input type="submit" value="wyszukaj"> -->
            </form>
        </main>

    </div>

</body>

</html>