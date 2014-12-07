<script>
	
	var url;
	$(document).ready(function(){

		receive = function (){
			$('#dialog').dialog({
				title: 'Receive',
				width: $(window).width() * 0.8,
				height: $(window).height() * 0.99,
				closed: true,
				cache: false,
				href: base_url+'document_receive/receive',
				modal: true
			});			 
			$('#dialog').dialog('open');
		}
		
		var editIndex = undefined;
		endEditing = function(){
			if (editIndex == undefined){return true}
			if ($('#dg').datagrid('validateRow', editIndex)){
				$('#dg').datagrid('endEdit', editIndex);
				editIndex = undefined;
				return true;
			} else {
				return false;
			}
		}
		
		$(function(){ // init
			$('#dg').datagrid({url:"document_receive/grid"});	
			//$('#dg').datagrid('enableFilter'); 
		});	
		
	});
</script>

<div id="toolbar_ddr" style="padding:5px;height:auto">
	<div class="fsearch">
		<table>
			<tr>
					<td>
							&nbsp;&nbsp;<a href="#" onclick="receive()" class="easyui-linkbutton" iconCls="icon-add">Add</a>
					</td>							
			</tr>
			<tr> 
					<td>&nbsp;</td>
			</tr>		
			<tr> 
				<td>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-ok">Done</a>
						&nbsp;&nbsp;<a href="#" onclick="loading()" class="easyui-linkbutton" iconCls="icon-print">Print</a>
				</td>
			</tr>			
		</table>
	</div>
</div>

<table id="dg" title="Detail DOcument Receive" data-options="
			rownumbers:true,
			singleSelect:false,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_ddr',
		">		
	<thead>
		<tr>
			<th field="user_id" sortable="true" width="150" hidden="true">ID</th>
			<th field="kode_barang" sortable="true" width="60">ID DR</th>
			<th field="kode_barang" sortable="true" width="60">ID PO</th>
			<th field="kode_barang" sortable="true" width="60">ID PR</th>
			<th field="jumlah" sortable="true" width="70">ID Vendor</th>
			<th field="nama_kategori" sortable="true" width="130">Requestor</th>
			<th field="nama_sub_kategori" sortable="true" width="120">Departement</th>
			<th field="kode_sub_kategori" sortable="true" width="70">Purpose</th>
			<th field="nama_barang" sortable="true" width="120">Cat Request</th>
			<th field="nama_barang" sortable="true" width="100">Ext Document No</th>
			<th field="nama_barang" sortable="true" width="100">ETD</th>
			<th field="nama_barang" sortable="true" width="100">Date Create</th>
		</tr>
	</thead>
</table>
