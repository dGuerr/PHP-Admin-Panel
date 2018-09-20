<?php
    if(!isConnect())
    {
        header("Location: index.php?p=connexion&n=8");
        die();
    }
    hasPermission(9, true);

    $b = true;
    $list = array("Age", "Forum", "Prenom", "Nom", "Twitch", "GUID", "Commentaire");
    foreach($list as $name)
    {
        if(!isset($_GET[$name]))
        {
            $b = false;
            break;
        }
    }
    if($b){
        $age = htmlentities(addslashes($_GET['Age']));
        $guid = htmlentities(addslashes($_GET['GUID']));
        $prenom = htmlentities(addslashes($_GET['Prenom']));
        $nom = htmlentities(addslashes($_GET['Nom']));
        $twitch = htmlentities(addslashes($_GET['Twitch']));
        $forum = htmlentities(addslashes($_GET['Forum']));
        $date = date("Y-m-d H:i:s");
        $staff = htmlentities(addslashes(getIdentifiant()));
        $commentaire = htmlentities(addslashes($_GET['Commentaire']));

        $joueur = new Joueur(0);
        $joueur->addDefault($guid, $prenom, $nom);
        $exist = $joueur->exist();
        if($exist=="nom"){
            header("Location: index.php?p=addplayer&n=21");
            die();   
        }elseif($exist=="guid"){
            header("Location: index.php?p=addplayer&n=22");
            die();   
        }else{
            $joueur->_date = $date;
            $joueur->_twitch = $twitch;
            $joueur->_forum = $forum;
            $joueur->_moderateur = $staff;
            $joueur->_age = $age;
            $joueur->_commentaire = $commentaire;
            if($joueur->create()){
                header("Location: index.php?p=joueurs&n=19");
                die();   
            }else{
                header("Location: index.php?p=addplayer&n=20");
                die();   
            }
        }
    }
?>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-top:50px;">
  <ul class="nav navbar-nav">
    <li><a href="#Introduction">Introduction</a></li>
    <li><a href="#1">Etape 1</a></li>
    <li><a href="#2">Etape 2</a></li>
    <li><a href="#3">Etape 3</a></li>
    <li><a href="#4">Etape 4</a></li>
    <li><a href="#5">Etape 5</a></li>
</nav>

