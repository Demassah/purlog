<script>
  
  var url;
  $(document).ready(function(){
  var id_return = <?php echo $id_return;?>;

    tambahDetail = function (val){
        if(val==null){
          var row = $('#dg').datagrid('getData');              
          var id = id_return;
          val = id;
        }

      $('#dialog_kosong').dialog({
        title: 'Tambah Detail Return Detail',
        width: $(window).width() * 0.88,
        height: $(window).height() * 0.99,
        closed: true,
        cache: false,
        href: base_url+'retur/add_detail_return/' + val,
        modal: true
      });      
      $('#dialog_kosong').dialog('open');
      url = base_url+'retur/save_detail_return/add_detail';
    }
    // end newData

    back = function (){
      $('#konten').panel({
        href:base_url+'retur/index'
      });
    }
    
    
  $(function(){ // init
      $('#dg').datagrid({url:"retur/grid_detail/<?=$id_return?>"});  
  }); 

  //# Tombol Bawah
    $(function(){
      var pager = $('#dg').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
        <?if($this->mdl_auth->CekAkses(array('menu_id'=>21, 'policy'=>'ADD'))){?>
          {
            iconCls:'icon-add',
            text:'Tambah Detail',
            handler:function(){
              tambahDetail();
            }
          },
        <?}?>
           {
            iconCls:'icon-undo',
            text:'Kembali',
            handler:function(){
              back();
            }
          }              
        ]
      });     
    }); 
    
  });
</script>

<table id="dg" title ="Detail Return" data-options="
      rownumbers:true,
      singleSelect:false,
      pagination:true,
      autoRowHeight:false,
      fit:true,
      toolbar:'#toolbar_detail',
    ">    
  <thead>
    <tr>
      <th field="id_detail_return" sortable="true" width="100">ID Detail Return</th>
      <th field="id_return" sortable="true" width="80">ID Return</th>
      <th field="id_receive" sortable="true" width="80">ID Receive</th>
      <th field="id_detail_receive" sortable="true" width="100">ID Detail Receive</th>
      <th field="id_detail_pros" sortable="true" width="100">ID Detail Pros</th>
      <th field="id_ro" sortable="true" width="80">ID RO</th>
      <th field="id_detail_ro" sortable="true" width="100">ID Detail RO</th>
      <th field="kode_barang" sortable="true" width="100">Kode Barang</th>
      <th field="nama_barang" sortable="true" width="100">Nama Barang</th>
      <th field="qty" sortable="true" width="60">Qty</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
    </tr>
  </thead>
</table>

