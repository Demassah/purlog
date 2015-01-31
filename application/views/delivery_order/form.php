<script>
	// search text combo
		$(document).ready(function(){
			$("#DO").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
	<input type="hidden" name="date" value="<?php echo $date;?>">
	<input type="hidden" name="status" value="<?php echo $status;?>">
	<div class="fitem" >
		<label style="width:100px">Courir </label>: 
			<select id="DO" name="id_courir" style="width:200px;">
							<?=$this->mdl_prosedur->OptionCourir(array('value'=>$id_courir));?>
						       
				</select>	
	</div>

</form>
	

