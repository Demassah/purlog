
<div id="p" class="easyui-panel" title="Form Detail Item" style="padding:10px;background:#fafafa;" data-options="collapsible:true">
    <form id="form1" method="post" style="margin:10px">
			<input type="hidden" name="kode" id="kode" value="<?=$kode?>">
			<div class="fitem">
				<label style="width:100px">Id Item</label>:
				<input name="id_item" id="id_item" size="15" value="">
			</div>
			<div class="fitem" >
				<label style="width:100px">Item Type</label>: 
				<select id="id_kategori" class="item_type" name="id_kategori" style="width:200px;">
							<?=$this->mdl_prosedur->OptionKategori(array('value'=>$id_kategori));?>
					</select>	
			</div>
			<div class="fitem">
				<label style="width:100px">Item Name</label>:
				<input name="id_item" size="15" id="item_name" value="">
			</div>
			<div class="fitem" >
				<label style="width:100px">Description </label>: 
				<textarea  name="kode_barang" class="desc"></textarea>
			</div>
			<input type='button' name='tambah' class='button' id="tambah" value='Tambah' style="width:100px;">
		</form>
</div>
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
			<tr>
				<th width="150">ID Item</th>
				<th width="150">Item Type</th>
				<th width="150">Item Name</th>
				<th width="150">Description</th>
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