<?php include_once('header.php'); ?>

<?php

// Session i Cookie

if(isset($_GET['odjava'])){
    if(isset($_SESSION['logiran'])){
        unset($_SESSION['logiran']);
    }
    if(isset($_COOKIE['remember'])){
        setcookie("remember", "", time()-3600);
    }
}

//Provjera korisničkog imena i šifre

if(isset($_REQUEST['login'])){
    $username=htmlspecialchars($_REQUEST['username']);
    $pass=htmlspecialchars($_REQUEST['pass']);

    $con=spajanje();
    $sql="SELECT * FROM korisnik WHERE username='{$username}' AND pass='{$pass}'";

    $korisnik=upit($con,$sql);

    if(count($korisnik)>0){
        $_SESSION['logiran']='da';
        $_SESSION['id']=$korisnik[0]['id_korisnik'];
        if(isset($_REQUEST['rememberme'])){
            setcookie("remember","kuki",time()+3600);
        }
        header('location: polaznici.php');
    }
    else{
        $info="Greška prilikom prijave!";
    }
}

if(isset($info)) echo $info;

?>
<div class="container">
    <div class="col-xs-4"></div>
    <div id="div-obrazac" class="col-xs-4">
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="username" class"control-label">Username(admin)</label>
                <input id="username" name="username" type="text" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="pass" class"control-label">Pass(123)</label>
                <input id="pass" name="pass" type="password" value="" class="form-control">
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label for="rememberme" class"control-label">Remember Me</label>
                    <input id="rememberme" name="rememberme" type="checkbox" value="" class="checkbox">
                </div>
            </div>
            <div class="form-group">
                <input id="login" name="login" type="submit" value="Log In" class="btn btn-info btn-sm">
            </div>
    </div>
    <div class="col-xs-4">
    </div>
</div>

<?php include_once('footer.php'); ?>