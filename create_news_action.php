<?php // Cette page effectue l'action de création d'une actualité
session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)

    if(!isset($_SESSION['login'])) // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start()
    {
     //Si la session n'est pas ouverte, redirection vers la page du formulaire
        header("Location:session.php");
    exit();
    }

	if(isset($_POST['titre'])){ // On vérifie que le formulaire contient bien un input nommé 'titre'
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

        if(!empty($_POST['titre'])){ // On vérifie que le titre n'est pas vide (si il l'est on affiche une erreur)
        	$titre=htmlspecialchars(addslashes($_POST["titre"])); // On sécurise la valeur retournée par le formulaire
        	if(!empty($_POST['texte'])){ // On vérifie que le texte n'est pas vide (si il l'est on affiche une erreur)
        		$texte=htmlspecialchars(addslashes($_POST['texte'])); // On sécurise la valeur retournée par le formulaire
        	}else{
        		?><p style="color: red;">Vous n'avez pas mis de texte</p> 
        		<a href="admin_actualites.php"><p>Retourner à la gestion des actualités</p></a>
        		<?php exit();
        		}
        }else{
        	?><p style="color: red;">Vous n'avez pas indiqué de titre</p>
        	<a href="admin_actualites.php"><p>Retourner à la gestion des actualités</p></a> <?php
        	exit();
        }

        
        if(!empty($_POST['etat'])){ // On vérifie que le formulaire contient bien un input nommé etat, puis on test sa valeur pour savoir si la requête devra rendre l'actualité caché ou non
        	if($_POST['etat']=="hide"){
        		$etat='C';
        	}else{
        		$etat='L';
        	 // Pas besoin de htmlspecialchars et addslashes car provient de radio bouttons
        	}


		
		$requete_create_news="INSERT INTO T_ACTUALITE_NEW (NEW_NUMERO, NEW_TITRE, NEW_TEXTE, NEW_DATE_DE_PUBLICATION, NEW_ETAT, CUR_PSEUDO) VALUES (NULL,\"".$titre."\", \"".$texte."\", current_timestamp(),'".$etat."' ,\"".$_SESSION['login']."\");"; // requête pour créer l'actualité
		if($resultat_create_news=$mysqli->query($requete_create_news)==false){ // exécution de la requête et vérification de sa réussite
			echo "<p>Erreur: Problème lors de la création de l'actualité</p>\n";
            exit();
		}else{
			header("Location:admin_actualites.php");
		}
	}



	}else{
		echo "<p style=\"color: red;\">erreur lors de la création de l'actualité</p>";
	}


?>