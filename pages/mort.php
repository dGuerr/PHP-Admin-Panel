<?php
	function remplace($txt, $recherche){
		if($recherche == "")
			return $txt;
		$replace = "<span class=surligne>".$recherche."</span>";
		$result ="";
		$result = str_replace($recherche, $replace, $txt);
		return $result;
	}

	if(!isConnect())
	{
		header("Location: index.php?p=connexion&n=8");
		die();
	}
	hasPermission(8, true);
	$page = 0;
	if(isset($_GET['page'])){
		if(is_numeric($_GET['page']))
			$page = htmlentities(addslashes($_GET['page'])) -1;
	}

	$count = getCountMorts();
	$maxpage = ceil($count/50);

	if($page > $maxpage){
		$page = $maxpage-1;
	}else if($page < 0){
		$page = 0;
	}

	$query = "(SELECT * FROM ".getNomBaseSQL().".kill_log ORDER BY id DESC) LIMIT ".($page*50).",50";
	$recherche = "";
?>

<center>
	<div class="row">
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<form class="well" action="" method="get">
					<h3>Recherche</h3>
				<p class="help-block">Entrez un mot clé pour votre recherche. Attention, la recherche prend en compte la Case du mot.</a></p>
				<input name="p" type=hidden value="mort">
				<input type="text" class="form-control" placeholder="Victime/Tueur/GUID/Raison/Date" required name="r">
				<br>
				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Rechercher"></input>
				</form>	
			</div>
	</div>
</center>
<?php
		if(isset($_GET['r'])){
			$recherche =  htmlentities(addslashes($_GET['r']));
			$query = "(SELECT * FROM ".getNomBaseSQL().".kill_log
			WHERE 
			victime_name LIKE '%$recherche%' OR
			victime_uid LIKE '%$recherche%' OR
			killer_name LIKE '%$recherche%' OR
			killer_uid LIKE '%$recherche%' OR
			death_by LIKE '%$recherche%' OR
			kill_time LIKE '%$recherche%'
			ORDER BY id)
			LIMIT ".($page*50).",100";
		}

		echo "<div class=\"span\">
		<center><h4>Log des morts</h4></center>";
		echo paginate("index.php?p=mort", "&page=", $maxpage, $page+1);
		echo"
		<div>
		<table class=\"table table-striped\" id=\"\">
		<thead><tr><th>ID</th><th>Victime</th><th>GUID</th><th>Tueur</th><th>GUID</th><th>Raison</th><th>Date</th></tr></thead>
		<tbody>";

		foreach(getAllMortsWithQuery($query) as $mort){
			$id = $mort->getID();
			$victimeName = $mort->getVictimeName();
			$victimeUID = $mort->getVictimeUID();
			$killerName =$mort->getKillerName();
			$killerUID = $mort->getKillerUID();
			$reason = $mort->getReason();
			$date = $mort->getDate();
			echo"<tr><td>".$id."</td><td>".$victimeName."</td><td>".$victimeUID."</td><td>".$killerName."</td><td>".$killerUID."</td><td>".$reason."</td><td>".$date."</td></tr>";
		}												
		echo "</tbody></table></div></div>";


		echo paginate("index.php?p=mort", "&page=", $maxpage, $page+1);
?>

