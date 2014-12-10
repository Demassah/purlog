<script>
	var url;
	$(document).ready(function(){
	
		newData = function (){
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

		detailData = function (){
			$('#konten').panel({
				href:base_url+'shipment_req_order/detail'
			});
		}
		
		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>13, 'policy'=>'DETAIL'))){?>
					col += '<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
			return col;
		}

		// search text combo
		$(document).ready(function(){
			$("#search").select2();
		});
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"shipment_req_order/grid"
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
							newData();
						}
					}
				<?}?>	
				]
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
			<td>ROS</td>
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
			<th field="id_ros" sortable="true" width="100">ID ROS</th>
			<th field="id_do" sortable="true" width="100">ID DO</th>
			<th field="full_name" sortable="true" width="100">Requestor</th>
			<th field="date_create" sortable="true" width="100">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>


