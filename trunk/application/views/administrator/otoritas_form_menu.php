<script>
	var url;
	$(document).ready(function(){
		
		// kamus data
		
		saveMenu = function(){
			rows = $('#dg-menu').datagrid('getData');
			//alert(JSON.stringify(rows));
			//return 0;
			$.ajax({
			  url: base_url+"otoritas/save_menu/",
			  method: 'POST',
			  data: {
						user_level_id : $('#user_level_id').val(),
						data : rows
					},
			  success : function(response, textStatus){
				//alert(response);
				var response = eval('('+response+')');
				if(response.success){
					$.messager.show({
						title: 'Success',
						msg: 'Data Berhasil Disimpan'
					});
					$('#dialog-menu').dialog('close');
					$('#dg').datagrid('reload');
				}else{
					$.messager.show({
						title: 'Error',
						msg: response.msg
					});
				}
			  }
			});
		}
		//end saveData
		
		// cell checkbox
		update_value = function(index, field, value){
			//alert('Index:'+index+'  -  Field:'+field+'  -  Checked:'+value);
			if(value==true && field != 'access'){
				$('#dg-menu').datagrid('updateRow',{index:index, row:{access:1}});
			}
			switch(field){
				case 'access':  if(value==false){ // jika akses == false maka yg lainnya tidak bisa
									$('#dg-menu').datagrid('updateRow',{index:index, row:{add:0}});
									$('#dg-menu').datagrid('updateRow',{index:index, row:{detail:0}});
									$('#dg-menu').datagrid('updateRow',{index:index, row:{edit:0}});
									$('#dg-menu').datagrid('updateRow',{index:index, row:{deleted:0}});
									$('#dg-menu').datagrid('updateRow',{index:index, row:{print:0}});
								}
								$('#dg-menu').datagrid('updateRow',{index:index, row:{access:(value==true?1:0)}}); 
								break;
				case 'add': $('#dg-menu').datagrid('updateRow',{index:index, row:{add:(value==true?1:0)}}); break;
				case 'detail': $('#dg-menu').datagrid('updateRow',{index:index, row:{detail:(value==true?1:0)}}); break;
				case 'edit': $('#dg-menu').datagrid('updateRow',{index:index, row:{edit:(value==true?1:0)}}); break;
				case 'deleted': $('#dg-menu').datagrid('updateRow',{index:index, row:{deleted:(value==true?1:0)}}); break;
				case 'print': $('#dg-menu').datagrid('updateRow',{index:index, row:{print:(value==true?1:0)}}); break;
			}
		}
		
		CheckboxAccess = function(value,row,index){
			if(row.access1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+',\'access\', this.checked)" '+(row.access==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		
		CheckboxAdd = function(value,row,index){
			if(row.add1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', \'add\', this.checked)" '+(row.add==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		
		CheckboxEdit = function(value,row,index){
			if(row.edit1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', \'edit\', this.checked)" '+(row.edit==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		CheckboxDetail = function(value,row,index){
			if(row.detail1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', \'detail\', this.checked)" '+(row.detail==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		
		CheckboxDeleted = function(value,row,index){
			if(row.delete1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', \'deleted\', this.checked)" '+(row.deleted==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		
		CheckboxPrint = function(value,row,index){
			if(row.print1){
				return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', \'print\', this.checked)" '+(row.print==true?'checked="checked"':'')+' />';
			}else{
				return '';
			}
		}
		
		// load menu
		$(function(){ // init
			$('#dg-menu').datagrid({
				url:"<?=base_url()?>otoritas/menu_load/<?=$user_level_id?>"
			});
		});	
		
		// expand all group
		expandAllGroup = function(data){
			//alert(JSON.stringify(data));
			for(var i=0; i<data.total; i++){
				$('#dg-menu').datagrid('expandGroup', i);
			}
		}
		
		check_all = function(value){
			var rec = $('#dg-menu').datagrid('getData');
			for(var i=0; i<rec.total; i++){
				//alert(rec.rows[i].menu_id);
				$('#dg-menu').datagrid('updateRow',{index:i, row:{access:(value==true?1:0)}});
				$('#dg-menu').datagrid('updateRow',{index:i, row:{add:(value==true?1:0)}});
				$('#dg-menu').datagrid('updateRow',{index:i, row:{detail:(value==true?1:0)}});
				$('#dg-menu').datagrid('updateRow',{index:i, row:{edit:(value==true?1:0)}});
				$('#dg-menu').datagrid('updateRow',{index:i, row:{deleted:(value==true?1:0)}});
				$('#dg-menu').datagrid('updateRow',{index:i, row:{print:(value==true?1:0)}});
			}
		}
		
	});
</script>

<input type="hidden" name="user_level_id" id="user_level_id" value="<?=$user_level_id?>">
<table id="dg-menu" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:false,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar',
			view:groupview,
			groupField:'menu_group',
			groupFormatter:function(value, rows){
				return 'Menu ' + value;
			},
			rowStyler: function(index,row){
				if (row.menu_parent == 0){
					return 'background-color:#feffc1;color:#000;';
				}
			},
			onLoadSuccess: expandAllGroup
		">		
	<thead>
		<tr>
			<th field="user_access_id" width="100" hidden="true">user_access_id</th>
			<th field="menu_id" width="100" hidden="true">menu id</th>
			<th field="menu_parent" width="100" hidden="true">Parent</th>
			<th field="menu_name" width="200">Menu Name</th>
			<th field="menu_group" width="100" hidden="true">menu group</th>
			
			<th field="access1" width="50" formatter="CheckboxAccess" align="center">Akses</th>
			<th field="add1" width="50" formatter="CheckboxAdd" align="center">Add</th>
			<th field="detail1" width="50" formatter="CheckboxDetail" align="center">Detail</th>
			<th field="edit1" width="50" formatter="CheckboxEdit" align="center">Edit</th>
			<th field="delete1" width="50" formatter="CheckboxDeleted" align="center">Delete</th>
			<th field="print1" width="50" formatter="CheckboxPrint" align="center">Print</th>
			
			<th field="access" width="30" hidden="true">access</th>
			<th field="add" width="30" hidden="true">add</th>
			<th field="detail" width="30" hidden="true">detail</th>
			<th field="edit" width="30" hidden="true">edit</th>
			<th field="deleted" width="30" hidden="true">delete</th>
			<th field="print" width="30" hidden="true">print</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<a href="#" onclick="check_all(true)" class="easyui-linkbutton" plain="true">Check All</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="#" onclick="check_all(false)" class="easyui-linkbutton" plain="true">Uncheck All</a>
</div>