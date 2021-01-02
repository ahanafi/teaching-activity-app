<?php

$api = file_get_contents('https://api-frontend.kemdikbud.go.id/detail_prodi/MDVGMjY2QzEtRDMyOC00MjA5LUE2REYtMzk1RERENERFQTM4');
$api = json_decode($api);

$collectId = "";
foreach ($api->datadosen as $dosen) {

	$collectId .= $dosen->id . ",";
}

echo $collectId;
