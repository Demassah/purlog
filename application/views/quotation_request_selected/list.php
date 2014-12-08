<script type="text/javascript">
    listSRO = function (){
            $('#dialog').dialog({
                title: 'Add Vendor',
                width: $(window).width() * 0.8,
                height: $(window).height() * 0.99,
                closed: true,
                cache: false,
                href: base_url+'quotation_request_selected/add',
                modal: true
            });
             
            $('#dialog').dialog('open');
            url = base_url+'departement/save/add';
        }
</script>
<div id="toolbar_detail" style="padding:5px;height:auto">
  <div class="fsearch">
    <table>
      <tr>
          <td>
            <td>&nbsp;&nbsp;<a href="#" onclick="listSRO()" class="easyui-linkbutton" iconCls="icon-detail">Add </a></td>
          </td> 
      </tr>     
    </table>
  </div>
</div>
<?php
echo 'Quotation List <br>';
$header = TRUE;
$counter = 0;
$_crossfield = array(' ', 'TOP', 'Price');
$_colname = array(0=>"supplier_nama", 1=>"top", 2=>"price");
?>
<table border='1' title="Detail Purchase Request" data-options="
            rownumbers:true,
            singleSelect:false,
            pagination:true,
            autoRowHeight:false,
            fit:true,
            toolbar:'#toolbar_pending'
        "> 
    <thead>
        <?php
        foreach ($_crossfield as $rows) {
            $_columns = explode(',', $dataset[0][$_colname[$counter]]);
            
            echo '<tr>';
            if(!$header) {
                echo '<th>'.$rows.'</th>';                
                
                foreach ($_columns as $cols) {
                    echo '<td>'.$cols.'</td>';
                }
                
            } else {
                echo '<th>'.$rows.'</th>';
                
                foreach ($_columns as $cols) {
                    echo '<th>'.$cols.'</th>';
                }
            }
            echo '</tr>';
            
            $header = FALSE;
            $counter++;
        }?>
    </thead>
</table>
  