
<table id="dg_in" title="Purchase Order List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_in" sortable="true" width="100" >ID IN</th>
			<th field="ext_rec_no" sortable="true" width="130">Ext Rec No</th>
			<th field="type" sortable="true" width="70">Type</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="full_name" sortable="true" width="120">Requestor</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<script>
	var url;
	$(document).ready(function(){

		newData = function (){
			$('#dialog').dialog({
				title: 'Add inbound',
				width: 380,
				height: 180,
				closed: true,
				cache: false,
				href: base_url+'inbound/add',
				modal: true
			});

			$('#dialog').dialog('open');
			url = base_url+'inbound/save/add';
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
						$('#dg_in').datagrid('reload');		// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		//save
		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>41, 'policy'=>'DETAIL'))){?>
				col += '<a href="#" onclick="detail_in(\''+row.id_in+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>41, 'policy'=>'ACCESS'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="#(\''+row.id_in+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			<?}?>
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>41, 'policy'=>'DELETE'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="#(\''+row.id_in+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>

			return col;
		}

		detail_in = function (val,row,index){
      $('#konten').panel({
        href: base_url+'inbound/detail_in/' + val,
      });
    }

		done_po = function (val){
			if(confirm("Apakah yakin akan mengirim data ke  '" + val + "'?")){
				var response = '';
				$.ajax({ type: "GET",
					 url: base_url+'purchase_order/done_po/' + val,
					 async: false,
					 success : function(response){
						var response = eval('('+response+')');
						if (response.success){
							$.messager.show({
								title: 'Success',
								msg: 'Data Berhasil Dikirim'
							});
							// reload and close tab
							$('#dg_po').datagrid('reload');
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

		delete_po = function (val){
			if(confirm("Apakah yakin akan Menghapus data ke  '" + val + "'?")){
				var response = '';
				$.ajax({ type: "GET",
					 url: base_url+'purchase_order/delete_po/' + val,
					 async: false,
					 success : function(response){
						var response = eval('('+response+')');
						if (response.success){
							$.messager.show({
								title: 'Success',
								msg: 'Data Berhasil Dihapus'
							});
							// reload and close tab
							$('#dg_po').datagrid('reload');
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

		
		
		
		$(function(){
			$('#dg_in').datagrid({
				url:"<?=base_url()?>inbound/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_in').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>41, 'policy'=>'ADD'))){?>
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