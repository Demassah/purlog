<div id="toolbar_report_delivery" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="650" border="0">
		  <tr>
			<td>Search By Date</td>
			<td>: 
				<input class="date" name="date_1"  id="date_1" size="15">
			</td>
			<td>To</td>
			<td>
				<input name="date_2" class="date" id="date_2" size="15">
			</td>
			<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
			<td></td>
			<td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>
		  </tr>

		</table>
	</div>
</div>

<table id="dg_report_delivery" title="Report Delivery Order" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_report_delivery'
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true"></th>
			<th field="id_do" sortable="true" width="50" >ID DO</th>
			<th field="full_name" sortable="true" width="130">Courir</th>
			<th field="date_create" sortable="true" width="130">Date Create</th>			
			<th field="id_sro" sortable="true" width="120">ID SRO</th>
			<th field="id_ro" sortable="true" width="120">ID RO</th>
			<th field="full_name" sortable="true" width="120">Requestor</th>
			<th field="departement_name" sortable="true" width="120">Departemen</th>

	
		</tr>
	</thead>
</table>

<script>
	var url;
	$(document).ready(function(){

	
		$('.date').datepick({dateFormat: 'yyyy-mm-dd'});

		// reset 
		reset = function(){
			$('#date_1').val('');
			$('#date_2').val('');
			$('#dg_report_delivery').datagrid('load',{
				tgl : $('#date_create').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_delivery').datagrid('load',{
				date_1 : $('#date_1').val(),
				date_2 : $('#date_2').val()
			});
			//$('#dg').datagrid('enableFilter');
		}

	ExportExcel = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
     		
     		if (date_1 != '' && date_2 != ''){
				window.open('<?=base_url().'laporan_delivery/laporan_excel/'?>'+date_1+'/'+date_2);
			}else{
				$.messager.show({
				title: 'Warning',
				msg: 'Harap Isi Filter Terlabih Dahulu'
				});
			}  
    }

    ExportPdf = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
      		
      		if (date_1 != '' && date_2 != ''){
				window.open('<?=base_url().'laporan_delivery/laporan_pdf/'?>'+date_1+'/'+date_2);
			}else{
				$.messager.show({
				title: 'Warning',
				msg: 'Harap Isi Filter Terlabih Dahulu'
				});
			}      
    }


		$(function(){
			$('#dg_report_delivery').datagrid({
				url:"<?=base_url()?>laporan_delivery/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_delivery').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>49, 'policy'=>'ACCESS'))){?>
					{
						iconCls:'icon-excel',
						text:'Export Excel',
						handler:function(){
							ExportExcel();
						}
					},
				<?}?>
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>49, 'policy'=>'ACCESS'))){?>
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
