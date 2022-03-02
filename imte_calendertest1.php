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


<!--inserting machine entries in machine_plan table --> 
<?php
if(isset($_POST['machineadd']))
{

$dt2=date("d-m-Y h:i:s");
$uid=$_SESSION['id'];
$name=$_SESSION['fullName'];

$monthcalendar=$_POST['monthcalendar'];
$monthcalendar=htmlspecialchars($monthcalendar,ENT_QUOTES);

// $query4 =mysql_query("SELECT * FROM machine");
// while($row4=mysql_fetch_array($query4))
// {
// $macid=$row4['id'];
// $machine_code=$row4['machinecode'];
// $machine_name=$row4['machine_name'];
// $machine_family=$row4['machine_group'];

$sql1=mysql_query("select * from machineplan where planyear='$monthcalendar'");
$count1=mysql_num_rows($sql1);
if($count1==0)
{
$det=mysql_query("SELECT id,machinecode,machine_name,machine_group,status,machinetype FROM machine");
while($row21=mysql_fetch_array($det)) 
{
	$id=$row21['id'];
	$machinecode=$row21['machinecode'];
	$machine_name=$row21['machine_name'];
	$machine_group=$row21['machine_group'];
	$status=$row21['status'];
	$machinetype=$row21['machinetype'];
$sql=mysql_query("INSERT INTO machineplan(machine_id,machine_code,machine_name,machine_family,machine_status,machine_type,planyear)values('$id','$machinecode','$machine_name','$machine_group','$status','$machinetype','$monthcalendar')");

echo '<script>        
window.location = "machineplanning_reg.php?year="+"'.$monthcalendar.'";
</script>';  
}

}
else
{
echo '<script>        
window.location = "machineplanning_reg.php?year="+"'.$monthcalendar.'";
</script>';           
} 
}
?>


<?php
// machine plan details
if(isset($_POST['insert_row']))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$regdate=date("d-m-Y");
$regdate2=date("Y-m-d");
//$mon=$_POST['mon_val'];
$yr=$_POST['yr_val'];
//$code=$_POST['code_val'];
//$macid=$_POST['macid_val'];
$mcplanid=$_POST['mcplanid_val'];
$wrk=$_POST['wrk'];
$sft=$_POST['sft'];

if(($sft>=0)&&($sft<=3))
{
$sqlw=mysql_query("update machineplan set workdys_jan='$wrk' where planyear='$yr'");

$sql1=mysql_query("update machineplan set regdate='$regdate',regdate2='$regdate2',planyear='$yr',jan='$sft' where id='$mcplanid'");
echo mysql_insert_id();
exit();
}
else
{

}
}
//isset end
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for January \n Minimum enter 0",
type: "warning"   
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for February \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for March \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for April \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for May \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for June \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for July \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for August \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for September \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
text: "Looks like few machine plan entries are blank for October. \n Enter 0, if any machine is not being planned/considered for October",
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for November \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
title: "Oops...!!!",
text: "Kindly fill all the shift entries for December \n Minimum enter 0",
type: "warning"   
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
text: "Data for Machine Planning Inserted Successfully",
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
padding: 5px 12px;
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

   .tableFixHead { overflow-y: auto; height: 400px; }
   

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
<h4 class="text-themecolor" >Machine Planning</h4>
</div>
<div class="col-md-7 align-self-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
<li class="breadcrumb-item"><a href="machineplan_monthreg.php">Machine Planning</a></li>

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
<li class="nav-item"><a class="nav-link active "  href="machineplanning_reg.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span><span class="hidden-xs-down">Machine Planning</span></a></li>
<!--  <li class="nav-item"><a class="nav-link" href="machineplan_view.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span><span class="hidden-xs-down">Machine-Log Summary</span></a></li> -->
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel"> 
<!-- division for operator list--> 
<div class="p-20">
<div class="row">
<div class="col-md-12">
<div  style="color:blue;font-size:small;padding-left:80%">
<!-- <button type="submit" class="btn btn-default btn-outline"><a href="machineplan_monthreg.php"><span class="text-muted"><i class="fa fa-reply"></i>&nbsp;Back</span></a></button> -->
<label for="firstName1" style="color:blue;font-size:small;">Date : </label>
<?php
echo " " . date("d-m-Y");
?> 
</div>
</div>
<?php
$mon=$_GET['month'];
if($mon >= 1 && $mon <= 12){
$monthname = date("F", mktime(0, 0, 0, $mon ,12));
}
$yr=$_GET['year'];
$query4 =mysql_query("SELECT * FROM machineplan_data where planmonth='$mon' and planyear='$yr' ");
while($row4=mysql_fetch_array($query4))
{
$workday=$row4['workdys'];
} ?>
<!--monthly machine planner table start-->  
<div class="container"> 

