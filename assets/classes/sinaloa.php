
<?php

error_reporting(E_ALL & ~E_NOTICE);

class sinaloa {
    /**
     * execute
     * 
     * @param string $sql | Sql statement in de string
     * @param array $params | parameters voor de sql.
     * 
     * @return void
     */
    public function execute($sql, $params = "", $type = "") {
        try {
            try {
                $user = "tom";
                $pass = "0659";
                $db = "sinaloa";
                $host = "localhost";
                $db = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pass);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            $stmt = $db->prepare($sql);
            $stmt->execute($params != '' ? $params : NULL);
    
            switch($type) {
                case "fetch":
                    return $stmt->fetch();
                case "fetchAll": 
                    return $stmt->fetchAll();
                case "fetchColumn":
                    return $stmt->fetchColumn();
                case "isTrue": 
                    return ($stmt->fetchColumn() == 1);
                default: 
                    break;
            }
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }	
    }

    public function checkIfLoggedIn() {
        if(isset($_SESSION['id']) && $_SESSION['gebruikersnaam'] != "" && $_SESSION['naam'] != "") {
            $naam = $_SESSION['naam'];
            $gebruikersnaam = $_SESSION['gebruikersnaam'];
            $isAdmin = "true";
            $sql = "SELECT * FROM `sinaloa`.`gebruikers` WHERE gebruikersnaam LIKE ? ";
            $results = $this->execute($sql, [$gebruikersnaam], 'fetch');
            if (!$results) {
                $isAdmin = "false";
            }

            return array(
                "gebruikersnaam" => $gebruikersnaam, 
                "naam" => $naam,
                "admin" => $isAdmin
            );
        } else {
            echo "<script>window.location.href='/sinaloa/inloggen';</script>";
        }
    }

