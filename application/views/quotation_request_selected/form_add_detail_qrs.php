<form id="form_add_detail" method="post">
<table class="tbl" id="dg" title="Detail Shipment Request Order" >       
    <thead>
        <tr align="center">
            <th><input type="checkbox" id="check-all"> <label for="check-all"></label></th>
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
                    <td align='center'><input type='checkbox' id='$d[id_detail_pr]' name='id_detail_pr[]' class='checkbox' checked='checked' value='$d[id_detail_pr]'>
                    <td>$d[id_detail_pr]</td>
                    <td><input type='hidden' name='id_pr[]' value='$d[id_pr]'>$d[id_pr]</td>
                    <td><input type='hidden' name='id_qrs[]' value='$d[id_qrs]' size='3'>$d[id_qrs]</td>
                    <td><input type='hidden' name='kode_barang[]' value='$d[kode_barang]'>$d[kode_barang]</td>
                    <td>$d[nama_barang]</td>
                    <td>$d[qty]</td>
                    <td><input type='hidden'  id='pick_qty_$d[qty]' value='$d[qty]' >$d[sisa]</td>
                    <td id='$d[id_detail_pr]'><div id='$d[id_detail_pr]' class='qrs'><input type='text'  id='pick_input_$d[id_detail_pr]' name='pick[]' value='' size='7'></div></td>
                    </td>
                </tr> ";

                }
            ?>
    </tbody>
</table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
         $('input[type="checkbox"]').click(function(){
            var id_detail = $(this).attr('id');
                if($(this).prop("checked") == true){
                    $("#check_"+id_detail).show();
                }
                else if($(this).prop("checked") == false){
                    $("#check_"+id_detail).hide();
                }
            });
         $(function(){ //Sama jika menggunakan $(document).ready(function(){
             $("#check-all").click(function(){
                if ( (this).checked == true ){
                   $('.checkbox').prop('checked', true);
                   $('.checkbox').show();
                } else {
                   $('.checkbox').prop('checked', false);
                    $('.checkbox').hide();
                }
             });
        });
    });
</script>
<!--<script type="text/javascript">
    $(document).ready(function() {
        $("td").on('click' ,'.qrs', function(event) {
          var ID_detail = $(this).attr('id');
    }).change(function(event) {
        var ID_detail = $(this).attr('id');
        var pick = $("#pick_input_"+ID_detail).val();
        var pick_qty = $("#pick_qty_"+ID_detail).val();
        $(pick).numericInput();
        if(pick => pick_qty ){
            alert("Qty melebihi Qty yang ada");
        }
    });
});
</script>-->
