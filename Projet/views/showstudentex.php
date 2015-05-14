


<!-- Header -->
<div id="body_wrapper">
<div class="container">


		<div class="inner">

		
				<!-- Nav -->
				<?php require_once(PATH_VIEWS.'headerteachers.php'); ?>
     
                <!-- Banner -->
                <h2><?php echo $matricule.".  ".$tabstudent[0]->last_name()."  ".$tabstudent[0]->first_name()?></h2>
        <div id="banner">
            <table id="tableBalises2">
                <thead>
                <tr>
                    
					<th>Numero Exercice</th>
					<th>Querie de l'etudiant</th>
					
					
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0;$i<count($tabanswer);$i++) { ?>
                    <tr>
						<td><span class="html"><?php echo $tabanswer[$i]->exercise()?></span>
						<td><span class="html"><?php echo $tabanswer[$i]->answer_query()?></span>
						<?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
        
        