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
		
		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_pending',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Request Order</th>
			<th field="kode_barang" sortable="true" width="120">ID Ext Document</th>
			<th field="kode_barang" sortable="true" width="120">ID Barang</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Nama Barang</th>
			<th field="kode_barang" sortable="true" width="120">Qty</th>
			<th field="kode_barang" sortable="true" width="120">Requestor </th>
			<th field="kode_barang" sortable="true" width="120">Date Create</th>
			<th field="kode_barang" sortable="true" width="120">Note</th>			
		</tr>
	</thead>
</table>
<div id="toolbar_pending" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a>
							&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a></td> 
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-add">Purchase Request</a></td> 
			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

