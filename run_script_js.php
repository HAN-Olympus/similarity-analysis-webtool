<html>
 	<head>
  		<title>Running Script</title>
  		<script type="text/javascript" src="./lib/pdfobject.js"></script>
 	</head>
 	
 	<body>
 		<p>
 			Click these button's to view the PDF's created by the tool:

 			<input type="submit" name="getCoveragePDFButton" id="getCoveragePDFButton" value="View Coverage Plot" onclick="viewCoveragePDF()">
 			<input type="submit" name="getMisMatchesPDFButton" id="getMisMatchesPDFButton" value="View Mismatches Plot" onclick="viewMisMatchesPDF()">
 			<input type="submit" name="getPercentIdentityPDFButton" id="getPercentIdentityPDFButton" value="View Percent Identity Plot" onclick="viewPercentIdentityPDF()">
 			<input type="submit" name="getPercentIdentityPerCoveragePDFButton" id="getPercentIdentityPerCoveragePDFButton" value="View Percent Identity Per CoveragePlot" onclick="viewPercentIdentityPerCoveragePDF()"><br>

 			Create a zip of all the output data:
 			<input type="submit" name="createZipButton" id="createZipButton" value="Create Zip" onclick="createZipOfOutputFolder()">

 			Script output: <br><br>

 			<!-- Disable the 3 buttons to view the PDF's -->
 			<script type="text/javascript" >
 				document.getElementById("getCoveragePDFButton").disabled = true; 
 				document.getElementById("getMisMatchesPDFButton").disabled = true; 
 				document.getElementById("getPercentIdentityPDFButton").disabled = true;
 				document.getElementById("getPercentIdentityPerCoveragePDFButton").disabled = true; 
 			</script>
 		</p>

 		<!-- Create a new Div to view the output pdf's in -->
 		Coverage Plot: 
 		<div id="coveragePDFViewer"></div>
 		Mismatches Plot:
 		<div id="mismatchesPDFViewer"></div>
 		Percent Identity Plot:
 		<div id="percentIdentityPDFViewer"></div>
 		Percent Identity Per Coverage Plot:
 		<div id="percentIdentityPerCoveragePDFViewer"></div>

	 <?php


		// Get the file paths for both files
		// $queryFilePath = $UPLOAD_DIR.$queryFilename;
		// $databaseFilePath = $UPLOAD_DIR.$databaseFilename;

		$queryFilePath = $_POST["queryFilePath"];
		$databaseFilePath = $_POST["databaseFilePath"];

		// Get the parameters the user gave in
		// Modify the query- and database genome size and multiply them with 10e6
		$queryGenomeSize = ($_POST["queryGenomeSize"] *1000000);
		$databaseGenomeSize = ($_POST["databaseGenomeSize"] *1000000);
		
		$queryFileFileType = $_POST["queryFiletype"];
		//$databaseFileFileType = $_POST["databaseFileType"];

		$fileTypeParam = "";

		if ($queryFileFileType == "FASTA") {
			$fileTypeParam = "-f";	
		}
		elseif ($queryFileFileType == "FASTQ") {
			$fileTypeParam = "-q";
		}
		elseif ($queryFileFileType == "SRA") {
			$fileTypeParam = "-a";
		}

		$iterations = $_POST["iterations"];

		// Get the file extension for the input files
		$queryName = pathinfo($queryFilePath, PATHINFO_FILENAME);
		$databaseName = pathinfo($databaseFilePath, PATHINFO_FILENAME);

		//echo "$queryFilePath";

		//$escapedcommand = escapeshellarg("grep -c '^>' $queryFilePath");

		//$queryFileNumberOfReads = shell_exec("sh get_amount_of_reads.sh $queryFilePath");

		//echo "$queryFileNumberOfReads";
		//echo "Query Size: $queryGenomeSize";


		// Run the actual script
		// IMPORTANT!!
		// Be sure to change the output folder (the path after the -o flag) to the appropriate path on your computer
		//passthru("python ../cgi-bin/tool/core.py -i $queryFilePath -d $databaseFilePath -o /Applications/MAMP/htdocs/OUTPUT $fileTypeParam -s $queryGenomeSize -k $databaseGenomeSize -T $iterations");


		$coveragePDF = "http://127.0.0.1:8888/OUTPUT/{$queryName}-{$databaseName}/figures/Coverage_{$queryName}_ALIGNED_TO_{$databaseName}.pdf";
		$misMatchesPDF = "http://127.0.0.1:8888/OUTPUT/{$queryName}-{$databaseName}/figures/Mismatches_{$queryName}_ALIGNED_TO_{$databaseName}.pdf";
		$percentIdentityPDF = "http://127.0.0.1:8888/OUTPUT/{$queryName}-{$databaseName}/figures/percent\ dentity_{$queryName}_ALIGNED_TO_{$databaseName}.pdf";
		$percentIdentityPerCoveragePDF = "http://127.0.0.1:8888/OUTPUT/{$queryName}-{$databaseName}/figures/percentID_per_coverage_{$queryName}_ALIGNED_TO_{$databaseName}.pdf";



		// // Create a zip from the output folder
		// $source_dir = "http://127.0.0.1:8888/OUTPUT/{$queryName}-{$databaseName}";
		$zip_file = "{$queryName}-{$databaseName}.zip";
		
		// The path where we can find the output
		// BE SURE TO CHANGE THIS TO THE CORRECT PATH IF YOU SETUP THE TOOL ON A DIFFERENT MACHINE
		$rootPath = "./OUTPUT/{$queryName}-{$databaseName}_equalized";


		$zipCommand = "zip -r $zip_file $rootPath";
		system($zipCommand);

		//shell_exec("sh zipFolder.sh $zip_file $rootPath");


	?>


 		<script type="text/javascript">
 			// Re-enable all the 4 buttons to view the PDF's
 			document.getElementById("getCoveragePDFButton").disabled = false; 
 			document.getElementById("getMisMatchesPDFButton").disabled = false; 
 			document.getElementById("getPercentIdentityPDFButton").disabled = false;
 			document.getElementById("getPercentIdentityPerCoveragePDFButton").disabled = false;

 			function viewCoveragePDF(){
 				var embedParams = {url: "<?php echo $coveragePDF ?>"};
 				var myPDF = new PDFObject(embedParams).embed("coveragePDFViewer");
 			};

 			function viewMisMatchesPDF(){
 				var embedParams = {url: "<?php echo $misMatchesPDF ?>"};
 				var myPDF = new PDFObject(embedParams).embed("mismatchesPDFViewer");
 			};

 			function viewPercentIdentityPDF(){
 				var embedParams = {url: "<?php echo $percentIdentityPDF ?>"};
 				var myPDF = new PDFObject(embedParams).embed("percentIdentityPDFViewer");
 			}

 			function viewPercentIdentityPerCoveragePDF(){
 				var embedParams = {url: "<?php echo $percentIdentityPerCoveragePDF ?>"};
 				var myPDF = new PDFObject(embedParams).embed("percentIdentityPerCoveragePDFViewer");
 			}

 			// Create a zip of all the output folder
 			function createZipOfOutputFolder(){


 			}

 		</script>

 		

 		


		<!-- //echo $output;

		// echo "$queryFilePath<br>";
		// echo "$databaseFilePath<br>";

		// echo "Query File: ".file_get_contents($UPLOAD_DIR.$queryFilename)."<br><br>";
		// echo "Database File: ".file_get_contents($UPLOAD_DIR.$databaseFilename)."<br>"; -->

 	</body>
</html>