<script>
	var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah SRO',
				width: 380,
				height: 150,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'shipment_req_order/save/add';
		}
		// end newData
		
		detailData = function (){
			$('#dialog').dialog({
				title: 'List Detail SRO',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/detail',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'shipment_req_order/save/add';
		}
		
		saveData = function(){
			
			$('#form1').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					//alert(result);
					var result = eval('('+result+')');
					if (result.success){
						$('#dialog').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');		// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		//end saveData
		
		actionbutton = function(value, row, index){
			var col='';
			//<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'edit'))){?>
			//		col = '<a href="#" onclick="editData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
			//<?}?>

			//<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){?>
			//		col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			//<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>13, 'policy'=>'DETAIL'))){?>
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"shipment_req_order/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>13, 'policy'=>'ADD'))){?>
					{
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
							newData();
						}
					}
				<?}?>	
				]
			});			
		});
		
	});
</script>
<table id="dg" title="Kelola Data SRO" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar'
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
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>


<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="900" border="0">
		  <tr>
		  <!--<td>PROS</td>
			<td>: 
				<select id="#" name="#" style="width:200px;">
					
				</select>
			</td>-->
			<td>ROS</td>
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

<!-- AREA untuk Form MENU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
<div id="dialog-menu" class="easyui-dialog" style="width:400px;height:150px" closed="true" buttons="#dlg-buttons-menu">
<div id="dlg-buttons-menu">
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">Save</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-menu').dialog('close')">Cancel</a>
</div>