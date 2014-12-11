<script type="text/javascript">
	 $(document).ready(function() {
		$(".select").select2();
	});

</script>
<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
	<div class="fitem" >
		<label style="width:140px">Category </label>: 
		<select name="id_kategori" style="width:167px;">
			<option value="">-- Pilih --</option>
			<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Category </label>: 
		<select class="select"  name="id_sub_kategori" style="width:167px;">
			<option value="">-- Pilih --</option>
			<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Id Item </label>: 
		<select class="select"  name="id_sub_kategori" style="width:167px;">
			<option value="">-- Pilih --</option>
			<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Qty </label>: 
		<input name="kode_barang" size="19" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Description </label>: 
		<textarea name="kode_barang" size="19" value=" "></textarea>
	</div>
</form>
