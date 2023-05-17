<?php

$connect = [
	'HOSTNAME' => 'localhost', // HOST NAME
	'USERNAME' => 'root',      // DATABASE USERNAME
	'PASSWORD' => 'root',      // DATABASE PASSWORD
	'DATABASE' => 'pollate_new' // DATABASE NAME
];

# Tables' Prefix
define('prefix', 'pl_');

$db = new mysqli($connect['HOSTNAME'], $connect['USERNAME'], $connect['PASSWORD'], $connect['DATABASE']);
if($db->connect_errno){
    echo "Echec lors de la connexion à MySQL : (" . $db->connect_errno . ") " . $db->connect_error;
}
