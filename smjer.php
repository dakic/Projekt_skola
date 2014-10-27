<?php include_once('header.php'); ?>

<div class="container">
    <div class="row">

        <?php

        $con=spajanje();

        if(isset($_GET['id'])){
            $id_smjer=$_GET['id'];
            $sql="SELECT * FROM smjer WHERE id_smjer={$id_smjer}";
            $item=upit($con,$sql);
        }

        //INSERT
        if(isset($_REQUEST['spremi'])){
            $naziv=$_REQUEST['naziv'];
            $ur_broj=$_REQUEST['ur_broj'];

            $sql="INSERT INTO smjer (naziv, ur_broj) VALUES ('{$naziv}', '{$ur_broj}')";

            if(zapis($con, $sql)){
                $info="Podaci uspješno spremljeni";
            }
            else{
                $info="Greška prilikom spremanja";
            }

        }

        //UPDATE
        if(isset($_REQUEST['uredi'])){
            $naziv=$_REQUEST['naziv'];
            $ur_broj=$_REQUEST['ur_broj'];

            $sql2="UPDATE smjer SET naziv='{$naziv}', ur_broj='{$ur_broj}' WHERE id_smjer=$id_smjer";

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
            <a href="smjer.php" class="btn btn-info btn-sm" role="button">Resetiraj polja</a><br><br>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="naziv" class"control-label">Naziv</label>
                    <input id="naziv" name="naziv" type="text" value="<?php if(isset($item)) echo $item[0]['naziv']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ur_broj" class"control-label">Ur broj</label>
                    <input id="ur_broj" name="ur_broj" type="text" value="<?php if(isset($item)) echo $item[0]['ur_broj']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <?php if(isset($_GET['id'])): ?>
                        <input id="uredi" name="uredi" type="submit" value="Uredi" class="btn">
                    <?php else: ?>
                        <input id="spremi" name="spremi" type="submit" value="Spremi" class="btn">
                    <?php endif; ?>
                </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>