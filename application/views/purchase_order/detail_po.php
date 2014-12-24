 <h2 align='center'>Detail Vendor</h2>

<div class="detail">
<div class="fitem">
		<label style="width:80px">ID Vendor </label>:
			<?=$list->id_vendor;?>
	</div>
	<div class="fitem" >
		<label style="width:80px">Vendor </label>:
			<?=$list->name_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Contact </label>:
			<?=$list->contact_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Mobile </label>:
			<?=$list->mobile_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">Address </label>:
			<?=$list->address_vendor;?>
	</div>
	<div class="fitem">
		<label style="width:80px">TOP </label>:
			<?=$list->top;?>
	</div>

	<table class="tbl">
		
		<thead>
			<tr>
				<th>Kode barang</th>
				<th>Nama Barang</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach ($item as $l) {
				echo " <tr>
				<td>".$l->kode_barang."</td>
				<td>".$l->nama_barang."</td>
				<td>".$l->price."</td>
			</tr>
				";
			}
		?>
		</tbody>
	</table>

</div>