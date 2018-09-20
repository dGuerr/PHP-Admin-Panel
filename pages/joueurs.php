<?php

if(!isConnect())
{
    header("Location: index.php?p=connexion&n=8");
    die();
}
hasPermission(4, true);

$die = false;

function remplace($txt, $recherche)
{
    if($recherche == "")
        return $txt;
    $replace = "<span class=surligne>".$recherche."</span>";
    $result ="";
    $result = str_replace($recherche, $replace, $txt);
    return $result;
}

    if(isset($_GET['a']) && isset($_GET['id']))
    {
        $id = htmlentities(addslashes($_GET['id']));
        if($_GET['a'] == "supression")
        {
            hasPermission(7, true);
            if(canConnectSQL())
            {
                if($con = connectSQL())
                {
                    $retour = mysqli_query($con, "DELETE FROM ".getNomBaseSQL().".joueurs WHERE id='".$id."'");
                    closeSQL($con);
                }
                header("Location: index.php?p=joueurs&n=11");
                die();
            }
        }
        else if($_GET['a'] == "modifier")
        {
            hasPermission(6, true);
            if(canConnectSQL())
            {
                if($user = new Joueur($id)){
                    $user->get();
                    $GUID=$user->_guid;
                    $prenom = $user->_prenomRP;
                    $nom = $user->_nomRP;
                    $twitch= $user->_twitch;
                    $forum = $user->_forum;
                    $moderateur = $user->_moderateur;
                    $ancien_noms = $user->_ancien_noms;
                    $date = $user->_date;
                    $groupe = $user->_groupe;
                    $grade = $user->_gradeFaily;
                    $slot = $user->_slot;
                    $absent= $user->_absent;
                    $avertissement= $user->_avertissement;
                    $ban = $user->_ban;
                    $age = $user->_age;
                }

                if($prenom==""){
                    header("Location: index.php?p=joueurs&n=17");
                    die();
                }else{
                    echo "
                        <center>
                        <div class=\"row\">
                        <div class=\"col-md-3\"></div>
                        <div class=\"col-md-6\">
                        <form class=\"well\" action=\"index.php\" method=\"get\">
                        <input name=\"p\" type=hidden value=\"joueurs\">
                        <input name=\"a\" type=hidden value=\"update\">
                        <input name=\"id\" type=hidden value=\"".$id."\">
                        <h3>Profil de ".$prenom." ".$nom."</h3>
                        <h5>GUID: ".$GUID."</h5>
                        <p>Joueur intégré le $date par $moderateur</p><br>
 
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Prénom</label>
                        <input name=\"Prenom\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Prénom\"  value=\"".$prenom."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Nom</label>
                        <input name=\"Nom\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Nom\"  value=\"".$nom."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Age</label>
                        <input name=\"Age\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Age\"  value=\"".$age."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Forum</label>
                        <input name=\"Forum\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Forum\"  value=\"".$forum."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Twitch</label>
                        <input name=\"Twitch\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Twitch\"  value=".$twitch.">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Anciens noms</label>
                        <input name=\"Anciens_noms\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Anciens noms\"  value=\"".$ancien_noms."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Groupe</label>
                        <input name=\"Groupe\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Groupe\"  value=\"".$groupe."\">
                        </div>
                       <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Grade</label>
                        <input name=\"Grade\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Grade\"  value=\"".$grade."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Slot</label>
                        <input name=\"Slot\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Slot\"  value=\"".$slot."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Absent</label>
                        <input name=\"Absent\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Absent\"  value=\"".$absent."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Avertissement</label>
                        <input name=\"Avertissement\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Avertissement\"  value=\"".$avertissement."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Ban</label>
                        <input name=\"Ban\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Ban\"  value=\"".$ban."\">
                        </div><br>
                        <input type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" value=\"Sauvegarder\"></input>
                       
                        </form>
                        </div>
                        </div>
                        </center>
                    ";

                    $die=true;

                }
            }
        }
        else if($_GET['a'] == "update")
        {
            $b = true;
            hasPermission(6, true);

            $list = array("Prenom", "Nom","Twitch", "Forum", "Anciens_noms", "Groupe", "Grade", "Slot", "Absent", "Avertissement", "Ban", "Age");
            foreach($list as $name)
            {
                if(!isset($_GET[$name]))
                {
                    $b = false;
                    break;
                }
            }
            if($b)
            {
                $prenom = htmlentities(addslashes($_GET['Prenom']));
                $nom = htmlentities(addslashes($_GET['Nom']));
                $twitch = htmlentities(addslashes($_GET['Twitch']));
                $forum = htmlentities(addslashes($_GET['Forum']));
                $ancien_noms = htmlentities(addslashes($_GET['Anciens_noms']));
                $ban = htmlentities(addslashes($_GET['Ban']));
                $groupe = htmlentities(addslashes($_GET['Groupe']));
                $grade = htmlentities(addslashes($_GET['Grade']));
                $absent = htmlentities(addslashes($_GET['Absent']));
                $slot = htmlentities(addslashes($_GET['Slot']));
                $avertissement = htmlentities(addslashes($_GET['Avertissement']));
                $age = htmlentities(addslashes($_GET['Age']));

                if($user = new Joueur($id)){
                    $user->get();
                    $user->_prenomRP = $prenom;
                    $user->_nomRP = $nom;
                    $user->_twitch = $twitch;
                    $user->_forum = $forum;
                    $user->_ancien_noms = $ancien_noms;
                    $user->_ban = $ban;
                    $user->_groupe= $groupe;
                    $user->_gradeFaily = $grade;
                    $user->_absent = $absent;
                    $user->_slot = $slot;
                    $user->_avertissement = $avertissement;
                    $user->_age = $age;
                    $user->update();

                    header("Location: index.php?p=joueurs&n=10");
                    die();    
                }else{
                    header("Location: index.php?p=joueurs&n=1");
                    die();
                }
            }
        }
        else if($_GET['a'] == "addcommentaire" && isset($_GET['Commentaire'])){
            hasPermission(5, true);
            if(canConnectSQL()){
                $contents = htmlentities(addslashes($_GET['Commentaire']));
                $com = new Commentaire(0);
                $com->addDefault($id, getID(), $contents);
                $com->create();
                header("Location: index.php?p=joueurs&a=view&id=".$id."&n=23#commentaire");
                die();    
            }
        }
        else if($_GET['a'] == "view"){
            hasPermission(5, true);
            if(canConnectSQL())
            {
                if($user = new Joueur($id)){
                    $user->get();
                    $GUID=$user->_guid;
                    $prenom = $user->_prenomRP;
                    $nom = $user->_nomRP;
                    $twitch= $user->_twitch;
                    $forum = $user->_forum;
                    $moderateur = $user->_moderateur;
                    $ancien_noms = $user->_ancien_noms;
                    $date = $user->_date;
                    $groupe = $user->_groupe;
                    $grade = $user->_gradeFaily;
                    $slot = $user->_slot;
                    $absent= $user->_absent;
                    $commentaire = $user->_commentaire;
                    $avertissement= $user->_avertissement;
                    $ban = $user->_ban;
                    $age = $user->_age;
                }

                if($prenom==""){
                    header("Location: index.php?p=joueurs&n=17");
                    die();
                }else{
                    echo "
                        <center>
                        <div class=\"row\">
                        <div class=\"col-md-3\"></div>
                        <div class=\"col-md-6\">
                        <form class=\"well\" action=\"index.php\" method=\"get\">
                        <h3>Profil de ".$prenom." ".$nom."</h3>
                        <h5>GUID: ".$GUID."</h5>
                        <p>Joueur intégré le $date par $moderateur</p><br>";
                        if(hasPermission(6, false)){echo"<a href=\"index.php?p=joueurs&a=modifier&id=".$id."\"> [Modifier les Informations]</a>";}
                        echo" 
                        <blockquote class=blockquote-reverse>
                            <p>".$commentaire."</p>
                            <footer><strong>".$moderateur." </strong><cite>".$date."</cite></footer>
                        </blockquote>   

                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Prénom</label>
                        <input disabled name=\"Prenom\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Prénom\" required value=\"".$prenom."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Nom</label>
                        <input disabled name=\"Nom\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Nom\" required value=\"".$nom."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Age</label>
                        <input disabled name=\"Age\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Age\" required value=\"".$age."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Forum</label>
                        <input disabled name=\"Forum\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Forum\" required value=\"".$forum."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Twitch</label>
                        <input disabled name=\"Twitch\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Twitch\" required value=\"".$twitch."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Anciens noms</label>
                        <input disabled name=\"Anciens_noms\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Anciens noms\" required value=\"".$ancien_noms."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Groupe</label>
                        <input disabled name=\"Groupe\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Groupe\" required value=\"".$groupe."\">
                        </div>
                       <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Grade</label>
                        <input disabled name=\"Grade\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Grade\" required value=\"".$grade."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Slot</label>
                        <input disabled name=\"Slot\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Slot\" required value=\"".$slot."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Absent</label>
                        <input disabled name=\"Absent\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Absent\" required value=\"".$absent."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Avertissement</label>
                        <input disabled name=\"Avertissement\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Avertissement\" required value=\"".$avertissement."\">
                        </div>
                        <div class=\"form-group\">
                        <label for=\"inputIdentifiant\">Ban</label>
                        <input disabled name=\"Ban\" type=\"text\" class=\"form-control\" id=\"inputIdentifiant\" placeholder=\"Ban\" required value=\"".$ban."\">
                        </div>
                        </form>
                        </div>
                        </div>
                        </center>

    
                        <center>
                        <div id=\"commentaire\" class=\"row\">
                        <div class=\"col-md-3\"></div>
                        <div class=\"col-md-6\">
                        <form class=\"well\" action=\"index.php\" method=\"get\">
                         <input name=\"p\" type=hidden value=\"joueurs\">
                         <input name=\"a\" type=hidden value=\"addcommentaire\">
                         <input name=\"id\" type=hidden value=\"".$id."\">
                         <textarea name=\"Commentaire\" class=\"form-control\" rows=\"3\" placeholder=\"Commentaire\" required></textarea>
                         <br>
                         <input type=\"submit\" class=\"btn btn-primary\" value=\"Ajouter un commentaire\"></input>
                        </form>
                        </div>
                        </div>
                        <h4>Listes des commentaires</h4>

                        </center>
                    
                    ";

                    foreach(getAllCommentaire($id) as $com){
                        $user = new User($com->getOwnerID());
                        $user->get();
                    echo "
                        <center>
                        <div class=\"row\">
                        <div class=\"col-md-3\"></div>
                        <div class=\"col-md-6\">
                            <blockquote class=blockquote-reverse>
                            <p>".$com->getContents()."</p>
                            <footer><strong>".$user->_identifiant."</strong> <cite>".$com->getDate()."</cite></footer>
                            </blockquote>   
                        </div>
                        </div>
                        </center>";
                    }
                    $die=true;

                }
            }
        }
    }

