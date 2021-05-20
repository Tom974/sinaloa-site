<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
session_start();
require $_SERVER['DOCUMENT_ROOT']."/sinaloa/assets/classes/sinaloa.php";
$sinaloa = new sinaloa();
# Controle of we al ingelogd zijn
$login = $sinaloa->checkIfLoggedIn();
if (!is_array($login)) {
    echo $login;
}
echo $sinaloa->checkAccess("admin", $login);
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
                    <!-- Switches -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Administratie Paneel</h3>
                        </div>
                        <div class="block-content">
                            <!-- Default -->
                            <h2 class="content-heading">Welkom, Tom Kanon</h2>
                            <div class="row push">

                    <!-- Dynamic Table Full -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title font-w600">Loodsen <small>Paneel</small></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th>Type</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Aantal pers.</th>
                                        <th style="width: 15%;">Opslag</th>
                                        <th style="width: 15%;">Productiviteit</th>
                                        <th style="width: 15%;">Batch Grootte</th>
                                        <th style="width: 15%;">Plaats Beschikbaar?</th>
                                        <th style="width: 15%;">Ingredienten In Loods</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td class="text-center">1</td>
                                        <td class="font-w600">
                                            <a href="wiet.php">Wiet</a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="8 man">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="3000">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="5 = 1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="75">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="Ja">
                                        </td>
                                        <td>
                                        
                                        <span class="text-center font-w600">1000</span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="font-w600">
                                            <a href="wiet.php">Meth</a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="8 man">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="1000">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="5 = 1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="75">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control font-w600" id="example-text-input" name="example-text-input" placeholder="Ja">
                                        </td>
                                        <td>
                                        
                                        <span class="text-center font-w600">1.000</span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <!-- Dynamic Table Full -->
                        <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title font-w600">Gebruikers <small>Paneel</small></h3>
                        </div>
                        <div id="datatable" class="block-content block-content-full" style="float: center;">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">#</th>
                                        <th>Gebruikersnaam</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Naam</th>
                                        <th style="width: 15%;">Achternaam</th>
                                        <th style="width: 15%;">Telefoonnummer</th>
                                        <th style="width: 15%;">Wiet</th>
                                        <th style="width: 15%;">Coke</th>
                                        <th style="width: 15%;">Meth</th>
                                        <th style="width: 15%;">Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    # PHP Code om alle gebruikers informatie op te halen.


                                        $result = $sinaloa->execute("SELECT * FROM gebruikers ORDER BY ID ASC;", '', 'fetchAll');
                                        foreach($result as $persoon) {
                                            $checked_wiet = ($persoon['wiet_toegang'] == 1) ? "checked" : "";
                                            $checked_coke = ($persoon['coke_toegang'] == 1) ? "checked" : "";
                                            $checked_meth = ($persoon['meth_toegang'] == 1) ? "checked" : "";
                                            $checked_admin = ($persoon['admin'] == 1) ? "checked" : "";
                                            echo '                                    <tr class="data">
                                            <td class="text-center">'.$persoon['id'].'</td>
                                            <td class="font-w600">
                                                <a href="wiet.php">'.$persoon['gebruikersnaam'].'</a>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600 naam">
                                                <span class="text-center">'.$persoon['naam'].'</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600">
                                                <span class="text-center">'.$persoon['achternaam'].'</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600">
                                                <span class="text-center">'.$persoon['telefoonnummer'].'</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600 type">
                                                <div class="custom-control custom-switch custom-control-lg custom-control-inline mb-2">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="example-sw-custom-inline-lg-'.$persoon['naam'].'-wiet" name="example-sw-custom-inline-lg-'.$persoon['naam'].'-wiet" '.$checked_wiet.'>
                                                    <label class="custom-control-label" for="example-sw-custom-inline-lg-'.$persoon['naam'].'-wiet"></label>
                                                </div>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600 type">
                                                <div class="custom-control custom-switch custom-control-lg custom-control-inline mb-2">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="example-sw-custom-inline-lg-'.$persoon['naam'].'-coke" name="example-sw-custom-inline-lg-'.$persoon['naam'].'-coke" '.$checked_coke.'>
                                                    <label class="custom-control-label" for="example-sw-custom-inline-lg-'.$persoon['naam'].'-coke"></label>
                                                </div>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600 type">
                                                <div class="custom-control custom-switch custom-control-lg custom-control-inline mb-2">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="example-sw-custom-inline-lg-'.$persoon['naam'].'-meth" name="example-sw-custom-inline-lg-'.$persoon['naam'].'-meth" '.$checked_meth.'>
                                                    <label class="custom-control-label" for="example-sw-custom-inline-lg-'.$persoon['naam'].'-meth"></label>
                                                </div>
                                            </td>
                                            <td class="d-none d-sm-table-cell font-w600 type">
                                                <div class="custom-control custom-switch custom-control-lg custom-control-inline mb-2">
                                                    <input type="checkbox" class="custom-control-input checkbox" id="example-sw-custom-inline-lg-'.$persoon['naam'].'-admin" name="example-sw-custom-inline-lg-'.$persoon['naam'].'-admin" '.$checked_admin.'>
                                                    <label class="custom-control-label" for="example-sw-custom-inline-lg-'.$persoon['naam'].'-admin"></label>
                                                </div>
                                            </td>
                                        </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <script>
                            jQuery(function() {
                                $('.btn-opslaan').on('click', function () {
                                    Swal.fire({
                                    title: 'Correcte informatie?',
                                    text: "Weet je zeker dat dit de correcte informatie is?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ja, Opslaan!'
                                        }).then((result) => {
                                        if (result.isConfirmed) {

                                            $('.naam').each(function () {

                                            })
                                            Swal.fire(
                                            'Opgeslagen!',
                                            '',
                                            'success'
                                            )
                                        }
                                    })
                                });
                            })
                            </script>
                            <button type="submit" class="btn btn-primary btn-opslaan" style="float: right;">Opslaan</button>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                    </div>
                    <!-- END Default -->
                </div>
                <!-- END Page Content -->
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
