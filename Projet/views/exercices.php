<title>Signin IAnArch</title>

<head>
<body class="homepage">

	<!-- Header -->
	<div id="header-wrapper">
		<div class="container">

			<!-- Header -->
			<header id="header">
				<div class="inner">


					<!-- Nav -->
					<nav id="nav">
						<ul>
							<li>IAnArch</li>
							<li class="current_page_item"><a
								href="index.php?action=homeStudent">Home</a></li>
							<li><a href="index.php?action=level">Niveau</a></li>
							<li><a href="index.php?action=studentStat">Profil</a></li>
							<li><a href="index.php?action=logout">Deconnexion</a></li>
						</ul>
					</nav>

				</div>
			</header>

			<h2>Bienvenue <?php echo $name_student[0]->last_name().' '.$name_student[0]->first_name();?></h2>

			<div id="form3">
				<form
					action="index.php?action=exercices&level=<?php echo $tabexercises[$i]->num_level();?>&exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
					id="raccourci" method="post">
					<p>
						<input type="hidden" name="module" /> <input type="text"
							id="direct" name="nr_question" /><input id="go" type="submit"
							value="Go" />
					</p>
				</form>
				<form
					action="index.php?action=exercices&level=<?php echo $tabexercises[$i]->num_level();?>&exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
					method="post" id="precedent">
					<p>
						<input type="hidden" name="module" value="niv" /> <input
							type="hidden" name="nr_question_precedent"
							value="<?php echo $tabexercises[$i]->num_exercise()?>" /> <input
							type="submit" value="&lt;" />
					</p>
				</form>
				<form
					action="index.php?action=exercices&level=<?php echo $tabexercises[$i]->num_level();?>&exercise=<?php echo $tabexercises[$i]->num_exercise()?>"
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
					<span class="html">Niveau <?php echo $num_level[0]->num_level(); ?></span>
				</h2>
				<h2>
					<span class="html">Question <?php echo $tabexercises[$i]->num_exercise(); ?></span>
				</h2>

				<p>
					<span class="html"><?php echo $tabexercises[$i]->statement(); ?></span>
				</p>


				<!-- 				<a id="niveau" href="images/niveau1.jpg"><img -->
				<!-- 					src="images/tn_niveau1.jpg" alt="DSD niveau1" -->
				<!-- 					title="Cliquez pour agrandir" /></a> -->

				<form
					action="index.php?action=exercices&level=<?php echo $tabexercises[$i]->num_level();?>&exercise=<?php echo $tabexercises[$i]->num_exercise() ?>"
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
        <?php if($show_answer){?>
                	<table id="tableBalises">

				<tr>
               <?php for($j=0;$j<count($tabNamesColumns);$j++){?>
            	
               <?php echo '<th>' .$tabNamesColumns[$j]. '</th>'?>
               	
               <?php }?>
				
				
			
					
					 <?php for($k=0;$k<count($tabshowanswer);$k++){ ?>
					
					
				
				
				<tr>
					  <?php for($j=0;$j<count($tabNamesColumns);$j++){?>
					<?php echo '<td>'.$tabshowanswer[$k][$tabNamesColumns[$j]].'</td>';?>
				
				
               <?php }?>
		</tr>
		<?php }?>

            </tr>

			</table>




			<h2>Réponse Attendue</h2>
			<p>
				<table id="tableBalises">

				<tr>
               <?php for($j=0;$j<count($tabNamesColumns);$j++){?>
            	
               <?php echo '<th>' .$tabNamesColumns[$j]. '</th>'?>
               	
               <?php }?>
				
				
			
					
					 <?php for($k=0;$k<count( $tab_show_answer_teacher);$k++){ ?>
					
					
				
				
				<tr>
					  <?php for($j=0;$j<count($tabNamesColumns);$j++){?>
					<?php echo '<td>'. $tab_show_answer_teacher[$k][$tabNamesColumns[$j]].'</td>';?>
				
				
               <?php }?>
		</tr>
		<?php }?>

            </tr>

			</table>
			
			</p>
			<h2>Votre Réponse</h2>
			<p>
				<span class="html">
				<?php echo $tabanswer[0]->answer_query();?>
				</span>
			</p>
        <?php }?>
    </div>

		</head>