if(!$die){


    ?>

    <center>
    	<div class="row">
    		<div class="col-md-3"></div>
    		<div class="col-md-6">
    			<form class="well" action="" method="get">
    			<h3>Recherche</h3>
    			<p class="help-block">Entrez un mot clé pour votre recherche. Attention, la recherche prend en compte la Case du mot.</a></p>
    			<input name="p" type=hidden value="joueurs">
    			<input type="text" class="form-control" placeholder="mot/nom/pseudo/groupe/pseudo forum/pseudo twitch/pseudo Steam/age..." required name="r">
    			<br>
    			<input type="submit" class="btn btn-primary btn-lg btn-block" value="Rechercher"></input>
    			</form>
    		</div>
    	</div>
    </center>

    <?php
    $alphabet = array ("@","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $lettre = "@";
    echo '<div class ="pagination">
    <ul>';
    if(isset($_GET['l']))
    {
        $l = $_GET['l'];
        foreach($alphabet as $val)
        {
            $active = "";
            if($val==$l)
            {
                $active = " class=\"active\"";
                $lettre = $val;
            }
            echo '<li'.$active.'><a href=index.php?p=joueurs&l='.$val.'><span>'.$val.'</span></a></li>';
        }
    }
    else
    {
        foreach($alphabet as $val)
        {
            $active = "";
            if($val==$lettre)
                $active = " class=\"active\"";
            echo '<li'.$active.'><a href=index.php?p=joueurs&l='.$val.'>'.$val.'</a></li>';
        }
    }
    echo "
    </ul></div></center>";
    $query = "(SELECT * FROM ".getNomBaseSQL().".joueurs WHERE prenomRP LIKE '$lettre%') ORDER BY id DESC";
    if($lettre == "@")
        $query = "(SELECT * FROM ".getNomBaseSQL().".joueurs) ORDER BY id DESC";
    $recherche = "";
    if(isset($_GET['r']))
    {
        $recherche =  htmlentities(addslashes($_GET['r']));
        $query = "(SELECT * FROM ".getNomBaseSQL().".joueurs
                 WHERE
                 prenomRP LIKE '%$recherche%' OR
                 nomRP LIKE '%$recherche%' OR
                 guid LIKE '%$recherche%' OR
                 twitch LIKE '%$recherche%' OR
                 forum LIKE '%$recherche%' OR
                 ancien_noms LIKE '%$recherche%' OR
                 groupe LIKE '%$recherche%' OR
                 gradeFaily LIKE '%$recherche%' OR
                 age LIKE '%$recherche%' OR
                 date LIKE '%$recherche%' OR
                 slot LIKE '%$recherche%' OR
                 forum LIKE '%$recherche%')
                 ORDER BY id DESC";
    }
    $find = false;
    foreach (getAllJoueursWithQuery($query) as $user) {
        if(!$find){

            echo "
            <div class=\"span\">
            <center><h4>Resultats de la recherche</h4></center>
            <div>
            <table class=\"table table-striped\" id=\"sortTable\">
            <thead><tr>".((hasPermission(6, false) || hasPermission(7, false)) ? "<th>Admin</th>" : "")."<th>ID<img height=15px src=../images/sort-50.png></th><th>Nom<img height=15px src=../images/sort-50.png></th><th>GUID<img height=15px src=../images/sort-50.png></th><th>Forum<img height=15px src=../images/sort-50.png></th><th>Twitch<img height=15px src=../images/sort-50.png></th><th>Groupe<img height=15px src=../images/sort-50.png></th><th>Age</th><th>Date</th><th>Averts<img height=15px src=../images/sort-50.png></th><th>Ban<img height=15px src=../images/sort-50.png></th></tr></thead>
            <tbody>
            ";
        }
        $find = true;
        $id = remplace($user->getID(), $recherche);
        $prenomRP = remplace($user->_prenomRP, $recherche);
        $nomRP = remplace($user->_nomRP, $recherche);
        $guid = remplace($user->_guid, $recherche);
        $twitch = remplace($user->_twitch, $recherche);
        $forum = remplace($user->_forum, $recherche);
        $ancien_noms = remplace($user->_ancien_noms, $recherche);
        $groupe = remplace($user->_groupe, $recherche);
        $gradeFaily = remplace($user->_gradeFaily, $recherche);
        $age = remplace($user->_age, $recherche);
        $date = remplace($user->_date, $recherche);
        $avertissements = remplace($user->_avertissement, $recherche);
        $ban = remplace($user->_ban, $recherche);
        echo "
        <tr>";
        if(hasPermission(6, false))
        {
            echo"<td><a href=\"index.php?p=joueurs&a=modifier&id=".$id."\"><img class=option src=../images/Icon/Document-50.png></img></a>";
        }
        if(hasPermission(7, false))
        {
            echo"<a onclick=\"return confirm('Voulez vous supprimer ce joueur ?');\" href=\"index.php?p=joueurs&a=supression&id=".$id."\"><img class=option src=../images/Icon/Cancel-50.png></img></a></td>";
        }

        echo'</td>
        <td>'.$id.'</td>',
        '   <td><a href="index.php?p=joueurs&a=view&id='.$id.'">'.$prenomRP.' '.$nomRP.'</a></td>','    <td>'.$guid.'</td>','   <td>'.$forum.'</td>','   <td>'.$twitch.'</td>',' <td>'.$groupe,' </td>','    <td>'.$age,' </td>','   <td>'.$date,' </td>',' </td>','  <td>'.$avertissements,' </td>','    <td>'.$ban,' </td>
        </tr>'
        ;
    }

    if($find){
        echo "</tbody></table></center></div></div>";
    }else{
        echo '
        <div class="notification" id="warning">
        <h4>Aucun résultat</h4>
        <p>Il n\'y a aucun résultat correspondant à votre recherche</p>
        </div>
        ';
    }
    echo "</div>";
 }
?>

