
<table id="dg" title="Purchase Order List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="id_po" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_pr" sortable="true" width="130">ID Purchase Request</th>
			<th field="id_vendor" sortable="true" width="70">ID Vendor</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="departement_name" sortable="true" width="120">Departement</th>
			<th field="purpose" sortable="true" width="70">Purpose</th>
			<th field="cat_req" sortable="true" width="120">Cat Request</th>
			<th field="ext_doc_no" sortable="true" width="100">Ext Document No</th>
			<th field="ETD" sortable="true" width="100">ETD</th>
			<th field="date_create" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>
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
				height: 190,
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
		//save
		detail_po = function (value){
			$('#dialog').dialog({
				title: 'Detail Purchase Order / Detail Vendor',
				width: 580,
				height: 490,
				closed: true,
				cache: false,
				href: base_url+'purchase_order/detail_po/' + value,
				modal: true
			});
			$('#dialog').dialog('open');
		}

		
		actionbutton = function(value, row, index){
			var col;

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>17, 'policy'=>'DETAIL'))){?>
				col = '<a href="#" onclick="detail_po(\''+row.id_po+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>purchase_order/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>17, 'policy'=>'ADD'))){?>
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