<form id="Introduction" action="index.php" method="get"> 
    <center>
    <input name="p" type=hidden value="addplayer" required>

   <div class="row" style="margin: -10% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 300px 0px;">
            <div class="well">
                <h3>Integration d'un nouveau membre dans la communauté</h3>
                <p class="text-center">
                    La prise en charge d’un nouvel arrivant, son orientation et son intégration à notre communauté se déroule en quatre étapes essentielles mais primordiales.
                </p>
                <a href="#1"class="btn btn-primary">Suivant</a>
            </div> 
        </div>
    </div>


    <div id="1" class="row" style="margin: 100% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 105px 0px;">
            <div class="well" >
                <h3>Première Etape</h3>
                <p class="text-justify">
                C'est la prise de contact. Le joueur en face de vous ne vous connait pas et ne connait probablement pas Failywood.<br /> <br /> Commencez donc par les r&égles de politesse de base. Un &laquo; bonjour &raquo; ou un &laquo; salut &raquo; ne mange pas de pain. <br /> N'oubliez également pas de le remercier d'avoir attendu X temps pour son entretien. <br /> Ou si il a attendu plus d'une heure, de vous excuser pour ce temps d'attente. Commencez à l'amener doucement vers l'entretien pur et dur. <br /> Demandez-lui comment c'est passé la lecture de la charte, si il a bien tous compris et si il a des questions de quel qu'ordre que ce soit. <br /> <span style="font-style: italic;">(Certains joueurs demandent à ce moment-là ce que la gallinette vient faire la dedans).</span><br style="font-style: italic;" /> <br /> Si ce n'est pas le cas, introduisez la phrase <span style="font-weight: bold; color: #990000;">La Gallinette cendrée est dans le </span><span class="c2" style="font-weight: bold; color: #990000;">Bouchonnois</span><span style="font-weight: bold; color: #990000;">.</span> Des phrases bateau mais efficace telles que :
                <ul>
                <li>Une phrase &lsquo;est cachée dans la charte. L'as-tu trouvée ?</li>
                <li>Rien ne t'a surpris dans la charte ?</li>
                <li>As-tu remarqué qu'il y a une r&égle qui n'a rien à faire la ?</li>
                </ul>
                </p>
                <p class="text-justify">
                S'il trouve la réponse, passez à l'étape 2. <span style="font-weight: bold; color: #990000;">Si non</span>, demandez-lui poliment et sympathiquement de <span style="font-weight: bold; color: #990000;">relire un peu plus attentivement</span> la charte en lui expliquant que même si c'est embêtant et prend plusieurs minutes, <br /> cela lui évitera des probl&émes plus tard. <span style="font-weight: bold; color: #990000;">Réitérez cette opération jusqu'a qu'il trouve la réponse. </span>
                </p>
                <a href="#2"class="btn btn-primary">Etape 2</a>
            </div>
        </div>
    </div>


    <div id="2" class="row" style="margin: 100% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 110px 0px;">
            <div class="well">
                <h3>Deuxième Etape</h3>
                <p class="text-justify">
               

                <p class="text-justify">C'est son introduction sur le serveur. La naissance de son personnage.</p>
                <p class="text-justify">Demandez-lui tous d'abord <span style="font-weight: bold; color: #990000;">son âge</span>.
                 Cela permettra à ce de moins de 18 ans n'ayant pas fait de présentation, d'être redirigé vers la partie : <span style="font-style: italic;">Présentation et intégration</span>.<br /> Expliquez lui que cela n'est évidemment pas une punition, mais que Failywood étant un serveur poussé, les moins de 18 ans sont admis par vote de la communauté. <br /> Si le premier contact se passe bien, vous pouvez lui proposer de lire ou de corriger sa présentation avant qu'il ne la poste.</p>
                <div class="form-group">
                    <label>Age</label>
                    <input name="Age" type="text" class="form-control" placeholder="Age" required>
                 </div>
                <p class="text-justify">Demandez-lui également son <span style="font-weight: bold; color: #990000;">nom forum</span> afin de savoir et de signaler si il a un nom différent</p>
                <div class="form-group">
                    <label for="inputForum">Forum</label>
                    <input name="Forum" type="text" class="form-control" placeholder="Forum" required>
                 </div>
                <p class="text-justify">Ensuite, une fois validé dans le cas d'un mineur ou s'il est majeur, demandez-lui <span style="font-weight: bold; color: #990000;">ses noms et prénoms RP</span>. N'hésitez pas à demander un <span style="font-weight: bold; color: #990000;">mini résumé de son background</span> pour ceux qui n'ont pas de présentation à faire. Cela vous permettra de faire des rappels ou de guider le joueur dans ses choix possible sur Failywood.</p>
                <div class="form-group">
                    <label>Prenom</label>
                    <input name="Prenom" type="text" class="form-control" placeholder="Prenom" required>
                 </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input name="Nom" type="text" class="form-control" placeholder="Nom" required>
                 </div>

                <p class="text-justify">Si celui-ci se décrit comme étant un ancien membre des Deltas forces, n'hésitez pas à lui rappeler que<span style="font-weight: bold; color: #990000;"> les super soldats n'existent pas</span> et que <span style="font-weight: bold; color: #990000;">sa vie doit être la chose la plus importante</span>. La peur face à la mort doit le pousser à coopérer. A lui de gérer en RP cette coopération.<span style="font-weight: bold; color: #990000;"> Appuyez bien sur le fait que toute personne préférant mourir que coopérer peut-être sanctionner.</span></p>
                <p class="text-justify">Une fois que tout à bien était éclairci, passez à l'étape 3</p>
                </p>
                <a href="#3"class="btn btn-primary">Etape 3</a>
            </div>
        </div>
    </div>
    <div id="3" class="row" style="margin: 100% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 220px 0px;">
            <div class="well">
                <h3>Troisième Etape</h3>
                <p class="text-justify">
                    <p class="text-justify">Cette étape est
                    trés rapide et facile. Mais c'est aussi
                    l'une des plus importantes.  </p>
                    <p class="text-justify">Demandez-lui <span
                     style="font-weight: bold; color: rgb(153, 0, 0);">s'il
                    stream</span>, s'il a une chaine YouTube ou un
                    compte Twitch.  </p>
                    <ul>
                      <li>  </span></span></span>Si
                    oui : Demandez lui de se signaler
                    ici et de vous le donner: <a
                     href="http://forum.failywood.com/index.php?threads/white-liste-stream.1638/">http://forum.failywood.com/index.php?threads/white-liste-stream.1638/</a>  <span
                     style=""></span></span></li>
                      <li>  </span></span></span>Si
                    non : Informez-le que s'il décide de le
                    faire il devra s'inscrire  </li>
                    </ul>
                    <div class="form-group">
                        <label>Twitch/Youtube</label>
                        <input name="Twitch" type="text" class="form-control" placeholder="Twitch/Youtube" required>
                    </div>
                    <p class="text-justify">C'est ici
                    également que vous pouvez demander <span
                     style="color: rgb(153, 0, 0); font-weight: bold;">comment il
                    a
                    découvert Faily.</span>  </p>
                    <p class="text-justify">Vous pouvez maintenant passez
                    à l'étape 4  </p>
                <a href="#4"class="btn btn-primary">Etape 4</a>
            </div>
        </div>
    </div>
    
