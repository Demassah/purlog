<script>
	
	var url;
	$(document).ready(function(){

		detail_ros = function (){
			$('#dialog').dialog({
				title: 'Detail ROS',
				//style:{background:'#d4d4d4'},
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivered/detail_ros/',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'pros/save';
		}

		detailDelivered = function (){
			$('#dialog').dialog({
				title: 'Detail Barang SRO',
				//style:{background:'#d4d4d4'},
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivered/detail/',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'pros/save';
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailDelivered(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
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
			<th field="nama_sub_kategori" sortable="true" width="540">Deskripsi</th>	
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail_ros()" class="easyui-linkbutton" iconCls="icon-detail-form">Detail ROS</a>
					</td> 
			</tr>		
		</table>
	</div>
</div>


