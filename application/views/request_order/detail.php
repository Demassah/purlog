<script type="text/javascript">
		var url;
	$(document).ready(function(){

		back = function (val){
			$('#konten').panel({
				href:base_url+'request_order/index'
			});
		}

		newDetail = function (){
			$('#dialog_kosong').dialog({
				title: 'Tambah Detail Request Order',
				width: 440,
				height: $(window).height() * 0.66,
				closed: true,
				cache: false,
				href: base_url+'request_order/add_detail/<?=$id_ro?>',
				modal: true
			});
			$('#dialog_kosong').dialog('open');
		}
		// end newData
		
		deleteData = function (val){
				if(confirm("Apakah yakin akan menghapus data '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'request_order/deleteDetail/' + val,
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
			//}
		}
		//end deleteData 

		actionDetail = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="deleteData(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			return col;
		}

	
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order/grid_detail/<?=$id_ro?>"
			});
		});

		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					{
						iconCls:'icon-add',
						text:'Tambah Detail',
						handler:function(){
							newDetail();
						}
					},
					{
						iconCls:'icon-undo',
						text:'Kembali',
						handler:function(){
							back();
						}
					}
				]
			});			
		});

		
	});
</script>

<table id="dg" title="Detail Request Order" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_detailRO',
			">
	<thead>
		<tr>
			<th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_ro" sortable="true" width="130">ID Request Order</th>
			<th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
			<th field="kode_barang" sortable="true" width="80">ID Barang</th>
			<th field="nama_barang" sortable="true" width="120">Nama Barang</th>
			<th field="qty" sortable="true" width="60">Qty</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="note" sortable="true" width="200">Note</th>
			<th field="action" align="center" formatter="actionDetail" width="80">Aksi</th>
		</tr>
	</thead>
</table>
