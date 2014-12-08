<script>
	var url;
	$(document).ready(function(){

		detail_pr = function (){
			$('#konten').panel({
				href:base_url+'purchase_request/detail_pr'
			});
		}

		qrs = function (){
			$('#konten').panel({
				href:base_url+'quotation_request_selected/index'
			});
		}
		
		actionbutton = function(value, row, index){
			var col;

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>14, 'policy'=>'DETAIL'))){?>
				col = '<a href="#" onclick="detail_pr(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

				col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="qrs(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">QRS</a>';
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>purchase_request/grid"
			});
		});
	
		
	});
</script>
<table id="dg" title="Purchase Request List" data-options="
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
			<th field="kode_barang" sortable="true" width="130">ID Purchase Request</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_barang" sortable="true" width="120">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>