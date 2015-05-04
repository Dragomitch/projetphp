
<link rel="stylesheet" href="views/css/signin.css" />
	
<div class="wrapper">
	<h2>Login</h2>
	<p>Bienvenue sur la page de 1er login.</p>
	
	<div id="notification"><?php echo $notification; ?></div>
	<div class="form-signin" >
		<form action="?action=first" method="post" class="form-control">
		<p>Login : <input type="text" name="login" />
		<br>Mot de passe : <input type="password" name="password" />
		<br>Confirmer Mot de passe : <input type="password" name="motdepasseconfirme"/></p>
		<p><input type="submit" name="form_login" value="Enregistrer mot de passe"></p>
		</form>
	</div>
</div><!-- #contenu -->
