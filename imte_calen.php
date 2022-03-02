<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
if(!isset($_SESSION['id'],$_SESSION['department']))
{
header('location:index.php?lmsg=true');
exit;
}
require_once('includes/dbconfig.php');
include("includes/config.php");

?>

<?php
$timezone = 'Asia/Kolkata';
date_default_timezone_set($timezone);
$today = date('d-m-Y');
$year = date('Y');
if(isset($_GET['year'])){
$year = $_GET['year'];
}

?>


<?php 
if(isset($_GET['status']))
{
$status1=$_GET['status'];
$select=mysql_query("select * from imte_calen where id='$status1'");
while($row=mysql_fetch_object($select))
{
$status_var=$row->instrumentstatus;
if($status_var=='0')
{
$status_state=1;
}
else
{
$status_state=0;
}
$update=mysql_query("update imte_calen set instrumentstatus='$status_state' where id='$status1'");
if($update)
{
header("Location:imte_calenupdate.php");
}
else
{
echo mysql_error();
}
}
}

?>
<?php
if (isset($_POST['submit'])) {

$imteid=$_POST['imteid'];
$imteid=htmlspecialchars($imteid,ENT_QUOTES);

$sendcalibdate=$_POST['sendcalibdate'];
$sendcalibdate=htmlspecialchars($sendcalibdate,ENT_QUOTES);

$planyear=$_POST['planyear'];
$planyear=htmlspecialchars($planyear,ENT_QUOTES);



$supplierid=$_POST['supplierid'];
$supplierid=htmlspecialchars($supplierid,ENT_QUOTES);

$query_imte=mysql_query("select * from supplier where id='$supplierid'");
while($row_imte=mysql_fetch_array($query_imte))
{
$suppliername=$row_imte['suppliername'];
}

$sql=mysql_query("update imte_calen set supplierid='$supplierid',suppliernamee='$suppliername',sendcalibdate='$sendcalibdate',planyear='$planyear' where id='$imteid'");

if ($sql) {
echo '<script>             
setTimeout(function() {
swal({  
title: "Success!",
text: "Updated successfully",
type: "success"     
}, 
function() 
{
window.location = "imte_calenupdate.php";
});
}, 1000);
</script>';
}

}

?>	
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="OTlogo.png">
<title>ESM | IMTE View</title>
<link rel="stylesheet" href="main/js/jquery-ui.css">
<script src="main/js/jquery-3.3.1.js"></script>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/plugins/html5-editor/bootstrap-wysihtml5.css" >
<!-- This page css -->
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/switchery/dist/switchery.min.css"rel="stylesheet" />
<link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- datatable css-->
<link href="assets/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
<link href="assets/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="assets/datatables/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<link href="assets/datatables/css/select.dataTables.min.css" rel="stylesheet">


<!-- date picker -->
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" >
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" >
<!-- End - This is for export functionality only -->
<link href="main/css/style.css" rel="stylesheet">
<link href="main/css/colors/blue.css" id="theme" rel="stylesheet">
<link href="assets/plugins/sweetalert/sweetalert.css">
<link href="assets/plugins/wizard/steps.css">
<script src="assets/plugins/Chart.bundle.min.js"></script>
<script src="main/js/jquery-ui.js"></script>
<script src="jquery.min.js"></script>
<link href="sweetalert.css" rel="stylesheet" />
<script src="sweetalert.min.js"></script>
<script src="assets/Chart.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 


<style>
div.scrollmenu 
{
overflow: auto;
}
div.scrollmenu 
{ overflow: auto; }
.form-control
{ font-size:small;}
@import url('font-awesome.min.css');
.panel-title > a:before {
float: right !important;
font-family: FontAwesome;
content:"\f068";
padding-right: 5%;
}
.panel-title > a.collapsed:before {
float: right !important;
content:"\f067";
}
.panel-title > a:hover, 
.panel-title > a:active, 
.panel-title > a:focus  {
text-decoration:none;
}
th{
font-size:10px;
}
td{

color:#2C3E50;
font-size: 12px;
}

