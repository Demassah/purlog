<script>
  
  var url;
  $(document).ready(function(){
    var id_pr = <?php echo $id_pr;?>;

    /*detail = function (val){      
      if(val==null){
          var row = $('#dg_detailpr').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/detail/' + val,
      });
    }

    pending = function (val){
       if(val==null){
          var row = $('#dg_detailpr').datagrid('getData');              
          var id = id_ro;
          val = id;
      }
      $('#konten').panel({
        href: base_url+'picking_req_order_selected/pending/' + val,
      });
    }*/

    Checkbox = function(value, row, index){
      return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>';
    }
      
    $(function(){ // init
      $('#dg_detailpr').datagrid({url:"purchase_request/grid_detailPR/<?=$id_pr?>"}); 
    }); 


    //# Tombol Bawah 
    // $(function(){
    //   var pager = $('#dg_detailpr').datagrid().datagrid('getPager'); // get the pager of datagrid
    //   pager.pagination({
    //     buttons:[
    //       {
    //         iconCls:'icon-ok',
    //         text:'Save',
    //         handler:function(){
    //           saveData();
    //         }
    //       },
    //       {
    //         iconCls:'icon-print',
    //         text:'Print Picklist',
    //         handler:function(){
    //           c();
    //         }
    //       }               
    //     ]
    //   });     
    // });
    
    
  });
</script>

<table id="dg_detailpr" data-options="
    rownumbers:true,
    singleSelect:true,
    autoRowHeight:false,
    pageSize:30,
    fit:true,
    
    ">    
   <thead>
    <tr>
      <th field="id_detail_pros" sortable="true" width="150" hidden="true">ID</th>
      <th field="id_ro" sortable="true" width="100">ID RO</th>
      <th field="id_stock" sortable="true" width="100">ID Stock</th>
      <th field="kode_barang" sortable="true" width="120">ID Barang</th>
      <th field="nama_barang" sortable="true" width="130">Nama Barang</th>
      <th data-options="field:'qty',width:'100'" editor="text">Qty</th>    
      <th field="id_lokasi" sortable="true" width="100">Lokasi</th>
      <!-- <th field="action" align="center" formatter="actionAvailable" width="80">Aksi</th> -->
    </tr>
  </thead>
</table>


