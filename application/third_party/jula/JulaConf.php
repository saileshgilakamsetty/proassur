<?php
	//$SRV_URL = "https://www.numherit-labs.com/pmp-admingtp/api-dev/paiement.php";
	$SRV_URL = "https://www.numherit-labs.com/pmp-admingtp/paiementapi/paiement.php";
	//$SRV_URL = "https://api-paiement.postecash.sn/paiement.php";


	$JULA_GENERAL_ERRORS = array(
		'InvalidRequestKey' => 1000, // Erreur quand l'input array du marchand contient une mauvaise cl�
		'InvalidResponseKey' => 2000, // Erreur quand l'input array du serveur contient une mauvaise cl�
		'HashError' => 500, // Erreur quand le hash de la requ�te n'est pas correct
		'InvalidDataFormat' => 1001, // Erreur quand le nb de variables envoy�s par le marchand est < 2 ou quand l'URL a un mauvais format
		'RequestMechantIdError' => 1002 // Erreur quand l'Id du marchand contenu dans l'URL a �t� modifi�
	);

	/*
	 * PARAMETRES DE LA REQUETE DE PAIEMENT
	 */
	 
	// L'array contenant le nom des variables utilis�e dans la requ�te de paiement
	$JULA_REQVAR = array ( 'IDMerchant', 'num_transaction','amount','email_acheteur','currency', 'URLReturn', 'URLCancel', 'URLNotification');


	// le tableau contenant la taille max des champs de la requ�te
	$JULA_MAXLEN_REQVAR = array(
		'IDMerchant' => 6 ,
		'num_transaction' => 45 ,
		'amount' => 7,
		'email_acheteur' => 45,
		'currency' => 10,
		'URLReturn' => 255,
		'URLCancel' => 255,
		'URLNotification' => 255
	);

	// Les erreurs retourn�s quand un champ est trop long
	$JULA_MAXLEN_REQVAR_ERRNO = array(
		'IDMerchant' => 1020,
		'num_transaction' => 1021,
		'amount' => 1022,
		'email_acheteur' => 1023,
		'currency' => 1024,
		'URLReturn' => 1025,
        'URLCancel' => 1026,
        'URLNotification' => 1027
	);

	// The maximum length of transaction fields
	$JULA_TYPES_REQVAR = array(
		'IDMerchant' => 'N' ,
		'num_transaction' => 'A' ,
		'amount' => 'N',
		'email_acheteur' => 'A',
		'currency' => 'A',
		'URLReturn' => 'A',
        'URLCancel' => 'A',
        'URLNotification' => 'A'
	);


	// Les erreurs retourn�s quand un champ a un mauvais type
	$JULA_TYPES_REQVAR_ERRNO = array(
		'IDMerchant' => 1040,
		'num_transaction' => 1041,
		'amount' => 1042,
		'email_acheteur' => 1043,
		'currency' => 1044,
		'URLReturn' => 1045,
        'URLCancel' => 1046,
        'URLNotification' => 1047
	);

	// Les erreurs retournes quand un champ manque
	$JULA_MISSING_REQVAR_ERRNO = array(
		'IDMerchant' => 1060,
		'num_transaction' => 1061,
		'amount' => 1062,
		'email_acheteur' => 1063,
		'currency' => 1064,
		'URLReturn' => 1065,
        'URLCancel' => 1066,
        'URLNotification' => 1067
	);
?>