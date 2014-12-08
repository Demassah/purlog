
<form id="form1" method="post" style="margin:10px">
<!-- 	<input type="hidden" name="kode" id="kode" value="<?=$kode?>"> -->
	<div class="fitem" >
		<label style="width:140px">Category </label>: 
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
		<label style="width:140px">Id Item </label>: 
		<select id="id_item" name="id_sub_kategori" style="width:167px;">
			<option value="">Choose Category</option>
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
	<div>
		<button type="button" id="tambah">Add</button>
	</div>
</form>


<br />
<div id="p" class="easyui-panel" title="Table List Item" style="padding:10px;background:#fafafa;" data-options="collapsible:true">
	<table id="dg" title="Request Order List" data-options="
				rownumbers:true,
				singleSelect:true,
				autoRowHeight:false,
				pagination:true,
				pageSize:30,
				fit:true,
				toolbar:'#toolbar',
				">
		<thead>
			<tr border="1px" style:{background:'#000000'>
				<th width="150">ID Detail</th>
				<th width="150">ID RO</th>
				<th width="150">ID Detail</th>
				<th width="150">ID RO</th>
				<th width="150">ID Item</th>
				<th width="50">Qty</th>
				<th width="150">Decsription</th>
			</tr>
		</thead>
		<tbody id="data">
			
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var arrayPenerimaan=[];
		$("#tambah").click(function(){
			var x = 0;
			var id_item = $('#id_item').val();
			var item_type = $('.item_type').val();
			var item_name = $('#item_name').val();
			var desc 			= $('.desc').val();
			$.each( arrayPenerimaan, function( key, value ) {
				if(id_item==value.id_item)
				{
					x = 1;
				}
			});
			if(x==1){
				alert('Kode barang tidak boleh sama');
			}else{
			$('#data').empty();
			arrayPenerimaan.push({
				id_item: id_item,
				item_type: item_type, 
				item_name: item_name,
				desc:desc
			});
			
			$.each( arrayPenerimaan, function( key, value ) {
				$("#data").append("<tr class='gradeX'><td>" + value.id_item +"</td><td>" + value.item_type +"</td><td>" + value.item_name +"</td><td>" + value.desc +"</td></tr>");
			});
			}
		});
</script>
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