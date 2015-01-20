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
		font-size: 20px;
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
		padding: 6px 6px;
		font-size: 13px;
	}
</style>

<page backtop="10mm" backbottom="10mm" backleft="1mm" backright="3mm">
    <page_header>
        <table style="width: 100%;" class="header" cellspacing=0 cellpadding=0 >
            <tr>
	
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; ">
            <tr>
                <td style="text-align: left;    width: 50%">PT. CIPAGANTI CITRA GRAHA </td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
	<!--<table style="width:100%;">-->
<p align="center"><b>Transfer Barang</b></p>
<br><br>
	<!--<p align="center"><?php  echo $data_pdf[0]->nama_tahunajaran;?></p>-->
	<table width= "100%"s>
		<tr>
			<td  align="left">ID Transfer</td>
			<td  align="left"> : <?php  echo $data_pdf[0]->id_transfer;?></td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Date Create </td>
			<td align="left"> : <?php  echo $data_pdf[0]->date_create;?></td>
		</tr>
		<tr>
			<td align="left">Tipe Transfer</td>
			<td align="left"> : <?php  echo $data_pdf[0]->type_transfer;?></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Requestor </td>
			<td align="left"> : <?php  echo $data_pdf[0]->full_name;?></td>
		</tr>
	</table>
	<br/> 
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='' cellspacing=0 cellpadding=0>
	<tr>
	<td width="80" align="center" border="" colspan="" rowspan="" headers=""><b>ID Detail</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>ID Stock</b></td>
	<td width="100" align="center" colspan="" rowspan="" headers=""><b>Kode Barang</b></td>
	<td width="170" align="center" colspan="" rowspan="" headers=""><b>Nama Barang</b></td>
	<td width="90" align="center" colspan="" rowspan="" headers=""><b>Qty Stock</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>Qty Transfer</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>Price</b></td>
	<td width="140" align="center" colspan="" rowspan="" headers=""><b>Lokasi Stock</b></td>
	<td width="140" align="center" colspan="" rowspan="" headers=""><b>Lokasi Transfer</b></td>
	</tr>
		<?php 
			$no = 1;
			foreach ($data_pdf as $data):
		?>
	<tr>
	<td colspan="" align="center"  rowspan="" headers=""><? echo $data->id_detail_transfer; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->id_stock; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->kode_barang; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->nama_barang; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->qty_stock; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->qty; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->price; ?> </td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->lokasi_stock; ?></td>
	<td colspan="" align="center" rowspan="" headers=""><? echo $data->id_lokasi; ?></td>
	</tr>
		<? 
			$no++;
			//foreach
	 	 endforeach; ?>
	</table>
	</div>
</page>
<?php } ?>