<script>
	
	var url;
	$(document).ready(function(){

		detailDO = function (){
			$('#dialog').dialog({
				title: 'Detail Delivery Order',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}

		detailSROlist = function (){
			$('#dialog').dialog({
				title: 'List Detail SRO',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/detailSROlist',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'departement/save/add';
		}
				
		actiondetail = function(value, row, index){
			var col='';
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailSROlist(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';			
			return col;
		}

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
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
			toolbar:'#toolbar_list_sro',
		">		
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="nama_barang" sortable="true" width="100">ID SRO</th>
			<th field="nama_barang" sortable="true" width="100">ID ROS</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_barang" sortable="true" width="120">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>	
			<th field="action" align="center" formatter="actiondetail" width="140">Aksi</th>
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>
<div id="toolbar_list_sro" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
					<td>&nbsp;&nbsp;<a href="#" onclick="detailDO()" class="easyui-linkbutton" iconCls="icon-detail">Detail Delivery Order</a></td>						
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						<label style="width:120px">SRO </label>:

						<select id="#" name="#" style="width:200px;">
						</select>
						&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-add">Add All</a>
				</td>
			</tr>			
		</table>
	</div>
</div>


