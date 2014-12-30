
<table id="dg_po" title="Purchase Order List" data-options="
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
			<th field="id_po" sortable="true" width="100" >ID PO</th>
			<th field="id_pr" sortable="true" width="130">ID Purchase Request</th>
			<th field="id_ro" sortable="true" width="70">ID RO</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="departement_name" sortable="true" width="120">Departement</th>
			<th field="purpose" sortable="true" width="70">Purpose</th>
			<th field="cat_req" sortable="true" width="130">Cat Request</th>
			<th field="ext_doc_no" sortable="true" width="100">Ext Document No</th>
			<th field="ETD" sortable="true" width="100">ETD</th>
			<th field="date_create" sortable="true" width="120">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<script>
	var url;
	$(document).ready(function(){

		newData = function (){
			$('#dialog').dialog({
				title: 'Add Purchase Order',
				width: 380,
				height: 130,
				closed: true,
				cache: false,
				href: base_url+'purchase_order/add',
				modal: true
			});

			$('#dialog').dialog('open');
			url = base_url+'purchase_order/save/add';
		}
		// end newData
		saveData = function(){
			
			$('#form1').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					alert(result);
					var result = eval('('+result+')');
					if (result.success){
						$('#dialog').dialog('close');		// close the dialog
						$('#dg_po').datagrid('reload');		// reload the user data
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
		detail_po = function (value){
			$('#dialog_kosong').dialog({
				title: 'Detail Purchase Order / Detail Vendor',
				width: 580,
				height: 490,
				closed: true,
				cache: false,
				href: base_url+'purchase_order/detail_po/' + value,
				modal: true
			});
			$('#dialog_kosong').dialog('open');
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

		
		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>10, 'policy'=>'DETAIL'))){?>
				col += '<a href="#" onclick="detail_po(\''+row.id_po+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>10, 'policy'=>'ACCESS'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="done_po(\''+row.id_po+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			<?}?>
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>10, 'policy'=>'DELETE'))){?>
				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="delete_po(\''+row.id_po+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			<?}?>

			return col;
		}
		
		$(function(){
			$('#dg_po').datagrid({
				url:"<?=base_url()?>purchase_order/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_po').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>10, 'policy'=>'ADD'))){?>
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