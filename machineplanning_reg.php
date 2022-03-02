<?php 
// error_reporting(E_ERROR | E_PARSE);
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
// machine plan details
if(isset($_POST['insert_rowfeb']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");
//$monfeb_val=$_POST['monfeb_val'];
$yrfeb_val=$_POST['yrfeb_val'];
//$codefeb_val=$_POST['codefeb_val'];
//$macidfeb_val=$_POST['macidfeb_val'];
$mcplanidfeb_val=$_POST['mcplanidfeb_val'];
$wrkdy2feb_val=$_POST['wrkdy2feb_val'];
$sftfeb_val=$_POST['sftfeb_val'];

if(($sftfeb_val>=0)&&($sftfeb_val<=3))
{
$sqlw=mysql_query("update machineplan set workdys_feb='$wrkdy2feb_val' where planyear='$yrfeb_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yrfeb_val',feb='$sftfeb_val' where id='$mcplanidfeb_val'");
echo mysql_insert_id();
exit();
}
else
{

}

}
?>

<!--MARCH -->
<?php
if(isset($_POST['insert_rowmar']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_marval=$_POST['wrkdy_marval'];
$sft_marval=$_POST['sft_marval'];

if(($sft_marval>=0)&&($sft_marval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_mar='$wrkdy_marval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',mar='$sft_marval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{

}

}
?>

<!--APRIL -->
<?php
if(isset($_POST['insert_rowapr']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_aprval=$_POST['wrkdy_aprval'];
$sft_aprval=$_POST['sft_aprval'];

if(($sft_aprval>=0)&&($sft_aprval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_apr='$wrkdy_aprval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',apr='$sft_aprval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!-- MAY -->
<?php
if(isset($_POST['insert_rowmay']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_mayval=$_POST['wrkdy_mayval'];
$sft_mayval=$_POST['sft_mayval'];

if(($sft_mayval>=0)&&($sft_mayval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_may='$wrkdy_mayval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',may='$sft_mayval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--JUNE -->
<?php
if(isset($_POST['insert_rowjune']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_juneval=$_POST['wrkdy_juneval'];
$sft_juneval=$_POST['sft_juneval'];

if(($sft_juneval>=0)&&($sft_juneval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_june='$wrkdy_juneval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',jun='$sft_juneval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--JULY -->
<?php
if(isset($_POST['insert_rowjuly']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_julyval=$_POST['wrkdy_julyval'];
$sft_julyval=$_POST['sft_julyval'];

if(($sft_julyval>=0)&&($sft_julyval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_july='$wrkdy_julyval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',jul='$sft_julyval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--AUGUST -->
<?php
if(isset($_POST['insert_rowaug']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_augval=$_POST['wrkdy_augval'];
$sft_augval=$_POST['sft_augval'];

if(($sft_augval>=0)&&($sft_augval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_aug='$wrkdy_augval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',aug='$sft_augval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--SEPTEMBER -->
<?php
if(isset($_POST['insert_rowsep']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_sepval=$_POST['wrkdy_sepval'];
$sft_sepval=$_POST['sft_sepval'];

if(($sft_sepval>=0)&&($sft_sepval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_sep='$wrkdy_sepval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',sep='$sft_sepval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>


<!--OCTOBER -->
<?php
if(isset($_POST['insert_rowoct']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_octval=$_POST['wrkdy_octval'];
$sft_octval=$_POST['sft_octval'];

if(($sft_octval>=0)&&($sft_octval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_oct='$wrkdy_octval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',oct='$sft_octval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--NOVEMBER -->
<?php
if(isset($_POST['insert_rownov']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_novval=$_POST['wrkdy_novval'];
$sft_novval=$_POST['sft_novval'];

if(($sft_novval>=0)&&($sft_novval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_nov='$wrkdy_novval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',nov='$sft_novval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>

<!--DECEMBER -->
<?php
if(isset($_POST['insert_rowdec']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$yr_val=$_POST['yr_val'];
$mcplanid_val=$_POST['mcplanid_val'];
$wrkdy_decval=$_POST['wrkdy_decval'];
$sft_decval=$_POST['sft_decval'];

if(($sft_decval>=0)&&($sft_decval<=3))
{
$sqlw=mysql_query("update machineplan set workdys_dec='$wrkdy_decval' where planyear='$yr_val'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr_val',decc='$sft_decval' where id='$mcplanid_val'");
echo mysql_insert_id();
exit();
}
else
{
	
}

}
?>



<?php
if(isset($_POST['submitmc']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");

$wrkdy1=$_POST['wrkdy1'];
$sundaypdn=$_POST['sundaypdn'];

$wrkdy2feb=$_POST['wrkdy2feb'];
$sundaypdnfeb=$_POST['sundaypdnfeb'];

$wrkdy_mar=$_POST['wrkdy_mar'];
$sundaypdn_mar=$_POST['sundaypdn_mar'];

$wrkdy_apr=$_POST['wrkdy_apr'];
$sundaypdn_apr=$_POST['sundaypdn_apr'];

$wrkdy_may=$_POST['wrkdy_may'];
$sundaypdn_may=$_POST['sundaypdn_may'];

$wrkdy_june=$_POST['wrkdy_june'];
$sundaypdn_june=$_POST['sundaypdn_june'];

$wrkdy_july=$_POST['wrkdy_july'];
$sundaypdn_july=$_POST['sundaypdn_july'];

$wrkdy_aug=$_POST['wrkdy_aug'];
$sundaypdn_aug=$_POST['sundaypdn_aug'];

$wrkdy_sep=$_POST['wrkdy_sep'];
$sundaypdn_sep=$_POST['sundaypdn_sep'];

$wrkdy_oct=$_POST['wrkdy_oct'];
$sundaypdn_oct=$_POST['sundaypdn_oct'];

$wrkdy_nov=$_POST['wrkdy_nov'];
$sundaypdn_nov=$_POST['sundaypdn_nov'];

$wrkdy_dec=$_POST['wrkdy_dec'];
$sundaypdn_dec=$_POST['sundaypdn_dec'];

if($wrkdy1!="")
{
if($sundaypdn=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for January. \n Enter 0, if any machine is not being planned/considered for January",
type: "error"   
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy2feb!="")
{
if($sundaypdnfeb=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for February. \n Enter 0, if any machine is not being planned/considered for February",
type: "error"  
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_mar!="")
{
if($sundaypdn_mar=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for March. \n Enter 0, if any machine is not being planned/considered for March",
type: "error"   
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_apr!="")
{
if($sundaypdn_apr=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for April. \n Enter 0, if any machine is not being planned/considered for April",
type: "error"  
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_may!="")
{
if($sundaypdn_may=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for May. \n Enter 0, if any machine is not being planned/considered for May",
type: "error"  
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_june!="")
{
if($sundaypdn_june=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for June. \n Enter 0, if any machine is not being planned/considered for June",
type: "error"   
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_july!="")
{
if($sundaypdn_july=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for July. \n Enter 0, if any machine is not being planned/considered for July",
type: "error"  
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}


if($wrkdy_aug!="")
{
if($sundaypdn_aug=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for August. \n Enter 0, if any machine is not being planned/considered for August",
type: "error"  
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_sep!="")
{
if($sundaypdn_sep=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for September. \n Enter 0, if any machine is not being planned/considered for September",
type: "error"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_oct!="")
{
if($sundaypdn_oct=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for October. \n Enter 0, if any machine is not being planned/considered for October",
type: "error"   
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_nov!="")
{
if($sundaypdn_nov=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for November. \n Enter 0, if any machine is not being planned/considered for November",
type: "error"   
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}

if($wrkdy_dec!="")
{
if($sundaypdn_dec=="")
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Incomplete Planning",
text: "Looks like one or more machine plan entries are blank for December. \n Enter 0, if any machine is not being planned/considered for December",
type: "error"     
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";

});
}, 1000);
</script>';
}
else
{
echo '<script>        
setTimeout(function() {
swal({  
title: "Success!",
text: "Machine Planning saved successfully.",
type: "success"    
}, 
function() 
{
window.location = "machineplanning_reg.php?year="+"'.$_GET['year'].'";
});
}, 1000);
</script>';
}
}


}//isset end
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
<title>ESM | Machine Planning</title>
<link rel="stylesheet" href="main/js/jquery-ui.css">
<script src="main/js/jquery-1.12.4.js"></script>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/plugins/html5-editor/bootstrap-wysihtml5.css" >
<!-- This page css -->
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/switchery/dist/switchery.min.css"rel="stylesheet" />
<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="assets/datatables/jquery.dataTables.yadcf.css" rel="stylesheet" type="text/css" />
<link href="main/css/style.css" rel="stylesheet">
<link href="main/css/colors/blue.css" id="theme" rel="stylesheet">
<!--  <link href="assets/plugins/sweetalert/sweetalert.css">-->
<link href="sweetalert.css" rel="stylesheet" />
<script src="sweetalert.min.js"></script>
<link href="assets/plugins/wizard/steps.css">
<script src="jquery.min.js"></script>

<style type="text/css">
.btn {
padding: 0px 20px;
}



/*css for input field to display line*/
input[type=number]:not(.browser-default) {
background-color: transparent;
border: none;
border-bottom: 1px solid #9e9e9e;
outline: none;
width:100px;
font-size: 12px;
text-align:center;
}

/* Custom Swal buttons for operator data entry deletion: Are You Sure, You want to delete entry */
.sweet-alert[data-custom-class="mycustomclass"] button.confirm {
color: white;
background-color: green;
}
.sweet-alert.mycustomclass button.cancel {
color: white;
background-color: red;
}
</style>

<style type="text/css">

   .tableFixHead { overflow-y: auto; height: 200px; }
   

    #customers td, #customers th {
      border:1px solid #C0C0C0;
      font-size:10px;
      vertical-align:middle;
      text-align: center;
    }

    #customers th {
      text-align: center;
      background-color: #0080ff;
      color: white;
      font-size:10px;
      vertical-align:middle;
      border:1px solid #C0C0C0;

    }
</style>




</head>

<body class="fix-header fix-sidebar card-no-border">
<div id="main-wrapper" class="scrollmenu" style="font-size:small">
<?php include("includes/config.php");

?>
<?php include("includes/header.php");?> 
<?php include("includes/sidebar.php");?>
<div class="page-wrapper" >
<div class="row page-titles m-b-0 " style="height:45px">
<div class="col-md-5 align-self-center">
<h4 class="text-themecolor" >IMTE Calender</h4>
</div>
<div class="col-md-7 align-self-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
<li class="breadcrumb-item"><a href="machineplan_monthreg.php">IMTE Calender</a></li>

</ol>
</div> 
</div>
<br>
<!--  playcards-->
<!-- <div class=row>
<div class="col-md-2">
<div class="card card-inverse card-info"  style="height: 110px;background-color:#009688;width:200px;margin-left: 30px">
<div class="card-body">
<div id="myCarouse3" class="carousel slide" data-ride="carousel">

<div class="carousel-inner">
<div class="row">
<div class="col-12">
<h3  style="font-weight:400;color:white"><span style="font-size: 25px;"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;&nbsp;<?php echo "2";?>&nbsp;</span></h3> 
</div>

<div class="col-12">
<span class="card-subtitle" style="font-size:15px;color:white">&nbsp;Total Machine</span>
</div>
<div class="col-12" style="margin-top:3px">
<div class="card-subtitle"style="font-size:12px">
<span style="font-weight:500;font-size:14px"></span>&nbsp; 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
element.style {
    margin-top: 30px;
}

<div class="col-md-2">
<div class="card card-inverse card-info"  style="height: 110px;background-color:#009688;width:200px;margin-left: 30px">
<div class="card-body">
<div id="myCarouse3" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<div class="row">
<div class="col-12">
<h3  style="font-weight:400;color:white"><span style="font-size: 25px;"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;&nbsp;<?php echo "2";?>&nbsp;</span></h3> 
</div>

<div class="col-12">
<span class="card-subtitle" style="font-size:15px;color:white">&nbsp;Total Machine</span>
</div>
<div class="col-12" style="margin-top:3px">
<div class="card-subtitle"style="font-size:12px">
<span style="font-weight:500;font-size:14px"></span>&nbsp; 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> -->
<!-- end -->
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<!-- Nav tabs -->
<?php $queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<ul class="nav nav-tabs" role="tablist">

<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['breakdownaccess'];
$comarr1=explode(',',trim( $complaintarr1));
$secondaryarr1=$row21['multidept'];
$secarr1=explode(',',trim($secondaryarr1));
$querydays1=mysql_query("select * from breakdown_days order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['reg_fdept'];
$qua1=explode(',',trim($quadept1));

if(((in_array($rowdays1['reg_fdept'],$secarr1)) || (in_array($row21['department'],$qua1))) && (in_array('regbreak',$comarr1)))
{   ?>
<?php 
$breakarr=$rowacc['breakdownaccess'];
$comarr=explode(',',trim( $breakarr));
if(in_array('regbreak',$comarr))
{  ?>

<?php $query1=mysql_query("select * from master order by id desc limit 1");
while($row1=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i");
if($row1['licend']<= $dt3) 
{
?>

<?php } 
else
{ ?>


<?php } 
} ?>

<?php
}
?>
<?php } } } ?>
<li class="nav-item"><a class="nav-link active "  href="machineplanning_reg.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span><span class="hidden-xs-down">IMTE Calender</span></a></li>
<!--  <li class="nav-item"><a class="nav-link" href="machineplan_view.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span><span class="hidden-xs-down">Machine-Log Summary</span></a></li> -->
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel"> 
<!-- division for operator list--> 
<div class="p-20">
<div class="row">


<div class="col-sm-2" style="margin-left: 580px" >
<a id="reportprint3" target="_blank"><button type="submit" class="btn btn-default btn-outline" ><span class="text-muted"><i class="fa fa-print"></i>&nbsp;Print</span></button></a>
</div>
<div class="col-md-3">
<div  style="color:blue;font-size:small;">
<!-- <button type="submit" class="btn btn-default btn-outline"><a href="machineplan_monthreg.php"><span class="text-muted"><i class="fa fa-reply"></i>&nbsp;Back</span></a></button> -->
<label for="firstName1" style="color:blue;font-size:small;">Date : </label>
<?php
echo " " . date("d-m-Y");
?> 
</div>


</div>

<!--monthly machine planner table start-->  
<div class="container"> 

<form method="post" enctype="multipart/form-data" name="submitdata">


<!-- <div class="col-md-4">
<label style="font-size:15px">Select Month/Year&nbsp;<span style="font-size:medium;color:red">*</span></label>
<input type="text" id="DigitalBush" class="form-control-sm digital-bush" style="width:90px;margin-left:10px" placeholder="yyyy"  name="monthcalendar" required="true" readonly>
<span id="error" style="margin-left:120px;"></span>
</div> -->







<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Select Year</label>
<select class="form-control" id="DigitalBush" name="monthcalendar" onclick="planyear1()">
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
<div class="col-md-2" style="margin-top:30px;">
<div class="form-group" >
<label></label>
 <input type="submit" class="btn btn-primary" name="machineadd" value="GO" onclick="return getyear()" >
</div>
</div>




</div>





<!--to get the 5th day of every month start -->

<!-- <?php 
$fr=8;
$currentdate=date('Y-m-d');
$datejan1 = mktime(0,0,0, date('01'), $fr, date('Y'));
$datejan= date('Y-m-d', strtotime('+0 month ', $datejan1));
echo $datejan."sss";
?>
<br> -->

<?php 
$currentdate=date('Y-m-d');
$datejan1 = mktime(0,0,0, date('01'), 5, date('Y'));
$datejan= date('Y-m-d', strtotime('+0 month ', $datejan1));
//echo $datejan;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datefeb1 = mktime(0,0,0, date('02'), 5, date('Y'));
$datefeb= date('Y-m-d', strtotime('+0 month ', $datefeb1));
//echo $datefeb;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datemar1 = mktime(0,0,0, date('03'), 5, date('Y'));
$datemar= date('Y-m-d', strtotime('+0 month ', $datemar1));
//echo $datemar;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$dateapr1 = mktime(0,0,0, date('04'), 5, date('Y'));
$dateapr= date('Y-m-d', strtotime('+0 month ', $dateapr1));
//echo $dateapr;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datemay1 = mktime(0,0,0, date('05'), 5, date('Y'));
$datemay= date('Y-m-d', strtotime('+0 month ', $datemay1));
//echo $datemay;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datejun1 = mktime(0,0,0, date('06'), 5, date('Y'));
$datejun= date('Y-m-d', strtotime('+0 month ', $datejun1));
//echo $datejun;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datejul1 = mktime(0,0,0, date('07'), 5, date('Y'));
$datejul= date('Y-m-d', strtotime('+0 month ', $datejul1));
//echo $datejul;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$dateaug1 = mktime(0,0,0, date('08'), 5, date('Y'));
$dateaug= date('Y-m-d', strtotime('+0 month ', $dateaug1));
//echo $dateaug;
?>
<!-- <br> -->
<?php 
$currentdate=date('Y-m-d');
$datesep1 = mktime(0,0,0, date('09'), 5, date('Y'));
$datesep= date('Y-m-d', strtotime('+0 month ', $datesep1));
//echo $datesep;
?>
<!-- <br> -->
<?php 
$date4=date('Y-m-d');
$date = mktime(0,0,0, date('10'), 5, date('Y'));
$date2oc= date('Y-m-d', strtotime('+0 month ', $date));
//echo $date2oc;
?>
<!-- <br> -->
<?php 
$date4=date('Y-m-d');
$datenov1 = mktime(0,0,0, date('11'), 5, date('Y'));
$datenov= date('Y-m-d', strtotime('+0 month ', $datenov1));
//echo $datenov;
?>
<!-- <br> -->
<?php 
$date4=date('Y-m-d');
$datedec1 = mktime(0,0,0, date('12'), 5, date('Y'));
$datedec= date('Y-m-d', strtotime('+0 month ', $datedec1));
//echo $datedec;
?>
<!--to get the 5th day of every month end -->






<div id="printreport"> 

<div>
<div class="row">
<div class="col-md-7">
<h4 style="font-family: Poppins; font-weight: 500; color: black ">
CALIBRATION PLAN FOR YEAR:&nbsp;&nbsp;<input type="text" name="field2" id="field2" style="border: none"></h4>
</div>

</div>


<!-- <div class="col-md-1"></div> -->	
<div class="row" style="margin-left:400px;">
<!-- <div class="col-md-7">	 -->
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
<!-- </div> -->
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

<tr>
<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>

<th>P</th>
<th>A</th>
<th>S</th>
</tr>
</thead>

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



<!-- color code in jan -->
<?php
if(($row['janp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['jana'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['jans'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in Feb-->
<?php
if(($row['febp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['feba'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['febs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td style="background-color: red"></td>
	<?php
}?>

<!-- color code in Mar -->
<?php
if(($row['marp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['mara'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['mars'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<!-- color code in Apr -->
<?php
if(($row['aprp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['apra'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['aprs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in May -->
<?php
if(($row['mayp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['maya'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['mays'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in jun -->
<?php
if(($row['junp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['juna'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['juns'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in jul -->
<?php
if(($row['julp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['jula'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['juls'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in Aug -->
<?php
if(($row['augp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['auga'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['augs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<!-- color code in sep -->
<?php
if(($row['sepp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['sepa'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['seps'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in oct -->
<?php
if(($row['octp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['octa'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['octs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in nov -->
<?php
if(($row['novp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['nova'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['novs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>

<!-- color code in dec -->
<?php
if(($row['decp'])=='1')
{
?>
<td style="background-color:orange"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<?php
if(($row['deca'])=='1')
{
?>
<td style="background-color:yellow"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>
	
<?php
if(($row['decs'])=='1')
{
?>
<td style="background-color:green"></td>
<?php
} else{
	?>
	<td></td>
	<?php
}?>


<td></td>
<td></td>




 

</tr>

<?php }}}}  ?>

</table>



</div>

</div>
</div>


</form> 
</div>





</div><!--  monthlyplanner container end -->

</div> 
</div> <!--p-20 container end -->
</div><!-- /tab-pane -->
</div> <!-- /content-panel -->
</div><!-- /col-lg-4 -->     
</div><!-- /row -->       
</div>

<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" ></script>      
<script src="assets/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="main/js/custom.min.js"></script> 
<script src="main/js/jquery.slimscroll.js"></script>
<script src="main/js/waves.js"></script>
<script src="main/js/sidebarmenu.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date picker plugins css -->
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />


<!-- for shift entries ...alowing only 1 digit after decimal point-->
<script type="text/javascript">
function validateFloatKeyPress(el, evt) {
var charCode = (evt.which) ? evt.which : event.keyCode;
var number = el.value.split('.');
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
//just one dot
if(number.length>1 && charCode == 46){
return false;
}
//get the carat position
var caratPos = getSelectionStart(el);
var dotPos = el.value.indexOf(".");
if( caratPos > dotPos && dotPos>-1 && (number[1].length > 0)){
return false;
}
return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
if (o.createTextRange) {
var r = document.selection.createRange().duplicate()
r.moveEnd('character', o.value.length)
if (r.text == '') return o.value.length
return o.value.lastIndexOf(r.text)
} else return o.selectionStart
}
</script>


<!-- script for month/year field-->
<script type="text/javascript">
$('.digital-bush').datepicker({
autoclose: true,
todayHighlight: true,
orientation: "bottom",
minViewMode: 1,
format: 'yyyy'
});
</script>

<script type="text/javascript">
var $th = $('.tableFixHead').find('thead th')
$('.tableFixHead').on('scroll', function() {
  $th.css('transform', 'translateY('+ this.scrollTop +'px)');
});
</script>
<!-- <script type="text/javascript">
$(document).ready(function(){           
$('input.checksumoct').change(function(){   
if(($(this).val()>=0)&&($(this).val()<=1))
{

$('td.tdoct').css('background-color', 'orange');
	
// $('td.tdjan:first').css('background-color', 'orange');
}
// if(($(this).val()>=1.1)&&($(this).val()<=1.9))
// {
// $('td.tdjan').css('background-color', 'orange');
// }
});
});
</script> -->




<!-- only print -->
<script>
$('#reportprint3').click(function(){

var children = $('#printreport tr.child').length;
var visibleChildren = $('#printreport tr.child:visible').length;

var style = "<style>";
style = style + "footer {page-break-after: always;}";

// style = style + ".header{position:fixed;z-index:1;left:0;right:0;top:0;background-color:lightgray;}";
// style = style + "#cusdetails3{margin-top:300px;overflow:visible;}";

style = style + "table {font-family:'Poppins',sans-serif;}";
style = style + "label {color:black;font-weight:550;font-size:12px;display:inline;}";

style = style + "#customers td, #customers th {border:1px solid #C0C0C0;font-size:10px;vertical-align:middle;text-align:center;}";

style = style + "#customers th {text-align:center;background-color: #0080ff;color:white;font-size:10px;vertical-align:middle;border:1px solid #C0C0C0;}";
style = style + "input.checksum{ border:none;text-align:center;}";
style = style + "input.workdyclass{ border:none;text-align:center;}";
style = style + "table, th, td {border-collapse:collapse;padding:2px 3px;}";
style = style + "</style>";



var divToPrint=document.getElementById("printreport");
var win = window.open('', '', 'height=900,width=1200');
win.document.write('<html><head>');
win.document.write(style); 
win.document.write('</head>');
win.document.write('<body>');
win.document.write(divToPrint.outerHTML);
win.document.write('</body></html>');


win.print();
//win.close();  // AUTO CLOSE THE CURRENT WINDOW.
location.reload();
$('#printreport tr.child').hide();  

});
</script>

<script type="text/javascript">
function planyear1() {
var a = document.getElementById("DigitalBush").value;
document.getElementById("field2").value=a;
}
</script>

 <!-- <script type="text/javascript">
 	function printDiv("field2") {
  var printContents = document.getElementById("DigitalBush").innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
 </script> -->




<!-- <script type="text/javascript">
$(document).ready(function () {
$('#submitgo').click(function () {
var calendar=document.getElementById('DigitalBush').value;
window.location.href ="fetchmonth.php?cal="+calendar;

});
});
</script> -->


<footer class="footer">
<a style="font-size:small;height:10px">  Enterprise Solution Management | Version - 1 . 1 0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

© 2019 | All Rights Reserved
<a href="http://otes.in/" target="_blank" title="Ocean Technologies" style="text-align:center;font-size:small;color:#3366ff;font-weight:bold">      
<span href="http://otes.in/" target="_blank" title="Ocean Technologies" style="color: #1976D2;">&nbsp;&nbsp;OC<span style="color: #ff9900;">EAN</span></span> Technologies
</a>
</a>
</footer>
</body>
</html>
