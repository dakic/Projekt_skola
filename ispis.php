<?php include_once('header.php'); ?>

    <div class="container">
    	<div class="row">

    		<?php

    		$con=spajanje();

            if(isset($_GET['obrisi'])){
                $id=$_GET['id'];
                $grupa=$_GET['grupa'];
                $sql="DELETE FROM upis WHERE id_polaznik_fk=$id AND id_grupa_fk=$grupa";
                if(zapis($con, $sql)){
                    $info="Korisnik izbrisan iz grupe!";
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
		    function selectPolaznikGrupe(polaznikId){
		        if(polaznikId.length > 0) {
		        	$.post("ajax/selectPolaznikGrupe.php", {selectPolaznikId: ""+polaznikId+""}, function(data){
		        		$('.tablesorter').html(data);
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


			</script>


			<div id="div-obrazac">
                <a href="polaznici.php" class="btn btn-info btn-sm" role="button">Povratak na polaznike</a><br><br>
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label>Polaznici<br>
							<select id="polaznik" name="polaznik" onchange="selectPolaznikGrupe(this.options[this.selectedIndex].value);">
							<option>Izaberite polaznika!</option>
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
                </form>
                </div>

        <div>
            <div class="col-lg-8">
                <table cellspacing="1" class="tablesorter">

				</table>
			</div>

    	</div>
    </div>

<?php include_once('footer.php'); ?>