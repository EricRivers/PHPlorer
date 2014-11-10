<?PHP

require_once('classes/class.phplorer.php');

function scanFolder($folder) {
	$folders = array();
	$files = array();
	$directory = @opendir($folder);
	while (false!=($file = @readdir($directory))) {
		if (!preg_match("/^\./i",$file)) {
			if (is_dir($folder."/".$file)) {
				htmlspecialchars($folder);
				array_push($folders, urlencode($file));
			} else {
				htmlspecialchars($file);
				array_push($files, $file);
			}
		}
	}
	
	displayCurrentFolder($folder);
	displaySortedFolders($folders,$folder);	
	displaySortedFiles($files,$folder);
	
}

function displayCurrentFolder($folder) {
	if ($folder == "..") {
		echo "<b>Current folder: ../public_html</b><br><br>\n";
		echo "<img src=\"images/folder-open-grey.gif\"><b>../</b><br>\n";
	} else {
		$readable = str_replace("..", "../public_html", dirname(urldecode($folder)));
		echo "<b>Current folder: ".str_replace("..", "../public_html", urldecode($folder))."</b><br><br>\n";
		echo "<a href=\"".$_SERVER['PHP_SELF']."?newDir=".dirname($folder)."\"><img src=\"images/folder-open.gif\" border=\"0\"> <b>".$readable."</b></a><br>\n";
	}
}

function displaySortedFolders($folders,$folder) {
	echo "<ul>\n";
	sort($folders);
	foreach ($folders as $aFolder) {
		echo "<li><a href=\"".$_SERVER['PHP_SELF']."?newDir=$folder/$aFolder\"><img src=\"images/folder-closed.gif\" border=\"0\"> <b>".urldecode($aFolder)."</b></a><br>\n";
	}
}

function displaySortedFiles($files,$folder) {
	echo "<br>\n";
	echo "\t<ul>\n";
	sort($files);
	foreach ($files as $aFile) {
		echo "\t<li><a href=\"$folder/$aFile\" target=\"_blank\"><img src=\"images/generic.gif\" border=\"0\"> ".urldecode($aFile)."</a><br>\n";
	}
	echo "\t</ul>\n</ul>\n";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />

<title>PHPlorer</title>
<link href="css/phplorer.css" rel="stylesheet" />

</head>
<body>
<h2 align="center"><b>PHPlorer</b></h2>
<blockquote>
<p>
<img src="images/folder-open-grey.gif" width="27" height="22"> - Top-level folder, cannot navigate further up<br>
<img src="images/folder-open.gif" width="27" height="22"> - Parent folder, click to navigate up<br>
<img src="images/folder-closed.gif" width="20" height="22"> - Child folder, click to navigate down
</p>
<?PHP

$dir = new PHPlorer;

if (isset($_GET['newDir']))
{
	$folder = $_GET['newDir'];
	$dir->scanFolder($_GET['newDir']);
	$folders = $dir->scanFolder($_GET['newDir'])[0];
	$files = $dir->scanFolder($_GET['newDir'])[1];
}
else
{
	$folder = '..';
	$dir->scanFolder('..');
	$folders = $dir->scanFolder('..')[0];
	$files = $dir->scanFolder('..')[1];
}

displayCurrentFolder($folder);
displaySortedFolders($folders,$folder);	
displaySortedFiles($files,$folder);

/* if (isset($_GET['newDir'])) {
	scanFolder($_GET['newDir']);
} else {
	scanFolder("..");
}
 */?>
</blockquote>
</body>
</html>
