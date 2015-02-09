<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:120px">Nama Kategori </label>:
		<input name="name_courir" size="30" value="<?=$name_courir?>">
	</div>
	<div class="fitem" >
		<label style="width:120px">Contact </label>:
		<input name="contact" size="30" value="<?=$contact?>">
	</div>
	<div class="fitem" >
		<label style="width:120px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

