<?php

	/*****************************************************************************
	Auteur du script : NUMHERIT
	Soci�t� : NUMHERIT SARL
	Date : 24/12/2012
	Version : 1.0
	Description :	D�finition de fonctions communes aux marchand et serveur.
	*****************************************************************************/

error_reporting(E_ERROR | E_PARSE);
require_once "JulaConf.php";

$DBG=0;


function generateDataString($trsdata, $nbparams, $hash) {
	global $DBG;
	$data="";
	// Le nombre de parametres est le premier element des donn�es � g�n�rer. Il est sur 2 octets
	$data .= sprintf("%02d", $nbparams);
	// Calculer maintenant la chaine qui contient les longueurs des  diff�rentes variables
	// D'abord la longueur de la signature SHA1
	$fieldsLength = "040";

	// Maintenant les autres variables
	foreach($trsdata as $val) {
	 $fieldsLength .= sprintf("%03d", strlen($val));
	}

	// Ajouter la cha�ne contenant les longueurs des variables au r�sultat global
	$data .= $fieldsLength;

	// Maintenant generer la chaine qui contient les valeurs des variables 
	
	// D'abord la signature SHA1	
	$fieldsValues = $hash;
	// Ensuite les autres variables
	foreach($trsdata as $val) {
		if ($DBG) print "generateDataString: adding $val to data to hash<br>\n";
		$fieldsValues .= $val;
	}

	// Ajouter la cha�ne contenant les valeurs des variables au r�sultat global
	$data .= $fieldsValues;
	if ($DBG) print "generateDataString: unscrumbled data=$data<br>\n";

	// brouiller les donnees
    return scrumbleData($data);
}


function computeHash($trsdata, $key) {
	
	// Trier le tableau correctement
	ksort($trsdata);
	reset($trsdata);
	
	$tohash="";
	foreach($trsdata as $val) {
	 $tohash .= $val;
	}
	
	// ajouter la clef du marchand
    $tohash .= $key;
	//echo $tohash.' et ';
	$hashed=sha1_api($tohash);
	return $hashed;
}


function scrumbleData($data) {
	
	$newData="";
	$tailee = strlen($data);
	for($i=0; $i<$tailee;$i++) {
		$newData .= chr(ord($data[$i]) + 5);	
	}
	return $newData;
}

 
function checkRequestArray($inarr) {
	
	//$errno=0;
	
	// check var names
	$errno=checkRequestArrayVarNames($inarr);
	if ($errno != 0) {
		return $errno;
	}
	// check var length
	$errno=checkRequestArrayVarLen($inarr);
	if ($errno != 0) {
		return $errno;
	}
	
	// Verifier que les valeurs sont bien typ�es
	$errno=checkRequestArrayVarTypes($inarr);
	if ($errno != 0) {
		return $errno;
	}
}


function checkRequestArrayVarNames($inarr) {

	global $JULA_REQVAR, $JULA_MISSING_REQVAR_ERRNO, $JULA_GENERAL_ERRORS;

	$errno=0;

	// D'abord v�rifier que l'array pass� par le marchand ne contient pas des clefs invalides
	foreach($inarr as $key => $val) {
	 if (! in_array($key, $JULA_REQVAR) ) {
		 $errno=$JULA_GENERAL_ERRORS['InvalidRequestKey'];
		 break;
	 }
	}
	
	// Maintenant v�rifier que toutes les variables de la transaction sont bien pr�sentes dans  l'array pass� par le marchand
	foreach($JULA_REQVAR as $val) {
	 if (!array_key_exists($val, $inarr)) {
		 $errno=$JULA_MISSING_REQVAR_ERRNO[$val];
		 break;
	 }
	}
	
	return $errno;
}


function checkRequestArrayVarLen($inarr) {

	 global $JULA_MAXLEN_REQVAR, $JULA_MAXLEN_REQVAR_ERRNO;
	 $errno=0;

	 foreach($inarr as $key => $val) {
		 if (strlen($val) > $JULA_MAXLEN_REQVAR[$key]) {
			 $errno=$JULA_MAXLEN_REQVAR_ERRNO[$key];
			 break;
		 }
	 }

	 return $errno;
 }


function checkRequestArrayVarTypes($inarr) {

	 global $JULA_TYPES_REQVAR;
	 $errno=0;
	 foreach($inarr as $key => $val) {
		 $tmperrno = checkRequestType($key, $val, $JULA_TYPES_REQVAR[$key]);
		 if ( $tmperrno != 0 ) {
			 $errno=$tmperrno;
			 break;
		 }
	 }

	 return $errno;
 }

function checkRequestType($key, $val, $type) {

    global $JULA_TYPES_REQVAR_ERRNO;

    return ( (($type === 'N') && (!is_numeric($val))) || (($type === 'A') && (!is_string($val))) ) ?
        $JULA_TYPES_REQVAR_ERRNO[$key] : 0;
}

	
?>