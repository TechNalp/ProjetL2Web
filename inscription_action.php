<?php //Cette page permet d'efféctuer l'inscription
$mysqli = new mysqli('localhost','zplanchma','nw34g5c6','zfl2-zplanchma'); // Connection à la bdd
        if ($mysqli->connect_errno) //On regarde si il y a eu une erreur avec la connection à la bdd
            {
                echo "<p>Error: Problème de connexion à la BDD</p>";
                exit();// Arrêt du chargement de la page
            }
        // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
        if (!$mysqli->set_charset("utf8")) 
        {
            printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
            exit();
        } ?>
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
    </div>
    

    <!-- Main container -->
    
    

    <div style="position: inherit;margin-top: 84px;text-align: center">
    <?php //Cette partie du code php sert à vérifier que tout les champs d'inscription on bien été remplis, puis on attribut les valeurs obtenus à des variable après avoir appliqué htmlspecialchars et addslashes comme mécanisme de sécurité
    $problem=0; // Cette variable permet de savoir si une erreur à eu lieu
    if (!empty($_POST["pseudo"])){
        $id=htmlspecialchars(addslashes($_POST['pseudo']));
    }
    else{
        echo "<p style="."color:#FF007B>Erreur saisi pseudo\n</p>";
        $problem=1;
    }
    if (!empty($_POST["mdp"])){
        $mdp=htmlspecialchars(addslashes($_POST['mdp']));
    }
    else{
        echo "<p style="."color:#FF007B>Erreur saisi mot de passe\n</p>";
        $problem=1;
    }  
    if (!empty($_POST["name"])){
        $name=htmlspecialchars(addslashes($_POST['name']));
    }
    else{
        echo "<p style="."color:#FF007B>Erreur saisi prénom\n</p>";
        $problem=1;
    }
    if (!empty($_POST["last_name"])){
        $last_name=htmlspecialchars(addslashes($_POST['last_name']));
    }
    else{
         echo "<p style="."color:#FF007B>Erreur saisi nom\n</p>";
        $problem=1;
    }
    if (!empty($_POST["mail"])){
        $mail=htmlspecialchars(addslashes($_POST['mail']));
    }
    else{
        echo "<p style="."color:#FF007B>Erreur saisi email\n</p>";
        $problem=1;
    }

    if (!empty($_POST["mdp_confirm"])){
        $mdp_confirm=htmlspecialchars(addslashes($_POST['mdp_confirm']));
        if(strcmp($mdp,$mdp_confirm)!=0){ // On compare les 2 mot de passes saisi et on vérifie qu'il sont bien identique
            $problem=1; // Si il ne sont pas identique on modifie la variable $problem pour indiquer qu'une erreur à eu lieu
            echo "<p style=\"color:#FF007B; font-weight:bold;\">mot de passe différents</p>";
        }
    } ?>
