<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:120px">Kategori </label>:
		<input name="nama_kategori" size="30" value="<?=$nama_kategori?>">
	</div>
	<div class="fitem" hidden="true" >
		<label style="width:120px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

