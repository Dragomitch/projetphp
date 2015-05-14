<link rel="stylesheet" href="css/modele01.css" />

<!-- Nav -->
<?php require_once(PATH_VIEWS.'headerteachers.php'); ?>


<div class="wrapper">
    <h2>Exportation des CSV</h2>

    <p>Cette section va vous permettre d'exporter des niveaux de votre Base De Données.</p>

        <?php if(count($levels)> 0){?>

        <form action="index.php?action=exportCSV" method="POST">
            <p>Cochez les cases des niveaux dont vous voulez importer les exercices</p>
            <?php foreach($levels as $index => $level){ ?>

                <?php echo $level->label();?> <input type="checkbox" name="levelsToImport[]" value="<?php echo $level->level();?>"><br>


            <?php } ?>
                <input type="submit" value="Exporter les queries"><br>
        </form>
        <?php } ?>


    <?php if(!empty($notification)){?> <p id="notification"><?php echo $notification; }?></p>
</div>