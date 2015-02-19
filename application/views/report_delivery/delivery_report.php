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
    <!--<page_header>
        <table style="width: 100%;" class="header" cellspacing=0 cellpadding=0 >
            <tr>
                <td style="text-align: left;   width: 10%"><img src='<?php base_url()?>asset/images/logo.jpg' /></td>
				<td style="text-align: center; width: 80%">
					<h4><?php echo $namaUniv;?></h4>
					<p><?php echo $alamatUniv;?></p>
					<p><?php echo $kotaUniv;?></p>
				</td>
                <td style="text-align: right;   width: 10%"><?php //echo date('d/m/Y'); ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border-top: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">STMIK BANDUNG </td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>-->
	<!--<table style="width:100%;">-->
<p align="center"><b>Delivery Order</b></p>

	<p align="center">ID DO : <?php echo $data_pdf[0]->id_do;?></p><br>
	<table width="100%" class="tblbtl" align="center">
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td  align="left">Requestor</td>
			<td  align="left"> : <?php  echo $data_pdf[0]->full_name;?></td>
		</tr>
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Departemen</td>
			<td align="left"> : <?php  echo $data_pdf[0]->departement_name;?></td>
		</tr>
		<tr>
			<td >&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Date Create</td>
			<td align="left"> : <?php  echo $data_pdf[0]->date_create;?></td>
		</tr>
	</table>
	<br/> 
	<div>
	<table width= "100%" border="0.5" bordercolor="#000000" class='' cellspacing=0 cellpadding=0>
	<tr>
	<td width="120" align="center"  colspan="" rowspan="" headers="" ><b>Courir</b></td>
	<td width="80" align="center"  colspan="" rowspan="" headers="" ><b>ID SRO</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>ID RO</b></td>
	<td width="80" align="center" colspan="" rowspan="" headers=""><b>ID DO</b></td>
	<td width="200" align="center" colspan="" rowspan="" headers=""><b>Date Create</b></td>
	<td width="130" align="center" colspan="" rowspan="" headers=""><b>Departement</b></td>
	</tr>
		<?php 
			$no = 1;
			foreach ($data_pdf as $data):
		?>
	<tr>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->name_courir; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_sro; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_ro; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->id_do; ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo date('d-m-Y',strtotime($data->date_create)); ?></td>
	<td colspan="" rowspan=""  align="center" headers=""><? echo $data->departement_name; ?></td>

	</tr>
		<? 
			$no++;
			//foreach
	 	 endforeach; ?>
	</table>
	</div>
</page>
<?php } ?>