<script>
	var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Menu',
				width: 400,
				height: 300,
				closed: true,
				cache: false,
				href: base_url+'menu/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'menu/save/add';
		}
		// end newData
		
		editData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if (row){
				$('#dialog').dialog({
					title: 'Edit Menu',
					width: 400,
					height: 300,
					closed: true,
					cache: false,
					href: base_url+'menu/edit/'+val,
					modal: true
				});
				
				$('#dialog').dialog('open');  
				url = base_url+'menu/save/edit';
			// }
		}
		//end editData
		
		deleteData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if(row){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'menu/delete/' + val,
						 async: false,
						 success : function(response){
							var response = eval('('+response+')');
							if (response.success){
								$.messager.show({
									title: 'Success',
									msg: 'Data Berhasil Dihapus'
								});
								// reload and close tab
								$('#dg').datagrid('reload');
							} else {
								$.messager.show({
									title: 'Error',
									msg: response.msg
								});
							}
						 }
					});
				}
			// }
		}
		//end deleteData 
		
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
			//if (row.kd_fakultas != null) {
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>23, 'policy'=>'EDIT'))){?>
				col = '<a href="#" onclick="editData(\''+row.menu_id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
			<?}?>	

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>23, 'policy'=>'DELETE'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.menu_id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>menu/grid"
			});
		});
		
		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				menu_name : $('#s_menu_name').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>23, 'policy'=>'ADD'))){?>
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
<table id="dg" title="Kelola Menu" data-options="
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
			<th field="menu_id" sortable="true" width="150" hidden="true">ID</th>
			<!--<th field="menu_group" sortable="true" width="100">Group Menu</th>-->
			<th field="menu_name" sortable="true" width="200">Nama Menu</th>
			<!--<th field="menu_parent" sortable="true" width="80">Menu Parent</th>-->
			<th field="url" sortable="true" width="120">URL Controller</th>
			<th field="position" sortable="true" width="80">Position</th>
			<!--<th field="hide" sortable="true" width="50">hide</th>-->
			<th field="icon_class" sortable="true" width="100">Icon</th>
			<th field="policy" sortable="true" width="450">Policy</th>
			<th field="action" align="center" formatter="actionbutton" width="100">Aksi</th>
		</tr>
	</thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
		
	</div>
	<div class="fsearch">
		<table width="700" border="0">
		  <tr>
			<td>Nama Menu</td>
				<td>: 
					<input name="s_menu_name" id="s_menu_name" size="25">
				</td>
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

