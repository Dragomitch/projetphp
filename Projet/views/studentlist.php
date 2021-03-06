
<!-- Header -->
<div id="body_wrapper">
    <div class="container">

        <!-- Nav -->
        <?php require_once(PATH_VIEWS.'headerteachers.php'); ?>


        <!-- Banner -->
        <div id="banner">
            <table id="liststud">
                <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Prenom</th>
                    <th>Nom</th>
		
                    <?php for($k=0;$k<count($tablevel);$k++){?>
                    	<!-- get all the answer of the student for the level at $k -->
                        <?php if(count($tabexercise=Db::getInstance()->select_exercise($tablevel[$k]->level()))>1){ ?>
                            <th>Completer level <?php echo $tablevel[$k]->num_level();?></th>
                        <?php }}?>
                </tr>
                </thead>
                <tbody>
                <!-- $i is the index to get each student info -->
                <?php for ($i=0;$i<count($tabstudents);$i++) { ?>
                    <tr>
                        <td><span class="html"><?php echo $tabstudents[$i]->matricule() ?></span></td>
                        <td><a href="index.php?action=studentEx&amp;matricule=<?php echo $tabstudents[$i]->matricule() ?>"><span class="html"><?php echo $tabstudents[$i]->first_name()?></span></a></td>
                        <td><span class="html"><?php echo $tabstudents[$i]->last_name()?></span></td>
	
                        <?php for($k=0;$k<count($tablevel);$k++){ ?>
                         <!-- get all the exercise for the level at $k -->
                        <?php $tabexercise=Db::getInstance()->select_exercise($tablevel[$k]->level());?>
                        <?php if(count($tabexercise)>1) { ?>
                         <!-- get all the answer of the student for the level at $k and the student at $i -->
                        <?php $tab_answer_stud=Db::getInstance()->select_all_answer_student($tabstudents[$i]->matricule(), $tablevel[$k]->level());?>
                        <td><span class="html"><progress class="progress" value="<?php echo (count($tab_answer_stud)/count($tabexercise))*100;?>" max="<?php echo 100 ?>"></progress>  <?php echo round((count($tab_answer_stud)/count($tabexercise))*100,1)."%"?></span>
                            <?php }} ?>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

    </div>
</div>