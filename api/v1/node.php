<?php

function apiquery($field = FALSE) {
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT `ip`,`port`,`owner`,`version`,`status` FROM `nodes` ORDER BY `version` DESC, `owner` DESC");
	$stmt->execute();
	$stmt->bind_result($ip, $port, $owner, $version, $status);
	$i=0;
	
	while ($stmt->fetch()) {
		$result[$i] = array(
					"ip" => $ip,
					"port" => $port,
					"owner" => $owner,
					"version" => $version,
					"status" => $status
					);
		$i++;
	}
	
	$stmt->close();

	header('Content-type: text/javascript');
	echo pretty_json(json_encode($result));	
}
?>
