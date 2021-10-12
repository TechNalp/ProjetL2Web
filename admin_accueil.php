<?php //Cette page permet aux responsables (activés) de voir leurs informations et au administrateur d'en plus voir la liste des profils et de les activés/désactivés
session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)

    if(!isset($_SESSION['login'])) // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start()
    {
     //Si la session n'est pas ouverte, redirection vers la page du formulaire de connexion
    	header("Location:session.php");
        exit(); //arret du chargement de la page (éxécuté uniquement si le header n'a pas fonctionné)
    }

        $mysqli = new mysqli('localhost','zplanchma','nw34g5c6','zfl2-zplanchma'); // Connection à la bdd
        if ($mysqli->connect_errno) //verification de si il y a eu une erreur lors de la connection
        {
            // Affichage d'un message d'erreur
        	echo "<p>Erreur: Problème de connexion à la Base de données de ShowTech </p>\n";
            //echo "Errno: " . $mysqli->connect_errno . "\n";
            //echo "Error: " . $mysqli->connect_error . "\n";
            // Arrêt du chargement de la page
        	exit();
        }
        // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
        if (!$mysqli->set_charset("utf8")) {
        	printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
        	exit();
        }
        if($_SESSION['statut']=='A'){//On verifie si la session courante appartient à un administrateur ou non, si oui, on affiche la page comme pour un responsable  mais avec l'affichage de la liste des profils en plus (ainsi que leur activation/désactivation)
        ?>
        <html>
        <head>
        	<!--entête du fichier HTML-->
        	<meta charset="utf-8">
        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        	<meta name="viewport" content="width=device-width, initial-scale=1">
        	<title>Showroom De Mathis Planchet</title>
        	<link rel="icon" href="img/fav.png" type="image/x-icon">

        	<!-- Bootstrap -->
        	<link href="css/bootstrap.min.css" rel="stylesheet">
        	<link href="ionicons/css/ionicons.min.css" rel="stylesheet">

        	<!-- main css -->
        	<link href="css/style.css" rel="stylesheet">


        	<!-- modernizr -->
        	<script src="js/modernizr.js"></script>

        </head>
        <body>
        	<div class="container-fluid"> 
        		<!-- box-header -->
        		<header class="box-header">
        			<div class="box-logo">
        				<a href="index.php"><img src="img/logo.png" width="80" alt="Logo"></a>
        			</div>
        			<!-- box-nav -->
        			<a class="box-primary-nav-trigger" href="#0">
        				<span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
        			</a>
        		</header>
        		<!-- end box-header -->

        		<!-- nav -->
        		<nav>
        			<ul class="box-primary-nav">
        				<li class="box-label">ShowTech</li>

        				<li><a href="index.php">Accueil</a></li>
        				<li><a href="selection.php">Séléctions</a> <i class="ion-ios-circle-filled color"></i></li>

        				<li><a href="portfolio.php">Produits</a></li>
        				<li><a href="tuto.php">Nos conseils</a></li>

        				<li class="box-label">Nous suivre sur les réseaux sociaux</li>

        				<li class="box-social"><a href="#0"><i class="ion-social-facebook"></i></a></li>
        				<li class="box-social"><a href="#0"><i class="ion-social-instagram-outline"></i></a></li>
        				<li class="box-social"><a href="#0"><i class="ion-social-twitter"></i></a></li>
        				<li class="box-social"><a href="#0"><i class="ion-social-dribbble"></i></a></li>
        			</ul>
        		</nav>
        		<!-- end nav -->  
        	</div>

        	<!-- Top bar -->
        	<div class="top-bar">
        		<h1>ESPACE ADMINISTRATION</h1>
        		<p>Acceuil / Espace administration</p>
        	</div>
        	<!-- end Top bar -->
        	<div>
        		<div style="position: sticky; top:20px; text-align: center; margin: auto; width: fit-content;">
        			<form action="menu_action.php" method="post">
        				<input name="acceuil" value="Acceuil & profil(s)" type=submit style="color: black; font-weight: 500;">
        				<input name="selection" value="Gestion des séléctions" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
        				<input name="news" value="Gestion des actualités" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
        				<input name="deconnexion" value="Déconnexion" type=submit style="margin-left: 15px; color:red;font-weight: bold;">
        			</form>
        		</div>
        		<!-- Main container -->
        		<div>
        			<div style="text-align: center; width: 30%;margin: auto;">
        				<?php
		                        $statut="Administrateur"; //Nous sommes dans le IF ($_SESSION['statut']=='A'), donc il s'agit d'un compte administrateur
		                        $requete_liste_profils="SELECT * FROM T_PROFILUTILISATEUR_PUR"; //On crée donc une requête pour récuperer la liste des profils
		                        $resultat_liste_profils=$mysqli->query($requete_liste_profils); //On exécute la requête
		                    //Les echo si dessous servent à afficher les informations sur le compte actuellement connecté
		                        echo "<p> Vous êtes connecté en tant que: <span style=\"color: #ff8100; font-weight: bold;\">".$_SESSION['login']."</span>.</p>";
		                        echo "<p> Vos infos:</p>";
		                        echo "<div style=\"text-align: left;\">";
		                        echo "<p>Prénom: <span style=\"color:red;\">".$_SESSION['prenom']."</span></p><p>Nom: <span style=\"color:red;\">".$_SESSION['nom']."</span></p><p>Email: <span style=\"color:red;\">".$_SESSION['email']."</span></p><p>Date de création du profil: <span style=\"color:red;\">".$_SESSION['date_creation']."</span></p><p>Vous êtes: <span style=\"color:red;\">".$statut."";
		                        echo "</div>";
		                        ?>
		                    </div>
		                    <!-- Table contenant la liste des profils -->
		                    <table border=0 style="margin: auto; width:70%;">
		                    	<legend style="text-align: center;"><?php echo "Liste des profils (".$resultat_liste_profils->num_rows." trouvés) : "//On affiche le nombre de profils trouvés (correspondant au nombre de lignes retourné par la requête)?>:</legend>
		                    	<tr>
		                    		<th style="text-align: center;"><p>Pseudo</p></th>
		                    		<th style="text-align: center;"><p>Prénom</p></th>
		                    		<th style="text-align: center;"><p>Nom</p></th>
		                    		<th style="text-align: center;"><p>Email</p></th>
		                    		<th style="text-align: center;"><p>Date de création</p></th>
		                    		<th style="text-align: center;"><p>Validité du profil</p></th>
		                    		<th style="text-align: center;"><p>Statut</p></th>
		                    		<th style="text-align: center;"><p style="color:orange;">Activation/Désactivation</p></th>
		                    	</tr>
		                    	<?php while($profil=$resultat_liste_profils->fetch_assoc()){ //Pour chaque ligne retourné par la requête on crée un tableau associatif contenant les information de la ligne courante ?>
		                    		<tr>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['CUR_PSEUDO']; //Affichage du pseudo du profil contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_PRENOM']; //Affichage du prénom du profil contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_NOM']; //Affichage du nom du profil contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_EMAIL']; //Affichage de l'email du profil contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_DATE_DE_CREATION']; //Affichage de la date de création du profil contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_VALIDITE_DU_PROFIL']; //Affichage de la validité du profil (A/D) contenu dans la ligne courante ?></p></td>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $profil['PUR_STATUT']; //Affichage du statut du profil (A/R) contenu dans la ligne courante ?></p></td>
		                    			<?php //La dernière colonne du tableau contient pour chaque ligne un bouton (donc un formulaire) permettant d'activer ou de désactiver un profil selon sa validité actuelle (en fonction de cette dernière nous affichons également les boutons différemment), les fomulaire envoi via un input hidden le pseudo du profil de la ligne depuis laquel le formulaire est envoyé, il est envoyé vers un fichier "comptes_action.php",avec la méthode POST,qui s'occupera de désactiver/activer le profil ?>
		                    			<td style="text-align: center; border-top: solid; border-bottom: solid;"><?php if ($profil['PUR_VALIDITE_DU_PROFIL']=='A')
		                    			{
		                    				echo "<form style=\"margin: 10;\" action=\"comptes_action.php\" method=\"post\">
		                    				<fieldset>
		                    				<p style=\"text-align:center; margin: 0;\"><input name=\"pseudo\" type=\"hidden\" value=\"".
		                    				$profil['CUR_PSEUDO']."\"><input name=\"D\"type=\"submit\" value=\"Désactiver\" style=\"text-align:center;background: red; font-size: large;color: white;border-style: hidden;\"></p>
		                    				</fieldset>
		                    				</form>"; /*Ce formulaire envoi un imput nommé 'D'*/
		                    			}else
		                    			{
		                    				echo "<form style=\"margin: 10;\" action=\"comptes_action.php\" method=\"post\">
		                    				<fieldset>
		                    				<p style=\"text-align:center; margin: 0;\"><input name=\"pseudo\" type=\"hidden\" value=\"".
		                    				$profil['CUR_PSEUDO']."\"><input name=\"A\" type=\"submit\" value=\"Activer\" style=\"text-align:center;background: lawngreen;font-size: large;color: white;border-style: hidden;width: 40%;\"></p>
		                    				</fieldset>
		                    			</form>"; /*Ce formulaire envoi un imput nommé 'A'*/ }?></p></td>
		                    		</tr>
		                    	<?php } ?>
		                    </table>
		                </div>
		            </div>

		            <?php $mysqli->close(); //Une fois toute les actions nécessitant la bdd efféctuées, nous nous déconnectons?>




		            <!-- end Main container -->


		            <!-- footer -->
		            <footer>
		            	<div class="container-fluid">
		            		<p class="copyright">© Mathis Planchet</p>
		            	</div>
		            </footer>
		            <!-- end footer -->

		            <!-- back to top -->
		            <a href="#0" class="cd-top"><i class="ion-android-arrow-up"></i></a>
		            <!-- end back to top -->



		            <!-- jQuery -->
		            <script src="js/jquery-2.1.1.js"></script>
		            <!--  plugins -->
		            <script src="js/bootstrap.min.js"></script>
		            <script src="js/menu.js"></script>
		            <script src="js/animated-headline.js"></script>
		            <script src="js/isotope.pkgd.min.js"></script>

		            <!--  custom script -->
		            <script src="js/custom.js"></script>

		        </body>
		        </html>

    <?php }else //Si l'utilisateur n'est pas administrateur (On affiche la même page que pour un administrateur (mais sans la liste des profils et la possibilité de les activés/désactivés))
    { ?>
    	<html>
    	<head>
    		<!--entête du fichier HTML-->
    		<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
    		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    		<title>Showroom De Mathis Planchet</title>
    		<link rel="icon" href="img/fav.png" type="image/x-icon">
    		<!-- Bootstrap -->
    		<link href="css/bootstrap.min.css" rel="stylesheet">
    		<link href="ionicons/css/ionicons.min.css" rel="stylesheet">
    		<!-- main css -->
    		<link href="css/style.css" rel="stylesheet">
    		<!-- modernizr -->
    		<script src="js/modernizr.js"></script>
    	</head>
    	<body>
    		<!-- Preloader -->
    		<div id="preloader">
    			<div class="pre-container">
    				<div class="spinner">
    					<div class="double-bounce1"></div>
    					<div class="double-bounce2"></div>
    				</div>
    			</div>
    		</div>
    		<!-- end Preloader -->
    		<div class="container-fluid"> 
    			<!-- box-header -->
    			<header class="box-header">
    				<div class="box-logo">
    					<a href="index.php"><img src="img/logo.png" width="80" alt="Logo"></a>
    				</div>
    				<!-- box-nav -->
    				<a class="box-primary-nav-trigger" href="#0">
    					<span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
    				</a>
    			</header>
    			<!-- end box-header -->

    			<!-- nav -->
    			<nav>
    				<ul class="box-primary-nav">
    					<li class="box-label">ShowTech</li>

    					<li><a href="index.php">Accueil</a></li>
    					<li><a href="selection.php">Séléctions</a> <i class="ion-ios-circle-filled color"></i></li>

    					<li><a href="portfolio.php">Produits</a></li>
    					<li><a href="tuto.php">Nos conseils</a></li>

    					<li class="box-label">Nous suivre sur les réseaux sociaux</li>

    					<li class="box-social"><a href="#0"><i class="ion-social-facebook"></i></a></li>
    					<li class="box-social"><a href="#0"><i class="ion-social-instagram-outline"></i></a></li>
    					<li class="box-social"><a href="#0"><i class="ion-social-twitter"></i></a></li>
    					<li class="box-social"><a href="#0"><i class="ion-social-dribbble"></i></a></li>
    				</ul>
    			</nav>
    			<!-- end nav -->  
    		</div>

    		<!-- Top bar -->
    		<div class="top-bar">
    			<h1>ESPACE ADMINISTRATION</h1>
    			<p>Acceuil / Espace administration</p>
    		</div>
    		<!-- end Top bar -->
    		<div>
    			<div style="position: sticky; top:20px; text-align: center; margin: auto; width: fit-content;">
    				<form action="menu_action.php" method="post">
    					<input name="acceuil" value="Acceuil" type=submit style="color: black; font-weight: 500;">
    					<input name="selection" value="Gestion des séléctions" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
    					<input name="news" value="Gestion des actualités" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
    					<input name="deconnexion" value="Déconnexion" type=submit style="margin-left: 15px; color:red;font-weight: bold;">
    				</form>
    			</div>
    			<!-- Main container -->
    			<div>
    				<div style="text-align: center; width: 30%;margin: auto;">
    					<?php
    					$statut="Responsable"; //Nous sommes dans le cas ou l'utilisateur est un responsable
    					//Les echo si dessous servent à afficher les informations de l'utilisateur actuellement connecté
    					echo "<p> Vous êtes connecté en tant que: <span style=\"color: #ff8100; font-weight: bold;\">".$_SESSION['login']."</span>.</p>";
    					echo "<p> Vos infos:</p>";
    					echo "<div style=\"text-align: left;\">";
    					echo "<p>Prénom: <span style=\"color:red;\">".$_SESSION['prenom']."</span></p><p>Nom: <span style=\"color:red;\">".$_SESSION['nom']."</span></p><p>Email: <span style=\"color:red;\">".$_SESSION['email']."</span></p><p>Date de création du profil: <span style=\"color:red;\">".$_SESSION['date_creation']."</span></p><p>Vous êtes: <span style=\"color:red;\">".$statut."";
    					echo "</div>";
    					?>
    				</div>
    				<?php $mysqli->close(); //On ferme la connection à la bdd (car nous n'avons plus besoin)?>




    				<!-- end Main container -->
    			</div>
    		</div>


    		<!-- footer -->
    		<footer>
    			<div class="container-fluid">
    				<p class="copyright">© Mathis Planchet</p>
    			</div>
    		</footer>
    		<!-- end footer -->

    		<!-- back to top -->
    		<a href="#0" class="cd-top"><i class="ion-android-arrow-up"></i></a>
    		<!-- end back to top -->



    		<!-- jQuery -->
    		<script src="js/jquery-2.1.1.js"></script>
    		<!--  plugins -->
    		<script src="js/bootstrap.min.js"></script>
    		<script src="js/menu.js"></script>
    		<script src="js/animated-headline.js"></script>
    		<script src="js/isotope.pkgd.min.js"></script>


    		<!--  custom script -->
    		<script src="js/custom.js"></script>

    	</body>
    	</html>
    	<?php } ?>