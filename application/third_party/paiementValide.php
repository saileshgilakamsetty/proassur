<?php
/**
 * Created by PhpStorm.
 * User: ngompapa
 * Date: 06/03/2018
 * Time: 12:03
 */
include_once('jula/JulaMarchandSend.php');

global $JULA_MERCHANT_KEY;
if(isset($_GET['transaction1'], $_GET['transaction2'], $_GET['hash'])){

    $cle_hachage = sha1($_GET['transaction1'].$_GET['transaction2'].$JULA_MERCHANT_KEY);


    if($_GET['hash'] === $cle_hachage){
        echo 'Paiement ok';
    }
    else{
        echo 'Paiement ko';
    }
}
else{
    echo 'Paiement nok';
}
?>


