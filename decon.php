<?php  
 session_start();  
 if (!isset($_SESSION['isLogged_PMA'])) {
	header("location:login.php"); 
  die(); 
 }
 else if ($_SESSION['isLogged_PMA']) 
 { 
	 session_destroy(); 
	 unset($_SESSION['isLogged_PMA']);
	 unset($_SESSION['username']);
	 unset($_SESSION['id_user']);
	 unset($_SESSION['existe']);
	 unset($_SESSION['pih']);
	 unset($_SESSION['pif']);
	 unset($_SESSION['id_couple']);
	 unset($_SESSION['nom_H']);
	 unset($_SESSION['prenom_H']);
	 unset($_SESSION['delivrance_H']);
	 unset($_SESSION['date_delivrance_H']);
	 unset($_SESSION['date_naiss_H']);
	 unset($_SESSION['nat_H']);
	 unset($_SESSION['pays_H']);
	 unset($_SESSION['nom_F']);
	 unset($_SESSION['prenom_F']);
	 unset($_SESSION['delivrance_F']);
	 unset($_SESSION['date_delivrance_F']);
	 unset($_SESSION['date_naiss_F']);
	 unset($_SESSION['nat_F']);
	 unset($_SESSION['pays_F']);
 }
 header("location:login.php");  
 ?> 