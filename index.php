<!DOCTYPE html>
<html lang="en-US" dir="ltr">
						 <?php
session_start();
  if ($_SESSION["type"]  != "Admin") {
    header("Location: login.php");
  }
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Shocroom </title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/tun.ico"> 
    <link rel="manifest" href="assets/img/favicons/manifest.json"> 
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png"> 
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="assets/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
    <link href="assets/lib/leaflet/leaflet.css" rel="stylesheet">
    <link href="assets/lib/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
    <link href="assets/lib/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">
	<link href="assets/css/notiflix-2.7.0.min.css" rel="stylesheet">
	 <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src=
"https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
  <link
    rel="stylesheet"
    href=
"https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css"
  />
  <link
    rel=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
    type="text/css"
  />
  
  <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
  <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
  </script>
  
  <script src=
"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js">
  </script>
  

  </head>


  <style>
   
    h2 {
      text-align: center;
      font-family: "Verdana", sans-serif;
      font-size: 40px;
    }
  </style>
  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">


      <div class="container" data-layout="container">
        
        <div class="content">
          <nav class="navbar navbar-light navbar-glass navbar-top sticky-kit navbar-expand">

            <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

              <div class="d-flex align-items-center">
				<img class="mr-2" src="assets/img/illustrations/logo_fr.png" alt="" width="35%" />
              </div>

            
            <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
              
            <li class="nav-item">Ayoub ben Abdesslem</li>
              <li class="nav-item dropdown dropdown-on-hover">
				<a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					
                  <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="assets/img/team/avatar.png" alt="" />

                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white rounded-soft py-2">
                    
                    <a class="dropdown-item" href="decon.php">Fermer</a>
                  </div>
                </div>
              </li>
            </ul>
          </nav>
		  
		  <div class="card bg-light mb-3">
		  
            <div class="card-body p-3">
              <p class="fs--1 mb-0"><input type="button" class="btn btn-sm btn-primary" onclick="refresh(); Notiflix.Loading.Standard();" value="Rafraichir"/><?php 
			
  //session_start();
require('connect.php');
   $result1='';
   $result2='';
   $result3='';
   $result4='';
   $aujour=0;
   $hier=0;
   $tot=0;
   $tot_M=0;
   $tot_A=0;
   $nb_vaccine=0;
   $query = "Select to_char(DATE_INSCRIPTION,'yyyy-mm-dd'),count(*) from PMA_COUPLE where to_char(DATE_INSCRIPTION,'yyyy-mm-dd') >= '2022-08-01'  group by to_char(DATE_INSCRIPTION,'yyyy-mm-dd')  ORDER BY 1" ;
   $stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 	$hier=$aujour;
			if ($result1==''){$result1=$result1."'".$row[0]."'";}else{$result1=$result1.",'".$row[0]."'";}
			if ($result2==''){$result2=$result2.$row[1];}else{$result2=$result2.','.$row[1];}
			$aujour=$row[1];
			$tot_c=$tot+$row[1];
		}
		
		
	$query = "Select count(*) from PMA_COUPLE " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_c=$row[0];
		}
	
	
	$query = "Select count(*) from PMA_CYCLE_IIU " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_IIU=$row[0];
		}
		
		$query = "Select count(*) from PMA_CYCLE_TEC  " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_TEC=$row[0];
		}
		
		$query = "Select count(*) from PMA_CYCLE_DEVITRIFICATION  " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_DEVITIFICATION=$row[0];
		}
		
		$query = "Select count(*) from PMA_CYCLE_ICSI " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_ICSI=$row[0];
		}
		
		$query = "Select count(*) from PMA_CYCLE_FIV  " ;	
	$stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			$tot_FIV=$row[0];
		}
		
	
			$tot=$tot_DEVITIFICATION + $tot_IIU + $tot_FIV + $tot_ICSI + $tot_TEC;
		
	
  
$Object = new DateTime();  $Object->setTimezone(new DateTimeZone('Africa/Tunis')); $DateAndTime = $Object->format("d-m-Y h:i:s a");   echo "  Tunis, le $DateAndTime"; 



?></strong></p>
            </div>
			
			</div>
			
				  <!--div class="card bg-light mb-3">
            <div class="card-body p-3">
              
	<h3>Tableau de bord de la plateforme Test Rapide</h3>
	
