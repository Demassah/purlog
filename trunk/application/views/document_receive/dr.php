<script>
	var url;
	$(document).ready(function(){

		detail = function (){
			$('#konten').panel({
				href:base_url+'document_receive/detail'
			});
		}
		
		actionbutton = function(value, row, index){
			var col;

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>17, 'policy'=>'DETAIL'))){?>
				col = '<a href="#" onclick="detail(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>

			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>document_receive/grid"
			});
		});
		
		
	});
</script>
<table id="dg" title="Data Purchase Order" data-options="
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
			<th field="kode_barang" sortable="true" width="60">ID DR</th>
			<th field="kode_barang" sortable="true" width="60">ID PO</th>
			<th field="kode_barang" sortable="true" width="60">ID PR</th>
			<th field="jumlah" sortable="true" width="70">ID Vendor</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_sub_kategori" sortable="true" width="70">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>
		</tr>
	</thead>
</table>