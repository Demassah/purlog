<script>
	var url;
	$(document).ready(function(){


		detailData = function (val){
			$('#konten').panel({			
				href:base_url+'delivered/detail_ros/' + val,
			});
		}

		actionbutton = function(value, row, index){
			var col='';
			<?if($this->mdl_auth->CekAkses(array('menu_id'=>38, 'policy'=>'DETAIL'))){?>
				col += '<a href="#" onclick="detailData(\''+row.id_do+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			<?}?>
			return col;
		}

		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				id_do : $('#s_id_do').val(),
				id_courir : $('#s_id_courir').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}

		$(function(){
			$('#dg').datagrid({
				url:base_url+"delivered/grid"
			});
		});

	});
</script>

<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="400" border="0">
		  <tr>
			
			<td>ID DO</td>
			<td>: 
				<input name="s_id_do" id="s_id_do" size="15">
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		  <tr>
			<td>Courir</td>
			<td>: 
				<select id="s_id_courir" name="s_id_courir" style="width:120px;">
					<?=$this->mdl_prosedur->OptionCourir();?>
				</select>
			</td>

			<td>&nbsp;</td>
		  </tr>
		</table>
	</div>
</div>


<table id="dg" title="Delivered List" data-options="
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
			<th field="id_do" sortable="true" width="100">ID Delivery Order</th>
			<th field="name_courir" sortable="true" width="180">Nama Kurir</th>
			<th field="date_create" sortable="true" width="150">Date Create</th>
			<th field="action" align="center" formatter="actionbutton" width="80">Aksi</th>
		</tr>
	</thead>
</table>
