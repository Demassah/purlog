<div id="toolbar_report_purchase" style="padding:5px;height:auto">
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

<table id="dg_report_purchase" title="Report Purchase" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_report_purchase'
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true"></th>
			<th field="id_pr" sortable="true" width="80" >ID PR</th>
			<th field="id_ro" sortable="true" width="80">ID RO</th>
			<th field="id_detail_ro" sortable="true" width="80">ID Detail RO</th>
			<th field="kode_barang" sortable="true" width="120">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="130">Nama Barang</th>
			<th field="full_name" sortable="true" width="120">Requestor</th>
			<th field="date_create" sortable="true" width="120">Date Create</th>
			<th field="note" sortable="true" width="120">Note</th>

	
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
			$('#dg_report_purchase').datagrid('load',{
				tgl : $('#date_create').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_purchase').datagrid('load',{
				date_1 : $('#date_1').val(),
				date_2 : $('#date_2').val()
			});
			//$('#dg').datagrid('enableFilter');
		}

		ExportExcel = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
			
      		if (date_1 != '' && date_2 != ''){
				window.open(base_url+'laporan_purchase/laporan_excel/'+ date_1 + "/" + date_2);  
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
				window.open('<?=base_url().'laporan_purchase/laporan_pdf/'?>'+date_1+'/'+date_2);
			}else{
				$.messager.show({
				title: 'Warning',
				msg: 'Harap Isi Filter Terlabih Dahulu'
				});
			}  
    }



		$(function(){
			$('#dg_report_purchase').datagrid({
				url:"<?=base_url()?>laporan_purchase/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_purchase').datagrid().datagrid('getPager');	// get the pager of datagrid
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
