<script>
	$(document).ready(function(){
		
		$('#id_kategori').change(function(){
			$('#id_sub_kategori').load(base_url+'prosedur/getSubKategoribyKategori/'+$('#id_kategori').val());
		});
		
	});
</script>

<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<div class="fitem" >
		<label style="width:100px">Kategori </label>: 
		<select id="id_kategori" name="id_kategori" style="width:200px;">
			<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:100px">Sub Kategori </label>: 
		<select id="id_sub_kategori" name="id_sub_kategori" style="width:200px;">
			<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
		</select>	
	</div>
	<br>
	<div class="fitem" >
		<label style="width:100px">Kode Barang </label>: 
		<input name="kode_barang" size="15" value="<?=$kode_barang?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Nama Barang </label>: 
		<input name="nama_barang" size="30" value="<?=$nama_barang?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Satuan </label>: 
		<select id="id_satuan" name="id_satuan" style="width:100px;">
			<?=$this->mdl_prosedur->OptionSatuan(array('value'=>$id_satuan));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:100px">Type</label>:
		<select class="easyui-combobox" name="type" style="width:170px;">
			<option value="">-- Pilih --</option>
			<option value="1" <?= $type == '1'?'selected ="selected"':''; ?>>Fast Moving</option>
			<option value="2" <?= $type == '2'?'selected ="selected"':''; ?>>Slow Moving</option>
			<option value="3" <?= $type == '3'?'selected ="selected"':''; ?>>New Item</option>		
		</select></li>
	</div>
	<div class="fitem" >
		<label style="width:100px">Status</label>:
		<input type="checkbox" name="status" <?=$status=='1'?'checked':''?>/> Aktif
	</div>
</form>
	

