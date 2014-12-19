<form id="form1" method="post">
    <table class="tbl"  title="Detail Shipment Request Order">       
        <thead>
            <tr>
                <th width="80">Ext Doc No</th>
                <th width="80">Kode barang</th>
                <th width="80">Nama Barang</th>
                <th width="80">Create</th>
                <th width="120">Note</th>         
            </tr>
        </thead>
        <tbody>
                <?php 
                    foreach ($list as $l) {
                    echo"
                        <tr>
                        <td>".$l->ext_doc_no."</td>
                        <td>".$l->kode_barang."</td>
                        <td>".$l->nama_barang."</td>
                        <td>".$l->date_create."</td>
                        <td>".$l->note."</td>
                        </tr> ";
                        }
               
                 ?>
        </tbody>
    </table>
</form>
