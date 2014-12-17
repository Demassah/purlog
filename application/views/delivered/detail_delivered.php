
<table id="dg" title="Detail Shipment Request Order" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true"></th>
			<th field="id_detail_pros" sortable="true" width="120">ID Detail ROS</th>
			<th field="id_detail_ros" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="qty" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
		</tr>
	</thead>
</table>

<script>
	var url;
	var id_sro ='<?php echo $id_sro;?>';
	var id_ro ='<?php echo $id_ro;?>';
	$(document).ready(function(){

	
		$(function(){ // init
			$('#dg').datagrid({url:"delivered/detail_grid_sro/<?=$id_ro?>/<?=$id_sro?>"});	
		});	



		
	});
</script>