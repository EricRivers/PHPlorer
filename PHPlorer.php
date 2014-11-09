<?PHP

class PHPlorer
{
	public function scanFolder($folder)
	{
		$folders = array();
		$files = array();
		$directory = @opendir($folder);
		while (false!=($file = @readdir($directory)))
		{
			if (!preg_match("/^\./i",$file))
			{
				if (is_dir($folder."/".$file))
				{
					htmlspecialchars($folder);
					array_push($folders, urlencode($file));
				} else {
					htmlspecialchars($file);
					array_push($files, $file);
				}
			}
		}
		$foldfiles = array($folders,$files);
		return $foldfiles;
	}
}

$obj= new PHPlorer;
$obj->scanFolder("..");
$folders = $obj->scanFolder("..")[0];
$files = $obj->scanFolder("..")[1];
foreach ($folders as $folder)
{
	echo $folder . "<br/>\n";
}
foreach ($files as $file)
{
	echo $file . "<br/>\n";
}


?>