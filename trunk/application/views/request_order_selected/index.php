<script>
	var url;
	$(document).ready(function(){

		newData = function (){
			$('#dialog').dialog({
				title: 'Add Request Order',
				width: 380,
				height: 130,
				closed: true,
				cache: false,
				href: base_url+'request_order_selected/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order_selected/save/add';
		}
		// end newData
		
		detailROS = function (){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_selected/detailROS/'
			});

		}
	
		
		actionbutton = function(value, row, index){
			var col='';
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DETAIL'))){?>
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailROS(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			<?}?>			
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order_selected/grid"
			});
		});
		
		
	});
</script>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Search</td>
			<td>: 
				<input name="#" size="30" value=" ">
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>
<table id="dg" title="Request Order Selected List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			">
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="kode_barang" sortable="true" width="100">ID RO</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_barang" sortable="true" width="120">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>