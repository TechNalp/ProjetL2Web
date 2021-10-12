<!DOCTYPE html> <!-- Page d'acceuil du site, contenant la liste des actualités, les boutons de connexion/inscription ainsi que les informations de la structure en bas de page, elle permet d'accéder aux séléctions depuis le menu -->
<html lang="en">

<head>
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


 
    <script src="js/modernizr.js"></script>


</head>

<body style="background: linear-gradient(-45deg, #23a6d5, #23d5ab, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;">

    

	<div style="background: white;">
        <!-- ZONE PHP -->
    	<?php $mysqli = new mysqli('localhost','zplanchma','nw34g5c6','zfl2-zplanchma'); // Connection à la bdd
	    	if ($mysqli->connect_errno) //On regarde si il y a eu une erreur avec la connection à la bdd
	    	{
	    		echo "Error: Problème de connexion à la BDD \n";
	    		exit();// Arrêt du chargement de la page
	    	}
	    // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
	    if (!$mysqli->set_charset("utf8")) 
	    {
	    	printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
	    	exit();
	    }

	    $requete="SELECT * FROM T_ACTUALITE_NEW;";  //Requête pour récupérer les infos de toutes les actualités
	    $requete2="SELECT * FROM T_PRESENTATION_PRE;"; //Requête pour récupérer les infos de la structure

	    $result1 = $mysqli->query($requete); //execution des requêtes
	    $result2 = $mysqli->query($requete2); //execution des requêtes
	    $presentation = $result2->fetch_assoc(); //création d'un tableau associatif pour les informations de la structure

	    if ($result1 == false) //On vérifie que la requête à bien reussi
	    { 
	    	echo "Error: La requête de récupération des actualités a echoué \n"; //affichage erreur si la requête à choué
	    	exit(); // Si erreur, on stoppe le chargement de la page
	    } ?>
	</div>
    <div class="container-fluid">
        <!-- box header -->
        <header class="box-header" style="z-index: 4;">
            <div class="box-logo">
                <a href="index.php"><img src="img/logo.png" width="80" alt="Logo"></a>
            </div>
            <!-- box-nav -->
                    <a class="test_nav" href='inscription.php'>
                    <span class="ion-android-person-add" style="font-size: 25px; position: absolute; width: 30px; padding-left: 0em; background-color: transparent; height: 30px;line-height: 30px; right: 112px; top: 50%; bottom: auto; -webkit-transform: translateY(-50%); transform: translateY(-50%); display: inline-block;"></span>
                    </a>
                    <a class="test_nav" href='session.php'>
                    <span class="ion-android-person" style="font-size: 25px; position: absolute; width: 30px; padding-left: 0em; background-color: transparent; height: 30px;line-height: 30px; right: 150px; top: 50%; bottom: auto; -webkit-transform: translateY(-50%); transform: translateY(-50%); display: inline-block;"></span>
                    </a>
                    <a class="box-primary-nav-trigger" href="#0">
                        </span><span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
                    </a>
                </div>
            <!-- box-primary-nav-trigger -->
        </header>
        <!-- end box header -->
        <!-- nav -->
        <nav>
            <ul class="box-primary-nav">
                <li class="box-label">ShowTech</li>

                <li><a href="index.php">Accueil</a><i class="ion-ios-circle-filled color"></i></li>
                <li><a href="selection.php">Séléctions</a></li>
                
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
        <!-- box-intro -->
        <section class="box-intro">

            <div class="table-cell">
                <h1 class="box-headline letters rotate-2">
                    <span class="box-words-wrapper" style="z-index: -1;">
                        <b class="is-visible">showtech.</b>
                        <b class="second">Hardware.</b>
                    </span>
                </h1>
                <h5 id="amorce">Le Showroom du tech</h5>
            </div>

            <div class="mouse">
                <div class="scroll"></div>
            </div>
        </section>
        <!-- end box-intro -->
        </div>
    </div>
    <div style="position: inherit;background: white;">
    <h1 id="intro-h1" style="padding-top: 5px;">Nos Actualités:</h1>
    <div class="container main-container" style="width: 85%">
        <div class="clearfix">
            <?php while ($news=$result1->fetch_assoc()){ // Boucle pour afficher les actualités
                if ($news['NEW_ETAT']=='L'){ //On n'affiche que les actualités qui sont en ligne?> 
		            <div class="col-md-4 service-box">
		                <a class="select">
		                    <i class="ion-information-circled size-50" style="color: #de5e04;"></i>
		                    <h3><?php echo $news['NEW_TITRE'];?></h3>
		                        <h4 style="color: #de5e04; display:inline-block;"><?php echo ($news['NEW_DATE_DE_PUBLICATION']); //affichage de la date de publication?><h4 style="display:inline-block; color: #e273258c;">&nbsppar <?php echo($news['CUR_PSEUDO']) //Affichage du pseudo du publicateur?></h4></h4>
		                        <p style="font-size: 20px; color: #919191"><?php if (mb_strlen($news['NEW_TEXTE'])>200) //Cette partie sert à réduire le nombre de caractères affiché (si plus de 200 caractères, on affiche les 200 premier et on ajoute '...' à la fin)
		                        {
		                            echo (mb_substr($news['NEW_TEXTE'],0,200).'...');
		                        }   
		                        else{
		                            echo $news['NEW_TEXTE'];
		                        } ?></p>
		                        </a>
		            </div>
		    <?php  }} ?>
    	</div>
    </div>
 <?php $mysqli->close(); //On ferme la connection à la base de données ?>

