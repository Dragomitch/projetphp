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
                        <li class="current_page_item"><a href="index.php?action=homeStudent">Home</a></li>
                        <li>
                            <a href="index.php?action=level">niveau</a>
                        </li>
                        <li><a href="index.php?action=studentStat">Profil</a></li>
                        <li><a href="index.php?action=logout">Deconnexion</a></li>
                    </ul>
                </nav>

            </div>
        </header>


        <ul>
            <?php for ($i=0;$i<count($tablevel);$i++) { ?>
                <li><a href="index.php?action=exercices&level=<?php echo $tablevel[$i]->level()?>&exercise=1"><?php echo $tablevel[$i]->label()?></a></li>
            <?php }?>
        </ul>