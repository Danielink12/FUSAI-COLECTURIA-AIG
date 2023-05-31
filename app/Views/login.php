<!DOCTYPE html>
<html lang="en">
<?php 
        include("head.php"); 
     ?>
<body>
    <img class="wave" src="<?php echo base_url(); ?>/assets/wave.svg" alt="">
    <section class="login__main">
        <div class="logomasform">
            <picture class="logo">
             <img class="logofph" src="<?php echo base_url(); ?>/assets/logoaigt.png" alt="">
            </picture>
            <div class="login__content container">
                <div class="login__img">
                <picture>
                    <img class="mockup__login" src="<?php echo base_url(); ?>/assets/login_material.svg" alt="">
                </picture>
                </div>
                <div class="login__form">
                <div class="avatar">
                    <picture>     
                        <img class="avatarsvglogin" src="<?php echo base_url(); ?>/assets/avatar.svg" alt="">
                    </picture>
                </div>
                <form method="post" action="<?php echo base_url(); ?>Login/loginweb">

                    <div class="form-floating mb-2">
                        <input type="name" name="usuario" onkeyup="" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" name="password" onkeyup="" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Password</label>
                    </div>
                    <input class="btn btn-primary" type="submit" id="btnlogin" name="btnlogin" value="IDENTIFICARME">
                </form>
                <div class="forgot__pass__copy">
                    <p class="forgot__pass__text">¿Olvidaste tu contraseña? haz click <a href="">AQUI</a></p>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>