<form id="form_add_detail" method="post">
<table class="tbl" id="dg" title="Detail Shipment Request Order" >       
    <thead>
        <tr align="center">
            <th width="80">ID Detail PR</th>
            <th width="80">ID PR</th>
            <th width="80">ID QRS</th>
            <th width="90">Kode Barang</th>
            <th width="150">Nama Barang</th>
            <th width="70">Asal Qty</th>
            <th width="70">Sisa Qty</th>
            <th width="70">Pick</th>

        </tr>
    </thead>
    <tbody>
            <?php 
            foreach ($list as $d) {
            echo"
                <tr id='check_$d[id_detail_pr]' align='center' class='checkbox'>

                    <td><input type='hidden' id='$d[id_detail_pr]' name='id_detail_pr' class='detail_pr' value='$d[id_detail_pr]'>$d[id_detail_pr]</td>
                    <td><input type='hidden' class='id_pr' name='id_pr[]' value='$d[id_pr]'>$d[id_pr]</td>
                    <td><input type='hidden' class='id_qrs' name='id_qrs[]' value='$d[id_qrs]' size='3'>$d[id_qrs]</td>
                    <td><input type='hidden' name='kode_barang[]' value='$d[kode_barang]'>$d[kode_barang]</td>
                    <td>$d[nama_barang]</td>
                    <td>$d[qty]</td>
                    <td><input type='hidden'  id='pick_sisa_$d[id_detail_pr]' value='$d[sisa]' >$d[sisa]</td>
                    <td id='$d[id_detail_pr]'><div id='$d[id_detail_pr]' class='qrs'><input type='text'  id='pick_input_$d[id_detail_pr]'  class='pick_input' name='pick' value='' size='4'></div></td>
                </tr> ";

                }
            ?>
    </tbody>
</table>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $("div").on('change' ,'.qrs', function(event) {
          var ID_detail = $(this).attr('id');
          $("#pick_input_"+ID_detail).numericInput();
    }).change(function(event) {
        var ID_detail = $(this).attr('id');
        var pick = parseInt($("#pick_input_"+ID_detail).val());
        var pick_qty = parseInt($("#pick_sisa_"+ID_detail).val());
        console.log(pick +' '+pick_qty);
        if(pick > pick_qty || pick == 0 ){
             $("#pick_input_"+ID_detail).val("");
            alert("Nilai Melebihi sisa yang diajukan atau Nilai sama dengan Nol ");
        }
    });


});
</script>
