<script>
		$(document).ready(function(){
			$(".select").select2();
		});
</script>

<form id="form_qrs" method="post" style="margin:10px">
	<input type="hidden" name="user_id" value="<?=$user_id;?>">
	<input type="hidden" name="date_create" value="<?=$date_create;?>">
	<input type="hidden" name="status" value="<?=$status;?>">
	<input type="hidden" name="status_qrs" value ="1">
	<div class="fitem sub">
		<label style="width:100px">ID PR</label>:
		<select name="id_pr" class="select" >
			<?=$this->mdl_prosedur->OptionQrs();?>
		</select>
	</div>
</form>


