<script>
	
	var url;
	$(document).ready(function(){

		detail = function (){
			$('#dialog').dialog({
				title: 'List PROS Locked',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}

		loadingList = function (){
			$('#dialog').dialog({
				title: 'Loading List',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/loadingList',
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

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
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
			<th field="nama_sub_kategori" sortable="true" width="650">Deskripsi</th>		
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_detail" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">List PROS Locked</a>
							&nbsp;&nbsp;<a href="#" onclick="loadingList()" class="easyui-linkbutton" iconCls="icon-list">Loading List</a>
					</td>							
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-all">Uncheckout All</a>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-loading">Loading</a>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-ok">Done SRO</a>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-purchase-form">Checking Sheet</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


