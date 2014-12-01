<script>
	
	var url;
	$(document).ready(function(){
		
		// editing cell
		$.extend($.fn.datagrid.methods, {
			editCell: function(jq,param){
				return jq.each(function(){
					var opts = $(this).datagrid('options');
					var fields = $(this).datagrid('getColumnFields',true).concat($(this).datagrid('getColumnFields'));
					for(var i=0; i<fields.length; i++){
						var col = $(this).datagrid('getColumnOption', fields[i]);
						col.editor1 = col.editor;
						if (fields[i] != param.field){
							col.editor = null;
						}
					}
					$(this).datagrid('beginEdit', param.index);
					for(var i=0; i<fields.length; i++){
						var col = $(this).datagrid('getColumnOption', fields[i]);
						col.editor = col.editor1;
					}
				});
			}
		});
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg-nilai').datagrid('validateRow', editIndex)){
				$('#dg-nilai').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		onClickCells = function(index, field){
			if (endEditing()){
				$('#dg-nilai').datagrid('selectRow', index)
						.datagrid('editCell', {index:index,field:field});
				editIndex = index;
			}
		}
		
		// load matkul
		$(function(){ // init
			$('#dg-nilai').datagrid({url:"<?=base_url()?>picking/detail"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
		
		
	});
</script>

<table id="dg-nilai" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar-nilai',
			onClickCell: onClickCells,
		">		
	<thead>
		<tr>
			<th data-options="field:'id_krs_detail',width:'100', hidden:true">aa</th>
			<th data-options="field:'nim',width:'100'">Field 1</th>
			<th data-options="field:'nama',width:'300'">Field 2</th>
			<th data-options="field:'nilai_tugas',width:'75'" editor="text">Field 3</th>
			<th data-options="field:'nilai_uts',width:'75'" editor="text">Field 4</th>
			<th data-options="field:'nilai_uas',width:'75'" editor="text">Field 5</th>
			<th data-options="field:'nilai_quis',width:'75'" editor="text">Field 6</th>
			<th data-options="field:'presensi',width:'75'" editor="text">Field 7</th>
			<th data-options="field:'nilai_final',width:'75'" editor="text">Field 8 </th>
			<th data-options="field:'nilai_huruf',width:'75'" editor="text">Field 9</th>
		</tr>
	</thead>
</table>
<div id="toolbar-nilai" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
			<td>Alocation</td>
			<!--<td>: 
				<select id="a_kd_fakultas" name="a_kd_fakultas" style="width:200px;">
					<?=$this->mdl_prosedur->OptionFakultas();?>
				</select>
			</td>-->
			
			<td>&nbsp;</td>
			<!--<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Filter</a></td>-->
			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