</style>    
<style>
.act { color:#0F0; }
.deact { color:#F00;}
.hide
{
display:none;
}
.hide
{
display:none;
}
/*CSS for datatable*/

td{

color:#2C3E50;
}

/* machine status active/deactive buttons colors*/
.act { color:#0F0; }
.deact { color:#F00;}
/* to maintain space between sidebar and card body*/
div.container {
width: 80%;
}

/*printing text wordwrap*/
table {
table-layout:fixed;
}
table td {
word-wrap: break-word;
max-width: 400px;
}

/*	table width*/


/* word wrapping content of td*/
#example td {
white-space:inherit;
font-size: small;
}
#example th{
width: 67px;
font-size: smaller;
}
/*locating tools button*/
#tools {

}

/*table resizing according to page view and tableheader background color*/
table {border-collapse:collapse; table-layout:auto; width:100%;}
table td {border:solid 1px #fab; width:100px; word-wrap:none;}
table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled {
background: #1976d2;
color: white;
margin-top: 20px;
vertical-align: inherit;

}
table.dataTable thead th, table.dataTable tfoot th {
font-weight: 500;
}

/*To maintain space between its content and border*/
table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
padding-right: inherit;
font-size: small;
} 

/* background and textcolor for datable tools button*/
a.dt-button.dropdown-item{
background-color: #1976d2;
color:white;
}
a.dt-button.buttons-columnVisibility.active{
background-color: #1976d2;
color:white;
}
a.dt-button.buttons-columnVisibility{
background-color: white ;
color: #333;
}
/* coloumn visibility title background : 'Select Columns to Display'*/
div.dt-button-collection div.dt-button-collection-title {
background-color: orangered;
border: 1px solid rgba(0,0,0,0.15);
border-radius: 0.25rem;
color: white;
width: 563px;
font-size: small;
font-family:Poppins, sans-serif;
font-size:16px;
font-weight:400;
height:auto;
}

table {border-collapse:collapse; table-layout:fixed; width:100%;}
table td {border:solid 1px #fab; width:100px; word-wrap:none;}
table th {white-space: nowrap;}

/* Table Header break line(<br>) in print */
table.dataTable thead th, table.dataTable tfoot th {
font-weight: 500;
white-space: inherit;
}
/* Table Header margin-left 3px in print */
table.dataTable thead th, table.dataTable thead td {
padding: 10px 3px;
border-bottom: 1px solid #111111;
}
/* Table Filter FixedHeader adjusting width */
thead input {
width: 100%;
font-size: smaller;
}
/*--------------------------page-table-content-----------------------------*/

.page-wrapper .page-content {
display: inline-block;
width: 100%;
padding-left: 0px;
padding-top: 20px;
overflow-x: hidden;
flex: auto;
}

.page-wrapper .page-content> div {
padding: 5px 20px;
}

/*------------Datatable tfoot-FooterCallBack Element--------------*/
.dataTables_wrapper .toolbar {
float: left;
text-align: right;
padding-left: 20%;
font-size: larger;
font-weight: 550;
color : midnightblue;
}
@import url('font-awesome.min.css');
.panel-title > a:before {
float: right !important;
font-family: FontAwesome;
content:"\f068";
padding-right: 5%;
}
.panel-title > a.collapsed:before {
float: right !important;
content:"\f067";
}
.panel-title > a:hover, 
.panel-title > a:active, 
.panel-title > a:focus  {
text-decoration:none;
}td{

color:#2C3E50;
}
</style>
<style type="text/css">
/* Graph Cards */
.card-title {
font-size: small;
line-height: 18px;
font-weight: 300;
color: white;
}
.card-default .card-header{
background-color: #0080FF;
}
.card-actions{
color: white;
font-weight: 300;
}
</style>
<style type="text/css" media="print">
@import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700");
@font-face {
font-family: "Poppins";
font-weight: normal;
font-style: normal;
}

@media only print {
body {
font-family: "Poppins", sans-serif;
}
}

.printfont {
font-family: "Poppins", sans-serif;
}
</style>

</head>
<body class="fix-header fix-sidebar card-no-border">
<div id="main-wrapper" class="scrollmenu" style="font-size:small">
<?php include("includes/config.php");?>
<?php include("includes/header.php");?> 
<?php include("includes/sidebar.php");?>
<div class="page-wrapper" >
<div class="row page-titles m-b-0 " style="height:45px">
<div class="col-md-5 align-self-center">
<h4 class="text-themecolor">IMTE</h4>
</div>
<div class="col-md-7 align-self-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>

<li class="breadcrumb-item"><a href="addmachine.php">IMTE View</a></li>

<li class="breadcrumb-item active">View / Update</li>
</ol>
</div> 
</div> 
<div class="row" >
<div class="col-md-12" style="background-color:#F0F0F0">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><br>
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingTwo" style="height:30px" >
<h5 class="panel-title" style="margin-left:2.5%">Local Dashboard
<!--   <a  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
</a> -->
</h5>
</div>
<div style="background-color:white" id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
<div class="panel-body"> 
<div class="mega-dropdown-menu row">
<div class="col-lg-4">
<?php  
$conn = new mysqli("localhost", "root", "", "finalcms");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$and = 'AND YEAR(regdate1) = '.$year;
?>
</div> 


<br><br><br>

<div class="col-sm-1" >


</div>

</div>

<br>

<br>
</div>
</div>
</div>
</div>
</div>              
</div>
<!--  <br> -->

<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<!-- Nav tabs -->


<!-- settings start-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<ul class="nav nav-tabs" role="tablist">
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['imteaccess'];
$comarr1=explode(',',trim( $complaintarr1));
$secondaryarr1=$row21['multidept'];
$secarr2=explode(',',trim($secondaryarr1));
//to remove last comma from multidept array
$lastcomma = '';
foreach($secarr2 as $i=>$k) 
{
$lastcomma .= $k.',';
}
$lastcomma = rtrim($lastcomma,',');
$secarr1=explode(',',trim($lastcomma));
$querydays1=mysql_query("select * from imte_dept order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['regdepartment'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('regimte',$comarr1)))
{  ?>

<?php $query1=mysql_query("select * from master order by id desc limit 1");
while($row1=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i");
if($row1['licend']<= $dt3) 
{ ?>
<li class="nav-item"><a class="nav-link"  onclick="myFunctionstatus()" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span><span class="hidden-xs-down">Register</span></a></li> 
<?php } 

}

} } } ?> 
<li class="nav-item"><a class="nav-link" href="imte_reg.php" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> Register &nbsp;<b>
</b></span></a> 
</li>

<?php   
$inhousecomarr=$rowacc['imteaccess'];
$inhousearr=explode(',',trim( $inhousecomarr));
if(in_array('viewimte',$inhousearr))
{ ?>
<?php $query1=mysql_query("select * from master order by id desc limit 1");
while($row1=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i:s");
if($row1['licend']<= $dt3) 
{
?>
<li class="nav-item"><a class="nav-link active" onclick="myFunctionstatus()" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span><span class="hidden-xs-down">View/Update</span></a></li> 
<?php } 
else
{ ?>
<li class="nav-item"><a class="nav-link active" href="imte_calenupdate.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">View/Update</span></a> </li>
<?php } 
} ?>

<?php
} else{

} 
?>

<?php $companymaster=$rowacc['addmanageaccess'];
$compaarr=explode(',',trim($companymaster));
if(in_array('generalmanage',$compaarr))
{?>
<li class="nav-item"> <a class="nav-link"  href="imte_setting.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Settings</span></a> </li>
<?php } } ?>  
</ul>
<!--settings end -->


