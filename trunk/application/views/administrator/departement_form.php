<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:120px">Nama Departement </label>:
		<input name="departement_name" size="30" value="<?=$departement_name?>">
	</div>
	<div class="fitem" hidden="true" >
		<label style="width:120px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

