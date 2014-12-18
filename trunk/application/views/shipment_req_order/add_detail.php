<form id="form1" method="post" style="margin:10px">
    <input type="hidden" name="id_sro" value="<?=$id_sro?>"/>
    <table  title="Detail Shipment Request Order">      
        <thead>
            <tr>
                <th></th>
                <th>ID SRO</th>
                <th>ID RO</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
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
                    </tr> ";

                    }
                   
                ?>
             </tr>
        </tbody>

    </table>
</form>
