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
$today = date('Y-m-d');
$year = date('Y');
if(isset($_GET['year'])){
$year = $_GET['year'];
}
?>

<!--for agreement copy -->
<?php
//Agreement Copy 
if(isset($_POST['updateagree']))
{
$fullName=$_SESSION['fullName'];
$uid=$_SESSION['id'];
$department=$_SESSION['department'];
$departmentid=$_SESSION['departmentid'];

$id=$_POST['id'];

$yesno=$_POST['yesno'];
$yesno=htmlspecialchars($yesno,ENT_QUOTES);

$checkbox1=$_POST['dept_abbrivation'];
$chkcom="";
foreach($checkbox1 as $chk1)
{
$chkcom.=$chk1.",";

$department_chk2.=$chk1.",";

$codemachine=mysql_query("select * from department where department='$chk1'");
$rows=array();
while($rowmachine=mysql_fetch_array($codemachine))
$rows[]=$rowmachine;

foreach($rows as $rowmachine)
{
$department_chk.=$rowmachine['authority'].",";
}

}

// $query11=mysql_query("select * from feasibility_agreementcpy where frfno='$id' order by id desc limit 1");
// while($row11=mysql_fetch_array($query11)) 
// {      
//    $dept_combine=$chkcom;	
// }
$dept_combine=$department_chk;
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y");

$query11=mysql_query("select * from dept_combine where frfno='$id'");

if($yesno=="yes")
{
$query=mysql_query("insert into feasibility_agreementcpy(frfno,acceptby,userid,yesno,department,acceptdate,dept_abbrivation,department_chk,dept_combine) values('$id','$fullName','$uid','$yesno','$department','$dt2','$chkcom','$department_chk','$dept_combine')");

$queryfrf=mysql_query("update feasibility set dept_copy='$dept_combine' where id='$id'");


if($query=="")
{
echo '<script>              
setTimeout(function() {
swal({  
title: "Oops...!!!",
text: "Something went wrong",
type: "warning"     
}, 
function() 
{
window.location = "feasibilityview.php";
});
}, 1000);
</script>'; 
// } 
}
else
{
echo '<script>             
setTimeout(function() {
swal({  
title: "Success!",
text: "Product Release Acknowledgement Successfull",
type: "success"     
}, 
function() 
{
window.location = "feasibilityview.php";
});
}, 1000);
</script>';    
}  
}

} //if issset
else
{

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
<title>ESM | Feasibility Detail Entry</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="main/js/jquery-ui.css">
<script src="main/js/jquery-1.12.4.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->


<link rel="stylesheet" href="assets/plugins/html5-editor/bootstrap-wysihtml5.css" >
<link href="assets/plugins/footable/css/footable.core.css" rel="stylesheet">
<link href="assets/plugins/switchery/dist/switchery.min.css"rel="stylesheet" />
<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
<link href="main/css/style.css" rel="stylesheet">
<link href="main/css/colors/blue.css" id="theme" rel="stylesheet">
<link href="assets/plugins/sweetalert/sweetalert.css">
<link href="assets/plugins/wizard/steps.css">
<!-- Favicon icon -->

<!-- Bootstrap Core CSS -->
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- Page plugins css -->
<link href="assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<!-- Color picker plugins css -->
<link href="assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="main/css/style.css" rel="stylesheet">
<!-- You can change the theme colors from here -->
<link href="main/css/colors/blue.css" id="theme" rel="stylesheet">
<!--  <script src="assets/Chart.min.js"></script> -->
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<script src="respond.min.js"></script>
<![endif]-->
<!--  <script src="main/js/jquery-ui.js"></script>
<script src="jquery.min.js"></script> -->
<!--  <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

<!-- Include SmartWizard CSS -->
<link href="assets/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />

<!-- Optional SmartWizard theme -->
<link href="assets/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
<!-- This page css -->
<link href="sweetalert.css" rel="stylesheet" />
<!--  <script src="sweetalert.min.js"></script>
-->
<!-- Poppins Fonts with different sizes from Google -->
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

<!---<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />-->
<style>
div.scrollmenu 
{
overflow: 1;
}

#details th {
border: 1px solid #ddd;
padding: 8px;
}

#timelinetable th{
border: 1px solid black;
}
#timelinetable td{
border: 1px solid black;
font-size: 12px;
font-weight: 500;  
}

#reviewtable td{
border: 1px solid lightgray; 
color: black;
font-size: 12px;
font-weight: normal;
}

#reviewresulttable td{
border: 1px solid lightgray; 
color: black;
font-size: 12px;
font-weight: normal;
}

#finalconclutable td{
border: 1px solid lightgray; 
color: black;
font-size: 12px;
font-weight: normal;
}
#sampledevptable td{
border: 1px solid lightgray; 
color: black;
font-size: 12px;
font-weight: normal;
}
#devtractable td
{
border: 1px solid lightgray; 
font-size: 12px;
font-weight: normal;
/*text-align:justify;*/
}
#devtractable th
{
border: 1px solid lightgray; 

}

.h3reg,.h3timeline,.h3reqreview,.h3result,.h3sample,.h3final
{
color:black;
}

.headcolor /* To fill the sub-headings with Skyblue */
{
background-color: #87CEEB
}
.headtable{
color:white;
font-weight: 550;
font-size: 13px;
text-align: center;
background-color: #0080FF; 
}
tr.tbodyhead td{
font-size:small;color: black;font-weight:400
}

.label-warning{
width:100px;text-align: center;background-color: #ee7600;
}
.label-success{
width:100px;text-align: center;background-color: #5BB75B;
}

</style>

<style>
.circle {
width: 60px;
height: 60px;

font-size: 15px;
color: #fff;
text-align: center;
background:black;
}
.tbody
{

font-size:small;
}
.body{
font-family:Poppins, sans-serif;
}


.text{
width:170px;
background-color: white;
}
.btn-outline{
border-color: white;
}

.table-cont{
/**make table can scroll**/
max-height: 700px;
overflow: auto;
}
.table td, .table th {
vertical-align: middle;
}


</style>
<!-- Using Poppins font to print the document using browser window -->
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
<script src="jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

<div id="main-wrapper" class="scrollmenu" style="font-size:small">
<?php include("includes/config.php");?>
<?php include("includes/header.php");?> 
<?php include("includes/sidebar.php");?>
<div class="page-wrapper">
<div class="row page-titles"style="height:45px">
<div class="col-md-5 align-self-center" >
<h5 class="text-themecolor" style="font-weight:400">Feasibility Detail Entry</h5>
</div>
<div class="col-md-7 align-self-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
<li class="breadcrumb-item">Feasibility Detail Entry</li>
<li class="breadcrumb-item active">View / Update</li>
</ol>
</div> 
</div>
<?php 
$query=mysql_query("select * from feasibility where id='".$_GET['cid']."'");
//echo htmlentities($_GET['cid']);
while($row=mysql_fetch_array($query))
{
$cus=$row['cus_num'];
$customerid=$row['customer_id'];

?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
  <div class="card">
    <div class="card-body">
 <?php $queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
   while($rowacc=mysql_fetch_array($queryacc)) 
   {
   ?> 
<ul class="nav nav-tabs" role="tablist">
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$rowacc['feasibilityaccess'];
$comarr1=explode(',',trim( $complaintarr1));
$secondaryarr1=$rowacc['multidept'];
$secarr1=explode(',',trim($secondaryarr1));
$querydays1=mysql_query("select * from fsetting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['regdept'];
$qua1=explode(',',trim($quadept1));

if(((in_array($rowdays1['regdept'],$secarr1)) || (in_array($rowacc['department'],$qua1)))&&(in_array('regfeasibility',$comarr1)))
{   ?>


<?php   $query1=mysql_query("select * from master order by id desc limit 1");
while($row31=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i:s");
if($row31['licend']<= $dt3) 
{
?>
<!-- <li class="nav-item"> <a class="nav-link-active"  onclick="myFunctionstatus()" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Register</span></a> </li>  -->
<?php } 
else
{ ?>
<!-- <li class="nav-item"> <a class="nav-link"  href="registerfeasibility.php" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Register</span></a> </li> -->

<?php } 
} ?>



<?php } } } ?>



<li class="nav-item"> <a class="nav-link "  href="feasibilityview.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">View/Update</span></a> </li>


<li class="nav-item"> <a class="nav-link active"  href="feasibilitydetails.php?cid=<?php echo htmlentities($row['id']);?>" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">FRF No.&nbsp;<b>
<?php echo htmlentities($row['id']);?> 
</b>
</span></a> 
</li>

<?php   $companymaster=$rowacc['addmanageaccess'];
$compaarr=explode(',',trim($companymaster));
if(in_array('generalmanage',$compaarr))
{?>
<li class="nav-item"> <a class="nav-link"  href="feasibility_setting.php"role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Settings</span></a> </li>
<?php } ?>
</ul>

<br>  
<div class="col-sm-12" style="margin-left:60%">
<?php
if($row['result']=='Regretted')
{ ?>
<button type="submit" class="btn btn-default btn-outline" onclick="displayregretmsg();"><span class="text-muted"><i class="fa fa-edit"></i>&nbsp;Edit</span></button>
<?php }
else if($row['conclusion']=='Regularised')
{ ?>
<button type="submit" class="btn btn-default btn-outline" onclick="displaymsg();"><span class="text-muted"><i class="fa fa-edit"></i>&nbsp;Edit</span></button>
<?php }
else
{ ?>
<a href="feasibility_edit.php?cid=<?php echo htmlentities($row['id']);?>"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-edit"></i>&nbsp;Edit</span></button></a>
<?php } ?>


<a href="feasibilityview.php"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-reply"></i>&nbsp;Back</span></button></a>
<a onclick="myFunction()"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-refresh"></i>&nbsp;Refresh</span></button></a>
<a id="reportprint" target="_blank"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-print"></i>&nbsp;Print</span></button></a>
</div><br>

<?php 
$queryf=mysql_query("select * from category where id='$customerid'");
//echo htmlentities($_GET['cid']);
while($row11=mysql_fetch_array($queryf))
{
$add1=$row11['address1'];
$add2=$row11['address2'];
$add3=$row11['address3'];
$add4=$row11['city'];
$add5=$row11['district'];
$add6=$row11['state'];
$add7=$row11['country'];
$add8=$row11['pincode'];

?>
<?php  } ?>        



<div id="report">    

<table class="table table-bordered table-sm" >
<tr>  
<td rowspan="3" style="border:solid 1pt black;text-align:center;color:black;font-size:20px;font-weight:500;">FEASIBILITY REVIEW FORM</td>
<td style="border: solid 1pt black;font-size: 12px;color:black;font-weight:500;">Status</td>
<?php 
if($row['status']=="Registered")
{ ?>
<td style="border:solid 1pt black;color:#F38330;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>
<?php 
if($row['status']=="Review Complete")
{ ?>
<td style="border:solid 1pt black;color:#03A9F4;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="Quoted")
{ ?>
<td style="border:solid 1pt black;color:#00c851;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="PO received")
{ ?>
<td style="border:solid 1pt black;color:#D35400;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="Regretted")
{ ?>
<td style="border:solid 1pt black;color:#ff4444;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="Sample sent")
{ ?>
<td style="border:solid 1pt black;color:#075FBD;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="Regularised")
{ ?>
<td style="border:solid 1pt black;color:#007e33;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

<?php 
if($row['status']=="Rejected")
{ ?>
<td style="border:solid 1pt black;color:#cc0000;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>
<?php 
if($row['status']=="One Time")
{ ?>
<td style="border:solid 1pt black;color:#569926;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>
<?php 
if($row['status']=="Not Feasible")
{ ?>
<td style="border:solid 1pt black;color:#4b5f81;font-weight:bold;font-size:15px;"><?php echo htmlentities($row['status']);?></td>
<?php } ?>

</tr>
<tr>
<td style="border: solid 1pt black;font-size: 12px;color:black;font-weight:500;">FRF No.</td>
<td style="border: solid 1pt black;font-size: 15px;color:black;font-weight:bold;"><?php echo htmlentities($row['id']);?></td>


</tr>                                   
</table>
<?php
$sent1=$row['sent1'];
$sent2=$row['sent2'];
$sent3=$row['sent3'];

$maxdate = ["$sent1","$sent2","$sent3"];
$date=date("d-m-Y",max(array_map('strtotime',$maxdate)));

$batchdate1=$row['batchdate1'];
$batchdate2=$row['batchdate2'];
// $batchdate3=$row['batchdate3'];

$maxdate2 = ["$batchdate1","$batchdate2"];
$date1=date("d-m-Y",max(array_map('strtotime',$maxdate2)));
     
$regdate=$row['review_date'];
$enquirydate=$row['enquirydate'];
$regdate1 = new DateTime($regdate);
$enquirydate1 = new DateTime($enquirydate);
$datediff=$regdate1->diff($enquirydate1);
$days=$datediff->days;
$days1=$days+1;

$regdate2=$row['enquirydate'];
$reviewdate2=$row['reviewcompleted_date'];
$regandreview3 = new DateTime($regdate2);
$regandreview4= new DateTime($reviewdate2);
$datediff2=$regandreview3->diff($regandreview4);
$reviewdays=($datediff2->days)+1;

//difference between quote expected and quote submitted
$quotexpectandsubmit=$row['quotdate'];
$quotexpectandsubmit2=$date;
$quotexpectandsubmit3 = new DateTime($quotexpectandsubmit);
$quotexpectandsubmit4= new DateTime($quotexpectandsubmit2);
$datediff23=$quotexpectandsubmit3->diff($quotexpectandsubmit4);
$quotexpectandsubmit5=($datediff23->days);


$reviewdate3=$row['enquirydate'];
$quotesubmitted=$date;
$reviewandquote3 = new DateTime($reviewdate3);
$reviewandquote4= new DateTime($quotesubmitted);
$datediff3=$reviewandquote3->diff($reviewandquote4);
$quotdays=($datediff3->days)+1;
// $quotdays=$days3+$reviewdays;

$reviewdate4=$row['enquirydate'];;
$podatesam=$row['podate'];
$podatesam2 = new DateTime($reviewdate4);
$podatesam3 = new DateTime($podatesam);
$datediff4=$podatesam2->diff($podatesam3);;
$podays=($datediff4->days)+1;
// $podays=$days4+$quotdays;

$podatesam1=$row['enquirydate'];
$reviewdate5=$date1;
$podatesam5 = new DateTime($reviewdate5);
$podatesam4 = new DateTime($podatesam1);
$datediff5=$podatesam5->diff($podatesam4);;
$podays2=($datediff5->days)+1;
// $podays2=$days5+$podays;

$sampodate=$row['enquirydate'];
$samsubdate=$row['batchdate3'];
$sampodate1 = new DateTime($sampodate);
$samsubdate1 = new DateTime($samsubdate);
$datediff6=$sampodate1->diff($samsubdate1);;
$days7=($datediff6->days)+1;
// $days7=$days6+$podays;

$regudays4=$row['enquirydate'];
$regudays5=$row['regularised_date'];
$regudays6 = new DateTime($regudays4);
$regudays7 = new DateTime($regudays5);
$datediff8=$regudays7->diff($regudays6);;
$days11=($datediff8->days)+1;
// $days11=$days10+$days7;

$rejectdays4=$row['enquirydate'];
$rejectdays5=$row['rejected_date'];
$rejectdays6 = new DateTime($rejectdays4);
$rejectdays7 = new DateTime($rejectdays5);
$datediff14=$rejectdays7->diff($rejectdays6);;
$days15=($datediff14->days)+1;
// $days15=$days14+$days7;

$regretdays=$row['enquirydate'];
$regretdays2=$row['regretreceivedate'];
$regretdays3 = new DateTime($regretdays);
$regretdays4 = new DateTime($regretdays2);
$datediff16=$regretdays4->diff($regretdays3);;
$days18=($datediff16->days)+1;


?>
<!-- Time line block start  --> 
<h3 class="h3timeline"><b>Time Line</b></h3>
<div class="table-responsive">  
<table class="table table-bordered table-sm" id="timelinetable">
<tr>
<th style="color: white;background-color:#075FBD;font-size: small;">Stages</th>
<th colspan="4" style="color: white;background-color:#D35400;font-size: small;">Customer Targets</th>
<th colspan="4" style="color: white;background-color:#007e33;font-size: small; ">Actuals</th>
<th style="color: white;background-color:#075FBD;font-size: small;">Completion</th>
</tr>

<tr>
<td style="color: white;background-color:#03A9F4;font-size: small;">Registration</td>
<td style="color: white;background-color:#FFA500;font-size: small;">Enquiry Date</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['enquirydate']);?></td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Registered Date</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['review_date']);?></td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days1 %100) >= 11 && ($days1%100) <= 13)
echo $abbreviation = $days1. 'th Day';
else
{
$abbreviation = $days1. $ends[$days1 % 10];
echo "$abbreviation Day";
}   

?>

</td>
</tr> 

<tr>
<td style="color: white;background-color:#03A9F4;font-size: small;">Requirement Review</td>
<td colspan="4" style="color:#03A9F4;font-size: 15px;font-weight: bold;border:solid 1pt black;">
<?php
if($row['reviewcompleted_date']!="")
{
echo'<span style="color:#03A9F4;font-size: 15px;font-weight: bold;"><h4 style="color:#03A9F4"><b>' ."Review Completed".'</b></span>';
}
else
{
echo"";
}

?> 
</td>

<td style="color: white;background-color:#3CB371;font-size: small; ">Date</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['reviewcompleted_date']);?></td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">
<?php
$revieweddate1=$row['reviewcompleted_date'];
$regretteddate1=$row['regretreceivedate'];

$revieweddate=strtotime($revieweddate1);
$regretteddate=strtotime($regretteddate1);
if($row['regretreceivedate']!="")
{

if($regretteddate<$revieweddate)
{

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($reviewdays %100) >= 11 && ($reviewdays%100) <= 13)
{
$abbreviation = $reviewdays. 'th Day';
echo'<span style="color:red;text-decoration:line-through"><span style="color:white">' . $abbreviation .'</span></span>';
}
else
{  
$abbreviation = $reviewdays. $ends[$reviewdays % 10];
echo'<span style="color:red;text-decoration:line-through"><span style="color:white">' . $abbreviation .' Day </span></span>';
}   

}
} 
else if($row['reviewcompleted_date']!="")
{  

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($reviewdays %100) >= 11 && ($reviewdays%100) <= 13)
echo $abbreviation = $reviewdays. 'th Day';
else
{
$abbreviation = $reviewdays. $ends[$reviewdays % 10];
echo "$abbreviation Day";
}  
}
?>
</td>
</tr> 
<?php 
$querydev2 = mysql_query("SELECT * FROM development_track where ecnid='".$_GET['cid']."' and dueto='FRF'"); 
while($rowef=mysql_fetch_array($querydev2))
{ 

$devtrackstatus=$rowef['status'];
?>
<tr>
<td style="color: white;background-color:#03A9F4;font-size: small;">Development Tracker</td>
<td colspan="4">
<?php 
if(($devtrackstatus=="Initiated")||($devtrackstatus==""))
{
echo'<span style="color:#5C4AC7;font-size: 15px;font-weight: bold;"><h4 style="color:#5C4AC7"><b>' ."Initiated".'</b></span>';

}
if ($devtrackstatus=="Ready Verification")
{
echo'<span style="color:#ffb90f;font-size: 15px;font-weight: bold;"><h4 style="color:#ffb90f"><b>' .$devtrackstatus.'</b></span>';
}
if($devtrackstatus=="Need More Info")
{
echo'<span style="color:#1976D2;font-size: 15px;font-weight: bold;"><h4 style="color:#1976D2"><b>' .$devtrackstatus.'</b></span>';
}
if($devtrackstatus=="Approved")
{
echo'<span style="color:#5BB75B;font-size: 15px;font-weight: bold;"><h4 style="color:#5BB75B"><b>' .$devtrackstatus.'</b></span>';
}

?>   
</td>

<td style="color: white;background-color:#3CB371;font-size: small; ">Target Date</td>
<td colspan="3"><?php echo htmlspecialchars_decode($rowef['targetdate']);?></td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">

</td>
</tr>
<?php } ?>
<?php 
if($row['result']=="Regretted")
{ ?>  
<tr>
<td style="color: white;background-color:#03A9F4;font-size: small;">Review Result</td>
<td colspan="4" style="color:#ff4444;font-size: 15px;font-weight: bold;border:solid 1pt black;"><h4 style="color:#ff4444"><b>Regretted</b></h4></td>

<td style="color: white;background-color:#3CB371;font-size: small; ">Regret Sent Date</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['regretreceivedate']);?></td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 
if($row['result']=="Regretted")
{
$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days18 %100) >= 11 && ($days18%100) <= 13)
echo $abbreviation = $days18. 'th Day';
else
{  
$abbreviation = $days18. $ends[$days18 % 10];
echo "$abbreviation Day";
}   
}

?></td>
</tr>

<?php }  
else
{ ?>
<tr>
<td rowspan="3" style="color: white;background-color:#03A9F4;font-size: small;">Review Result</td>
<td style="color: white;background-color:#FFA500;font-size: small;">Quotation Expected</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['quotdate']);?></td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Quote Submitted</td>
<td colspan="3">
<?php
if($row['sent1']!="")
{
echo"$date"; 
} 
?><br>

