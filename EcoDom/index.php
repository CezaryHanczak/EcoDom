<?php
//Sprawdzanie czy dana osoba jest zalogowana
session_start();
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: houses.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoDom</title>
    <link rel="stylesheet" href="css/index-style.css">
</head>
<body>
<div class="container right-panel-active">
    <!-- Sign Up -->
    <div class="container__form container--signup">
        <form name="log" action="rejestracja.php" method="POST" class="form"> <!-- Było tu jeszcze pole id="form1", ale post nie działał to skasowałem, chyba nic się popsuło. -->
            <h2 class="form__title">Sign Up</h2>
            <input type="text" placeholder="Username" class="input" name="login" value="<?php
				if(isset($_SESSION['fr_login']))
				{
					echo $_SESSION['fr_login'];
					unset($_SESSION['fr_login']);
				}
			?>"/>
			<?php
				if(isset($_SESSION['e_login1']))
				{
					echo '<div class="error">'.$_SESSION['e_login1'].'</div>';
					unset($_SESSION['e_login1']);
					unset($_SESSION['e_login2']);
					unset($_SESSION['e_login3']);
				}
				if(isset($_SESSION['e_login2']))
				{
					echo '<div class="error">'.$_SESSION['e_login2'].'</div>';
					unset($_SESSION['e_login2']);
					unset($_SESSION['e_login3']);
				}
				if(isset($_SESSION['e_login3']))
				{
					echo '<div class="error">'.$_SESSION['e_login3'].'</div>';
					unset($_SESSION['e_login3']);
				}
			?>
            <input type="email" placeholder="Email" class="input" name="email" value="<?php
				if(isset($_SESSION['fr_email']))
				{
					echo $_SESSION['fr_email'];
					unset($_SESSION['fr_email']);
				}
			?>"/>
			<?php
				if(isset($_SESSION['e_email']))
				{
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
            <input type="password" placeholder="Password" class="input" name="haslo" value="<?php
				if(isset($_SESSION['fr_haslo']))
				{
					echo $_SESSION['fr_haslo'];
					unset($_SESSION['fr_haslo']);
				}
			?>"/>
			<?php
				if(isset($_SESSION['e_haslo1']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo1'].'</div>';
					unset($_SESSION['e_haslo1']);
					unset($_SESSION['e_haslo3']);
				}
				if(isset($_SESSION['e_haslo3']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo3'].'</div>';
					unset($_SESSION['e_haslo3']);
				}
			?>
            <input type="password" placeholder="Repeat password" class="input" name="potw" value="<?php
				if(isset($_SESSION['fr_potw']))
				{
					echo $_SESSION['fr_potw'];
					unset($_SESSION['fr_potw']);
				}
			?>"/>
			<?php
				if(isset($_SESSION['e_haslo2']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo2'].'</div>';
					unset($_SESSION['e_haslo2']);
				}
			?>
            <button class="btn" type="submit" name="zarejestruj" value="zarejestruj">Sign Up</button>
        </form>
    </div>

    <!-- Sign In -->
    <div class="container__form container--signin">
        <form class="form" name="rej" action="login.php" method="post"> <!-- Było tu jeszcze pole id="form2", ale post nie działał to skasowałem, chyba nic się popsuło. -->
            <h2 class="form__title">Sign In</h2>
            <input type="text" placeholder="Login" class="input" name="login"/>
            <input type="password" placeholder="Password" class="input" name="haslo"/>
            <a href="#" class="link">Forgot your password?</a>
			<?php
				if(isset($_SESSION['blad'])) echo "<br>".$_SESSION['blad'];
			?>
            <button type="submit" name="zaloguj" class="btn">Sign In</button>
        </form>
    </div>

    <!-- Overlay -->
    <div class="container__overlay">
        <div class="overlay">
            <div class="overlay__panel overlay--left">
                <button class="btn" id="signIn">Login</button>
            </div>
            <div class="overlay__panel overlay--right">
                <button class="btn" id="signUp">Register</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="js/index-js.js"></script>
</html>
<!--
bialy #ede9a3
zielony #55a44e -->
