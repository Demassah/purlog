<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="500" border="0">
		  <tr>
			<td>Shipment Request Order</td>
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
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_do" sortable="true" width="120">ID Delivery Order</th>
			<th field="name_courir" sortable="true" width="120">Courir</th>
			<th field="date_create" sortable="true" width="125">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>

<script>
	var url;
	$(document).ready(function(){

		// search text combo
		$(document).ready(function(){
			$("#search").select2();
		});

		detail_do = function (val){
			$('#konten').panel({
				href:base_url+'delivered/detail_do/'+ val
			});
		}

		actionbutton = function(value, row, index){
			var col='';

			<?if($this->mdl_auth->CekAkses(array('menu_id'=>38, 'policy'=>'DETAIL'))){?>
					col += '<a href="#" onclick="detail_do(\''+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url+"delivered/grid"
			});
		});
		
	});
</script>