<div id="4" class="row" style="margin: 100% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 175px 0px;">
            <div class="well">
                <h3>Quatrième Etape</h3>
                <p class="text-justify">
                    <p class="text-justify">La partie technique.  </p>
                    <p class="text-justify">Donnez lui ce lien et Expliquez-lui comment configurer son
                    PC :  </p>

                    <ul>

                      <li><p class="text-justify">Teamspeak<p></li>
                      <li><p class="text-justify">TaskForce  <p></li>
                      <li><p class="text-justify">Arma</p></li>
                      <li><p class="text-justify">Failywood</p></li>
                      <li><p class="text-justify">...</p></li>
                    </ul>
                    <p class="text-justify"><a target="_blank" href="https://docs.google.com/presentation/d/1oEaKzxUXJdSHzYN5weDpeWYoNdNq1rPhqtXlbgGlfx4/">https://docs.google.com/presentation/d/1oEaKzxUXJdSHzYN5weDpeWYoNdNq1rPhqtXlbgGlfx4/</a></p>
                    <p class="text-justify">Essayez d'être le
                    plus clair possible et rappelez-lui que
                    vous êtes là en cas de besoin.   <br>
                    Le bureau renseignements est là pour ça.
                    C'est ici que vous rappelez
                    qu'il est <span
                     style="font-weight: bold; color: rgb(153, 0, 0);">STRICTEMENT
                    INTERDIT DE POKE UN ADMIN</span> (Elise, Folken, Dimitri et
                    Razvan)  </p>


                <a href="#5"class="btn btn-primary">Etape 5</a>
            </div>
        </div>
    </div>
<div id="5" class="row" style="margin: 100% 0px 0% 0px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin: 120px 0px;">
            <div class="well">
                <h3>Cinquième Etape</h3>
                <p class="text-justify">
                Expliquez le principe du WL.<br> Demandez-lui son <span style="font-weight: bold; color: rgb(153, 0, 0);">ID Arma</span> <a target="_blank" href="http://codepen.io/micovery/full/bNbLqL">[LIEN POUR CONVERTIR EN GUID]</a>

                <div class="form-group">
                    <label>GUID</label>
                    <input name="GUID" type="text" class="form-control" placeholder="GUID" required>
                </div>
                <p class="text-justify">N'oubliez pas de le notter à la suite dans la WL des devs: <a href="https://docs.google.com/document/d/1Kba1RuVvEognTDRtKQ34Ic4-8-5rVduj4J-9Z_b59Wk" target ="_blank">[LIEN WL DEV]</a></p>
                Rappelez lui également que sa demande a était prise en compte mais qu’il ne pourra pas aller IG avant <span style="font-weight: bold; color: rgb(153, 0, 0);">le prochain reboot</span> au mieux.<br>

                Si à 20h il n’a pas était WL par les devs, contentez-vous de lui demander d’attendre le reboot de minuit (<span style="font-weight: bold; color: rgb(153, 0, 0);">faite une demande de MaJ WL sur HipChat avec le tag @all</span>). Si à minuit il ne peut toujours pas, il serra WL le lendemain. <br>

                Pour finir, n'oubliez pas de <span style="font-weight: bold; color: rgb(153, 0, 0);">le WL sur TS</span>.<br><br>

                <div class="form-group">
                    <label>Commentaire sur le joueur</label>
                    <input name="Commentaire" type="text" class="form-control" placeholder="Commentaire" required>
                </div>

                <br>

                Voila, beau travail ;)</p><br>



                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Valider le joueur"></input>
            </div>
        </div>
    </div>
</form>
</body>
