<script>
	var url;
	$(document).ready(function(){

		DetailData = function (val){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_logistic/detail/'+ val,
			});
		}

		DetailReject = function (val){
			//detail
			$('#konten').panel({
				href: base_url+'request_order_logistic/rejected/'+ val,
			});
		}

		doneData = function (val){
				if(confirm("Apakah yakin akan mengirim data ke Logistic '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'request_order_logistic/done/' + val,
						 async: false,
						 success : function(response){
							var response = eval('('+response+')');
							if (response.success){
								$.messager.show({
									title: 'Success',
									msg: 'Data Berhasil Dikirim Ke Proses Seleksi'
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

		actionbutton = function(value, row, index){
			var col='';
			//if (row.kd_fakultas != null) {
			
					col += '<a href="#" onclick="DetailData(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Approved</a>';

					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="DetailReject(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Rejected</a>';
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "request_order_logistic/grid"
			});
		});
		
		
	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Search</td>
			<td>: 
				<select id="search" name=" " style="width:200px;">
						<option>Pilih</option>
						<option>Search 1</option>
            <option>Search 2</option>
            <option>Search 3</option>	
            <option>Search 4</option>              
				</select>	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>

<table id="dg" title="Request Order Logistic List" data-options="
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
			<th field="id_ro" sortable="true" width="80" >ID RO</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="departement_name" sortable="true" width="130">Departement</th>
			<th field="purpose" sortable="true" width="120">Purpose</th>
			<th field="cat_req" sortable="true" width="120">Category Request</th>
			<th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
			<th field="ETD" sortable="true" width="100">ETD</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="200">Aksi</th>
		</tr>
	</thead>
</table>