<?php
if($row['sent1']!="") 
{ 
$date = strtotime($date); 
$qtdate = $row['quotdate']; 
$qtdate2 = strtotime($qtdate); 

if($date>$qtdate2)
{
if($quotexpectandsubmit5==1)
{ ?>
<span style="color: red;font-weight:500;"><i><?php echo"Delayed by $quotexpectandsubmit5 Day"; ?></i></span>
<?php  } 
else
{ ?>
<span style="color: red;font-weight:500;"><i><?php echo"Delayed by $quotexpectandsubmit5 Days"; ?></i></span>
<?php    }
}
else if($date<$qtdate2)
{ ?>

<?php  if($quotexpectandsubmit5==1)
{ ?>
<span style="color:green;font-weight:500;"><i><?php echo"Advanced by $quotexpectandsubmit5 Day";?></i></span>
<?php   } 
else
{ ?>
<span style="color:green;font-weight:500;"><i><?php echo"Advanced by $quotexpectandsubmit5 Days"; ?></i></span>
<?php    }
} }
?>

</td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 
if($row['sent1']!="")
{

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($quotdays %100) >= 11 && ($quotdays%100) <= 13)
echo $abbreviation = $quotdays. 'th Day';
else
{   
$abbreviation = $quotdays. $ends[$quotdays % 10];
echo "$abbreviation Day";
}   

}              
?>

</td>
</tr>

<tr>          
<td style="color: white;background-color:#FFA500;font-size: small;">PO Received Date for Sample</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['podate']);?></td>
<!-- <td></td> -->
<td colspan="4"></td>
<td rowspan="2" style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 
if($row['podate']!="")
{


$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($podays %100) >= 11 && ($podays%100) <= 13)
echo $abbreviation = $podays. 'th Day';
else
{  
$abbreviation = $podays. $ends[$podays % 10];
echo "$abbreviation Day";
}   

}
?> 
</td>
</tr>

<tr>
<!-- <td></td> -->
<td style="color: white;background-color:#FFA500;font-size: small;"> PO Recieved / Sample Approved for Pilot Batch</td>
<td colspan="3"><?php echo htmlspecialchars_decode($row['podate2']);?></td>
<!-- <td></td> -->
<td colspan="4"></td>
<!--  <td>s</td> -->
</tr>

<tr>
<td rowspan="4" style="color: white;background-color:#03A9F4;font-size: small;">Sample Development</td>
<td style="color: white;background-color:#FFA500;font-size: small;">Sample Expected</td>
<td style="width: 100px;"><?php echo htmlspecialchars_decode($row['quotdate1']);?></td>
<td style="color: white;background-color:#FFA500;font-size: small;">Quantity</td>
<td style="width:80px;"><?php echo htmlspecialchars_decode($row['sampledelivery']);?></td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Sample Submitted</td>
<td style="width: 100px;">
<?php
if($row['batchdate1']!="")
{
echo"$date1"; 
} 
?>  
</td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Quantity</td>
<td style="width:80px;">
<?php 
$batchdt1=$row['batchdate1'];
$batchdt2=$row['batchdate2'];

$batchdt3=strtotime($batchdt1);
$batchdt4=strtotime($batchdt2);


if($batchdt3>$batchdt4) 
{
echo htmlspecialchars_decode($row['batchquantity1']);
}
else if($batchdt4>$batchdt3)
{
echo htmlspecialchars_decode($row['batchquantity2']);
}
?>

</td>
<td rowspan="4" style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 
if(($date1!="")&&($row['batchdate3']!=""))
{  
// echo $days7.'th Day'; 

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days7 %100) >= 11 && ($days7%100) <= 13)
echo $abbreviation = $days7. 'th Day';
else
{  
$abbreviation = $days7. $ends[$days7 % 10];
echo "$abbreviation Day";
}   

} 
else if($row['batchdate1']!="")
{

$ends2 = array('th','st','nd','rd','th','th','th','th','th','th');
if (($podays2 %100) >= 11 && ($podays2%100) <= 13)
echo $abbreviation2 = $podays2. 'th Day';
else
{  
$abbreviation2 = $podays2. $ends2[$podays2 % 10];
echo "$abbreviation2 Day";
}    

} 

?>

</td>
</tr>

<tr>
<!-- <td></td> -->
<td style="color: white;background-color:#FFA500;font-size: small;">Agreed Targets after Receipt of PO</td>
<td colspan="3">
<?php 
if($row['bydays']!="")
{
$bydays9=$row['bydays'];
echo"$bydays9 Days";
}
else if($row['bydate']!="")
{
echo htmlspecialchars_decode($row['bydate']);
}
else{
echo"";
}
?>     
</td>
<td colspan="4"><i>
<?php 
if($row['podate']!="")
{
if($row['bydays']!="")
{
$bydays9=$row['bydays'];
$bydays10=$row['podate'];
$bydays11=explode('-', $bydays10);
$explodemnt=$bydays11[1];
$explodeyr=$bydays11[2];

$add1=$bydays10+$bydays9;

$enddate=date('d-m-Y', mktime(0, 0, 0, $explodemnt,$add1,$explodeyr));
echo"$bydays9 Days after Receipt of PO i.e., on $enddate";
}
elseif($row['bydate']!="") 
{
$agdate=$row['bydate'];
echo"After Receipt of PO on $agdate";
}
}  
?></i>
</td>      
</tr>

<tr>
<!-- <td></td> -->
<td style="color: white;background-color:#FFA500;font-size: small;">Pilot Batch Expected</td>
<td><?php echo htmlspecialchars_decode($row['pilotbatchdate']);?></td>
<td style="color: white;background-color:#FFA500;font-size: small;">Quantity</td>
<td><?php echo htmlspecialchars_decode($row['pilotdelivery']);?></td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Pilot Batch Submitted</td>
<td><?php echo htmlspecialchars_decode($row['batchdate3']);?></td>
<td style="color: white;background-color:#3CB371;font-size: small; ">Quantity</td>
<td><?php echo htmlspecialchars_decode($row['batchquantity3']);?></td>
<!-- <td>s</td> -->
</tr>

<tr>
<!-- <td></td> -->
<td style="color: white;background-color:#FFA500;font-size: small;">Agreed Targets after Receipt of PO</td>
<td colspan="3">
<?php 
if($row['bydays1']!="")
{

$bydays10= $row['bydays1'];
echo"$bydays10 Days";
}
else if($row['bydate1']!="")
{
echo htmlspecialchars_decode($row['bydate1']);
}
else{
echo"";
}
?> 
</td>
<td colspan="4"><i>
<?php 
if($row['podate2']!="")
{
if($row['bydays1']!="")
{
$bydays9=$row['bydays1'];
$bydays10=$row['podate2'];
$bydays11=explode('-', $bydays10);
$explodemnt=$bydays11[1];
$explodeyr=$bydays11[2];

$add1=$bydays10+$bydays9;

$enddate=date('d-m-Y', mktime(0, 0, 0, $explodemnt,$add1,$explodeyr));
echo"$bydays9 Days after Receipt of PO i.e., on $enddate";
}
elseif($row['bydate1']!="") 
{
$agdate1=$row['bydate1'];
echo"After Receipt of PO on $agdate1";
}
}   
?></i>

</td>      
</tr>
<tr>
<td style="color: white;background-color:#03A9F4;font-size: small;">Final Conclusion</td>
<td colspan="4">
<?php 
if($row['conclusion']=="Regularised")
{
echo'<span style="color:#007e33;font-size: 15px;font-weight: bold;"><h4 style="color:#007e33"><b>' . "Regularised" .'</b></span>';
}
else if($row['conclusion']=="Rejected")
{
echo'<span style="color:#cc0000;font-size: 15px;font-weight: bold;"><h4 style="color:#cc0000"><b>' . "Rejected" .'</b></span>';
}  
else
{
echo"";
}
?>

</td>
<td style="color: white;background-color:#3CB371;font-size: small; ">
<?php 
if($row['conclusion']=="Regularised")
{
echo"Regularised Date";
}
else if($row['conclusion']=="Rejected")
{
echo"Rejected Date";
}  
else
{
echo"Date";
}
?>

</td> 

<!-- <td>Date</td> -->
<td colspan="3">
<?php 
if($row['conclusion']=="Regularised")
{
echo htmlspecialchars_decode($row['regularised_date']);
}
else if($row['conclusion']=="Rejected")
{
echo htmlspecialchars_decode($row['rejected_date']);
}  
else
{
echo"";
}
?>                  
</td>
<td style="color: white;background-color:#03A9F4;font-size: small; ">
<?php 
if($row['conclusion']=="Regularised") 
{ 

$ends = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days11 %100) >= 11 && ($days11%100) <= 13)
echo $abbreviation = $days11. 'th Day';
else
{
$abbreviation = $days11. $ends[$days11 % 10];
echo "$abbreviation Day";
}   

}
else if($row['conclusion']=="Rejected")
{

$ends3 = array('th','st','nd','rd','th','th','th','th','th','th');
if (($days15 %100) >= 11 && ($days15%100) <= 13)
echo $abbreviation3 = $days15. 'th Day';
else
{
$abbreviation3 = $days15. $ends3[$days15 % 10];
echo "$abbreviation3 Day";
}   


}    
?>
</td>
</tr>

<?php   }  ?>    

</table>
</div>    

<div>                       <!-- customer details table start -->   
<h3 class="h3reg"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="regbutt" data-more="#sh" style="font-size:8px;" aria-pressed="true" onClick="displayhideregistration('registration')">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Registration</b></h3></div>   

<div id="registration" style="display:none;">   
<div class="table-responsive">         
<table class="table table-bordered table-sm" id="details">
<tr style="background-color: #0080FF;color: white;text-align: center;">
<th colspan="4">Customer Name & Address </th>
<th style="border:1px black">Contact Person</th>
<th colspan="7">Department and Designation</th>
<th>Telephone No. and Email</th>
<th>Inquiry No. & Status</th>
</tr>

