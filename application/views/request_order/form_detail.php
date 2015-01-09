<script>
	$(document).ready(function(){

		tutup = function (){
	      $('#dialog_kosong').dialog('close');      
	    }

		save_detail = function(){			
			$.ajax({
			  url: base_url+"request_order/save_detail/",
			  method: 'POST',
			  data: {
						id_ro : $('#id_ro').val(),
						ext_doc_no 		: $('#ext_doc_no').val(),
						user_id 		: $('#user_id').val(),
						date_create 	: $('#date_create').val(),
						kode_barang 	: $('#kode_barang').val(),
						qty				: $('#qty').val(),
						barang_bekas	: $('#barang_bekas').val(),
						note 			: $('#note').val(),
						status 			: $('#status').val(),
						status_delete	: $('#status_delete').val(),
						id_sro 			: $('#id_sro').val(),
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
					$('#dg').datagrid('reload');
				}else{
					$.messager.show({
						title: 'Error',
						msg: response.msg
					});
				}
			  }
			});
		}

		//text combo
		$(document).ready(function(){
			//$("#id_kategori").select2();
			//$("#id_sub_kategori").select2();
			$("#kode_barang").select2();
		});

		$('#dg_addDetail').datagrid({
		});

		$('#id_kategori').change(function(){
			$('#id_sub_kategori').load(base_url+'prosedur/getSubKategoribyKategori/'+$('#id_kategori').val());
		});
		
		$('#id_sub_kategori').change(function(){
			$('#kode_barang').load(base_url+'prosedur/getBarangbySubkat/'+$('#id_sub_kategori').val());
		});
		
	});
</script>


<div style="margin:15px; ">
	<input type="hidden" name="id_ro" id="id_ro" value="<?=$id_ro?>">
	<input type="hidden" name="ext_doc_no" id="ext_doc_no" value="<?=$ext_doc_no?>">
	<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>">
	<input type="hidden" name="date_create" id="date_create" value="<?=$date_create?>">

	<div class="fitem" >
		<label style="width:150px">ID Request Order </label>:
		<b><?=$id_ro?></b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Ext Document No </label>:
		<b><?=$ext_doc_no?></b> 
	</div>
	<div class="fitem" >
		<label style="width:150px">Requestor </label>:
		<b><?=$full_name?></b>
	</div>	
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Date Create </label>:
		<b><?=$date_create?></b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Kategori </label>:
			<select id="id_kategori" name="id_kategori" style="width:200px;">
					<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
			</select>	
	</div>
	<div class="fitem" >
		<label style="width:150px">Sub Kategori  </label>:
			<select id="id_sub_kategori" name="id_sub_kategori" style="width:200px;">
				<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
			</select>
	</div>
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Barang </label>:
		<select id="kode_barang" name="kode_barang" style="width:300px;">
				<?=$this->mdl_prosedur->OptionBarang(array('value'=>$kode_barang, 'id_sub_kategori'=>$id_sub_kategori));?>
		</select>
	</div>
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Qty </label>:
		<input name="qty" id="qty" size="10" value="<?=$qty?>" class="easyui-validatebox textbox" data-options="required:false">
	</div>
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Barang Bekas </label>:
			<select id="barang_bekas" name="barang_bekas">
				<option value="">- Pilih -</option>
				<option value="1" <?= $barang_bekas == 'Ada'?'selected ="selected"':''; ?>>Ada</option>
				<option value="2" <?= $barang_bekas == 'Tidak Ada'?'selected ="selected"':''; ?>>Tidak Ada</option>
			</select>
	</div>
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Note </label>:
		<textarea name="note" id="note" cols="36" rows="5"><?=$note?></textarea>
	</div>
	<div class="fitem" align="left">
		<label style="width:300px;">*Keterangan: </label>
		<label style="width:300px;">- Note di isi jika dibutuhkan </label>
		<label style="width:300px;">- Jika tidak di isi beri tanda (-) </label>
	</div>

	<!-- Hidden -->

	<div class="fitem" hidden="True">
		<label style="width:150px;vertical-align:top;">Status </label>:
		<input id="status" name="status" size="10" value="<?=$status?>">
	</div>
	<div class="fitem" hidden="True">
		<label style="width:150px;vertical-align:top;">Status delete </label>:
		<input id="status_delete" name="status_delete" size="10" value="<?=$status_delete?>">
	</div>
	<div class="fitem" hidden="True">
		<label style="width:150px;vertical-align:top;">ID SRO </label>:
		<input id="id_sro" name="id_sro" size="10" value="<?=$id_sro?>">
	</div>
</div>

<div align="right">
  <a href="#" class="easyui-linkbutton" onclick="save_detail();" iconCls="icon-save" plain="false">Save</a>
  <a href="#" class="easyui-linkbutton" onclick="tutup();" iconCls="icon-cancel" plain="false">Cancel</a>
  &nbsp;&nbsp;&nbsp;
</div>