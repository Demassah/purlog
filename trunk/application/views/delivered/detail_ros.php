<script>
	
	var url;
	$(document).ready(function(){

		sro = function (){
			$('#konten').panel({
				href:base_url+'delivered/sro'
			});
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';			
			return col;
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"picking_req_order_selected/grid"});	
		});	
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="sro()" class="easyui-linkbutton" iconCls="icon-list">Shipment Request Order</a>
					</td> 
			</tr>		
		</table>
	</div>
</div>

<table id="dtgrd" title="Detail Request Order Selected" data-options="
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
			<th field="kode_barang" sortable="true" width="120">Qty</th>
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
			<!--<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>-->
		</tr>
	</thead>
</table>



