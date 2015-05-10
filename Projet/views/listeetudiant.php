<title>Signin IAnArch</title>

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