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
								<span class="text" value="'.$l->receive.'" id="receive_'.$l->id_detail_pr.'">'.$l->receive.'</span>
					</td>
					<td><div id="'.$l->id_detail_pr.'" class="inbound">
							<span id="sisa_"'.$l->id_detail_pr.'">'.$l->sisa.'</span>
							<input type="text" name="sisa[]" value="" class="editbox" id="sisa_input_'.$l->id_detail_pr.'" size="2">
							<input type="hidden" name="id_in[]" value="'.$l->id_in.'">
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
$(".editbox").hide();
	$(document).ready(function() {
		$("div").on('click', '.inbound', function(event) {
			var id_inbound = $(this).attr('id');
				$("#sisa_"+id_inbound).hide();
				$("#sisa_input_"+id_inbound).show();
				$("#sisa_input_"+id_inbound).numericInput();

		}).change(function(event) {
			var id_inbound = $(this).attr('id');
			var masuk = $("#sisa_input_"+id_inbound).val();
			var sisa = $("#sisa_"+id_inbound).val();
			if(masuk>sisa){
				alert("Data Tidak Boleh Kosong atau melebihi data yang ada");
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

