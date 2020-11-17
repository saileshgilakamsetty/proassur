<?php
	/*****************************************************************************
	Auteur du script : NUMHERIT
	Soci�t� : NUMHERIT SARL
	Date : 24/12/2012
	Version : 1.0
	Description :	D�finition de fonctions communes aux marchand et serveur.
	*****************************************************************************/

require_once "JulaConf.php";
require_once "JulaUtils.php";
require_once "JulaMarchandKey.php";
require_once "sha1lib.class.inc.php";

$DBG=0;



function generateRequestURL($trsdata){

	global $DBG, $SRV_URL, $JULA_REQVAR, $JULA_MERCHANT_KEY ;

	$data="";
	$errno=0;
	$result=null;
	$JULAURL="";
	
	if ( count($trsdata) >= 1 ) {
		ksort($trsdata);
		reset($trsdata);
	}

	// Verifier ques les cl�s du tableau sont ceux d�finis dans $JULA_REQVAR
    $errno=checkRequestArray($trsdata);
	if ( $errno != 0 ) {
	 $result['Errno'] = $errno;
	 return $result;
	}

	// Recupere le nombre de variables � envoyer (nbre d'�l�ments du tableau + le checksum)
	$nbparams = count($JULA_REQVAR) + 1;
    //var_dump($trsdata);
	// Calculer le checksum de toutes les variables; celles-ci sont concatenees par ordre alphabetique
    $merchantHash = computeHash($trsdata, $JULA_MERCHANT_KEY);

	// Appeler la fonction de g�n�ration des donn�es cod�es
	$data = generateDataString($trsdata, $nbparams, $merchantHash);
    //var_dump($data);
	$result['Errno']=0;
	$result['data']=urlencode($data);
	$result['RedirectURL']=$SRV_URL;

	return $result;
}


?>