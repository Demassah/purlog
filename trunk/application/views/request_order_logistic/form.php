<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
<!-- 	<div class="fitem" >
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
	</div> -->
	<br>
	<div class="fitem" >
		<label style="width:100px">Field </label>: 
		<input name="kode_barang" size="15" value=" ">
	</div>
</form>
	

