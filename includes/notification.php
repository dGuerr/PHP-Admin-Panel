<?php
	if(isset($_GET['n']))
	{
		$n = $_GET['n'];
		if($notif = getNotification($n)){
			echo '
			<div class="notification" id="'.$notif->getStyle().'">
			<h4>'.$notif->getTitle().'</h4>
			<p>'.$notif->getText().'</p>
			</div>
			';
		}
	}
?>