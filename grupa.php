<?php include_once('header.php'); ?>

<div class="container">
    <div class="row">

        <?php

        //Spajanje na bazu

        $con=spajanje();

        if(isset($_GET['id'])){
            $id_grupa=$_GET['id'];
            $sql="SELECT * FROM grupa WHERE id_grupa={$id_grupa}";
            $item=upit($con,$sql);
        }

        //INSERT
        if(isset($_REQUEST['spremi'])){
            $oznaka=$_REQUEST['oznaka'];
            $cijena=$_REQUEST['cijena'];
            $id_smjer_fk=$_REQUEST['smjer'];
            $max_br_pol=$_REQUEST['max_br_pol'];
            $min_br_pol=$_REQUEST['min_br_pol'];

            $sql="INSERT INTO grupa (oznaka, cijena, id_smjer_fk, max_br_pol, min_br_pol) VALUES ('{$oznaka}', '{$cijena}', '{$id_smjer_fk}','{$max_br_pol}', '{$min_br_pol}')";

            if(zapis($con, $sql)){
                $info="Podaci uspješno spremljeni";
            }
            else{
                $info="Greška prilikom spremanja";
            }

        }

        //UPDATE
        if(isset($_REQUEST['uredi'])){
            $oznaka=$_REQUEST['oznaka'];
            $cijena=($_REQUEST['cijena']);
            $id_smjer_fk=$_REQUEST['smjer'];
            $max_br_pol=$_REQUEST['max_br_pol'];
            $min_br_pol=$_REQUEST['min_br_pol'];

            $sql2="UPDATE grupa SET oznaka='{$oznaka}', cijena='{$cijena}', id_smjer_fk='{$id_smjer_fk}', max_br_pol='{$max_br_pol}, min_br_pol='{$min_br_pol}' WHERE id_grupa=$id_grupa";

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
            <a href="grupa.php" class="btn btn-info btn-sm" role="button">Resetiraj polja</a><br><br>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="oznaka" class"control-label">Oznaka</label>
                    <input id="oznaka" name="oznaka" type="text" value="<?php if(isset($item)) echo $item[0]['oznaka']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cijena" class"control-label">Cijena</label>
                    <input id="cijena" name="cijena" type="text" value="<?php if(isset($item)) echo $item[0]['cijena']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Smjer</br>
                        <select id="smjer" name="smjer">

                        <?php
                        $sql3="SELECT * FROM smjer";
                        $smjerovi=upit($con,$sql3);

                        foreach ($smjerovi as $smjer) {
                            $tpl='<option value="';
                            $tpl.=$smjer['id_smjer'];
                            $tpl.='"';
                            if(isset($_GET['id']) && $smjer['id_smjer']==$item[0]['id_smjer_fk']){
                                $tpl.=' selected="selected"';
                            }
                            $tpl.='>';
                            $tpl.=$smjer['naziv'];
                            $tpl.="</option>";
                            echo $tpl;
                        }

                        ?>

                        </select>
                    </label>

                </div>
                <div class="form-group">
                    <label for="max_br_pol" class"control-label">Maksimalni broj polaznika</label>
                    <input id="max_br_pol" name="max_br_pol" type="text" value="<?php if(isset($item)) echo $item[0]['max_br_pol']; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="min_br_pol" class"control-label">Minimalni broj polaznika</label>
                    <input id="min_br_pol" name="min_br_pol" type="text" value="<?php if(isset($item)) echo $item[0]['min_br_pol']; ?>" class="form-control">
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