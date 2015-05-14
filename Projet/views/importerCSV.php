<link rel="stylesheet" href="css/modele01.css" />

<!-- Nav -->
<?php require_once(PATH_VIEWS.'headerteachers.php'); ?> <!--// TODO mettre ca dans l'index en fonction du type de personne-->

<div class="wrapper">
	<h2>Upload CSV</h2>
    
    <p>Make sure the file you want to upload is correct because the importation in Database is do just after the upload is finished<br>
    If you want to import students or teachers, please use this button.<br>
    Assurez-vous que le fichier que vous voulez importer est correct.
	</p>
 	
 	<p id="notification"><?php if(!empty($notification)) echo $notification ?><br></p>

	<form enctype="multipart/form-data" action="index.php?action=importCSV" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="CSVfile"><br>
        
    	

    <p>Si vous voulez uploader des exercices, veuillez rentrer un nom de niveau et un numéro de niveau<br>
    <!--  TODO Faire en sorte que les champs qui suivent ne soient visibles que si l'on selectionne uploadQueries  -->

        Le nom du niveau où l'on veut importer les exercices:<input type="text" name="level_label"><br>
        Le numéro du niveau où l'on veut importer les exercices: <input type="text" name="level_num"><br>
	</p>
	<input type="submit" value="Upload file"><br>
	</form>
</div>
