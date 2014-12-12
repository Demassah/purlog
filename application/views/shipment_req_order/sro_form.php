<script>
// search text combo
		$(document).ready(function(){
			$("#ros").select2();
		});
</script>

<form id="form1" method="post" style="margin:10px">
	<?php foreach ($list as $l ) {
		echo '<input type="hidden" name="user_id" id="id_user" value="'.$l->user_id.'" />';
		echo '<input type="hidden" name="date_create" value="'.date('Y-m-d H:m:s').'"';
		echo '<div class="fitem">';
		echo '<label style="width:120px">ROS </label>:';
		echo '<select id="ros" name="id_ro" style="width:200px;">';
		echo '<option value="'.$l->id_ro.'">'.$l->id_ro.'</option>';
		echo '</select>';
		echo '</div>';
	}?>
</form>
	

