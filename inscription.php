<!DOCTYPE html> <!-- Cette page contient le formulaire permettant l'inscription -->
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
                <li><a href="selection.php">Séléctions</a> </li>
                
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
        <h1>Incription</h1>
        <p>Acceuil / Inscription</p>
    </div>
    <!-- end Top bar -->
    
    <!-- Main container -->
   <div id="contenu" style="text-align: center;">
        <form action="inscription_action.php" method="post"> <!-- formulaire envoyant via la méthode post les informations de l'inscription au fichier "inscription_action.php" -->
        <legend>Données personnelles :</legend>
        <fieldset style="width: 402px; margin: 0px auto; text-align: right;">
            <p>Votre pseudo : <input type="text" name="pseudo" placeholder="Pseudo"/></p>
            <p>Votre mot de passe : <input type="password" name="mdp" minlength="8" placeholder="Mot de passe"/></p>
            <p>Confirmez votre mot de passe: <input type="password" name="mdp_confirm" placeholder="Confirmer mot de passe" minlength="8"/></p>
            <p>Votre prénom : <input type="text" name="name" placeholder="Prénom"/></p>
            <p>Votre nom : <input type="text" name="last_name" placeholder="Nom"/></p>
            <p>Votre E-mail : <input type="email" name="mail" placeholder="Email"/></p>
            <p style="text-align:center;"><input type="submit" value="Valider" style="text-align:center;background: #ff7500;font-size: large;color: white;border-style: hidden;"></p>
            </fieldset>
        </form>
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