<form method="post" enctype="multipart/form-data" name="submitdata">


<!-- <div class="col-md-4">
<label style="font-size:15px">Select Month/Year&nbsp;<span style="font-size:medium;color:red">*</span></label>
<input type="text" id="DigitalBush" class="form-control-sm digital-bush" style="width:90px;margin-left:10px" placeholder="yyyy"  name="monthcalendar" required="true" readonly>
<span id="error" style="margin-left:120px;"></span>
</div> -->

<div class="row">
<div class="col-md-12">
<h6 style="color:red;text-align:left;font-size:small;">1. Data will get freezed by EOD 5th of every month. User will not be allowed to edit later.</h6>
<h6 style="color:red;text-align:left;font-size:small;">2. Only active Production Machines are considered.</h6>
<h6 style="color:red;text-align:left;font-size:small;">3. Valid range of numbers for shift entries is 0 to 3</h6>
</div>
</div>
 <hr style="border-top: 1px dashed orange;text-align: center">



<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Select Year</label>
<select class="form-control" id="DigitalBush" name="monthcalendar">
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
<label></label>
 <input type="submit" class="btn btn-primary" name="machineadd" value="GO">
</div>
</div>

<div class="col-sm-2" style="margin-left:450px;">
<a id="reportprint3" target="_blank"><button type="submit" class="btn btn-default btn-outline"><span class="text-muted"><i class="fa fa-print"></i>&nbsp;Print</span></button></a>
</div>
</div>




<input type="hidden" id="mon" value="<?php echo $mon; ?>"><input type="hidden" id="yr" value="<?php echo $yr; ?>">
<!--no. of working days-->

<span id="errornumber" style="font-size:14px;color:red;font-weight:500;"></span>

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




