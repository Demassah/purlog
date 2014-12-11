<script>
	var url;
	$(document).ready(function(){

		// search text combo
		/*$(document).ready(function(){
			$("#search").select2();
		});*/

		doneData = function (val){
				if(confirm("Apakah yakin akan mengirim data ke Shipment '" + val + "'?")){
					var response = '';
					$.ajax({ type: "GET",
						 url: base_url+'picking_req_order_selected/doneData/' + val,
						 async: false,
						 success : function(response){
							var response = eval('('+response+')');
							if (response.success){
								$.messager.show({
									title: 'Success',
									msg: 'Data Berhasil Dikirim'
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
	
		detailData = function (val){
			$('#konten').panel({
				href: base_url+'picking_req_order_selected/detail/' + val,
			});
		}
		
		actionbutton = function(value, row, index){
			var col='';
		
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>12, 'policy'=>'DETAIL'))){?>
					col += ' <a href="#" onclick="detailData(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_ro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"picking_req_order_selected/grid"
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
			<td>Request Order Selected</td>
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

<table id="dg" title="Picking Request Order Selected List" data-options="
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
			<th field="id_ro" sortable="true" width="80" >ID ROS</th>
			<th field="full_name" sortable="true" width="130">Requestor</th>
			<th field="departement_name" sortable="true" width="130">Departement</th>
			<th field="purpose" sortable="true" width="120">Purpose</th>
			<th field="cat_req" sortable="true" width="120">Category Request</th>
			<th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
			<th field="ETD" sortable="true" width="100">ETD</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="150">Aksi</th>
		</tr>
	</thead>
</table>