<tr style="text-align: center">      
<td colspan="4" style="text-align: left"><?php echo htmlentities($row['cus_num']);?><br><?php echo $add1 ?>&nbsp;<?php echo $add2 ?>&nbsp;<?php echo $add3 ?><br><?php echo $add4 ?>&nbsp;<?php echo $add5 ?>&nbsp;<?php echo $add6 ?>&nbsp;<?php echo $add8 ?><br><?php echo $add7 ?></td>
<td> <?php echo htmlspecialchars_decode($row['con_nm']);?></td>
<td colspan="7" > <?php echo htmlspecialchars_decode($row['dep']);?></td>
<td> <?php echo htmlspecialchars_decode($row['phone']);?><br><?php echo htmlspecialchars_decode($row['email']);?></td>
<td style="color:blue;font-size:16px;font-weight:600;"> 
<?php
$track2=mysql_query("select * from inquiry_register where frfno='".$_GET['cid']."'");
while($rowf2=mysql_fetch_array($track2))
{ ?>

<a href="inquiry_view.php?cid=<?php echo $rowf2['id'];?>"><?php echo htmlspecialchars_decode($rowf2['id']);?></a><br>
<?php $statusdis=$rowf2['status'];
if($statusdis=='Pending')
{
?>
<label style="color:grey;font-size:12px;"><?php echo htmlentities($rowf2['status']);?></label> <br>
<?php 
} 
if($statusdis=='In Progress')
{
?> 
<label style="color:#03A9F4;font-size:12px;"><?php echo htmlentities($rowf2['status']);?></label> <br>
<?php 
}
if($statusdis=='Completed')
{
?>
<label style="color:#00c851;font-size:12px;"><?php echo htmlentities($rowf2['status']);?></label> <br>
<?php
}if($statusdis=='Cancelled')
{
?>
<label style="color:#FF0000;font-size:12px;"><?php echo htmlentities($rowf2['status']);?></label> <br>
<?php } } ?>

</td>
</tr>

<tr style="background-color: #0080FF;color: white;text-align: center">
<th>Enquiry Reference No.</th>
<th colspan="3">Part Name <br> [Drawing No.]</th>
<th colspan="8">Drawing Rev No.<br> [Rev. Date]</th>
<th>Is it a Drawing change ?</th>
<th colspan="4">In case of Drawing Change<br> Old Drawing No.<br>[Old Rev No.]</th>
</tr>

<tr style="text-align: center">
<td> <?php echo htmlspecialchars_decode($row['enquiry']);?></td>

<td colspan="3"><?php echo htmlspecialchars_decode($row['partno']);?><br>[<?php echo htmlspecialchars_decode($row['draw_no']);?>]</td>

<td colspan="8"><?php echo htmlspecialchars_decode($row['drawrev_no']);?><br>[<?php echo htmlspecialchars_decode($row['revdate']);?>]</td>

<td><?php echo htmlspecialchars_decode($row['isdrawchange']);?></td>

<?php
if($row['isdrawchange']=="Yes")
{ ?>
<td colspan="4"><?php echo htmlspecialchars_decode($row['revdrawno']);?><br>[<?php echo htmlspecialchars_decode($row['revno']);?>]</td>
<?php  } 
else{ ?>
<td colspan="4">-</td>
<?php  } ?>

</tr>
</table>
</div>  


</div>               
<!-- customer details table end -->  

<h3 class="h3reqreview"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" data-more="#sh" style="font-size:8px;" id="reviewbutt" aria-pressed="false" onClick="reqreview('requirementreview')">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Requirement Review</b></h3>            
<!--  <div class='' id=''>  -->
<div id="requirementreview" style="display: none;">
<div class=""> 
<table class="table table-bordered table-sm" id="reviewtable">


<thead style="background-color:#0080FF;color:white;text-align:center">
<th class="firstcol"></th>
<th>Sl No.</th>
<th>Parameter</th>
<th>Requirement</th>
<th data-toggle="tooltip" title="Review Comments about Feasibility of our organisation OR deviations from old drawings in case of drawing change">Review Comments</th>
<th>Review Status</th>

<!--   <th  colspan="2">Stabilized Model Used</th> -->
</thead>

<div class="row">   
<tr class="parent" id="product">
<td class="firstcol"><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="probutt" data-more="#sh" aria-pressed="false" style="font-size: 8px;">
<i class="ti-plus"></i><!-- <i class="fa fa-minus"></i> -->
</button></td>
<td colspan="5" style="background-color:#D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black">A. Product Requirements</td>
<!-- <td style="background-color: #D3D3D3"></td>
<td style="background-color: #D3D3D3"></td>
<td style="background-color: #D3D3D3"></td> -->

</tr>  
<!-- <div id="" style="display: none;"> -->
<tr class="child-product" id="productreq">

<td class="firstcol"> </td>
<td><h5 style="font-family:Poppins;text-align: center;font-size: small">1</h5></td>

<td class="headcolor"> Dimensions </td>
<td style="text-align: justify;font-family:Poppins;">
<?php 
if($row['dimension']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['dimension']);
}
?>

</td>
<td rowspan="7" style="text-align: justify;font-family:Poppins;"> 
<?php 
if($row['pro_comment']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['pro_comment']);
}
?></td>
<td rowspan="7" style="text-align: justify;"><?php 
if($row['pro_complete']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['pro_complete']);
}
?></td>

</tr>  
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">2</h5> </td>
<td class="headcolor">Tolerance</td>
<td style="text-align: justify;font-family:Poppins;"><?php 
if($row['tolerance']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['tolerance']);
}
?></td>


</tr>  
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">3</h5> </td>
<td class="headcolor">Surface Finish Requirement</td>
<td style="text-align: justify;font-family:Poppins;"><?php 
if($row['surface']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['surface']);
}
?></td>


</tr> 
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">4</h5> </td>
<td class="headcolor">Composition of Material </td>
<td style="text-align: justify"><?php 
if($row['comp_mate']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['comp_mate']);
}
?></td>


</tr> 
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">5</h5> </td>
<td class="headcolor">Preservation Needs </td>
<td style="text-align: justify"><?php 
if($row['preser_need']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['preser_need']);
}
?></td>


</tr> 
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">6</h5> </td>
<td class="headcolor"> Applicable Standards </td>
<td style="text-align: justify"><?php 
if($row['applic_st']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['applic_st']);
}
?></td>


</tr> 
<tr class="child-product ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">7</h5> </td>
<td class="headcolor">Manufacturing Capacity </td>
<td style="text-align: justify"><?php 
if($row['manu_cap']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['manu_cap']);
}
?></td>


</tr> 

<!--  </div> -->
</div>   
<div class="row">   
<tr class="parent2" id="standard">
<td class="firstcol"><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="stanbutt" data-more="#sh" aria-pressed="false" style="font-size:8px;">
<i class="ti-plus"></i>
</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black;">B. Standards Requirements</td>

</tr>  
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">1</h5></td>
<td class="headcolor">Customer Audits Applicable ? </td>
<td><?php 
if($row['audit_app']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['audit_app']);
}
?></td>
<td rowspan="6" style="text-align:justify;"><?php 
if($row['cus_comment']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['cus_comment']);
}
?></td>
<td rowspan="6"><?php 
if($row['cus_complete']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['cus_complete']);
}
?></td>

</tr>  
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">2</h5></td>
<td class="headcolor">Control Plans Needed ?  </td>
<td><?php 
if($row['plan_need']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['plan_need']);
}
?></td>

</tr>  
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">3</h5></td>
<td class="headcolor">Third Party Inspections Applicable  ?  </td>
<td><?php 
if($row['third_party']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['third_party']);
}
?></td>

</tr> 
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">4</h5></td>
<td class="headcolor">PPM Levels</td>
<td style="text-align: justify"><?php 
if($row['ppm']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['ppm']);
}
?></td>


</tr> 
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">5</h5></td>
<td class="headcolor">System Requirement </td>
<td style="text-align: justify"> <?php 
if($row['sys_req']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['sys_req']);
}
?></td>


</tr> 
<tr class="child-standard ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">6</h5></td>
<td class="headcolor">Applicable Standards </td>
<td><?php 
if($row['app_st']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['app_st']);
}
?></td>


</tr> 
</div>  


<div class="row">   
<tr class="parent3" id="commercial" >
<td class="firstcol"><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="combutt" data-more="#sh" aria-pressed="false" style="font-size:8px;">
<i class="ti-plus"></i>
</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black">C. Commercial</td>
<!-- <td>  </td>
<td></td>
<td></td>
-->

</tr>  
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">1</h5> </td>
<td class="headcolor"> Billing Requirements</td>
<td style="text-align: justify"><?php 
if($row['bill']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['bill']);
}
?></td>
<td rowspan="8" style="text-align: justify"><?php 
if($row['com_comment']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['com_comment']);
}
?></td>
<td rowspan="8" style="text-align: justify"><?php 
if($row['com_complete']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['com_complete']);
}
?></td>

</tr>  
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">2</h5></td>
<td class="headcolor">Insurance Required </td>
<td style="text-align: justify"><?php 
if($row['insur']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['insur']);
}
?></td>


</tr>   
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">3</h5></td>
<td class="headcolor">Special Machine Requirement</td>
<td style="text-align: justify"><?php 
if($row['mac_req']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['mac_req']);
}
?></td>


</tr> 
<tr class="child-commercial ">
<td class="firstcol"> </td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">4</h5></td>
<td class="headcolor">New Instrument</td>
<td style="text-align: justify"><?php 
if($row['new_inst']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['new_inst']);
}
?></td>


</tr> 
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">5</h5></td>
<td class="headcolor"> Additional Manpower</td>
<td style="text-align: justify"><?php 
if($row['add_man']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['add_man']);
}
?></td>


</tr> 
<tr class="child-commercial">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">6</h5></td>
<td class="headcolor">Tooling Cost</td>
<td style="text-align: justify"><span style="font-family: Verdana,sans-serif; font-size: 12px;">&#8377</span>&nbsp;<?php 
if($row['tool']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['tool']);
}
?></td>

</tr> 
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">7</h5></td>
<td class="headcolor">Gauge/Fixture Cost</td>
<td style="text-align: justify"><span style="font-family: Verdana,sans-serif; font-size: 12px;">&#8377</span>&nbsp;<?php 
if($row['gauge']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['gauge']);
}
?></td>


</tr>   
<tr class="child-commercial ">
<td class="firstcol"></td>
<td><h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">8</h5></td>
<td class="headcolor">Testing Cost</td>
<td style="text-align: justify"><span style="font-family: Verdana,sans-serif; font-size: 12px;">&#8377</span>&nbsp;<?php 
if($row['test']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['test']);
}
?></td>

</tr> 
</div> 
<div class="row">   
<tr class="parent4" id="delivery" >
<td class="firstcol"><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="delibutt" data-more="#sh" aria-pressed="false" style="font-size: 8px;">
<i class="ti-plus"></i>
</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black">D. Delivery</td>
<!-- <td> </td>
<td></td>
<td></td>
-->

</tr>  

<tr class="child-delivery">
<td class="firstcol"></td>
<td> <h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">1</h5> </td>
<td class="headcolor"> Transportation Requirements/Place etc.. </td>
<td style="text-align: justify"><?php 
if($row['transport']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['transport']);
}
?></td>
<td rowspan="2" style="text-align: justify"><?php 
if($row['deli_comment']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['deli_comment']);
}
?></td>
<td rowspan="2" style="text-align: justify"><?php 
if($row['deli_complete']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['deli_complete']);
}
?></td>

</tr>  
<tr class="child-delivery">
<td class="firstcol"></td>
<td> <h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">2</h5> </td>
<td class="headcolor"> Packaging Details </td>
<td style="text-align: justify"><?php 
if($row['pack']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['pack']);
}
?></td>


</tr>  

</div>  

<div class="row">   
<tr class="parent5" id="anotherspereq">
<td class="firstcol"><button type="button" id="anobutt" class="btn btn-info btn-sm" data-toggle="button" data-more="#sh" aria-pressed="false" style="font-size: 8px;">
<i class="ti-plus"></i>

</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black;">E. Another Special Requirements ?</td>

</tr>  
<!-- if another special requirements are given then display below elements  -->
<?php 
if($row['another']=="Yes")
{  ?>           
<tr class="child-anotherspereq">
<td class="firstcol"></td>
<td>1</td>
<td class="headcolor" style="text-align: justify"><?php 
if($row['another1title']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another1title']);
}
?></td>
<td style="text-align: justify"><?php 
if($row['another1desc']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another1desc']);
}
?></td>
<td rowspan="4"><?php echo htmlspecialchars_decode($row['spe_comment']);  ?></td>
<td rowspan="4"><?php echo htmlspecialchars_decode($row['spe_complete']);  ?></td>
</tr> 
<tr class="child-anotherspereq">
<td class="firstcol"></td>
<td>2</td>
<td class="headcolor" style="text-align: justify"><?php 
if($row['another2title']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another2title']);
}
?></td>
<td style="text-align: justify"><?php 
if($row['another2desc']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another2desc']);
}
?></td>
<!-- <td></td> -->
<!-- <td></td> -->
</tr> 
<tr class="child-anotherspereq">
<td class="firstcol"></td>
<td>3</td>
<td class="headcolor" style="text-align: justify"><?php 
if($row['another3title']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another3title']);
}
?></td>
<td style="text-align: justify"><?php 
if($row['another3desc']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another3desc']);
}
?></td>
<!-- <td></td> -->
<!-- <td></td> -->
</tr> 
<tr class="child-anotherspereq">
<td class="firstcol"></td>
<td>4</td>
<td class="headcolor" style="text-align: justify"><?php 
if($row['another4title']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another4title']);
}
?></td>
<td style="text-align: justify"><?php 
if($row['another4desc']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['another4desc']);
}
?></td>
<!-- <td></td> -->
<!-- <td></td> -->
</tr> 
<?php }   

else
{  ?>      
<tr class="child-anotherspereq">
<td class="firstcol"></td>
<td colspan="3">--</td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row['spe_comment']); ?></td>
<td><?php echo htmlspecialchars_decode($row['spe_complete']); ?></td>

</tr> 
<tr class="child-anotherspereq">
<td class="firstcol" style="display: none;"></td>
<td colspan="5" style="display: none;"></td>

</tr> 
<tr class="child-anotherspereq">
<td class="firstcol" style="display: none;"></td>
<td colspan="5" style="display: none;"></td>

</tr> 
<tr class="child-anotherspereq">
<td class="firstcol" style="display: none;"></td>
<td colspan="5" style="display: none;"></td>

</tr>                 
<?php } ?>                </div> 
<div class="row">   
<tr class="parent6" id="drawing" >
<td class="firstcol"><button type="button" id="drawbutt" class="btn btn-info btn-sm" data-toggle="button" data-more="#sh" aria-pressed="false" style="font-size: 8px;">
<i class="ti-plus"></i>
</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black;"> F. In Case of Drawing change</td>
<!--  <td>  <h5 style="font-family:Poppins; font-size: medium;text-align: center;font-weight: 400;height:5px"></h5> </td>
<td></td>
<td></td> -->
</tr>  

<?php
if($row['isdrawchange']=="Yes")
{ ?>            
<tr class="child-drawing">
<td class="firstcol"></td>
<td>1</td>
<td class="headcolor"> Work In Progress / Finished Goods Stock</td>
<td style="text-align: justify" colspan="3"><?php 
if($row['progress']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['progress']);
}
?></td>

</tr> 

<tr class="child-drawing">
<td class="firstcol"></td>
<td>2</td>
<td class="headcolor"> Done as per Old Drawing ?</td>
<td style="text-align: justify" colspan="3"><?php 
if($row['old_draw']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['old_draw']);
}
?></td>

</tr> 

<tr class="child-drawing">

