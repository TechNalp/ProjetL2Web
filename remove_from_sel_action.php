<?php // Cette page permet d'effectué l'action de suppression d'un élément de sa séléction
	session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)

    if(!isset($_SESSION['login'])) // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start()
    {
     //Si la session n'est pas ouverte, redirection vers la page du formulaire
        header("Location:session.php");
    exit();
    }

	if(isset($_POST['element'])){ 
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

		$requete_remove_elt_from_sel="DELETE FROM TJ_RASSEMBLE_RAS WHERE ELT_NUMERO=".$_POST['element'].";"; // requête pour retirer l'élément de sa séléction 
		if($resultat_remove_elt_from_sel=$mysqli->query($requete_remove_elt_from_sel)==false){ // on exécute la requête et on vérifie si elle s'est bien déroulée, si il y a eu une erreur on affiche une erreur?>
            <p style="color:red; text-align:center;">Erreur lors de la supression de l'élément</p>;
            <a href="admin_selection.php"><p style="text-align: center;">Retourner à la gestion des séléctions</p></a>
            <?php
            exit();
		}else{ // si il n'y a pas d'erreur on redirige vers la page de gestion des séléction
			header("Location:admin_selection.php");
		}



	}else{ // si aucun input nommé 'element' n'est détécté
		echo "<p style=\"color: red;\">erreur lors de la supression de l'élement de la séléction</p>";
	}







?>