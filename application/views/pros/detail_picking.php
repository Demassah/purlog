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
	 <!-- <div id="cc" class="easyui-layout" style="width:600px;height:400px;">
	    <div data-options="region:'north',title:'North Title',split:true" style="height:100px;"></div>
	    <div data-options="region:'south',title:'South Title',split:true" style="height:100px;"></div>
	    <div data-options="region:'east',title:'East',split:true" style="width:100px;"></div>
	    <div data-options="region:'west',title:'West',split:true" style="width:100px;"></div>
	    <div data-options="region:'center',title:'center title'" style="padding:5px;background:#eee;"></div>
    </div>-->

     <div id="cc" class="easyui-layout" style="width:600px;height:400px;" fit="false">
	    <div data-options="region:'north',title:'Alocation',split:true" style="height:100px;">	    	
	    	<div class="fitem" >
					<label style="width:100px">Kode Barang </label>: 
					<input name="kode_barang" size="15" value="">
				</div>
	    </div>

	    <div data-options="region:'center',title:'Available'" style="padding:5px;background:#eee;"></div>

	    <div data-options="region:'south',title:'Pending',split:true" style="height:100px;"></div>	    
    </div>