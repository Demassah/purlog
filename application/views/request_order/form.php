<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
<div class="fitem" >
		<label style="width:140px">Request Order Number </label>: 
		<input name="kode_barang" size="15" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Kategori Order </label>: 
		<select id="id_kategori" name="id_kategori" style="width:138px;">
					<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
			</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Requestor Name</label>: 
		<input name="kode_barang" size="15" value=" ">
	</div>
</form>
	

