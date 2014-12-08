<script>
	var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Otoritas Menu',
				width: 380,
				height: 160,
				closed: true,
				cache: false,
				href: base_url+'otoritas/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'otoritas/save/add';
		}
		// end newData
		
		editData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if (row){
				$('#dialog').dialog({
					title: 'Edit Otoritas Menu',
					width: 380,
					height: 160,
					closed: true,
					cache: false,
					href: base_url+'otoritas/edit/'+val,
					modal: true
				});
				
				$('#dialog').dialog('open');  
				url = base_url+'otoritas/save/edit';
			// }
		}
		//end editData
		
		deleteData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if(row){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'otoritas/delete/' + val,
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
		
		menu = function (val){
			$('#dialog-menu').dialog({
				title: 'Kelola Menu',
				width: $(window).width() * 0.6,
				//width: 600,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'otoritas/menu/'+val,
				modal: true
			});
			
			$('#dialog-menu').dialog('open');  
			url = base_url+'otoritas/menu_save';
		}
		//end menu
		
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
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>2, 'policy'=>'DETAIL'))){?>			
				col = '<a href="#" onclick="menu(\''+row.user_level_id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Menu</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>2, 'policy'=>'EDIT'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="editData(\''+row.user_level_id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>2, 'policy'=>'DELETE'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.user_level_id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>otoritas/grid"
			});
		});
		
		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				kd_pt : $('#s_kd_pt').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>2, 'policy'=>'ADD'))){?>
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
<table id="dg" title="Kelola Otoritas Menu" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="user_level_id" sortable="true" width="150" hidden="true">Kode </th>
			<th field="level_name" sortable="true" width="350">Nama Otoritas</th>
			<th field="level" sortable="true" width="350">Prioritas</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>

<!-- AREA untuk Form MENU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
<div id="dialog-menu" class="easyui-dialog" style="width:400px;height:150px" closed="true" buttons="#dlg-buttons-menu">
<div id="dlg-buttons-menu">
	<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">Save</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-menu').dialog('close')">Cancel</a>
</div>