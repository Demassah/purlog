<script>
	$(document).ready(function(){

		tutup = function (){
	      $('#dialog_kosong').dialog('close');      
	    }

		save_detail = function(){			
			$.ajax({
			  url: base_url+"transfer/save_transfer/",
			  method: 'POST',
			  data: {
						kode 			: $('#kode').val(),
						id_transfer 	: $('#id_transfer').val(),
						id_stock 		: $('#id_stock').val(),
						kode_barang 	: $('#kode_barang').val(),
						qty 			: $('#qty').val(),
						price 			: $('#price').val(),
						id_lokasi		: $('#id_lokasi').val(),
						status			: $('#status').val(),
					},
			  success : function(response, textStatus){
				//alert(response);
				var response = eval('('+response+')');
				if(response.success){
					$.messager.show({
						title: 'Success',
						msg: 'Data Berhasil Disimpan'
					});
					$('#dialog_kosong').dialog('close');
					$('#dtgrd').datagrid('reload');
				}else{
					$.messager.show({
						title: 'Error',
						msg: response.msg
					});
				}
			  }
			});
		}

		
	});
</script>

<input type="hidden" name="kode" id="kode" value="<?=$id_detail_transfer?>">
<input type="hidden" name="id_transfer" id="id_transfer" 	value="<?=$id_transfer?>">
<input type="hidden" name="id_stock" 	id="id_stock" 		value="<?=$id_stock?>">
<input type="hidden" name="kode_barang" id="kode_barang" 	value="<?=$kode_barang?>">
<input type="hidden" name="price" 		id="price" 			value="<?=$price?>">
<input type="hidden" name="status" 		id="status" 		value="<?=$status?>">

<form id="form1" method="post" style="margin:10px">
	
	<div class="fitem" >
		<label style="width:100px">ID Detail Transfer </label>: 
		<a><?=$id_detail_transfer?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">ID Transfer </label>: 
		<a><?=$id_transfer?></a>
	</div>
	<div class="fitem" >
		<label style="width:100px">ID Stock </label>:
		<a><?=$id_stock?></a>
	</div>
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
<div align="right">
  <a href="#" class="easyui-linkbutton" onclick="save_detail();" iconCls="icon-save" plain="false">Save</a>
  <a href="#" class="easyui-linkbutton" onclick="tutup();" iconCls="icon-cancel" plain="false">Cancel</a>
  &nbsp;&nbsp;&nbsp;
</div>

