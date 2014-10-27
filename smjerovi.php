<?php include_once('header.php'); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $("table").tablesorter({
            widthFixed: true,
            headers: {
                2:{
                    sorter: false
                },
                3:{
                    sorter: false
                }
            }
        });
    });

    function trazi(upit){
        if(upit.length == 0) {
            $('#rezultat').hide();
        } else {
            $.post("ajax/trazilicaSmjerovi.php", {naziv: ""+upit+""}, function(data){
                if(data.length >0) {
                    $('#rezultat').show();
                    $('#rezultat').html(data);
                }
            });
        }
    }
</script>

<div class="container-fluid">
    <div class="row">

        <?php

        $con=spajanje();
        $sql="SELECT * FROM smjer";
        $smjerovi=upit($con,$sql);

        if(isset($_GET['obrisi'])){
            $id=$_GET['id'];
            $sql2="DELETE FROM smjer WHERE id_smjer=$id";
            if(zapis($con, $sql2)){
                $info="Smjer obrisana!";
                $smjerovi=upit($con,$sql);
            }
            else{
                $info="Greška prilikom brisanja";
            }
        }

        if(isset($info)){
            echo "<p>$info</p>";
        }

        ?>

    </div>
    <div class="col-lg-2">
        <div class="col-xs-7">

            <a href="polaznici.php" class="btn btn-info btn-sm" role="button">Povratak na popis polaznika</a>
            <p></p>
            <a href="smjer.php" class="btn btn-info btn-sm" role="button">Dodaj smjer</a>
            <p>-----</p>
            <a href="grupe.php" class="btn btn-info btn-sm" role="button">Popis grupa</a>
            <p>-----</p>
            <p></p>
            <a href="index.php?odjava=da" class="btn btn-danger btn-sm" role="button">Odjava</a>
            <p></p>

        </div>
    </div>
    <div class="col-lg-8">
        <table cellspacing="1" class="tablesorter">
            <thead>
                <tr>
                <th>Naziv</th>
                <th>Ur broj</th>
                <th>Uredi</th>
                <th>Obriši</th>
                </tr>
            </thead>

        <?php

        echo "<tbody>";

        foreach ($smjerovi as $smjer) {
            $tpl="<tr>";
            $tpl.="<td>".$smjer['naziv']."</td>";
            $tpl.="<td>".$smjer['ur_broj']."</td>";
            $tpl.='<td><a href="smjer.php?id='.$smjer['id_smjer'].'">Uredi</a></td>';
            $tpl.='<td><a href="smjerovi.php?id='.$smjer['id_smjer'].'&obrisi=da" onclick="return confirm(\'Jeste li sigurni\')">Obriši</a></td>';
            $tpl.="</tr>";
            $tpl.="</tr>";

            echo $tpl;

        }
        echo "</tbody>";
        ?>
        </table>
    </div>
    <div class="col-lg-2">
        <form action="" method="post">
            <p>
                <label for="trazilica">Pretražite smjerove po nazivu</label>
                <input onkeyup="trazi(this.value);" id="trazilica" name="trazilica" type="text" value="" />
            </p>
            <div id="rezultat" style="display:none;"></div>
        </form>
    </div>
</div>

<?php include_once('footer.php'); ?>