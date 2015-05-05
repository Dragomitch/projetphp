<title>Signin IAnArch</title>

<head>
<body class="homepage">

<!-- Header -->
<div id="header-wrapper">
    <div class="container">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->
                <h1><a href="index.html" id="logo">Ianarch</a></h1>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li class="current_page_item"><a href="index.php?action=homeTeacher">Home</a></li>
                        <li>
                            <a href="index.php?action=modifExercice">Modification Exercices</a>
                        </li>
                        <li><a href="index.php?action=studentList">Liste Etudiants</a></li>
                        <li><a href="index.php?action=ExportCSV">Exporter CSV</a></li>
                        <li><a href="index.php?action=importCSV">Importer CSV</a></li>
                        <li><a href="index.php?action=logout">Deconnexion</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <!-- Banner -->
        <div id="banner">
            <table id="tableBalises2">
                <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Prenom</th>
                    <th>Nom</th>

                </tr>
                </thead>
                <tbody>
                <?php for ($i=0;$i<count($tabstudents);$i++) { ?>
                    <tr>
                        <td><span class="html"><?php echo $tabstudents[$i]->matricule() ?></span></td>
                        <td><span class="html"><?php echo $tabstudents[$i]->first_name()?></span></td>
                        <td><span class="html"><?php echo $tabstudents[$i]->last_name()?></span></td>

                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</head>
