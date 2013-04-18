<?php

/**
 * I hold file system utility methods
 *
 */
class FileSystemService
{
	private $filename;
	private $filepath;
	
	public function __construct()
	{
		error_reporting ( E_ERROR | E_USER_ERROR | E_PARSE );
	}
	
	/**
	 * @return unknown
	 */
	public function getFilename()
	{
		return $this->filename;
	}
	
	/**
	 * @param unknown_type $filename
	 */
	public function setFilename( $filename )
	{
		$this->filename = $filename;
	}
	
	/**
	 * @return unknown
	 */
	public function getFilepath()
	{
		return $this->filepath;
	}
	
	/**
	 * @param unknown_type $filepath
	 */
	public function setFilepath( $filepath )
	{
		$this->filepath = $filepath;
	}
	
	/**
	 * I browse the directory 
	 *
	 * @param [string] $aPath Path of which directory
	 * @return [array]
	 */
	public function browseDirectory( $path = '.', $level = 0, $jsonEncode = false )
	{
		$host = 'http://flex.jonniespratley.com/';
		$webRoot = '';
		
		// Directories to ignore when listing output. Many hosts will deny PHP access to the cgi-bin.
		$ignore = array ( 'cgi-bin', '.', '..', '.DS_Store' );
		
		// Open the directory to the handle $dh
		$dh = opendir ( $path );
		
		$folders = array ();
		
		// Loop through the directory
		while ( false !== ( $file = readdir ( $dh ) ) )
		{
			$ext = substr( strrchr( $file, '.' ), 1 );
			
			// Check that this file is not to be ignored
			if ( ! in_array ( $file, $ignore ) )
			{
					
					
				// Its a directory, so we need to keep reading down...
				if ( is_dir ( "$path/$file" ) )
				{
					// Re-call this same function but on a new directory.this is what makes function recursive.
					$folders[]  = array ( 
					'file' => $file, 
					'filename' => "$path/$file",
					'path' => $path,
					'ext' => $ext, 
					'isDir' => ( is_dir ( $file ) ) ? 'true' : 'false', 
					'isFile' => ( is_file ( $file ) ) ? 'true' : 'false', 
					'isWritable' => ( is_writable ( $file ) ) ? 'true' : 'false', 
					'isReadable' => ( is_readable ( $file ) ) ? 'true' : 'false',
					'children' => $this->browseDirectory( "$path/$file", $level + 1 ) );
					
					#rsort( $folders  );
				} else {
					
					$filename = "$path/$file";
					
					$newPath = preg_replace( '/(\.\.\/)|(\.\/)/', '', $filename );
					$download = $host.$newPath;
					
					$folders[] = array (
						'file' => $file, 
						'filename' => $filename,
						'download' => $download,  
						'path' => $path,
						'ext' => $ext, 
						'isDir' => ( is_dir ( $file ) ) ? 'true' : 'false', 
						'isFile' => ( is_file ( $file ) ) ? 'true' : 'false', 
						'isWritable' => ( is_writable ( $file ) ) ? 'true' : 'false', 
						'isReadable' => ( is_readable ( $file ) ) ? 'true' : 'false' 
					);
					#sort( $folders  );
				}
			}
		}
		 
		closedir ( $dh );
		
		if ( $jsonEncode )
		{
			return json_encode( $folders );
		}
		return  $folders;
	}
	
	public function browseSubDirectory( $folder )
	{
		$subdirArray = array ();
		$subDirHandle = opendir ( $folder );
		{
			while ( false !== ( $file = readdir ( $subDirHandle ) ) )
			{
				if ( $file != '.' && $file != '..' )
				{
					$subdirArray [] = array ( 'label' => $file );
				}
			
			}
			closedir ( $subDirHandle );
		}
		return $subdirArray;
	}
	
	/**
	 * I get the disk information
	 *
	 * @param [string] $aPath the path
	 * @return [array]
	 */
	public function getDiskInfo( $aPath )
	{
		$diskInfoArray = array ( 'freeSpace' => disk_free_space ( $aPath ), 'totalSize' => disk_total_space ( $aPath ) );
		
		return $diskInfoArray;
	}
	
