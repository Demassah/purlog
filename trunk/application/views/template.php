<script>
	var url;
	$(document).ready(function(){
		
		newData = function (){ 
			$('#dialog').dialog('open').dialog('setTitle','Tambah Data Fakultas');  
			$('#form1').form('clear');  
			url = base_url+'fakultas/save/add';
		}
		// end newData
		
		editData = function (){
			var row = $('#dg').datagrid('getSelected');
			$('#form1').form('clear');  

			if (row){
				$('#dialog').dialog('open').dialog('setTitle','Edit Data Fakultas');
				$('#form1').form('load', row);
				$('#kode').val(row.kd_fakultas);
				url = base_url+'fakultas/save/edit';
			}
		}
		//end editData
		
		deleteData = function (){
			var row = $('#dg').datagrid('getSelected');
			if(row){
				if(confirm("Apakah yakin akan menghapus data '" + row.nama_fakultas + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'fakultas/delete/' + row.kd_fakultas,
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
			}
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
		
		
		
		$(function(){
			$('#dg').datagrid({url:"<?=base_url()?>fakultas/grid"});
		});
		
	});
</script>
<table id="dg" title="Kelola User" data-options="
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
			<th field="kd_fakultas" sortable="true" width="80">Kode Fakultas</th>
			<th field="nama_fakultas" sortable="true" width="100">Nama Fakultas</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
		<a href="#" onclick="newData();" class="easyui-linkbutton" iconCls="icon-add" plain="true">Add</a>
		<a href="#" onclick="editData();" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Edit</a>
		<a href="#" onclick="deleteData();" class="easyui-linkbutton" iconCls="icon-remove" plain="true">Delete</a>
	</div>
	<div>
		Date From: <input name="tgl_akhir" class="easyui-datebox" style="width:80px">
		To: <input class="easyui-datebox" style="width:80px">
		Language: 
		<select class="easyui-combobox" panelHeight="auto" style="width:100px">
			<option value="java">Java</option>
			<option value="c">C</option>
			<option value="basic">Basic</option>
			<option value="perl">Perl</option>
			<option value="python">Python</option>
		</select>
		<a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a>
	</div>
</div>


<!-- AREA untuk Form Add/EDIT >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  -->
	<div id="dialog" class="easyui-dialog" style="width:400px;height:150px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<form id="form1" method="post">
			<input type="hidden" name="kode" id="kode" value="">
			<div class="fitem" >
				<label style="width:100px">Kode Fakultas :</label>
				<input name="kd_fakultas" class="easyui-validatebox" size="10" required="true">
			</div>
			<div class="fitem" >
				<label style="width:100px">Nama Fakultas :</label>
				<input name="nama_fakultas" class="easyui-validatebox" size="30" required="true">
			</div>
		</form>
	</div>

	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData()">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dialog').dialog('close')">Cancel</a>
	</div>