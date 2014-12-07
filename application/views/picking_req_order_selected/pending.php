<script>
	
	var url;
	$(document).ready(function(){

		purchase = function (){
			$('#konten').panel({
				href:base_url+'picking_req_order_selected/purchase'
			});
		}
		
		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
		});	
		
	});
</script>

<div id="toolbar_pending" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a>
							&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
		</table>
	</div>
</div>

<table id="dtgrd" title="Pending Picking Request Order Selected" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
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
			<th field="nama_sub_kategori" sortable="true" width="645">Deskripsi</th>	
		</tr>
	</thead>
</table>


