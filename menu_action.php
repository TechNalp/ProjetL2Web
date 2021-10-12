<?php //Ce fichier sert à gérer les redirections depuis le menu de l'espace administration

session_start(); //On verifie si une session existe, si ce n'est pas le cas une nouvelle sera ouverte (et donc avec $_SESSION de vide)
    if(!isset($_SESSION['login'])){ //si $_SESSION est vide, c'est qu'une nouvelle session vient d'être crée avec session_start() et donc que l'utilisateur n'est pas connecté
        header("Location:session.php"); // On redirige vers la page de connexion
        exit(); //Si header ne fonctionne pas, un exit() sera executé ce qui stoppera l'éxécution de cette page
    }

	if(isset($_POST["acceuil"])){ //Si on détecte que $_POST["acceuil"] contient une valeur, c'est que c'est le formulaire associé qui a été activé
    	header("Location:admin_accueil.php"); // On redirige vers la page admin_accueil
    }else if(isset($_POST["selection"])){ //Si on détecte que $_POST["selection"] contient une valeur, c'est que c'est le formulaire associé qui a été activé
    	header("Location:admin_selection.php"); // On redirige vers la page admin_selection
    }else if(isset($_POST["news"])){ //Si on détecte que $_POST["news"] contient une valeur, c'est que c'est le formulaire associé qui a été activé
    	header("Location:admin_actualites.php"); // On redirige vers la page admin_actualites
    }else if(isset($_POST["deconnexion"])){ //Si on détecte que $_POST["deconnexion"] contient une valeur, c'est que c'est le formulaire associé qui a été activé
		session_destroy(); //Si la déconnexion est demandé, on détruit la session courante et on renitialise la variable superglobal $_SESSION
    	unset($_SESSION['login']);
    	unset($_SESSION['statut']);
    	unset($_SESSION['prenom']);
    	unset($_SESSION['nom']);
    	unset($_SESSION['email']);
    	unset($_SESSION['date_creation']);
    	header("Location:session.php"); // On redirige ensuite vers la page de connexion
    }
?>
