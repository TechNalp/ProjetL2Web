<?php // Cette page gère l'authentification d'un utilisateur
session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)
/*Affectation dans des variables du pseudo/mot de passe s'ils existent,
affichage d'un message sinon*/
if (isset($_POST["pseudo"]) && isset($_POST["mdp"])){ // On verrifie que $_POST["pseudo"] et $_POST["mdp"] existes, si non, alors l'accès à cette page ne ce fait pas depuis le formulaire de connexion
    $id=htmlspecialchars(addslashes($_POST["pseudo"])); // On sécurise les informations entrés par l'utilisateur
    $motdepasse=htmlspecialchars(addslashes($_POST["mdp"])); // On sécurise les informations entrés par l'utilisateur
    // Connexion à la base MariaDB
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
    $sql="SELECT * FROM T_COMPTEUTILISATEUR_CUR JOIN T_PROFILUTILISATEUR_PUR USING(CUR_PSEUDO) WHERE CUR_PSEUDO='".$id."' AND CUR_MOT_DE_PASSE=MD5('".$motdepasse."') AND PUR_VALIDITE_DU_PROFIL='A'"; // requête de recherche du compte dans la bdd (pseudo + mdp et activation)
    $resultat = $mysqli->query($sql); // exécution de la requête
    if ($resultat==false) { // on vérifie si la requête à réussi, si elle à réussi, on continue, sinon on affiche un message d'erreur
    echo "Error: Problème d'accès à la base \n";
    exit();
    }   
    else {
    if($resultat->num_rows == 1) { // On vérifie si la requête à trouvé une ligne, si oui alors le compte existe dans la base et on crée la session
    //Mise à jour des données de la session
        $info=$resultat->fetch_assoc();
        $_SESSION['login']=$id;
        $_SESSION['statut']=$info['PUR_STATUT'];
        $_SESSION['prenom']=$info['PUR_PRENOM'];
        $_SESSION['nom']=$info['PUR_NOM'];
        $_SESSION['email']=$info['PUR_EMAIL'];
        $_SESSION['date_creation']=$info['PUR_DATE_DE_CREATION'];
        header("Location:admin_accueil.php"); // On redirige vers la page d'administration 

    }
    else{ // si aucune ligne retournée alors le compte n'existe pas ou n'est pas valide
    echo "<p style=\"color:red;\">pseudo/mot de passe incorrect(s) ou profil inconnu ou compte inactivé !</p>";
    echo "<br /><a href=\"./session.php\">Cliquez ici pour réafficher
    le formulaire</a>";
    }
    $mysqli->close(); //On ferme la connection à la base de données
}

}else{ // si on ne détecte pas les variable $_POST
    echo "pseudo/mot de passe non remplis";
}
?>