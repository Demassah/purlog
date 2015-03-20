<div id="toolbar_report_inventory" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="670" border="0">
		  <tr>
			<td>Search By Date</td>
			<td>: 
				<input class="date" name="date_1"  id="date_1" size="15">
			</td>
			<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
		  	<td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>

		  </tr>

		</table>
	</div>
</div>

<table id="dg_report_inventory" title="Report inventory" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_report_inventory'
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true"></th>
			<th field="id_stock" sortable="true" width="100" >ID Stock</th>
			<th field="kode_barang" sortable="true" width="130">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="130">Nama Barang</th>
			<th field="masuk" sortable="true" width="90">Qty In</th>
			<th field="keluar" sortable="true" width="90">Qty Out</th>
			<th field="stock" sortable="true" width="90">Qty Stock</th>
			<th field="price" sortable="true" width="120">price</th>
			<th field="id_lokasi" sortable="true" width="120">Lokasi</th>
			

	
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
			$('#supplier').val('');
			$('#kode_barang').val('');
			$('#dg_report_inventory').datagrid('load',{
				tgl : $('#date_create').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_inventory').datagrid('load',{
				date_1 : $('#date_1').val(),
				date_2 : $('#date_2').val(),
				supplier : $('#supplier').val(),
				kode_barang : $('#kode_barang').val()
			});
			//$('#dg').datagrid('enableFilter');
		}

	ExportExcel = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
     		
     		if (date_1 != '' ){
				window.open('<?=base_url().'laporan_persediaan/laporan_excel_kode/'?>'+date_1);
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
				window.open('<?=base_url().'laporan_persediaan/laporan_pdf/'?>'+date_1+'/'+date_2);
			}else{
				$.messager.show({
				title: 'Warning',
				msg: 'Harap Isi Filter Terlabih Dahulu'
				});
			}  
    }


		$(function(){
			$('#dg_report_inventory').datagrid({
				url:"<?=base_url()?>laporan_persediaan/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_inventory').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>54, 'policy'=>'EXCEL'))){?>
					{
						iconCls:'icon-excel',
						text:'Export Excel',
						handler:function(){
							ExportExcel();
						}
					},
				<?}?>
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>54, 'policy'=>'PDF'))){?>
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
