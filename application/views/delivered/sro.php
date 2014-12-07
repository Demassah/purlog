<script>
	
	var url;
	$(document).ready(function(){

		detail_ros = function (){
			$('#konten').panel({
				href:base_url+'delivered/detail_ros'
			});
		}

		receive = function (){
			$('#konten').panel({
				href:base_url+'delivered/receive'
			});
		}

		detailDelivered = function (){
			$('#dialog').dialog({
				title: 'Detail Barang Shipment Request Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivered/detail',
				modal: true
			});			 
			$('#dialog').dialog('open');
		}

		actiondetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="detailDelivered(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
			return col;
		}
		

		$(function(){ // init
			$('#dg').datagrid({url:"picking_req_order_selected/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail_ros()" class="easyui-linkbutton" iconCls="icon-detail-form">Detail ROS</a>

							&nbsp;&nbsp;<a href="#" onclick="receive()" class="easyui-linkbutton" iconCls="icon-ok">Receive</a>
					</td> 
			</tr>		
		</table>
	</div>
</div>

<table id="dg" title="Shipment Request Order" data-options="
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
			<th field="nama_sub_kategori" sortable="true" width="540">Deskripsi</th>	
			<th field="action" align="center" formatter="actiondetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>

