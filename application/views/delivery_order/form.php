<script>
	// search text combo
		$(document).ready(function(){
			$("#DO").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="id_user" value="1">
	<input type="hidden" name="date" value="<?php echo date('Y-m-d h:i');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem" >
		<label style="width:100px">Courir </label>: 
			<select id="DO" name="id_courir" style="width:200px;">
						<option>Pilih</option>
						<?php 
							foreach ($list as $l) {
								echo "<option value =".$l->id_courir.">".$l->name_courir."</option>";
							}?>
						       
				</select>	
	</div>

</form>
	

