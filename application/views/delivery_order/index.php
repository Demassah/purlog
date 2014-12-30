<table id="dg" title="Delivery Order List" data-options="
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
			<th field="id_do" sortable="true" width="120">ID Delivery Order</th>
			<th field="name_courir" sortable="true" width="120">Courir</th>
			<th field="date_create" sortable="true" width="125">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="180">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Delivery Order</td>
			<td>: 
					<select class="easyui-combobox" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>Search 1</option>
            <option>Search 2</option>
            <option>Search 3</option>	
            <option>Search 4</option>              
				</select>	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>
<script>
	var url;
	$(document).ready(function(){

		// search text combo
		$(document).ready(function(){
			$("#search").select2();
		});

		detailDO = function (val){
			$('#konten').panel({
				href: base_url+'delivery_order/detail/'+val,
			});
		}
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Delivery Order',
				width: 380,
				height: 130,
				closed: true,
				cache: false,
				href: base_url+'delivery_order/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'delivery_order/save/add';
		}
		// end newData
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
						$.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan ',
            });
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
		// save data
		doneData = function (val){
			if(confirm("Apakah yakin akan mengirim data ke Delivery '" + val + "'?")){
				var response = '';
				$.ajax({ type: "GET",
					 url: base_url+'delivery_order/doneData/' + val,
					 async: false,
					 success : function(response){
						var response = eval('('+response+')');
						if (response.success){
							$.messager.show({
								title: 'Success',
								msg: 'Data Berhasil Dikirim'
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
		// delete data
		deletedata = function (val){
			if(confirm("Apakah yakin akan Menghapus Data '" + val + "'?")){
				var response = '';
				$.ajax({ type: "GET",
					 url: base_url+'delivery_order/delete/' + val,
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
		//Done 
		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>19, 'policy'=>'DETAIL'))){?>
					col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailDO(\''+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>19, 'policy'=>'DELETE'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deletedata(\''+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>

			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"delivery_order/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>19, 'policy'=>'ADD'))){?>
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