</strong></p>
            </div>
          </div-->
		  <!-- Tittle -->
		<div class="tittle">
		<br>
		 <center><h2><b><i>Registre National d'Assistance Médicales à la Procréation </i></b></h2></center>
		<br>
		</div>
		  
          <div class="card mb-3">
            <div class="card-body rounded-soft bg-gradient">
              <div class="row text-white align-items-center no-gutters">
                <div class="col">
                  <h4 class="text-white mb-0"> <B><?php echo $tot_c; ?> </b> couple  enregistré sur le registre national PMA jusqu'à aujoud'hui <?php $d=date("d-M-Y"); echo $d;   ?>  à
				<?php  $Object = new DateTime();  $Object->setTimezone(new DateTimeZone('Africa/Tunis')); $DateAndTime = $Object->format("H:i:s ");   echo "  $DateAndTime"; ?>
				  </h4>
                  <!--p class="fs--1 font-weight-semi-bold">Hier <span class="opacity-50"><?php echo $hier; ?></span></p-->
                </div>
                <div class="col-auto d-none d-sm-block">
                  <select class="custom-select custom-select-sm mb-3" id="dashboard-chart-select">
                    <option value="all" selected="selected">Tous les Centres</option>
					<?php  
					require('connect.php');
					$query1 = "Select distinct LIB_CENTRE,ID_CENTRE from PMA_CENTRE " ;
   $stid1 = oci_parse($conn,$query1);
	oci_execute($stid1);
	while($row1 = oci_fetch_array($stid1,OCI_NUM+OCI_RETURN_NULLS))
		{ 
			echo ('<option value="'.$row1[1].'">   '.$row1[0].' </option> ');
			
		}
					?>
                  </select>
                </div>
              </div>
              <canvas class="max-w-100 rounded" id="chart-line" width="1618" height="375" aria-label="Line chart" role="img"></canvas>
            </div>
          </div>
          
          <div class="card-deck">
            <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
              </div>
              <!--/.bg-holder-->

              <div class="card-body position-relative">
                <h6>Nombre Total des Cycle enregistrés<span class="badge badge-soft-warning rounded-capsule ml-2">Cycles PMA</span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-warning"><?php echo $tot; ?></div>
              </div>
            </div>
            <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-2.png);">
              </div>
              <!--/.bg-holder-->

              <div class="card-body position-relative">
                <h6>Total Cycles IIU<span class="badge badge-soft-info rounded-capsule ml-2"><?php if ($tot_IIU) { echo (round((($tot_IIU/$tot)*100),2).'%'); } ?></span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal text-sans-serif text-info"><?php if ($tot_IIU) { echo $tot_IIU; } ?></div>
              </div>
            </div>
            <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-3.png);">
              </div>
              <!--/.bg-holder-->

              <div class="card-body position-relative">
                <h6>Total Cycles FIV<span class="badge badge-soft-success rounded-capsule ml-2"><?php if ($tot_FIV) {  echo (round((($tot_FIV/$tot)*100),2).'%'); } ?></span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal Acc-sans-serif" data-countup='{"count":43594,"format":"comma","prefix":"$"}'><?php if ($tot_FIV) {  echo $tot_FIV; } ?></div>
              </div>
            </div>
          </div>
		  
		   <div class="card-deck">
            <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
              </div>
              <!--/.bg-holder-->
			  
			  
			  
			  
			  
			  
                <div class="card-body position-relative">
                <h6>Total Cycles TEC<span class="badge badge-soft-success rounded-capsule ml-2"><?php if ($tot_TEC) {  echo (round((($tot_TEC/$tot)*100),2).'%'); } ?></span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal Acc-sans-serif" data-countup='{"count":43594,"format":"comma","prefix":"$"}'><?php if ($tot_TEC) { echo $tot_TEC; } ?></div>
              </div>
			  
            </div>
			
			
			 <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
              </div>
             
                <div class="card-body position-relative">
                <h6>Total Cycles ICSI<span class="badge badge-soft-success rounded-capsule ml-2"><?php if ($tot_ICSI) { echo (round((($tot_ICSI/$tot)*100),2).'%'); } ?></span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal Acc-sans-serif" data-countup='{"count":43594,"format":"comma","prefix":"$"}'><?php if ($tot_ICSI) { echo $tot_ICSI; }?></div>
              </div>
			  
            </div>
         
		  <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
              <div class="bg-holder bg-card" style="background-image:url(assets/img/illustrations/corner-1.png);">
              </div>
             
                <div class="card-body position-relative">
                <h6>Total Cycles DEVIRTIFICATION<span class="badge badge-soft-success rounded-capsule ml-2"><?php if ($tot_DEVITIFICATION) { echo (round((($tot_DEVITIFICATION/$tot)*100),2).'%'); } ?></span></h6>
                <div class="display-4 fs-4 mb-2 font-weight-normal Acc-sans-serif" data-countup='{"count":43594,"format":"comma","prefix":"$"}'><?php if ($tot_DEVITIFICATION) { echo $tot_DEVITIFICATION; } ?></div>
              </div>
			  
            </div>
           
		
			
			
          </div>
		<?php
					require('connect.php');
					$nb=0;
					
					
					$query1 = "Select count(ID_CENTRE) from PMA_CENTRE " ;
			$stid1 = oci_parse($conn,$query1);
			oci_execute($stid1);
			while($row1 = oci_fetch_array($stid1,OCI_NUM+OCI_RETURN_NULLS))
				{
					$nb=$row1[0];
				}					
					?>
		 <div class="row no-gutters">
		 
		
		 
            <div class="col-lg-6 pl-lg-2">
              <div class="card h-100 bg-gradient">
                <div class="card-header bg-transparent">
                  <!--h5 class="text-white">Nombre des Experts</h5-->
				  <h5 class="text-white">Liste des centres d'assitance médicale à la procréation</h5>
                  <div class="real-time-user display-1 font-weight-normal text-white" data-countup='{"count":5}'><?php echo $nb; ?></div>
                </div>
                <div class="card-body text-white fs--1">
                  
                  <div align="center" class="list-group-flush mt-4">
                    <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 font-weight-semi-bold border-top-0" style="border-color: rgba(255, 255, 255, 0.15)">
                      <p class="mb-0">Nom du centre</p>
                      <p class="mb-0">Type du centre / Région</p>
					  
                    </div>
					<?php
					require('connect.php');
					$nb=0;
					
					
					$query1 = "Select count(ID_CENTRE) from PMA_CENTRE " ;
			$stid1 = oci_parse($conn,$query1);
			oci_execute($stid1);
			while($row1 = oci_fetch_array($stid1,OCI_NUM+OCI_RETURN_NULLS))
				{
					$nb=$row1[0];
				}					
					
					$query=  "select LIB_CENTRE, TYPE_CENTRE,GOUVERNORAT from PMA_CENTRE ";

					 //$query = "Select CODEXPERT,NOMEXPERT from EVAXP_EXPERT where nomexpert not in ('admin','Lotfi Allani') and TYPEXPERT='M'" ;
 $stid = oci_parse($conn,$query);
	oci_execute($stid);
	while($row = oci_fetch_array($stid,OCI_NUM+OCI_RETURN_NULLS))
		{ 	
					
	
			echo'<div align="center" class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1" style="border-color: rgba(255, 255, 255, 0.05);text-align:center;">
                      <p align="center" class="mb-0">'.$row[0].'</p>
                      <p align="center" class="mb-0">'.$row[1]. ' / ' .$row[2].'</p>
					   
                    </div>';
		}
                    
                    
                    ?>
                    
                    
                  </div>
                </div>
               
              </div>
            </div>
			
			
            
		  
	<div class="col-lg-6 pl-lg-2">	  



 <div class="col-xs-12 text-center">
 <br> <br> <br>
      <h2>Répartition couples / Cycle PMA</h2>
    </div>
  
    <div id="donut-chart"></div>
     <input type="text" id="TEC" hidden disabled value="<?php echo $tot_TEC; ?>" />
	 <input type="text" id="IIU" hidden disabled value="<?php echo $tot_IIU; ?>" />
	 <input type="text" id="DEVIRTIFICATION" hidden disabled value="<?php echo $tot_DEVITIFICATION; ?>" />
	 <input type="text" id="FIV" hidden disabled value="<?php echo $tot_FIV; ?>" />
	 <input type="text" id="ICSI" hidden disabled value="<?php echo $tot_ICSI; ?>" />
    <script>
      var
      tec=document.getElementById('TEC').value;
	   iiu=document.getElementById('IIU').value;
	    deviritification=document.getElementById('DEVIRTIFICATION').value;
		 fiv=document.getElementById('FIV').value;
		  icsi=document.getElementById('ICSI').value;


	  chart = bb.generate({
        data: {
          columns: [
            ["IIU", tec],
            ["FIV", iiu],
            ["DEVITIRIFICATION", deviritification],
			["TEC", fiv],
			["ICSI", icsi],
          ],
          type: "donut",
          onclick: function (d, i) {
            console.log("onclick", d, i);
          },
          onover: function (d, i) {
            console.log("onover", d, i);
          },
          onout: function (d, i) {
            console.log("onout", d, i);
          },
        },
        donut: {
          title: "Taux d'oocupation",
        },
        bindto: "#donut-chart",
      });
    </script>

         </div>
		
	
          
		 
          <footer>
            <div class="row no-gutters justify-content-between fs--1 mt-4 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Centre Informatique du Ministère de la Santé <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2022 &copy; <a href="http://www.cims.tn">CIMS</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <!--p class="mb-0 text-600">v1.0.0</p-->
              </div>
            </div>
          </footer>
        </div>

      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/lib/@fortawesome/all.min.js"></script>
    <script src="assets/lib/stickyfilljs/stickyfill.min.js"></script>
    <script src="assets/lib/sticky-kit/sticky-kit.min.js"></script>
    <script src="assets/lib/is_js/is.min.js"></script>
    <script src="assets/lib/lodash/lodash.min.js"></script>
    <script src="assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="assets/lib/chart.js/Chart.min.js"></script>
    <script src="assets/lib/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="assets/lib/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <script src="assets/lib/leaflet/leaflet.js"></script>
    <script src="assets/lib/leaflet.markercluster/leaflet.markercluster.js"></script>
    <script src="assets/lib/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
    <!--script src="assets/js/theme.js"></script-->
	<script src="assets/js/notiflix-aio-2.7.0.min.js"></script>
	<script src="assets/js/notiflix-2.7.0.min.js"></script>
