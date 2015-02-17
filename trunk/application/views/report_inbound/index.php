<div id="toolbar_report_in" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="550" border="0">
		  <tr>
			<td>Search By Date</td>
			<td>: 
				<input class="easyui" name="id_in"  id="id_in" size="5">
			</td>
			<td>To</td>
			<td>
				<input name="date_2" class="easyui-datebox" id="date_2" size="5">
			</td>
			<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
			<td></td>
			<td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>
		  </tr>

		</table>
	</div>
</div>

<table id="dg_report_in" title="Report Inbound" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_report_in'
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true">ID</th>
			<th field="id_in" sortable="true" width="100" >ID IN</th>
			<th field="ext_rec_no" sortable="true" width="130">Ext Rec No</th>
			<th field="type" sortable="true" width="70">Type</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>
			<th field="full_name" sortable="true" width="120">Requestor</th>
	
		</tr>
	</thead>
</table>

<script>
	var url;
	$(document).ready(function(){

		// reset 
		reset = function(){
			$('#id_in').val('');
			$('#date_2').val('');
			$('#dg_report_in').datagrid('load',{
				tgl : $('#date_1').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_in').datagrid('load',{
				id_in : $('#id_in').val(),
				date_2 : $('#date_2').val()
			});
			//$('#dg').datagrid('enableFilter');
		}

		$(function(){
			$('#dg_report_in').datagrid({
				url:"<?=base_url()?>inbound/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_in').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>52, 'policy'=>'ACCESS'))){?>
					{
						iconCls:'icon-excel',
						text:'Export Excel',
						handler:function(){
							ExportExcel();
						}
					},
				<?}?>
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>52, 'policy'=>'ACCESS'))){?>
					{
						iconCls:'icon-pdf',
						text:'Export PDF',
						handler:function(){
							ExportPdf();
						}
					}
				<?}?>		
				]
			});			
		});
		
	});
</script>
