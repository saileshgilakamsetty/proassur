<?php
// if (!isset($_SESSION)) {
//   session_start();
// }


	/*****************************************************************************


	Description :	Programme d'envoi de la requ�te de paiement vers Neosurf.

		Ce programme r�cup�re les diff�rentes variables utiles au paiement 

		dans un tableau nomm� '$trsdata',	puis il redirige l'internaute vers

		l'interface de paiement de Neosurf.

	*****************************************************************************/

	

	//Appel des fichiers de l'API

	require_once "JulaMarchand.php";
	////include_once("../fonctions-panier.php");
	//include_once("../fonctions-panier.php");
/* D�but des variables � personnaliser pour chaque marchand (N=num�rique, A=alphanum�rique) */


function getFrom($data){
    $trsdata = array();

    if(array_key_exists('id_marchand', $data) && array_key_exists('montant', $data)
    && array_key_exists('email', $data) && array_key_exists('numero_transaction', $data) && array_key_exists('url_retour', $data)
    && array_key_exists('url_notification', $data)){



        if(!array_key_exists('url_annulation', $data)){
            $trsdata['URLCancel'] = '';
        }
        else{
            $trsdata['URLCancel'] = $data['url_annulation'];
        }

        if(!array_key_exists('currency', $data)){
            $trsdata['currency'] = '';
        }
        else{
            $trsdata['currency'] = $data['currency'];
        }

        $trsdata['email_acheteur'] = $data['email'];
        $trsdata['amount'] = $data['montant'];
        $trsdata['IDMerchant'] = $data['id_marchand'];
        $trsdata['num_transaction'] = $data['numero_transaction'];
        $trsdata['URLReturn'] = $data['url_retour'];
        $trsdata['URLNotification'] = $data['url_notification'];

        // Appel de l'API pour g�n�rer l'URL cod�e
        $result=generateRequestURL($trsdata);

        //echo urldecode($result['data']);
        if ( $result['Errno'] != 0 ) {
            return "Erreur dans l'appel de generateRequestURL. Code erreur =" . $result['Errno'] . "<br>\n";
        }
        else {
            
            return "<form id='jula_form' action=".$result['RedirectURL']." method='post'>
    <input name='sid' type='hidden' value='".$result['data']."' />
    <input name='idMerchand' type='hidden' value='".$trsdata['IDMerchant']."' />
    <input alt=\"Effectuez vos paiements via PosteCash/JULA : une solution rapide, gratuite et sécurisée\" name=\"submit\" src=\"https://www.numherit-labs.com/pmp-admingtp/paiementapi/logo.png\" type=\"image\" />
    </form>";

            //header("Location: " . $result['RedirectURL']); die;
        }

    }
    else if(!array_key_exists('id_marchand', $data)){
        return "Le paramètre de l'identifant du marchand doit être renseigner";
    }
    else if(!array_key_exists('montant', $data)){
        return "Le paramètre montant de la commande doit être renseigner";
    }
    else if(!array_key_exists('email', $data)){
        return "Le paramètre emqil du client doit être renseigner";
    }
    else if(!array_key_exists('numero_transaction', $data)){
        return "Le paramètre numéro de la transaction doit être renseigner";
    }
    else if(!array_key_exists('url_retour', $data)){
        return "Le paramètre d'url de retour doit être renseigner";
    }
    else if(!array_key_exists('url_notification', $data)){
        return "Le paramètre d'url de notification doit être renseigner";
    }
    else{
        return "Une erreur est survenue!";
    }


}

?>