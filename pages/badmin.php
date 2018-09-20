<?php
	if(!isConnect())
	{
		header("Location: index.php?p=connexion&n=8");
		die();
	}
	hasPermission(10, true);

$die = false;
	if(isset($_GET['id'])){
		$id = htmlentities(addslashes($_GET['id']));
		$grade = new Grade($id);
		$grade->get();

		if(isset($_GET['r'])){
			$requete = htmlentities(addslashes($_GET['r']));
			$grade->_permissions = $requete;
			$grade->update();
			header("Location: index.php?p=badmin&id=".$id."&n=24");
			die();
		}else{
			echo '
			<center>
				<div class="row">
					<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="well" action="" method="get">
							<h3>'.$grade->getName().'</h3>';
							foreach(getAllPermissions() as $perm){
								echo '<button id="perm-button" value="'.$perm->getID().'" style="margin: 10px;" class="'.($grade->hasPermission($perm->getID()) ? 'btn btn-success' : 'btn btn-danger').'">'.$perm->getName().'</button>';
							}
							echo '</div>
							<br>
			   				<input name="p" type="hidden" value="badmin">
							<input name="id" type="hidden" value="'.$grade->getID().'">
			   				<input id="requete" name="r" type="hidden" disabled class="form-control" placeholder="Requête vide" value="'.$grade->getPermissions().'"><br>
			    			<a id="requeteLink" href="index.php?p=badmin&id='.$grade->getID().'&r='.$grade->getPermissions().'" ><input type="submit" class="btn btn-primary btn-lg btn-block" value="Sauvegarder"></input></a>
							</div>
						</div>
				</div>
			</center>';
		}
		$die = true;
	}

if(!$die){
	echo '
		<center>
			<div class="row">
				<div class="col-md-3"></div>
					<div class="col-md-6">
						<form class="well" action="" method="get">
						<h3>Modifier les permissions des groupes</h3>';
						foreach(getAllGrades() as $grade){
								echo '<a style="margin: 10px;" href="index.php?p=badmin&id='.$grade->getID().'" class="btn btn-primary">'.$grade->getName().'</a>';
						}
						echo '</form>	
					</div>
			</div>
		</center>';
	
}
?>
<script>
	function update(){
		
		var requete = "";

		for(var i=0 ; i<getElementsByRegexId('perm-button').length ; i++) {  
			var element = getElementsByRegexId('perm-button')[i];
			if(element.className=="btn btn-success")
			requete += "-" + element.value + "-";
		}		

		var element = document.getElementById("requete");
		if(element != null){
			element.value = requete;
		}
		element = document.getElementById("requeteLink");
		if(element != null){
			var split = element.href.split('&r=');
			element.href = split[0] + "&r="+ requete;
		}
	}

	  function getElementsByRegexId(regexpParam, tagParam) {  
	   tagParam = (tagParam === undefined) ? '*' : tagParam;  
	   var elementsTable = new Array();  
	   for(var i=0 ; i<document.getElementsByTagName(tagParam).length ; i++) {  
	    if(document.getElementsByTagName(tagParam)[i].id && document.getElementsByTagName(tagParam)[i].id.match(regexpParam)) {  
	     elementsTable.push(document.getElementsByTagName(tagParam)[i]);  
	    }  
	   }  
	   return elementsTable;  
	  }

	for(var i=0 ; i<getElementsByRegexId('perm-button').length ; i++) {  
		var element = getElementsByRegexId('perm-button')[i];
		element.onclick = function(){
			this.className = this.className == "btn btn-danger" ? "btn btn-success" : "btn btn-danger";
			update();
		}
    }  
    update();

</script>