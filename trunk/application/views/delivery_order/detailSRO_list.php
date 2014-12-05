<script>
	
	var url;
	$(document).ready(function(){

		listSRO = function (){
			$('#dialog').dialog({
				title: 'List Shipment Request Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/listSRO',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}

		detailDO = function (){
			$('#dialog').dialog({
				title: 'Detail Delivery Order',
				//style:{background:'#d4d4d4'},
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/detail/',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'pros/save';
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailSROlist(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
					col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Cancel</a>';			
			return col;
		}
		

		$(function(){ // init
			$('#dtgrd').datagrid({url:"delivery_order/grid"});	
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
			<th field="nama_sub_kategori" sortable="true" width="600">Deskripsi</th>		
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detailDO()" class="easyui-linkbutton" iconCls="icon-detail">Detail Delivery Order</a>
							&nbsp;&nbsp;<a href="#" onclick="listSRO()" class="easyui-linkbutton" iconCls="icon-detail">List Shipment Request Order</a>							
					</td>					
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						<label style="width:120px">SRO </label>:

						<select id="#" name="#" style="width:200px;">
						</select>
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-print">Print</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


