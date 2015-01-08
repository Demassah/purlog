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
				<tr><input type="hidden" name="detail_id[]" value="'.$l->id_detail_pr.'">
					<td>'.$l->kode_barang.'
							<input type="hidden" name="kode_barang[]" value="'.$l->kode_barang.'">
					</td>
					<td>'.$l->nama_barang.'
							<input type="hidden" name="ext_rec_no[]" value="'.$l->id_detail_pr.'">
					</td>
					<td>'.$l->id_lokasi.'
							<input type="hidden" name="lokasi[]" value="'.$l->id_lokasi.'">
					</td>
					<td>'.$l->asal.'
							<input type="hidden" name="asal" class="asal_'.$l->id_detail_pr.'" value="'.$l->asal.'">
					</td>
					<td>
							<div id="'.$l->id_detail_pr.'" class="inbound">
								<span class="text" value="'.$l->receive.'" id="receive_'.$l->id_detail_pr.'">'.$l->receive.'</span>
								<input type="text" name="receive[]" value="" class="editbox" id="receive_input_'.$l->id_detail_pr.'" size="2">
							</div>
					</td>
					<td>
							<input type="hidden" class="sisa_kurang2" id="sisa_kurang2_'.$l->id_detail_pr.'" value="'.$l->sisa.'">
							<span class="sisa">'.$l->sisa.'</span>
							<input type="text" class="sisa_kurang" id="sisa_kurang_'.$l->id_detail_pr.'" size = "2" readonly>
							<input type="hidden" id="sisa_'.$l->id_detail_pr.'" value="'.$l->sisa.'">
							<input type="hidden" name="id_in[]" value="'.$l->id_in.'">
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
$(".editbox").hide();
$(".sisa_kurang").hide();
$(".sisa_kurang2").hide();
	$(document).ready(function() {
		$("div").on('click', '.inbound', function(event) {
			var id_inbound = $(this).attr('id');
				$("#receive_"+id_inbound).hide();
				$("#receive_input_"+id_inbound).show();
				$("#receive_input_"+id_inbound).numericInput();

		}).change(function(event) {
			var id_inbound = $(this).attr('id');
			var masuk = $("#receive_input_"+id_inbound).val();
			var asal = $(".asal_"+id_inbound).val();
			var sisa = $("#sisa_"+id_inbound).val();
			var isi = $("#receive_"+id_inbound).val();
			var sisa2=sisa-isi;
			if(masuk > sisa2 || masuk == 0){
				alert("Data Tidak Boleh Kosong atau melebihi data yang ada");
			}else{
				var id_inbound = $(this).attr('id');
				var masuk = $("#receive_input_"+id_inbound).val();
				var sisa2 =	$("#sisa_kurang2_"+id_inbound).val();
				var sisa = sisa2-masuk;
				$("#sisa_kurang_"+id_inbound).val(sisa);
				$("#sisa_kurang_"+id_inbound).show();
				$(".sisa").hide();
			}

		});

		$(".editbox").mouseup(function() {
      return false
    });
    $(document).mouseup(function() {
      // $(".editbox").hide();
      // $(".text").show();
      // $(".editbox").prop('disabled', true);
    });

	});
</script>

