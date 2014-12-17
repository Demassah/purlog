<script>
	var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Barang',
				width: 400,
				height: 225,
				closed: true,
				cache: false,
				href: base_url+'barang/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'barang/save/add';
		}
		// end newData
		
		editData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if (row){
				$('#dialog').dialog({
					title: 'Edit ',
					width: 400,
					height: 225,
					closed: true,
					cache: false,
					href: base_url+'barang/edit/'+val,
					modal: true
				});
				
				$('#dialog').dialog('open');  
				url = base_url+'barang/save/edit';
			// }
		}
		//end editData
		
		deleteData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if(row){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'barang/delete/' + val,
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
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>8, 'policy'=>'edit'))){?>
					col = '<a href="#" onclick="editData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
			<?}?>
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>8, 'policy'=>'DELETE'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>
			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>barang/grid"
			});
		});
		
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>8, 'policy'=>'ADD'))){?>
					{
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
							newData();
						}
					},
					<?}?>

					<?if($this->mdl_auth->CekAkses(array('menu_id'=>8, 'policy'=>'PRINT'))){?>
					{
						iconCls:'icon-pdf',
						text:'Export PDF',
						handler:function(){
							window.open('<?=base_url().'#/#'?>');
						}
					},
					<?}?>

					<?if($this->mdl_auth->CekAkses(array('menu_id'=>8, 'policy'=>'IMPORT'))){?>
					{
						iconCls:'icon-upload',
						text:'Import Excel',
						handler:function(){
							importDialog();
						}
					}
					<?}?>					
				]
			});			
		});
		
	});
</script>
<table id="dg" title="Kelola Data Barang" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="nama_kategori" sortable="true" width="150">Kategori</th>
			<th field="nama_sub_kategori" sortable="true" width="150">Sub Kategori</th>
			<th field="kode_barang" sortable="true" width="150">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="150">Nama Barang</th>
			<th field="action" align="center" formatter="actionbutton" width="100">Aksi</th>
		</tr>
	</thead>
</table>

<!-- AREA untuk Form MENU >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
<div id="dialog-menu" class="easyui-dialog" style="width:400px;height:150px" closed="true" buttons="#dlg-buttons-menu">
	<div id="dlg-buttons-menu">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveMenu()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog-menu').dialog('close')">Cancel</a>
	</div>
</div>