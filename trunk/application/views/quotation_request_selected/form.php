<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
	<div class="fitem" >
		<label style="width:140px">Vendor </label>: 
		<select id="purpose" name="id_kategori" style="width:167px;">
						<option value="">Choose Vendor</option>
						<option value="">Vendor A</option>			
		</select>	
	</div>
	<div class="fitem" >
		<label style="width:140px">TOP </label>: 
		<input name="name" size="19" value=" ">
	</div>

	<div class="fitem" >
		<label style="width:140px">Price</label>: 
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