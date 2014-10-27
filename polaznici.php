<?php include_once('header.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){
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
</script>

<div class="container-fluid">
    <div class="row">

        <?php

        $con=spajanje();
        $sql="SELECT * FROM polaznik";
        $polaznici=upit($con,$sql);

        if(isset($_GET['obrisi'])){
            $id=$_GET['id'];
            $sql2="DELETE FROM polaznik WHERE id_polaznik=$id";
            if(zapis($con, $sql2)){
                $info="Korisnik obrisan!";
                $polaznici=upit($con,$sql);
            }
            else{
                $info="Greška prilikom brisanja";
            }
        }

        if(isset($info)){
            echo "<p>$info</p>";
        }

        ?>

        <script type="text/javascript">
            function trazi(upit){
                if(upit.length == 0) {
                    $('#rezultat').hide();
                } else {
                    $.post("ajax/trazilicaPolaznici.php", {prezime: ""+upit+""}, function(data){
                        if(data.length >0) {
                            $('#rezultat').show();
                            $('#rezultat').html(data);
                        }
                    });
                }
            }
        </script>
    </div>
    <div class="col-lg-2">
        <div class="col-xs-7">

            <a href="polaznik.php" class="btn btn-info btn-sm" role="button">Dodaj polaznika</a>
            <p></p>
            <a href="upis.php" class="btn btn-info btn-sm" role="button">Upiši polaznika</a>
            <p></p>
            <a href="smjer.php" class="btn btn-info btn-sm" role="button">Dodaj smjer</a>
            <p></p>
            <a href="grupa.php" class="btn btn-info btn-sm" role="button">Dodaj grupu</a>
            <p>-----</p>
            <a href="smjerovi.php" class="btn btn-info btn-sm" role="button">Popis smjerova</a>
            <p></p>
            <a href="grupe.php" class="btn btn-info btn-sm" role="button">Popis grupa</a>
            <p>-----</p>
            <a href="ispis.php" class="btn btn-info btn-sm" role="button">Ispiši polaznika</a>
            <p></p>
            <a href="index.php?odjava=da" class="btn btn-danger btn-sm" role="button">Odjava</a>
            <p></p>

        </div>
    </div>
    <div class="col-lg-8">
        <table cellspacing="1" class="tablesorter">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Adresa</th>
                    <th>OIB</th>
                    <th>Uredi</th>
                    <th>Obriši</th>
                </tr>
            </thead>

            <?php

            echo "<tbody>";

            foreach ($polaznici as $polaznik) {

                $tpl="<tr>";
                $tpl.="<td>".$polaznik['ime']."</td>";
                $tpl.="<td>".$polaznik['prezime']."</td>";
                $tpl.="<td>".$polaznik['adresa']."</td>";
                $tpl.="<td>".$polaznik['oib']."</td>";
                $tpl.='<td><a href="polaznik.php?id='.$polaznik['ID_polaznik'].'">Uredi</a></td>';
                $tpl.='<td><a href="polaznici.php?id='.$polaznik['ID_polaznik'].'&obrisi=da" onclick="return confirm(\'Jeste li sigurni\')">Obriši</a></td>';
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
                <label for="trazilica">Pretražite polaznike po prezimenu</label><br>
                <input onkeyup="trazi(this.value);" id="trazilica" name="trazilica" type="text" value="" />
            </p>
            <div id="rezultat" style="display:none;"></div>
        </form>
    </div>
</div>

<?php include_once('footer.php'); ?>