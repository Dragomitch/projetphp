


<div id="body_wrapper">
    <div id="container">
        <!-- Header -->
        <?php require_once(PATH_VIEWS.'headerstudents.php'); ?>


        <ul>
            <?php for ($i=0;$i<count($tablevel);$i++) { ?>
                <li><a href="index.php?action=exercices&level=<?php echo $tablevel[$i]->level()?>&exercise=1"><?php echo $tablevel[$i]->label()?></a></li>
            <?php }?>
        </ul>
    </div>
</div>