<div class="portfolio-div" style="background: white;margin-top: -3%;"> 
        <div class="portfolio" style="width: 70%;margin-left: auto;margin-right: auto;">
            <h1 class="center select" style="font-weight: bold;color: #747474;text-decoration: underline; font-size: 375%;">Nos produits Phares</h1>
            <div class="no-padding portfolio_container" style="margin-left: 6%;">
                <!-- single work  -->
                <div class="col-md-3 col-sm-6  fashion logo">
                    <a href="products/INTEL_CORE_I5_10400F.php" class="portfolio_item">
                        <img src="img\Produits\Processeur/INTEL_CORE_I5_10400F.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>INTEL CORE I5 10400F</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> 
                <!-- end single work -->
                <!-- single work  -->
                <div class="col-md-3 col-sm-6 ads graphics">
                    <a href="products/ASUS_TUF_Z390_PLUS_GAMING.php" class="portfolio_item">
                        <img src="img\Produits\Carte_mere\ASUS_TUF_Z390_PLUS_GAMING.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>ASUS TUF Z390-PLUS GAMING (WI-FI)</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 photography">
                    <a href="products/ASUS_GEFORCE_RTX_3090_ROG_STRIX_OC.php" class="portfolio_item">
                        <img src="img\Produits\Cartes_graphiques\ASUS_GEFORCE_RTX_3090_ROG_STRIX_OC.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>ASUS GEFORCE RTX 3090 ROG STRIX OC</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 fashion ads">
                    <a href="products/SEAGATE_BARRACUDA _3_TO.php" class="portfolio_item">
                        <img src="img\Produits\Memoire\SEAGATE_BARRACUDA_3_TO.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>SEAGATE BARRACUDA - 3 TO</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>-
                </div>
                <!-- end single work -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 graphics ads">
                    <a href="products/BE_QUIET_PURE_ROCK_2_BLACK.php" class="portfolio_item">
                        <img src="img\Produits\Cooling\BE_QUIET_PURE_ROCK_2_BLACK.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>BE QUIET PURE ROCK 2 BLACK</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work  -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 photography">
                    <a href="products/MSI_INFINITE_S_10SC_051EU.php" class="portfolio_item">
                        <img src="img\Produits\All_in_one\MSI_INFINITE_S_10SC_051EU.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>MSI INFINITE S 10SC-051EU</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 graphics ads">
                    <a href="products/GIGABYTE_GP_P750GM_GOLD.php" class="portfolio_item">
                        <img src="img\Produits\Alimentation\GIGABYTE_GP_P750GM_GOLD.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>GIGABYTE GP-P750GM - GOLD</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work -->
                <!-- single work -->
                <div class="col-md-3 col-sm-6 graphics ads">
                    <a href="products/FRACTAL_DESIGN_FOCUS_G BLACK_WINDOW.php" class="portfolio_item">
                        <img src="img\Produits\Boitier\FRACTAL_DESIGN_FOCUS_G _BLACK_WINDOW.jpg" alt="image" class="img-responsive" />
                        <div class="portfolio_item_hover">
                            <div class="portfolio-border clearfix">
                                <div class="item_info">
                                    <span>FRACTAL DESIGN FOCUS G BLACK WINDOW</span>
                                    <em>Détails</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- end single work -->
            </div>
            <!-- end portfolio_container -->
        </div>
        <!-- portfolio -->
   </div>
    <!-- end portfolio div -->



    <!-- footer -->
    <footer>
        <div class="container-fluid">
            <p><?php echo $presentation['PRE_NOM_STRUCTURE']; ?> | <?php echo $presentation['PRE_ADRESSE']; ?> | <?php echo $presentation['PRE_EMAIL']; ?>  | <?php echo $presentation['PRE_TELEPHONE']; //Affichage dans le footer des informations de la structure?></p>
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




