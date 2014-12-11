<script>
	
	var url;
	$(document).ready(function(){

		Checkbox = function(value, row, index){
			return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
		}
			
		$(function(){ // init
			$('#dtgrd').datagrid({url:"purchase_request/grid_pr"});	
		});		
		
	});
</script>


<table id="dtgrd" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_available',
		">		
	<thead>
		<tr>
			<th field="id_detail_ro" sortable="true" width="120">ID Detail ROS</th>
			<th field="id_ro" sortable="true" width="120">ID ROS</th>
			<th field="kode_barang" sortable="true" width="120">ID Item</th>
			<th field="nama_barang" sortable="true" width="120">Nama Barang</th>
			<th field="qty" sortable="true" width="80">Qty</th>
			<th field="note" sortable="true" width="500">Deskripsi</th>	
			<th field="chk" width="23" formatter="Checkbox">
				<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
			</th>
		</tr>
	</thead>
</table>


