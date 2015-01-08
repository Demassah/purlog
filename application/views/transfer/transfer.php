<script type="text/javascript">
		var url;
	$(document).ready(function(){

		newData = function (){
			$('#dialog').dialog({
				title: 'Tambah Transfer',
				width: 475,
				height: 325,
				closed: true,
				cache: false,
				href: base_url+'transfer/add',
				modal: true
			});			 
			$('#dialog').dialog('open');
			url = base_url+'transfer/save/add';
		}
		// end newData
		
		detailData = function (val){
			$('#konten').panel({			
				href:base_url+'transfer/detail/' + val,
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
		//end saveData

		actionbutton = function(value, row, index){
			var col='';
			
					col += '<a href="#" onclick="detailData(\''+row.id_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';
			
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="doneData(\''+row.id_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Done</a>';
		
					col += '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="deleteData(\''+row.id_transfer+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Delete</a>';
			
			return col;
		}
		
		$(function(){
			$('#dg').datagrid({
				url:base_url + "transfer/grid"
			});
		});

		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				departement_id : $('#s_departement_id').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}

		//# Tombol Bawah
		$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>10, 'policy'=>'ADD'))){?>
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
			<td>Search</td>
			<td>: 
				<select id="s_departement_id" name="s_departement_id" style="width:200px;">
					<?=$this->mdl_prosedur->OptionDepartement();?>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  </tr>
		</table>
	</div>
</div>

<table id="dg" title="Transfer List" data-options="
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
			<th field="id_transfer" sortable="true" width="80">ID Transfer</th>			
			<th field="type_transfer" sortable="true" width="130">Tipe Transfer</th>
			<th field="note" sortable="true" width="250">Note</th>
			<th field="date_create" sortable="true" width="120">Date Create</th>
			<th field="user_id" sortable="true" width="120">Requestor</th>
			<th field="action" align="center" formatter="actionbutton" width="180">Aksi</th>
		</tr>
	</thead>
</table>
