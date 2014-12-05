<script>
	
	var url;
	$(document).ready(function(){

		purchase = function (){
			$('#dialog').dialog({
				title: 'Purchase Request',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/purchase',
				modal: true
			});
			 
			$('#dialog').dialog('open');
		}

		add_detail_pr = function (){
			$('#dialog').dialog({
				title: 'Add Purchase Request',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/add_detail_pr',
				modal: true
			});			 
			$('#dialog').dialog('open');
		}
		
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
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="665">Deskripsi</th>	
		</tr>
	</thead>
</table>
<div id="toolbar_pending" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr>
					<td> &nbsp;&nbsp;<a href="#" onclick="add_detail_pr()" class="easyui-linkbutton" iconCls="icon-add">Add Detail PR</a>	</td>   
			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

