<script type="text/javascript">
		var url;
	var base_url = $('#base').val();
	var site = base_url + "request_order_selected/grid";
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah RO Selected',
				width: 380,
				height: 240,
				closed: true,
				cache: false,
				href: base_url+'request_order_selected/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'request_order_selected/save/add';
		}
		// end newData
		
		editData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if (row){
				$('#dialog').dialog({
					title: 'Edit RO Selected',
					width: 380,
					height: 240,
					closed: true,
					cache: false,
					href: base_url+'request_order_selected/edit/'+val,
					modal: true
				});
				
				$('#dialog').dialog('open');  
				url = base_url+'request_order_selected/save/edit';
			// }
		}
		//end editData
		
		deleteData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if(row){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'request_order_selected/delete/' + val,
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
			var col;
			//if (row.kd_fakultas != null) {
				col = '<a href="#" onclick="editData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:site
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					{
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
							newData();
						}
					}
				]
			});			
		});
		
	});
</script>
<table id="dg" title="Kelola Data logistic" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">Name 1</th>
			<th field="nama_kategori" sortable="true" width="150">Name 2</th>
			<th field="nama_sub_kategori" sortable="true" width="150">Name 3</th>
			<th field="kode_barang" sortable="true" width="150">Name 4</th>

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
