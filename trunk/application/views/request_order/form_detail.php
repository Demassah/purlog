<script>
	$(document).ready(function(){

		// var editIndex = undefined;
		// endEditing = function(){
		// 	if (editIndex == undefined){return true}
		// 	if ($('#dg_addDetail').datagrid('validateRow', editIndex)){
				
		// 		// . set colum nama barang, sebelum selesai edit
		// 		var cmb = $('#dg_addDetail').datagrid('getEditor',{
		// 			index:editIndex,
		// 			field:'kode_barang'
		// 		});
		// 		if(cmb){
		// 			$('#dg_addDetail').datagrid('updateRow',{
		// 				index: editIndex,
		// 				row: {
		// 					kode_barang: $(cmb.target).combobox('getValue'),
		// 					nama_barang: $(cmb.target).combobox('getText')
		// 				}
		// 			});
		// 		}
			    
		// 		// close editor and save
		// 		$('#dg_addDetail').datagrid('endEdit', editIndex);
		// 		editIndex = undefined;
		// 		//hitung_sks();
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }
		
		// onClickCells = function(index, field, row){
		// 	// , get kode barang
		// 	var dat = $('#dg_addDetail').datagrid('getData');
		// 	var kode_barang = dat.rows[index].kode_barang;
			
		// 	// 
		// 	// change column option
		// 	var opts = $('#dg_addDetail').datagrid('getColumnOption', 'kode_barang');
		// 	opts.editor = {
		// 		type:'combobox',
		// 		options:{
		// 			mode:'remote',
		// 			valueField:'kode_barang',
		// 			textField:'nama_barang',
		// 			editable:false,
		// 			url:base_url+'krs/load_kode_barang/',
		// 		}
		// 	};
		// 	if (endEditing()){
		// 		$('#dg_addDetail').datagrid('selectRow', index)
		// 				.datagrid('editCell', {index:index,field:field});
		// 		editIndex = index;
		// 	}
		// }
		
		// FormatterCell_kode_barang = function(value,row,index){
		// 	return row.nama_barang;
		// }
		
		$('#dg_addDetail').edatagrid({
			data:<?=$data_detail?>
		});
		
	});
</script>


<div style="margin:15px">
	<input type="hidden" name="id_ro" id="id_ro" value="<?=$id_ro?>">
	<input type="hidden" name="ext_doc_no" id="ext_doc_no" value="<?=$ext_doc_no?>">
	<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>">
	<input type="hidden" name="date_create" id="date_create" value="<?=$date_create?>">

	<div class="fitem" >
		<label style="width:150px">ID Request Order </label>:
		<b><?=$id_ro?></b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Ext Document No </label>:
		<b><?=$ext_doc_no?></b> 
	</div>
	<div class="fitem" >
		<label style="width:150px">Requestor </label>:
		<b><?=$full_name?></b>
	</div>	
	<div class="fitem">
		<label style="width:150px;vertical-align:top;">Date Create </label>:
		<b><?=$date_create?></b>
	</div>
	<br>
	<table id="dg_addDetail" title="Barang" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:false,
			pageSize:60,
			fit:true,
			toolbar:'#toolbar_addDetail',
			">
	<thead>
		<tr>
			<th field="kode_barang" width="200"  editor="combobox" >Kode / Nama Barang</th>
			<th field="nama_barang" width="200" hidden="true">Barang</th>
			<!-- <th field="kode_barang" width="220" sortable="true" editor="{type:'validatebox',options:{required:true}}">Barang</th> -->
	    <th field="qty" width="80" sortable="true" editor="text">Qty</th>
	    <th field="note" width="250" sortable="true" editor="{type:'validatebox'}">Note</th>

		</tr>
	</thead>
</table>
<div id="toolbar_addDetail">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg_addDetail').edatagrid('addRow')">New</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg_addDetail').edatagrid('destroyRow')">Destroy</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg_addDetail').edatagrid('saveRow')">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg_addDetail').edatagrid('cancelRow')">Cancel</a>
</div>

</div>





	

