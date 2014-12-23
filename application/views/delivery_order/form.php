<script>
	// search text combo
		$(document).ready(function(){
			$("#DO").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="id_user" value="<?php echo  $this->session->userdata('user_level_id')?>">
	<input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s ');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem" >
		<label style="width:100px">Courir </label>: 
			<select id="DO" name="id_courir" style="width:200px;">
						<option>Pilih</option>
							<?=$this->mdl_prosedur->OptionCourir(array('value'=>$id_courir));?>
						       
				</select>	
	</div>

</form>
	

