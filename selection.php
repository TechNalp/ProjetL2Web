<?php // Page contenant la liste de toutes les séléctions et permettant d'accéder au premier élément de chacune
    $mysqli = new mysqli('localhost','zplanchma','nw34g5c6','zfl2-zplanchma');
    if ($mysqli->connect_errno)
    {
    // Affichage d'un message d'erreur
    echo "<p>Erreur: Problème de connexion à la Base de données de ShowTech </p>";
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

    $requete="SELECT * FROM T_SELECTION_SEL;"; // requête pour obtenir toutes les séléctions
    $result1 = $mysqli->query($requete); // exécution de la requête
    ?>


<!DOCTYPE html>
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
        <h1>Séléctions</h1>
        <p>Acceuil / Séléctions</p>
    </div>
    <!-- end Top bar -->
    
    <!-- Main container -->
    
    

<div style="position: inherit;margin-top: 25px; text-align: center">
 <!-- Table contenant la liste des séléctions et les liens vers leur premier élément réspectif -->
<table border=2 style="text-align: center; margin: auto;">
    <tr>
    <th style="text-align: center;"><p>Séléction</p></th>
    <th style="text-align: center;"><p>Description</p></th>
    <th style="text-align: center;"><p>Date d'ajout</p></th>
    <th style="text-align: center;"><p>Publicateur</p></th>
    <th style="text-align: center;"><p>Vers les éléments</p></th>
</tr>
    

    <?php while ($sel= $result1->fetch_assoc()) // Pour chaque séléction on effectue la requête si dessous
    { 
        $requete2="SELECT * FROM T_ELEMENT_ELT JOIN TJ_RASSEMBLE_RAS USING (ELT_NUMERO) WHERE SEL_NUMERO = ".$sel['SEL_NUMERO']." AND ELT_ETAT = 'P' LIMIT 1;"; // requête pour récuperer le premire élément d'une séléction choisie
        $result2 = $mysqli->query($requete2); // exécution de la requête
        $first_elt= $result2->fetch_assoc(); // création du tableau associatif
    ?>
    <tr>
        <td> <?php echo $sel['SEL_INTITULE']; //Affichage de l'intitulé de la séléction contenu dans la ligne courante ?></td>
        <td> <?php echo $sel['SEL_TEXTE_INTRODUCTIF']; //Affichage du texte de la séléction contenu dans la ligne courante?></td>
        <td> <?php echo $sel['SEL_DATE_AJOUT']; //Affichage de la date d'ajout de la séléction contenu dans la ligne courante??></td>
        <td> <?php echo $sel['CUR_PSEUDO']; //Affichage du pseudo du profil ayant créé la séléction contenu dans la ligne courante??></td>
        <td> <?php echo "<a href='./affichageselection.php?sel_id=".$sel['SEL_NUMERO']."&elt_id=".$first_elt['ELT_NUMERO']."'>Voir</a>"; //Création du lien vers le premier élément de la séléction courante?></td>
    </tr>
    <?php } $mysqli->close(); //On ferme la connection à la base de données?>

</table>


<!-- end Main container -->
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