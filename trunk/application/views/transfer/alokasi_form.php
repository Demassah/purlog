<form id="form1" method="post" style="margin:10px">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
	<input type="hidden" name="kode_barang" id="kode_barang" 	value="<?=$kode_barang?>">
	<input type="hidden" name="price" 		id="price" 			value="<?=$price?>">
	<input type="hidden" name="status" 		id="status" 		value="<?=$status?>">

	<div class="fitem" >
		<label style="width:100px">Kode Barang </label>:
		<a><?=$kode_barang?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">Nama Barang </label>:
		<a><?=$nama_barang?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">Qty Stock</label>:
		<a><?=$qty_stock?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">Qty Transfer</label>:
		<input name="qty" id="qty" size="5" value="<?=$qty?>">
	</div>
	<div class="fitem" >
		<label style="width:100px">Price</label>:
		<a><?=$price?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">Lokasi Stock</label>:
		<a><?=$lokasi_stock?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">Lokasi Transfer</label>:
		<select id="id_lokasi" name="id_lokasi" style="width:100px;">
			<?=$this->mdl_prosedur->OptionLokasi(array('value'=>$id_lokasi));?>
		</select>
		
	</div>
	<div class="fitem" hidden="true">
		<label style="width:100px">Status</label>:
		<a><?=$status?></a>
		
	</div>
</form>
<br>
<!-- <div align="right">
  <a href="#" class="easyui-linkbutton" onclick="save_detail();" iconCls="icon-save" plain="false">Save</a>
  <a href="#" class="easyui-linkbutton" onclick="tutup();" iconCls="icon-cancel" plain="false">Cancel</a>
  &nbsp;&nbsp;&nbsp;
</div>
 -->
