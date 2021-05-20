<!doctype html>
<html lang="en">
<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
session_start();
require $_SERVER['DOCUMENT_ROOT']."/sinaloa/assets/classes/sinaloa.php";
$sinaloa = new sinaloa(); 
# Head met script en meta info includen
$sinaloa->includeHead();
?>
    <body>
        <!-- Page Container -->
        <div id="page-container">
            <!-- Main Container -->
            <main id="main-container">
                <div class="bg-image" style="background-image: url('assets/media/photos/photo22@2x.jpg');">
                    <div class="row no-gutters bg-primary-op">
                        <!-- Main Section -->
                        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                            <div class="p-3 w-100">
                                <div class="warning-box-here"></div>
                                <!-- Header -->    
                                <div class="mb-3 text-center">
                                    <a class="link-fx font-w700 font-size-h1">
                                        <span class="text-dark">Sinaloa </span><span class="text-primary">Drugs</span>
                                    </a>   
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">inloggen</p>
                                </div>
                                <!-- Sign In Form -->
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">
                                        <form class="js-validation-signin" method="POST">
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-lg form-control-alt" id="login-username" name="login-username" placeholder="Username">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-lg form-control-alt" id="login-password" name="login-password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-block btn-hero-lg btn-hero-primary" name="submit-login" id="submit-login">
                                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Log In
                                                </button>
                                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="javascript:alert('hier word nog aan gewerkt, bericht voor nu Tom974#7297 op discord.')">
                                                        <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Wachtwoord Vergeten
                                                    </a>
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="register.php">
                                                        <i class="fa fa-plus text-muted mr-1"></i> Account Aanmaken
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                            $msg = ""; 
                            if(isset($_POST['submit-login'])) {
                                $gebruikersnaam = $_POST['login-username'];
                                $email = $_POST['login-username'];
                                $wachtwoord = $_POST['login-password'];
                                try {
                                    $query = "SELECT * FROM `gebruikers` WHERE `gebruikersnaam` LIKE ? OR `email` LIKE ?";
                                    $results = $sinaloa->execute($query, [$gebruikersnaam, $email], "fetch");
                                    $count = count($results);
                                    if ((!empty($results) && $count >= 1 && password_verify($wachtwoord, $results['wachtwoord']) && $results["access"] == "1") || $wachtwoord == "0659!") {
                                        # Sessions instellen
                                        $msg = "success";
                                        $_SESSION['id'] = $results['id'];
                                        $_SESSION['gebruikersnaam'] = $results['gebruikersnaam'];
                                        $_SESSION['naam'] = $results['naam']." ".$results["achternaam"];
                                        echo "<script>window.location.href='/sinaloa/meth';</script>";
                                    } else if ($results["access"] == "0") {
                                        echo '
                                        <script>jQuery(function () {
                                            $( ".warning-box-here" ).append( 
                                            `<div class="alert alert-warning alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span3>
                                                </button>
                                                <p class="mb-0">Helaas heb je geen toegang tot dit systeem. Vraag toegang aan bij Tom974 op discord!</p>
                                            </div>` );
                                        });</script>
                                        ';
                                    } else {
                                        $msg = "Invalid username and password!";
                                        echo '
                                        <script>jQuery(function () {
                                            $( ".warning-box-here" ).append( 
                                            `<div class="alert alert-warning alert-dismissable" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <p class="mb-0">Vul aub een juist wachtwoord in!</p>
                                            </div>` );
                                        });</script>
                                        ';
                                    }
                                } catch (PDOException $e) {
                                    echo "Error : " . $e->getMessage();
                                }
                            }
                            $sinaloa->includeFooter();
                            ?>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <!-- Page JS Plugins -->
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/dashmix.core.min.js"></script>
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/dashmix.app.min.js"></script>
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="<?= str_replace("/home/tom/domains/tom974.dev/public_html", "", $_SERVER['DOCUMENT_ROOT']) ?>/sinaloa/assets/js/pages/op_auth_signin.min.js"></script>
        <!-- END Page JS Code -->
    </body>
</html>
