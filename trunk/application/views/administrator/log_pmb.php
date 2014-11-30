<script>
	var url;
	$(document).ready(function(){
		
		// formater
		f_aksi = function(){
			var aksi = $('#s_aksi').val();
			
			if(aksi == 'add'){
				return 'Add';
			}else if(aksi == 'update'){
				return 'Update';
			}else{
				return 'Delete';
			}
		}
		
		$(function(){
			$('#dg').datagrid({
				url:"<?=base_url()?>log_pmb/grid"
			});
		});
		
		// filter
		filter = function(){
			$('#dg').datagrid('load',{
				s_module : $('#s_module').val(),
				s_aksi : $('#s_aksi').val(),
			});
			//$('#dg').datagrid('enableFilter');
		}
		
		//# Tombol Bawah
		/*$(function(){
			var pager = $('#dg').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
					{
						iconCls:'icon-print',
						text:'Export PDF',
						handler:function(){
							window.open('<?=base_url().'log_pmb/laporan_pdf'?>');
						}
					}
				]
			});			
		});*/
		
		
		
	});
</script>
<table id="dg" title="Kelola Data log_pmb" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			toolbar:'#toolbar',
			pagination:true,
			pageSize:30,
			fit:true,
			">
	<thead>
		<tr>
			<th field="tanggal" width="150">Tanggal - Waktu</th>
			<th field="username" width="150">User</th>
			<th field="aksi" formatter="f_aksi" width="75">Aksi</th>
			<th field="deskripsi" width="300">Deskripsi</th>
		</tr>
	</thead>
</table>
<div id="toolbar" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">
	
	</div>
	<div>
		<table width="700" border="0">
		  <tr>
			<td>Module</td>
			<td>: 
				<select id="s_module" name="s_kd_pt" style="width:130px;">
					<option value="jadwal_pmb">Jadwal PMB</option>
					<option value="formulir_pmb">Formulir PMB</option>
					<option value="seleksi">Seleksi Ijian</option>
				</select>
			</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>Aksi</td>
			<td>: 
				<select id="s_aksi" name="s_kd_pt" style="width:130px;">
					<option value="add">Add</option>
					<option value="update">Update</option>
					<option value="delete">Delete</option>
				</select>
			</td>
			<td>&nbsp;&nbsp;<a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Filter</a></td>
		  </tr>
		</table>
	</div>
</div>
