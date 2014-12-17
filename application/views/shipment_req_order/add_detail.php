<form id="form1" method="post" style="margin:10px">
    <table>
        <thead>
            <tr>
                <th></th>
                <th>ID RO</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        <?php 
        foreach ($list as $d) {
        echo"
            <tr>
            <td align='center'><input type='checkbox' name='id_detail_pros[]'  value='$d[id_detail_pros]'></td>
            <td align='center'><input name='id_sro'  value='$id_sro'></td>
            <td>$id_ro</td>
            <td>$id_sro</td>
            <td>$d[kode_barang]</td>
            <td>$d[nama_barang]</td>
            </tr> ";
            }
           
        ?>
            <tr>
            <!-- <td><input type='reset' value='Reset'></td>
            <td><input type='submit' name='submit' onclick="saveData()"value='Simpan'></td> -->
            </tr>
         </tr>
        </tbody>
    </table>
</form>

