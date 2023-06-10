<!DOCTYPE html>
<html lang="en">
<?php 

if (isset($_POST['connexion']))
{
  include ('connect.php');

// Récupération du type d'utilisateur depuis la base de données
    $query = "SELECT type_utilisateur FROM utilisateur where email_utilisateur = '".$_POST['login']."' AND  password_utilisateur = '".$_POST['password']."'";
    $result = $connexion->query($query);

    if ($result && $result->num_rows === 1) {
        // Récupérer le type d'utilisateur
        $row = $result->fetch_assoc();
        $Type = $row['type_utilisateur'];

        // Redirection en fonction du type d'utilisateur
        if ($Type === 'agent hopital') {
            header('Location: formulaire.php');
            exit();
        } elseif ($Type === 'agent shocroom') {
            header('Location: hela.html');
            exit();
        } elseif ($Type === 'admin') {
            header('Location: admin.php');
            exit();
        } else {
            // Type d'utilisateur inconnu ou autre traitement à effectuer
            // Redirection vers une page par défaut ou affichage d'un message d'erreur, par exemple
            header('Location: default.html');
            exit();
        }
    }
  }

// Autres opérations sur la base de données...

// Fermeture de la connexion
//$connexion->close();
?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Shocroom</title>


   <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="assets/img/logo.png" />
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
	
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="assets/css/theme.css" rel="stylesheet">

  </head>


  <body>
	<?php
	session_start();
	if ((isset($_SESSION["user_id"]) && $_SESSION["type"]  == "Admin")) {
		header("Location: login.php");
	}
	?>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container-fluid">
        <div class="row min-vh-100 flex-center no-gutters">
          <div class="col-lg-8 col-xxl-5 py-3"><img class="bg-auth-circle-shape" src="assets/img/illustrations/bg-shape.png" alt="" width="250"><img class="bg-auth-circle-shape-2" src="assets/img/illustrations/shape-1.png" alt="" width="150">
            <div class="card overflow-hidden z-index-1">
              <div class="card-body p-0">
                <div class="row no-gutters h-100">
                  <div class="col-md-5 text-white text-center bg-card-gradient">
                    <div class="position-relative p-4 pt-md-5 pb-md-7">
                      <div class="bg-holder bg-auth-card-shape" style="background-image:url(assets/img/illustrations/half-circle.png);">
                      </div>
                      <!--/.bg-holder-->

                      <div class="z-index-1 position-relative"><img class="mr-2" src="assets/img/drapeauB.png" alt="" align="center" width="180px" />
					  <br>
					   <br>
					  <a class="text-white mb-4 text-sans-serif font-weight-extra-bold fs-4 d-inline-block" href="index.php">UrgenTrack</a>
                        <p class="text-white opacity-75"></p>
                      </div>
                    </div>
                    <div class="mt-3 mb-4 mt-md-4 mb-md-5">
                      <p><br><a class="text-white text-underline" href="#"></a></p>
                      <p class="mb-0 mt-4 mt-md-5 fs--1 font-weight-semi-bold text-white opacity-75"><a class="text-underline text-white" href="#"></a><a class="text-underline text-white" href="#"></a></p>
                    </div>
                  </div>
                  <div class="col-md-7 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                      <h3>Se connecter </h3>
                      <form method="POST" class="my-login-validation" action="login.php">
                        <div class="form-group">
                          <label for="login">Email utilisateur </label>
                          <input class="form-control" id="login" type="text" name="login" value="" required autofocus/>
                        </div>
                        <div class="form-group">
                          <div class="d-flex justify-content-between">
                            <label for="password">Mot de passe </label>
                          </div>
                          <input class="form-control" id="password" name="password" type="password" required data-eye/>
                        </div>
						<?php
										if (isset($_SESSION["error"])) {
											$error = $_SESSION["error"];
											echo "<span style = 'color : red ;'>$error</span>";
											unset($_SESSION["error"]);
										}
										?>
										
										<!--div id="recaptcha" name="recaptcha" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " > 
                                 <div class="row" >
									<div class="form-group"> 
										<div class="g-recaptcha" data-sitekey="6LfAnuwkAAAAALUsEZJdtcC1lK8uf90CGBKumKp4"></div>

									</div>
								 </div>
						   </div-->
						
                        <div class="form-group">
                          <button class="btn btn-primary btn-block mt-3" type="submit" name="connexion">Connexion </button>
                        </div>
                      </form>
                      <div class="w-100 position-relative mt-4">
                        <hr class="text-300" />
                        <div class="position-absolute absolute-centered t-0 px-3 bg-white text-sans-serif fs--1 text-500 text-nowrap">Copyright &copy; 2023 &mdash; CIMS</div>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    <script src="assets/js/theme.js"></script>

  </body>

</html>