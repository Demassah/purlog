<script>
	var url;
	$(document).ready(function(){

		detail_pr = function (){
			$('#dialog').dialog({
				title: 'Detail Purchase Request',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'purchase_request/detail_pr',
				modal: true
			});			 
			$('#dialog').dialog('open');
		}

		qrs = function (){
			$('#dialog').dialog({
				title: 'Add Purchase Request',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'purchase_request/qrs',
				modal: true
			});			 
			$('#dialog').dialog('open');
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
</script>
<table id="dg" title="Data Purchase Request" data-options="
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