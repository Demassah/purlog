
<?php
	$out = '';
		$i=1;
		$color = '';
		foreach ($q as $r) {
			$color = ($i % 2 == 0)?'#FFFFFF':'#e6e6e6';
			echo '<tr>';
			echo '  <td bgcolor="'.$color.'">'.$i;
			echo '     <input type="hidden" name="data['.$i.'][id_stock]" value="'.$r->id_stock.'">';
			echo '     <input type="hidden" name="data['.$i.'][kode_barang]" value="'.$r->kode_barang.'">';
			echo '     <input type="hidden"  name="data['.$i.'][price]" value="'.$r->price.'">';
						  
			echo '  </td>';
			echo '  <td bgcolor="'.$color.'">'.$r->id_stock.'</td>';
			echo '  <td bgcolor="'.$color.'">'.$r->kode_barang.'</td>';
			echo '  <td bgcolor="'.$color.'">'.$r->nama_barang.'</td>';
			echo '  <td bgcolor="'.$color.'"><input type="hidden" id="qty_sisa_'.$i.'" value='.$r->qty.'>'.$r->qty.'</td>';
			echo '  <td bgcolor="'.$color.'">'.$r->price.'</td>';
			echo '  <td bgcolor="'.$color.'">'.$r->id_lokasi.'</td>';
			echo '  <td bgcolor="'.$color.'"><select id="id_lokasi" name="data['.$i.'][lokasi]" style="width:100px;">'
									.$this->mdl_prosedur->OptionLokasi().
								'</select></td>';
			echo '  <td bgcolor="'.$color.'"><div id='.$i.' class="D_Transfer"><input type="text" size="3" name="data['.$i.'][qty_trans]"  id="qty_input_'.$i.'"></div></td>';
			echo '  <td bgcolor="'.$color.'" align="center">';
			echo '   <label> <input style="margin-top:2px;" type="checkbox" name="data['.$i.'][chk]" id="checkbox"/>';
			echo '  </td>';
			echo '</tr>';
			$i++;
		}
		
		
	?>


<script type="text/javascript">
    $(document).ready(function() {
        $("div").on('change' ,'.D_Transfer', function(event) {
          var ID_detail = $(this).attr('id');
          $("#qty_input_"+ID_detail).numericInput();
    }).change(function(event) {
        var ID_detail = $(this).attr('id');
        var pick = parseInt($("#qty_input_"+ID_detail).val());
        var pick_qty = parseInt($("#qty_sisa_"+ID_detail).val());
        console.log(pick +' '+ pick_qty);
        if(pick > pick_qty || pick == 0 ){
             $("#qty_input_"+ID_detail).val("");
            alert("Nilai Melebihi sisa yang diajukan atau Nilai sama dengan Nol ");
        }
    });


});
</script>