<?php   
$queryde = mysql_query("SELECT * FROM imte_dept");
$numberde=mysql_num_rows($queryde);
if ( $numberde== '0' ) 
{ ?>    
<h5>To view the Inquiry List please Go to Settings and set the Department for Inquiry or Contact to Admin</h5>

<?php }

else
{ ?>		
<div class="">
<div class="tab-pane active" id="home" role="tabpanel">
<br>

</div>
<!-- To take the datatable buttons outside-->

<table id="example" cellpadding="0" cellspacing="0" border="0" class=" table table-bordered table-striped display" style="width:100%">


<!-- year dropdown -->


<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>select year</label>
<select class="form-control" id="DigitalBush" name="monthcalendar"onclick="planyear1() ">
<option></option>

<?php
date_default_timezone_set($timezone);
$today1= date('Y-m-d');
// $year1 = date('Y');
$iyear=date('Y');
$iyear1=date('Y');

for($i=2018; $i<=$iyear1; $i++){
$selected = ($i==$year1)?'selected':'';
echo "

<option value='".$i."' ".$selected.">".$i."</option>
";
}
?>
</select> 
</div>
</div>
<div class="col-md-2" style="margin-top:24px;">
<div class="form-group">
<input type="submit" class="btn btn-primary" name="planyear" value="GO"  onclick="function()">

</div>
</div>
<div class="col-md-1"></div>
<div class="col-sm-2" style="margin-left:200px; margin-bottom: 35px;">
<a id="reportprint3" target="_blank"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-print"></i>&nbsp;Print</span></button></a>
</div>
<div class="col-md-2" style="color:blue; margin-top:10px; font-family: Poppins;">Date : 31-12-2020</div>
</div>


<div id="printreport"> 
<div class="row">

<h5 style="font-family: Poppins; font-weight: 500; color: black;">
CALIBRATION PLAN FOR YEAR</h5>
&nbsp;&nbsp;

<h5 style="font-family: Poppins; font-weight: 500; color: black;text-align:left"><input type="text" name="" id="field2" style="border: none;"></h5>

<!-- <div class="col-md-1"></div> -->	
<div class="col-md-7">	
<span><i class="fa fa-square" style="color: orange; font-size: large; "  aria-hidden="true"></i>
&nbsp;Planned&nbsp;&nbsp;
</span>
<span><i class="fa fa-square" style="color:yellow; font-size: large; " aria-hidden="true"></i>
&nbsp;Actual&nbsp;&nbsp;
</span>
<span><i class="fa fa-square" style="color:green; font-size: large;" aria-hidden="true"></i>
&nbsp;Status OK&nbsp;&nbsp;
</span>
<span><i class="fa fa-square" style="color:red; font-size: large;" aria-hidden="true"></i>
&nbsp;Status NOT OK&nbsp;&nbsp;
</span>
<span><i class="fa fa-square" style="color:blue; font-size: large;" aria-hidden="true"></i>
&nbsp;Out for callibration
</span>
</div>
</div>





<div class="tableFixHead">
<table class="table table-bordered table-sm" style="width: 100%;" id="customers" class="myTable">
<thead>
<tr style="background-color: #0080ff;color: white;border-color:white;text-align:center;">
<th style="border:1px solid #C0C0C0; " rowspan="2" width="50px">Sr. <br>no</th>
<th  style="border:1px solid #C0C0C0;" rowspan="2" width="70px">IMTE Code <br>name</th>
<th  style="border:1px solid #C0C0C0;" rowspan="2" width="70px">Size<br>range</th>
<th  style="border:1px solid #C0C0C0;" rowspan="2" width="70px">Frequency<br>in month</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Jan</th>

<th style="border:1px solid #C0C0C0;" colspan="3">Feb</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Mar</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Apr</th>
<th style="border:1px solid #C0C0C0;" colspan="3">May</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Jun</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Jul</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Aug</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Sep</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Oct</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Nov</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Dec</th> 
<th style="border:1px solid #C0C0C0;" rowspan="2" width="80px">Used for items <br>(Parts list)</th>
<th style="border:1px solid #C0C0C0;" rowspan="2" width="70px">Remarks</th>
</tr>
</thead>

<tr>

<td >P</td>
<td>A</td>
<td>S</td>

<td >P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td>

<td>P</td>
<td>A</td>
<td>S</td> 




</tr>

<?php
$servername="localhost";
$username="root";
$password="";
$dbname="finalcms";
$connect=mysqli_connect($servername,$username,$password,$dbname);
// if connections is established 
if ($connect) {

$selectQuery = "SELECT * FROM `imte_calen` ORDER BY `slno` ASC";
$result = mysqli_query($connect,$selectQuery);

if(mysqli_num_rows($result)>0)
{
while($row = mysqli_fetch_assoc($result))
{
?>
<!--table data fetching from database-->
<tr >
<td> 
<?php echo $row['slno']; ?>  
</td>
<td>  
<?php echo $row['imtename']; ?>  
<?php echo $row['imtecode']; ?> 
</td>
<td>       
<?php echo $row['minsize']; ?>
<?php echo $row['minunit']; ?>
<?php echo $row['maxsize']; ?>
<?php echo $row['maxunit']; ?>  
</td>
<td>  
<?php echo $row['callibfrequency']; ?> 
</td>

</tr>
<?php }}}}  ?>