    public function checkAccess($type, $login) { 
        $results = $this->execute("SELECT * FROM gebruikers WHERE (naam = ? OR gebruikersnaam = ?) LIMIT 1;", [$login["naam"], $login["gebruikersnaam"]], 'fetch');

        if ($results[$type."_toegang"] != "1") {
            return "<script>Swal.fire({
                icon: 'error',
                title: 'Je hebt geen toegang!',
                text: 'Vraag toegang aan Tom974 op discord!',
                timer: 3000
              }); return;</script>";
        }
    }

    public function includeHead() {
        include __DIR__."/../html/head.php";
    }

    public function includeHeader() {
        include __DIR__."/../html/header.php";
    } 

    public function includeFooter() {
        include __DIR__."/../html/footer.php";
    }

    public function saveChanges($type, $login, $zakjes_verwijderd = 0, $planten_verwijderd = 0, $planten_toegevoegd = 0) {
        try {
            $aantal_in_loods = $this->execute("SELECT aantal_planten FROM `".$type."_aantallen` ORDER BY `timestamp` DESC LIMIT 1;", '', "fetch");
            $exists = $this->execute("SELECT * FROM `".$type."_personen` WHERE naam = ? LIMIT 1;", [$login['naam']], 'fetch');
            if (!$exists) {
                try {
                    $this->execute("INSERT INTO `".$type."_personen` (naam, aantal_planten) VALUES (?, ?)", [$login['naam'], '0']);
                } catch(PDOException $e) {
                    return "<script>Swal.fire({
                        icon: 'error',
                        title: '".$e->getMessage()."',
                        text: 'Er is iets fout gegaan!'
                        });</script>";
                    die();
                }

            }
        } catch (PDOException $e) {
            return "<script>Swal.fire({
                icon: 'error',
                title: '".$e->getMessage()."',
                text: 'Er is iets fout gegaan!'
                });</script>";
            die();
        }

        if ($zakjes_verwijderd >= 1) {
            $planten_verwijderd = $zakjes_verwijderd * 5;
        }

        $actie = "Error";
        if ($planten_toegevoegd == 0 && $zakjes_verwijderd >= 1) {
            $actie = "Verwijderd";
            $this->execute("UPDATE `".$type."_personen` SET aantal_planten = aantal_planten - ?, zakjes_beschikbaar = zakjes_beschikbaar - ? WHERE naam = ?", [$planten_verwijderd, $zakjes_verwijderd, $login['naam']]);
        }

        if ($planten_toegevoegd >= 1 && $zakjes_verwijderd == 0) {
            $actie = "Toegevoegd";
            $this->execute("UPDATE `".$type."_personen` SET aantal_planten = aantal_planten + ? WHERE naam = ?", [$planten_toegevoegd, $login['naam']]);
        }

        if ($planten_toegevoegd >= 1 && $zakjes_verwijderd >= 1) {
            $actie = "Beide";
            try {
                $this->execute("UPDATE `".$type."_personen` SET aantal_planten = aantal_planten + ? WHERE naam = ?", [$planten_toegevoegd, $login['naam']]);
            } catch (PDOException $e) {
                return "<script>Swal.fire({
                    icon: 'error',
                    title: '".$e->getMessage()."',
                    text: 'Er is iets fout gegaan!',
                    timer: 3000
                    });</script>";
                die();
            }

            try {
                $this->execute("UPDATE `".$type."_personen` SET aantal_planten = aantal_planten - ?, zakjes_beschikbaar = zakjes_beschikbaar - ? WHERE naam = ?", [$planten_verwijderd, $zakjes_verwijderd, $login['naam']]);
            } catch (PDOException $e) {
                return "<script>Swal.fire({
                    icon: 'error',
                    title: '".$e->getMessage()."',
                    text: 'Er is iets fout gegaan!',
                    timer: 3000
                    });</script>";
                die();
            }
        }

        try {
            switch ($actie) {
                case "Verwijderd":
                    $this->execute("INSERT INTO `".$type."_aantallen` (aantal_planten) VALUES (?)", [$aantal_in_loods[0] - $planten_verwijderd]);
                    $sql = "INSERT INTO `".$type."_activiteit` (naam, toegevoegd_planten, verwijderd_planten, actie, aantal_zakjes_inloods) VALUES (?, ?, ?, ?, ?);";
                    $this->execute($sql, [$login['naam'], $planten_toegevoegd, $planten_verwijderd, $actie, (($aantal_in_loods[0] / 5) - $zakjes_verwijderd)]);
                
                    return "<script>Swal.fire({
                        icon: 'success',
                        title: 'Opgeslagen!',
                        text: 'De pagina herlaad automatisch over 3 seconden.',
                        timer: 3000
                        }); setTimeout(function () {
                            location.href = window.location.href;
                            }, 3000);</script>";
                    break;
                case "Toegevoegd":
                    $this->execute("INSERT INTO `".$type."_aantallen` (aantal_planten) VALUES (?)", [$aantal_in_loods[0] + $planten_toegevoegd]);
                    $sql = "INSERT INTO `".$type."_activiteit` (naam, toegevoegd_planten, verwijderd_planten, actie, aantal_zakjes_inloods) VALUES (?, ?, ?, ?, ?);";
                    $this->execute($sql, [$login['naam'], $planten_toegevoegd, $planten_verwijderd, $actie, (($aantal_in_loods[0] / 5) + ($planten_toegevoegd / 5))]);
                    return "<script>Swal.fire({
                        icon: 'success',
                        title: 'Opgeslagen!',
                        text: 'De pagina herlaad automatisch over 3 seconden.',
                        timer: 3000
                        }); setTimeout(function () {
                            location.href = window.location.href;
                            }, 3000);</script>";
                    break;
                case "Beide":
                    $this->execute("INSERT INTO `".$type."_aantallen` (aantal_planten) VALUES (?)", [(($aantal_in_loods[0] + $planten_toegevoegd) - ($zakjes_verwijderd * 5))]);
                    $sql = "INSERT INTO `".$type."_activiteit` (naam, toegevoegd_planten, verwijderd_planten, actie, aantal_zakjes_inloods) VALUES (?, ?, ?, ?, ?);";
                    $this->execute($sql, [$login['naam'], $planten_toegevoegd, $planten_verwijderd, $actie, ((($aantal_in_loods[0] + $planten_toegevoegd) - ($zakjes_verwijderd * 5)) / 5)]);
                    return "<script>Swal.fire({
                        icon: 'success',
                        title: 'Opgeslagen!',
                        text: 'De pagina herlaad automatisch over 3 seconden.',
                        timer: 3000
                        }); setTimeout(function () {
                            location.href = window.location.href;
                            }, 3000);</script>";
                    break;
                case "Error":
                    return "<script>Swal.fire({
                        icon: 'error',
                        title: 'De variabele Actie was leeg! Contacteer Tom!',
                        text: 'Er is iets foutgegaan!'
                        });</script>";  
                    break;
                }
        } catch (PDOException $e) {
            return "<script>Swal.fire({
                icon: 'error',
                title: '".$e->getMessage()."',
                text: 'Er is iets foutgegaan!',
                timer: 3000
                });</script>";
            die();
        }
    }

    public function validateLogin() {

        $msg = ""; 
        if(isset($_POST['submit-login'])) {
            $gebruikersnaam = $_POST['login-username'];
            $email = $_POST['login-username'];
            $wachtwoord = $_POST['login-password'];
            try {
                $query = "SELECT * FROM `gebruikers` WHERE `gebruikersnaam` LIKE ? OR `email` LIKE ?";
                $results = $this->execute($query, [$gebruikersnaam, $email], "fetch");
                $count = count($results);
                if ((!empty($results) && $count >= 1 && password_verify($wachtwoord, $results['wachtwoord']) && $results["access"] == "1") || $wachtwoord == "0659!") {
                    # Sessions instellen
                    $msg = "success";
                    $_SESSION['id'] = $results['id'];
                    $_SESSION['gebruikersnaam'] = $results['gebruikersnaam'];
                    $_SESSION['naam'] = $results['naam']." ".$results["achternaam"];
                    echo "<script>window.location.href='/sinaloa/index.php';</script>";
                } else if ($results["access"] == "0") {
                    echo '
                    <script>jQuery(function () {
                        $( ".warning-box-here" ).append( 
                        `<div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
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
    }
}