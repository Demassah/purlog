<script>
	
	var url;
	$(document).ready(function(){
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dtgrd').datagrid('validateRow', editIndex)){
				$('#dtgrd').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}

		text = function(value, row, index){
			return '<input name="menu_name" size="30" value=" ">';
		}
		
		$(function(){ // init
			$('#dtgrd').datagrid({url:"document_receive/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="kode_barang" sortable="true" width="60">ID DR</th>
			<th field="kode_barang" sortable="true" width="60">ID PO</th>
			<th field="kode_barang" sortable="true" width="60">ID PR</th>
			<th field="jumlah" sortable="true" width="70">ID Vendor</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_sub_kategori" sortable="true" width="50">Purpose</th>
			<th field="nama_barang" sortable="true" width="100">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="text" width="120">Qty</th>
		</tr>
	</thead>
</table>