<script>
		$(document).ready(function(){
			$(".select").select2();
		});
</script>
<?php date_default_timezone_set("Asia/Jakarta");?>
<form id="form2" method="post" style="margin:10px">
	<input type="hidden" name="user_id" value="<?php echo  $this->session->userdata('user_level_id')?>">
	<input type="hidden" name="date_create" value="<?php echo date('Y-m-d H:i:s');?>">
	<input type="hidden" name="status" value="1">
	<div class="fitem sub" >
		<label style="width:100px">ID PR </label>:
		<select id="id_pr"  name="id_pr" class="select" style="width:100px;">
			<?=$this->mdl_prosedur->OptionQrs(array('value'=>$id_pr));?>
		</select>
	</div>
</form>


