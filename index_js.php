 <!DOCTYPE html>
 <html>

 <head>
	<!-- <link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet"> -->
	<link href="./lib/uploadfile.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->


	<!-- <script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script> -->
	<script src="./lib/jquery.uploadfile.min.js"></script>
 </head>

 <body>

	<h1>Welcome to the Similarity Analysis Tool.</h1>
		<p>

		<!-- Import the library required for uploading our files -->
		<script type="text/javascript" src="./lib/upclick-min.js"></script>

		<!-- Create the input form -->
		<form method="post" enctype="multipart/form-data" action="./run_script_js.php">

			<div id="queryfileuploader">Query File</div>
			<div id="queryFileUploadStatus"></div>
			<div id="queryFileReads">Number of reads: </div>
			<!-- <div id="queryFilePath"></div> -->

			Query File Path on Server:
			<input type="text" name="queryFilePath" id="queryFilePath"><br>

			<div id="databasefileuploader">Database File</div>
			<div id="databaseFileUploadStatus"></div>
			<div id="databaseFileReads">Number of reads: </div>
			<!-- <div id="databaseFilePath"></div> -->

			Database File Path on Server:
			<input type="text" name="databaseFilePath" id="databaseFilePath"><br>

			<!-- style="visibility: hidden" -->

			Query Genome Size (in milions):
			<input type="number" name="queryGenomeSize" step="0.01"><br><br>

			Database Genome Size (in milions):
			<input type="number" name="databaseGenomeSize" step="0.01"><br><br>

			Read Length:
			<input type="number" name="readLength" min="100"><br><br>
			
			Filetype:
			<select name="queryFiletype">
				<option value="SRA">SRA</option>
				<option value="FASTA">FASTA</option>
				<option value="FASTQ">FASTQ</option>
			</select><br>

			Iterations:
			<input type="number" name="iterations" min="1" step="1"><br>
			<input type="submit" name="runToolButton" value="Run Tool">
		</form>
		</p>


		
	
		<!-- Javascript code for uploading the query and database files -->
		<script>

			$(document).ready(function(){
				// Settings for uploading the query file
				var queryFileSettings = {
					url: "./upload_query_file.php",
					method: "POST",
					enctype: "multipart/form-data",
					returnType: "json",
					allowedTypes:"fasta,sra,fastq,fa",
					fileName: "queryFile",
					multiple: false,
					showCancel: true,
					showDone: false,
					onSuccess:function(files,data,xhr)
					{
						$("#queryFileUploadStatus").html("<font color='green'>Uploaded query file succesfully</font>");
						
						// Parse the JSON we get back from the PHP script and display the number of reads in the appropiate input field
						console.log(data);

						var queryPath = data.queryFilePath;
						var queryFileNumberOfReads = data.queryFileReads;

						console.log(queryPath);
						console.log(queryFileNumberOfReads);

						$("#queryFileReads").append(queryFileNumberOfReads);
						// $("#queryFilePath").append(queryPath);

						document.getElementById("queryFilePath").value=queryPath;

					},
					onError: function(files,status,errMsg)
					{      
						$("#queryFileUploadStatus").html("<font color='red'>Uploading of query file Failed</font>");
					}
				}
				// Almost the same settings for uploading the database file
				var databaseFileSettings = {
					url: "./upload_db_file.php",
					method: "POST",
					enctype: "multipart/form-data",
					returnType: "json",
					allowedTypes:"fasta,sra,fastq,fa",
					fileName: "databaseFile",
					multiple: false,
					showCancel: true,
					showDone: false,
					onSuccess:function(files,data,xhr)
					{
						$("#databaseFileUploadStatus").html("<font color='green'>Uploaded database file succesfully</font>");
						
						// Parse the JSON we get back from the PHP script and display the number of reads in the appropiate input field
						console.log(data);

						var databasePath = data.databaseFilePath;
						var databaseFileNumberOfReads = data.databaseFileReads;

						console.log(databasePath);
						console.log(databaseFileNumberOfReads);

						$("#databaseFileReads").append(databaseFileNumberOfReads);
						// $("#databaseFilePath").append(databasePath);

						document.getElementById("databaseFilePath").value=databasePath;

					},
					onError: function(files,status,errMsg)
					{      
						$("#databaseFileUploadStatus").html("<font color='red'>Uploading of database file Failed</font>");
					}
				}
				// Calling the actual file upload
				$("#queryfileuploader").uploadFile(queryFileSettings);
				$("#databasefileuploader").uploadFile(databaseFileSettings);
			});


		</script>

		<?php
			# Check is the user pressed the submit button,
			# if so.. get the variables from the input fields and run the tool
			// if(isset($_POST["runToolButton"])){

			// 	# Multiply the genome sizes with 10e6
			// 	$queryGenomeSize = ($_POST["queryGenomeSize"] *1000000);
			// 	$databaseGenomeSize = ($_POST["databaseGenomeSize"] *1000000);
			// 	$fileType = $_POST["filetype"];
			// 	$iterations = $_POST["iterations"];

				
			// }

		?>

</body>
</html>
