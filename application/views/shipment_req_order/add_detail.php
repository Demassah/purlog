<form id="form1"  method="post" accept-charset="utf-8">
<input type="text" name="id_sro" value="<?=$id_sro?>"/>
    <table  title="Detail Shipment Request Order">      
        <thead>
            <tr>
                <th></th>
                <th sortable="true" width="120">ID RO</th>
                <th width="120">Ext Doc No</th>
                <th width="80">Kode Barang</th>
                <th width="200">Nama Barang</th>
                <th width="10">QTY</th>        
            </tr>
             <?php foreach ($list as $l) {
            echo"
                <tr>
                <td align='center'><input type='checkbox' name='item' value='$l->kode_barang'></td>
                <td>$l->id_ro</td>
                <td>$l->ext_doc_no</td>
                <td>$l->kode_barang</td>
                <td>$l->nama_barang</td>
                <td>$l->qty</td>
                </tr> ";
                }
        ?> 
        </thead>
    </table>
</form>
