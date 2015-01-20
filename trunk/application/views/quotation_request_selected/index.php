
<div id="toolbar_qrs" style="padding:5px;height:auto">
  <div style="margin-bottom:5px">   
  </div>
  <div class="fsearch">
    <table width="500" border="0">
      <tr>
      <td>Search By ID QRS</td>
      <td>: 
        <input name="s_id_qrs" id="s_id_qrs" size="15">
      </td>
      <td><a href="#" onclick="reset()" class="easyui-linkbutton" iconCls="icon-reload">Reset</a></td>
      </tr>

    </table>
  </div>
</div>
<table id="dg_qrs" title="Quotation Request List" data-options="
      rownumbers:true,
      singleSelect:true,
      autoRowHeight:false,
      pagination:true,
      pageSize:30,
      fit:true,
      toolbar:'#toolbar_qrs',
    ">    
  <thead>
    <tr>
      <th field="id_qrs" sortable="true" width="80" >ID QRS</th>
      <th field="id_pr" sortable="true" width="80" >ID PR</th>
      <th field="id_ro" sortable="true" width="60">ID RO</th>     
      <th field="full_name" sortable="true" width="130">Requestor</th>
      <th field="departement_name" sortable="true" width="130">Departement</th>
      <th field="purpose" sortable="true" width="90">Purpose</th>
      <th field="cat_req" sortable="true" width="120">Category Request</th>
      <th field="ext_doc_no" sortable="true" width="120">External Doc No</th>
      <th field="ETD" sortable="true" width="100">ETD</th>
      <th field="date_create" sortable="true" width="130">Date Create</th>
      <th field="action" align="center" formatter="actionQrs" width="150">Aksi</th>
    </tr>
  </thead>
</table>

<script >
  var url;
  $(document).ready(function(){

  newData = function (){
      $('#dialog').dialog({
        title: 'Tambah Delivery Order',
        width: 380,
        height: 130,
        closed: true,
        cache: false,
        href: base_url+'quotation_request_selected/new_qrs',
        modal: true
      });
       
      $('#dialog').dialog('open');
      url = base_url+'quotation_request_selected/SaveNewQrs/add';
    }
    // end newData
    saveData = function(){
      
      $('#form2').form('submit',{
        url: url,
        onSubmit: function(){
          return $(this).form('validate');
        },
        success: function(result){
          //alert(result);
          var result = eval('('+result+')');
          if (result.success){
            $.messager.show({
              title: 'Succes',
              msg: 'Data Berhasil Ditambahkan ',
            });
            $('#dialog').dialog('close');   // close the dialog
            $('#dg_qrs').datagrid('reload');   // reload the user data
          } else {
            $.messager.show({
              title: 'Error',
              msg: result.msg
            });
          }
        }
      });
    }

   done = function (val){
      if(confirm("Apakah yakin akan mengirim data ke Purchase Order '" + val + "'?")){
        var response = '';
        $.ajax({ type: "GET",
           url: base_url+'quotation_request_selected/Done/' + val,
           async: false,
           success : function(response){
            var response = eval('('+response+')');
            if (response.success){
              $.messager.show({
                title: 'Success',
                msg: 'Data Berhasil Di save'
              });
              $('#dg_qrs').datagrid('reload');
            }else{
              $.messager.show({
                title: 'Error',
                msg: response.msg
              });
            }
           }
        });
      }
    }

    //end sendData 
    Add_Qrs = function (val){
      $('#konten').panel({
        href: base_url+'quotation_request_selected/add_qrs/' + val,
      });
    }
    
    detail_Qrs = function (val){
      $('#konten').panel({
        href: base_url+'quotation_request_selected/detail_Qrs/' + val,
      });
    }
  
    actionQrs = function(value, row, index){
      var col='';
          <?php if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'DETAIL'))){ ?>
          col += '<a href="#" onclick="detail_Qrs(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">Detail</a>';     
          <?php }?>
          <?php if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'DETAIL'))){ ?>
          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="Add_Qrs(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">QRS</a>';     
          <?php }?>
          <?php if($this->mdl_auth->CekAkses(array('menu_id'=>15, 'policy'=>'APPROVE'))){ ?>
          col += '&nbsp;&nbsp; | &nbsp;&nbsp;<a href="#" onclick="done(\''+row.id_pr+'\');" class="easyui-linkbutton" iconCls="icon-edit"plain="false">Done</a>';
          <?php }?>
      return col;
    }
    
    $(function(){ // init
      $('#dg_qrs').datagrid({url:"quotation_request_selected/grid"});
  });
    //tombol bawah
 $(function(){
      var pager = $('#dg_qrs').datagrid().datagrid('getPager'); // get the pager of datagrid
      pager.pagination({
        buttons:[
          {
            iconCls:'icon-add',
            text:'Create QRS',
            handler:function(){
              newData();
            }
          }            
        ]
      });     
    });
 //reset datagrid
    reset = function(){
      $('#s_id_qrs').val('');
      $('#dg_qrs').datagrid('load',{
        id_qrs : $('#s_id_qrs').val()
        
      });
    }

$("#s_id_qrs ").autocomplete({
     source: function(request, response) {
       $.post("<?=base_url();?>quotation_request_selected/selectqrs", request, response);//Ganti menjadi fpp/selectNasabah
 
       },
       minLength: 1,
      
       select: function(event, result) {
          $('#dg_qrs').datagrid('load',{
            id_sro : $('#s_id_qrs').val()
            
          });
       }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
       return $("<li>").append("<a> ID QRS " + item.label + " | ID RO " + item.id_ro + "</a>").appendTo(ul);
    };

});
</script>
