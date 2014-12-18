<form id="form1" method="post">
<input type="hidden" name="id_sro" value="<?=$id_sro?>"/>
<table class="tbl" id="dg" title="Detail Shipment Request Order">       
    <thead>
        <tr>
            <th width="20"></th>
            <th width="120">ID SRO</th>
            <th width="120">ID RO</th>
            <th width="120">ID Item</th>
            <th width="80">Item Name</th>
            <th width="100">Lokasi</th>          
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            foreach ($list as $d) {
            echo"
                <tr>
                <td align='center'><input type='checkbox' name='id_detail_pros[]'  value='$d[id_detail_pros]'>
                <input type='hidden' name='id_sro'  value='$id_sro'></td>
                <td>$id_sro</td>
                <td>$id_ro</td>
                <td>$d[kode_barang]</td>
                <td>$d[nama_barang]</td>
                <td>$d[id_lokasi]</td>
                </tr> ";

                }
               
            ?>
    </tr>
    </tbody>
</table>
</form>
