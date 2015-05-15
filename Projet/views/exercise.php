
<!-- Header -->
<div id="body_wrapper">
    <div class="container">

        <!-- Header -->
        <?php require_once(PATH_VIEWS.'headerstudents.php'); ?>

        <h2>Bienvenue <?php echo $name_student[0]->last_name().' '.$name_student[0]->first_name();?></h2>

        <div id="form3">
            <form
                action="index.php?action=exercices&amp;level=<?php echo $tabexercises[$i]->num_level();?>&amp;exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
                id="raccourci" method="post">
                <p>
                    <input type="hidden" name="module" /> <input type="text"
                                                                 id="direct" name="nr_question" /><input id="go" type="submit"
                                                                                                         value="Go" />
                </p>
            </form>
            <form
                action="index.php?action=exercices&amp;level=<?php echo $tabexercises[$i]->num_level();?>&amp;exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
                method="post" id="precedent">
                <p>
                    <input type="hidden" name="module" value="niv" /> <input
                        type="hidden" name="nr_question_precedent"
                        value="<?php echo $tabexercises[$i]->num_exercise()?>" /> <input
                        type="submit" value="&lt;" />
                </p>
            </form>
            <form
                action="index.php?action=exercices&amp;level=<?php echo $tabexercises[$i]->num_level();?>&amp;exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
                method="post" id="suivant">
                <p>
                    <input type="hidden" name="module" value="niveau1" /> <input
                        type="hidden" name="nr_question_suivant"
                        value="<?php echo $tabexercises[$i]->num_exercise()?>" /> <input
                        type="submit" value="&gt;" />
                </p>
            </form>
        </div>
        <div id="contenu">

            <h2>
                <br><span class="html">Niveau <?php echo $num_level[0]->num_level(); ?></span>
            </h2>
            <h2>
                <span class="html">Question <?php echo $tabexercises[$i]->num_exercise(); ?></span>
            </h2>

            <p>
                <span class="html"><?php echo $tabexercises[$i]->statement(); ?></span>
            </p>

            <a id="niveau" href="views/css/image/niveau1.jpg"><img src="views/css/image/niveau1.jpg" alt="DSD niveau1" title="Cliquez pour agrandir" /></a>

            <?php if(empty($last_answer)){?>
                <p>
                    <span class="html"><?php echo $notification_last_answer;?> </span>
                </p>
            <?php }else{?>
                <p>
                    <span class="html">Votre reponse : <?php echo $last_answer[0]->answer_query();?> </span>
                </p>
            <?php } ?>
            <!-- 				<a id="niveau" href="images/niveau1.jpg"><img -->
            <!-- 					src="images/tn_niveau1.jpg" alt="DSD niveau1" -->
            <!-- 					title="Cliquez pour agrandir" /></a> -->

            <form
                action="index.php?action=exercices&amp;level=<?php echo $tabexercises[$i]->num_level();?>&amp;exercise=<?php echo $tabexercises[$i]->num_exercise() ?>"
                method="post">
                <input type="hidden" name="number_ex"
                       value="<?php echo $tabexercises[$i]->number()?>">
                <p>
                    <textarea rows="6" cols="65" name="answer">SELECT </textarea>
                </p>
                <p class="droite">
                    <input type="submit" value="Exécuter" />
                </p>
            </form>
        </div>
			<p><?php echo $notification_valid;?></p>

        <?php if($show_answer ){?>
            <?php if(isset($notificationStud)){?>
                <p id='notification' > <?php echo $notificationStud; ?></p>
            <?php }else {?>

                <h2>Votre Réponse</h2>
                <p>
				<span class="html">
				<?php echo $tabanswer[0]->answer_query();?>
				</span>
                </p>
                <table class="tableBalises">

                <tr>
                <!-- loop : get the name of the columns -->
                <?php for($j=0;$j<count($tabNamesColumns);$j++){?>

                    <?php echo '<th>' .$tabNamesColumns[$j]. '</th>'?>

                <?php }?>
				
  				</tr>

				 <!-- loop 1 : $k=index of the array where is save an other array where each index is a line of answer  -->
                <?php for($k=0;$k<count($tabshowanswer);$k++){ ?>




                    <tr>
                    <!-- $j is the index who give the names of the columns -->
                    
                        <?php for($j=0;$j<count($tabNamesColumns);$j++){?>
                            <?php echo '<td>'.$tabshowanswer[$k][$tabNamesColumns[$j]].'</td>';?>


                        <?php }?>
                    </tr>
                  

			
                <?php }?>
                </table>
            <?php } ?>

            




			<h2>Réponse Attendue</h2>
			<?php if(isset($notificationTeacher)){ ?>
                <p id='notification'><?php echo $notificationTeacher; ?></p>
            <?php } else{ ?>
                <table class="tableBalises">

                    <tr>
                        <?php for($j=0;$j<count($tabNamesColumnsTeacher);$j++){?>

                            <?php echo '<th>' .$tabNamesColumnsTeacher[$j]. '</th>'?>

                        <?php }?>
</tr>



                        <?php for($k=0;$k<count( $tab_show_answer_teacher);$k++){ ?>




                    <tr>
                        <?php for($j=0;$j<count($tabNamesColumnsTeacher);$j++){?>
                            <?php echo '<td>'. $tab_show_answer_teacher[$k][$tabNamesColumnsTeacher[$j]].'</td>';?>


                        <?php }?>
                    </tr>
                    <?php }?>

                    

                </table>
            <?php }?>
			
			
        <?php }?>
    </div>
</div>
