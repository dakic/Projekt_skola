<?php include_once('header.php'); ?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $("table").tablesorter({
            widthFixed: true,
            headers: {
                4:{
                    sorter: false
                },
                5:{
                    sorter: false
                }
            }
        });
    });

    function trazi(upit){
        if(upit.length == 0) {
            $('#rezultat').hide();
        } else {
            $.post("ajax/trazilicaGrupe.php", {oznaka: ""+upit+""}, function(data){
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
        $sql="SELECT * FROM grupa";
        $grupe=upit($con,$sql);

        if(isset($_GET['obrisi'])){
            $id=$_GET['id'];
            $sql2="DELETE FROM grupa WHERE id_grupa=$id";
            if(zapis($con, $sql2)){
                $info="Grupa obrisana!";
                $grupe=upit($con,$sql);
            }
            else{
                $info="Greška prilikom spremanja";
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
            <a href="grupa.php" class="btn btn-info btn-sm" role="button">Dodaj grupu</a>
            <p>-----</p>
            <a href="smjerovi.php" class="btn btn-info btn-sm" role="button">Popis smjerova</a>
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
                    <th>Oznaka</th>
                    <th>Cijena [HRK]</th>
                    <th>Maksimalni broj polaznika</th>
                    <th>Minimani broj polaznika</th>
                    <th>Uredi</th>
                    <th>Obriši</th>
                </tr>
            </thead>

        <?php

        echo "<tbody>";

        foreach ($grupe as $grupa) {
            $tpl="<tr>";
            $tpl.="<td>".$grupa['oznaka']."</td>";
            $tpl.="<td>".$grupa['cijena']."</td>";
            $tpl.="<td>".$grupa['max_br_pol']."</td>";
            $tpl.="<td>".$grupa['min_br_pol']."</td>";
            $tpl.='<td><a href="grupa.php?id='.$grupa['id_grupa'].'">Uredi</a></td>';
            $tpl.='<td><a href="grupe.php?id='.$grupa['id_grupa'].'&obrisi=da" onclick="return confirm(\'Jeste li sigurni\')">Obriši</a></td>';
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
                <label for="trazilica">Pretražite grupe po oznaci</label>
                <input onkeyup="trazi(this.value);" id="trazilica" name="trazilica" type="text" value="" />
            </p>
            <div id="rezultat" style="display:none;"></div>
        </form>
    </div>
</div>

<?php include_once('footer.php'); ?>