<script>
function refresh() { window.location.reload(false); }


"use strict";

var _this = this;

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/*-----------------------------------------------
|   Theme Configuration
-----------------------------------------------*/
var storage = {
  isDark: false
};
/*-----------------------------------------------
|   Utilities
-----------------------------------------------*/

var utils = function ($) {
  var grays = function grays() {
    var colors = {
      white: '#fff',
      100: '#f9fafd',
      200: '#edf2f9',
      300: '#d8e2ef',
      400: '#b6c1d2',
      500: '#9da9bb',
      600: '#748194',
      700: '#5e6e82',
      800: '#4d5969',
      900: '#344050',
      1000: '#232e3c',
      1100: '#0b1727',
      black: '#000'
    };

    if (storage.isDark) {
      colors = {
        white: '#0e1c2f',
        100: '#132238',
        200: '#061325',
        300: '#344050',
        400: '#4d5969',
        500: '#5e6e82',
        600: '#748194',
        700: '#9da9bb',
        800: '#b6c1d2',
        900: '#d8e2ef',
        1000: '#edf2f9',
        1100: '#f9fafd',
        black: '#fff'
      };
    }

    return colors;
  };

  var themeColors = function themeColors() {
    var colors = {
      primary: '#2c7be5',
      secondary: '#748194',
      success: '#00d27a',
      info: '#27bcfd',
      warning: '#f5803e',
      danger: '#e63757',
      light: '#f9fafd',
      dark: '#0b1727'
    };

    if (storage.isDark) {
      colors.light = grays()['100'];
      colors.dark = grays()['1100'];
    }

    return colors;
  };

  var pluginSettings = function pluginSettings() {
    var settings = {
      tinymce: {
        theme: 'oxide'
      },
      chart: {
        borderColor: 'rgba(255, 255, 255, 0.8)'
      }
    };

    if (storage.isDark) {
      settings.tinymce.theme = 'oxide-dark';
      settings.chart.borderColor = themeColors().primary;
    }

    return settings;
  };

  var Utils = {
    $window: $(window),
    $document: $(document),
    $html: $('html'),
    $body: $('body'),
    $main: $('main'),
    isRTL: function isRTL() {
      return this.$html.attr('dir') === 'rtl';
    },
    location: window.location,
    nua: navigator.userAgent,
    breakpoints: {
      xs: 0,
      sm: 576,
      md: 768,
      lg: 992,
      xl: 1200,
      xxl: 1540
    },
    colors: themeColors(),
    grays: grays(),
    offset: function offset(element) {
      var rect = element.getBoundingClientRect();
      var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      return {
        top: rect.top + scrollTop,
        left: rect.left + scrollLeft
      };
    },
    isScrolledIntoViewJS: function isScrolledIntoViewJS(element) {
      var windowHeight = window.innerHeight;
      var elemTop = this.offset(element).top;
      var elemHeight = element.offsetHeight;
      var windowScrollTop = window.scrollY;
      return elemTop <= windowScrollTop + windowHeight && windowScrollTop <= elemTop + elemHeight;
    },
    isScrolledIntoView: function isScrolledIntoView(el) {
      var $el = $(el);
      var windowHeight = this.$window.height();
      var elemTop = $el.offset().top;
      var elemHeight = $el.height();
      var windowScrollTop = this.$window.scrollTop();
      return elemTop <= windowScrollTop + windowHeight && windowScrollTop <= elemTop + elemHeight;
    },
    getCurrentScreanBreakpoint: function getCurrentScreanBreakpoint() {
      var _this2 = this;

      var currentScrean = '';
      var windowWidth = this.$window.width();
      $.each(this.breakpoints, function (index, value) {
        if (windowWidth >= value) {
          currentScrean = index;
        } else if (windowWidth >= _this2.breakpoints.xl) {
          currentScrean = 'xl';
        }
      });
      return {
        currentScrean: currentScrean,
        currentBreakpoint: this.breakpoints[currentScrean]
      };
    },
    hexToRgb: function hexToRgb(hexValue) {
      var hex;
      hexValue.indexOf('#') === 0 ? hex = hexValue.substring(1) : hex = hexValue; // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")

      var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
      var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.replace(shorthandRegex, function (m, r, g, b) {
        return r + r + g + g + b + b;
      }));
      return result ? [parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)] : null;
    },
    rgbColor: function rgbColor(color) {
      if (color === void 0) {
        color = '#fff';
      }

      return "rgb(" + this.hexToRgb(color) + ")";
    },
    rgbaColor: function rgbaColor(color, alpha) {
      if (color === void 0) {
        color = '#fff';
      }

      if (alpha === void 0) {
        alpha = 0.5;
      }

      return "rgba(" + this.hexToRgb(color) + ", " + alpha + ")";
    },
    rgbColors: function rgbColors() {
      var _this3 = this;

      return Object.keys(this.colors).map(function (color) {
        return _this3.rgbColor(_this3.colors[color]);
      });
    },
    rgbaColors: function rgbaColors() {
      var _this4 = this;

      return Object.keys(this.colors).map(function (color) {
        return _this4.rgbaColor(_this4.colors[color]);
      });
    },
    settings: pluginSettings(_this),
    isIterableArray: function isIterableArray(array) {
      return Array.isArray(array) && !!array.length;
    },
    setCookie: function setCookie(name, value, expire) {
      var expires = new Date();
      expires.setTime(expires.getTime() + expire);
      document.cookie = name + "=" + value + ";expires=" + expires.toUTCString();
    },
    getCookie: function getCookie(name) {
      var keyValue = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
      return keyValue ? keyValue[2] : keyValue;
    },
    getBreakpoint: function getBreakpoint($element) {
      var classes = $element.attr('class');
      var breakpoint;

      if (classes) {
        breakpoint = this.breakpoints[classes.split(' ').filter(function (cls) {
          return cls.indexOf('navbar-expand-') === 0;
        }).pop().split('-').pop()];
      }

      return breakpoint;
    }
  };
  return Utils;
}(jQuery);
/*-----------------------------------------------
|   Detector
-----------------------------------------------*/