</table>



</div>



<!-- else closing -->

</div>
<br> 
<?php 
$setting=mysql_query("select * from imte_dept");
while($rowset=mysql_fetch_array($setting))
{ 
?>
<hr style="background-color:lightgray">
<div class="row">
<label style="color:black;margin-left:15px"></label><span style="color:black;font-weight:bold;"><?php echo htmlspecialchars_decode($rowset['isoformat_view']);?></span>
<label style="color:black;">&nbsp;|&nbsp;Rev. No.</label>&nbsp;<span style="color:black;font-weight:bold;"><?php echo htmlspecialchars_decode($rowset['isono_view']);?></span>
</div>
<?php  } ?>                
</div><!-- /content-panel -->

</div><!-- /col-lg-4 -->   

</div><!-- /row -->



<?php 
include("includes/footer.php");
?>

</div></div></div></div>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="main/js/jquery-ui.js"></script>
<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="main/js/jquery.slimscroll.js"></script>
<script src="main/js/waves.js"></script>
<script src="main/js/sidebarmenu.js"></script>
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="main/js/custom.min.js"></script>
<script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<script src="assets/plugins/raphael/raphael-min.js"></script>
<script src="assets/plugins/morrisjs/morris.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="assets/plugins/wizard/jquery.validate.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/wizard/steps.js"></script>
<script src="main/js/dashboard2.js"></script>
<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> 


