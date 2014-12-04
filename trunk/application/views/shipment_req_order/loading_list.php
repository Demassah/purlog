<script>
	
	var url;
	$(document).ready(function(){

		detailData = function (){
			$('#dialog').dialog({
				title: 'List Detail SRO',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'shipment_req_order/save/add';
		}

		checkout = function (){
			$('#dialog').dialog({
				title: 'Checkout',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/checkout',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}
					
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">UnCheckout</a>';			
			return col;
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
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="kode_barang" sortable="true" width="300">Deskripsi</th>	
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detailData()" class="easyui-linkbutton" iconCls="icon-detail">List Detail SRO</a>
							&nbsp;&nbsp;<a href="#" onclick="checkout()" class="easyui-linkbutton" iconCls="icon-add">Checkout</a>
					</td>							
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-add">Loading Sheet</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


