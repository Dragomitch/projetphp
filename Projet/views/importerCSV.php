<link rel="stylesheet" href="css/modele01.css" />

<!-- Nav -->
<?php require_once(PATH_VIEWS.'headerteachers.php'); ?>

<div class="wrapper">
	<h2>Upload CSV</h2>
    <p>Make sure the file you want to upload is correct because the importation in Database is do just after the upload is finished</p>
	<form enctype="multipart/form-data" action="index.php?action=importCSV" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="file" name="CSVfile"><br>
        <input type="submit" value="Upload file">
    </form>
    <?php if(!empty($notification)) echo $notification ?>
</div>