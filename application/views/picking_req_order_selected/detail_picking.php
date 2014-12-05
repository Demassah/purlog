<script>
	
	var url;
	$(document).ready(function(){

		available = function (){
			$('#dialog').dialog({
				title: 'Picking Request Order Selected',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/available',
				modal: true
			});
			 
			$('#dialog').dialog('open');
		}

		lock = function (){
			$('#dialog').dialog({
				title: 'Lock Picking Request Order Selected',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/lock',
				modal: true
			});
			 
			$('#dialog').dialog('open');
		}
		

		pending = function (){
			$('#dialog').dialog({
				title: 'Pending Picking Request Order Selected',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/pending',
				modal: true
			});
			 
			$('#dialog').dialog('open');
		}

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
		
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Alocate</a>';			
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
			<th field="nama_sub_kategori" sortable="true" width="545">Deskripsi</th>	
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="available()" class="easyui-linkbutton" iconCls="icon-ok">Picking</a>
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a>
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a>
							&nbsp;&nbsp;<a href="#" onclick="purchase()" class="easyui-linkbutton" iconCls="icon-purchase-form">Purchase Request</a>
					</td> 
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-all">Alocate All</a></td>
			</tr>			
		</table>
	</div>
</div>


