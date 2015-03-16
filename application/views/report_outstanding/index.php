<div id="toolbar_report_buy" style="padding:5px;height:auto">
	<div style="margin-bottom:5px">		
	</div>
	<div class="fsearch">
		<table width="670" border="0">
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
			
		  </tr>
		  <tr>
		  	<td>Supplier</td>
		  	<td>:
		  		<input name="supplier"  id="supplier" size="15">
		  	</td>
		  	<td>Kode Barang</td>
		  	<td>
		  		<input name="kode_barang"  id="kode_barang" size="15">
		  	</td>
		  	<td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>
		  </tr>

		</table>
	</div>
</div>

<table id="dg_report_outstanding" title="Report Outstanding" data-options="
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
			<th field="id_po" sortable="true" width="50" >ID PO</th>
			<th field="name_vendor" sortable="true" width="130">Supplier</th>
			<th field="kode_barang" sortable="true" width="130">Kode Barang</th>
			<th field="nama_barang" sortable="true" width="180">Nama Barang</th>
			<th field="dipesan" sortable="true" width="120">Qty Dipesan</th>
			<th field="diterima" sortable="true" width="120">Qty Diterima</th>
			<th field="outstanding" sortable="true" width="120">Qty OutStanding</th>
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
			$('#supplier').val('');
			$('#kode_barang').val('');
			$('#dg_report_outstanding').datagrid('load',{
				tgl : $('#date_create').val(),
				
				
			});
		}

		filter = function(){
			$('#dg_report_outstanding').datagrid('load',{
				date_1 : $('#date_1').val(),
				date_2 : $('#date_2').val(),
				supplier : $('#supplier').val(),
				kode_barang : $('#kode_barang').val()
			});
			//$('#dg').datagrid('enableFilter');
		}

    ExportPdf = function(val){
			var date_1 = $('#date_1').val();
			var date_2 = $('#date_2').val();
			var supplier = $('#supplier').val();
			var kode_barang = $('#kode_barang').val();
      		if (date_1 != '' && date_2 != ''){
				window.open('<?=base_url().'laporan_outstanding/laporan_pdf/'?>'+date_1+'/'+date_2);
			}else{
				if(supplier !=''){
					window.open('<?=base_url().'laporan_outstanding/laporan_pdf_supp/'?>'+supplier);
				}else{
					if(kode_barang !=''){
						window.open('<?=base_url().'laporan_outstanding/laporan_pdf_kode/'?>'+kode_barang);
					}else{
						$.messager.show({
						title: 'Warning',
						msg: 'Harap Isi Filter Terlabih Dahulu'
						});
					}
				}
			}
    }


		$(function(){
			$('#dg_report_outstanding').datagrid({
				url:"<?=base_url()?>laporan_outstanding/grid"
			});
		});
		
		//# Tombol Bawah
		$(function(){
			var pager = $('#dg_report_outstanding').datagrid().datagrid('getPager');	// get the pager of datagrid
			pager.pagination({
				buttons:[
				<?if($this->mdl_auth->CekAkses(array('menu_id'=>60, 'policy'=>'PDF'))){?>
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
