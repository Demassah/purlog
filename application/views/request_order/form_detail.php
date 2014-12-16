<script>
	$(document).ready(function(){
		
		function addRow (tableID) {
 
      var table = document.getElementById(tableID);
 
            //var rowCountTable = table.rows.length;
			//alert(table.rows[rowCountTable-1].cells[2].childNodes[1].id);
			//var rowCount = parseInt(table.rows[rowCountTable-1].cells[2].childNodes[1].id) + 1;
            var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
 
            var colCount = table.rows[1].cells.length;
			
			var newcell = row.insertCell(0);
			newcell.innerHTML = table.rows[1].cells[0].innerHTML;
			
			newcell = row.insertCell(1);
			newcell.innerHTML = rowCount;
			
			newcell = row.insertCell(2);
			newcell.innerHTML = table.rows[1].cells[2].innerHTML;
			newcell.childNodes[1].selectedIndex = 0;
			newcell.childNodes[1].id = rowCount;
			newcell.childNodes[1].name = "detail[" + rowCount + "][kode_barang]";
			
			newcell = row.insertCell(3);
			newcell.innerHTML = table.rows[1].cells[3].innerHTML;
			newcell.childNodes[1].value = "";
			newcell.childNodes[1].name = "detail[" + rowCount + "][qty]";
			
			newcell = row.insertCell(4);
			newcell.innerHTML = table.rows[1].cells[4].innerHTML;
			newcell.childNodes[1].id = "note" + rowCount + ' ';
			newcell.childNodes[1].value = "";
			newcell.childNodes[1].name = "detail[" + rowCount + "][note]";

			newcell.childNodes[1].readOnly = "true";
			
        }
 
    function deleteRow (tableID) {
            try {
				var table = document.getElementById(tableID);
				var rowCount = table.rows.length;
				
				if(rowCount <= 2) {
					alert("Cannot delete all the rows.");
				}else{
					//table.deleteRow(rowCount-1);
					for(var i=0; i<rowCount; i++) {
						if(rowCount <= 2){
							//alert("Cannot delete all the rows.");
							break;
						}
						var row = table.rows[i];
						var chkbox = row.cells[0].childNodes[0];
						if(null != chkbox && true == chkbox.checked) {
							table.deleteRow(i);
							rowCount--;
							i--;
						}
					}
					
					for(var i=1; i<rowCount; i++) {
						var row = table.rows[i];
						row.cells[1].innerHTML = (i);
						
						row.cells[2].childNodes[1].id = i;
						row.cells[2].childNodes[1].name = "detail[" + i + "][kode_barang]";;
						
						row.cells[3].childNodes[1].name = "detail[" + i + "][qty]";
						
						row.cells[4].childNodes[1].id = "note" + i + ' ';

						row.cells[4].childNodes[1].name = "detail[" + i + "][note]";
					}
				}
				
            }catch(e) {
                alert(e);
            }
        }
		
		$('#dg-detail').datagrid({
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

	<!-- <div class="fitem">
		<label style="width:150px;vertical-align:top;"> </label>
		<table id="dg-detail" style="width:575px;height:25px"
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
				<th field="kode_barang" sortable="false" width="80" editor="text" position="center">KD Barang</th>
				<th field="qty" sortable="false" width="50" editor="text" position="center">Qty</th>
				<th field="note" sortable="false" width="500" editor="text" position="center">Note</th>
				<th field="status" sortable="false" width="50" hidden="true" editor="text">Status</th>
			</tr> 
		</thead>
	</table> 
	</div>-->
	<div class="fitem">
	<br>
	<table id="tbl ">
		<thead>
			<tr>
				<th></th>
				<th bgcolor="#F4F4F4">No.</th>
				<th bgcolor="#F4F4F4">Nama Barang</th>
				<th bgcolor="#F4F4F4">Qty</th>
				<th width="60%" bgcolor="#F4F4F4">Note</th>
			</tr>
		</thead>
		<tbody id="tbodyiku ">
			
		</tbody>
	</table>
	<br>
	<a href="#" class="easyui-linkbutton" iconCls="icon-add" onclick="addRow('tbl')">Tambah Barang</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" onclick="deleteRow('tbl')">Hapus Barang</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<!-- <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveData()">Simpan</a> -->
</div>
</div>



	

