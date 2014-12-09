<script>
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
			if ($('#dg-detail').datagrid('validateRow', editIndex)){
				$('#dg-detail').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		onClickCells = function(index, field){
			if (endEditing()){
				$('#dg-detail').datagrid('selectRow', index)
						.datagrid('editCell', {index:index,field:field});
				editIndex = index;
			}
		}
		
		$('#dg-detail').datagrid({
			data:<?=$data_sap?>
		});
		
		//tombol bawah
		$(function(){
			var pager = $('#dg-detail').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				{
					iconCls:'icon-add',
					text:'Tambah',
					handler:function(){
						$('#dg-detail').datagrid('appendRow',{
							kd_prodi:'',
							kd_matakuliah:'',
							kd_materi:'',
							Materi:'',
							Waktu:'',
							Metode:''
						});
					}
				},
				{
					iconCls:'icon-remove',
					text:'Hapus',
					handler:function(){
						delete_sap();
						// $('#dg-detail').datagrid('endEdit', editIndex);
						// var xx = $('#dg-detail').datagrid('getData');
						// alert(JSON.stringify(xx));
					}
				}
				],
				layout:[],
				displayMsg:''
			});
		});
		
		
		
	});
</script>

<div style="margin:15px">
	<input type="hidden" name="kd_matakuliah" id="kd_matakuliah" value=" ">
	<input type="hidden" name="kd_prodi" id="kd_prodi" value=" ">

	<div class="fitem" >
		<label style="width:150px">ID Request Order </label>:
		<b> </b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Ext Document No </label>:
		<b> </b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Requestor </label>:
		<b> </b>
	</div>
	<div class="fitem" >
		<label style="width:150px">Date Create </label>:
		<b> </b>
	</div>

	<div class="fitem">
		<label style="width:150px;vertical-align:top;"> </label>
		<table id="dg-detail" style="width:575px;height:50px"
			data-options="	rownumbers:true,
							singleSelect:true,
							autoRowHeight:false,
							pagination:true,
							pageSize:50,
							pageList:[10,20,30,40,50,100,150,200],
							fit:false,
							onClickCell: onClickCells,
					    ">
		<thead>
			<tr>
				<th field="kd_prodi" hidden="true" sortable="false" width="80">x</th>
				<th field="kd_matakuliah" hidden="true" sortable="false" width="80">y</th>

				<th field="id_barang" sortable="false" width="120" editor="text">Nama Barang</th>
				<th field="qty" sortable="false" width="60" editor="text">Qty</th>
				<th field="note" sortable="false" width="150" editor="text">Deskripsi</th>
				<th field="status" sortable="false" width="50" editor="text">Status</th>
			</tr>
		</thead>
	</table>
	</div>
</div>
