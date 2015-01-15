<script>
	// search text combo
		$(document).ready(function(){
			$(".select").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form2" method="post" style="margin:10px">
	<input type="hidden" name="id_pr" value="<?php echo $id_pr;?>">
	<input type="hidden" name="date_create" value="<?php echo date('Y-m-d');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem" >
		<label style="width:100px">Vendor </label>: 
			<select class="select" name="id_vendor" style="width:200px;">
						<!-- <option>Pilih</option> -->
						<?php
						foreach ($list as $l) {
						 	echo "<option value=".$l->id_vendor.">".$l->name_vendor."</option>";
						 } 
						?>
						       
				</select>	
	</div>
	<div class="fitem">
		<label style="width:100px">TOP</label>:
		<input type="text" name="top" class="top" placeholder="TOP" />
	</div>

</form>
<script type="text/javascript">
var top = $(".top").val();
$(".top").numericInput();
</script>

