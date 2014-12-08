<script>
	
	var url;
	$(document).ready(function(){

		// search text combo
		$(document).ready(function(){
			$("#SRO").select2();
		});

		back = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/index',
			});
		}


		detailSROlist = function (){
			$('#konten').panel({
				href: base_url+'delivery_order/detailSROlist',
			});
		}
				
		text = function(value, row, index){
			return '<input name="menu_name" size="30" value=" ">';
		}		

		$(function(){ // init
			$('#dgrtd').datagrid({url:"delivery_order/grid"});				
		});	

		
	});
</script>
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
		<input name="name" size="19" value=" "> Days
	</div>

</form>

<table id="dgrtd" title="Detail" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_form',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="kode_barang" sortable="true" width="120">ID </th>
			<th field="kode_barang" sortable="true" width="120">Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="480">Deskripsi</th>		
			<th field="text" align="center" width="75" formatter="text">Price</th>	
		</tr>
	</thead>
</table>
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