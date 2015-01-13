<script>
	var url;
	$(document).ready(function(){

		doneData = function (val){
				if(confirm("Apakah yakin akan menerima barang dengan id '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'document_receive/doneData/' + val,
						 async: false,
						 success : function(response){
							var response = eval('('+response+')');
							if (response.success){
								$.messager.show({
									title: 'Success',
									msg: 'Data Berhasil Diterima'
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
		//end sendData
		
		deleteData = function (val){
				if(confirm("Apakah yakin akan menghapus penerimaan barang dengan id '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'document_receive/deleteData/' + val,
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
		//end sendData 

		add_dr = function (val){
	      $('#konten').panel({
	        href: base_url+'document_receive/add_dr/',
	      });
	    }
	    // end newData

		detailData = function (val){
			$('#konten').panel({			
				href:base_url+'document_receive/detail/' + val,
			});
		}

		actionbutton = function(value, row, index){
			var col='';
				col += '<a href="#" onclick="detailData(\''+row.id_receive+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
				col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_receive+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
				col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id_receive+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			return col;
		}

		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				id_receive : $('#s_id_receive').val(),
				id_sro : $('#s_id_sro').val(),
				id_courir : $('#s_id_courir').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}

		$(function(){
			$('#dg').datagrid({
				url:base_url+"document_receive/grid"
			});
		});

		//# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah DR',
            handler:function(){
              add_dr();
            }
          }            
        ]
      });     
    }); 

	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="600" border="0">
		  <tr>
			<td>ID Receive</td>
			<td>: 
				<input name="s_id_receive" id="s_id_receive" size="15">
			</td>
			<td>Courir</td>
			<td>: 
				<select id="s_id_courir" name="s_id_courir" style="width:120px;">
					<?=$this->mdl_prosedur->OptionCourir();?>
				</select>			
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		  <tr>
			<td>ID SRO</td>
			<td>: 
				<input name="s_id_sro" id="s_id_sro" size="15">
			</td>

			<td>&nbsp;</td>
		  </tr>
		</table>
	</div>
</div>


<table id="dg" title="Document Receive List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			">
	<thead>
		<tr>
			<th field="id_receive" sortable="true" width="100">ID Receive</th>
			<th field="id_sro" sortable="true" width="100">ID SRO</th>
			<th field="id_courir" sortable="true" width="100">ID Courir</th>
			<th field="name_courir" sortable="true" width="180">Nama Kurir</th>
			<th field="date_create" sortable="true" width="150">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="180">Aksi</th>
		</tr>
	</thead>
</table>
