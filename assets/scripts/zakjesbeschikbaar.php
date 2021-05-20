<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "/home/tom/domains/tom974.dev/public_html/sinaloa/assets/classes/sinaloa.php";
$sinaloa = new sinaloa();

# Snelheid is in 15 minuten aantal zakjes dat het verwerkt, bij snelheid lvl 2 in dit geval dus 4.44
$snelheid = $sinaloa->execute("SELECT loods_verwerk FROM loodsen_info WHERE loods_type = ?", ['Meth'], "fetch")["loods_verwerk"];
# 4.44 zakjes per 15 minuten.
# Gebruikers berekenen waarvan aantal planten hoger is als 0.
$users = $sinaloa->execute('SELECT * FROM `meth_personen` WHERE aantal_planten >= 25', [], 'fetchAll');
$count = count($users);
$zakjes_pp = floatval($snelheid) / floatval($count);
$gebruikers_verwerkt = [];
foreach($users as $user) {
    $zakjes_beschikbaar = $user['zakjes_beschikbaar'] ?? 0;
    if (($zakjes_beschikbaar + $zakjes_pp) >= ($user['aantal_planten'] / 5)) {
        $count = $count - 1;
        echo $user['naam']. " kan alles gwn pakken, wat een megool zeg. \n";
    } else {
        echo "hehe heb een gebruiker verwerkt a niffo.\n";
        $user_array = [];
        $user_array['naam'] = $user['naam'];
        $user_array['zakjes_beschikbaar'] = $zakjes_beschikbaar;
        array_push($gebruikers_verwerkt, $user_array);
    }
}       

echo '<xmp>Output $gebruikers_verwerkt File: '.end(explode('/',__FILE__)).' Line '.__LINE__.': '. print_r( $gebruikers_verwerkt, true ) .'</xmp>';
if ($count == 0) {
    echo "Niemand heeft genoeg ingredienten in de loods zitten, ik kap de cronjob af!\n";
    exit();
}

$zakjes_pp = floatval($snelheid) / floatval($count);

foreach($gebruikers_verwerkt as $gebruiker) {
    $sinaloa->execute('UPDATE `meth_personen` SET `zakjes_beschikbaar` = ? WHERE `naam` = ?', [(floatval($gebruiker['zakjes_beschikbaar']) + floatval($zakjes_pp)), $gebruiker['naam']]);
}
echo "Done!";
?>