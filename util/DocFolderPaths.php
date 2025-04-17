<?php
///////Call For Root Dir Path
$rootPath = getParentDirPath(__DIR__);
$folders = ['uploads', 'uploads/ticket', 'uploads/query','uploads/profile'];
//After uploads Folder
$TICKET_DOC_PATH = $rootPath."uploads/ticket/";
$QUERY_DOC_PATH = $rootPath."uploads/query/";
$PROFILE_DOC_PATH = $rootPath."uploads/profile/";
foreach ($folders as $folder) {
	if (!file_exists($rootPath.$folder)) {
		mkdir($rootPath.$folder);
	}
}
 ?>