<td class="firstcol"></td>
<td>3</td>
<td class="headcolor"> Customer Remark :</td>
<td colspan="3" style="text-align: justify"><?php 
if($row['remark']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['remark']);
}
?></td>

</tr>

<tr class="child-drawing">
<td class="firstcol"></td>
<td>4</td>
<td class="headcolor"> This Fesibility can be Quoted by</td>
<td style="text-align: justify" colspan="3"><?php 
if($row['feasibilitydate']=="")
{
echo"-";
} 
else{
echo htmlspecialchars_decode($row['feasibilitydate']);
}
?></td>

</tr> 
<?php }             

else
{ ?>
<!-- <tr class="child-drawing"> -->
<tr class="child-drawing" style="display: none;">
<td class="firstcol"></td>
<td colspan="5">This Feasibility is not with respect to any drawing change</td>


</tr> 

<tr class="child-drawing">
<td class="firstcol" style="display: none;"></td>
<td style="display: none;"></td>

</tr> 

<tr class="child-drawing">

<td class="firstcol" style="display: none;"></td>
<td style="display: none;"></td>


</tr>

<tr class="child-drawing">          
<td class="firstcol" style="display: none;"></td>  
<td style="display: none;"></td>

</tr>   
<!-- </tr> -->
<!--   <td></td>
<td></td>
<td></td> -->
<?php  } ?>  

</div>
<div class="row">   
<tr class="parent10" id="blockg" >
<td class="firstcol"><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="blockgbutt" data-more="#sh" aria-pressed="false" style="font-size: 8px;">
<i class="ti-plus"></i>
</button></td>
<td colspan="5" style="background-color: #D3D3D3;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: black">G. Sample / Pilot Batch Submission Expected either by Date or Days.</td>

</tr>   
<tr class="child-blockg">
<td class="firstcol"></td>
<td> <h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">1</h5> </td>
<td class="headcolor"> Sample submission expected by  (After PO)</td>
<td colspan="5" style="text-align: justify">
<?php
if($row['samplesub']=="bydays")
{
$sampledays=$row['bydays'];
echo "$sampledays Days";
}
else if($row['samplesub']=="bydate")
{
echo htmlspecialchars_decode($row['bydate']);
}
else
{
echo"-";
}
?>
</td>
</tr>  
<tr class="child-blockg">
<td class="firstcol"></td>
<td> <h5 style="font-family:Poppins; font-size: small;text-align: center;font-weight: 400;height:5px">2</h5> </td>
<td class="headcolor">Pilot Batch submission expected by  (After PO) </td>
<td colspan="5" style="text-align: justify">
<?php
if($row['pilotsub']=="bydays")
{
$pilotdays=$row['bydays1'];
echo "$pilotdays Days";
}
else if($row['pilotsub']=="bydate")
{
echo htmlspecialchars_decode($row['bydate1']);
}
else
{
echo"-";
}
?>
</td>
</tr>  
</div>
</table>
</div>  
</div>