<!-- date picker -->

<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>

<!--datatable scripts-->
<script src="assets/datatables/js/jquery.dataTables.js"></script>
<script src="assets/datatables/js/dataTables.buttons.min.js"></script> 
<script src="assets/datatables/js/jszip.min.js"></script>
<script src="assets/datatables/js/pdfmake.min.js"></script>
<script src="assets/datatables/js/vfs_fonts.js"></script>
<script src="assets/datatables/js/buttons.html5.min.js"></script>
<script src="assets/datatables/js/buttons.colVis.min.js"></script>
<script src="assets/datatables/js/buttons.print.min.js"></script>
<script src="assets/datatables/js/dataTables.bootstrap4.min.js"></script> 
<script src="assets/datatables/js/buttons.bootstrap4.min.js"></script>
<!--fixed Header-->
<script src="assets/datatables/js/dataTables.fixedHeader.min.js"></script>


<!-- date picker material -->
<script>

$('#dop').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD', time: false}); 
$('#lcd').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD', time: false});
$('#ncd').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD', time: false});
$('#datepicker').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD', time: false ,maxDate: new Date()});
$('#datepicker1').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD', time: false ,maxDate: new Date()});

</script>
<script type="text/javascript">


function planyear1() {
var a = document.getElementById("DigitalBush").value;
document.getElementById("field2").value=a;


}


</script>



<script>
$('.li-modal').on('click', function(e){
e.preventDefault();
$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
});
</script>
<!-- fetch data for Monthly breakdown slip Status chart--->  
<?php
$conn = new mysqli('localhost', 'root', '', 'finalcms');

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>

<!-- only print -->
<script>
$('#reportprint3').click(function(){

var children = $('#report tr.child').length;
var visibleChildren = $('#report tr.child:visible').length;

var style = "<style>";
style = style + "table {width: 100%;font-size: 12px;font-family:'Poppins', sans-serif;}";
style = style + "label { color:black;font-weight:550;font-size:14px;}";
style = style + "#customers tr.headcolor{ background-color:#0080FF;}";
style = style + "table, th, td {border-collapse: collapse;padding: 2px 3px;border:1px solid #D3D3D3;}";
style = style + "</style>";


var divToPrint=document.getElementById("printreport");
var win = window.open('', '', 'height=900,width=1200');

win.document.write('<html><head>');
win.document.write('<title> Inquiry_Form_No.</title>');

win.document.write(style); 
win.document.write('</head>');
win.document.write('<body>');
win.document.write(divToPrint.outerHTML);
win.document.write('<h5 style="font-family:Poppins,sans-serif;"><center> ---------- END OF REPORT ---------- </center></h5>');
win.document.write('</body></html>');

win.print(); // PRINT THE CONTENTS.

win.close();   // CLOSE THE CURRENT WINDOW.
location.reload();
$('#printreport tr.child').hide(); 
});
</script>


