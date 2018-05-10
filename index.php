<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$version = '1.0.1';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            'candy' => $candy
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

        <!-- Piwik -->
        <script type="text/javascript">
            var _paq = _paq || [];
            _paq.push(["setDomains", ["*.taubsirechner.de"]]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function () {
                var u = "//piwik.ehlertainment.de/";
                _paq.push(['setTrackerUrl', u + 'piwik.php']);
                _paq.push(['setSiteId', '2']);
                var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
                g.type = 'text/javascript';
                g.async = true;
                g.defer = true;
                g.src = u + 'piwik.js';
                s.parentNode.insertBefore(g, s);
            })();
        </script>
        <noscript><p><img src="//piwik.ehlertainment.de/piwik.php?idsite=2" style="border:0;" alt=""/></p></noscript>
        <!-- End Piwik Code -->

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
        <div class="imprint-container">
            <div class="trigger"><u>Impressum und Datenschutz</u></div>
            <div class="imprint hidden">
                Uli Ehler <br>
                Kleines Bergl 2 <br>
                91257 Pegnitz <br>
                m@uli.io <br>
                <br>
                <br>
                <a href="https://uli.io" style="color:blue; display: block;">uli.io</a>
                <br>
                <br>
                <blockquote>
                    <p>
                        <strong>Analysedienste</strong>
                    </p>
                    <p>
                        Unsere Website verwendet Piwik, dabei handelt es sich um einen sogenannten Webanalysedienst. Piwik verwendet sog. “Cookies”, das sind Textdateien, die auf Ihrem Computer gespeichert werden und die unsererseits eine Analyse der Benutzung der Webseite ermöglichen. Zu diesem Zweck werden die durch den Cookie erzeugten Nutzungsinformationen (einschließlich Ihrer gekürzten IP-Adresse) an unseren Server übertragen und zu Nutzungsanalysezwecken gespeichert, was der Webseitenoptimierung unsererseits dient. Ihre IP-Adresse wird bei diesem Vorgang umge&shy;hend anony&shy;mi&shy;siert, so dass Sie als Nutzer für uns anonym bleiben. Die durch den Cookie erzeugten Informationen über Ihre Benutzung dieser Webseite werden nicht an Dritte weitergegeben. Sie können die Verwendung der Cookies durch eine entsprechende Einstellung Ihrer Browser Software verhindern, es kann jedoch sein, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website voll umfänglich nutzen können.
                    </p>
                    <p>
                        Wenn Sie mit der Spei&shy;che&shy;rung und Aus&shy;wer&shy;tung die&shy;ser Daten aus Ihrem Besuch nicht ein&shy;ver&shy;stan&shy;den sind, dann kön&shy;nen Sie der Spei&shy;che&shy;rung und Nut&shy;zung nachfolgend per Maus&shy;klick jederzeit wider&shy;spre&shy;chen. In diesem Fall wird in Ihrem Browser ein sog. Opt-Out-Cookie abgelegt, was zur Folge hat, dass Piwik kei&shy;ner&shy;lei Sit&shy;zungs&shy;da&shy;ten erhebt. <strong>Achtung</strong>: Wenn Sie Ihre Cookies löschen, so hat dies zur Folge, dass auch das Opt-Out-Cookie gelöscht wird und ggf. von Ihnen erneut aktiviert werden muss.
                    </p>
                    <p>
                        <strong>Widerspruch</strong>:
                    </p>
                    <iframe style="border: 0; height: 200px; width: 600px;" src="http://piwik.ehlertainment.de/index.php?module=CoreAdminHome&action=optOut&language=de"></iframe>

                    <p>
                        Quelle Datenschutzerklärung: <a href="www.datenschutzbeauftragter-info.de">www.datenschutzbeauftragter-info.de</a>
                    </p>
                </blockquote>
            </div>
        </div>


        <script>window.onload = init;

            function init() {
                document.querySelector('.trigger').onclick = triggerImprint;
            }

            function triggerImprint() {
                var imprint = document.querySelector('.imprint');
                console.log(imprint);

                if (imprint.classList.contains('hidden')) {
                    imprint.classList.remove('hidden');
                } else {
                    imprint.classList.add('hidden');
                }
            }</script>
    </body>
</html>
