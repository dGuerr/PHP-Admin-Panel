<?php

function paginate($url, $link, $total, $current, $adj=3) {
		$prev = $current - 1; 
		$next = $current + 1; 
		$penultimate = $total - 1;
		$pagination = '';
	 
		if ($total > 1) {
			$pagination .= "<center><nav><ul class=\"pagination\">\n";
	 
			if ($current == 2) {
				$pagination .= "<li><a href=\"{$url}\">&laquo;</a></li>";
			} elseif ($current > 2) {
				$pagination .= "<li><a href=\"{$url}{$link}{$prev}\">&laquo;</a></li>";
			} else {
				$pagination .= '<li class="disabled"><a><span>&laquo;</span></a></li>';
			}
			if ($total < 7 + ($adj * 2)) {
				$pagination .= ($current == 1) ? '<li class="active"><a>1{$i}<span class=\"sr-only\">(current)</span></a></li>' : "<li><a href=\"{$url}\">1</a></li>";
	 
				for ($i=2; $i<=$total; $i++) {
					if ($i == $current) {
						$pagination .= "<li class=\"active\"><a>{$i}<span class=\"sr-only\">(current)</span></a></li>";
					} else {
						$pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
					}
				}
			}
			else {
				if ($current < 2 + ($adj * 2)) {
					$pagination .= ($current == 1) ? "<li class=\"active\"><a>1</a></li>" : "<li><a href=\"{$url}\">1</a></li>";
					for ($i = 2; $i < 4 + ($adj * 2); $i++) {
						if ($i == $current) {
							$pagination .= "<li class=\"active\"><a>{$i}<span class=\"sr-only\">(current)</span></a></li>";
						} else {
							$pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
						}
					}
	 
					$pagination .= '<li><a>...</a></li>';

					$pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
					$pagination .= "<li><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
				}
				elseif ( (($adj * 2) + 1 < $current) && ($current < $total - ($adj * 2)) ) {
					$pagination .= "<li><a href=\"{$url}\">1</a></li>";
					$pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
					$pagination .= '<li><a>&hellip;</a></li>';
	 
					for ($i = $current - $adj; $i <= $current + $adj; $i++) {
						if ($i == $current) {
							$pagination .= "<li class=\"active\"><a>{$i}</a></li>";
						} else {
							$pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
						}
					}

	 
					$pagination .= '<li><a>&hellip;</a></li>';
	 
					$pagination .= "<li><a href=\"{$url}{$link}{$penultimate}\">{$penultimate}</a></li>";
					$pagination .= "<li><a href=\"{$url}{$link}{$total}\">{$total}</a></li>";
				}
				else {
					$pagination .= "<li><a href=\"{$url}\">1</a></li>";
					$pagination .= "<li><a href=\"{$url}{$link}2\">2</a></li>";
					$pagination .= '<li><a>&hellip;</a></li>';
	 
					for ($i = $total - (2 + ($adj * 2)); $i <= $total; $i++) {
						if ($i == $current) {
							$pagination .= "<li class=\"active\"><a>{$i}<span class=\"sr-only\">(current)</span></a></li>";
						} else {
							$pagination .= "<li><a href=\"{$url}{$link}{$i}\">{$i}</a></li>";
						}
					}
				}
			}
	 
			if ($current == $total)
				$pagination .= "<li class=\"disabled\"><a>»</a></li>\n";
			else
				$pagination .= "<li><a href=\"{$url}{$link}{$next}\">»</a></li>\n";
	 
			$pagination .= "</ul></nav></center>\n";
		}
	 
		return ($pagination);
	}
?>