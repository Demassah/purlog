<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>ROS</td>
			<td>: 
					<select class="" name=" " style="width:200px;">
						<option>Choose ROS</option>
						           
				</select>	
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>

<table id="dg" title="Shipment Request Order List" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar'
			">
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_sro" sortable="true" width="100">ID SRO</th>
			<th field="id_ro" sortable="true" width="100">ID RO</th>
			<th field="full_name" sortable="true" width="200">Requestor</th>
			<th field="date_create" sortable="true" width="120">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>

<script>
	var url;
	$(document).ready(function(){

		addData = function (){
			$('#dialog').dialog({
				title: 'Tambah SRO',
				width: 380,
				height: 130,
				closed: true,
				cache: false,
				href: base_url+'shipment_req_order/add',
				modal: true
			});
			 
			$('#dialog').dialog('open');
			url = base_url+'shipment_req_order/save/add';
		}
		// end newData

		detailData = function (val){
			$('#konten').panel({
				href:base_url+'delivered/detail_sro/'+val
			});
		}

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

		doneData = function (val){
			if(confirm("Apakah yakin akan mengirim data ke Delivery Order '" + val + "'?")){
				var response = '';
				$.ajax({ type: "GET",
					 url: base_url+'shipment_req_order/doneData/' + val,
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
		
		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>38, 'policy'=>'DETAIL'))){?>
					col += '<a href="#" onclick="detailData(\''+row.id_ro+'/'+row.id_sro+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			return col;
		}

		
		$(document).ready(function(){
			$(".select").select2();
		});
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"delivered/detail_grid/<?=$id_do?>"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>13, 'policy'=>'ADD'))){?>
					{
						iconCls:'icon-add',
						text:'Tambah Data',
						handler:function(){
							addData();
						}
					}
				<?}?>	
				]
			});			
		});
		
	});
</script>

