<form id="form1" method="post">
    <table class="tbl"  title="Detail Shipment Request Order">       
        <thead>
            <tr>
                <th width="80">Id Detail RO</th>
                <th width="80">Id RO</th>
                <th width="80">Id Barang</th>
                <th width="80">Item Name</th>
                <th width="20">Qty</th>
                <th width="90">lokasi</th>

            </tr>
        </thead>
        <tbody>
                <?php 
                    foreach ($list as $l) {
                    echo"
                        <tr>
                        <td>".$l->id_detail_ro."</td>
                        <td>".$l->id_ro."</td>
                        <td>".$l->kode_barang."</td>
                        <td>".$l->nama_barang."</td>
                        <td>".$l->qty."</td>
                        <td>".$l->id_lokasi."</td>
                        </tr> ";
                        }
                 ?>
        </tbody>
    </table>
</form>
