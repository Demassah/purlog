<script type="text/javascript">
		var url;
	$(document).ready(function(){

		back = function (val){
			$('#konten').panel({
				href:base_url+'request_order/index'
			});
		}

		newDetail = function (){
			$('#dialog').dialog({
				title: 'Tambah Detail Request Order',
				width: 700,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'request_order/add_detail',
				modal: true
			});			 
			$('#dialog').dialog('open');
			url = base_url+'request_order/save/add_detail';
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
						$('#dg_ro').datagrid('reload');		// reload the user data
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

		actionbutton = function(value, row, index){
			var col='';
					col += '<a href="#" onclick="deleteData(\''+row.id_detail_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			return col;
		}

	
		$(function(){
			$('#dg_ro').datagrid({
				url:base_url + "request_order/grid_detail"
			});
		});

		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_ro').datagrid().datagrid('getPager');	// get the pager of datagrid
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

<table id="dg_ro" title="Detail Request Order" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_ro',
			">
	<thead>
		<tr>
			<th field="id_detail_ro" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_ro" sortable="true" width="130">ID Request Order</th>
			<th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
			<th field="nama_barang" sortable="true" width="120">Nama Barang</th>
			<th field="qty" sortable="true" width="120">Qty</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="note" sortable="true" width="200">Note</th>
			<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>
		</tr>
	</thead>
</table>
