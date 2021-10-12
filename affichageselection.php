<?php // Cette page permet d'afficher un élément précis et d'accéder aux élement suivant et précédent publié de la même séléction que l'élément courant
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
    } ?>


<!DOCTYPE html>
<html lang="en">

<head>
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

<body style="background: white;">

    

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
    <?php
    
    $erreur=0; //On crée une variable qui permettra d'identifier les erreurs

    if(isset($_GET['sel_id'])) // On regarde si des informations sont passés via GET
    {
        $sel_id=$_GET['sel_id'];

        $requete_sel_min="SELECT MIN(SEL_NUMERO) FROM T_SELECTION_SEL"; // On récupère le numéro de séléction le plus bas
        $requete_sel_max="SELECT MAX(SEL_NUMERO) FROM T_SELECTION_SEL"; // On récupère le numéro de séléction le plus haut
        // On exécute les deux requêtes
        $resultat_sel_min= $mysqli->query($requete_sel_min);
        $resultat_sel_max= $mysqli->query($requete_sel_max); 
        // Création des tableaux associatifs
        $sel_id_min= $resultat_sel_min->fetch_assoc();
        $sel_id_max= $resultat_sel_max->fetch_assoc();

        if(($sel_id<=$sel_id_max['MAX(SEL_NUMERO)']) AND ($sel_id>=$sel_id_min['MIN(SEL_NUMERO)'])){ // On vérifie que l'id de la séléction récupéré est compris entre l'id min et max, si oui, on continue, sinon on met $erreur à 2
            if(isset($_GET['elt_id'])){ // On vérifie qu'un id d'élément est bien passé via GET, si oui on continue, sinon on met $erreur à 3


                $elt_id=$_GET['elt_id'];

                $requete_min="SELECT MIN(ELT_NUMERO) FROM TJ_RASSEMBLE_RAS WHERE SEL_NUMERO=".$sel_id.""; // On récupère le numéro d'élément le plus bas dans la sélzction récupéré via $_GET['sel_id']
                $requete_max="SELECT MAX(ELT_NUMERO) FROM TJ_RASSEMBLE_RAS WHERE SEL_NUMERO=".$sel_id.""; // On récupère le numéro d'élément le plus haut dans la sélzction récupéré via $_GET['sel_id']
                // On exécute les deux requêtes
                $resultat_min= $mysqli->query($requete_min); 
                $resultat_max= $mysqli->query($requete_max); 
                // Création des tableaux associatifs
                $elt_id_min= $resultat_min->fetch_assoc();
                $elt_id_max= $resultat_max->fetch_assoc();

                    if(($elt_id<=$elt_id_max['MAX(ELT_NUMERO)']) AND ($elt_id>=$elt_id_min['MIN(ELT_NUMERO)'])){ // On vérifie que l'id de l'élément récupérer et bien compris entre l'id min et max des éléments de la séléction choisie

                        $requete_elt_courant="SELECT * FROM T_ELEMENT_ELT WHERE ELT_NUMERO=".$elt_id.""; // On récupère les informations de l'élément courant
                        $resultat_elts_courant=$mysqli->query($requete_elt_courant); // On exécute la requête
                        $elt_courant=$resultat_elts_courant->fetch_assoc(); // On crée le tableau associatif
                        if ($elt_courant['ELT_ETAT']=='B'){ //On vérifie que l'élément n'est pas dans l'état brouillon (si il l'est on met $erreur à 5 sinon on continue)
                            $erreur=5;
                            }
                        }
                    else{
                        $erreur=4;
                    }
            }
            else{
                $erreur=3;
            }
        }
        else {
            $erreur=2;
        }
    }
    else {
        $erreur=1;
    }

    // On teste les différentes erreur et on affiche les information nécessaire
    if($erreur==5){
        ?><div class="container main-container clearfix"><?php echo "<p style=\"color:red; font-weight:bold; text-align:center;\">L'élement séléctionné n'est pas publié</p>";?></div><?php
        echo $elt_courant['ELT_ETAT'];
    }
    else if($erreur == 4){
        ?><div class="container main-container clearfix"><?php echo "<p style=\"color:red; font-weight:bold; text-align:center;\">L'élement séléctionné n'est pas dans cette séléction ou n'éxiste pas</p>";?></div><?php
    }else if($erreur ==2){
        ?><div class="container main-container clearfix"><?php echo "<p style=\"color:red; font-weight:bold; text-align:center;\">La séléction n'existe pas</p>";?></div><?php

    }else if($erreur == 1 or $erreur ==3){
        ?><div class="container main-container clearfix"><?php echo "<p style=\"color:red; font-weight:bold; text-align:center;\">sel_id ou elt_id non définie</p>";?></div><?php
    }else if($erreur==0){ // Si il n'y a pas d'erreur, on exécute les requêtes pour récupérer l'id de l'élement précédent et suivant
        $requete_elts_suiv="SELECT ELT_NUMERO FROM TJ_RASSEMBLE_RAS JOIN T_ELEMENT_ELT USING (ELT_NUMERO) WHERE ELT_NUMERO >".$elt_id." AND SEL_NUMERO = ".$sel_id." AND ELT_ETAT='P' ORDER BY ELT_NUMERO ASC LIMIT 1";
        $requete_elts_prec="SELECT ELT_NUMERO FROM TJ_RASSEMBLE_RAS JOIN T_ELEMENT_ELT USING (ELT_NUMERO) WHERE ELT_NUMERO < ".$elt_id." AND SEL_NUMERO = ".$sel_id." AND ELT_ETAT='P'ORDER BY ELT_NUMERO DESC LIMIT 1";
        $resultat_elts_suiv=$mysqli->query($requete_elts_suiv);
        $resultat_elts_prec=$mysqli->query($requete_elts_prec);
        $elt_suiv=$resultat_elts_suiv->fetch_assoc();
        $elt_prec=$resultat_elts_prec->fetch_assoc(); ?>


    <div class="top-bar">
        <h1><?php echo $elt_courant['ELT_INTITULE'];?></h1>
        <p><a href="index.php">Acceuil</a> /<a href="selection.php">Séléctions</a>/ <?php echo $elt_courant['ELT_INTITULE'];?> </p>
    </div>
    <!-- end Top bar -->
    <div style="text-align:center;">
    <p>
    <?php 
    if ($resultat_elts_prec->num_rows==1){ // On vérifie si il y a un élément précédent, si oui on génère le lien vers l'élément précédent (et le bouton "précédent")
        echo "<a href='./affichageselection.php?sel_id=".$sel_id."&elt_id=".$elt_prec['ELT_NUMERO']."'>PRÉCÉDENT</a>"; 
    }?><span style="font-weight: 500;margin: 5px;">|</span><?php
    if($resultat_elts_suiv->num_rows==1){ // On vérifie si il y a un élément suivant, si oui on génère le lien vers l'élément suivant (et le bouton "suivant")
        echo "<a href='./affichageselection.php?sel_id=".$sel_id."&elt_id=".$elt_suiv['ELT_NUMERO']."'>SUIVANT</a>"; 
        }  
    ?>
    </p>
    </div>

    <div class="container main-container clearfix">
    <div class="col-md-6">
    <?php echo "<img class=\"img-responsive\"' src=".$elt_courant['ELT_FICHIER_IMAGE'].">";?>
        </div>
        <div class="col-md-6">
            <h3 class="uppercase"><?php echo $elt_courant['ELT_INTITULE']; ?></h3>
            <h5>Le <?php echo $elt_courant['ELT_DATE_AJOUT'];?><span style ="color:grey; margin: 15px;">Prix:<?php echo " ".$elt_courant['ELT_PRIX']." €"; ?></span></h5>
            <p>
            <?php echo (nl2br($elt_courant['ELT_DESCRIPTIF']));}?>
            </p>
        </div>
    </div>


        
        
    
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