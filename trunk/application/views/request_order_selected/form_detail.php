<script>
	$(document).ready(function(){

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

<form id="form1" method="post" style="margin:10px;">
	<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
		<div style="margin:15px; ">
			<input type="hidden" name="id_ro" id="id_ro" value="<?=$id_ro?>">
			<input type="hidden" name="ext_doc_no" id="ext_doc_no" value="<?=$ext_doc_no?>">
			<input type="hidden" name="qty" id="ext_doc_no" value="<?=$qty?>">
			<input type="hidden" name="barang_bekas" id="ext_doc_no" value="<?=$barang_bekas?>">
			<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>">
			<input type="hidden" name="date_create" id="date_create" value="<?=$date_create?>">
			<input type="hidden" name="note" id="note" value="<?=$note?>">
			<input type="hidden" name="status" id="status" value="<?=$status?>">
			<input type="hidden" name="status_delete" id="status_delete" value="<?=$status_delete?>">
			<input type="hidden" name="id_sro" id="id_sro" value="<?=$id_sro?>">

			<div class="fitem" >
				<label style="width:150px">ID Request Order </label>:
				<b><?=$id_ro?></b>
			</div>
			<div class="fitem" >
				<label style="width:150px">Ext Document No </label>:
				<b><?=$ext_doc_no?></b> 
			</div>
			
			<div class="fitem" >
				<label style="width:150px">Kategori </label>:
					<select id="id_kategori" name="id_kategori" style="width:200px;" <?if($type == 3){}else{echo "disabled";} ?> >
						<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
					</select>	
			</div>
			<div class="fitem" >
				<label style="width:150px">Sub Kategori  </label>:
					<select id="id_sub_kategori" name="id_sub_kategori" style="width:200px;" <?if($type == 3){}else{echo "disabled";} ?> >
						<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
					</select>
			</div>
			<div class="fitem">
				<label style="width:150px;vertical-align:top;" >Barang </label>:
					<select id="kode_barang" name="kode_barang" style="width:200px;" <?if($type == 3){}else{echo "disabled";} ?> >
						<?=$this->mdl_prosedur->OptionBarang(array('value'=>$kode_barang, 'id_sub_kategori'=>$id_sub_kategori));?>
					</select>
			</div>
			<div class="fitem">
				<label style="width:150px;vertical-align:top;">Qty </label>:
				<b><?=$qty?></b>
			</div>
			<div class="fitem" hidden="True">
				<label style="width:150px;vertical-align:top;">Barang Bekas </label>:
				<b><?=$barang_bekas?></b>
			</div>
			<div class="fitem" >
				<label style="width:150px">Requestor </label>:
				<b><?=$user_id?></b>
			</div>	
			<div class="fitem">
				<label style="width:150px;vertical-align:top;">Date Create </label>:
				<b><?=$date_create?></b>
			</div>
			<div class="fitem">
				<label style="width:150px;vertical-align:top;">Note </label>:
				<b><?=$note?></b>
			</div>

			<!-- Hidden -->

			<div class="fitem" hidden="True">
				<label style="width:150px;vertical-align:top;">Status </label>:
				<b><?=$status?></b>
			</div>
			<div class="fitem" hidden="True">
				<label style="width:150px;vertical-align:top;">Status delete </label>:
				<b><?=$status_delete?></b>
			</div>
			<div class="fitem" hidden="True">
				<label style="width:150px;vertical-align:top;">ID SRO </label>:
				<b><?=$id_sro?></b>
			</div>
		</div>
</form>