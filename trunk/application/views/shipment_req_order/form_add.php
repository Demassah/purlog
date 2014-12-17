<script>
// search text combo
		$(document).ready(function(){
			$("#ros").select2();
		});
</script>

<form id="form1" method="post" style="margin:10px">
	<div class="fitem">
		<label style="width:120px">ROS </label>:
		<select name="id_ro" id="ros">
			<?php
				foreach ($list as $l ) {
					echo '<option value="'.$l->id_ro.'">'.$l->id_ro.'</option> ';
				}
			?>
		</select>
		<input type="hidden" name="date_create" value="<?=date('Y-m-d')?>" placeholder="">
	</div>
</form>
	

