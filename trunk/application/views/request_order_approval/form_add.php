<link rel="stylesheet" type="text/css" href="<?=base_url();?>asset/select/select2.css"/>
	<script type="text/javascript" src="<?=base_url();?>asset/select/select2.js"></script>
<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
	<div class="fitem" >
		<label style="width:140px">Name </label>: 
		<input name="name" size="19" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Departement </label>: 
		<input name="kode_barang" size="19" value=" ">
	</div>
	<div class="fitem" >
		<label style="width:140px">Purpose </label>: 
		<select id="purpose" name="id_kategori" style="width:167px;">
			<option value="">Choose Purpose</option>
			<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Category </label>: 
		<select id="id_sub_kategori" name="id_sub_kategori" style="width:167px;">
			<option value="">Choose Category</option>
			<?=$this->mdl_prosedur->OptionSubKategori(array('value'=>$id_sub_kategori, 'id_kategori'=>$id_kategori));?>
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">Category </label>:
		<select id="id_item" name="id_item" style="width:167px;">
        <option value="AL">Alabama</option>
        <option value="WY">Wyoming</option>
    </select>
	</div>
	<div class="fitem" >
		<label style="width:140px">Ext Doc </label>: 
		<input name="kode_barang" size="19" value=" ">
	</div>
</form>
<script>
	 $(document).ready(function(){
		
		$('#purpose').change(function(){
			$('#id_sub_kategori').load(base_url+'prosedur/getSubKategoribyKategori/'+$('#purpose').val());
		});
		
	});

	 $(document).ready(function() {
		$("#id_item").select2();
		$("#id_sub_kategori").select2();
		$("#purpose").select2();
	});

</script>