utils.$document.ready(function () {
  if (window.is.opera()) utils.$html.addClass('opera');
  if (window.is.mobile()) utils.$html.addClass('mobile');
  if (window.is.firefox()) utils.$html.addClass('firefox');
  if (window.is.safari()) utils.$html.addClass('safari');
  if (window.is.ios()) utils.$html.addClass('ios');
  if (window.is.iphone()) utils.$html.addClass('iphone');
  if (window.is.ipad()) utils.$html.addClass('ipad');
  if (window.is.ie()) utils.$html.addClass('ie');
  if (window.is.edge()) utils.$html.addClass('edge');
  if (window.is.chrome()) utils.$html.addClass('chrome');
  if (utils.nua.match(/puppeteer/i)) utils.$html.addClass('puppeteer');
  if (window.is.mac()) utils.$html.addClass('osx');
  if (window.is.windows()) utils.$html.addClass('windows');
  if (navigator.userAgent.match('CriOS')) utils.$html.addClass('chrome');
});
  
  /*-----------------------------------------------
  |   Helper functions and Data
  -----------------------------------------------*/
  
  var chartData = [<?php echo($result2); ?>];
  var labels = [<?php echo($result1);    ?>];
  /*-----------------------------------------------
  |   Chart Initialization
  -----------------------------------------------*/

  var newChart = function newChart(chart, config) {
    var ctx = chart.getContext('2d');
    return new window.Chart(ctx, config);
  };
  /*-----------------------------------------------
  |   Line Chart
  -----------------------------------------------*/


  var chartLine = document.getElementById('chart-line');

  if (chartLine) {
    var getChartBackground = function getChartBackground(chart) {
      var ctx = chart.getContext('2d');

     // if (storage.isDark) {
      //  var _gradientFill = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);

       // _gradientFill.addColorStop(0, utils.rgbaColor(utils.colors.primary, 0.5));

      //  _gradientFill.addColorStop(1, 'transparent');

      //  return _gradientFill;
     // }

      var gradientFill = ctx.createLinearGradient(0, 0, 0, 250);
      gradientFill.addColorStop(0, 'rgba(255, 255, 255, 0.3)');
      gradientFill.addColorStop(1, 'rgba(255, 255, 255, 0)');
      return gradientFill;
    };

    var dashboardLineChart = newChart(chartLine, {
      type: 'line',
      data: {
        labels: labels.map(function (label) {
          //return label.substring(0, label.length - 3);
		  return label.substring(0, label.length - 0);
        }),
        datasets: [{
          borderWidth: 2,
          data: chartData.map(function (d) {
            //return (d * 3.14).toFixed(2);
			return (d).toFixed(0);
          }),
          borderColor: utils.settings.chart.borderColor,
          backgroundColor: getChartBackground(chartLine)
        }]
      },
      options: {
        legend: {
          display: false
        },
        tooltips: {
          mode: 'x-axis',
          xPadding: 20,
          yPadding: 10,
          displayColors: false,
          callbacks: {
            label: function label(tooltipItem) {
              //return labels[tooltipItem.index] + " - " + tooltipItem.yLabel + " USD";
			  return labels[tooltipItem.index] + " - " + tooltipItem.yLabel + " Dossiers";
            },
            title: function title() {
              return null;
            }
          }
        },
        hover: {
          mode: 'label'
        },
        scales: {
          xAxes: [{
            scaleLabel: {
              show: true,
              labelString: 'Month'
            },
            ticks: {
              fontColor: utils.rgbaColor('#fff', 0.7),
              fontStyle: 600
            },
            gridLines: {
              color: utils.rgbaColor('#fff', 0.1),
              zeroLineColor: utils.rgbaColor('#fff', 0.1),
              lineWidth: 1
            }
          }],
          yAxes: [{
            display: true
          }]
        }
      }
    });
    $('#dashboard-chart-select').on('change', function (e) {
      var
		centre = document.getElementById('dashboard-chart-select').value;
		c=centre.to_char();

	  LineDB = {
        all: [<?php echo($result2); ?>].map(function (d) {
          //return (d * 3.14).toFixed(2);
		  return (d * 1).toFixed(0);
        }),
		
		c: [<?php echo($result2); ?>].map(function (d) {
          //return (d * 3.14).toFixed(2);
		  return (d * 1).toFixed(0);
        }),
        successful: [3, 1, 4, 1, 5, 9, 2, 6, 5, 3, 5, 8].map(function (d) {
          //return (d * 3.14).toFixed(2);
		  return (d * 1).toFixed(0);
        }),
        failed: [1, 0, 2, 1, 2, 1, 1, 0, 0, 1, 0, 2].map(function (d) {
          //return (d * 3.14).toFixed(2);
		  return (d * 1).toFixed(0);
        })
      };
      dashboardLineChart.data.datasets[0].data = LineDB[e.target.value];
      dashboardLineChart.update();
    });
  }
 
  
  
  
</script>
  </body>

</html>