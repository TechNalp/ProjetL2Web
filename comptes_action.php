<?php //Cette page permet aux profils activés et administrateurs d'exécuter les actions d'activation et de désactivation des profils
    session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)

    if(!isset($_SESSION['login']) or $_SESSION['statut']!='A') // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start(), on vérifie également que l'utilisateur est également administrateur, car eux seul peuvent activer/désactiver des profils
    {
    //Si la session n'est pas ouverte, redirection vers la page du formulaire de connexion
        header("Location:session.php");
        exit();
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

    // On utilise la variable superglobale $_POST pour récupérer les informations du formulaire
    if (isset($_POST['A'])){ // On regarde si le formulaire contient un input nommée 'A' si oui alors nous voulons éffectuer une activation
        $requete_active="UPDATE T_PROFILUTILISATEUR_PUR SET PUR_VALIDITE_DU_PROFIL = 'A' WHERE CUR_PSEUDO =\"".$_POST['pseudo']."\" ;"; // Requête d'activation d'un profil, on récupére le pseudo du profil à activer via l'input caché du formulaire
        $execute = $mysqli->query($requete_active); // On exécute la requête d'activation d'un profil
        header("Location:admin_accueil.php");
    }else{ // Si le formulaire ne contient pas d'input nommé 'A', alors nous voulons éffectuer une désactivation
        $requete_active="UPDATE T_PROFILUTILISATEUR_PUR SET PUR_VALIDITE_DU_PROFIL = 'D' WHERE CUR_PSEUDO =\"".$_POST['pseudo']."\" ;"; // Requête de désactivation d'un profil, on récupére le pseudo du profil à désactiver via l'input caché du formulaire
        $execute = $mysqli->query($requete_active); // On exécute la requête désactivation d'un profil
    }
    
    header("Location:admin_accueil.php"); // Une fois la requête voulu exécuté, on redirige vers la page d'administration
    ?>