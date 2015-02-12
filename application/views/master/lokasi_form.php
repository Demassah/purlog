<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:120px">ID Lokasi </label>:
		<input name="id_lokasi" size="30" value="<?=$id_lokasi?>">
	</div>
	<div class="fitem" >
		<label style="width:120px">Type</label>:
		<select class="easyui-combobox" name="type" style="width:170px;">
			<option value="">-- Pilih --</option>
			<option value="1" <?= $type == '1'?'selected ="selected"':''; ?>>Fast Moving</option>
			<option value="2" <?= $type == '2'?'selected ="selected"':''; ?>>Slow Moving</option>
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:120px">Storage</label>:
		<select class="easyui-combobox" name="storage" style="width:170px;">
			<option value="">-- Pilih --</option>
			<option value="1" <?= $storage == '1'?'selected ="selected"':''; ?>>Available</option>
			<option value="2" <?= $storage == '2'?'selected ="selected"':''; ?>>Hold</option>
			<option value="3" <?= $storage == '3'?'selected ="selected"':''; ?>>Damage</option>
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:120px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

