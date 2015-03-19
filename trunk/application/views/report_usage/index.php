<div id="toolbar_report_buy" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="800" border="0">
		  <tr>
			<td>Search By Date</td>
			<td>: 
				<input class="date" name="date_1"  id="date_1" size="15">
			</td>
			<td>To</td>
			<td>
				<input name="date_2" class="date" id="date_2" size="15">
			</td>
			<td>Kode Barang</td>
		  	<td>
		  		<input name="kode_barang"  id="kode_barang" size="15">
		  	</td>
			<td><a href="#" onclick="filter()" class="easyui-linkbutton" iconCls="icon-search">Search</a></td>
			
		  </tr>
		  <tr>
		  	<td>No Rangka</td>
		  	<td>:
		  		<input name="no_rangka"  id="no_rangka" size="15">
		  	</td>
		  	<td>No Polisi</td>
		  	<td>
		  		<input name="no_polisi"  id="no_polisi" size="15">
		  	</td>
		  	<td></td>
		  	<td></td>
					<td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>
		  	
		  </tr>

		</table>
	</div>
</div>

<table id="dg_report_usage" title="Report usage" data-options="
			rownumbers:true,
			singleSelect:true,
			autoRowHeight:false,
			pagination:true,
			pageSize:30,
			fit:true,
			toolbar:'#toolbar_report_buy'
			">
	<thead>
		<tr>
			<th field="" sortable="true" width="150" hidden="true"></th>
			<th field="id_detail_pros" sortable="true" width="120" >ID Pros Detail</th>
			<th field="no_rangka" sortable="true" width="130">No Rangka</th>
			<th field="no_polisi" sortable="true" width="130">No Polisi</th>
			<th field="kode_barang" sortable="true" width="180">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="120">Nama Barang</th>
			<th field="qty" sortable="true" width="120">Qty </th>
			<th field="price" sortable="true" width="120">price</th>
			<th field="total" sortable="true" width="120">Total</th>
			<th field="date_create" sortable="true" width="180">Date Create</th>

	
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
			$('#no_rangka').val('');
			$('#kode_barang').val('');
			$('#no_polisi').val('');
			$('#dg_report_usage').datagrid('load',{
				tgl : $('#date_create').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_usage').datagrid('load',{
				date_1 : $('#date_1').val(),
				date_2 : $('#date_2').val(),
				no_rangka : $('#no_rangka').val(),
				no_polisi : $('#no_polisi').val(),
				kode_barang : $('#kode_barang').val(),
				
			});
			//$('#dg').datagrid('enableFilter');
		}

    ExportPdf = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
			var no_rangka = $('#no_rangka').val();
			var kode_barang = $('#kode_barang').val();
			var no_polisi = $('#no_polisi').val();
      		if (date_1 != '' && date_2 != ''){
				window.open('<?=base_url().'laporan_usage/laporan_pdf/'?>'+date_1+'/'+date_2);
			}else{
				if(no_rangka !=''){
					window.open('<?=base_url().'laporan_usage/laporan_pdf_rangka/'?>'+no_rangka);
				}else{
					if(kode_barang !=''){
						window.open('<?=base_url().'laporan_usage/laporan_pdf_kode/'?>'+kode_barang);
					}else{
						if(no_polisi !=''){
						window.open('<?=base_url().'laporan_usage/laporan_pdf_polisi/'?>'+no_polisi);
						}else{
							$.messager.show({
							title: 'Warning',
							msg: 'Harap Isi Filter Terlabih Dahulu'
							});
						}
					}
				}
			}
    }

    ExportExcel = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
			var no_rangka = $('#no_rangka').val();
			var kode_barang = $('#kode_barang').val();
			var no_polisi = $('#no_polisi').val();
      		if (date_1 != '' && date_2 != ''){
				window.open('<?=base_url().'laporan_usage/laporan_excel/'?>'+date_1+'/'+date_2);
			}else{
				if(no_rangka !=''){
					window.open('<?=base_url().'laporan_usage/laporan_excel_rangka/'?>'+no_rangka);
				}else{
					if(kode_barang !=''){
						window.open('<?=base_url().'laporan_usage/laporan_excel_kode/'?>'+kode_barang);
					}else{
						if(no_polisi !=''){
						window.open('<?=base_url().'laporan_usage/laporan_excel_polisi/'?>'+no_polisi);
						}else{
							$.messager.show({
							title: 'Warning',
							msg: 'Harap Isi Filter Terlabih Dahulu'
							});
						}
					}
				}
			}
    }


		$(function(){
			$('#dg_report_usage').datagrid({
				url:"<?=base_url()?>laporan_usage/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_usage').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>57, 'policy'=>'EXCEL'))){?>
					{
						iconCls:'icon-excel',
						text:'Export Excel',
						handler:function(){
							ExportExcel();
						}
					},
				<?}?>
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>57, 'policy'=>'PDF'))){?>
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
