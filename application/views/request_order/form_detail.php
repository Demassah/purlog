<script>
	$(document).ready(function(){

		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg_addDetail').edatagrid('validateRow', editIndex)){
				
				// . set colum nama dosen, sebelum selesai edit
				var cmb = $('#dg_addDetail').edatagrid('getEditor',{
					index:editIndex,
					field:'kode_barang'
				});
				if(cmb){
					$('#dg_addDetail').edatagrid('updateRow',{
						index: editIndex,
						row: {
							kode_barang: $(cmb.target).combobox('getValue'),
							nama_barang: $(cmb.target).combobox('getText')
						}
					});
				}
			    
				// close editor and save
				$('#dg_addDetail').edatagrid('endEdit', editIndex);
				editIndex = undefined;
				//hitung_sks();
				return true;
			} else {
				return false;
			}
		}
		
		onClickCells = function(index, field, row){
			// , get kode barang
			var dat = $('#dg_addDetail').edatagrid('getData');
			//var kd_matkul = dat.rows[index].kd_matakuliah;
			
			// 
			// change column option
			var opts = $('#dg_addDetail').edatagrid('getColumnOption', 'kode_barang');
			opts.editor = {
				type:'combobox',
				options:{
					mode:'remote',
					valueField:'kode_barang',
					textField:'nama_barang',
					editable:false,
					url:base_url+'request_order/load_kode_barang/',
					
				}
			};
			if (endEditing()){
				$('#dg_addDetail').edatagrid('selectRow', index)
						.edatagrid('editCell', {index:index,field:field});
				editIndex = index;
			}
		}
		
		FormatterCell_kode_barang = function(value,row,index){
			return row.nama_barang;
		}

		// update_value = function(index, value, kode_barang){
		// 	//alert(id_jadwal);
		// 	if(kode_barang == 0 || kode_barang == 'null'){
		// 		$('#dg_addDetail').datagrid('updateRow',{index:index, row:{chk:0}});
		// 		alert('Request Order tidak bisa diambil, karena kode dan nama barang tidak ada.');
		// 	}else{
		// 		$('#dg_addDetail').datagrid('updateRow',{index:index, row:{chk:(value==true?1:0)}});
		// 	}
		// }

		$('#dg_addDetail').edatagrid({
			data:<?=$data_detail?>
		});
		
	});
</script>


<div style="margin:15px;width:600px;height:600px">
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

	<table id="dg_addDetail" title="List Barang" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:false,
			pageSize:60,
			fit:true,
			toolbar:'#toolbar_addDetail',

			onClickCell: onClickCells,

			">
	<thead>
		<tr>
			<th field="kode_barang" width="220" editor="text" formatter="FormatterCell_kode_barang">Kode Barang | Nama Barang</th>
			<th field="nama_barang" width="200" hidden="true">Nama Barang</th>
			<th field="qty" width="70" editor="text">Qty</th>
			<th field="note" width="250" editor="text">Note</th>
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
