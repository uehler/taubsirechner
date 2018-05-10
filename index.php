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
        <link href="css/all.css?v=<?php echo str_replace('.', '', $version); ?>" rel="stylesheet">
    </head>
    <body>

        <div class="card">
            <h1><a href="" title="Taubsirechner">Taubsirechner</a></h1>

            <p>Hier kannst du berechnen, wie viele EP deine Pokemon bringen, wenn du ein Glücksei nutzt</p>
        </div>

        <?php if (!empty($ep)) { ?>
            <div class="alert card">
                Wenn du deine Pokemon entwickelst und dabei ein Glücksei verwendest, dann erhälts du <?= $totalEp; ?> EP. <br>
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
