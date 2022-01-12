<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grzybobranie</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>

<section class="header">

    <div class="mini">
        <a href="img/borowik.jpg">
            <img src="img/borowik-miniatura.jpg" alt="Grzybobranie">
        </a>
    </div>
    <div class="title">
        <h1>Idziemy na grzyby!</h1>
    </div>
</section>

<section class="main" >
    <div class="lewy">
        <?php

        $connection = new mysqli("localhost", "root", "", "dane2");
        $result = $connection->query("SELECT `nazwa_pliku`, `potoczna` FROM `grzyby`;");

        foreach ($result as $row) {
            echo '<img src="img/' . $row['nazwa_pliku'] . '" title="' . $row['potoczna'] . '">';
        }

        $connection->close();
        ?>
    </div>
    <div class="prawy">
        <h2>Grzyby jadalne</h2>
        <?php

        $connection = new mysqli("localhost", "root", "", "dane2");
        $result = $connection->query("SELECT `nazwa`,`potoczna` FROM `grzyby` WHERE `jadalny` = 1;");

        foreach ($result as $row) {
            echo '<p>' . $row['nazwa'] . ' (' . $row['potoczna'] . ')</p>';
        }

        $connection->close();
        ?>
        <h2>Polecamy do sosów</h2>
        <?php

        $connection = new mysqli("localhost", "root", "", "dane2");
        $result = $connection->query("SELECT `grzyby`.`nazwa`, `grzyby`.`potoczna`, `rodzina`.`nazwa` AS `rodzina_nazwa`  FROM `grzyby` INNER JOIN `rodzina` ON `grzyby`.`rodzina_id`=`rodzina`.id INNER JOIN `potrawy` ON `grzyby`.`potrawy_id`=`potrawy`.id WHERE `potrawy`.`nazwa` = \"sos\";");

        echo "<ol>";
        foreach ($result as $row) {
            echo '<li> ' . $row['nazwa'] . ' (' . $row['potoczna'] . '), rodzina: ' . $row['rodzina_nazwa'] . '</li>';
        }
        echo "</ol>";

        $connection->close();
        ?>
    </div>
</section>

<section class="footer">
    <p>Autor: SIEMA</p>
</section>

</body>
</html>