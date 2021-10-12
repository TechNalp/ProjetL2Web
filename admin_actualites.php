<?php //Cette page permet aux profils activés de voir toutes les actualitées et d'en créer
    session_start(); //Vérification de l'existance d'une session (si non, alors $_SESSION n'est pas définie et une nouvelle est créée)
    if(!isset($_SESSION['login'])) // On verrifie que $_SESSION['login'] existe, si non, alors la session courante vient d'être créée avec session_start()
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
        } ?>    
                <html style="scroll-behavior:smooth;">
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
                                <h1>ESPACE ADMINISTRATION</h1>
                                <p>Acceuil / Espace administration</p>
                            </div>
                            <!-- end Top bar -->
                            <div>
                                <div style="position: sticky;top:20px;text-align: center; margin:auto; width: fit-content;">
                                    <?php if($_SESSION['statut']=='A'){ //Si l'utilisateur est administrateur, on affiche un menu légerement différents ( Acceuil/Acceuil & profil(s) )?>
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
                            <div style="text-align: center; margin: auto;">
                                <p style="font-size: 30px; color: coral;">Gestion des actualités: </p>
                            </div>
                            <?php
                                    $requete_liste_actualites="SELECT * FROM T_ACTUALITE_NEW;"; // requête pour récupérer toutes les actualités
                                    $resultat_liste_actualites=$mysqli->query($requete_liste_actualites); // éxécution de la requête de récupération de toutes les actualités ?>
                                <!-- Cette table contient la liste des actualités-->
                                <table border=0 style="margin: auto; width:70%;">
                                    <legend style="text-align: center;">Liste des actualités</legend>
                                    <tr>
                                        <th style="text-align: center;"><p>Titre</p></th>
                                        <th style="text-align: center;"><p>Texte</p></th>
                                        <th style="text-align: center;"><p>Date de publication</p></th>
                                        <th style="text-align: center;"><p>Auteur</p></th>
                                        <th style="text-align: center; padding: 0px 30px 0 30px;"><p>Etat</p></th>
                                    </tr>
                            <?php
                                while($news=$resultat_liste_actualites->fetch_assoc()){ //Pour chaque ligne retourné par la requête on crée un tableau associatif contenant les information de la ligne courante?>
                                    <tr>
                                        <td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $news['NEW_TITRE']; //Affichage du titre de l'actualité contenu dans la ligne courante ?></p></td>
                                        <td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $news['NEW_TEXTE']; //Affichage du texte de l'actualité contenu dans la ligne courante ?></p></td>
                                        <td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $news['NEW_DATE_DE_PUBLICATION']; //Affichage du titre de l'actualité contenu dans la ligne courante ?></p></td>
                                        <td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php echo $news['CUR_PSEUDO']; //Affichage du pseudo du profil qui a créé l'actualité contenu dans la ligne courante?></p></td>
                                        <td style="text-align: center; border-top: solid; border-bottom: solid;"><p><?php if($news['NEW_ETAT']=='L'){ echo "<p style=\"color: limegreen;\">En ligne</p>";}else{ echo "<p style=\"color: red;\">Caché</p>";} // Si l'actualité est publié, on affiche le texte "En ligne" en vert, sinon on affiche "Caché" en rouge ?></p></td>
                                    </tr>
                                <?php } ?>
                                </table>
                                 <?php $mysqli->close(); //Une fois toute les actions nécessitant la bdd efféctuées, nous nous déconnectons?>
                                <!-- end Main container -->
                                </div>
                            </div>

                            <div style="position: sticky; bottom: -25%; background: linear-gradient(-45deg, rgb(35, 166, 213), rgb(35, 213, 171), rgb(35, 166, 213), rgb(35, 213, 171)) 0% 0% / 400% 400%; animation: 15s ease 0s infinite normal none running gradient;">
                                <a href="#create_news"><p style="font-size: 200%; text-align: center; color: white;">Créer une actualité</p></a>

                                    <form action="create_news_action.php" method="post">
                                        <legend style="border:0; text-align: center;">Informations de l'actualité : </legend>
                                        <fieldset style="width: 402px; margin: 0px auto; text-align: center;">
                                            <p style="color: #333; font-weight: bold;">Titre : <input type="text" name="titre" placeholder="Titre"/></p>
                                            <p style="color: #333; font-weight: bold;">Texte : <input type="text" name="texte" placeholder="Texte"/></p>
                                            <p style="color: #333;"><span style="font-weight: bold;">Etat de l'actualité : </span><br><input type="radio" name="etat" value="public" checked> Publié
                                            <input type="radio" name="etat" value="hide"> Caché</p>
                                            <p style="text-align:center;"><input type="submit" value="Valider" style="text-align:center;background: #ff7500;font-size: large;color: white;border-style: hidden;"></p>
                                        </fieldset>
                                    </form>
                            </div>
                            <a id="create_news" style="bottom: 0px;"></a>
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