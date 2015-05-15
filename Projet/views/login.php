


<div class="wrapper">
    <h2>Page d'identification</h2>
    <p>Bienvenue sur la page d'identification.</p>

    <div id="notification"><?php echo $notification; ?></div>
    <div class="form-signin" >
        <form action="?action=login" method="post" class="form-control">
            <p> Login : <input type="text" name="login" />
            <p>Mot de passe : <input type="password" name="password" /></p>
            <p><input type="submit" name="form_login" value="Se connecter"></p>
        </form>
    </div>
    <p>Pas encore de mot de passe ? cliquez <a href="index.php?action=first">ICI</a>
</div><!-- #contenu -->