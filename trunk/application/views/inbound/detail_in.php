<table id="dg_detail_in" title ="Detail inbound" data-options="
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			autoRowHeight:false,
			fit:true,
			toolbar:'#toolbar_detail',
		">		
	<thead>
		<tr>
			<th field="id_detail_in" sortable="true" width="150">ID Detail In</th>
      <th field="id_in" sortable="true" width="80">ID In</th>
      <th field="kode_barang" sortable="true" width="120">Kode Barang</th>
      <th field="nama_barang" sortable="true" width="120">Nama Barang</th>
      <th field="qty" sortable="true" width="70">Qty</th>
      <th field="ext_rec_no_detail" sortable="true" width="120">Detail Rec No</th>
      <th field="lokasi" sortable="true" width="70">Lokasi</th>
      <th field="status" sortable="true" width="70">Status</th>
		</tr>
	</thead>
</table>
<?
  foreach ($item as $l) {
    echo '<input type="hidden" id="ext_rec_no" value="'.$l->ext_rec_no.'">';
    echo '<input type="hidden" id="type" value="'.$l->type.'">';
  }
?>

<script>
  
  var url;
  $(document).ready(function(){
    var ext = $("#ext_rec_no").val();
    var type = $("#type").val();
    var id_in = <?php echo $id_in;?>;

    tambahDetail = function (val){
        if(val==null){
          var row = $('#dg_detail_in').datagrid('getData');              
          var id = ext;
          var type = $("#type").val();
          val = id;
         
        }

      $('#dialog').dialog({
        title: 'Tambah Detail inbound',
        width: 500,
        height: 200,
        closed: true,
        cache: false,
        href: base_url+'inbound/add_detailIn/' + val +'/'+ type,
        modal: true
      });      
      $('#dialog').dialog('open');
      url = base_url+'inbound/save_detail/add';
    }
    // end newData
    saveData = function(){
      $('#form2').form('submit',{
        url: url,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          alert(result);
          var result = eval('('+result+')');
          if (result.success){
            
            $('#dialog').dialog('close');   // close the dialog
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan  ',
            });
          } else {
            $.messager.show({
              title: 'Error',
              msg: result.msg
            });
          }
        }
      });
    }

    back = function (){
      $('#konten').panel({
        href:base_url+'inbound/index'
      });
    }
    
    
  $(function(){ // init
      $('#dg_detail_in').datagrid({url:"inbound/grid_detail/"+id_in});  
  }); 

  //# Tombol Bawah
    $(function(){
      var pager = $('#dg_detail_in').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Tambah Detail',
            handler:function(){
              tambahDetail();
            }
          },
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
