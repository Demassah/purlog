<form id="form1" method="post">
    <table class="tbl" id="dg" title="Detail Shipment Request Order">       
        <thead>
            <tr>
                <th width="20"></th>
                <th width="20">ID SRO</th>
                <th width="120">Create</th>
                <th width="120">Requestor</th>         
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</form>