	/**
	 * I change the permissions on a file, or directory
	 *
	 * @param [string] $whatDir the directory
	 * @param [int] $aPermissions the permissions
	 * @return [boolean]
	 */
	public function changePermissions( $whatDir, $aPermissions )
	{
		if ( ! $aPermissions )
		{
			$aPermissions = 0777;
		}
		$change = false;
		// Everything for owner, read and execute for others
		if ( chmod ( $whatDir, $aPermissions ) )
		{
			$change = true;
		}
		
		return $change;
	}
	
	/**
	 * I write to a file
	 *
	 * @param [string] $file the file name
	 * @param [string] $contents file contents
	 */
	public function writeFile( $file, $contents )
	{
		//write file
		$filename = "$file";
		
		$fp = fopen ( $file, 'w' );
		
		//make sure file is writable
		chmod ( $filename, 0777 );
		
		$filecontents = $contents;
		
		fwrite ( $fp, $filecontents, 1024 );
		
		fclose ( $fp );
	}
	
	public function readFile( $file )
	{
		$data = '';
		//$contents = array ();
		if ( is_file( $file ) )
		{
		
		$fp = fopen ( $file, 'r' );
		
		//make sure file is readable
		chmod ( $filename, 0755 );
		
		if ( ! $fp )
		{
			echo 'File could not be opened';
			exit ();
		}
		
		while ( ! feof ( $fp ) )
		{
			//$contents = array ( 'contents' => fgets ( $fp, 9999 ));
			$data .= fgets ( $fp, 9999 );
			//dump the contents into an array
		}
		
		fclose ( $fp );	
		}
		return $data;
	}
	
	/**
	 * I create a directory
	 *
	 * @param [string] $aFolder name of the folder
	 * @param [int] $aPermissions the permissions
	 */
	public function createDirectory( $aFolder, $aPermissions = 0755 )
	{
		$oldmask = umask ( 0 );
		$newPath = mkdir ( $aFolder, $aPermissions );
		$message = '';
		
		umask ( $oldmask );
		
		if ( ! $newPath )
		{
			$message = 'Error creating ' . $newPath;
		}
		else
		{
			$message = 'Created' . $newPath;
		}
		return $message;
	}
	
	/**
	 * I remove a file
	 *
	 * @param [string] $whatDir
	 * @param [string] $whatFile
	 * @return [string]
	 */
	public function removeFile( $whatDir, $whatFile )
	{
		$filepath = "$whatDir/$whatFile";
		$this->changePermissions ( $filepath, 0777 );
		
		$removeFile = unlink ( $filepath );
		$message = '';
		if ( ! $removeFile )
		{
			$message = 'There was a problem removing the file.';
		}
		else
		{
			$message = "$whatFile was removed.";
		}
		return $message;
	}
	
	public function escapeContents( $contents )
	{
		return htmlspecialchars ( $contents );
	}
	
	private function getFormattedDate( $aFile )
	{
		$newDate = date ( 'j F Y H:i', $aFile );
		
		return $newDate;
	}
	
	public function getDirectory( $path = '.', $level = 0 )
	{
		// Directories to ignore when listing output. Many hosts will deny PHP access to the cgi-bin.
		$ignore = array ( 'cgi-bin', '.', '..' );
		
		// Open the directory to the handle $dh
		$dh = opendir ( $path );
		
		$folders = array ();
		$subFolders = array ();
		
		// Loop through the directory
		while ( false !== ( $file = readdir ( $dh ) ) )
		{
			// Check that this file is not to be ignored
			if ( ! in_array ( $file, $ignore ) )
			{
				// Its a directory, so we need to keep reading down...
				if ( is_dir ( "$path/$file" ) )
				{
					// Re-call this same function but on a new directory.this is what makes function recursive.
					$folders[]  = array ( 'label' => $file, 'path' => "$path/$file", 'children' => $this->getDirectory ( "$path/$file", $level + 1 ) );
				}
				else
				{
					$folders[] = array ( 'label' => $file );
				}
			}
		}
		closedir ( $dh );
		return  $folders;
	}

}

?>