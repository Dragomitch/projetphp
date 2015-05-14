

<!-- Header -->
<div id="body_wrapper">
    <div class="container">

        <!-- Header -->

        <div class="inner">


            <?php require_once(PATH_VIEWS.'headerteachers.php'); ?>
        </div>


        <!-- Banner -->
        <div id="banner">
            <h2>
                <strong>Modification des exercices</strong>
            </h2>
            <p>Quelle exercice voulez vous changer ?</p>
            <form action="index.php?action=modifExercice" method="post">
                <?php if(!$afficher){?>
                    <p>
                        num level :<input type="text" name='num_level'>
                    </p>
                    <p>
                        num exercice : <input type="text" name='num_exercise' /> <input
                            type="submit" value="afficher"/>

                    </p>
                <?php } ?>
            </form>
            <?php if($afficher){ ?>

                <form action="index.php?action=modifExercice" method="post">
                    <p>
                        <span class="html">Question <?php echo $tabexercises[$i]->num_exercise(); ?></span>
                        <input type="hidden" name='num_exercise' value="<?php echo $tabexercises[$i]->num_exercise();?>"/>
                    </p>


                    <p>
                        <span class="html"><?php echo $tabexercises[$i]->statement(); ?></span>
                        <input type="hidden" name='num_level' value="<?php echo $tabexercises[$i]->num_level();?>"/>
                    </p>

                    <p>
                        Statement:<br>
                        <textarea rows="6" cols="65" name='statement'><?php echo $tabexercises[$i]->statement(); ?></textarea>
                        <br> Query :<br>
                        <textarea rows="6" cols="65" name='query'><?php echo $tabexercises[$i]->query();?></textarea>
                        <br> Theme : <input type="text" name='theme' value="<?php echo $tabexercises[$i]->theme();?>"><br>
                        nb_lines : <input type="number" name='nb_lines'	value="<?php echo $tabexercises[$i]->nb_lines();?>" /><br>
                        <input	type="submit" value="changer">
                    </p>


                </form>

            <?php } ?>
        </div>

    </div>
</div>
