<?php include_once('header.php'); ?>

<div class="container">
    <div class="row">

        <?php

        $con=spajanje();

        if(isset($_GET['id'])){
            $id_polaznik=$_GET['id'];
            $sql="SELECT * FROM polaznik WHERE id_polaznik={$id_polaznik}";
            $item=upit($con,$sql);
        }


        //INSERT
        if(isset($_REQUEST['spremi'])){
            $ime=$_REQUEST['ime'];
            $prezime=htmlspecialchars($_REQUEST['prezime']);
            $adresa=$_REQUEST['adresa'];
            $oib=$_REQUEST['oib'];

            $sql="INSERT INTO polaznik (ime, prezime, adresa, oib) VALUES ('{$ime}', '{$prezime}', '{$adresa}', '{$oib}')";

            if(zapis($con, $sql)){

                $polLastId = mysqli_insert_id($con); //pokupi zadnji id

                if(isset($_FILES)){

                    //INSERT MEDIA
                    if(($_FILES['slika']['size'] < 300000) && ($_FILES['slika']['type'] == 'image/jpeg')){
                        $broj='file-'.rand(100,999);
                        $nazivSlika=$broj.'-'.$_FILES['slika']['name'];

                        move_uploaded_file($_FILES['slika']['tmp_name'], "uploads/".$nazivSlika);

                        $sql5 = "INSERT INTO media (name) VALUES ('$nazivSlika')";

                        if(zapis($con,$sql5)){
                        $mediaLastId = mysqli_insert_id($con);
                        $sql6 = "INSERT INTO polaznik_media (id_polaznik_fk, id_media_fk) VALUES ('$polLastId', '$mediaLastId')";
                            if(zapis($con,$sql6)){
                            $info="Podaci uspješno spremljeni";
                            }
                        }
                    }
                    elseif($_FILES['slika']['size'] == 0){
                        //slika nije obvezna.
                    }
                    else{$nazivSlika = ''; echo "Samo slike manje od 300kb i jpeg!";}
                }
                else{
                    $info="Greška prilikom spremanja!";
                }
            }
        }

        //UPDATE
        if(isset($_REQUEST['uredi'])){
            $ime=$_REQUEST['ime'];
            $prezime=htmlspecialchars($_REQUEST['prezime']);
            $adresa=$_REQUEST['adresa'];
            $oib=$_REQUEST['oib'];

            $sql2="UPDATE polaznik SET ime='{$ime}', prezime='{$prezime}', adresa='{$adresa}', oib='{$oib}' WHERE id_polaznik=$id_polaznik";

            if(zapis($con, $sql2)){
                $info="Podaci uspješno spremljeni";
                $item=upit($con,$sql);
            }
            else{
                $info="Greška prilikom spremanja";
            }
        }

        if(isset($info)){
            echo "<p>$info</p>";
        }

        ?>



        <div id="div-obrazac" class="col-xs-3">
            <a href="polaznici.php" class="btn btn-info btn-sm" role="button">Povratak na polaznike</a>
            <a href="polaznik.php" class="btn btn-info btn-sm" role="button">Resetiraj polja</a><br><br>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="ime" class"control-label">Ime</label>
                    <input id="ime" name="ime" type="text" value="<?php if(isset($item)) echo $item[0]['ime']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="prezime" class"control-label">Prezime</label>
                    <input id="prezime" name="prezime" type="text" value="<?php if(isset($item)) echo $item[0]['prezime']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="adresa" class"control-label">Adresa</label>
                    <input id="adresa" name="adresa" type="text" value="<?php if(isset($item)) echo $item[0]['adresa']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="oib" class"control-label">OIB</label>
                    <input id="oib" name="oib" type="text" value="<?php if(isset($item)) echo $item[0]['oib']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="slika" class"control-label">Slika</label>
                    <input id="slika" name="slika" type="file" value="" class="form-control">
                </div>
                <div class="form-group">
                    <?php if(isset($_GET['id'])): ?>
                        <input id="uredi" name="uredi" type="submit" value="Uredi" class="btn">
                    <?php else: ?>
                        <input id="spremi" name="spremi" type="submit" value="Spremi" class="btn">
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
    
<?php include_once('footer.php'); ?>