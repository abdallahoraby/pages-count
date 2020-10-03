<?php
	require_once 'conf.php';

	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	//function to generate random string for file name
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	//function to calculate pdf pages and return pages_count input

	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // get file extension

	if ( 0 < $_FILES['file']['error'] ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	}

	else if ( $_FILES['file']['type'] == 'application/pdf') { // file extension is pdf

		$temp_file_name = generateRandomString().'.pdf'; //set temp name for pdf
		move_uploaded_file($_FILES['file']['tmp_name'], '../temp_upload/' . $temp_file_name);
		$delete_path = '../temp_upload/'.$temp_file_name;
		$path = PATH. '/temp_upload/'.$temp_file_name;

		function countPDF($pdfname) {
			$pdftext = file_get_contents($pdfname);
			$num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
			return $num;
		}

		echo countPDF($path);

	} else if ( $ext == 'docx' ){

		$temp_file_name = generateRandomString().'.docx'; //set temp name for docx
		move_uploaded_file($_FILES['file']['tmp_name'], '../temp_upload/' . $temp_file_name);
		$delete_path = '../temp_upload/'.$temp_file_name;

		//count word file pages
		include 'class-doccounter.php';
		$doc = new DocCounter();
		$doc->setFile($delete_path);
		echo $doc->getInfo()->pageCount;


	} else if ( $ext == 'pptx' ){

		$temp_file_name = generateRandomString().'.pptx'; //set temp name for pptx
		move_uploaded_file($_FILES['file']['tmp_name'], '../temp_upload/' . $temp_file_name);
		$delete_path = './temp_upload/'.$temp_file_name;

		function PageCount_PPTX($file) {
			$pageCount = 0;

			$zip = new ZipArchive();

			if($zip->open($file) === true) {
				if(($index = $zip->locateName('docProps/app.xml')) !== false)  {
					$data = $zip->getFromIndex($index);
					$zip->close();
					$xml = new SimpleXMLElement($data);
					$pageCount = $xml->Slides;
				}
				$zip->close();
			}

			return $pageCount;
		}

		echo PageCount_PPTX($delete_path);

	}

	//function to delete all files inside the temp_upload folder after check

	//The name of the folder.
	$folder = '../temp_upload';

	//Get a list of all of the file names in the folder.
	$files = glob($folder . '/*');

	//Loop through the file list.
	foreach($files as $file){
		//Make sure that this is a file and not a directory.
		if(is_file($file)){
			//Use the unlink function to delete the file.
			unlink($file);
		}
	}


