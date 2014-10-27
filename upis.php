<?php include_once('header.php'); ?>

<script type="text/javascript">
    function selectSmjerGrupa(smjerId){
        if(smjerId.length > 0) {
            $.post("ajax/selectSmjerGrupa.php", {selectSmjerId: ""+smjerId+""}, function(data){
                $('#grupa').html(data);
            });

        }

    }

    function ispisCijena(grupaId){
        if(grupaId.length > 0) {
            $.post("ajax/ispisCijena.php", {ispisCijenaId: grupaId}, function(data){
                $('#cijena').val(data);

            });
        }

    }

    //DATEPICKER
    $(function() {
        $( "#datum" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    });

    //POPUST
    $(document).ready(function(){
        $("#popust").keyup(function(){
            var val1 = +$("#cijena").val();
            var val2 = +$("#popust").val();
            $("#ukupan-iznos").val(parseInt(val1 - (val1 * (val2 / 100) )).toFixed(2));
        });
    });
</script>

<div class="container">
    <div class="row">

    <?php

    $con=spajanje();

    //INSERT
    if(isset($_REQUEST['spremi'])){
        $datum_upis=$_REQUEST['datum'];
        $iznos=$_REQUEST['ukupan-iznos'];
        $polaznik_fk = $_REQUEST['polaznik'];
        $grupa_fk = $_REQUEST['grupa'];

        $sql="INSERT INTO upis (id_polaznik_fk, id_grupa_fk, datum_upis, iznos) VALUES ('{$polaznik_fk}','{$grupa_fk}','{$datum_upis}','{$iznos}')";

        if(zapis($con, $sql)){
            $info="Podaci uspješno spremljeni";
        }
        else{
            $info="Greška prilikom spremanja";
        }

        echo $info."<br><br>";

    }
    ?>



        <a href="polaznici.php" class="btn btn-info btn-sm" role="button">Povratak na polaznike</a>
        <a href="upis.php" class="btn btn-info btn-sm" role="button">Resetiraj polja</a><br><br>
        <div id="div-obrazac" class="col-xs-3">
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label>Polaznici</br>
                        <select id="polaznik" name="polaznik">
                        <?php
                        $sql1="SELECT * FROM polaznik";
                        $polaznici=upit($con,$sql1);

                        foreach ($polaznici as $polaznik) {
                            $tpl='<option value="';
                            $tpl.=$polaznik['ID_polaznik'];
                            $tpl.='">';
                            $tpl.=$polaznik['ime']." ".$polaznik['prezime'];
                            $tpl.="</option>";
                            echo $tpl;
                        }

                        ?>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label>Smjer</br>
                        <select id="smjer" name="smjer" onchange="selectSmjerGrupa(this.options[this.selectedIndex].value);">
                        <?php
                        $sql2="SELECT * FROM smjer";
                        $smjerovi=upit($con,$sql2);
                        echo '<option>Izaberite smjer</option>';
                        foreach ($smjerovi as $smjer) {
                            $tpl='<option value="';
                            $tpl.=$smjer['id_smjer'];
                            $tpl.='"';
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
                    <label>Grupa</br>
                        <select id="grupa" name="grupa" onchange="ispisCijena(this.options[this.selectedIndex].value);">
                            <option>Izaberite prvo smjer!</option>
                        <?php


                        ?>

                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label for="datum" class"control-label">Datum</label>
                    <input id="datum" name="datum" type="text" value="">
                </div>
                <div class="form-group">
                    <label for="cijena" class"control-label">Cijena</label>
                    <input id="cijena" name="cijena" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="popust" class"control-label">Popust</label>
                    <input id="popust" name="popust" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ukupan-iznos" class"control-label">Iznos</label>
                    <input id="ukupan-iznos" name="ukupan-iznos" type="text" value="" class="form-control">
                </div>
                <div class="form-group">
                    <input id="spremi" name="spremi" type="submit" value="Spremi" class="btn">
                </div>
        </div>

    </div>
</div>

<?php include_once('footer.php'); ?>