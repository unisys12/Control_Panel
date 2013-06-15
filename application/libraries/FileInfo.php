<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FileInfo {

	public $file;

	public static function getFile($file)
	{

		return $file;

	}

	public static function getFileName($file)
	{

		// Get the files tmp location
		$tmp = File::getFileTemp($file);

		// Check if this is a valid file
		if(is_file($tmp)){

			// Assign the files name to the variable $file
			$file = File::getFile($file)['name'];

			// Return the info
			return $file;

		} else {

			// If not a valid file, return an error message to the browser
			return "There is a problem with your files name!";
		}


	}

	/**
		* If the browser says that the file is a image,
		* use the 'getimagesize()' method to determine if it
		* really is. If so, display the file type. If not, display
		* an error.
		*/
	public static function getFileType($file)
	{
		// return mime type ala mimetype extension
		$finfo = new finfo(FILEINFO_MIME);

		// Get the files tmp location
		$tmp = File::getFileTemp($file);

		// If this is a valid file
		if(is_uploaded_file($tmp)){

			// get mime-type for a specific file using finfo()
			$file = $finfo->file($tmp);

			// Return the info
			return $file;

		} else {

			// If not a valid file, return an error message to the browser
			return "The file type of the file is incorrect!";

		}


	}

	// Return the file's size. if no size is returned, throws an error
	public static function getFileSize($file)
	{

		// Get the file temp location
		$tmp = File::getFileTemp($file);

		// Check if it is a valid file
		if(is_file($tmp)){

			// Use filesize() to get the size and assign it to $file
			$file = filesize($tmp);

			// Return the filesize and append kb to it
			return $file . "kb";

		} else {

			// If not a valid file, return an error message to the browser
			return "There file size of the file is incorrect!";

		}

	}

	// Returns the file's tmp path from the server
	public static function getFileTemp($file)
	{

		$file = File::getFile($file['tmp_name']);


		return $file;

	}

	// Returns errors
	public static function getFileError($file)
	{

		$file = File::getFile($file['error']);
		return $file;

	}

}
