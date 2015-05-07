<link rel="stylesheet" href="css/modele01.css" />

<!-- Nav -->
<?php require_once(PATH_VIEWS.'headerteachers.php'); ?>

<div class="wrapper">
	<h2>Upload CSV</h2>
    
    <p>Make sure the file you want to upload is correct because the importation in Database is do just after the upload is finished<br>
    If you want to import students or teachers, please use this button.<br>
	</p>
 	
 	<?php if(!empty($notification)) echo $notification ?><br>

	<form enctype="multipart/form-data" action="index.php?action=importCSV" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="CSVfile"><br>
        
    

    <p>If you want to upload exercises, please complete that field<br>
    <!--  TODO Faire en sorte que les champs qui suivent ne soient visibles que si l'on selectionne uploadQueries  -->
	The new level number for that queries:<input type="text" name="level_num"><br>
	</p>
	<input type="submit" value="Upload file"><br>
	</form>
</div>
