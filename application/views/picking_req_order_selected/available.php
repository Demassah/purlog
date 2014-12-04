<script>
	
	var url;
	$(document).ready(function(){

		detail = function (){
			$('#dialog').dialog({
				title: 'Detail Picking Request Order Selected',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'picking_req_order_selected/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
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
			url = base_url+'departement/save/add';
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
			url = base_url+'departement/save/add';
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
		
		actionAvailable = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp;| &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">ReAlocate</a>';		
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
			toolbar:'#toolbar_available',
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th field="nama_kategori" sortable="true" width="120">ID Detail ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="kode_barang" sortable="true" width="80">Qty</th>
			<th field="kode_barang" sortable="true" width="300">Deskripsi</th>	
			<th field="action" align="center" formatter="actionAvailable" width="160">Aksi</th>
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_available" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">Detail</a> 
							&nbsp;&nbsp;<a href="#" onclick="lock()" class="easyui-linkbutton" iconCls="icon-login">Lock</a> 
							&nbsp;&nbsp;<a href="#" onclick="pending()" class="easyui-linkbutton" iconCls="icon-redo">Pending</a></td> 
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-add">ReAlocate All</a> 
					&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-login">Lock SRO</a>
					&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-login">Print Picklist</a></td>
			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