<!-- Datatable Buttons and Fixedheader-->
<script>
$(document).ready(function() {
var table = $("#example").DataTable({
order: [[0, "desc"]],
// dom: "lBfrtip",

});
var fixNewLine = {
exportOptions: {
format: {
body: function ( data, row, column, node ) {
// Strip $ from salary column to make it numeric
return column === 1,2 ?
data.replace( /<br\s*\/?>/ig, "\n" ) :
data;
},
header: function ( data, row, column, node ) {
// Strip $ from salary column to make it numeric
return column === 1,2 ?
data.replace( /<br>/g, "\n" ) :
data;
}
}
}
};
var buttons = new $.fn.dataTable.Buttons(table, {
buttons: [
{
extend: "collection",
text: '<i class="fa fa-share-square"></i>&nbsp; Tools',
buttons: [
{

extend: "print",
text: '<i class="fa fa-print"></i>&nbsp; Print',
filename: 'customized_print_file_name',

exportOptions: {
columns: [0, 1, 2, 3 ,4 ,5 ,6, 7, 8, 9, 10, 11]
}
},
{
extend: "copyHtml5",
text: '<i class="fa fa-copy"></i>&nbsp; Copy',
messageTop: 'The information in this table is copyright to Hitech Engineering.',
exportOptions: {
columns: [0, 1, 2, 3 ,4 ,5 ,6, 7, 8, 9, 10, 11]
}
},
{
extend: "excelHtml5",
text: '<i class="fa fa-file-excel-o"></i>&nbsp; Excel',
messageTop: 'The information in this table is copyright to Hitech Engineering.',
title: 'ESM | Sales Invoice',
filename: 'ESM | Sales Invoice',
exportOptions: {
columns: [0, 1, 2, 3 ,4 ,5 ,6, 7, 8, 9, 10, 11]
}
},
{
extend: "csvHtml5",
text: '<i class="fa fa-table"></i>&nbsp; CSV',
messageTop: 'The information in this table is copyright to Hitech Engineering.',      
title: 'ESM | Sales Invoice',
filename: 'ESM | Sales Invoice',
exportOptions: {
columns: [0, 1, 2, 3 ,4 ,5 ,6, 7, 8, 9, 10, 11]
}
},
{
extend: "pdfHtml5",
text:'<i class="fa fa-file-pdf-o"></i>&nbsp; PDF',
title: 'ESM | Sales Invoice',
filename: 'ESM | Sales Invoice',

exportOptions: {
columns: [0, 1, 2, 3 ,4 ,5 ,6, 7, 8, 9, 10, 11],
stripNewlines: false
}
},
{
extend: "colvis",
text:'<i class="fa fa-barcode"></i><i class="fa fa-grip-lines-vertical"></i>&nbsp; Display Columns',
//text: 'Column Selection',

collectionLayout: "fixed two-column",
collectionTitle: "Select Columns to Display",
postfixButtons: ["colvisRestore"],
columnText: function(dt, idx, title) {
return idx + 1 + ": " + title;
}
},
{
text:'<i class="fa fa-database"></i>&nbsp; Export All',
action: function ( e, dt, button, config ) {
window.location = 'inquiry_exportdb.php';
}        
}
]
}
]
}).container().appendTo($('#tools'));

new $.fn.dataTable.FixedHeader( table, {
header: true,
headerOffset: $('.topbar').height() //offset added to show tableheader just below theme header

} );

// Filter Setup - add a text input to each header cell w.r.t Fixed Header
$('#example thead tr').clone(true).appendTo( '#example thead' );
$('#example thead tr:eq(1) th').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" placeholder="Search" />' );

$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search( this.value )
.draw();
}
} );
} );

//fixed header when side bar is toggled 
$(".sidebartoggler").on('click', function () {
$(".page-wrapper").removeClass("toggled");
table.columns.adjust().draw();
table.draw();
});
$(".sidebartoggler").on('click', function () {
$(".page-wrapper").addClass("toggled");
table.columns.adjust();
});
});
</script>

<script>
$(document).ready(function() {
$('.datatable-1').dataTable();
$('.dataTables_paginate').addClass("btn-group datatable-pagination");
$('.dataTables_paginate > a').wrapInner('<span />');
} );
</script>
<script>
function myFunction() {
swal("Oops...!!!", "you can't edit a Under Maintainance, Handed over , Temporary Fix", "warning")

}
</script>
<script>
function myFunction1() {
swal("Oops...!!!", "you Don't have access","warning")
}
</script>
<script>
function myFunctionstatus() {
swal("We are Sorry !", "Your license has expired.\n Please contact your administrator","warning")
}
</script>
<link rel="stylesheet" href="assets/plugins/html5-editor/bootstrap-wysihtml5.css" > 

</body>
</html>
