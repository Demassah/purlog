<form id="form1" method="post">
<table class="tbl" id="dg" title="Detail Shipment Request Order" >       
    <thead>
        <tr>
            <th width="20"></th>
            <th width="80">ID Detail PR</th>
            <th width="80">ID PR</th>
            <th width="80">ID QRS</th>
            <th width="80">Kode Barang</th>
            <th width="150">Nama Barang</th>
            <th width="70">Qty</th>
            <th width="70">Pick</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            foreach ($list as $d) {
            echo"
                <tr>
                    <td align='center'><input type='hidden' name='id_detail_pr[]'  value='".$d->id_detail_pr."'>".$d->id_detail_pr."</td>
                    <td>".$d->id_detail_pr."</td>
                    <td><input type='hidden' name='id_pr[]' value='".$d->id_pr."' size='3'>".$d->id_pr."</td>
                    <td><input type='hidden' name='id_qrs[]' value='".$d->id_qrs."' size='3'>".$d->id_qrs."</td>
                    <td><input type='hidden' name='kode_barang[]' value='".$d->kode_barang."'>".$d->kode_barang."</td>
                    <td>".$d->nama_barang."</td>
                    <td ><input type='hidden'  id='pick_qty_".$d->qty."' value='".$d->qty."' >".$d->qty."</td>
                    <td id='".$d->id_detail_pr."'><div id='".$d->id_detail_pr."' class='qrs'><input type='text'  id='pick_input_".$d->id_detail_pr."' name='pick[]' value='' size='7'></div></td>
                </tr> ";

                }
               
            ?>
    </tbody>
</table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("td").on('click' ,'.qrs', function(event) {
          var ID_detail = $(this).attr('id');
    }).change(function(event) {
        var ID_detail = $(this).attr('id');
        var pick = $("#pick_input_"+ID_detail).val();
        var pick_qty = $("#pick_qty_"+ID_detail).val();
        $(pick).numericInput();
        if(pick => pick_qty || pick_qty==0){
            alert("Qty melebihi Qty yang ada");
        }
    });
});
</script>