
<table id="dg_orde" title="ordered List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
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
		//save
		detail_orde = function (value){
			$('#detail_dialog').dialog({
				title: 'Detail Purchase Order / Detail Vendor / Detail ordered',
				width: 800,
				height: 490,
				closed: true,
				cache: false,
				href: base_url+'ordered/detail_orde/' + value,
				modal: true
			});
			$('#detail_dialog').dialog('open');
		}

				
		actionbutton = function(value, row, index){
			var col;

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>39, 'policy'=>'DETAIL'))){?>
				col = '<a href="#" onclick="detail_orde(\''+row.id_po+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

			return col;
		}
		
		$(function(){
			$('#dg_orde').datagrid({
				url:"<?=base_url()?>ordered/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_orde').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
			
				]
			});			
		});
		
	});
</script>