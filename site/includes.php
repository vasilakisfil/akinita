<?php 
/****************************************************************************************
*	Auto to arxeio periexei ola ta aparaithta includes kai tis aparaithtes dhlwseis
*	Ginetai include sxedon se ka8e arxeio .php
*****************************************************************************************/

	//kanoume include to arxeio html_functions.php pou periexei tis sunarthseis pou emfanizoun ton vasiko html kwdika
	require_once('html_functions.php');
	//kanoume include to arxeio main_functions.pho pou periexei tis aparaithtes php sunarthseis
	require_once('main_functions.php');
	//3ekiname ena session
	session_start();
	//elegxoume an h session metavlhth user_type exei te8ei kai an exei te8ei 8etoume sthn topikh metavlhth $type thn timh
	//ths metavlhths $_SESSION['user_type']
	if(isset($_SESSION['user_type'])) $type=$_SESSION['user_type'];
	//elegxoume an h session metavlhth valis_user exei te8ei kai an exei te8ei 8etoume sthn topikh metavlhth $val_user thn timh
	//ths metavlhths $_SESSION['valid_user']
	if(isset($_SESSION['valid_user'])) $val_user=$_SESSION['valid_user'];
?>