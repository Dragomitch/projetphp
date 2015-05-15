


<!-- Header -->
<div id="body_wrapper">
    <div class="container">


        <div class="inner">


            <!-- Nav -->
            <?php require_once(PATH_VIEWS.'headerteachers.php'); ?>

            <!-- Banner -->
            <h2><?php echo $matricule.".  ".$tabstudent[0]->last_name()."  ".$tabstudent[0]->first_name()?></h2>
            <div id="banner">
                <?php for($i=0;$i<count($tablevel);$i++){ ?>
                    <p>Niveau :  <?php echo $tablevel[$i]->num_level();?></p>
                <table id="tableBalises2">
                    <thead>
                    <tr>

                        <th>Numero Exercice</th>
                        <th>Query de l'etudiant</th>


                    </tr>
                    </thead>
                    <tbody>
                    <!-- get all the answer of the student for the level at $i -->
                    <?php  $tabanswer=Db::getInstance()->select_all_answer_student($matricule, $tablevel[$i]->level()); ?>
                    <!-- $k = index to get each exercises of the student -->
                    <?php for ($k=0;$k<count($tabanswer);$k++) { ?>
                    <tr>
                        <td><span class="html"><?php echo $tabanswer[$k]->exercise()?></span>
                        <td><span class="html"><?php echo $tabanswer[$k]->answer_query()?></span>
                            <?php } ?>
                    </tr>
                    </tbody>
                </table>
                <?php } ?>
            </div>

        </div>
    </div>
        
        