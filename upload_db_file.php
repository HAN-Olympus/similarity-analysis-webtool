
 <?php
	$UPLOAD_DIR = "/Applications/MAMP/htdocs/data_files/";

	// Check if both files contain data
	if (!empty($_FILES["databaseFile"])) {
		$databaseFile = $_FILES["databaseFile"];


		// ensure a safe filename
		$databaseFilename = preg_replace("/[^A-Z0-9._-]/i", "_", $databaseFile["name"]);

		// preserve file from temporary directory
	    move_uploaded_file($databaseFile["tmp_name"], $UPLOAD_DIR.$databaseFilename);

	    // echo $queryFile["name"]."<br>";
	    // echo $databaseFile["name"]."<br>";

	}
	// Get the file paths for both files and put these in a JSON object
	$databaseFilePath = $UPLOAD_DIR.$databaseFilename;

	$databaseFileNumberOfReads = str_replace("\n", "", shell_exec("sh get_amount_of_reads.sh $databaseFilePath"));

	$db_filePath = array('databaseFilePath' => $databaseFilePath,
						'databaseFileReads' => $databaseFileNumberOfReads);
	echo json_encode($db_filePath);

	// Get the parameters the user gave in
	// Modify the query- and database genome size and multiply them with 10e6
	// $queryGenomeSize = ($_POST["queryGenomeSize"] *1000000);
	// $databaseGenomeSize = ($_POST["databaseGenomeSize"] *1000000);
	// $fileType = $_POST["filetype"];
	// $iterations = $_POST["iterations"];
	

	//echo "Query Size: $queryGenomeSize";


	// Run the actual script

	//$command = escapeshellcmd('python ../cgi-bin/tool/test.py');
	//$command = escapeshellcmd("python ../cgi-bin/tool/core.py -i $queryFilePath -d $databaseFilePath -o /Users/Koen/Desktop/OUTPUT -f -s $queryGenomeSize -k $databaseGenomeSize -T $iterations");
	//$output = shell_exec($command);

	//echo $output;

	// echo "$queryFilePath<br>";
	// echo "$databaseFilePath<br>";

	// echo "Query File: ".file_get_contents($UPLOAD_DIR.$queryFilename)."<br><br>";
	// echo "Database File: ".file_get_contents($UPLOAD_DIR.$databaseFilename)."<br>";
?>

