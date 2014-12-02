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
		<label style="width:100px">Grup Menu</label>: 
		<input name="menu_group" size="20" value="<?=$menu_group?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Nama Menu </label>: 
		<input name="menu_name" size="30" value="<?=$menu_name?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Menu Parent </label>:
			<select id="menu_parent" name="menu_parent" style="width:200px;">
					<?=$this->mdl_prosedur->OptionMenuParent(array('value'=>$menu_id));?>
			</select>
	</div>
	<div class="fitem" >
		<label style="width:100px">URL </label>: 
		<input name="url" size="30" value="<?=$url?>" type="url">
	</div>
	<div class="fitem" >
		<label style="width:100px">Position </label>: 
		<input name="position" size="30" value="<?=$position?>">
	</div>
	<br>
	<div class="fitem" >
		<label style="width:100px">Hide</label>:		
		<input type="checkbox" name="hide" <?=$hide=='1'?'checked':''?>/>
	</div>
	<div class="fitem" >
		<label style="width:100px">Icon Class </label>: 
		<input name="icon_class" size="30" value="<?=$icon_class?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Policy </label>: 
		<input name="policy" size="30" value="<?=$policy?>">
	</div>	
	</div>
</form>
	

