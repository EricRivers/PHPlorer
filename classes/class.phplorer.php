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
		$foldersfiles = array($folders,$files);
		return $foldersfiles;
	}

}

?>