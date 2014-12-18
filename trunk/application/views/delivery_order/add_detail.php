<form id="form1" method="post" style="margin:10px">
    <table border='1'>
        <thead>
            <tr>
                <th></th>
                <th>ID SRO</th>
                <th>Create</th>
                <th>Requestor</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        <?php 
        foreach ($list as $d) {
        echo"
            <tr>
            <td align='center'><input type='checkbox' name='id_sro[]'  value='$d[id_sro]'>
            <input type='hidden' name='id_do'  value='$id_do'></td>
            <td>$d[id_sro]</td>
            <td>$d[date_create]</td>
            <td>$d[full_name]</td>
            </tr> ";
            }
        ?>
         </tr>
        </tbody>
    </table>
</form>

