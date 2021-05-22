<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require $_SERVER['DOCUMENT_ROOT']."/sinaloa/assets/classes/sinaloa.php";
$sinaloa = new sinaloa(); 
echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
# Controle of we al ingelogd zijn
$login = $sinaloa->checkIfLoggedIn();
# Head met script en meta info includen
$sinaloa->includeHead();
?>
    <body>
        <!-- Page Container -->
        <div id="page-container" class="enable-page-overlay side-scroll main-content-boxed">
            <!-- Main Container -->
            <main id="main-container">
                <!-- Hero -->
                <div class="bg-body-light border-top border-bottom">
                    <div class="content content-full py-1">
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                            <h1 class="flex-sm-fill font-size-sm text-uppercase font-w700 mt-2 mb-0 mb-sm-2">
                                <i class="fa fa-angle-right fa-fw text-primary isAdmin" isAdmin="<?= $login['admin'] ?>"></i>Welkom, <?= $login['naam'] ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Hero -->
                <!-- Page Content -->
                <div class="content">
                    <div class="block block-bordered js-classic-nav d-none d-sm-block">
                        <div class="block-content block-content-full">
                            <div class="row no-gutters border">
                                <div class="col-lg-6 col-xl-3 invisible" data-toggle="appear">
                                    <a class="block block-bordered block-link-pop text-center mb-0" type="submit" href="https://tom974.dev/sinaloa/wiet">
                                        <div class="block-content block-content-full text-center">
                                            <div class="py-2">
                                                <i class="fa fa-2x fas far fa-arrow-alt-circle-up text-primary d-none d-sm-inline-block mb-3"></i>
                                                <div><strong>Naar Wiet</strong></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-xl-3 invisible" data-toggle="appear">
                                    <a class="block block-bordered block-link-pop text-center mb-0" type="submit" href="https://tom974.dev/sinaloa/coke">
                                        <div class="block-content block-content-full text-center">
                                            <div class="py-2">
                                                <i class="fa fa-2x fas fa-address-card text-primary d-none d-sm-inline-block mb-3"></i>
                                                <div><strong>Naar Coke</strong></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-xl-3 invisible" data-toggle="appear">
                                    <a class="block block-bordered block-link-pop text-center mb-0" type="submit" href="https://tom974.dev/sinaloa/meth">
                                        <div class="block-content block-content-full text-center">
                                            <div class="py-2">
                                                <i class="fa fa-2x far fa-gem text-primary d-none d-sm-inline-block mb-3"></i>
                                                <div><strong>Naar Meth</strong></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-xl-3 invisible" data-toggle="appear">
                                    <a class="block block-bordered block-link-pop text-center mb-0" type="submit" href="https://tom974.dev/sinaloa/admin">
                                        <div class="block-content block-content-full text-center">
                                            <div class="py-2">
                                                <i class=" fa-2x fas far fa-arrow-alt-circle-up text-primary d-none d-sm-inline-block mb-3"></i>
                                                <div><strong>Naar Admin</strong></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="https://tom974.dev/sinaloa/assets/js/dashmix.core.min.js"></script>
        <script src="https://tom974.dev/sinaloa/assets/js/dashmix.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="https://tom974.dev/sinaloa/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

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
