<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$version = '1.0.1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ep = [];
    $totalEp = 0;
    foreach ($_POST as $pokemon => $values) {
        $candy = (int)$values['candy'];
        $count = (int)$values['count'];

        $maxEvolve = floor($candy / 12);
        $maxEvolve = $count < $maxEvolve ? $count : $maxEvolve;

        $ep[$pokemon] = array(
            'ep' => $maxEvolve * 500 * 2,
            'maxEvolve' => $maxEvolve,
            'count' => $count,
            'candy' => $candy,
        );

        $totalEp += $ep[$pokemon]['ep'];
    }
} else {
    $totalEp = 0;
    $ep = array();
}
?>


<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="robots" content="index, follow">

        <title>Taubsirechner</title>
        <style>
            body {
                font-size: 25px;
                color: #212121;
                font-family: "brandon-grotesque", sans-serif;
                margin: 10% 10% 0 10%;
                background-color: #fafafa
            }

            @media screen and (max-device-width: 360px) {
                body {
                    margin: 10px 10px 0 10px
                }
            }

            @media screen and (min-device-width: 1280px) {
                body {
                    width: 1024px;
                    margin-left: auto;
                    margin-right: auto
                }
            }

            h1 {
                font-size: 1.5em;
                margin-top: 0
            }

            .card {
                box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.2);
                padding: 20px;
                margin-bottom: 1em;
                background-color: white
            }

            .card p {
                margin: 0
            }

            .row {
                width: 100%
            }

            .col-1-3 {
                display: inline-block;
                width: 31%
            }

            a:link, a:visited, a:hover, a:active {
                text-decoration: none;
                color: #212121
            }

            input {
                box-sizing: border-box;
                font-size: .8em;
                border: 0;
                border-radius: 5px;
                background: #fafafa;
                margin: 10px 0 10px 0;
                padding: 10px;
                box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.2);
                width: 100%
            }

            input[type=submit] {
                cursor: pointer;
                background: #ffffff
            }

            .alert {
                margin-bottom: 1em;
                color: green
            }
        </style>
    </head>
    <body>

        <div class="card">
            <h1><a href="" title="Taubsirechner">Taubsirechner</a></h1>

            <p>Hier kannst du berechnen, wie viele EP deine Pokemon bringen, wenn du ein Glücksei nutzt</p>
        </div>

        <?php if (!empty($ep)) { ?>
            <div class="alert card">
                Wenn du deine Pokemon entwickelst und dabei ein Glücksei verwendest, dann erhältst du <?= $totalEp; ?> EP. <br>
                <br>
                Entwickelbare Pokemon:
                <ul>
                    <?php
                    foreach ($ep as $pokemon => $values) {
                        echo '<li>' . ucfirst($pokemon) . ': ' . $values['maxEvolve'] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
        <form method="post" class="card">
            <div class="row">
                <label for="taubsi" class="col-1-3">Taubsis</label>
                <input type="number" class="col-1-3" name="taubsi[count]" id="taubsi" value="<?= $ep['taubsi']['count']; ?>" placeholder="Anzahl">
                <input type="number" class="col-1-3" name="taubsi[candy]" id="taubsi" value="<?= $ep['taubsi']['candy']; ?>" placeholder="Bonbons">
            </div>

            <div class="row">
                <label for="hornliu" class="col-1-3">Hornlius</label>
                <input type="number" class="col-1-3" name="hornliu[count]" id="hornliu" value="<?= $ep['hornliu']['count']; ?>" placeholder="Anzahl">
                <input type="number" class="col-1-3" name="hornliu[candy]" id="hornliu" value="<?= $ep['hornliu']['candy']; ?>" placeholder="Bonbons">
            </div>
            <div class="row">
                <label for="raupy" class="col-1-3">Raupys</label>
                <input type="number" class="col-1-3" name="raupy[count]" id="raupy" value="<?= $ep['raupy']['count']; ?>" placeholder="Anzahl">
                <input type="number" class="col-1-3" name="raupy[candy]" id="raupy" value="<?= $ep['raupy']['candy']; ?>" placeholder="Bonbons">
            </div>

            <div class="row">
                <div class="col-1-3"></div>
                <div class="col-1-3"></div>
                <input type="submit" class="col-1-3" value="berechne">
            </div>
        </form>
    </body>
</html>
