<div id="toolbar" style="padding:5px;height:auto">
  <div class="fsearch">
  </div>
</div>
<div id="qrs_table">
<form name="form2" id="form2" method="post">
	<table class="tbl">
		<thead>
			<tr>
				<th width="120">Kode Barang</th>
				<th width="120">Nama Barang</th>
				<th width="120">Lokasi</th>
				<th width="120">Qty</th>
				<th width="120">Receive</th>
				<th width="120">remaining</th>

			</tr>
		</thead>
		<tbody>
		<?php
			foreach ($list as $l) {
			echo '
				<tr><input type="hidden" name="detail_id[]" value="'.$l->id_detail_qrs.'">
					<td>'.$l->kode_barang.'
							<input type="hidden" name="kode_barang[]" value="'.$l->kode_barang.'">
					</td>
					<td>'.$l->nama_barang.'
							<input type="hidden" name="ext_rec_no[]" value="'.$l->id_detail_qrs.'">
					</td>
					<td><select id="id_lokasi" name="lokasi[]" style="width:100px;">'.$this->mdl_prosedur->OptionLokasi().'
								
							</select>
					</td>
					<td>'.$l->asal.'
							<input type="hidden" name="asal" class="asal_'.$l->id_detail_qrs.'" value="'.$l->asal.'">
					</td>
					<td>
								<span class="text" value="'.$l->receive.'" id="receive_'.$l->id_detail_qrs.'">'.$l->receive.'</span>
					</td>
					<td><div id="'.$l->id_detail_qrs.'" class="inbound">
							<span id="sisa_"'.$l->id_detail_qrs.'">'.$l->sisa.'</span>
							<input type="hidden" value="'.$l->sisa.'" id="sisa_'.$l->id_detail_qrs.'" size="2">
							<input type="text" name="sisa[]" value="" id="sisa_input_'.$l->id_detail_qrs.'" size="2">
							<input type="hidden" name="id_in[]" value="'.$l->id_in_asal.'">
							</div>
					</td>
				</tr>
			';

			}
		?>
	</tbody>
	</table>

</form>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		$("div").on('change', '.inbound', function(event) {
			var id_inbound = $(this).attr('id');
				$("#sisa_"+id_inbound).hide();
				$("#sisa_input_"+id_inbound).show();
				$("#sisa_input_"+id_inbound).numericInput();

		}).change(function(event) {
			var id_inbound = $(this).attr('id');
			var masuk = parseInt($("#sisa_input_"+id_inbound).val());
			var sisa = parseInt($("#sisa_"+id_inbound).val());
			 console.log(masuk +' '+ sisa);
			if(masuk > sisa){
				alert("Data Tidak Boleh Kosong atau melebihi data yang ada");
			}
			

		});

		$(".editbox").mouseup(function() {
      return false
    });

	});
</script>

