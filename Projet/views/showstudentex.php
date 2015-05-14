
<title>IAnArch</title>

</head>
<body class="homepage">

<!-- Header -->
<div id="header-wrapper">
<div class="container">

<!-- Header -->
<header id="header">
		<div class="inner">

		<!-- Logo -->
		<h1><a href="index.php" id="logo">Ianarch</a></h1>

				<!-- Nav -->
				<?php require_once(PATH_VIEWS.'headerteachers.php'); ?>
        </header>
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
						<?php if(count($tabanswer)>1) { ?>
						<td><span class="html"><?php echo $tabanswer[$i]->exercise()?></span>
						<td><span class="html"><?php echo $tabanswer[$i]->answer_query()?></span>
						<?php }} ?>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
        
        