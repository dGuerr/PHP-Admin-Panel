<?php
	if(isset($_GET['a']) && isset($_GET['id']))
	{
		$id = htmlentities(addslashes($_GET['id']));
		if($_GET['a'] == "supression")
		{

			if(canConnectSQL())
			{
				if($con = connectSQL())
				{
					$retour = mysqli_query($con, "DELETE FROM ".getNomBaseSQL().".utilisateurs WHERE id='".$id."'");
					closeSQL($con);
				}
				header("Location: index.php?p=membres&n=1");
				die();
			}
		}
		else if($_GET['a'] == "modifier")
		{
			if(canConnectSQL())
			{
				$con = connectSQL();
				if($con)
				{
					$rs = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".utilisateurs WHERE id='".$id."'");
					if($rs == TRUE)
					{
						$identifiant ="";
						while($row = mysqli_fetch_array($rs))
						{
							$identifiant = $row["identifiant"];
							$email = $row["email"];
							$rang = $row["rang"];
							$banni = $row["banni"];
							$telephone = $row["telephone"];
							$steam = $row["steam"];
						}

						if($identifiant=="")
						{
							header("Location: index.php?p=membres&n=2");
							die();
						}
						else
						{
							echo '<FORM action="" method="get">
							<p>
							<center>
							<input name="p" type=hidden value="membres"><br>
							<input name="a" type=hidden value="update"><br>
							<input name="id" type=hidden value="'.$id.'"><br>
							Identifiant: <input maxlength=20 name="Identifiant" style="width:152px; height: 25px;" placeholder="Identifiant" required="required" value='.$identifiant.'><br>
							Mail: <input name="Mail" style="width:152px; height: 25px;" placeholder="Mail" required="required" value='.$email.'><br>
							Rang: <SELECT name="rang" size="1" selected='.getRangNameByID($rang).'>';
							
							$grades = array (0,1,2,3,4,5,6,7,8);
							foreach($grades as $i){
								$selected = "";
								if($i == $rang){
									$selected = "selected ";
								}
								echo"<OPTION ".$selected."value=".$i.">".getRangNameByID($i);
							}
							echo '</SELECT><br><br>
							Banni: <SELECT name="banni" size="1" selected='.($banni ? "Oui" : "Non").'>';
							
							function getBanState($val){
								if($val == 0){
									return "Non";
								}else{
									return "Oui";
								}
							}
							
							$states = array (0,1);
							foreach($states as $i){
								$selected = "";
								if($i == $banni){
									$selected = "selected ";
								}
								echo"<OPTION ".$selected."value=".$i.">".getBanState($i);
							}
							
							echo '</SELECT>
							
							<br><br>
								Telephone: <input name="telephone" style="width:152px; height: 25px;" placeholder="telephone" required="required" value='.$telephone.'><br>
							Steam: <input name="Steam" style="width:152px; height: 25px;" placeholder="steam" required="required" value='.$steam.'><br>
							
							<a class="bouton" onclick="submitform();">Sauvegarder</a>

							<script>
							function submitform() {
							var f = document.getElementsByTagName(\'form\')[0];
							if(f.checkValidity()) {
							f.submit();
						} else {

						}
						}
							</script>
							</center>
							</p>
							</FORM>
							';

						}
					}
				}
			}
		}else if($_GET['a'] == "update"){
			if(isset($_GET['Identifiant']) && isset($_GET['Mail']) && isset($_GET['rang']) && isset($_GET['banni']) && isset($_GET['telephone']) && isset($_GET['Steam'])){
					$identifiant = htmlentities(addslashes($_GET['Identifiant']));
					$mail = htmlentities(addslashes($_GET['Mail']));
					$rang = htmlentities(addslashes($_GET['rang']));
					$banni = htmlentities(addslashes($_GET['banni']));
					$telephone = htmlentities(addslashes($_GET['telephone']));
					$steam = htmlentities(addslashes($_GET['Steam']));
					
			if(canConnectSQL()){
				$con = connectSQL();
				if($con){
					$rs = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET identifiant = '".$identifiant."', email = '".$mail."', rang = '".$rang."', telephone = '".$telephone."', steam = '".$steam."', banni = '".$banni."' WHERE id='".$id."'");
					if($rs == TRUE){
						header("Location: index.php?p=membres&n=2"); //SUCCESS
						die();
					}
				}
			}
			header("Location: index.php?p=membres&n=3"); //SQL
			die();			
			}
		}
	}
?>
