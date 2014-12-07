<script>
	
	var url;
	$(document).ready(function(){

		detailDelivered = function (){
			$('#dialog').dialog({
				title: 'Detail Barang Shipment Request Order',
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
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Submit</a>';			
					//col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Pending</a>';			
					//col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Received</a>';			
			return col;
		}

		text = function(value, row, index){
			return '<input name="menu_name" size="30" value=" ">';
		}
		

		$(function(){ // init
			$('#dg').datagrid({url:"delivered/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>	
			<tr> 
				<td>
						&nbsp;&nbsp;<a href="#" onclick="detailDelivered()" class="easyui-linkbutton" iconCls="icon-detail-form">Detail Barang SRO</a>
				</td>
			</tr>			
		</table>
	</div>
</div>

<table id="dg" title="Receive Barang SRO" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Request Order</th>
			<th field="kode_barang" sortable="true" width="100">ID Ext Document</th>
			<th field="kode_barang" sortable="true" width="120">ID Barang</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Nama Barang</th>
			<th field="kode_barang" sortable="true" width="50">Qty Request</th>
			<th field="kode_barang" sortable="true" width="50">Qty Received</th>
			<th field="kode_barang" sortable="true" width="50">Qty Pending</th>
			<th field="kode_barang" sortable="true" width="100">Requestor </th>
			<th field="kode_barang" sortable="true" width="100">Date Create</th>
			<th field="kode_barang" sortable="true" width="100">Note</th>	
			<!--<th field="action" align="center" formatter="actiondetail" width="120">Aksi</th>-->
		</tr>
	</thead>
</table>



