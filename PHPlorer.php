<?PHP

class PHPlorer
{
	public $folder = "..";
	
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
				} else
				{
				htmlspecialchars($file);
				array_push($files, $file);
				}
			}
		}
	}
	
}

$obj= new PHPlorer;

echo $obj->folder."<br/>\n";

foreach ($folders as $aFolder)
{
	echo $aFolder."<br/>\n";
}

foreach ($files as $aFile)
{
	echo $aFile."<br/>\n";
}

?>