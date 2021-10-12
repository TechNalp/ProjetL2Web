<?php //Cette page permet aux profils activés de voir toutes les séléctions ainsi que leurs éléments respectifs, ils ont également la possibilité de supprimer un élément de sa séléction
session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)

    if(!isset($_SESSION['login'])) // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start()
    {
     //Si la session n'est pas ouverte, redirection vers la page du formulaire de connexion
        header("Location:session.php");
        exit(); //arret du chargement de la page (éxécuté uniquement si le header n'a pas fonctionné)
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
        } ?>

    <html>
            <head>
            <!--entête du fichier HTML-->
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
                        <div>
                        <a class="box-primary-nav-trigger" href="#0">
                            <span class="box-menu-text">Menu</span><span class="box-menu-icon"></span>
                        </a>
                    </div>
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
                    <h1>ESPACE ADMINISTRATION</h1>
                    <p>Acceuil / Espace administration</p>
                </div>
                <!-- end Top bar -->
                <div>
                <?php
                $requete_liste_selection="SELECT * FROM T_SELECTION_SEL;"; // requête listant toutes les séléctions
                $resultat_liste_selection = $mysqli->query($requete_liste_selection); // exécution de la requête ?>
                    <ul class="selection_action_menu">
                        <li style="font-weight: bold; text-decoration: underline; color: black;">Suppression d'un élément:</li>
                        <li>
                            <form action="admin_selection.php" method="get"> <!-- Ce formulaire permet de choisir une séléction en envoyant via la méthode GET la sélécion choisi-->
                                <p style="color: black;">Choisissez la séléction:</p>
                                <select style="color:black; margin-bottom: 10px; width: 70%;" name="selection" value="test">
                                    <?php while($sel=$resultat_liste_selection->fetch_assoc()){ //Pour chaque ligne retourné par la requête on crée un tableau associatif contenant les information de la ligne courante et on affiche dans un choix unique la titre de chaque séléction
                                        ?><option style="color:black;" value=<?php echo "\"".$sel['SEL_NUMERO']."\""?>> <?php echo $sel['SEL_INTITULE'];?></option>;
                                       <?php }
                                    ?>
                                </select>
                                <input style="color: black;" type="submit" value="Choisir cette séléction">
                            </form>
                        </li>
                        <li><?php if(isset($_GET['selection']) and is_numeric($_GET['selection'])){ // On affiche le formulaire du choix de l'élément uniquement si un GET est présent dans l'URL et si la valeur contenu et un chiffre.
                            $requete_liste_elt = "SELECT * FROM T_ELEMENT_ELT JOIN TJ_RASSEMBLE_RAS USING (ELT_NUMERO) WHERE SEL_NUMERO = ".$_GET['selection'].";"; // requête récupérant la liste des éléments d'une séléction particulière
                            $resultat_liste_elt = $mysqli->query($requete_liste_elt); // exécution de la requête

                            $requete_info_selection_courante = "SELECT SEL_INTITULE FROM T_SELECTION_SEL WHERE SEL_NUMERO=".$_GET['selection'].";"; // Requête récupérant les informations d'une séléction précise
                            $resultat_info_selection_courante = $mysqli->query($requete_info_selection_courante); // exécution de la requête
                            $info_selection_courante = $resultat_info_selection_courante->fetch_assoc(); // Création d'un tableau associatif contenant les informations provenat de la séléction courante?> 

                                <form action="remove_from_sel_action.php" method="post"> <!-- Ce formualaire permet de choisir l'élément que l'on veut détruire et l'envoie via la méthode GET (il ne propose que les éléments de la séléction choisi dans le formulaire précédent)-->
                                <p style="color: black;">Choisissez l'élément:</p>
                                <select style="color:black; margin-bottom: 10px; width: 70%;" name="element">
                                    <?php while($elt=$resultat_liste_elt->fetch_assoc()){ //Pour chaque ligne retourné par la requête on crée un tableau associatif contenant les information de la ligne courante et on affiche dans un choix unique la titre de chaque élément
                                        ?><option style=<?php if($elt['ELT_ETAT']=='P'){ echo "\"color:limegreen;\"";}else{echo "\"color:red;\"";} ?> value=<?php echo "\"".$elt['ELT_NUMERO']."\""?>> <?php echo $elt['ELT_INTITULE'];?></option>;
                                       <?php } 
                                    ?>
                                </select>
                                <input style="color:black;" type="submit" value=<?php echo "\"Supprimer l'élément de: ".$info_selection_courante['SEL_INTITULE']."\"";?>>
                            </form> 
                        </li>
                        <?php } ?>
                    </ul> 
                <div style="margin-top: -100px;">

                <div style="position: sticky;top:20px;text-align: center;margin-left: 35%;width: fit-content;">
                    <?php if($_SESSION['statut']=='A'){ ?>
                    <form action="menu_action.php" method="post">
                        <div style="z-index: 3">
                        <input name="acceuil" value="Acceuil & profil(s)" type=submit style="color: black; font-weight: 500;">
                        <input name="selection" value="Gestion des séléctions" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
                        <input name="news" value="Gestion des actualités" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
                        <input name="deconnexion" value="Déconnexion" type=submit style="margin-left: 15px; color:red;font-weight: bold;">
                    </div>
                    </form>
                <?php }else{ ?>
                    <form action="menu_action.php" method="post">
                        <input name="acceuil" value="Acceuil" type=submit style="color: black; font-weight: 500;">
                        <input name="selection" value="Gestion des séléctions" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
                        <input name="news" value="Gestion des actualités" type=submit style="margin-left: 15px; color: black;font-weight: 500;">
                        <input name="deconnexion" value="Déconnexion" type=submit style="margin-left: 15px; color:red;font-weight: bold;">
                    </form>
                <?php } ?>
                </div>

                <!-- Main container -->
            <div>
                <div style="text-align: end;width: 30%;margin: auto;">
                        <p style="font-size: 30px; color: coral;">Gestion des séléctions: </p>
                </div>
                
            
                <table border=0 style="text-align: center; margin-left: 30%;">
                    <tr>
                        <th style="text-align: center;"><p>Séléction</p></th>
                        <th style="text-align: center;"><p>Publicateur</p></th>
                        <th style="text-align: center;"><p>Liste des éléments</p></th>
                    </tr>
     
                    <?php $resultat_liste_selection = $mysqli->query($requete_liste_selection);

                    while ($sel= $resultat_liste_selection->fetch_assoc()) // Pour chaque séléction on affiche leurs info et on affiche leurs éléments réspéctifs
                    {
                        $requete_liste_elt = "SELECT * FROM T_ELEMENT_ELT JOIN TJ_RASSEMBLE_RAS USING (ELT_NUMERO) WHERE SEL_NUMERO = ".$sel['SEL_NUMERO'].";"; // requête récupérant la liste des éléments d'une séléction choisi
                        $resultat_liste_elt = $mysqli->query($requete_liste_elt); //exécution de la requête précédente ?>
                    <tr>
                        <td style="border-top: solid; border-bottom: solid;"> <?php echo $sel['SEL_INTITULE'];  // Affichage de l'intitulé de la séléction courante ?></td>
                        <td style="border-top: solid; border-bottom: solid;"> <?php echo $sel['CUR_PSEUDO']; // Affichage du pseudo ayant créer la séléction courante ?></td>
                        <td style="border-top: solid; border-bottom: solid;"> <?php if($resultat_liste_elt->num_rows<1){echo "Aucun élément dans cette séléction";}else{
                            while ($elt=$resultat_liste_elt->fetch_assoc()){  // On affiche les information de chaque élément retourné par $requete_liste_elt
                                echo "<a style=\"font-size: 10px; font-weight: bold;\" href=\"./affichageselection.php?sel_id=".$sel['SEL_NUMERO']."&elt_id=".$elt['ELT_NUMERO']."\"><p style=\"font-size: 10px; font-weight: bold;\">".$elt['ELT_INTITULE']."</a> (ETAT: "; 
                                if($elt['ELT_ETAT']=='P'){echo "<span style=\"color:limegreen;\">Publié</span>)";}else{ echo "<span style=\"color:red;\">Brouillon)</span></p>"; } // Si l'élément est Publié alors on affiche le texte "Publié" en rouge sinon on affiche "Brouillon" en rouge
                            }?></td>
                       <?php } ?>
                    </tr>
                    <?php }
                    $mysqli->close(); //Une fois toute les actions nécessitant la bdd efféctuées, nous nous déconnectons?>

                </table>

            </div>
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
          