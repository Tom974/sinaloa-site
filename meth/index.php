<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require $_SERVER['DOCUMENT_ROOT']."/sinaloa/assets/classes/sinaloa.php";
$sinaloa = new sinaloa();
# Controle of we al ingelogd zijn
$login = $sinaloa->checkIfLoggedIn();
if (!is_array($login)) {
    die("de variabele login was leeg! Contacteer Tom974 asap!");
}
echo $sinaloa->checkAccess("meth", $login);
# Head met script en meta info includen
$sinaloa->includeHead();
?>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="enable-page-overlay side-scroll main-content-boxed">
            <?php $sinaloa->includeHeader(); ?>
            <!-- Main Container -->
            <main id="main-container">
                <!-- Hero -->
                <div class="bg-body-light border-top border-bottom">
                    <div class="content content-full py-1">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill font-size-sm text-uppercase font-w700 mt-2 mb-0 mb-sm-2">
                                <i class="fa fa-angle-right fa-fw text-primary isAdmin" isAdmin="<?= $login['admin'] ?>"></i> <?= $login['naam'] ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->
                <!-- Page Content -->
                <div class="content">
                    <!-- Statistics -->
                    <div class="row">
                        <!-- Wallet -->
                        <div class="col-lg-6 invisible" data-toggle="appear">
                            <div class="block block-bordered">
                                <div class="block-content">
                                    <div class="px-sm-3 pt-sm-3 clearfix" style="min-height: 260px;">
                                        <p class="display-4 text-black font-w300 mb-2">
                                            Meth Loods
                                        </p>
                                        <p class="text-muted w-75">
                                            <?php
                                            $aantal_in_loods = $sinaloa->execute('SELECT aantal_planten FROM `meth_aantallen` ORDER BY `id` DESC LIMIT 1', '', "fetch");
                                                            echo "Er passen nog ".(1500 - $aantal_in_loods[0])." ingredienten de loods";
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="block-content p-1 overflow-hidden">
                                    <?php
                                        # php code om de laatste wijzigingen in de loods op te halen
                                        $grafiek = $sinaloa->execute("SELECT aantal_planten FROM `meth_aantallen` ORDER BY `id` ASC LIMIT 8;", '', "fetchAll");
                                        $arr = '[';
                                        foreach($grafiek as $grafie) {
                                            $arr .= $grafie['aantal_planten'].",";
                                        }


                                        $arr = substr($arr, 0, -1);
                                        $arr .= ']';
                                    ?>
                                    <!-- Sparkline Container -->
                                    <span class="js-sparkline" data-type="line"
                                          data-points="<?php echo $arr; ?>"
                                          data-width="100%"
                                          data-height="189px"
                                          data-chart-range-min="320"
                                          data-fill-color="rgba(6,101,208,.1)"
                                          data-spot-color="transparent"
                                          data-min-spot-color="transparent"
                                          data-max-spot-color="transparent"
                                          data-highlight-spot-color="#0665d0"
                                          data-highlight-line-color="#0665d0"
                                          data-tooltip-prefix="Ingredienten:"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Wallet -->

                        <!-- Various Stats -->
                        <div class="col-lg-6 invisible" data-toggle="appear">

                            <!-- Weekly Visits -->
                            <div class="block block-bordered mb-lg-2">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="ml-3">
                                        <p class="font-size-h2 font-w300 text-black mb-0">
                                            <?= ($aantal_in_loods[0] == "") ? "0" : $aantal_in_loods[0] ?>
                                        </p>
                                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                                            Ingredienten in de loods
                                        </a>
                                    </div>
                                    <div>
                                        <!-- Sparkline Container -->
                                        <span class="js-sparkline" data-type="line"
                                              data-points="[352,480,698,758,523,625,780]"
                                              data-width="100px"
                                              data-height="60px"
                                              data-line-color="#689550"
                                              data-fill-color="rgba(104,149,80,.1)"
                                              data-spot-color="transparent"
                                              data-min-spot-color="transparent"
                                              data-max-spot-color="transparent"
                                              data-highlight-spot-color="#689550"
                                              data-highlight-line-color="#689550"
                                              data-tooltip-suffix="*"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="block block-bordered mb-lg-2">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="ml-3">
                                        <p class="font-size-h2 font-w300 text-black mb-0">
                                            <?= ($aantal_in_loods['aantal_planten'] / 5) ?>
                                        </p>
                                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                                            Omgerekend Zakjes
                                        </a>
                                    </div>
                                    <div>
                                        <!-- Sparkline Container -->
                                        <span class="js-sparkline" data-type="line"
                                              data-points="[15,18,22,19,16,21,19]"
                                              data-width="100px"
                                              data-height="60px"
                                              data-line-color="#3c90df"
                                              data-fill-color="rgba(60,144,223,.1)"
                                              data-spot-color="transparent"
                                              data-min-spot-color="transparent"
                                              data-max-spot-color="transparent"
                                              data-highlight-spot-color="#3c90df"
                                              data-highlight-line-color="#3c90df"
                                              data-tooltip-suffix="*"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Weekly Followers -->
                            <div class="block block-bordered mb-lg-2">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="ml-3">
                                        <p class="font-size-h2 font-w300 text-black mb-0">
                                        <?php
                                        $lastadded = $sinaloa->execute("SELECT naam FROM `meth_activiteit` WHERE `actie` LIKE 'toegevoegd' ORDER BY timestamp DESC LIMIT 1", '', 'fetch');
                                        echo ($lastadded['naam'] == "") ? "Onbekend" : $lastadded['naam'];
                                        ?>
                                        </p>
                                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                                            Laatst toegevoegd
                                        </a>
                                    </div>
                                    <div>
                                        <!-- Sparkline Container -->
                                        <span class="js-sparkline" data-type="line"
                                              data-points="[89,78,115,98,82,136,112]"
                                              data-width="100px"
                                              data-height="60px"
                                              data-line-color="#ffb119"
                                              data-fill-color="rgba(255,177,25,.1)"
                                              data-spot-color="transparent"
                                              data-min-spot-color="transparent"
                                              data-max-spot-color="transparent"
                                              data-highlight-spot-color="#ffb119"
                                              data-highlight-line-color="#ffb119"
                                              data-tooltip-suffix="*"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- END Weekly Followers -->

                            <!-- Weekly Tickets -->
                            <div class="block block-bordered mb-lg-2">
                                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                    <div class="ml-3">
                                        <p class="font-size-h2 font-w300 text-black mb-0">
                                            <?php
                                            $lastremoved = $sinaloa->execute("SELECT naam FROM `meth_activiteit` WHERE `actie` LIKE 'verwijderd' ORDER BY timestamp DESC LIMIT 1", '', 'fetch');
        
                                            echo ($lastremoved['naam'] == "" || !$lastremoved) ? "Onbekend" : $lastremoved['naam'];

                                            ?>
                                        </p>
                                        <a class="link-fx font-size-sm font-w600 text-muted text-uppercase mb-0" href="javascript:void(0)">
                                            Laatst Verwijderd
                                        </a>
                                    </div>
                                    <div>
                                        <!-- Sparkline Container -->
                                        <span class="js-sparkline" data-type="line"
                                              data-points="[1,6,3,5,4,8,2]"
                                              data-width="100px"
                                              data-height="60px"
                                              data-line-color="#e04f1a"
                                              data-fill-color="rgba(224,79,26,.1)"
                                              data-spot-color="transparent"
                                              data-min-spot-color="transparent"
                                              data-max-spot-color="transparent"
                                              data-highlight-spot-color="#e04f1a"
                                              data-highlight-line-color="#e04f1a"
                                              data-tooltip-suffix="*"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- END Weekly Tickets -->
                        </div>
                        <!-- END Various Stats -->
                    </div>
                    <!-- END Statistics -->

                    <!-- Latest Orders and Customers -->
                    
                    <form class="form-inline mb-4" method="POST">
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="planten_toegevoegd" name="planten_toegevoegd" placeholder="Ingredienten Toegevoegd..">
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="zakjes_verwijderd" name="zakjes_verwijderd" placeholder="Zakjes Verwijderd..">
                        <button name="save_amounts_meth" id="save_amounts_meth" class="btn btn-primary">Opslaan</button>
                    </form>

                    <?php
                    if (isset($_POST['save_amounts_meth'])) {
                        if (!isset($_POST['planten_toegevoegd'])) {
                            $planten_toegevoegd = 0;
                        } else {
                            if (is_numeric($_POST['planten_toegevoegd'])) {
                                $planten_toegevoegd = $_POST['planten_toegevoegd'];
                            } else {
                                $planten_toegevoegd = 0;
                            }
                        }

                        if (!isset($_POST['zakjes_verwijderd'])) {
                            $zakjes_verwijderd = 0;
                        } else {
                            if (is_numeric($_POST['zakjes_verwijderd'])) {
                                $zakjes_verwijderd = $_POST['zakjes_verwijderd'];
                                $planten_verwijderd = ($_POST['zakjes_verwijderd'] * 5);
                            } else {
                                $zakjes_verwijderd = 0;
                                $planten_verwijderd = 0;
                            }
                        } 
                        echo $sinaloa->saveChanges("meth", $login, $zakjes_verwijderd, $planten_verwijderd, $planten_toegevoegd);
                    }
                    ?>

                    <div class="row row-deck">
                        <!-- Jouw loods informatie -->
                        <div class="col-lg-12 invisible" data-toggle="appear">
                            <div class="block block-bordered">
                                <div class="block-header border-bottom">
                                    <h3 class="block-title">Jouw aantal in de meth loods</h3>
                                </div>
                                <div class="block-content block-content-full block-content-sm">
                                    <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                                        <thead class="thead-light">
                                            <tr class="text-uppercase">
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Naam</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Aantal Ingredienten</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Aantal Zakjes</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Aantal Zakjes Pakken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $result = $sinaloa->execute("SELECT * FROM `meth_personen` ORDER BY naam DESC", [], "fetchAll");
                                                foreach ($result as $results) {
                                                    if (($results['naam'] == $login['naam']) && $results['aantal_planten'] <= 25) {
                                                        echo "<script>Swal.fire({
                                                            icon: 'warning',
                                                            title: 'Let op',
                                                            text: 'Je hebt op dit moment 25 of minder ingredienten in de loods zitten. Deze verwerken niet!! je moet er dus meer in doen!',
                                                            timer: 3000
                                                        });</script>";
                                                    }

                                                    echo ' 
                                                    <tr>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <span class="font-w700">'.$results['naam'].'</span>
                                                        </td>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.($results['aantal_planten'] ?? "0").'</a>
                                                        </td>                                                        
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.(($results['aantal_planten'] / 5) ?? "0").'</a>
                                                        </td>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.(floor($results['zakjes_beschikbaar']) ?? "0").'</a>
                                                        </td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END Jouw Loods Informatie Customers -->
                        <!-- Latest Customers -->
                        <div class="col-lg-12 invisible" data-toggle="appear">
                            <div class="block block-bordered">
                                <div class="block-header border-bottom">
                                    <h3 class="block-title">Laatste acties meth loods</h3>
                                </div>
                                <div class="block-content block-content-full block-content-sm">
                                    <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                                        <thead class="thead-light">
                                            <tr class="text-uppercase">
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Tijdstip</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Naam</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Actie</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Ingredienten Toegevoegd</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Zakjes Verwijderd</th>
                                                <th class="d-none d-sm-table-cell font-w700 text-center">Loods Zakjes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $results = $sinaloa->execute("SELECT * FROM `meth_activiteit` ORDER BY `timestamp` DESC LIMIT 100;", "", "fetchAll");
                                            foreach($results as $persoon) {
                                                $actie = "Error";
                                                if ($persoon["toegevoegd_planten"] == 0 && $persoon["verwijderd_planten"] >= 1)
                                                    $actie = "Verwijderd";
                                                if ($persoon['toegevoegd_planten'] >= 1 && $persoon["verwijderd_planten"] == 0)
                                                    $actie = "Toegevoegd";
                                                if ($persoon["toegevoegd_planten"] >= 1 && $persoon["verwijderd_planten"] >= 1)
                                                    $actie = "Beide";

                                                echo ' 
                                                    <tr>
                                                        <td>
                                                            <span class="d-none d-sm-table-cell text-center font-w600">'.$persoon['naam'].'</span>
                                                        </td>
                                                        <td>
                                                            <span class="d-none d-sm-table-cell text-center font-w600">'.$actie.'</span>                      
                                                        </td>
                                                        <td>
                                                            <span class="d-none d-sm-table-cell text-center font-w600">'.$persoon['timestamp'].'</span>                          
                                                        </td>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.$persoon['toegevoegd_planten'].'</a>
                                                        </td>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.($persoon['verwijderd_planten'] / 5).'</a>
                                                        </td>
                                                        <td class="d-none d-sm-table-cell text-center">
                                                            <a class="font-w700">'.($persoon["aantal_zakjes_inloods"] ?? "NULL").'</a>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END Latest Customers -->
                    </div>
                    <!-- END Latest Orders and Customers -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
            <!-- BEGIN Footer -->  
            <?php
                    $sinaloa->includeFooter(); ?>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/dashmix.core.min.js"></script>
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/dashmix.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <!-- Page JS Helpers (jQuery Sparkline Plugin) -->
        <script>jQuery(function () {
                Dashmix.helpers('sparkline');
            });</script>
    </body>
</html>