<?php
if($problem==0){ //On éxécute les requêtes uniquement si il n'y pas eu erreur
        $sql_compte="INSERT INTO T_COMPTEUTILISATEUR_CUR VALUES('".$id."','".MD5($mdp)."');"; // Requête d'insertion du compte dans la bdd
        $sql_profil="INSERT INTO T_PROFILUTILISATEUR_PUR VALUES('".$name."', '".$last_name."', '".$mail."', 'D', 'R', current_timestamp(), '".$id."');"; // Requête d'insertion du profils dans la bdd
        $delete_compte="DELETE FROM T_COMPTEUTILISATEUR_CUR WHERE CUR_PSEUDO =\"".$id."\""; // Requête de suppresion du compte de la bdd

        $result3 = $mysqli->query($sql_compte); //On exécute la requête d'insertion du compte dans la bd
        if ($result3 == false) //Si il y eu une erreur lors de l'exécution, on réaffiche le formulaire préremplie
        {
            echo "<p style="."color:#7900FF; font-weight: bold;>Erreur création Compte\n</p>";
            //echo "<p style="."color:#7900FF>Query: " . $sql_compte . "\n</p>";
            //echo "<p style="."color:#7900FF>Errno: " . $mysqli->errno . "\n</p>";
            //echo "<p style="."color:#7900FF>Error: " . $mysqli->error . "\n</p>";
            echo "<p style="."color:red>Erreur de génération du compte/profil</p>";
            echo "<form action=\"inscription_action.php\" method=\"post\">";
                echo    "<legend>Modifier le formulaire :</legend>";
                echo        "<fieldset style=\"width: 402px; margin: 0px auto; text-align: right;\">";
                echo            "<p>Votre pseudo : <input type=\"text\" value=\"$id\" name=\"pseudo\"/></p>";
                echo            "<p>Votre mot de passe : <input type=\"password\" name=\"mdp\" minlength=\"8\"/></p>";
                echo            "<p>Confirmez votre mot de passe: <input type=\"password\" name=\"mdp_confirm\" minlength=\"8\"/></p>";
                echo            "<p>Votre prénom : <input type=\"text\" value=\"$name\" name=\"name\" /></p>";
                echo            "<p>Votre nom : <input type=\"text\" value=\"$last_name\" name=\"last_name\" /></p>";
                echo            "<p>Votre E-mail : <input type=\"email\" value=\"$mail\" name=\"mail\" /></p>";
                echo            "<p style=\"text-align:center;\"><input type=\"submit\" value=\"Valider\" style=\"text-align:center;background: #ff7500;font-size: large;color: white;border-style: hidden;\"></p>";
                echo        "</fieldset>";
                echo "</form>";
            exit(); //On arrête le chargement de la page
        }
        else{ //Si requête réussi
            $result4 = $mysqli->query($sql_profil); //On exécute la requête d'insertion du profil dans la bdd
            if ($result4 == false){ // si la requête précédente n'a pas fonctionné (donc il y a un compte sans profil)
                echo "<p style="."color:red>Erreur creation profil \n</p>"; //on affiche une erreur
                //echo "Query: " . $sql_profil . "\n";
                //echo "Errno: " . $mysqli->errno . "\n";
                //echo "Error: " . $mysqli->error . "\n";
                $result5 = $mysqli->query($delete_compte); //on exécute la requête de suppression du compte, pour ne pas laisser de compte sans profil
                if ($result5 == false){ //On verifie si la requête de suppression du compte s'est bien exécuté
                    echo "Error: suppression profil sans compte \n"; //On affiche l'erreur
                    //echo "Query: " . $delete_compte . "\n";
                    //echo "Errno: " . $mysqli->errno . "\n";
                    //echo "Error: " . $mysqli->error . "\n";
                }
                echo "<p style="."color:red>Erreur de génération du compte/profil</p>"; // On réaffiche le formulaire préremplie
                echo "<form action=\"inscription_action.php\" method=\"post\">";
                echo    "<legend>Modifier le formulaire :</legend>";
                echo        "<fieldset style=\"width: 402px; margin: 0px auto; text-align: right;\">";
                echo            "<p>Votre pseudo : <input type=\"text\" value=\"$id\" name=\"pseudo\"/></p>";
                echo            "<p>Votre mot de passe : <input type=\"password\" name=\"mdp\" minlength=\"8\"/></p>";
                echo            "<p>Confirmez votre mot de passe: <input type=\"password\" name=\"mdp_confirm\" minlength=\"8\"/></p>";
                echo            "<p>Votre prénom : <input type=\"text\" value=\"$name\" name=\"name\" /></p>";
                echo            "<p>Votre nom : <input type=\"text\" value=\"$last_name\" name=\"last_name\" /></p>";
                echo            "<p>Votre E-mail : <input type=\"email\" value=\"$mail\" name=\"mail\" /></p>";
                echo            "<p style=\"text-align:center;\"><input type=\"submit\" value=\"Valider\" style=\"text-align:center;background: #ff7500;font-size: large;color: white;border-style: hidden;\"></p>";
                echo        "</fieldset>";
                echo "</form>";
            exit(); // On arrête le chargement de la page 
            }
            ?>
            <p>Bonjour et bienvenue, &nbsp<span style="color: #ff8d00; font-weight: bold;"><?php echo htmlspecialchars($_POST['pseudo']); ?></span>.</p> <!-- Si il n'y a pas eu d'erreur, on affiche un message de bienvenu et on indique que l'inscription s'est bien déroulé -->
            <?php echo "<p style="."color:#00FF21; font-weight: bold;>Inscription réussie !" . "\n</p>";
        }
    
        $mysqli->close(); // On ferme la connexion avec la bdd
}
else{ //Si $problem !=0, on réaffiche le formulaire d'inscription en mettant à NULL les variables qui n'ont pas reçu de valeur (cause possible de l'erreur)
    if(empty($id)){
        $id=NULL;
    }
    if(empty($name)){
        $name=NULL;
    }
    if(empty($last_name)){
        $last_name=NULL;
    }
    if(empty($mail)){
        $mail=NULL;
    }
    echo "<p style="."color:red>Erreur de génération du compte/profil</p>";
    echo "<form action=\"inscription_action.php\" method=\"post\">";
    echo    "<legend>Modifier le formulaire :</legend>";
    echo        "<fieldset style=\"width: 402px; margin: 0px auto; text-align: right;\">";
    echo            "<p>Votre pseudo : <input type=\"text\" value=\"$id\" name=\"pseudo\"/></p>";
    echo            "<p>Votre mot de passe : <input type=\"password\" name=\"mdp\" minlength=\"8\"/></p>";
    echo            "<p>Confirmez votre mot de passe: <input type=\"password\" name=\"mdp_confirm\" minlength=\"8\"/></p>";
    echo            "<p>Votre prénom : <input type=\"text\" value=\"$name\" name=\"name\" /></p>";
    echo            "<p>Votre nom : <input type=\"text\" value=\"$last_name\" name=\"last_name\" /></p>";
    echo            "<p>Votre E-mail : <input type=\"email\" value=\"$mail\" name=\"mail\" /></p>";
    echo            "<p style=\"text-align:center;\"><input type=\"submit\" value=\"Valider\" style=\"text-align:center;background: #ff7500;font-size: large;color: white;border-style: hidden;\"></p>";
    echo        "</fieldset>";
    echo "</form>";
    //echo "<a href="."inscription.php>Retourner au formulaire d'inscription</a>";

}
?>
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