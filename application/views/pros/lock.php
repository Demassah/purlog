<script>
	
	var url;
	$(document).ready(function(){
		
		saveData = function(){
			// get data matakuliah
			var arr=[];
			rows = $('#dg-matakuliah').datagrid('getChecked');
			for(var i=0; i<rows.length; i++){
				arr.push(rows[i].kd_matakuliah);
			}
			
			$.ajax({
			  url: base_url+"krs/save/",
			  method: 'POST',
			  data: {
						kd_fakultas : $('#kd_fakultas').val(),
						kd_prodi : $('#kd_prodi').val(),
						kd_kurikulum : $('#kd_kurikulum').val(),
						id_tahunajaran : $('#id_tahunajaran').val(),
						nim : $('#nim').combogrid('getValue'),
						semester : $('#semester').val(),
						sks : $('#sks').val(),
						kd_dosen : $('#kd_dosen').val(),
						kd_matakuliah : arr
					},
			  success : function(response, textStatus){
				//alert(response);
				var response = eval('('+response+')');
				if(response.success){
					$.messager.show({
						title: 'Success',
						msg: 'Data Berhasil Disimpan'
					});
					$('#dialog').dialog('close');
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
		
		//
		save_nilai = function(){
			// save jika cell masih dlm keadaan edit
			$('#dg-nilai').datagrid('endEdit', editIndex);
			//alert(JSON.stringify($('#dg-nilai').datagrid('getData')));
			$.ajax({
			  url: base_url+"nilai/save",
			  method: 'POST',
			  data: {
						data_nilai : $('#dg-nilai').datagrid('getData')
					},
			  success : function(response, textStatus){
				//alert(response);
				var response = eval('('+response+')');
				if(response.success){
					$.messager.show({
						title: 'Success',
						msg: 'Data Berhasil Disimpan'
					});
					$('#dialog-sap').dialog('close');
					//$('#dg').datagrid('reload');
				}else{
					$.messager.show({
						title: 'Error',
						msg: response.msg
					});
				}
			  }
			});
		}
		
		// onchange
		$('#a_kd_fakultas').change(function(){
			$('#a_kd_prodi').load(base_url+'prosedur/getProdibyFakultas/'+$('#a_kd_fakultas').val());
		});
		
		$('#a_kd_prodi').change(function(){
			$('#a_kd_kurikulum').load(base_url+'prosedur/getKurikulumbyProdi/'+$('#a_kd_prodi').val());
		});
		
		$('#a_kd_kurikulum').change(function(){
			$('#a_kd_matakuliah').load(base_url+'prosedur/getMatakuliah/'+$('#a_kd_kurikulum').val());
		});
		
		$('#a_kd_matakuliah').change(function(){
			$('#a_kd_dosen').load(base_url+'prosedur/getDosenbyProdiNilai/'+$('#a_kd_matakuliah').val());
		});
		
		$('#a_kd_dosen').change(function(){
			//load datanya
			$('#a_kd_kelas').load(base_url+'prosedur/getKelasbyDosenNilai/'+$('#a_kd_dosen').val());
			//load_nilai();
		});
		$('#a_kd_kelas').change(function(){
			//$('#s_kd_kelas').load(base_url+'prosedur/getKelasbyDosenNilai/'+$('#s_kd_dosen').val());
			load_nilai();
		});
		
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
			$('#dg-nilai').datagrid({url:"<?=base_url()?>nilai/grid_input"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
		// filter
		load_nilai = function(){
			$('#dg-nilai').datagrid('load',{
				kd_prodi : $('#a_kd_prodi').val(),
				kd_matakuliah : $('#a_kd_matakuliah').val(),
				kd_dosen : $('#a_kd_dosen').val(),
				kd_kelas : $('#a_kd_kelas').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
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
			<th data-options="field:'nilai_tugas',width:'175'" editor="text">ID Request Order</th>
			<th data-options="field:'nilai_uts',width:'175'" editor="text">ID Ext Document</th>
			<th data-options="field:'nilai_uas',width:'75'" editor="text">ID Barang</th>
			<th data-options="field:'nilai_quis',width:'175'" editor="text">Nama Barang</th>
			<th data-options="field:'presensi',width:'50'" editor="text">Qty</th>
			<th data-options="field:'nilai_final',width:'75'" editor="text">Requestor </th>
			<th data-options="field:'nilai_huruf',width:'75'" editor="text">Date Create</th>
			<th data-options="field:'nilai_huruf',width:'75'" editor="text">Note</th>
			
			<th field="action" align="center" formatter="actionbutton" width="140">Aksi</th>
		</tr>
	</thead>
</table>
<div id="toolbar-nilai" style="padding:5px;height:auto">
	<div>
		<table>
			<tr>
			<td>&nbsp;&nbsp;<a href="#" onclick="SRO()" class="easyui-linkbutton" iconCls="icon-add">Shipment Request Order</a></td> 

			<td>&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