<?php
$queryday =mysql_query("SELECT * FROM machineplan where machine_status='1' AND machine_type='Production Machine' AND planyear='$yr' order by id limit 1");
while($rowday=mysql_fetch_array($queryday))
{ 
 ?>

<div id="printreport"> 

<div class="row">
<div class="col-md-6">
<h4 style="font-family:Poppins;color:black;font-weight:500;"> Calibration Plan for Year 2020:&nbsp;&nbsp;&nbsp;<?php echo $yr; ?>
</h4>
</div>
<div class="col-md-4">
<p id="datasave" style="display:none;font-size:20px;color:green;font-family:Poppins;margin-left:25px;font-weight:600;">Data Saved Successfully</p>
</div>
</div>


<div class="tableFixHead">
<table class="table table-bordered table-sm" style="width: 100%;" id="customers" class="myTable">

<thead>	
<tr style="background-color: #0080ff;color: white;border-color:white;text-align:center;">
<th style="border:1px solid #C0C0C0;" rowspan="2">IMTE Code <br>name</th>
<th style="border:1px solid #C0C0C0;" rowspan="2">Size<br>range</th>
<th style="border:1px solid #C0C0C0;" rowspan="2">Frequency<br>in month</th>
<th style="border:1px solid #C0C0C0;" colspan="3" >Jan</th>
<th style="border:1px solid #C0C0C0;" colspan="3" >Feb</th>
<th style="border:1px solid #C0C0C0;" colspan="3" >Mar</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Apr</th>
<th style="border:1px solid #C0C0C0;" colspan="3">May</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Jun</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Jul</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Aug</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Sep</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Oct</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Nov</th>
<th style="border:1px solid #C0C0C0;" colspan="3">Dec</th>
</tr>

<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>
<tr>
<td>P</td>
<td>A</td>
<td>S</td>
</tr>

<?php 
if($currentdate>=$datejan)
{ ?>

<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">	
<input type="number" name="wrkdy1" id="wrkdy1" value="<?php echo $rowday['workdys_jan'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$datefeb)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy2feb" id="wrkdy2feb" value="<?php echo $rowday['workdys_feb'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$datemar)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>

<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_mar" id="wrkdy_mar" value="<?php echo $rowday['workdys_mar'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$dateapr)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_apr" id="wrkdy_apr" value="<?php echo $rowday['workdys_apr'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$datemay)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_may" id="wrkdy_may" value="<?php echo $rowday['workdys_may'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$datejun)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_june" id="wrkdy_june" value="<?php echo $rowday['workdys_june'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$datejul)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_july" id="wrkdy_july" value="<?php echo $rowday['workdys_july'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($currentdate>=$dateaug)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_aug" id="wrkdy_aug" value="<?php echo $rowday['workdys_aug'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">	
</th>
<?php } ?>

<?php 
if($currentdate>=$datesep)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_sep" id="wrkdy_sep" value="<?php echo $rowday['workdys_sep'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">	
</th>
<?php } ?>

<?php 
if($date4>=$date2oc)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_oct" id="wrkdy_oct" value="<?php echo $rowday['workdys_oct'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>

<?php 
if($date4>=$datenov)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_nov" id="wrkdy_nov" value="<?php echo $rowday['workdys_nov'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">	
</th>
<?php } ?>

<?php 
if($date4>=$datedec)
{ ?>
<th style="background:#cccccc;color:white;font-weight:500;"></th>
<?php } 
else
{ ?>
<th style="background:white;font-weight:500;">
<input type="number" name="wrkdy_dec" id="wrkdy_dec" value="<?php echo $rowday['workdys_dec'];?>" class="form-control form-control-line form-control-sm workdyclass" min="0" style="font-weight:800;text-align:left;font-size:12px;width:52px;color:black;">
</th>
<?php } ?>
</tr>

<tr>
<th colspan="3" style="border:1px solid #C0C0C0;text-align:right;font-weight:800;color:white;font-size:14px;"><b>Machine Shift Status<b></th>

<?php 
if($currentdate>=$datejan)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_jan']=="")
{ ?>
<th style="background:white;font-weight:500;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datefeb)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_feb']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datemar)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_mar']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$dateapr)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_apr']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datemay)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_may']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datejun)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_june']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datejul)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_july']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$dateaug)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_aug']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($currentdate>=$datesep)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_sep']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($date4>=$date2oc)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_oct']=="")
{ ?>
<th style="background:green;color:white;font-weight:500;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>

<?php } ?>

<?php 
if($date4>=$datenov)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_nov']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>

<?php 
if($date4>=$datedec)
{ ?>
<th style="background:grey;color:white;font-weight:500;">Freezed</th>
<?php } 
else
{ 
if($rowday['workdys_dec']=="")
{ ?>
<th style="background:white;font-weight:500;color:black;">Not Planned</th>
<?php }
else
{ ?>
<th style="background:green;color:white;font-weight:500;">Planned</th>
<?php } ?>
<?php } ?>
</tr>

<?php } ?>
</thead>

<tbody>
<?php
$querydept1 =mysql_query("SELECT * FROM machineplan where machine_status='1' AND machine_type='Production Machine' AND planyear='$yr' order by id");
while($row=mysql_fetch_array($querydept1))
{  $macid=$row['id'];
 ?>
<!-- <input type="text" name="planmonth" id="mon<?php echo $row['id'];?>" value="01" style="display:none;"> -->
<input type="text" name="planyear" id="yr<?php echo $row['id'];?>" value="<?php echo $yr;?>" style="display:none;">
<!-- <input type="text" name="machinecode" id="code<?php echo $row['id'];?>" value="<?php echo $row['machine_code'];?>" style="display:none;">
<input type="text" name="machineid" id="macid<?php echo $row['id'];?>" value="<?php echo $row['machine_id'];?>" style="display:none;">  -->
<input type="text" name="mcplanid" id="mcplanid<?php echo $row['id'];?>" value="<?php echo $row['id'];?>" style="display:none;">
<!--machine code-->  
<tr>
<!-- <input type="number" name="wrkdy2" id="wrkdy2" style="display:none;"> -->
<td  style="border:1px solid #C0C0C0;">
<?php echo $row['machine_code']; ?>
</td>
<td style="border:1px solid #C0C0C0;"><?php echo $row['machine_name']; ?></td>
<td style="border:1px solid #C0C0C0;"><?php echo $row['machine_family']; ?></td>
<!--shifts running-->

<?php 
if($currentdate>=$datejan)
{ 
//for color code	
if($row['jan']>0 && $row['jan']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['jan'];?></td>
<?php }
else if($row['jan']>1 && $row['jan']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['jan'];?></td>
<?php }
else if($row['jan']>2 && $row['jan']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['jan'];?></td>
<?php } 
else if($row['jan']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['jan'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<td style="border:1px solid #C0C0C0;" class="tdjan">
<div class="form-material" >
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn" id="sft<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['jan'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_row('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

<!--for FEB -->


<?php
if($currentdate>=$datefeb)
{ 

//for color code	
if($row['feb']>0 && $row['feb']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['feb'];?></td>
<?php }
else if($row['feb']>1 && $row['feb']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['feb'];?></td>
<?php }
else if($row['feb']>2 && $row['feb']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['feb'];?></td>
<?php } 
else if($row['feb']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['feb'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdnfeb" id="sftfeb<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['feb'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowfeb('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

<!--for MARCH -->
<?php 

if($currentdate>=$datemar)
{ 
//for color code	
if($row['mar']>0 && $row['mar']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['mar'];?></td>
<?php }
else if($row['mar']>1 && $row['mar']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['mar'];?></td>
<?php }
else if($row['mar']>2 && $row['mar']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['mar'];?></td>
<?php } 
else if($row['mar']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['mar'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_mar" id="sft_mar<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['mar'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowmar('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

<?php 

if($currentdate>=$dateapr)
{ 
//for color code	
if($row['apr']>0 && $row['apr']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['apr'];?></td>
<?php }
else if($row['apr']>1 && $row['apr']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['apr'];?></td>
<?php }
else if($row['apr']>2 && $row['apr']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['apr'];?></td>
<?php } 
else if($row['apr']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['apr'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<!--for APRIL -->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_apr" id="sft_apr<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['apr'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowapr('<?php echo $row['id'];?>');">
</div>	
</td>
<?php } ?>


<!--for MAY -->
<?php 

if($currentdate>=$datemay)
{ 
//for color code	
if($row['may']>0 && $row['may']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['may'];?></td>
<?php }
else if($row['may']>1 && $row['may']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['may'];?></td>
<?php }
else if($row['may']>2 && $row['may']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['may'];?></td>
<?php } 
else if($row['may']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['may'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_may" id="sft_may<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['may'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowmay('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>


<?php 

if($currentdate>=$datejun)
{ 
//for color code	
if($row['jun']>0 && $row['jun']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['jun'];?></td>
<?php }
else if($row['jun']>1 && $row['jun']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['jun'];?></td>
<?php }
else if($row['jun']>2 && $row['jun']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['jun'];?></td>
<?php } 
else if($row['jun']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['jun'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<!--for JUNE -->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_june" id="sft_june<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['jun'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowjune('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

<?php 

if($currentdate>=$datejul)
{ 
//for color code	
if($row['jul']>0 && $row['jul']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['jul'];?></td>
<?php }
else if($row['jul']>1 && $row['jul']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['jul'];?></td>
<?php }
else if($row['jul']>2 && $row['jul']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['jul'];?></td>
<?php } 
else if($row['jul']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['jul'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<!--for JULY -->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_july" id="sft_july<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['jul'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowjuly('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>


<?php 

if($currentdate>=$dateaug)
{ 

//for color code	
if($row['aug']>0 && $row['aug']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['aug'];?></td>
<?php }
else if($row['aug']>1 && $row['aug']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['aug'];?></td>
<?php }
else if($row['aug']>2 && $row['aug']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['aug'];?></td>
<?php } 
else if($row['aug']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['aug'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<!--for AUGUST-->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_aug" id="sft_aug<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['aug'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowaug('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>


<?php 

if($currentdate>=$datesep)
{ 

//for color code	
if($row['sep']>0 && $row['sep']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['sep'];?></td>
<?php }
else if($row['sep']>1 && $row['sep']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['sep'];?></td>
<?php }
else if($row['sep']>2 && $row['sep']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['sep'];?></td>
<?php } 
else if($row['sep']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['sep'];?></td>
<?php } ?>
<!-- for color code end-->

<?php } 
else
{ ?>
<!--for SEPTEMBER-->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_sep" id="sft_sep<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['sep'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;" oninput="insert_rowsep('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>


<?php 

if($date4>=$date2oc)
{ 
//for color code	
if($row['oct']>0 && $row['oct']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['oct'];?></td>
<?php }
else if($row['oct']>1 && $row['oct']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['oct'];?></td>
<?php }
else if($row['oct']>2 && $row['oct']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['oct'];?></td>
<?php } 
else if($row['oct']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['oct'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<!--for OCTOBER-->
<td style="border:1px solid #C0C0C0;" class="tdoct">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_oct" id="sft_oct<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['oct'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;border:none;" oninput="insert_rowoct('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

<?php 

if($date4>=$datenov)
{ 
//for color code	
if($row['nov']>0 && $row['nov']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['nov'];?></td>
<?php }
else if($row['nov']>1 && $row['nov']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['nov'];?></td>
<?php }
else if($row['nov']>2 && $row['nov']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['nov'];?></td>
<?php } 
else if($row['nov']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['nov'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<!--for NOVEMBER-->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_nov" id="sft_nov<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['nov'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;border:none;" oninput="insert_rownov('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>


<?php

if($date4>=$datedec)
{ 
//for color code	
if($row['decc']>0 && $row['decc']<=1)
{ ?>
<td style="background-color:#0086ad;color:white;text-align:center;"><?php echo $row['decc'];?></td>
<?php }
else if($row['decc']>1 && $row['decc']<=2)
{ ?>
<td style="background-color:#da7a24;color:white;text-align:center;"><?php echo $row['decc'];?></td>
<?php }
else if($row['decc']>2 && $row['decc']<=3)
{ ?>
<td style="background-color:#d62976;color:white;text-align:center;"><?php echo $row['decc'];?></td>
<?php } 
else if($row['decc']==0)
{ ?>
<td style="background-color:#cccccc;color:white;text-align:center;"><?php echo $row['decc'];?></td>
<?php } ?>
<!-- for color code end-->
<?php } 
else
{ ?>
<!--for DECEMBER-->
<td style="border:1px solid #C0C0C0;">
<div class="form-material">
<input type="number" class="form-control-line form-control-sm checksum" name="sundaypdn_dec" id="sft_dec<?php echo $row['id'];?>" min="0" max="3" step="0.1" value="<?php echo $row['decc'];?>" autocomplete="off" style="font-weight:500;text-align:left;width:52px;font-size:9px;border:none;" oninput="insert_rowdec('<?php echo $row['id'];?>');">
</div>
</td>
<?php } ?>

</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<?php 
if($_GET['year']!="")
{
?>
<center>
<input type="submit" class="btn btn-primary" name="submitmc" value="Submit">
</center>
<?php } ?>

</form> 
</div>


<!-- table to view shifts data monthly -->
<!-- <?php
$queryrow="SELECT * from machineplan";
$resultsrow=mysql_query($queryrow);
$row_count=mysql_num_rows($resultsrow); 
if($row_count!=0)
{ //display table to view ?>
<table class="table table-bordered table-sm">
<thead>
<tr style="background-color: #0080ff;color:white;border-color:white;text-align:center;">
<th style="border:1px solid #C0C0C0;">Jan<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Feb<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Mar<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Apr<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">May<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Jun<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Jul<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Aug<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Sep<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Oct<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Nov<br><?php echo $yr; ?></th>
<th style="border:1px solid #C0C0C0;">Dec<br><?php echo $yr; ?></th>
</tr>
</thead>
<tbody>
<tr>

<?php
$query2 =mysql_query("SELECT * FROM machine where status='1' AND machinetype='Production Machine' order by id");
while($row2=mysql_fetch_array($query2))
{  
$macid=$row2['id'];  

// fetching data to display in table form
$query3 =mysql_query("SELECT * FROM machineplan where planyear='$yr' AND machine_id='$macid' order by machine_id");
while($row3=mysql_fetch_array($query3))
{ 
$db_jan=$row3['jan'];
$db_feb=$row3['feb'];
$db_mar=$row3['mar'];
$db_apr=$row3['apr'];
$db_may=$row3['may'];
$db_jun=$row3['jun'];
$db_jul=$row3['jul'];
$db_aug=$row3['aug'];
$db_sep=$row3['sep'];
$db_oct=$row3['oct'];
$db_nov=$row3['nov'];
$db_dec=$row3['decc'];

?>
<tr>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_jan; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_feb; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_mar; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_apr; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_may; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_jun; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_jul; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_aug; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_sep; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_oct; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_nov; ?></th>
<th  style="border:1px solid #C0C0C0;text-align:center;"><?php echo $db_dec; ?></th>
</tr>
<?php } } } ?>
</tbody>
</table> -->



<?php } ?> <!--select * from users -->

</div><!--  monthlyplanner container end -->

</div> 
</div> <!--p-20 container end -->
</div><!-- /tab-pane -->
</div> <!-- /content-panel -->
</div><!-- /col-lg-4 -->     
</div><!-- /row -->       
</div></div></div>

<script>
function hodneedinfo() {
  setTimeout(function() {
        swal({  
                    title: "Success!",
                    text: "Data Inserted Successfully",
                    type: "success"   
          }, 
           function() 
          {
                    location.reload();
            });
         }, 1000);
}
</script>
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


<script type="text/javascript">
$('input.checksum').keyup(function() {
var max = parseInt($(this).attr('max'));
var min = parseInt($(this).attr('min'));
if ($(this).val() > max)
{
$(this).val('');
swal("Wrong entry !", "Valid range is between 0 to 3", "error")
return false;
}
else if ($(this).val() < min)
{
$(this).val('');
swal("Wrong entry !", "Valid range is between 0 to 3", "error")
return false;
}
else   
{

}
}); 
</script>

<script>
function insert_row(id)
{
//var mon=document.getElementById('mon'+id).value;
var yr=document.getElementById('yr'+id).value;
//var code=document.getElementById('code'+id).value;
var sft=document.getElementById('sft'+id).value;
var wrk=document.getElementById('wrkdy1').value;
//var macid=document.getElementById('macid'+id).value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrk=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_row:'insert_row',
yr_val:yr,
mcplanid_val:mcplanid,
wrk:wrk,
sft:sft
},
success:function(response) {
if(response!="")
{

// document.getElementById('mon'+id).value="";
// document.getElementById('yr'+id).value="";
// document.getElementById('code'+id).value="";
// document.getElementById('macid'+id).value="";
// document.getElementById('sft'+id).value="";
//document.getElementById('datasave').style.display="block";
//window.location.href = "machineplan_reg.php?month="+mon+"&year="+yr;
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowfeb(id)
{
//var monfeb=document.getElementById('monfeb'+id).value;
var yrfeb=document.getElementById('yr'+id).value;
//var codefeb=document.getElementById('codefeb'+id).value;
var sftfeb=document.getElementById('sftfeb'+id).value;
var wrkdy2feb=document.getElementById('wrkdy2feb').value;
//var macidfeb=document.getElementById('macidfeb'+id).value;
var mcplanidfeb=document.getElementById('mcplanid'+id).value;
if(wrkdy2feb=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowfeb:'insert_rowfeb',
yrfeb_val:yrfeb,
mcplanidfeb_val:mcplanidfeb,
wrkdy2feb_val:wrkdy2feb,
sftfeb_val:sftfeb
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowmar(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_mar=document.getElementById('sft_mar'+id).value;
var wrkdy_mar=document.getElementById('wrkdy_mar').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_mar=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowmar:'insert_rowmar',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_marval:wrkdy_mar,
sft_marval:sft_mar
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowapr(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_apr=document.getElementById('sft_apr'+id).value;
var wrkdy_apr=document.getElementById('wrkdy_apr').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_apr=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowapr:'insert_rowapr',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_aprval:wrkdy_apr,
sft_aprval:sft_apr
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>

<script>
function insert_rowmay(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_may=document.getElementById('sft_may'+id).value;
var wrkdy_may=document.getElementById('wrkdy_may').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_may=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowmay:'insert_rowmay',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_mayval:wrkdy_may,
sft_mayval:sft_may
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowjune(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_june=document.getElementById('sft_june'+id).value;
var wrkdy_june=document.getElementById('wrkdy_june').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_june=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowjune:'insert_rowjune',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_juneval:wrkdy_june,
sft_juneval:sft_june
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowjuly(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_july=document.getElementById('sft_july'+id).value;
var wrkdy_july=document.getElementById('wrkdy_july').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_july=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowjuly:'insert_rowjuly',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_julyval:wrkdy_july,
sft_julyval:sft_july
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowaug(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_aug=document.getElementById('sft_aug'+id).value;
var wrkdy_aug=document.getElementById('wrkdy_aug').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_aug=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowaug:'insert_rowaug',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_augval:wrkdy_aug,
sft_augval:sft_aug
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<script>
function insert_rowsep(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_sep=document.getElementById('sft_sep'+id).value;
var wrkdy_sep=document.getElementById('wrkdy_sep').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_sep=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowsep:'insert_rowsep',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_sepval:wrkdy_sep,
sft_sepval:sft_sep
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>

<script>
function insert_rowoct(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_oct=document.getElementById('sft_oct'+id).value;
var wrkdy_oct=document.getElementById('wrkdy_oct').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_oct=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowoct:'insert_rowoct',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_octval:wrkdy_oct,
sft_octval:sft_oct
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>

<script>
function insert_rownov(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_nov=document.getElementById('sft_nov'+id).value;
var wrkdy_nov=document.getElementById('wrkdy_nov').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_nov=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rownov:'insert_rownov',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_novval:wrkdy_nov,
sft_novval:sft_nov
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>

<script>
function insert_rowdec(id)
{
var yr=document.getElementById('yr'+id).value;
var sft_dec=document.getElementById('sft_dec'+id).value;
var wrkdy_dec=document.getElementById('wrkdy_dec').value;
var mcplanid=document.getElementById('mcplanid'+id).value;
if(wrkdy_dec=='')
{  
}
else
{
$.ajax
({
type:'post',
url:'machineplanning_reg.php',
data:{
insert_rowdec:'insert_rowdec',
yr_val:yr,
mcplanid_val:mcplanid,
wrkdy_decval:wrkdy_dec,
sft_decval:sft_dec
},
success:function(response) {
if(response!="")
{
$("#datasave").show();
setTimeout(function() { $("#datasave").hide(); }, 1000);
}
}
});
}
}
</script>


<!-- To copy no. of working days in each row in while loop -->
<script type="text/javascript">
function copy_wrkdy(){
var f1 = document.getElementById("wrkdy1");
var f2 = document.getElementById("wrkdy2");
f2.value = f1.value;
}
</script>


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
<!-- <script type="text/javascript">
$(document).ready(function () {
$('#submitgo').click(function () {
var calendar=document.getElementById('DigitalBush').value;
window.location.href ="fetchmonth.php?cal="+calendar;

});
});
</script> -->


<footer class="footer">
<a style="font-size:small;height:10px">  Enterprise Solution Management | Version - 1 . 1 0
<br>
© 2019 | All Rights Reserved
<a href="http://otes.in/" target="_blank" title="Ocean Technologies" style="text-align:center;font-size:small;color:#3366ff;font-weight:bold">      
<span href="http://otes.in/" target="_blank" title="Ocean Technologies" style="color: #1976D2;">&nbsp;&nbsp;OC<span style="color: #ff9900;">EAN</span></span> Technologies
</a>
</a>
</footer>
</body>
</html>
