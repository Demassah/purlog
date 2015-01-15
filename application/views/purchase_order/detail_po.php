 <h2 align='center'>Detail Vendor</h2>

<div class="detail" style="margin:10px">
<div class="fitem">
		<label style="width:80px">ID Vendor </label>:
			<?=$item[0]->id_vendor;?>
	</div>
	<div class="fitem" >
		<label style="width:80px">Vendor </label>:
			<?=$item[0]->name_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Contact </label>:
			<?=$item[0]->contact_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Mobile </label>:
			<?=$item[0]->mobile_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Address </label>:
			<?=$item[0]->address_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">TOP </label>:
			<?=$item[0]->top;?>
	</div>

	<table class="tbl" align="center">
		
		<thead align="center">
			<tr>
				<th>ID PO</th>
				<th>ID Detail PR</th>
				<th>Kode barang</th>
				<th>Nama Barang</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($item as $l) {
				echo " <tr align='center'>
				<td>".$l->id_po."</td>
				<td>".$l->id_detail_pr."</td>
				<td>".$l->kode_barang."</td>
				<td>".$l->nama_barang."</td>
				<td>".$l->qty."</td>
				<td>Rp.".number_format($l->price,2,',','.')."</td>
				<td>Rp.".number_format($l->total,2,',','.')."</td>
			</tr>
				";
			}
		?>
		</tbody>
	</table>
	<table>
			<tr>
					
					<td style="width:95%"></td>
        <td>
	        <?if($this->mdl_auth->CekAkses(array('menu_id'=>17, 'policy'=>'PDF'))){?>
	        <a href="#" onclick="cetakData()" class="easyui-linkbutton" iconCls="icon-pdf">Export </a>
	        <?}?>
        </td>
			</tr>		
		</table>

</div>
<script>
	var url;
	var id_po ='<?php echo $id_po;?>';
	$(document).ready(function(){

 		cetakData = function(val){    
        window.open(base_url+'purchase_order/laporan_pdf/'+ id_po);      
    }
  });
</script>