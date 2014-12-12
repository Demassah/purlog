<script>
    var id_sro = '<?= $id_sro ?>';
    var url;
    $(document).ready(function () {

        // detail = function (){
        // 	$('#konten').panel({
        // 		href:base_url+'shipment_req_order/detail'
        // 	});
        // }

        // loadingList = function (){
        // 	$('#konten').panel({
        // 		href:base_url+'shipment_req_order/loadingList'
        // 	});
        // }

        // actiondetail = function(value, row, index){
        // 	var col='';
        // 			col += '&nbsp;&nbsp; &nbsp;&nbsp;<a href="#" onclick="detailData(\''+row.id+'\');" class="easyui-linkbutton" iconCls="icon-edit" plain="false">UnCheckout</a>';			
        // 	return col;
        // }		

        Checkbox = function (value, row, index) {
            return '<input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value(' + index + ', this.checked, \'' + row.id_jadwal + '\')" ' + (row.chk == true ? 'checked="checked"' : '') + '/>';
        }

        $(function () { // init
            $('#dtgrd').datagrid({url: "shipment_req_order/add_grid/<?php echo $id_ro; ?>/<?php echo $id_sro; ?>"});
            //$('#dg').datagrid('enableFilter'); 
        });

        //# Tombol Bawah
        $(function () {
            var pager = $('#dtgrd').datagrid().datagrid('getPager'); // get the pager of datagrid
//            pager.pagination({
//                buttons: [
//                    {
//                        iconCls: 'icon-all',
//                        text: 'Uncheckout All',
//                        handler: function () {
//                            a();
//                        }
//                    },
//                    {
//                        iconCls: 'icon-loading',
//                        text: 'Loading',
//                        handler: function () {
//                            b();
//                        }
//                    },
//                    {
//                        iconCls: 'icon-ok',
//                        text: 'Done SRO',
//                        handler: function () {
//                            c();
//                        }
//                    },
//                    {
//                        iconCls: 'icon-purchase-form',
//                        text: 'Checking Sheet',
//                        handler: function () {
//                            d();
//                        }
//                    }
//                ]
//            });
        });

    });
</script>

<div id="toolbar_detail" style="padding:5px;height:auto">
    <!-- <div class="fsearch">
            <table>
                    <tr>
                                    <td>
                                                    &nbsp;&nbsp;<a href="#" onclick="detail()" class="easyui-linkbutton" iconCls="icon-detail">List PROS Locked</a>
                                                    &nbsp;&nbsp;<a href="#" onclick="loadingList()" class="easyui-linkbutton" iconCls="icon-list">Loading List</a>
                                    </td>							
                    </tr>	
            </table>
    </div> -->
</div>

<table id="dtgrd" title="Add Detail SRO" data-options="
       rownumbers:true,
       singleSelect:false,
       pagination:true,
       autoRowHeight:false,
       fit:true,
       toolbar:'#toolbar_detail',
       "method="post">		
    <thead>
        <tr>
            <th data-options="field:'id_krs_detail',width:'100', hidden:true"></th>
            <th data-options="field:'id_ro',checkbox:true" name="id_ro[]"></th>
            <!-- <th field="chk" width="23" formatter="Checkbox">
                    <input style="margin-top:2px;" type="checkbox" name="checkbox" id="checkbox" onclick="update_value('+index+', this.checked, \''+row.id_jadwal+'\')" '+(row.chk==true?'checked="checked"':'')+'/>
            </th> -->
            <th field="id_detail_ro" sortable="true" width="120">ID Detail ROS</th>
            <th field="ext_doc_no" sortable="true" width="120">Ext Doc No</th>
            <th field="kode_barang" sortable="true" width="80">Kode Barang</th>
            <th field="nama_barang" sortable="true" width="80">Kode Barang</th>
            <th field="note" sortable="true" width="400">Deskripsi</th>		

        </tr>
    </thead>
</table>

<div id="dlg-buttons">
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td style="text-align:right">
                <a href="#" class="easyui-linkbutton" id="bsave" iconCls="icon-save" onclick="">Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dd').dialog('close')">Close</a>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    console.log('test');
    $(function () {
        $("#bsave").click(function () {
//            alert('test save');
//            event.preventDefault();
//            var searchIDs = $("input:checkbox:checked").map(function () {
//                return $(this).val();
//            }).get(); 
//            console.log('checkbox: '+ searchIDs);
            $(".datagrid-btable").find("input[type=checkbox]").each(function () {
                if (this.checked) {
                    alert('Checkbox Checked: ');
                }
                else
                {
                    alert('Checkbox not Checked');
                }
            });
        });
    });
</script>
