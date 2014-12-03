var url;
	$(document).ready(function(){
	
		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Kategori',
				width: 380,
				height: 130,
				closed: true,
				cache: false,
				href: base_url+'kategori/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'kategori/save/add';
		}
		// end newData
		
		editData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if (row){
				$('#dialog').dialog({
					title: 'Edit Kategori',
					width: 380,
					height: 130,
					closed: true,
					cache: false,
					href: base_url+'kategori/edit/'+val,
					modal: true
				});
				
				$('#dialog').dialog('open');  
				url = base_url+'kategori/save/edit';
			// }
		}
		//end editData
		
			detailData = function (){
			$('#dialog').dialog({
				title: 'Detail Picking',
				//style:{background:'#d4d4d4'},
				//width: $(window).width() * 0.8,
				//height: $(window).height() * 0.99,
				width: 625,
				height: 600,
				closed: true,
				cache: false,
				href: base_url+'pros/detail/',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'pros/save';
		}
		// end newData
		
		deleteData = function (val){
			// var row = $('#dg').datagrid('getSelected');
			// if(row){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'kategori/delete/' + val,
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
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'edit'))){?>
					col = '<a href="#" onclick="editData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Edit</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DELETE'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DETAIL'))){?>
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			//}
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "pros/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'ADD'))){?>
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