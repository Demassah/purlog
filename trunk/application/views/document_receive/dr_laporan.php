<?php
if (empty ($data_pdf)) {
    echo "Tidak ada data";
}
else {
?>
<style>
	h4 {
		font-size:20px;
		font-weight:bold;
		margin:0px;
		margin-bottom:5px;
	}
	page{
		border:1px solid black;
	}
	p{
		margin:5px;
		font-size: 15px;
	}
	.header{
		width:95%;
		border-bottom:2px double black;
		padding:10px 0;
	}
	.header img{
		width:100px;
		height:auto;
	}
	.tblbtl {
		border: 1px solid black;
		width: 100%;
	}
	.tblbtl td, 
	.tblbtl th {
		border-bottom: 1px solid black;
		padding: 4px 4px;
		font-size: 13px;
	}
</style>
<page backtop="15mm" backbottom="10mm" backleft="1mm" backright="3mm">
    <page_header>
        <table style="width: 100%;" class="header" cellspacing=0 cellpadding=0 >
            <tr>
              <!--   <td style="text-align: left;   width: 10%"><img src='<?php base_url()?>asset/images/logo.jpg' /></td>
				<td style="text-align: center; width: 80%">
					<h4><?php echo $namaUniv;?></h4>
					<p><?php echo $alamatUniv;?></p>
					<p><?php echo $kotaUniv;?></p>
				</td>
                <td style="text-align: right;   width: 10%"><?php //echo date('d/m/Y'); ?></td> -->
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border-top: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">PT. Cipaganti Citra Graha </td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
	<!--<table style="width:100%;">-->
<h4 align="center"><b>Document Receive</b></h4>
<p></p>
<p></p>
<p></p>
<p></p>
	<!--<p align="center"><?php  echo $data_pdf[0]->nama_tahunajaran;?></p>-->
	<table>
		<tr>
			<td  align="left">ID Receive</td>
			<td  align="left"> : <?php echo $data_pdf[0]->id_receive;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">Nama Courir</td>
			<td align="left"> : <?php echo $data_pdf[0]->name_courir;?></td>
		</tr>    
		<tr>
			<td align="left">ID SRO</td>
			<td align="left"> : <?php echo $data_pdf[0]->id_sro;?></td>
			<td>&nbsp;&nbsp;</td>
			<td align="left">Date Create</td>
			<td align="left"> : <?php echo $data_pdf[0]->date_create;?></td>
		</tr>
		<tr>
			<td align="left">ID Courir</td>
			<td align="left"> : <?php echo $data_pdf[0]->id_courir;?></td>
		</tr>
	</table>
	<br/> 
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='tblbtl' cellspacing=0 cellpadding=0>
	  <tr>
		<th width="30" align="center">No</th>
		<th width="70" align="center">ID Detail</th>
		<th width="70" align="center">ID RO</th>
		<th width="70" align="center">ID Detail RO</th>
		<th width="70" align="center">ID SRO</th>
		<th width="90" align="center">Kode Barang</th>
		<th width="165" align="center">Nama Barang</th>
		<th width="50" align="center">Qty Delivered</th>
		<th width="50" align="center">Qty Received</th>
		<th width="50" align="center">Qty Return</th>
		<th width="125" align="center">Date Create</th>
		<!--td width="65">Kredit</td-->
	  </tr>
	  <?php 
		$no = 1;
		foreach ($data_pdf as $data):
	  ?>
	  <tr>
		<td align="center"><?php echo $no; ?></td>
		<td align="center"><?php echo $data->id_detail_receive;?></td>
		<td align="center"><?php echo $data->id_ro;?></td>
		<td align="center"><?php echo $data->id_detail_ro;?></td>
		<td align="center"><?php echo $data->id_sro;?></td>
		<td align="center"><?php echo $data->kode_barang;?></td>
		<td align="center"><?php echo $data->nama_barang;?></td>
		<td align="center"><?php echo $data->qty_delivered;?></td>
		<td align="center"><?php echo $data->qty;?></td>
		<td align="center"> </td>
		<td align="center"><?php echo $data->date_create;?></td>
	  </tr>
	  <?php 
		$no++;
	//foreach
	  endforeach; ?>
	</table>
	</div>
</page>
<?php } ?>