<!-- Development tracker start -->
<?php 
$fesno=$_GET['cid'];
$querydev=mysql_query("SELECT * FROM development_track where ecnid='$fesno' and dueto='FRF'");
$numberdev=mysql_num_rows($querydev);
if ( $numberdev== '0' ) 
{ ?> 

<button id="trackerbutt" style="display:none;"></button>
<div id="devptracker" style="display:none"></div>
<label style="display:none;"></label>  
<?php } 
else
{ 
$query1=mysql_query("select * from actiontrackfeasibility where id='$fesno'");
while($row1=mysql_fetch_array($query1)) 
{ ?>

<h3 class="h3final"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="trackerbutt" data-more="#sh" aria-pressed="false" onClick="displayhidedevtracker('devptracker')" style="font-size:8px;">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Development Tracker</b></h3>

<div id="devptracker" style="display:none">
<?php 
while($row15=mysql_fetch_array($querydev)) 
{ 
$devpid=$row15['id']; ?>

<div>
<label style="color:black;font-family:'Poppins',sans-serif;">Development Tracker ID:&nbsp;<span style="font-weight:bold;font-family:'Poppins',sans-serif;"><?php echo "$devpid"; ?></span></label>
</div>
<?php } ?> 
<table class="table table-bordered table-sm" id="devtractable">
<div class="row">
<thead> 
<tr>
<th class="headtable">Sr.<br>No.</th>
<th class="headtable">Description</th>
<th class="headtable">Affects</th>
<th class="headtable">Action</th>
<th class="headtable">Department</th>
<th class="headtable">Resp</th>
<th class="headtable">Target Date</th>
<th class="headtable">Days Taken</th>
<th class="headtable">Status</th>
<th class="headtable">Cost Incurred<br> in &nbsp;<span style="font-family:Verdana,sans-serif;font-size:17px;">&#8377</span></th>
</tr></thead>

<tr>
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">PART DETAILING</td>
</tr>

<tr class="tbodyhead">
<td><center>1</center></td>
<td class="headcolor">3D Modal Update</td>
<td><?php echo htmlspecialchars_decode($row1['modalupdate_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['modalupdate_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['modalupdate_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['modalupdate_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['modalupdate_date']);?></td>
<td>
<?php
if($row1['modalupdate_status']=="Completed")
{

if($row1['modalupdate_date']==""||$row1['modalupdate_date']=="--") 
{
echo '--';
}else{
$time5=$row1['modalupdatedate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['modalupdate_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['modalupdate_date']==""||$row1['modalupdate_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['modalupdate_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['modalupdate_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['modalupdate_status']);?></span></td>
<?php }
else if($row1['modalupdate_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['modalupdate_status']);?></span></td>
<?php } 
else if($row1['modalupdate_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['modalupdate_status']);?></span></td>
<?php } 
else if($row1['modalupdate_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['modalupdate_status']);?></span></td>
<?php } 
else if($row1['modalupdate_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['modalupdate_status']);?></span><br>
<?php

$orgdate=$row1['modalupdatedate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['modalupdate_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['modalupdate_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['modalupdatecost']);?></td>
</tr>

<tr class="tbodyhead">
<td><center>2</center></td>
<td class="headcolor">2D Drawing Update</td>
<td><?php echo htmlspecialchars_decode($row1['drawingupdate2d_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['drawingupdate2d_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['drawingupdate2d_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['drawingupdate2d_date']);?></td>
<td>
<?php
if($row1['drawingupdate2d_status']=="Completed")
{

if($row1['drawingupdate2d_date']==""||$row1['drawingupdate2d_date']=="--") 
{
echo '--';
}else{
$time5=$row1['drawingupdate2ddate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['drawingupdate2d_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['drawingupdate2d_date']==""||$row1['drawingupdate2d_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['drawingupdate2d_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['drawingupdate2d_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_status']);?></span></td>
<?php }
else if($row1['drawingupdate2d_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_status']);?></span></td>
<?php } 
else if($row1['drawingupdate2d_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_status']);?></span></td>
<?php } 
else if($row1['drawingupdate2d_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_status']);?></span></td>
<?php } 
else if($row1['drawingupdate2d_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['drawingupdate2d_status']);?></span><br>
<?php

$orgdate=$row1['drawingupdate2ddate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['drawingupdate2d_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['drawingupdate2d_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['drawingupdate2dcost']);?></td>
</tr>


<tr class="tbodyhead">
<td><center>3</center></td>
<td class="headcolor">BOM Update</td>
<td><?php echo htmlspecialchars_decode($row1['bomupdate_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['bomupdate_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['bomupdate_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['bomupdate_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['bomupdate_date']);?></td>
<td>
<?php
if($row1['bomupdate_status']=="Completed")
{

if($row1['bomupdate_date']==""||$row1['bomupdate_date']=="--") 
{
echo '--';
}else{
$time5=$row1['bomupdatedate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['bomupdate_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['bomupdate_date']==""||$row1['bomupdate_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['bomupdate_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['bomupdate_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['bomupdate_status']);?></span></td>
<?php }
else if($row1['bomupdate_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['bomupdate_status']);?></span></td>
<?php } 
else if($row1['bomupdate_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['bomupdate_status']);?></span></td>
<?php } 
else if($row1['bomupdate_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['bomupdate_status']);?></span></td>
<?php } 
else if($row1['bomupdate_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['bomupdate_status']);?></span><br>
<?php

$orgdate=$row1['bomupdatedate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['bomupdate_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['bomupdate_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['bomupdatecost']);?></td>
</tr>


<tr>
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">TOOLINGS</td>
</tr>
<tr class="tbodyhead">
<td><center>4</center></td>
<td class="headcolor">Pattern</td>
<td><?php echo htmlspecialchars_decode($row1['pattern_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['pattern_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pattern_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pattern_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pattern_date']);?></td>
<td>
<?php
if($row1['pattern_status']=="Completed")
{

if($row1['pattern_date']==""||$row1['pattern_date']=="--") 
{
echo '--';
}else{
$time5=$row1['patterndate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['pattern_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['pattern_date']==""||$row1['pattern_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['pattern_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['pattern_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pattern_status']);?></span></td>
<?php }
else if($row1['pattern_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['pattern_status']);?></span></td>
<?php } 
else if($row1['pattern_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pattern_status']);?></span></td>
<?php } 
else if($row1['pattern_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pattern_status']);?></span></td>
<?php } 
else if($row1['pattern_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pattern_status']);?></span><br>
<?php

$orgdate=$row1['patterndate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['pattern_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['pattern_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['patterncost']);?></td>
</tr>
<tr class="tbodyhead">
<td><center>5</center></td>
<td class="headcolor">Jig / Fixture</td>
<td><?php echo htmlspecialchars_decode($row1['jig_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['jig_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['jig_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['jig_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['jig_date']);?></td>
<td><?php
if($row1['jig_status']=="Completed")
{

if($row1['jig_date']==""||$row1['jig_date']=="--") 
{
echo '--';
}else{
$time5=$row1['jigdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['jig_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['jig_date']==""||$row1['jig_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['jig_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>


</td>
<?php if($row1['jig_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['jig_status']);?></span></td>
<?php }
else if($row1['jig_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['jig_status']);?></span></td>
<?php } 
else if($row1['jig_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['jig_status']);?></span></td>
<?php } 
else if($row1['jig_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['jig_status']);?></span></td>
<?php } 
else if($row1['jig_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['jig_status']);?></span><br>
<?php

$orgdate=$row1['jigdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['jig_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['jig_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['jigcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>6</center></td>
<td class="headcolor">Production Tools</td>
<td><?php echo htmlspecialchars_decode($row1['tool_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['tool_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tool_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tool_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tool_date']);?></td>
<td><?php
if($row1['tool_status']=="Completed")
{

if($row1['tool_date']==""||$row1['tool_date']=="--") 
{
echo '--';
}else{
$time5=$row1['tooldate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['tool_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['tool_date']==""||$row1['tool_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['tool_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>
<?php if($row1['tool_status']=="Not Started")
{?>
<td><span class="label label-danger"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tool_status']);?></span></td>
<?php }
else if($row1['tool_status']=="Work In Progress")
{?>
<td ><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['tool_status']);?></span></td>
<?php } 
else if($row1['tool_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tool_status']);?></span></td>
<?php } 
else if($row1['tool_status']=="Not Applicable")
{?>
<td ><span class="label label-primary"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tool_status']);?></span></td>
<?php } 
else if($row1['tool_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tool_status']);?></span><br>
<?php

$orgdate=$row1['tooldate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['tool_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['tool_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php } else{?>
<td></td>
<?php } ?>      

<td><?php echo htmlspecialchars_decode($row1['toolcost']);?></td>


</tr>
<tr  class="tbodyhead">
<td><center>7</center></td>
<td class="headcolor">Gauges</td>
<td><?php echo htmlspecialchars_decode($row1['gauge_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['gauge_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['gauge_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['gauge_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['gauge_date']);?></td>
<td><?php
if($row1['gauge_status']=="Completed")
{

if($row1['gauge_date']==""||$row1['gauge_date']=="--") 
{
echo '--';
}else{
$time5=$row1['gaugedate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['gauge_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['gauge_date']==""||$row1['gauge_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['gauge_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>
<?php if($row1['gauge_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['gauge_status']);?></span></td>
<?php }
else if($row1['gauge_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['gauge_status']);?></span></td>
<?php } 
else if($row1['gauge_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['gauge_status']);?></span></td>
<?php } 
else if($row1['gauge_status']=="Not Applicable")
{?>
<td ><span class="label label-primary"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['gauge_status']);?></span></td>
<?php } 
else if($row1['gauge_status']=="Completed")
{?>
<td><span class="label label-success" ><?php echo htmlspecialchars_decode($row1['gauge_status']);?></span><br>
<?php

$orgdate=$row1['gaugedate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['gauge_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['gauge_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['gaugecost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>8</center></td>
<td class="headcolor">Any Other Toolings</td>
<td><?php echo htmlspecialchars_decode($row1['other1_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['other1_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other1_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other1_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other1_date']);?></td>
<td><?php
if($row1['other1_status']=="Completed")
{

if($row1['other1_date']==""||$row1['other1_date']=="--") 
{
echo '--';
}else{
$time5=$row1['other1date'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['other1_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['other1_date']==""||$row1['other1_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['other1_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>


</td>
<?php if($row1['other1_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other1_status']);?></span></td>
<?php }
else if($row1['other1_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['other1_status']);?></span></td>
<?php } 
else if($row1['other1_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other1_status']);?></span></td>
<?php } 
else if($row1['other1_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other1_status']);?></span></td>
<?php } 
else if($row1['other1_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other1_status']);?></span>
<br>
<?php

$orgdate=$row1['other1date'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['other1_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['other1_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['other1cost']);?></td>
</tr>


<tr class="suppdoc">
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">SUPPORTING DOCUMENTS</td>
</tr>

<tr class="suppdoc">
<td colspan="2" style="text-align:center;font-size:small;color:black;font-weight:400">
Pattern

<!-- <div id="pattfile">  --> 
<?php $cfile1=$row1['patternfile'];
if($cfile1==""  )
{

}
else if($cfile1=="NULL"||$cfile1=="default.png")
{
echo "File Not Attached";
}
else
{
$cfile2=pathinfo($row1['patternfile']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" target="_blank">View File</a>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<img style="width:50px;height:30px"src="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" ?>&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" target="_blank">View File</a>
<?php 
}else{ ?>
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['patternfile']);?>" target="_blank">View File</a>
<?php }
} ?>

<!-- </div> -->

</td>
<!-- <td ></td> -->
<td colspan="2" style="text-align:center;font-size:small;color:black;font-weight:400">Jig / Fixture

<?php $cfile1=$row1['jigfile'];
if($cfile1==""  )
{

}
else if($cfile1=="NULL"||$cfile1=="default.png")
{
echo "File Not Attached";
}
else
{
$cfile2=pathinfo($row1['jigfile']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" target="_blank">View File</a>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<img style="width:50px;height:30px"src="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" ?>&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" target="_blank">View File</a>
<?php 
}else{ ?>
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['jigfile']);?>" target="_blank">View File</a>
<?php }
} ?>

</td>
<!-- <td></td> -->
<td colspan="2" style="text-align:center;font-size:small;color:black;font-weight:400">Production Tools

<?php $cfile1=$row1['productfile'];
if($cfile1==""  )
{

}
else if($cfile1=="NULL"||$cfile1=="default.png")
{
echo "File Not Attached";
}
else
{
$cfile2=pathinfo($row1['productfile']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" target="_blank">View File</a>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<img style="width:50px;height:30px"src="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" ?>&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" target="_blank">View File</a>
<?php 
}else{ ?>
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['productfile']);?>" target="_blank">View File</a>
<?php }
} ?>


</td>
<!-- <td></td> -->
<td colspan="2" style="text-align:center;font-size:small;color:black;font-weight:400">Gauges

<?php $cfile1=$row1['gaugefile'];
if($cfile1==""  )
{

}
else if($cfile1=="NULL"||$cfile1=="default.png")
{
echo "File Not Attached";
}
else
{
$cfile2=pathinfo($row1['gaugefile']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" target="_blank">View File</a>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<img style="width:50px;height:30px"src="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" ?>&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" target="_blank">View File</a>
<?php 
}else{ ?>
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['gaugefile']);?>" target="_blank">View File</a>
<?php }
} ?>


</td>
<!-- <td></td> -->
<td colspan="2" style="text-align:center;font-size:small;color:black;font-weight:400">Any Other Toolings

<?php $cfile1=$row1['anyotherfile'];
if($cfile1==""  )
{

}
else if($cfile1=="NULL"||$cfile1=="default.png")
{
echo "File Not Attached";
}
else
{
$cfile2=pathinfo($row1['anyotherfile']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" target="_blank">View File</a>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" target="_blank">View File</a>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<img style="width:50px;height:30px"src="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" ?>&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" target="_blank">View File</a>
<?php 
}else{ ?>
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="devlopmenttracker/<?php echo htmlentities($row1['anyotherfile']);?>" target="_blank">View File</a>
<?php }
} ?>

</td>
</tr>

<tr>
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">DOCUMENTS</td>
</tr>
<tr  class="tbodyhead">
<td><center>9</center></td>
<td class="headcolor">Process Flow Diagram</td>
<td><?php echo htmlspecialchars_decode($row1['flow_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['flow_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['flow_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['flow_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['flow_date']);?></td>
<td><?php
if($row1['flow_status']=="Completed")
{

if($row1['flow_date']==""||$row1['flow_date']=="--") 
{
echo '--';
}else{
$time5=$row1['flowdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['flow_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['flow_date']==""||$row1['flow_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['flow_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['flow_status']=="Not Started")
{?>
<td><span class="label label-danger"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['flow_status']);?></span></td>
<?php }
else if($row1['flow_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['flow_status']);?></span></td>
<?php } 
else if($row1['flow_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['flow_status']);?></span></td>
<?php } 
else if($row1['flow_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['flow_status']);?></span></td>
<?php } 
else if($row1['flow_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['flow_status']);?></span><br>
<?php

$orgdate=$row1['flowdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['flow_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['flow_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['flowcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>10</center></td>
<td class="headcolor">FMEA</td>
<td><?php echo htmlspecialchars_decode($row1['fmea_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['fmea_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['fmea_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['fmea_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['fmea_date']);?></td>
<td><?php
if($row1['fmea_status']=="Completed")
{

if($row1['fmea_date']==""||$row1['fmea_date']=="--") 
{
echo '--';
}else{
$time5=$row1['fmeadate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['fmea_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['fmea_date']==""||$row1['fmea_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['fmea_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>
<?php if($row1['fmea_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['fmea_status']);?></span></td>
<?php }
else if($row1['fmea_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['fmea_status']);?></span></td>
<?php } 
else if($row1['fmea_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['fmea_status']);?></span></td>
<?php } 
else if($row1['fmea_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['fmea_status']);?></span></td>
<?php } 
else if($row1['fmea_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['fmea_status']);?></span>
<br>
<?php

$orgdate=$row1['fmeadate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['fmea_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['fmea_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['fmeacost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>11</center></td>
<td class="headcolor">Control Plan</td>
<td><?php echo htmlspecialchars_decode($row1['cp_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['cp_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cp_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cp_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cp_date']);?></td>
<td><?php
if($row1['cp_status']=="Completed")
{

if($row1['cp_date']==""||$row1['cp_date']=="--") 
{
echo '--';
}else{
$time5=$row1['cpdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['cp_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['cp_date']==""||$row1['cp_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['cp_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['cp_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cp_status']);?></span></td>
<?php }
else if($row1['cp_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['cp_status']);?></span></td>
<?php } 
else if($row1['cp_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cp_status']);?></span></td>
<?php } 
else if($row1['cp_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cp_status']);?></span></td>
<?php } 
else if($row1['cp_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cp_status']);?></span>
<br>
<?php

$orgdate=$row1['cpdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['cp_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['cp_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['cpcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>12</center></td>
<td class="headcolor">Process Layout</td>
<td><?php echo htmlspecialchars_decode($row1['layout_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['layout_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['layout_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['layout_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['layout_date']);?></td>
<td><?php
if($row1['layout_status']=="Completed")
{

if($row1['layout_date']==""||$row1['layout_date']=="--") 
{
echo '--';
}else{
$time5=$row1['layoutdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['layout_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['layout_date']==""||$row1['layout_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['layout_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['layout_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['layout_status']);?></span></td>
<?php }
else if($row1['layout_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" ><?php echo htmlspecialchars_decode($row1['layout_status']);?></span></td>
<?php } 
else if($row1['layout_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['layout_status']);?></span></td>
<?php } 
else if($row1['layout_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['layout_status']);?></span></td>
<?php } 
else if($row1['layout_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['layout_status']);?></span>
<br>
<?php

$orgdate=$row1['layoutdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['layout_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['layout_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['layoutcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>13</center></td>
<td class="headcolor">Quality Plan</td>
<td><?php echo htmlspecialchars_decode($row1['quality_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['quality_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['quality_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['quality_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['quality_date']);?></td>
<td><?php
if($row1['quality_status']=="Completed")
{

if($row1['quality_date']==""||$row1['quality_date']=="--") 
{
echo '--';
}else{
$time5=$row1['qualitydate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['quality_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['quality_date']==""||$row1['quality_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['quality_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['quality_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['quality_status']);?></span></td>
<?php }
else if($row1['quality_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['quality_status']);?></span></td>
<?php } 
else if($row1['quality_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['quality_status']);?></span></td>
<?php } 
else if($row1['quality_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['quality_status']);?></span></td>
<?php } 
else if($row1['quality_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['quality_status']);?></span><br>
<?php

$orgdate=$row1['qualitydate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['quality_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['quality_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['qualitycost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>14</center></td>
<td class="headcolor">Machining Drawing</td>
<td><?php echo htmlspecialchars_decode($row1['machine_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['machine_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['machine_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['machine_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['machine_date']);?></td>
<td><?php
if($row1['machine_status']=="Completed")
{

if($row1['machine_date']==""||$row1['machine_date']=="--") 
{
echo '--';
}else{
$time5=$row1['machinedate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['machine_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['machine_date']==""||$row1['machine_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['machine_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['machine_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['machine_status']);?></span></td>
<?php }
else if($row1['machine_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['machine_status']);?></span></td>
<?php } 
else if($row1['machine_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['machine_status']);?></span></td>
<?php } 
else if($row1['machine_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['machine_status']);?></span></td>
<?php } 
else if($row1['machine_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['machine_status']);?></span><br>
<?php

$orgdate=$row1['machinedate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['machine_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['machine_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['machinecost']);?></td>


</tr>
<tr  class="tbodyhead">
<td><center>15</center></td>
<td class="headcolor">Casting Drawing</td>
<td><?php echo htmlspecialchars_decode($row1['cast_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['cast_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cast_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cast_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cast_date']);?></td>
<td><?php
if($row1['cast_status']=="Completed")
{

if($row1['cast_date']==""||$row1['cast_date']=="--") 
{
echo '--';
}else{
$time5=$row1['castdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['cast_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['cast_date']==""||$row1['cast_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['cast_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['cast_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cast_status']);?></span></td>
<?php }
else if($row1['cast_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cast_status']);?></span></td>
<?php } 
else if($row1['cast_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cast_status']);?></span></td>
<?php } 
else if($row1['cast_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cast_status']);?></span></td>
<?php } 
else if($row1['cast_status']=="Completed")
{?>
<td><span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cast_status']);?></span><br>
<?php

$orgdate=$row1['castdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['cast_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['cast_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['castcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>16</center></td>
<td class="headcolor">Tooling Drawing</td>
<td><?php echo htmlspecialchars_decode($row1['tooling_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['tooling_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tooling_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tooling_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['tooling_date']);?></td>
<td><?php
if($row1['tooling_status']=="Completed")
{

if($row1['tooling_date']==""||$row1['tooling_date']=="--") 
{
echo '--';
}else{
$time5=$row1['toolingdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['tooling_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['tooling_date']==""||$row1['tooling_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['tooling_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>
<?php if($row1['tooling_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tooling_status']);?></span></td>
<?php }
else if($row1['tooling_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tooling_status']);?></span></td>
<?php } 
else if($row1['tooling_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tooling_status']);?></span></td>
<?php } 
else if($row1['tooling_status']=="Not Applicable")
{?>
<td ><span class="label label-primary"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tooling_status']);?></span></td>
<?php } 
else if($row1['tooling_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['tooling_status']);?></span>
<br>
<?php

$orgdate=$row1['toolingdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['tooling_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['tooling_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['toolingcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>17</center></td>
<td class="headcolor">Packing STD</td>
<td><?php echo htmlspecialchars_decode($row1['pack_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['pack_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pack_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pack_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['pack_date']);?></td>
<td><?php
if($row1['pack_status']=="Completed")
{

if($row1['pack_date']==""||$row1['pack_date']=="--") 
{
echo '--';
}else{
$time5=$row1['packdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['pack_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['pack_date']==""||$row1['pack_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['pack_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['pack_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pack_status']);?></span></td>
<?php }
else if($row1['pack_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pack_status']);?></span></td>
<?php } 
else if($row1['pack_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pack_status']);?></span></td>
<?php } 
else if($row1['pack_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pack_status']);?></span></td>
<?php } 
else if($row1['pack_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['pack_status']);?></span>
<br>
<?php

$orgdate=$row1['packdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['pack_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['pack_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php } else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['packcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>18</center></td>
<td class="headcolor">Master Lists of Documents</td>
<td><?php echo htmlspecialchars_decode($row1['master_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['master_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['master_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['master_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['master_date']);?></td>
<td><?php
if($row1['master_status']=="Completed")
{

if($row1['master_date']==""||$row1['master_date']=="--") 
{
echo '--';
}else{
$time5=$row1['masterdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['master_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['master_date']==""||$row1['master_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['master_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['master_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['master_status']);?></span></td>
<?php }
else if($row1['master_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['master_status']);?></span></td>
<?php } 
else if($row1['master_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['master_status']);?></span></td>
<?php } 
else if($row1['master_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['master_status']);?></span></td>
<?php } 
else if($row1['master_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['master_status']);?></span><br>
<?php

$orgdate=$row1['masterdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['master_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['master_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['mastercost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>19</center></td>
<td class="headcolor">NC Programs</td>
<td><?php echo htmlspecialchars_decode($row1['nc_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['nc_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['nc_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['nc_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['nc_date']);?></td>
<td><?php
if($row1['nc_status']=="Completed")
{

if($row1['nc_date']==""||$row1['nc_date']=="--") 
{
echo '--';
}else{
$time5=$row1['ncdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['nc_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['nc_date']==""||$row1['nc_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['nc_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['nc_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['nc_status']);?></span></td>
<?php }
else if($row1['nc_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['nc_status']);?></span></td>
<?php } 
else if($row1['nc_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['nc_status']);?></span></td>
<?php } 
else if($row1['nc_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['nc_status']);?></span></td>
<?php } 
else if($row1['nc_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['nc_status']);?></span>
<br>
<?php

$orgdate=$row1['ncdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['nc_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['nc_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>  

<td><?php echo htmlspecialchars_decode($row1['nccost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>20</center></td>
<td class="headcolor">Training of Stake Holders</td>
<td><?php echo htmlspecialchars_decode($row1['train_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['train_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['train_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['train_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['train_date']);?></td>
<td><?php
if($row1['train_status']=="Completed")
{

if($row1['train_date']==""||$row1['train_date']=="--") 
{
echo '--';
}else{
$time5=$row1['traindate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['train_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['train_date']==""||$row1['train_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['train_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['train_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['train_status']);?></span></td>
<?php }
else if($row1['train_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['train_status']);?></span></td>
<?php } 
else if($row1['train_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['train_status']);?></span></td>
<?php } 
else if($row1['train_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['train_status']);?></span></td>
<?php } 
else if($row1['train_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['train_status']);?></span><br>
<?php

$orgdate=$row1['traindate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['train_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['train_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php  }else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['traincost']);?></td>

</tr>


<tr class="tbodyhead">
<td><center>21</center></td>
<td class="headcolor">Any Other Document</td>
<td><?php echo htmlspecialchars_decode($row1['other2_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['other2_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other2_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other2_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['other2_date']);?></td>
<td><?php
if($row1['other2_status']=="Completed")
{

if($row1['other2_date']==""||$row1['other2_date']=="--") 
{
echo '--';
}else{
$time5=$row1['other2date'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['other2_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['other2_date']==""||$row1['other2_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['other2_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['other2_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other2_status']);?></span></td>
<?php }
else if($row1['other2_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other2_status']);?></span></td>
<?php } 
else if($row1['other2_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other2_status']);?></span></td>
<?php } 
else if($row1['other2_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other2_status']);?></span></td>
<?php } 
else if($row1['other2_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['other2_status']);?></span>
<br>
<?php

$orgdate=$row1['other2date'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['other2_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['other2_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>


<td><?php echo htmlspecialchars_decode($row1['other2cost']);?></td>
</tr>


<tr>
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">COSTING</td>
</tr>
<tr class="tbodyhead">
<td><center>22</center></td>
<td class="headcolor">Impact in Supplier Costing</td>
<td><?php echo htmlspecialchars_decode($row1['supp_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['supp_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['supp_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['supp_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['supp_date']);?></td>
<td><?php
if($row1['supp_status']=="Completed")
{

if($row1['supp_date']==""||$row1['supp_date']=="--") 
{
echo '--';
}else{
$time5=$row1['suppdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['supp_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['supp_date']==""||$row1['supp_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['supp_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['supp_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['supp_status']);?></span></td>
<?php }
else if($row1['supp_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['supp_status']);?></span></td>
<?php } 
else if($row1['supp_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['supp_status']);?></span></td>
<?php } 
else if($row1['supp_status']=="Not Applicable")
{?>
<td ><span class="label label-primary"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['supp_status']);?></span></td>
<?php } 
else if($row1['supp_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['supp_status']);?></span><br>
<?php

$orgdate=$row1['suppdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['supp_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['supp_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>


<td><?php echo htmlspecialchars_decode($row1['suppcost']);?></td>
</tr>


<tr class="tbodyhead">
<td><center>23</center></td>
<td class="headcolor">Impact in Production Costing</td>
<td><?php echo htmlspecialchars_decode($row1['productioncost_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['productioncost_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['productioncost_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['productioncost_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['productioncost_date']);?></td>
<td>
<?php
if($row1['productioncost_status']=="Completed")
{

if($row1['productioncost_date']==""||$row1['productioncost_date']=="--") 
{
echo '--';
}else{
$time5=$row1['productioncostdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['productioncost_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['productioncost_date']==""||$row1['productioncost_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['productioncost_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['productioncost_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['productioncost_status']);?></span></td>
<?php }
else if($row1['productioncost_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['productioncost_status']);?></span></td>
<?php } 
else if($row1['productioncost_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['productioncost_status']);?></span></td>
<?php } 
else if($row1['productioncost_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['productioncost_status']);?></span></td>
<?php } 
else if($row1['productioncost_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['productioncost_status']);?></span><br>
<?php

$orgdate=$row1['productioncostdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['productioncost_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['productioncost_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['productioncost_cost']);?></td>
</tr>



<tr  class="tbodyhead">
<td><center>24</center></td>
<td class="headcolor">Impact in Customer Costing</td>
<td><?php echo htmlspecialchars_decode($row1['cus_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['cus_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cus_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cus_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['cus_date']);?></td>
<td><?php
if($row1['cus_status']=="Completed")
{

if($row1['cus_date']==""||$row1['cus_date']=="--") 
{
echo '--';
}else{
$time5=$row1['cusdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['cus_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['cus_date']==""||$row1['cus_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['cus_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['cus_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cus_status']);?></span></td>
<?php }
else if($row1['cus_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cus_status']);?></span></td>
<?php } 
else if($row1['cus_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cus_status']);?></span></td>
<?php } 
else if($row1['cus_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cus_status']);?></span></td>
<?php } 
else if($row1['cus_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['cus_status']);?></span>
<br>
<?php

$orgdate=$row1['cusdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");

if($row1['cus_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['cus_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php } else{?>
<td></td>
<?php } ?>
<td><?php echo htmlspecialchars_decode($row1['cuscost']);?></td>
</tr>


<tr class="tbodyhead">
<td><center>25</center></td>
<td class="headcolor">Any Other Costing</td>
<td><?php echo htmlspecialchars_decode($row1['anyothercost_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['anyothercost_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['anyothercost_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['anyothercost_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['anyothercost_date']);?></td>
<td>
<?php
if($row1['anyothercost_status']=="Completed")
{

if($row1['anyothercost_date']==""||$row1['anyothercost_date']=="--") 
{
echo '--';
}else{
$time5=$row1['anyothercostdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['anyothercost_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['anyothercost_date']==""||$row1['anyothercost_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['anyothercost_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>

</td>

<?php 
if($row1['anyothercost_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['anyothercost_status']);?></span></td>
<?php }
else if($row1['anyothercost_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center;background-color: #ee7600"><?php echo htmlspecialchars_decode($row1['anyothercost_status']);?></span></td>
<?php } 
else if($row1['anyothercost_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['anyothercost_status']);?></span></td>
<?php } 
else if($row1['anyothercost_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['anyothercost_status']);?></span></td>
<?php } 
else if($row1['anyothercost_status']=="Completed")
{?>
<td>
<span class="label label-success"  style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['anyothercost_status']);?></span><br>
<?php

$orgdate=$row1['anyothercostdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");

if($row1['anyothercost_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['anyothercost_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?>
</td>

<?php }  else{?>
<td></td>
<?php } ?>  
<td><?php echo htmlspecialchars_decode($row1['anyothercost_cost']);?></td>
</tr>

<tr>
<td colspan="10" style="color:black;font-weight:600;background-color: #D3D3D3">INVENTORY DISPOSITION</td>
</tr>
<tr style="color:black;font-weight: 600;background-color: #DCDCDC;text-align: center">
<th class="headtable"></th>
<th class="headtable">Category</th>
<th class="headtable">Stock in Qty</th>
<th class="headtable">Action</th>
<th class="headtable">Dept</th>
<th class="headtable">Resp</th>
<th class="headtable">Target Date</th>
<th class="headtable">Days Taken</th>
<th class="headtable">Status</th>
<th class="headtable">Cost Incurred</th>
</tr>
<tr  class="tbodyhead">
<td><center>26</center></td>
<td class="headcolor">Casting</td>
<td><?php echo htmlspecialchars_decode($row1['casting_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['casting_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['casting_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['casting_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['casting_date']);?></td>
<td><?php
if($row1['casting_status']=="Completed")
{

if($row1['casting_date']==""||$row1['casting_date']=="--") 
{
echo '--';
}else{
$time5=$row1['castingdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['casting_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['casting_date']==""||$row1['casting_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['casting_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['casting_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['casting_status']);?></span></td>
<?php }
else if($row1['casting_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['casting_status']);?></span></td>
<?php } 
else if($row1['casting_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['casting_status']);?></span></td>
<?php } 
else if($row1['casting_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['casting_status']);?></span></td>
<?php } 
else if($row1['casting_status']=="Completed")
{?>
<td><span class="label label-success"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['casting_status']);?></span>
<br>
<?php

$orgdate=$row1['castingdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['casting_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['casting_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }  else{?>
<td></td>
<?php } ?>

<td><?php echo htmlspecialchars_decode($row1['castingcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>27</center></td>
<td class="headcolor">Semi Finish</td>
<td><?php echo htmlspecialchars_decode($row1['semi_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['semi_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['semi_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['semi_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['semi_date']);?></td>
<td><?php
if($row1['semi_status']=="Completed")
{

if($row1['semi_date']==""||$row1['semi_date']=="--") 
{
echo '--';
}else{
$time5=$row1['semidate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['semi_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['semi_date']==""||$row1['semi_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['semi_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['semi_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['semi_status']);?></span></td>
<?php }
else if($row1['semi_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['semi_status']);?></span></td>
<?php } 
else if($row1['semi_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['semi_status']);?></span></td>
<?php } 
else if($row1['semi_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['semi_status']);?></span></td>
<?php } 
else if($row1['semi_status']=="Completed")
{?>
<td><span class="label label-success"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['semi_status']);?></span><br>
<?php

$orgdate=$row1['semidate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
//  $newdate_date=DateTime::createFromFormat("Y-m-d H:i:s", "$newdate")->format("d/m/Y");


if($row1['semi_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['semi_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php } else{?>
<td></td>
<?php } ?>  


<td><?php echo htmlspecialchars_decode($row1['semicost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>28</center></td>
<td class="headcolor">Finished</td>
<td><?php echo htmlspecialchars_decode($row1['finish_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['finish_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['finish_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['finish_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['finish_date']);?></td>
<td><?php
if($row1['finish_status']=="Completed")
{

if($row1['finish_date']==""||$row1['finish_date']=="--") 
{
echo '--';
}else{
$time5=$row1['finishdate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['finish_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['finish_date']==""||$row1['finish_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['finish_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['finish_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['finish_status']);?></span></td>
<?php }
else if($row1['finish_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['finish_status']);?></span></td>
<?php } 
else if($row1['finish_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['finish_status']);?></span></td>
<?php } 
else if($row1['finish_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['finish_status']);?></span></td>
<?php } 
else if($row1['finish_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['finish_status']);?></span>
<br>
<?php

$orgdate=$row1['finishdate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
if($row1['finish_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['finish_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }else{?>
<td></td>
<?php } ?>  


<td><?php echo htmlspecialchars_decode($row1['finishcost']);?></td>

</tr>
<tr  class="tbodyhead">
<td><center>29</center></td>
<td class="headcolor">Recall</td>
<td><?php echo htmlspecialchars_decode($row1['recall_aff']);?></td>
<td style="text-align:justify;"><?php echo htmlspecialchars_decode($row1['recall_action']);?></td>
<td><?php echo htmlspecialchars_decode($row1['recall_dept']);?></td>
<td><?php echo htmlspecialchars_decode($row1['recall_user']);?></td>
<td><?php echo htmlspecialchars_decode($row1['recall_date']);?></td>
<td><?php
if($row1['recall_status']=="Completed")
{

if($row1['recall_date']==""||$row1['recall_date']=="--") 
{
echo '--';
}else{
$time5=$row1['recalldate'];
$time52=date("d-m-Y",strtotime($time5));
$time51=strtotime($time52);
$current=strtotime($row1['recall_date']);

if($current == $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else if($current > $time51)
{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:green;text-align:center;"><?php echo $date6 ?>&nbsp;days taken</span>
<?php }
else{
$sub_time5=abs($current-$time51);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:red;text-align:center;"><?php echo $date6 ?>&nbsp;days overdue</span>

<?php }

} } 

else{

if($row1['recall_date']==""||$row1['recall_date']=="--") 
{
echo '--';
}else{
$time5=strtotime($row1['recall_date']);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$current1=date("d-m-Y");
$current=strtotime($current1);
if($current == $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }
else if($current < $time5)
{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5;  ?>
<span style="color:black;text-align:center;"><?php echo $date6 ?>&nbsp;days Left</span>
<?php }else{
$sub_time5=abs($current-$time5);
$date5=$sub_time5/86400; //86400 seconds in ond day
$date5=intval($date5);
$date6=$date5; ?>
<span style="color:gray;text-align:center;"><?php echo $date6+1 ?>&nbsp;days overdue</span>

<?php }

} } ?>
</td>
<?php if($row1['recall_status']=="Not Started")
{?>
<td><span class="label label-danger" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['recall_status']);?></span></td>
<?php }
else if($row1['recall_status']=="Work In Progress")
{?>
<td style="color:orange"><span class="label label-warning"style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['recall_status']);?></span></td>
<?php } 
else if($row1['recall_status']=="On Hold")
{?>
<td style="color:blue"><span class="label label-info" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['recall_status']);?></span></td>
<?php } 
else if($row1['recall_status']=="Not Applicable")
{?>
<td ><span class="label label-primary" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['recall_status']);?></span></td>
<?php } 
else if($row1['recall_status']=="Completed")
{?>
<td><span class="label label-success" style="width:100px;text-align: center"><?php echo htmlspecialchars_decode($row1['recall_status']);?></span>
<br>
<?php

$orgdate=$row1['recalldate'];
//$orgdate = Date($orgdate);
//echo $orgdate;
$newdate=date("d-m-Y",strtotime($orgdate));
if($row1['recall_date'] > $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else if($row1['recall_date'] == $newdate ) 
{ ?>
<span style="color:green;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php }
else {?>
<span style="color:red;text-align:center;font-size: 11px"><center>on&nbsp;&nbsp;<?php echo $newdate ?></center></span>
<?php } ?></td>   
<?php }else{?>
<td></td>
<?php } ?>  


<td><?php echo htmlspecialchars_decode($row1['recallcost']);?></td>

</tr>
</div>
</table>
</div>

<?php } } ?>  

<!-- Development tracker end -->
<!-- <?php
$querydev2=mysql_query("SELECT * FROM development_track where ecnid='$fesno' and dueto='FRF'");
while($rowtra=mysql_fetch_array($querydev2))
{ 
$devpid2=$rowtra['ecnid'];
?>  
<input type="text" id="devpid2" value="<?php echo"$devpid2";?>">
<?php } ?> -->



<!--review result table start -->
<h3 class="h3result"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="resultbutt" data-more="#sh" aria-pressed="false" onClick="displayhidereviewresult('reviewresult')" style="font-size:8px;">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Review Result</b></h3>

<div id="reviewresult" style="display: none;">
<div class="table-responsive"> 
<table class="table table-bordered table-sm" id="reviewresulttable"> 
<div class="row">  

<tr>

<td colspan="7" style="background-color: #0080FF;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: white">Review Result:</td>

</tr>  
<!-- If quoted  -->      

<?php 
if($row['result']=="Quoted")
{  ?>                

<tr>
<td style="width:200px;"class="headcolor">
The Above query can be quoted/regretted .</td>
<td colspan="5" style="color:#00c851;font-weight:bold;font-size:15px;"><b><?php echo htmlspecialchars_decode($row['result']);?></b></td>
</tr> 


<tr>
<td class="headcolor">1. Quotation / Offer No.</td>
<td><?php echo htmlspecialchars_decode($row['offerno1']);?></td>
<td class="headcolor">Quote Sent Date</td>
<td><?php echo htmlspecialchars_decode($row['sent1']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Quotation / Offer</td>
<td class="quoteletter"> 
<span id="regretlet"></span>
<?php 
$cfile1=$row['offer1'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>

<span id="quotelet1">File Not Attached</span>
<?php }
else
{ 
?>
<span id="quotelet1" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['offer1']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" target="_blank">View File</a></div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer1']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>

</td>

  
</tr> 

<tr>

<td class="headcolor">2. Quotation / Offer No.</td>
<td><?php echo htmlspecialchars_decode($row['offerno2']);?></td>
<td class="headcolor">Quote Sent Date</td>
<td><?php echo htmlspecialchars_decode($row['sent2']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Quotation / Offer</td>
<td class="quoteletter"> 


<?php 
$cfile1=$row['offer2'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="quotelet2">File Not Attached</span>
<?php }
else
{ ?>
<span id="quotelet2" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['offer2']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" target="_blank">View File</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer2']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>


</td>

  
</tr> 

<tr>

<td class="headcolor">3.Quotation / Offer No</td>
<td><?php echo htmlspecialchars_decode($row['offerno3']);?></td>
<td class="headcolor">Quote Sent Date</td>
<td><?php echo htmlspecialchars_decode($row['sent3']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Quotation / Offer</td>
<td class="quoteletter">

<?php 
$cfile1=$row['offer3'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="quotelet3">File Not Attached</span>
<?php }
else
{ ?>
<span id="quotelet3" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['offer3']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" target="_blank">View File</a></div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['offer3']);?>" target="_blank">View File</a></div>
<?php }
} ?>
</td>
</tr> 
      
    

<tr>
<td class="headcolor">Customer PO No &nbsp;&nbsp;(For Sample)</td>
<td><?php echo htmlspecialchars_decode($row['pono']);?></td>
<td class="headcolor">PO Date</td>
<td><?php echo htmlspecialchars_decode($row['podate']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Uploaded PO</td>
<td class="quoteletter" colspan="3">
      
<?php 
$cfile1=$row['uploadpo'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="uploadpolet1">File Not Attached</span>
<?php }
else
{ ?>
<span id="uploadpolet1" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['uploadpo']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" target="_blank">View File</a></div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" target="_blank">View File</a></div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>
</td>
</tr> 
<tr>

<td class="headcolor">Customer PO No &nbsp;&nbsp;(For Pilot)</td>
<td><?php echo htmlspecialchars_decode($row['pono2']);?></td>
<td class="headcolor">PO Date</td>
<td><?php echo htmlspecialchars_decode($row['podate2']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Uploaded PO</td>
<td class="quoteletter" colspan="3">
      
<?php 
$cfile1=$row['uploadpo2'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="uploadpolet2">File Not Attached</span>
<?php }
else
{ ?>
<span id="uploadpolet2" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['uploadpo2']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo2']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo2']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo2']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['uploadpo2']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo2']);?>" target="_blank">View File</a></div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadpo22']);?>" target="_blank">View File</a></div>
<?php }
} ?>
</td>
</tr>
<tr>
<td class="headcolor">Other Requirements Accepted</td>
<td colspan="5"><?php echo htmlspecialchars_decode($row['other']);?></td>
</tr> 
<?php } 
else if($row['result']=="Regretted")
{ ?>
<tr>
<td class="headcolor">The Above query can be quoted/regretted</td>
<td colspan="2"style="color:#ff4444;font-weight:bold;font-size:15px;width:800px;"><b><?php echo htmlspecialchars_decode($row['result']);?></b></td>
 </tr> 
 <tr>

    <td class="headcolor">Regretted sent on</td>
    <td colspan="2"><?php echo htmlspecialchars_decode($row['regretreceivedate']);?></td>

    
 </tr> 
 <tr>

<td style="background-color:#87CEEB" class="regretletter">Regret Letter</td>
<td class="regretletter" colspan="2">

<span id="quotelet1"></span>
<span id="quotelet2"></span>
<span id="quotelet3"></span>
<span id="uploadpolet1"></span>
<span id="uploadpolet2"></span>

<?php 
$cfile1=$row['uploadregret'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>

<span id="regretlet">File Not Attached</span>
<?php }
else
{ ?>
<span id="regretlet" style="display:none;">File Attached</span>

<?php
$cfile2=pathinfo($row['uploadregret']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" target="_blank">View File</a></div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" target="_blank">View File</a></div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" target="_blank">View File</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['uploadregret']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>

</td>

    
</tr> 
<?php }  

else
{ ?>
<td>-
<span id="quotelet1"></span>
<span id="quotelet2"></span>
<span id="quotelet3"></span>
<span id="uploadpolet1"></span>
<span id="uploadpolet2"></span>
<span id="regretlet"></span>
</td>

<?php } ?>


</div> 
</table>
</div>      
</div>   

<h3 class="h3sample"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="samplebutt" data-more="#sh" aria-pressed="false" onClick="displayhidesampledevp2('sampledevp2')" style="font-size:8px;">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Sample Development</b></h3>

<div id="sampledevp2" style="display: none;">
<div class="table-responsive">
<table class="table table-bordered table-sm" id="sampledevptable">
<div class="row">
<tr>
<td colspan="8" style="background-color: #0080FF;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: white">Sample Development</td>
</tr>  
<tr>
<td class="headcolor">1st Sample Batch Quantity</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchquantity1']);?></td>
<td class="headcolor">Invoice No.</td>
<td style="width:120px;"><?php echo htmlspecialchars_decode($row['invoiceno1']);?></td>
<td class="headcolor">Sent Date</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchdate1']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">1st Sample Inspection Report</td>
<td class="quoteletter" style="width:100px;">
<?php 
$cfile1=$row['inspecreport1'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="samplelet1">File Not Attached</span>
<?php }
else
{ ?>
<span id="samplelet1" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['inspecreport1']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" target="_blank">View File</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport1']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>
</td>
</tr>  

<tr>
<td class="headcolor">2nd Sample Batch Quantity</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchquantity2']);?></td>
<td class="headcolor">Invoice No.</td>
<td style="width:120px;"><?php echo htmlspecialchars_decode($row['invoiceno2']);?></td>
<td class="headcolor">Sent Date</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchdate2']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">2nd Sample Inspection Report</td>
<td class="quoteletter" style="width:100px;">
<?php 
$cfile1=$row['inspecreport2'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="samplelet2">File Not Attached</span>
<?php }
else
{ ?>
<span id="samplelet2" style="display:none;">File Attached</span>
<?php
$cfile2=pathinfo($row['inspecreport2']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?>  
<div class="viewfile">
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" target="_blank">View File</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport2']);?>" target="_blank">View File</a>
</div>
<?php }
} ?> 
</td>
</tr> 


<tr>
<td class="headcolor">Pilot Batch Quantity</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchquantity3']);?></td>
<td class="headcolor">Invoice No.</td>
<td style="width:120px;"><?php echo htmlspecialchars_decode($row['invoiceno3']);?></td>
<td class="headcolor">Sent Date</td>
<td style="width:100px;"><?php echo htmlspecialchars_decode($row['batchdate3']);?></td>
<td style="background-color:#87CEEB" class="quoteletter">Pilot Batch Inspection Report</td>
<td class="quoteletter" style="width:100px;">
<?php 
$cfile1=$row['inspecreport3'];
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span id="samplelet3">File Not Attached</span>
<?php }
else
{ ?>
<span id="samplelet3" style="display:none;">File Attached</span>
<?php 
$cfile2=pathinfo($row['inspecreport3']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
<img src="complaintdocs/doc.png" style="height:40px;width:45px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" target="_blank">View File</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile">
<img src="complaintdocs/pdf.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
<img src="complaintdocs/xls.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" target="_blank">View File</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<img style="width:50px;height:30px"src="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" ?>&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" target="_blank">View File</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<img src="complaintdocs/unknown.png" style="height:40px;width:40px">
&nbsp;<a href="feasibilityfiles/<?php echo htmlentities($row['inspecreport3']);?>" target="_blank">View File</a>
</div>
<?php }
} ?>
</td>
</tr>
</div>  
</table>
</div>
</div>
 <!--review result table end --> 

<h3 class="h3final"><b><button type="button" class="btn btn-info btn-sm" data-toggle="button" id="finalbutt" data-more="#sh" aria-pressed="false" onClick="displayhidefinalconclu('finalconclusion')" style="font-size:8px;">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Final Conclusion</b></h3>


<div id="finalconclusion" style="display: none;">
<div class="table-responsive"> 
<table class="table table-bordered table-sm" id="finalconclutable"> 
<div class="row">  
<tr>
<td colspan="2" style="background-color: #0080FF;font-family:Poppins; font-size: medium;text-align: left;font-weight: 400;color: white;">Final Conclusion:
</td>
</tr>  

<tr>
    <td class="headcolor">Feasibility Conclusion</td>
    <td style="width:800px;">
    <?php 
    if($row['conclusion']=="Regularised")
    {
     echo'<span style="color:#007e33;font-size: 15px;font-weight: bold;"><b>'."Regularised" .'</b></span>';
    }
    else if($row['conclusion']=="Rejected")
    {
      echo'<span style="color:#cc0000;font-size: 15px;font-weight: bold;"><b>'."Rejected" .'</b></span>';
    } 
    else if($row['status']=="Not Feasible")
    {
      echo'<span style="color:#4b5f81;font-size: 15px;font-weight: bold;"><b>'."Not Feasible" .'</b></span>';
    } 
    else
    {
      echo"-";
    }
   ?>

  </td>    
 </tr> 
 <tr>
    <td class="headcolor">Conclusion Remarks</td>
  <td style="text-align: justify;" colspan="2"><?php 
      if($row['concluremark']=="")
       {
        echo"-";
       } 
       else{
        echo htmlspecialchars_decode($row['concluremark']);
       }
      ?></td>   
 </tr> 
 <tr>

    <td class="headcolor">Corrective Action</td>
    <td style="text-align: justify;" colspan="2"><?php 
      if($row['correctiveaction']=="")
       {
        echo"-";
       } 
       else{
        echo htmlspecialchars_decode($row['correctiveaction']);
       }
      ?></td>
</tr>

</div> 
</table>


<input type="text" id="formno" value="<?php echo htmlentities($row['id']);?>" style="display: none">         
</div>    
</div> 



<?php 
if($row['status']!="Regularised")
{ ?>
<div id="productack" style="display:none;">
</div>
<?php }
else if($row['status']=="Regularised")
{ ?>
<h3 class="h3final"><b><button type="button" class="btn btn-info btn-sm ackbutt" data-toggle="button" id="productackbutt" data-more="#sh" aria-pressed="false" onClick="displayhideproductack('productack')" style="font-size:8px;">
<i class="ti-plus" aria-hidden="true"></i>
<i class="ti-minus text-active" aria-hidden="true"></i>
</button> &nbsp;&nbsp;Product Acknowledgement</b></h3>

<div id="productack" style="display:none;">
<?php
$querydays10=mysql_query("select * from fsetting order by id desc limit 1");
while($rowdays10=mysql_fetch_array($querydays10)) 
{ 
$quadeptaut=$rowdays10['dept_authority'];
$splittedaut = explode(',',trim($quadeptaut));
$lastcomma = '';
foreach($splittedaut as $i=>$k) 
{
$lastcomma .= $k.',';
}
$lastcomma = rtrim($lastcomma,',');
$secarr1=explode(',',trim($lastcomma));


$rowid=$row['id'];
$queryag=mysql_query("select * from feasibility_agreementcpy where frfno='$rowid' order by id desc limit 1");
while($rowag=mysql_fetch_array($queryag)) 
{ 
$department_chk2=$rowag['dept_combine'];
$department_chk = explode(',',trim($department_chk2));
$deptchk = '';
foreach($department_chk as $i=>$k1) 
{
$deptchk .= $k1.',';
}
$deptchk = rtrim($deptchk,',');
$deptchk1=explode(',',trim($deptchk));


$ddd=array_diff($secarr1,$deptchk1);
}

?>

<?php 
if($row['status']=="Regularised")
{ ?>


<table class="table table-sm" style="border:none;">
<div class="row">
<tr>
<td style="border:none;">
<label style="color:black;font-size:14px;font-family:'Poppins',sans-serif;">This Feasibility has been acknowledged by these concerned Departments&nbsp;:&nbsp;</label>

<?php 
if(empty($deptchk1))
{ ?>
<label style="font-weight:800;color:black;font-size:14px;font-family:'Poppins',sans-serif;">None</label>
<?php }
else
{
?>
 <label style="font-weight:800;color:black;font-size:14px;font-family:'Poppins',sans-serif;"><?php echo implode(", ", $deptchk1); ?></label> 
 <?php } ?>
</td>
</tr>
<tr>
<td style="border:none;">

<?php 
if($deptchk1==$secarr1)
{ ?>
<!-- <label style="color:black;font-size:14px;font-family:'Poppins',sans-serif;"> Awaiting Acknowledgements from these concerned Departments&nbsp;:&nbsp;</label>
<label style="font-weight:800;color:black;font-size:14px;font-family:'Poppins',sans-serif;">None</label> -->
<?php }
else if(!empty($deptchk1))
{
?>
<label style="color:black;font-size:14px;font-family:'Poppins',sans-serif;"> Awaiting Acknowledgements from these concerned Departments&nbsp;:&nbsp;</label>
<label style="font-weight:800;color:black;font-size:14px;font-family:'Poppins',sans-serif;"><?php echo implode(", ", $ddd); ?></label>
<?php 
 }
else if(empty($deptchk1))
{ ?>
<label style="color:black;font-size:14px;font-family:'Poppins',sans-serif;"> Awaiting Acknowledgements from these concerned Departments&nbsp;:&nbsp;</label>
<label style="font-weight:800;color:black;font-size:14px;font-family:'Poppins',sans-serif;"><?php echo implode(", ", $secarr1); ?></label>
<?php } 
?>
</td>
</tr>
</div>
</table>



<!-- <div class="row" style="margin-left:22px;">
<div class="col-md-12">


</div>
</div>
<div class="row">
<div class="col-md-12">

</div>
</div> -->

<?php }  }?>

</div>
<?php } ?>



<br>
<div id="attachdiv" style="display:none;">
<table class="table table-sm">	
<tr>
<td style="font-weight:400;background-color:#A6A6A6;color:white;text-align:left" colspan="2">This report has below additional attachments</td>
</tr> 

<?php 
if($row['offer1']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">1st Quotation Offer</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['offer1']!="")
{
$file1= $row['offer1'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>
 
<?php 
if($row['offer2']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">2nd Quotation Offer</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['offer2']!="")
{
$file1= $row['offer2'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>
 

<?php 
if($row['offer3']!="")
{ ?> 
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;"> 3rd Quotation Offer</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['offer3']!="")
{
$file1= $row['offer3'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['uploadpo']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">PO for Sample</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['uploadpo']!="")
{
$file1= $row['uploadpo'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['uploadpo2']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">PO for Pilot</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['uploadpo2']!="")
{
$file1= $row['uploadpo2'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['uploadregret']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">Regret Letter</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['uploadregret']!="")
{
$file1= $row['uploadregret'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['inspecreport1']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">1st Sample Inspection Report</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['inspecreport1']!="")
{
$file1= $row['inspecreport1'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['inspecreport2']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">2nd Sample Inspection Report</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['inspecreport2']!="")
{
$file1= $row['inspecreport2'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

<?php 
if($row['inspecreport3']!="")
{ ?>
<tr>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">3rd Sample Inspection Report</td>
<td style="border:solid 1px #DDD;color:black;font-weight:normal;">
<?php 
if($row['inspecreport3']!="")
{
$file1= $row['inspecreport3'];
echo"$file1";
} 
else
{
echo"File Not Attached";
}  
?>
</td>
</tr> 
<?php } ?>

</table>
<label style="font-size:12px;font-family:'Poppins',sans-serif;color:black;font-weight:normal;">Note : Kindly print them seperately</label>
</div>





<?php 
//fetch authority of user session department 
$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept=$row11['authority'];

}

?>



<?php
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowaccess=mysql_fetch_array($queryacc)) 
{
$ecnarr=$rowaccess['feasibilityaccess'];
$ecnarr1=explode(',',trim( $ecnarr));

$secondaryarr1=$rowaccess['multidept'];
$secarr2=explode(',',trim($secondaryarr1));
//to remove last comma from multidept array
$lastcomma = '';
foreach($secarr2 as $i=>$k) 
{
$lastcomma .= $k.',';
}
$lastcomma = rtrim($lastcomma,',');
$secarr1=explode(',',trim($lastcomma));//users mutlidept array



$querydays1=mysql_query("select * from fsetting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 

$dept_copy=$rowdays1['dept_copy'];
$dept_copy1=explode(',',trim($dept_copy)); 
$result1 = array_intersect($secarr1,$dept_copy1);


//fetching fullforms of depts specified in settings
$department_chkk2=$rowdays1['dept_copy'];
$department_chkk = explode(',',trim($department_chkk2));
$deptchkk = '';
foreach($department_chkk as $i=>$kk1) 
{
$deptchkk .= $kk1.',';
}
$deptchkk = rtrim($deptchkk,',');
$deptchkk1=explode(',',trim($deptchkk));//full forms of depts specified in settings


$queryag=mysql_query("select * from feasibility_agreementcpy where frfno='".$_GET['cid']."' order by id desc limit 1");
while($rowag=mysql_fetch_array($queryag)) 
{ 
$department_chk2=$rowag['department_chk'];
$department_chk = explode(',',trim($department_chk2));
$deptchk = '';
foreach($department_chk as $i=>$k1) 
{
$deptchk .= $k1.',';
}
$deptchk = rtrim($deptchk,',');
$deptchk1=explode(',',trim($deptchk));//short forms of agreed depts


$dept_abbrivation2=$rowag['dept_abbrivation'];
$dept_abbrivation1 = explode(',',trim($dept_abbrivation2));
$dept_abbrivation = '';
foreach($dept_abbrivation1 as $i=>$k1) 
{
$dept_abbrivation .= $k1.',';
}
$dept_abbrivation = rtrim($dept_abbrivation,',');
$dept_abbrivations=explode(',',trim($dept_abbrivation));//combined array of approved depts-fullforms

}



if(in_array($rowaccess['department'],$secarr1))
{
$primarypush1=$secarr1;
}
else
{
$primarypush1=array_push($secarr1, $rowaccess['department']);
}


//common elements between fsetting and users depts
$intersect=array_intersect($secarr1, $deptchkk1);


//difference between approved depts and common elements from fsetting and users depts
$diff=array_diff($intersect, $dept_abbrivations);

$remainingcount=count($diff);


$queryde = mysql_query("SELECT * FROM feasibility_agreementcpy where frfno='".$_GET['cid']."' and department='".$_SESSION['department']."'");
$numberde=mysql_num_rows($queryde);

if($row['status']=="Regularised")
{ 
if((($result1!=array())||(in_array($rowaccess['department'],$dept_copy1))) && (in_array('feasibilityack',$ecnarr1)))
{ 

if(empty($deptchk1))
{ ?>
<div class="responsebutt">
<center>
<div class="row">
<div class="col-md-12" >
<h5>Do you Acknowledge to this Product Release ?</h5>
</div>
</div>
</center>
<center>
<div class="row">
<div class="col-md-12">
<a href="feasibility_deptcopy.php?cid=<?php echo $_GET['cid'];?>&uid=<?php echo htmlentities($_SESSION['id']);?>&dept=<?php echo htmlentities($dept);?>" class='li-modal'>
<button class="btn btn-primary">Submit my response here</button></a>
</div><div id="theModal" class="modal fade text-center">
<div class="modal-dialog">
<div class="modal-content">
</div>
</div>
</div>
</div>
</center>
</div>
<?php }
if(!empty($deptchk1)) 
{ 
	if($remainingcount==0)
	{ ?>
<div class="responsebutt">
<center>
<div class="row" >
<div class="col-md-12" >
<h5>Do you Acknowledge to this Product Release ?</h5>
</div>
</div>
</center>
<center>
<div class="row">
<div class="col-md-12">
<button class="btn" onclick="checkalreadyack();" style="background-color:grey;color:white;">Submit my response here</button><br><br>
</div>
</div>
</center>
</div>
<?php 	}
	else
	{ ?>
<div class="responsebutt">
<center>
<div class="row" >
<div class="col-md-12" >
<h5>Do you Acknowledge to this Product Release ?</h5>
</div>
</div>
</center>
<center>
<div class="row">
<div class="col-md-12">
<a href="feasibility_deptcopy.php?cid=<?php echo $_GET['cid'];?>&uid=<?php echo htmlentities($_SESSION['id']);?>&dept=<?php echo htmlentities($dept);?>" class='li-modal'>
<button class="btn btn-primary">Submit my response here</button></a>
</div><div id="theModal" class="modal fade text-center">
<div class="modal-dialog">
<div class="modal-content">
</div>
</div>
</div>
</div>
</center>
</div>
<?php } } ?>
<?php 
} //if access check
else
{ ?>
<div class="responsebutt">
<center>
<div class="row">
<div class="col-md-12">
<h5>Do you Acknowledge to this Product Release ?</h5>
</div>
</div>
</center>
<center>
<div class="row">
<div class="col-md-12">
<button class="btn" onclick="checkaccess();" style="background-color:grey;color:white;">Submit my response here</button><br><br>
</div>
</div>
</center>
</div>	
<?php }


} //if status is regularised
} 

} //while loop of users table
?>


<?php 
$setting=mysql_query("select * from fsetting");
while($rowset=mysql_fetch_array($setting))
{ 
?>
<hr style="background-color:lightgray">
<div class="row">
<label style="color:black;margin-left:15px;font-family:'Poppins',sans-serif"></label>&nbsp;<span style="color:black;font-weight:bold;font-family:'Poppins',sans-serif"><?php echo htmlspecialchars_decode($rowset['isonoreg']);?></span>
<label style="color:black;font-family:'Poppins',sans-serif">&nbsp;|&nbsp;Rev. No.</label>&nbsp;<span style="color:black;font-weight:bold;font-family:'Poppins',sans-serif"><?php echo htmlspecialchars_decode($rowset['isorevnoreg']);?></span>
</div>

<input type="text" id="isonoreg" value="<?php echo htmlspecialchars_decode($rowset['isonoreg']);?>" style="display: none">

<input type="text" id="isorevnoreg" value="<?php echo htmlspecialchars_decode($rowset['isorevnoreg']);?>" style="display: none">
<?php  } ?>


</div><!--div id="report" close -->

<?php } }?>
    
</div>
</div>
</div></div></div>



<?php 
include("includes/footer.php");
?>

<script src="jquery.min.js"></script>
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
<!-- <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> -->
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
<script src="assets/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="assets/dist/js/jquery.smartWizard.min.js"></script>
<!-- <script src="js/validation.js"></script> -->

<!-- check access for agreement copy button-->
<script>
function checkaccess() {
event.preventDefault();
setTimeout(function() {
swal({  
title: "Not Allowed",
text: "You Do not have access to Acknowledge to this Product Release",
type:"error"

}, 
function() 
{
window.location = "feasibilityview.php";
});
},);
};
</script>


<script>
function checkalreadyack() {
event.preventDefault();
setTimeout(function() {
swal({  
title: "Not Allowed",
text: "Concerned Department has Already Aknowledged for this Product Release",
type:"error"

}, 
function() 
{
window.location = "feasibilityview.php";
});
},);
};
</script>

<script>
$('.li-modal').on('click', function(e){
  e.preventDefault();
  $('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
});
</script>

<script type="text/javascript">
function displayregretmsg()
{
setTimeout(function() {
swal({  
  title: "Editing Prohibited",
  text: "This Feasibility has already been Regretted \n You cannot edit this Feasibility",
  type:"error"
  
}, 
function() 
{
  window.location = "feasibilityview.php";
});
},);

}

</script>

<script type="text/javascript">
function displaymsg()
{
setTimeout(function() {
swal({  
  title: "Editing Prohibited",
  text: "This Feasibility has already been Regularised \n You cannot edit this Feasibility",
  type:"error"
  
}, 
function() 
{
  window.location = "feasibilityview.php";
});
},);

}

</script>

<!-- Minimize or expand final conclusion block-->


<script type="text/javascript">
function displayhideregistration(ele6) {

var srcElement = document.getElementById(ele6);


if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
     document.getElementById("regbutt").innerHTML = '<i class="ti-plus"></i>';

}
else {
srcElement.style.display = 'block';
document.getElementById("regbutt").innerHTML = '<i class="ti-minus"></i>';
}
return false;
}
}
</script>

<!--Minimize/expand requirement review block --> 
<script type="text/javascript">
function reqreview(ele2) {
var srcElement = document.getElementById(ele2);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("reviewbutt").innerHTML = '<i class="ti-plus"></i>';
}
else {
srcElement.style.display = 'block';
document.getElementById("reviewbutt").innerHTML = '<i class="ti-minus"></i>';
}
return false;
}
}
</script>

<!--Minimize or expand review result -->
<script type="text/javascript">
function displayhidereviewresult(ele3) {
var srcElement = document.getElementById(ele3);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("resultbutt").innerHTML = '<i class="ti-plus"></i>';
}
else {
srcElement.style.display = 'block';
document.getElementById("resultbutt").innerHTML = '<i class="ti-minus"></i>';   

}
return false;
}
}
</script>
<script type="text/javascript">
function displayhidesampledevp2(ele6) {
var srcElement = document.getElementById(ele6);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("samplebutt").innerHTML = '<i class="ti-plus"></i>';   
}
else {
srcElement.style.display = 'block';
document.getElementById("samplebutt").innerHTML = '<i class="ti-minus"></i>';
}
return false;
}
}
</script>
<!-- Minimize or expand final conclusion block-->
<script type="text/javascript">
function displayhidefinalconclu(ele5) {
var srcElement = document.getElementById(ele5);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("finalbutt").innerHTML = '<i class="ti-plus"></i>';    
}
else {
srcElement.style.display = 'block';
document.getElementById("finalbutt").innerHTML = '<i class="ti-minus"></i>'; 
}
return false;
}
}
</script>


<!-- Minimize or expand product acknowledgement block-->
<script type="text/javascript">
function displayhideproductack(ele12) {
var srcElement = document.getElementById(ele12);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("productackbutt").innerHTML = '<i class="ti-plus"></i>';    
}
else {
srcElement.style.display = 'block';
document.getElementById("productackbutt").innerHTML = '<i class="ti-minus"></i>'; 
}
return false;
}
}
</script>

<script type="text/javascript">
function displayhidedevtracker(ele8) {
var srcElement = document.getElementById(ele8);

if (srcElement != null) {
if (srcElement.style.display == "block") {
srcElement.style.display = 'none';
document.getElementById("trackerbutt").innerHTML = '<i class="ti-plus"></i>';    
}
else {
srcElement.style.display = 'block';
document.getElementById("trackerbutt").innerHTML = '<i class="ti-minus"></i>'; 
}
return false;
}
}
</script>
<!-- scripts to minimize and expand each requirement block -->
<script type="text/javascript">
$(function() {
$('tr.parent td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent2 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent3 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent4 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent5 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent6 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>

<script type="text/javascript">
$(function() {
$('tr.parent10 td button.btn')
.on("click", function(){
var idOfParent = $(this).parents('tr').attr('id');
$('tr.child-'+idOfParent).toggle('slow');
});
$('tr[class^=child-]').hide().children('td');
});
</script>
<!-- scripts to minimize and expand each requirement block end -->

<script type="text/javascript">
$('#product td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>

<script type="text/javascript">
$('#standard td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>

<script type="text/javascript">
$('#commercial td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>

<script type="text/javascript">
$('#delivery td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>

<script type="text/javascript">
$('#anotherspereq td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>

<script type="text/javascript">
$('#drawing td button').click(function(){
// $(this).next('ul').slideToggle('500');
$(this).find('i').toggleClass('ti-plus ti-minus')
});
</script>


<script>
$('#reportprint').click(function(){
var children = $('#report tr.child').length;
var visibleChildren = $('#report tr.child:visible').length;

var style = "<style>";
style = style + "table {width: 100%;font-size: 12px;font-family:'Poppins', sans-serif;}";
style = style + "th.firstcol {display: none;}";
style = style + "td.firstcol {display: none;}";
// style = style + "td.quoteletter {display: none;}";
// style = style + "td.regretletter {display: none;}";
style = style + "div.responsebutt{ display:none;}";
style = style + "div.viewfile{ display:none;}";
style = style + "button.ackbutt{ display:none;}";
style = style + "#timelinetable th{border:1px solid black;}";
style = style + "#timelinetable td{border:1px solid black;}";

style = style + ".h3reg,.h3timeline,.h3reqreview,.h3result,.h3sample,.h3final{font-family: 'Poppins', sans-serif;}";

style = style + "table, th, td {border:1px solid lightgray;border-collapse:collapse;font-size: 12px;padding:2px 3px;font-family:'Poppins',sans-serif;}";

style = style + "td.headcolor{background-color:87CEEB;}";

style = style + "th.headtable{color:white;font-weight: 550;font-size: 13px;text-align:center;background-color:#0080FF;}";

style = style + "</style>";

var formno = document.getElementById("formno").value;
var isonoreg = document.getElementById("isonoreg").value;
var isorevnoreg = document.getElementById("isorevnoreg").value;

var registration = document.getElementById("registration");
registration.style.display = "block";

var requirementreview = document.getElementById("requirementreview");
requirementreview.style.display = "block";

var devptracker = document.getElementById("devptracker");
devptracker.style.display = "block";

var reviewresult = document.getElementById("reviewresult");
reviewresult.style.display = "block";

var finalconclusion = document.getElementById("finalconclusion");
finalconclusion.style.display = "block";

var sampledevp = document.getElementById("sampledevp2");
sampledevp.style.display = "block";

var trackerbutt = document.getElementById("trackerbutt");
trackerbutt.style.display = "none";

var a2 = document.getElementById("regbutt");
a2.style.display = "none";

var a22 = document.getElementById("reviewbutt");
a22.style.display = "none";

var a3 = document.getElementById("resultbutt");
a3.style.display = "none";

var a5 = document.getElementById("finalbutt");
a5.style.display = "none";

var a6 = document.getElementById("samplebutt");
a6.style.display = "none";

var samplelet1 = document.getElementById("samplelet1");
samplelet1.style.display = "block";

var samplelet2 = document.getElementById("samplelet2");
samplelet2.style.display = "block";

var samplelet3 = document.getElementById("samplelet3");
samplelet3.style.display = "block";

var quotelet1 = document.getElementById("quotelet1");
quotelet1.style.display = "block";

var quotelet2 = document.getElementById("quotelet2");
quotelet2.style.display = "block";

var quotelet3 = document.getElementById("quotelet3");
quotelet3.style.display = "block";

var uploadpolet1 = document.getElementById("uploadpolet1");
uploadpolet1.style.display = "block";

var uploadpolet2 = document.getElementById("uploadpolet2");
uploadpolet2.style.display = "block";

var regretlet = document.getElementById("regretlet");
regretlet.style.display = "block";

var attachdiv = document.getElementById("attachdiv");
attachdiv.style.display = "block";

var productack = document.getElementById("productack");
productack.style.display = "block";

$('#report tr.child-product').show();
$('#report tr.child-standard').show();
$('#report tr.child-commercial').show();
$('#report tr.child-delivery').show();
$('#report tr.child-anotherspereq').show();
$('#report tr.child-drawing').show();
$('#report tr.child-blockg').show();

$('#report tr.suppdoc').hide();

var divToPrint=document.getElementById("report");
var win = window.open('', '', 'height=900,width=1200');

//var trpopcountry = document.getElementById("files");
//trpopcountry.style.display = "none";

// win.document.write('<html><head><title>my div</title>');
win.document.write('<html><head>');
// win.document.write('<img src="OTlogo.png" height:"150px" width:"150px"></img>');
win.document.write('<title> Feasibility_Review_Form_No.'+'_'+formno+'</title>');  // <title> FOR PDF HEADER.

win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
win.document.write('</head>');
win.document.write('<body>');
win.document.write(divToPrint.outerHTML);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
//    console.log(am.title);
win.document.write('<h5 style="font-family:Poppins,sans-serif;"><center> ---------- END OF REPORT ---------- </center></h5>');
win.document.write('</body></html>');

win.print(); // PRINT THE CONTENTS.

win.close();   // CLOSE THE CURRENT WINDOW.
location.reload();

//newWin= window.open("");
// newWin.document.write(divToPrint.outerHTML);
//newWin.print();
// newWin.close();
$('#report tr.child').hide(); 
});
</script>

<!-- -->
<script type="text/javascript">
$(document).ready(function(){
// Toolbar extra buttons
var btnFinish = $('<button></button>').text('Finish')
.addClass('btn btn-info')
.on('click', function(){ alert('Finish Clicked'); });
var btnCancel = $('<button></button>').text('Cancel')
.addClass('btn btn-danger')
.on('click', function(){ $('#smartwizard').smartWizard("reset"); });

// Smart Wizard
$('#smartwizard').smartWizard({
selected: 0,
theme: 'arrows',
transitionEffect:'fade',
toolbarSettings: {toolbarPosition: 'bottom',
toolbarExtraButtons: [btnFinish, btnCancel]
}
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

// Toolbar extra buttons
var btnFinish = $('<button></button>').text('Finish')
.addClass('btn btn-info')
.on('click', function(){ alert('Finish Clicked'); });
var btnCancel = $('<button></button>').text('Cancel')
.addClass('btn btn-danger')
.on('click', function(){ $('#smartwizard').smartWizard("reset"); });

// Smart Wizard
$('#smartwizard1').smartWizard({
selected: 1,
theme: 'arrows',
transitionEffect:'fade',
toolbarSettings: {toolbarPosition: 'bottom',
toolbarExtraButtons: [btnFinish, btnCancel]
}
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

// Toolbar extra buttons
var btnFinish = $('<button></button>').text('Finish')
.addClass('btn btn-info')
.on('click', function(){ alert('Finish Clicked'); });
var btnCancel = $('<button></button>').text('Cancel')
.addClass('btn btn-danger')
.on('click', function(){ $('#smartwizard').smartWizard("reset"); });

// Smart Wizard
$('#smartwizard2').smartWizard({
selected: 2,
theme: 'arrows',
transitionEffect:'fade',
toolbarSettings: {toolbarPosition: 'bottom',
toolbarExtraButtons: [btnFinish, btnCancel]
}
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){

// Toolbar extra buttons
var btnFinish = $('<button></button>').text('Finish')
.addClass('btn btn-info')
.on('click', function(){ alert('Finish Clicked'); });
var btnCancel = $('<button></button>').text('Cancel')
.addClass('btn btn-danger')
.on('click', function(){ $('#smartwizard').smartWizard("reset"); });

// Smart Wizard
$('#smartwizard3').smartWizard({
selected: 3,
theme: 'arrows',
transitionEffect:'fade',
toolbarSettings: {toolbarPosition: 'bottom',
toolbarExtraButtons: [btnFinish, btnCancel]
}
});
});
</script>

<script>
$(document).on('click', '#refresh', function () {
var $link = $('li.active a[data-toggle="tab"]');
$link.parent().removeClass('active');
var tabLink = $link.attr('href');
$('#mainTabs a[href="' + tabLink + '"]').tab('show');
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function () {
$('.show-time').html(new Date().toLocaleTimeString());
});</script>
<script>
function myFunction() {
location.reload();
}
</script>
<link rel="stylesheet" href="assets/plugins/html5-editor/bootstrap-wysihtml5.css" >
<script>
function myFunction1() {
swal("We are Sorry...!!!", "Only concerened Department can perform action here.","warning")
}
</script>

<script src="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css"></script>

</body>
</html>


