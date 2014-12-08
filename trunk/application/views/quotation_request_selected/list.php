<script type="text/javascript">
    listSRO = function (){
            $('#dialog').dialog({
                title: 'Add Vendor',
                width: $(window).width() * 0.7,
                height: $(window).height() * 0.7,
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
        <tr>
            <th> </th>
            <th>PT. Demas Nusantara</th>
            <th>PT. Demas Nusantara</th>
            <th>PT. Demas Nusantara</th>
        </tr>
        <tr>
            <th>TOP</th>
            <td>12</td>
            <td>11</td>
            <td>10</td>
        </tr>
        <tr>
            <th>Ban</th>
            <td>Rp.12000</td>
            <td>Rp.11000</td>
            <td>Rp.10000</td>
        </tr>

        <tr>
            <th>Busi</th>
            <td>Rp.1200</td>
            <td>Rp.1100</td>
            <td>Rp.1000</td>
        </tr>   
    </thead>
</table>
