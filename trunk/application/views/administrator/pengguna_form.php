<script>
	$(document).ready(function(){
		$('#kd_fakultas').change(function(){
			$('#kd_prodi').load(base_url+'prosedur/getProdibyFakultas/'+$('#kd_fakultas').val());
		});
	});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:100px">Username </label>: 
		<input name="user_name" size="30" value="<?=$user_name?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Password </label>: 
		<input name="passwd" size="30" value="" type="password">
	</div>
	<div class="fitem" >
		<label style="width:100px">Otoritas </label>: 
		<select id="user_level_id" name="user_level_id" style="width:200px;">
				<?=$this->mdl_prosedur->OptionOtoritas(array('value'=>$user_level_id));?>
		</select>	
	</div>
	<br>
	<div class="fitem" >
		<label style="width:100px">Nama Lengkap </label>: 
		<input name="full_name" size="30" value="<?=$full_name?>">
	</div>
	<div class="fitem" >
		<label style="width:100px;">Departemen </label>: 
			<select id="departement_id" name="departement_id" style="width:200px;">
					<?=$this->mdl_prosedur->OptionDepartement(array('value'=>$departement_id));?>
			</select>				
	</div>	
	</div>
</form>
	

