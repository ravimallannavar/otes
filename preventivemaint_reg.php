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

<!--on page load add machine entries in preventive table for current month and year present in url -->
<!--on page load add machine entries in preventive table for current month and year present in url -->
<?php
$urlyear=$_GET['year'];
$urlmonth=$_GET['month'];

$sqlpp=mysql_query("select * from preventivemaint_reg where planyear='$urlyear' and month='$urlmonth'");
$countpp=mysql_num_rows($sqlpp);

if($countpp==0)
{
$detp=mysql_query("SELECT * FROM machine where status='1'");
while($row21=mysql_fetch_array($detp)) 
{
$id=$row21['id'];
$machinecode=$row21['machinecode'];
$machine_name=$row21['machine_name'];
$machine_group=$row21['machine_group'];
$status=$row21['status'];
$machinetype=$row21['machinetype'];
$location=$row21['location'];
$bkid=$row21['bkid'];
$createdate1=$row21['createdate'];
$createdate2=date('d-m-Y', strtotime($createdate1));
$createdateymd=date('Y-m-d', strtotime($createdate1));

$createdate3 = explode("-", $createdate2);
$machineday = $createdate3[0];
$machinemonth = $createdate3[1]; 
$machineyear = $createdate3[2];

$currentyear=date('Y');
$currentmonth=date('m');
 
if(($countpp==0)&&(($urlyear>$machineyear)||($urlyear==$machineyear))&&(($urlmonth>$machinemonth)||$urlmonth==$machinemonth))
{
$sql=mysql_query("INSERT INTO preventivemaint_reg(machine_id,machine_code,machine_name,machine_family,machine_status,machine_type,machine_location,bkid,planyear,month)values('$id','$machinecode','$machine_name','$machine_group','$status','$machinetype','$location','$bkid','$urlyear','$urlmonth')");
}
else if(($countpp==0)&&($urlyear>=$currentyear)&&($urlmonth>=$currentmonth))
{
$sql=mysql_query("INSERT INTO preventivemaint_reg(machine_id,machine_code,machine_name,machine_family,machine_status,machine_type,machine_location,bkid,planyear,month)values('$id','$machinecode','$machine_name','$machine_group','$status','$machinetype','$location','$bkid','$urlyear','$urlmonth')");
}
else
{
           
} 
}

} //if countpp==0

?>


<!--on submit of GO button -->
<!--inserting machine entries in preventivemaint_reg table --> 
<?php
if(isset($_POST['machineadd']))
{

$dt2=date("d-m-Y h:i:s");
$uid=$_SESSION['id'];
$name=$_SESSION['fullName'];

$month=$_POST['month'];
$month=htmlspecialchars($month,ENT_QUOTES);

$year=$_POST['year'];
$year=htmlspecialchars($year,ENT_QUOTES);

$currentyear=date('Y');
$currentmonth=date('m');

$sql1=mysql_query("select * from preventivemaint_reg where planyear='$year' and month='$month'");
$count1=mysql_num_rows($sql1);


$det=mysql_query("SELECT * FROM machine where status='1'");
while($row21=mysql_fetch_array($det)) 
{
	$id=$row21['id'];
	$machinecode=$row21['machinecode'];
	$machine_name=$row21['machine_name'];
	$machine_group=$row21['machine_group'];
	$status=$row21['status'];
	$machinetype=$row21['machinetype'];
    $location=$row21['location'];
    $bkid=$row21['bkid'];

$createdate1=$row21['createdate'];
$createdate2=date('d-m-Y', strtotime($createdate1));
$createdateymd=date('Y-m-d', strtotime($createdate1));

$createdate3 = explode("-", $createdate2);
$machineday = $createdate3[0];
$machinemonth = $createdate3[1]; 
$machineyear = $createdate3[2];


if(($count1==0)&&(($year>$machineyear)||($year==$machineyear))&&(($month>$machinemonth)||$month==$machinemonth))
{
$sql=mysql_query("INSERT INTO preventivemaint_reg(machine_id,machine_code,machine_name,machine_family,machine_status,machine_type,machine_location,bkid,planyear,month)values('$id','$machinecode','$machine_name','$machine_group','$status','$machinetype','$location','$bkid','$year','$month')");

echo '<script>        
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$month.'";
</script>';  
}
else if(($count1==0)&&($year>=$currentyear)&&($month>=$currentmonth))
{
$sql=mysql_query("INSERT INTO preventivemaint_reg(machine_id,machine_code,machine_name,machine_family,machine_status,machine_type,machine_location,bkid,planyear,month)values('$id','$machinecode','$machine_name','$machine_group','$status','$machinetype','$location','$bkid','$year','$month')");
}

else
{
echo '<script>        
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$month.'";
</script>';           
}
}
 
}
?>


<?php  
if(isset($_POST['updateweek1']))
{
$fullName=$_SESSION['fullName'];
$department=$_SESSION['department'];
$uid=$_SESSION['id'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y h:i:s");

$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept_abb=$row11['authority'];

}

$macid=$_POST['macid'];
$week=$_POST['week'];
$mon=$_POST['mon'];
$year=$_POST['year'];
$autoid=$_POST['autoid'];
$machine_code=$_POST['machine_code'];
$machine_name=$_POST['machine_name'];

$pmstatus1=$_POST['pmstatus1'];
$pmstatus1=htmlspecialchars($pmstatus1,ENT_QUOTES);

$pmdoneby1=$fullName;
$pmdoneid1=$uid;
$pmdonedept1=$dept_abb;
$pmdonedate1=$dt2;

$machinehealth1=$_POST['machinehealth1'];
$machinehealth1=htmlspecialchars($machinehealth1,ENT_QUOTES);

$points1=$_POST['points1'];
$points1=htmlspecialchars($points1,ENT_QUOTES);

$verifiedyesno1=$_POST['verifiedyesno1'];
$verifiedyesno1=htmlspecialchars($verifiedyesno1,ENT_QUOTES);

if($verifiedyesno1=="yes")
{
$verifiedname1=$fullName;
$verifieddept1=$dept_abb;
$verifieddate1=$dt2;
$verifiedid1=$uid;
}
else
{
$verifiedname1="";
$verifieddept1="";
$verifieddate1="";
$verifiedid1="";
}

if($machinehealth1!="")
{
$health_updateby1=$fullName;
$health_updatedept1=$dept_abb;
$health_updatedate1=$dt2;
$health_updatedid1=$uid;
}
else
{
$health_updateby1="";
$health_updatedept1="";
$health_updatedate1="";
$health_updatedid1="";
}

$pm_updatestatus1=$_POST['pm_updatestatus1'];
$pm_updatestatus1=htmlspecialchars($pm_updatestatus1,ENT_QUOTES);

$pm_updatestatusby1=$fullName;
$pm_updatestatusid1=$uid;
$pm_updatestatusdate1=$dt2;


if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}

//storing attachment
$pathd=$_FILES['attachment1']['name'];
$extd = pathinfo($pathd, PATHINFO_EXTENSION);
$based = pathinfo($pathd, PATHINFO_FILENAME);
$sqlfile57=mysql_query("select * from preventivemaint_reg where id='$autoid'");
while($rowfile47=mysql_fetch_array($sqlfile57))
{
if($based=="")
{
$attachment1=$rowfile47['attachment1'];
}
else
{
$sqlfile=mysql_query("select id from preventivemaint_reg where id='$autoid'");
while($rowfile=mysql_fetch_array($sqlfile))
{
$cmpnfile=$rowfile['id'];
}
$fileno=$cmpnfile;

$dash="_";
$fileformat1="Report".$dash;
$fileformat2=$machine_name.$dash.$machine_code.$dash.$monthvalue.$dash.$year.$dash."Week1".$dash;
$fileformat3=$fileformat1.$fileformat2;
$attachment1= $fileformat3.date("YmdHis.").$extd;
}
}
move_uploaded_file($_FILES["attachment1"]["tmp_name"],"Attachments/Production/Preventive_Maintenance/".$attachment1);


$sql51=mysql_query("update preventivemaint_reg set pmstatus1='$pmstatus1',machinehealth1='$machinehealth1',points1='$points1',verifiedyesno1='$verifiedyesno1',verifiedname1='$verifiedname1',verifieddate1='$verifieddate1',verifieddept1='$verifieddept1',verifiedid1='$verifiedid1',attachment1='$attachment1',pmdoneby1='$pmdoneby1',pmdoneid1='$pmdoneid1',pmdonedept1='$pmdonedept1',pmdonedate1='$pmdonedate1',health_updatedid1='$health_updatedid1',health_updatedate1='$health_updatedate1',health_updatedept1='$health_updatedept1',health_updateby1='$health_updateby1',pm_updatestatus1='$pm_updatestatus1',pm_updatestatusdate1='$pm_updatestatusdate1',pm_updatestatusid1='$pm_updatestatusid1',pm_updatestatusby1='$pm_updatestatusby1' where id='$autoid'");

if($sql51=="")    
{
echo '<script>        
setTimeout(function() {
swal({  
title: "warning",
text: "Something Went Wrong",
type: "warning"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
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
text: "PM Activity for Machine Code : '.$machine_code.' Updated Successfully for Week 1",
type: "success"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
});
}, 1000);
</script>';     
}
}
else
{

} 
?>


<?php  
if(isset($_POST['updateweek2']))
{
$fullName=$_SESSION['fullName'];
$department=$_SESSION['department'];
$uid=$_SESSION['id'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y h:i:s");

$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept_abb=$row11['authority'];

}

$macid=$_POST['macid'];
$week=$_POST['week'];
$mon=$_POST['mon'];
$year=$_POST['year'];
$autoid=$_POST['autoid'];
$machine_code=$_POST['machine_code'];
$machine_name=$_POST['machine_name'];

$pmstatus1=$_POST['pmstatus1'];
$pmstatus1=htmlspecialchars($pmstatus1,ENT_QUOTES);

$pmdoneby1=$fullName;
$pmdoneid1=$uid;
$pmdonedept1=$dept_abb;
$pmdonedate1=$dt2;

$machinehealth1=$_POST['machinehealth1'];
$machinehealth1=htmlspecialchars($machinehealth1,ENT_QUOTES);

$points1=$_POST['points1'];
$points1=htmlspecialchars($points1,ENT_QUOTES);

$verifiedyesno1=$_POST['verifiedyesno1'];
$verifiedyesno1=htmlspecialchars($verifiedyesno1,ENT_QUOTES);

if($verifiedyesno1=="yes")
{
$verifiedname1=$fullName;
$verifieddept1=$dept_abb;
$verifieddate1=$dt2;
$verifiedid1=$uid;
}
else
{
$verifiedname1="";
$verifieddept1="";
$verifieddate1="";
$verifiedid1="";
}

if($machinehealth1!="")
{
$health_updateby1=$fullName;
$health_updatedept1=$dept_abb;
$health_updatedate1=$dt2;
$health_updatedid1=$uid;
}
else
{
$health_updateby1="";
$health_updatedept1="";
$health_updatedate1="";
$health_updatedid1="";
}

$pm_updatestatus1=$_POST['pm_updatestatus1'];
$pm_updatestatus1=htmlspecialchars($pm_updatestatus1,ENT_QUOTES);

$pm_updatestatusby1=$fullName;
$pm_updatestatusid1=$uid;
$pm_updatestatusdate1=$dt2;

if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}

//storing attachment
$pathd=$_FILES['attachment1']['name'];
$extd = pathinfo($pathd, PATHINFO_EXTENSION);
$based = pathinfo($pathd, PATHINFO_FILENAME);
$sqlfile57=mysql_query("select * from preventivemaint_reg where id='$autoid'");
while($rowfile47=mysql_fetch_array($sqlfile57))
{
if($based=="")
{
$attachment1=$rowfile47['attachment2'];
}
else
{
$sqlfile=mysql_query("select id from preventivemaint_reg where id='$autoid'");
while($rowfile=mysql_fetch_array($sqlfile))
{
$cmpnfile=$rowfile['id'];
}
$fileno=$cmpnfile;

$dash="_";
$fileformat1="Report".$dash;
$fileformat2=$machine_name.$dash.$machine_code.$dash.$monthvalue.$dash.$year.$dash."Week2".$dash;
$fileformat3=$fileformat1.$fileformat2;
$attachment1= $fileformat3.date("YmdHis.").$extd;
}
}
move_uploaded_file($_FILES["attachment1"]["tmp_name"],"Attachments/Production/Preventive_Maintenance/".$attachment1);


$sql51=mysql_query("update preventivemaint_reg set pmstatus2='$pmstatus1',machinehealth2='$machinehealth1',points2='$points1',verifiedyesno2='$verifiedyesno1',verifiedname2='$verifiedname1',verifieddate2='$verifieddate1',verifieddept2='$verifieddept1',verifiedid2='$verifiedid1',attachment2='$attachment1',pmdoneby2='$pmdoneby1',pmdoneid2='$pmdoneid1',pmdonedept2='$pmdonedept1',pmdonedate2='$pmdonedate1',health_updatedid2='$health_updatedid1',health_updatedate2='$health_updatedate1',health_updatedept2='$health_updatedept1',health_updateby2='$health_updateby1',pm_updatestatus2='$pm_updatestatus1',pm_updatestatusdate2='$pm_updatestatusdate1',pm_updatestatusid2='$pm_updatestatusid1',pm_updatestatusby2='$pm_updatestatusby1' where id='$autoid'");

if($sql51=="")    
{
echo '<script>        
setTimeout(function() {
swal({  
title: "warning",
text: "Something Went Wrong",
type: "warning"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
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
text: "PM Activity for Machine Code : '.$machine_code.' Updated Successfully for Week 2",
type: "success"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
});
}, 1000);
</script>';     
}
}
else
{

} 
?>


<?php  
if(isset($_POST['updateweek3']))
{
$fullName=$_SESSION['fullName'];
$department=$_SESSION['department'];
$uid=$_SESSION['id'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y h:i:s");

$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept_abb=$row11['authority'];

}

$macid=$_POST['macid'];
$week=$_POST['week'];
$mon=$_POST['mon'];
$year=$_POST['year'];
$autoid=$_POST['autoid'];
$machine_code=$_POST['machine_code'];
$machine_name=$_POST['machine_name'];

$pmstatus1=$_POST['pmstatus1'];
$pmstatus1=htmlspecialchars($pmstatus1,ENT_QUOTES);

$pmdoneby1=$fullName;
$pmdoneid1=$uid;
$pmdonedept1=$dept_abb;
$pmdonedate1=$dt2;

$machinehealth1=$_POST['machinehealth1'];
$machinehealth1=htmlspecialchars($machinehealth1,ENT_QUOTES);

$points1=$_POST['points1'];
$points1=htmlspecialchars($points1,ENT_QUOTES);

$verifiedyesno1=$_POST['verifiedyesno1'];
$verifiedyesno1=htmlspecialchars($verifiedyesno1,ENT_QUOTES);

if($verifiedyesno1=="yes")
{
$verifiedname1=$fullName;
$verifieddept1=$dept_abb;
$verifieddate1=$dt2;
$verifiedid1=$uid;
}
else
{
$verifiedname1="";
$verifieddept1="";
$verifieddate1="";
$verifiedid1="";
}

if($machinehealth1!="")
{
$health_updateby1=$fullName;
$health_updatedept1=$dept_abb;
$health_updatedate1=$dt2;
$health_updatedid1=$uid;
}
else
{
$health_updateby1="";
$health_updatedept1="";
$health_updatedate1="";
$health_updatedid1="";
}

$pm_updatestatus1=$_POST['pm_updatestatus1'];
$pm_updatestatus1=htmlspecialchars($pm_updatestatus1,ENT_QUOTES);

$pm_updatestatusby1=$fullName;
$pm_updatestatusid1=$uid;
$pm_updatestatusdate1=$dt2;

if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}

//storing attachment
$pathd=$_FILES['attachment1']['name'];
$extd = pathinfo($pathd, PATHINFO_EXTENSION);
$based = pathinfo($pathd, PATHINFO_FILENAME);
$sqlfile57=mysql_query("select * from preventivemaint_reg where id='$autoid'");
while($rowfile47=mysql_fetch_array($sqlfile57))
{
if($based=="")
{
$attachment1=$rowfile47['attachment3'];
}
else
{
$sqlfile=mysql_query("select id from preventivemaint_reg where id='$autoid'");
while($rowfile=mysql_fetch_array($sqlfile))
{
$cmpnfile=$rowfile['id'];
}
$fileno=$cmpnfile;

$dash="_";
$fileformat1="Report".$dash;
$fileformat2=$machine_name.$dash.$machine_code.$dash.$monthvalue.$dash.$year.$dash."Week3".$dash;
$fileformat3=$fileformat1.$fileformat2;
$attachment1= $fileformat3.date("YmdHis.").$extd;
}
}
move_uploaded_file($_FILES["attachment1"]["tmp_name"],"Attachments/Production/Preventive_Maintenance/".$attachment1);


$sql51=mysql_query("update preventivemaint_reg set pmstatus3='$pmstatus1',machinehealth3='$machinehealth1',points3='$points1',verifiedyesno3='$verifiedyesno1',verifiedname3='$verifiedname1',verifieddate3='$verifieddate1',verifieddept3='$verifieddept1',verifiedid3='$verifiedid1',attachment3='$attachment1',pmdoneby3='$pmdoneby1',pmdoneid3='$pmdoneid1',pmdonedept3='$pmdonedept1',pmdonedate3='$pmdonedate1',health_updatedid3='$health_updatedid1',health_updatedate3='$health_updatedate1',health_updatedept3='$health_updatedept1',health_updateby3='$health_updateby1',pm_updatestatus3='$pm_updatestatus1',pm_updatestatusdate3='$pm_updatestatusdate1',pm_updatestatusid3='$pm_updatestatusid1',pm_updatestatusby3='$pm_updatestatusby1' where id='$autoid'");

if($sql51=="")    
{
echo '<script>        
setTimeout(function() {
swal({  
title: "warning",
text: "Something Went Wrong",
type: "warning"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
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
text: "PM Activity for Machine Code : '.$machine_code.' Updated Successfully for Week 3",
type: "success"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
});
}, 1000);
</script>';     
}
}
else
{

} 
?>

<?php  
if(isset($_POST['updateweek4']))
{
$fullName=$_SESSION['fullName'];
$department=$_SESSION['department'];
$uid=$_SESSION['id'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y h:i:s");

$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept_abb=$row11['authority'];

}

$macid=$_POST['macid'];
$week=$_POST['week'];
$mon=$_POST['mon'];
$year=$_POST['year'];
$autoid=$_POST['autoid'];
$machine_code=$_POST['machine_code'];
$machine_name=$_POST['machine_name'];

$pmstatus1=$_POST['pmstatus1'];
$pmstatus1=htmlspecialchars($pmstatus1,ENT_QUOTES);

$pmdoneby1=$fullName;
$pmdoneid1=$uid;
$pmdonedept1=$dept_abb;
$pmdonedate1=$dt2;

$machinehealth1=$_POST['machinehealth1'];
$machinehealth1=htmlspecialchars($machinehealth1,ENT_QUOTES);

$points1=$_POST['points1'];
$points1=htmlspecialchars($points1,ENT_QUOTES);

$verifiedyesno1=$_POST['verifiedyesno1'];
$verifiedyesno1=htmlspecialchars($verifiedyesno1,ENT_QUOTES);

if($verifiedyesno1=="yes")
{
$verifiedname1=$fullName;
$verifieddept1=$dept_abb;
$verifieddate1=$dt2;
$verifiedid1=$uid;
}
else
{
$verifiedname1="";
$verifieddept1="";
$verifieddate1="";
$verifiedid1="";
}

if($machinehealth1!="")
{
$health_updateby1=$fullName;
$health_updatedept1=$dept_abb;
$health_updatedate1=$dt2;
$health_updatedid1=$uid;
}
else
{
$health_updateby1="";
$health_updatedept1="";
$health_updatedate1="";
$health_updatedid1="";
}

$pm_updatestatus1=$_POST['pm_updatestatus1'];
$pm_updatestatus1=htmlspecialchars($pm_updatestatus1,ENT_QUOTES);

$pm_updatestatusby1=$fullName;
$pm_updatestatusid1=$uid;
$pm_updatestatusdate1=$dt2;

if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}

//storing attachment
$pathd=$_FILES['attachment1']['name'];
$extd = pathinfo($pathd, PATHINFO_EXTENSION);
$based = pathinfo($pathd, PATHINFO_FILENAME);
$sqlfile57=mysql_query("select * from preventivemaint_reg where id='$autoid'");
while($rowfile47=mysql_fetch_array($sqlfile57))
{
if($based=="")
{
$attachment1=$rowfile47['attachment4'];
}
else
{
$sqlfile=mysql_query("select id from preventivemaint_reg where id='$autoid'");
while($rowfile=mysql_fetch_array($sqlfile))
{
$cmpnfile=$rowfile['id'];
}
$fileno=$cmpnfile;

$dash="_";
$fileformat1="Report".$dash;
$fileformat2=$machine_name.$dash.$machine_code.$dash.$monthvalue.$dash.$year.$dash."Week4".$dash;
$fileformat3=$fileformat1.$fileformat2;
$attachment1= $fileformat3.date("YmdHis.").$extd;
}
}
move_uploaded_file($_FILES["attachment1"]["tmp_name"],"Attachments/Production/Preventive_Maintenance/".$attachment1);


$sql51=mysql_query("update preventivemaint_reg set pmstatus4='$pmstatus1',machinehealth4='$machinehealth1',points4='$points1',verifiedyesno4='$verifiedyesno1',verifiedname4='$verifiedname1',verifieddate4='$verifieddate1',verifieddept4='$verifieddept1',verifiedid4='$verifiedid1',attachment4='$attachment1',pmdoneby4='$pmdoneby1',pmdoneid4='$pmdoneid1',pmdonedept4='$pmdonedept1',pmdonedate4='$pmdonedate1',health_updatedid4='$health_updatedid1',health_updatedate4='$health_updatedate1',health_updatedept4='$health_updatedept1',health_updateby4='$health_updateby1',pm_updatestatus4='$pm_updatestatus1',pm_updatestatusdate4='$pm_updatestatusdate1',pm_updatestatusid4='$pm_updatestatusid1',pm_updatestatusby4='$pm_updatestatusby1' where id='$autoid'");

if($sql51=="")    
{
echo '<script>        
setTimeout(function() {
swal({  
title: "warning",
text: "Something Went Wrong",
type: "warning"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
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
text: "PM Activity for Machine Code : '.$machine_code.' Updated Successfully for Week 4",
type: "success"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
});
}, 1000);
</script>';     
}
}
else
{

} 
?>

<?php  
if(isset($_POST['updateweek5']))
{
$fullName=$_SESSION['fullName'];
$department=$_SESSION['department'];
$uid=$_SESSION['id'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt2=date("d-m-Y h:i:s");

$departmentid=$_SESSION['departmentid'];
$query11=mysql_query("select * from department where id='$departmentid'");
while($row11=mysql_fetch_array($query11)) 
{
  $dept_abb=$row11['authority'];

}

$macid=$_POST['macid'];
$week=$_POST['week'];
$mon=$_POST['mon'];
$year=$_POST['year'];
$autoid=$_POST['autoid'];
$machine_code=$_POST['machine_code'];
$machine_name=$_POST['machine_name'];

$pmstatus1=$_POST['pmstatus1'];
$pmstatus1=htmlspecialchars($pmstatus1,ENT_QUOTES);

$pmdoneby1=$fullName;
$pmdoneid1=$uid;
$pmdonedept1=$dept_abb;
$pmdonedate1=$dt2;

$machinehealth1=$_POST['machinehealth1'];
$machinehealth1=htmlspecialchars($machinehealth1,ENT_QUOTES);

$points1=$_POST['points1'];
$points1=htmlspecialchars($points1,ENT_QUOTES);

$verifiedyesno1=$_POST['verifiedyesno1'];
$verifiedyesno1=htmlspecialchars($verifiedyesno1,ENT_QUOTES);

if($verifiedyesno1=="yes")
{
$verifiedname1=$fullName;
$verifieddept1=$dept_abb;
$verifieddate1=$dt2;
$verifiedid1=$uid;
}
else
{
$verifiedname1="";
$verifieddept1="";
$verifieddate1="";
$verifiedid1="";
}

if($machinehealth1!="")
{
$health_updateby1=$fullName;
$health_updatedept1=$dept_abb;
$health_updatedate1=$dt2;
$health_updatedid1=$uid;
}
else
{
$health_updateby1="";
$health_updatedept1="";
$health_updatedate1="";
$health_updatedid1="";
}

$pm_updatestatus1=$_POST['pm_updatestatus1'];
$pm_updatestatus1=htmlspecialchars($pm_updatestatus1,ENT_QUOTES);

$pm_updatestatusby1=$fullName;
$pm_updatestatusid1=$uid;
$pm_updatestatusdate1=$dt2;

if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}

//storing attachment
$pathd=$_FILES['attachment1']['name'];
$extd = pathinfo($pathd, PATHINFO_EXTENSION);
$based = pathinfo($pathd, PATHINFO_FILENAME);
$sqlfile57=mysql_query("select * from preventivemaint_reg where id='$autoid'");
while($rowfile47=mysql_fetch_array($sqlfile57))
{
if($based=="")
{
$attachment1=$rowfile47['attachment5'];
}
else
{
$sqlfile=mysql_query("select id from preventivemaint_reg where id='$autoid'");
while($rowfile=mysql_fetch_array($sqlfile))
{
$cmpnfile=$rowfile['id'];
}
$fileno=$cmpnfile;

$dash="_";
$fileformat1="Report".$dash;
$fileformat2=$machine_name.$dash.$machine_code.$dash.$monthvalue.$dash.$year.$dash."Week5".$dash;
$fileformat3=$fileformat1.$fileformat2;
$attachment1= $fileformat3.date("YmdHis.").$extd;
}
}
move_uploaded_file($_FILES["attachment1"]["tmp_name"],"Attachments/Production/Preventive_Maintenance/".$attachment1);


$sql51=mysql_query("update preventivemaint_reg set pmstatus5='$pmstatus1',machinehealth5='$machinehealth1',points5='$points1',verifiedyesno5='$verifiedyesno1',verifiedname5='$verifiedname1',verifieddate5='$verifieddate1',verifieddept5='$verifieddept1',verifiedid5='$verifiedid1',attachment5='$attachment1',pmdoneby5='$pmdoneby1',pmdoneid5='$pmdoneid1',pmdonedept5='$pmdonedept1',pmdonedate5='$pmdonedate1',health_updatedid5='$health_updatedid1',health_updatedate5='$health_updatedate1',health_updatedept5='$health_updatedept1',health_updateby5='$health_updateby1',pm_updatestatus5='$pm_updatestatus1',pm_updatestatusdate5='$pm_updatestatusdate1',pm_updatestatusid5='$pm_updatestatusid1',pm_updatestatusby5='$pm_updatestatusby1' where id='$autoid'");

if($sql51=="")    
{
echo '<script>        
setTimeout(function() {
swal({  
title: "warning",
text: "Something Went Wrong",
type: "warning"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
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
text: "PM Activity for Machine Code : '.$machine_code.' Updated Successfully for Week 5",
type: "success"   
}, 
function() 
{
window.location = "preventivemaint_reg.php?year="+"'.$year.'&month="+"'.$mon.'";
});
}, 1000);
</script>';     
}
}
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
<title>ESM | Preventive Maintenance Calendar</title>
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
.tableFixHead { overflow-y: auto; height: 600px; }
.tableFixHead th{
    position: sticky;
    top: 0;
}

#tabledetails td
{
  border: solid 0.5px black;
  font-size:9px;
  color:black;
  font-weight:500;
  vertical-align: middle;
}
#tabledetails th
{
  border: solid 0.5px white;
  font-size:11px;
  color:white;
  font-weight:500;
  background-color:#0080ff;
  vertical-align: middle;
}
  
/*.table thead th {
    vertical-align: middle;
}*/

/*table th {
position: sticky;
top: 0;
border: 1px solid #C0C0C0;
}

table.floatThead-table {
border-top: none;
border-bottom: none;
background-color: #FFF;
border: solid 0.5px white;
}*/

/*table {
top: 160px;
}*/

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
<h4 class="text-themecolor">Preventive Maintenance Calendar</h4>
</div>
<div class="col-md-7 align-self-center">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
<li class="breadcrumb-item"><a href="preventivemaint_reg.php?year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>">Preventive Maintenance Calendar</a></li>
</ol>
</div> 
</div>
<br>

<!-- end -->
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
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
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_doneby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('regpreventive',$comarr1)))
{  ?>

<?php $query1=mysql_query("select * from master order by id desc limit 1");
while($row1=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i");
if($row1['licend']<= $dt3) 
{ ?>
<li class="nav-item"><a class="nav-link active"  onclick="myFunctionstatus()" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span><span class="hidden-xs-down">Register</span></a></li> 
<?php } 
else
{ ?>
<li class="nav-item"><a class="nav-link active" href="preventivemaint_reg.php?year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> Register &nbsp;<b>
</b></span></a> 
</li>
<?php } 
} 

}else{

} } } ?>

<?php   
$inhousecomarr=$rowacc['preventiveaccess'];
$inhousearr=explode(',',trim( $inhousecomarr));
if(in_array('viewpreventive',$inhousearr))
{ ?>
<?php $query1=mysql_query("select * from master order by id desc limit 1");
while($row1=mysql_fetch_array($query1))
{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$dt3=date("Y-m-d h:i:s");
if($row1['licend']<= $dt3) 
{
?>
<!--view update tab -->
<?php } 
else
{ ?>
<!--view update tab -->
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
<li class="nav-item"> <a class="nav-link"  href="preventivemaint_setting.php" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Settings</span></a> </li>
<?php } } ?>  
</ul>
<!--settings end -->





<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel"> 
<div class="p-20">
<div class="row">
<div class="col-md-12">
<div  style="color:blue;font-size:small;margin-left:88%">
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
$mon=$_GET['month'];

if($mon=="01")
{
$monthvalue="Jan";
}
else if($mon=="02")
{
$monthvalue="Feb";
}
else if($mon=="03")
{
$monthvalue="Mar";
}
else if($mon=="04")
{
$monthvalue="Apr";
}
else if($mon=="05")
{
$monthvalue="May";
}
else if($mon=="06")
{
$monthvalue="Jun";
}
else if($mon=="07")
{
$monthvalue="Jul";
}
else if($mon=="08")
{
$monthvalue="Aug";
}
else if($mon=="09")
{
$monthvalue="Sep";
}
else if($mon=="10")
{
$monthvalue="Oct";
}
else if($mon=="11")
{
$monthvalue="Nov";
}
else if($mon=="12")
{
$monthvalue="Dec";
}
else
{

}
?>
<!--monthly machine planner table start-->  
<div class="container"> 

<form method="post" enctype="multipart/form-data" name="submitdata">


<input type="text" id="mon" value="<?php echo $mon; ?>" style="display:none;">

<input type="text" id="yr" value="<?php echo $yr; ?>" style="display:none;">


<?php
function getStartAndEndDatedemo2($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week,0);
  $ret['week_start'] = $dto->format('d-m-Y');
  $dto->modify('+6 days');
  $ret['week_end'] = $dto->format('d-m-Y');
  return $ret;
}
$week_array1 = getStartAndEndDatedemo2(1,$yr);
$week_array2 = getStartAndEndDatedemo2(2,$yr);
$week_array3 = getStartAndEndDatedemo2(3,$yr);
$week_array4 = getStartAndEndDatedemo2(4,$yr);
$week_array5 = getStartAndEndDatedemo2(5,$yr);
$week_array6 = getStartAndEndDatedemo2(6,$yr);
$week_array7 = getStartAndEndDatedemo2(7,$yr);
$week_array8 = getStartAndEndDatedemo2(8,$yr);
$week_array9 = getStartAndEndDatedemo2(9,$yr);
$week_array10 = getStartAndEndDatedemo2(10,$yr);

$week_array11 = getStartAndEndDatedemo2(11,$yr);
$week_array12 = getStartAndEndDatedemo2(12,$yr);
$week_array13 = getStartAndEndDatedemo2(13,$yr);
$week_array14 = getStartAndEndDatedemo2(14,$yr);
$week_array15 = getStartAndEndDatedemo2(15,$yr);
$week_array16 = getStartAndEndDatedemo2(16,$yr);
$week_array17 = getStartAndEndDatedemo2(17,$yr);
$week_array18 = getStartAndEndDatedemo2(18,$yr);
$week_array19 = getStartAndEndDatedemo2(19,$yr);
$week_array20 = getStartAndEndDatedemo2(20,$yr);

$week_array21 = getStartAndEndDatedemo2(21,$yr);
$week_array22 = getStartAndEndDatedemo2(22,$yr);
$week_array23 = getStartAndEndDatedemo2(23,$yr);
$week_array24 = getStartAndEndDatedemo2(24,$yr);
$week_array25 = getStartAndEndDatedemo2(25,$yr);
$week_array26 = getStartAndEndDatedemo2(26,$yr);
$week_array27 = getStartAndEndDatedemo2(27,$yr);
$week_array28 = getStartAndEndDatedemo2(28,$yr);
$week_array29 = getStartAndEndDatedemo2(29,$yr);
$week_array30 = getStartAndEndDatedemo2(30,$yr);

$week_array31 = getStartAndEndDatedemo2(31,$yr);
$week_array32 = getStartAndEndDatedemo2(32,$yr);
$week_array33 = getStartAndEndDatedemo2(33,$yr);
$week_array34 = getStartAndEndDatedemo2(34,$yr);
$week_array35 = getStartAndEndDatedemo2(35,$yr);
$week_array36 = getStartAndEndDatedemo2(36,$yr);
$week_array37 = getStartAndEndDatedemo2(37,$yr);
$week_array38 = getStartAndEndDatedemo2(38,$yr);
$week_array39 = getStartAndEndDatedemo2(39,$yr);
$week_array40 = getStartAndEndDatedemo2(40,$yr);

$week_array41 = getStartAndEndDatedemo2(41,$yr);
$week_array42 = getStartAndEndDatedemo2(42,$yr);
$week_array43 = getStartAndEndDatedemo2(43,$yr);
$week_array44 = getStartAndEndDatedemo2(44,$yr);
$week_array45 = getStartAndEndDatedemo2(45,$yr);
$week_array46 = getStartAndEndDatedemo2(46,$yr);
$week_array47 = getStartAndEndDatedemo2(47,$yr);
$week_array48 = getStartAndEndDatedemo2(48,$yr);
$week_array49 = getStartAndEndDatedemo2(49,$yr);
$week_array50 = getStartAndEndDatedemo2(50,$yr);

$week_array51 = getStartAndEndDatedemo2(51,$yr);
$week_array52 = getStartAndEndDatedemo2(52,$yr);
$week_array53 = getStartAndEndDatedemo2(53,$yr);

$keyarr1 = array_values($week_array1);
$keyarr2 = array_values($week_array2);
$keyarr3 = array_values($week_array3);
$keyarr4 = array_values($week_array4);
$keyarr5 = array_values($week_array5);
$keyarr6 = array_values($week_array6);
$keyarr7 = array_values($week_array7);
$keyarr8 = array_values($week_array8);
$keyarr9 = array_values($week_array9);
$keyarr10 = array_values($week_array10);

$keyarr11 = array_values($week_array11);
$keyarr12 = array_values($week_array12);
$keyarr13 = array_values($week_array13);
$keyarr14 = array_values($week_array14);
$keyarr15 = array_values($week_array15);
$keyarr16 = array_values($week_array16);
$keyarr17 = array_values($week_array17);
$keyarr18 = array_values($week_array18);
$keyarr19 = array_values($week_array19);
$keyarr20 = array_values($week_array20);

$keyarr21 = array_values($week_array21);
$keyarr22 = array_values($week_array22);
$keyarr23 = array_values($week_array23);
$keyarr24 = array_values($week_array24);
$keyarr25 = array_values($week_array25);
$keyarr26 = array_values($week_array26);
$keyarr27 = array_values($week_array27);
$keyarr28 = array_values($week_array28);
$keyarr29 = array_values($week_array29);
$keyarr30 = array_values($week_array30);

$keyarr31 = array_values($week_array31);
$keyarr32 = array_values($week_array32);
$keyarr33 = array_values($week_array33);
$keyarr34 = array_values($week_array34);
$keyarr35 = array_values($week_array35);
$keyarr36 = array_values($week_array36);
$keyarr37 = array_values($week_array37);
$keyarr38 = array_values($week_array38);
$keyarr39 = array_values($week_array39);
$keyarr40 = array_values($week_array40);

$keyarr41 = array_values($week_array41);
$keyarr42 = array_values($week_array42);
$keyarr43 = array_values($week_array43);
$keyarr44 = array_values($week_array44);
$keyarr45 = array_values($week_array45);
$keyarr46 = array_values($week_array46);
$keyarr47 = array_values($week_array47);
$keyarr48 = array_values($week_array48);
$keyarr49 = array_values($week_array49);
$keyarr50 = array_values($week_array50);

$keyarr51 = array_values($week_array51);
$keyarr52 = array_values($week_array52);
$keyarr53 = array_values($week_array53);

$month = $mon;
$year = $yr;

$beg = (int) date('W', strtotime("first thursday of $year-$month"));
$end = (int) date('W', strtotime("last  thursday of $year-$month"));

$countweeks=range($beg, $end);
//print_r($countweeks);

$weeks1=$keyarr1[0]."  -  ".$keyarr1[1];
$weeks2=$keyarr2[0]."  -  ".$keyarr2[1];
$weeks3=$keyarr3[0]."  -  ".$keyarr3[1];
$weeks4=$keyarr4[0]."  -  ".$keyarr4[1];
$weeks5=$keyarr5[0]."  -  ".$keyarr5[1];

$weeks6=$keyarr6[0]."  -  ".$keyarr6[1];
$weeks7=$keyarr7[0]."  -  ".$keyarr7[1];
$weeks8=$keyarr8[0]."  -  ".$keyarr8[1];
$weeks9=$keyarr9[0]."  -  ".$keyarr9[1];
$weeks10=$keyarr10[0]."  -  ".$keyarr10[1];

$weeks11=$keyarr11[0]."  -  ".$keyarr11[1];
$weeks12=$keyarr12[0]."  -  ".$keyarr12[1];
$weeks13=$keyarr13[0]."  -  ".$keyarr13[1];
$weeks14=$keyarr14[0]."  -  ".$keyarr14[1];
$weeks15=$keyarr15[0]."  -  ".$keyarr15[1];

$weeks16=$keyarr16[0]."  -  ".$keyarr16[1];
$weeks17=$keyarr17[0]."  -  ".$keyarr17[1];
$weeks18=$keyarr18[0]."  -  ".$keyarr18[1];
$weeks19=$keyarr19[0]."  -  ".$keyarr19[1];
$weeks20=$keyarr20[0]."  -  ".$keyarr20[1];

$weeks21=$keyarr21[0]."  -  ".$keyarr21[1];
$weeks22=$keyarr22[0]."  -  ".$keyarr22[1];
$weeks23=$keyarr23[0]."  -  ".$keyarr23[1];
$weeks24=$keyarr24[0]."  -  ".$keyarr24[1];
$weeks25=$keyarr25[0]."  -  ".$keyarr25[1];

$weeks26=$keyarr26[0]."  -  ".$keyarr26[1];
$weeks27=$keyarr27[0]."  -  ".$keyarr27[1];
$weeks28=$keyarr28[0]."  -  ".$keyarr28[1];
$weeks29=$keyarr29[0]."  -  ".$keyarr29[1];
$weeks30=$keyarr30[0]."  -  ".$keyarr30[1];

$weeks31=$keyarr31[0]."  -  ".$keyarr31[1];
$weeks32=$keyarr32[0]."  -  ".$keyarr32[1];
$weeks33=$keyarr33[0]."  -  ".$keyarr33[1];
$weeks34=$keyarr34[0]."  -  ".$keyarr34[1];
$weeks35=$keyarr35[0]."  -  ".$keyarr35[1];

$weeks36=$keyarr36[0]."  -  ".$keyarr36[1];
$weeks37=$keyarr37[0]."  -  ".$keyarr37[1];
$weeks38=$keyarr38[0]."  -  ".$keyarr38[1];
$weeks39=$keyarr39[0]."  -  ".$keyarr39[1];
$weeks40=$keyarr40[0]."  -  ".$keyarr40[1];

$weeks41=$keyarr41[0]."  -  ".$keyarr41[1];
$weeks42=$keyarr42[0]."  -  ".$keyarr42[1];
$weeks43=$keyarr43[0]."  -  ".$keyarr43[1];
$weeks44=$keyarr44[0]."  -  ".$keyarr44[1];
$weeks45=$keyarr45[0]."  -  ".$keyarr45[1];


$weeks46=$keyarr46[0]."  -  ".$keyarr46[1];
$weeks47=$keyarr47[0]."  -  ".$keyarr47[1];
$weeks48=$keyarr48[0]."  -  ".$keyarr48[1];
$weeks49=$keyarr49[0]."  -  ".$keyarr49[1];
$weeks50=$keyarr50[0]."  -  ".$keyarr50[1];

$weeks51=$keyarr51[0]."  -  ".$keyarr51[1];
$weeks52=$keyarr52[0]."  -  ".$keyarr52[1];
$weeks53=$keyarr53[0]."  -  ".$keyarr53[1];

?>


<?php
$values=array_values($countweeks);
if($values[0]==1)
{
$finalweek1=$weeks1;
$weekno="Week 1";
}
if($values[0]==2)
{
$finalweek1=$weeks2;
$weekno="Week 2";
}
if($values[0]==3)
{
$finalweek1=$weeks3;
$weekno="Week 3";
}
if($values[0]==4)
{
$finalweek1=$weeks4;
$weekno="Week 4";
}
else if($values[0]==5)
{
$finalweek1=$weeks5;
$weekno="Week 5";
}
else if($values[0]==6)
{
$finalweek1=$weeks6;
$weekno="Week 6";
}
else if($values[0]==7)
{
$finalweek1=$weeks7;
$weekno="Week 7";
}
else if($values[0]==8)
{
$finalweek1=$weeks8;
$weekno="Week 8";
}
else if($values[0]==9)
{
$finalweek1=$weeks9;
$weekno="Week 9";
}
else if($values[0]==10)
{
$finalweek1=$weeks10;
$weekno="Week 10";
}
else if($values[0]==11)
{
$finalweek1=$weeks11;
$weekno="Week 11";
}
else if($values[0]==12)
{
$finalweek1=$weeks12;
$weekno="Week 12";
}
else if($values[0]==13)
{
$finalweek1=$weeks13;
$weekno="Week 13";
}
else if($values[0]==14)
{
$finalweek1=$weeks14;
$weekno="Week 14";
}
else if($values[0]==15)
{
$finalweek1=$weeks15;
$weekno="Week 15";
}
else if($values[0]==16)
{
$finalweek1=$weeks16;
$weekno="Week 16";
}
else if($values[0]==17)
{
$finalweek1=$weeks17;
$weekno="Week 17";
}
else if($values[0]==18)
{
$finalweek1=$weeks18;
$weekno="Week 18";
}
else if($values[0]==19)
{
$finalweek1=$weeks19;
$weekno="Week 19";
}
else if($values[0]==20)
{
$finalweek1=$weeks20;
$weekno="Week 20";
}
else if($values[0]==21)
{
$finalweek1=$weeks21;
$weekno="Week 21";
}
else if($values[0]==22)
{
$finalweek1=$weeks22;
$weekno="Week 22";
}
else if($values[0]==23)
{
$finalweek1=$weeks23;
$weekno="Week 23";
}
else if($values[0]==24)
{
$finalweek1=$weeks24;
$weekno="Week 24";
}
else if($values[0]==25)
{
$finalweek1=$weeks25;
$weekno="Week 25";
}
else if($values[0]==26)
{
$finalweek1=$weeks26;
$weekno="Week 26";
}
else if($values[0]==27)
{
$finalweek1=$weeks27;
$weekno="Week 27";
}
else if($values[0]==28)
{
$finalweek1=$weeks28;
$weekno="Week 28";
}
else if($values[0]==29)
{
$finalweek1=$weeks29;
$weekno="Week 29";
}
else if($values[0]==30)
{
$finalweek1=$weeks30;
$weekno="Week 30";
}
else if($values[0]==31)
{
$finalweek1=$weeks31;
$weekno="Week 31";
}
else if($values[0]==32)
{
$finalweek1=$weeks32;
$weekno="Week 32";
}
else if($values[0]==33)
{
$finalweek1=$weeks33;
$weekno="Week 33";
}
else if($values[0]==34)
{
$finalweek1=$weeks34;
$weekno="Week 34";
}
else if($values[0]==35)
{
$finalweek1=$weeks35;
$weekno="Week 35";
}
else if($values[0]==36)
{
$finalweek1=$weeks36;
$weekno="Week 36";
}
else if($values[0]==37)
{
$finalweek1=$weeks37;
$weekno="Week 37";
}
else if($values[0]==38)
{
$finalweek1=$weeks38;
$weekno="Week 38";
}
else if($values[0]==39)
{
$finalweek1=$weeks39;
$weekno="Week 39";
}
else if($values[0]==40)
{
$finalweek1=$weeks40;
$weekno="Week 40";
}
else if($values[0]==41)
{
$finalweek1=$weeks41;
$weekno="Week 41";
}
else if($values[0]==42)
{
$finalweek1=$weeks42;
$weekno="Week 42";
}
else if($values[0]==43)
{
$finalweek1=$weeks43;
$weekno="Week 43";
}
else if($values[0]==44)
{
$finalweek1=$weeks44;
$weekno="Week 44";
}
else if($values[0]==45)
{
$finalweek1=$weeks45;
$weekno="Week 45";
}
else if($values[0]==46)
{
$finalweek1=$weeks46;
$weekno="Week 46";
}
else if($values[0]==47)
{
$finalweek1=$weeks47;
$weekno="Week 47";
}
else if($values[0]==48)
{
$finalweek1=$weeks48;
$weekno="Week 48";
}
else if($values[0]==49)
{
$finalweek1=$weeks49;
$weekno="Week 49";
}
else if($values[0]==50)
{
$finalweek1=$weeks50;
$weekno="Week 50";
}
else if($values[0]==51)
{
$finalweek1=$weeks51;
$weekno="Week 51";
}
else if($values[0]==52)
{
$finalweek1=$weeks52;
$weekno="Week 52";
}
else if($values[0]==53)
{
$finalweek1=$weeks53;
$weekno="Week 53";
}
?>

<?php
$values=array_values($countweeks);
if($values[1]==1)
{
$finalweek2=$weeks1;
$weekno2="Week 1";
}
if($values[1]==2)
{
$finalweek2=$weeks2;
$weekno2="Week 2";
}
if($values[1]==3)
{
$finalweek2=$weeks3;
$weekno2="Week 3";
}
if($values[1]==4)
{
$finalweek2=$weeks4;
$weekno2="Week 4";
}
else if($values[1]==5)
{
$finalweek2=$weeks5;
$weekno2="Week 5";
}
else if($values[1]==6)
{
$finalweek2=$weeks6;
$weekno2="Week 6";
}
else if($values[1]==7)
{
$finalweek2=$weeks7;
$weekno2="Week 7";
}
else if($values[1]==8)
{
$finalweek2=$weeks8;
$weekno2="Week 8";
}
else if($values[1]==9)
{
$finalweek2=$weeks9;
$weekno2="Week 9";
}
else if($values[1]==10)
{
$finalweek2=$weeks10;
$weekno2="Week 10";
}
else if($values[1]==11)
{
$finalweek2=$weeks11;
$weekno2="Week 11";
}
else if($values[1]==12)
{
$finalweek2=$weeks12;
$weekno2="Week 12";
}
else if($values[1]==13)
{
$finalweek2=$weeks13;
$weekno2="Week 13";
}
else if($values[1]==14)
{
$finalweek2=$weeks14;
$weekno2="Week 14";
}
else if($values[1]==15)
{
$finalweek2=$weeks15;
$weekno2="Week 15";
}
else if($values[1]==16)
{
$finalweek2=$weeks16;
$weekno2="Week 16";
}
else if($values[1]==17)
{
$finalweek2=$weeks17;
$weekno2="Week 17";
}
else if($values[1]==18)
{
$finalweek2=$weeks18;
$weekno2="Week 18";
}
else if($values[1]==19)
{
$finalweek2=$weeks19;
$weekno2="Week 19";
}
else if($values[1]==20)
{
$finalweek2=$weeks20;
$weekno2="Week 20";
}
else if($values[1]==21)
{
$finalweek2=$weeks21;
$weekno2="Week 21";
}
else if($values[1]==22)
{
$finalweek2=$weeks22;
$weekno2="Week 21";
}
else if($values[1]==23)
{
$finalweek2=$weeks23;
$weekno2="Week 23";
}
else if($values[1]==24)
{
$finalweek2=$weeks24;
$weekno2="Week 24";
}
else if($values[1]==25)
{
$finalweek2=$weeks25;
$weekno2="Week 25";
}
else if($values[1]==26)
{
$finalweek2=$weeks26;
$weekno2="Week 26";
}
else if($values[1]==27)
{
$finalweek2=$weeks27;
$weekno2="Week 27";
}
else if($values[1]==28)
{
$finalweek2=$weeks28;
$weekno2="Week 28";
}
else if($values[1]==29)
{
$finalweek2=$weeks29;
$weekno2="Week 29";
}
else if($values[1]==30)
{
$finalweek2=$weeks30;
$weekno2="Week 30";
}
else if($values[1]==31)
{
$finalweek2=$weeks31;
$weekno2="Week 31";
}
else if($values[1]==32)
{
$finalweek2=$weeks32;
$weekno2="Week 32";
}
else if($values[1]==33)
{
$finalweek2=$weeks33;
$weekno2="Week 33";
}
else if($values[1]==34)
{
$finalweek2=$weeks34;
$weekno2="Week 34";
}
else if($values[1]==35)
{
$finalweek2=$weeks35;
$weekno2="Week 35";
}
else if($values[1]==36)
{
$finalweek2=$weeks36;
$weekno2="Week 36";
}
else if($values[1]==37)
{
$finalweek2=$weeks37;
$weekno2="Week 37";
}
else if($values[1]==38)
{
$finalweek2=$weeks38;
$weekno2="Week 38";
}
else if($values[1]==39)
{
$finalweek2=$weeks39;
$weekno2="Week 39";
}
else if($values[1]==40)
{
$finalweek2=$weeks40;
$weekno2="Week 40";
}
else if($values[1]==41)
{
$finalweek2=$weeks41;
$weekno2="Week 41";
}
else if($values[1]==42)
{
$finalweek2=$weeks42;
$weekno2="Week 42";
}
else if($values[1]==43)
{
$finalweek2=$weeks43;
$weekno2="Week 43";
}
else if($values[1]==44)
{
$finalweek2=$weeks44;
$weekno2="Week 44";
}
else if($values[1]==45)
{
$finalweek2=$weeks45;
$weekno2="Week 45";
}
else if($values[1]==46)
{
$finalweek2=$weeks46;
$weekno2="Week 46";
}
else if($values[1]==47)
{
$finalweek2=$weeks47;
$weekno2="Week 47";
}
else if($values[1]==48)
{
$finalweek2=$weeks48;
$weekno2="Week 48";
}
else if($values[1]==49)
{
$finalweek2=$weeks49;
$weekno2="Week 49";
}
else if($values[1]==50)
{
$finalweek2=$weeks50;
$weekno2="Week 50";
}
else if($values[1]==51)
{
$finalweek2=$weeks51;
$weekno2="Week 51";
}
else if($values[1]==52)
{
$finalweek2=$weeks52;
$weekno2="Week 52";
}
else if($values[1]==53)
{
$finalweek2=$weeks53;
$weekno2="Week 53";
}

?> 

<?php
$values=array_values($countweeks);
if($values[2]==1)
{
$finalweek3=$weeks1;
$weekno3="Week 1";
}
if($values[2]==2)
{
$finalweek3=$weeks2;
$weekno3="Week 2";
}
if($values[2]==3)
{
$finalweek3=$weeks3;
$weekno3="Week 3";
}
if($values[2]==4)
{
$finalweek3=$weeks4;
$weekno3="Week 4";
}
else if($values[2]==5)
{
$finalweek3=$weeks5;
$weekno3="Week 5";
}
else if($values[2]==6)
{
$finalweek3=$weeks6;
$weekno3="Week 6";
}
else if($values[2]==7)
{
$finalweek3=$weeks7;
$weekno3="Week 7";
}
else if($values[2]==8)
{
$finalweek3=$weeks8;
$weekno3="Week 8";
}
else if($values[2]==9)
{
$finalweek3=$weeks9;
$weekno3="Week 9";
}
else if($values[2]==10)
{
$finalweek3=$weeks10;
$weekno3="Week 10";
}
else if($values[2]==11)
{
$finalweek3=$weeks11;
$weekno3="Week 11";
}
else if($values[2]==12)
{
$finalweek3=$weeks12;
$weekno3="Week 12";
}
else if($values[2]==13)
{
$finalweek3=$weeks13;
$weekno3="Week 13";
}
else if($values[2]==14)
{
$finalweek3=$weeks14;
$weekno3="Week 14";
}
else if($values[2]==15)
{
$finalweek3=$weeks15;
$weekno3="Week 15";
}
else if($values[2]==16)
{
$finalweek3=$weeks16;
$weekno3="Week 16";
}
else if($values[2]==17)
{
$finalweek3=$weeks17;
$weekno3="Week 17";
}
else if($values[2]==18)
{
$finalweek3=$weeks18;
$weekno3="Week 18";
}
else if($values[2]==19)
{
$finalweek3=$weeks19;
$weekno3="Week 19";
}
else if($values[2]==20)
{
$finalweek3=$weeks20;
$weekno3="Week 20";
}
else if($values[2]==21)
{
$finalweek3=$weeks21;
$weekno3="Week 21";
}
else if($values[2]==22)
{
$finalweek3=$weeks22;
$weekno3="Week 22";
}
else if($values[2]==23)
{
$finalweek3=$weeks23;
$weekno3="Week 23";
}
else if($values[2]==24)
{
$finalweek3=$weeks24;
$weekno3="Week 24";
}
else if($values[2]==25)
{
$finalweek3=$weeks25;
$weekno3="Week 25";
}
else if($values[2]==26)
{
$finalweek3=$weeks26;
$weekno3="Week 26";
}
else if($values[2]==27)
{
$finalweek3=$weeks27;
$weekno3="Week 27";
}
else if($values[2]==28)
{
$finalweek3=$weeks28;
$weekno3="Week 28";
}
else if($values[2]==29)
{
$finalweek3=$weeks29;
$weekno3="Week 29";
}
else if($values[2]==30)
{
$finalweek3=$weeks30;
$weekno3="Week 30";
}
else if($values[2]==31)
{
$finalweek3=$weeks31;
$weekno3="Week 31";
}
else if($values[2]==32)
{
$finalweek3=$weeks32;
$weekno3="Week 32";
}
else if($values[2]==33)
{
$finalweek3=$weeks33;
$weekno3="Week 33";
}
else if($values[2]==34)
{
$finalweek3=$weeks34;
$weekno3="Week 34";
}
else if($values[2]==35)
{
$finalweek3=$weeks35;
$weekno3="Week 35";
}
else if($values[2]==36)
{
$finalweek3=$weeks36;
$weekno3="Week 36";
}
else if($values[2]==37)
{
$finalweek3=$weeks37;
$weekno3="Week 37";
}
else if($values[2]==38)
{
$finalweek3=$weeks38;
$weekno3="Week 38";
}
else if($values[2]==39)
{
$finalweek3=$weeks39;
$weekno3="Week 39";
}
else if($values[2]==40)
{
$finalweek3=$weeks40;
$weekno3="Week 40";
}
else if($values[2]==41)
{
$finalweek3=$weeks41;
$weekno3="Week 41";
}
else if($values[2]==42)
{
$finalweek3=$weeks42;
$weekno3="Week 42";
}
else if($values[2]==43)
{
$finalweek3=$weeks43;
$weekno3="Week 43";
}
else if($values[2]==44)
{
$finalweek3=$weeks44;
$weekno3="Week 44";
}
else if($values[2]==45)
{
$finalweek3=$weeks45;
$weekno3="Week 45";
}
else if($values[2]==46)
{
$finalweek3=$weeks46;
$weekno3="Week 46";
}
else if($values[2]==47)
{
$finalweek3=$weeks47;
$weekno3="Week 47";
}
else if($values[2]==48)
{
$finalweek3=$weeks48;
$weekno3="Week 48";
}
else if($values[2]==49)
{
$finalweek3=$weeks49;
$weekno3="Week 49";
}
else if($values[2]==50)
{
$finalweek3=$weeks50;
$weekno3="Week 50";
}
else if($values[2]==51)
{
$finalweek3=$weeks51;
$weekno3="Week 51";
}
else if($values[2]==52)
{
$finalweek3=$weeks52;
$weekno3="Week 52";
}
else if($values[2]==53)
{
$finalweek3=$weeks53;
$weekno3="Week 53";
}
?>

<?php
$values=array_values($countweeks);
if($values[3]==1)
{
$finalweek4=$weeks1;
$weekno4="Week 1";
}
if($values[3]==2)
{
$finalweek4=$weeks2;
$weekno4="Week 2";
}
if($values[3]==3)
{
$finalweek4=$weeks3;
$weekno4="Week 3";
}
if($values[3]==4)
{
$finalweek4=$weeks4;
$weekno4="Week 4";
}
else if($values[3]==5)
{
$finalweek4=$weeks5;
$weekno4="Week 5";
}
else if($values[3]==6)
{
$finalweek4=$weeks6;
$weekno4="Week 6";
}
else if($values[3]==7)
{
$finalweek4=$weeks7;
$weekno4="Week 7";
}
else if($values[3]==8)
{
$finalweek4=$weeks8;
$weekno4="Week 8";
}
else if($values[3]==9)
{
$finalweek4=$weeks9;
$weekno4="Week 9";
}
else if($values[3]==10)
{
$finalweek4=$weeks10;
$weekno4="Week 10";
}
else if($values[3]==11)
{
$finalweek4=$weeks11;
$weekno4="Week 11";
}
else if($values[3]==12)
{
$finalweek4=$weeks12;
$weekno4="Week 12";
}
else if($values[3]==13)
{
$finalweek4=$weeks13;
$weekno4="Week 13";
}
else if($values[3]==14)
{
$finalweek4=$weeks14;
$weekno4="Week 14";
}
else if($values[3]==15)
{
$finalweek4=$weeks15;
$weekno4="Week 15";
}
else if($values[3]==16)
{
$finalweek4=$weeks16;
$weekno4="Week 16";
}
else if($values[3]==17)
{
$finalweek4=$weeks17;
$weekno4="Week 17";
}
else if($values[3]==18)
{
$finalweek4=$weeks18;
$weekno4="Week 18";
}
else if($values[3]==19)
{
$finalweek4=$weeks19;
$weekno4="Week 19";
}
else if($values[3]==20)
{
$finalweek4=$weeks20;
$weekno4="Week 20";
}
else if($values[3]==21)
{
$finalweek4=$weeks21;
$weekno4="Week 21";
}
else if($values[3]==22)
{
$finalweek4=$weeks22;
$weekno4="Week 22";
}
else if($values[3]==23)
{
$finalweek4=$weeks23;
$weekno4="Week 23";
}
else if($values[3]==24)
{
$finalweek4=$weeks24;
$weekno4="Week 24";
}
else if($values[3]==25)
{
$finalweek4=$weeks25;
$weekno4="Week 25";
}
else if($values[3]==26)
{
$finalweek4=$weeks26;
$weekno4="Week 26";
}
else if($values[3]==27)
{
$finalweek4=$weeks27;
$weekno4="Week 27";
}
else if($values[3]==28)
{
$finalweek4=$weeks28;
$weekno4="Week 28";
}
else if($values[3]==29)
{
$finalweek4=$weeks29;
$weekno4="Week 29";
}
else if($values[3]==30)
{
$finalweek4=$weeks30;
$weekno4="Week 30";
}
else if($values[3]==31)
{
$finalweek4=$weeks31;
$weekno4="Week 31";
}
else if($values[3]==32)
{
$finalweek4=$weeks32;
$weekno4="Week 32";
}
else if($values[3]==33)
{
$finalweek4=$weeks33;
$weekno4="Week 33";
}
else if($values[3]==34)
{
$finalweek4=$weeks34;
$weekno4="Week 34";
}
else if($values[3]==35)
{
$finalweek4=$weeks35;
$weekno4="Week 35";
}
else if($values[3]==36)
{
$finalweek4=$weeks36;
$weekno4="Week 36";
}
else if($values[3]==37)
{
$finalweek4=$weeks37;
$weekno4="Week 37";
}
else if($values[3]==38)
{
$finalweek4=$weeks38;
$weekno4="Week 38";
}
else if($values[3]==39)
{
$finalweek4=$weeks39;
$weekno4="Week 39";
}
else if($values[3]==40)
{
$finalweek4=$weeks40;
$weekno4="Week 40";
}
else if($values[3]==41)
{
$finalweek4=$weeks41;
$weekno4="Week 41";
}
else if($values[3]==42)
{
$finalweek4=$weeks42;
$weekno4="Week 42";
}
else if($values[3]==43)
{
$finalweek4=$weeks43;
$weekno4="Week 43";
}
else if($values[3]==44)
{
$finalweek4=$weeks44;
$weekno4="Week 44";
}
else if($values[3]==45)
{
$finalweek4=$weeks45;
$weekno4="Week 45";
}
else if($values[3]==46)
{
$finalweek4=$weeks46;
$weekno4="Week 46";
}
else if($values[3]==47)
{
$finalweek4=$weeks47;
$weekno4="Week 47";
}
else if($values[3]==48)
{
$finalweek4=$weeks48;
$weekno4="Week 48";
}
else if($values[3]==49)
{
$finalweek4=$weeks49;
$weekno4="Week 49";
}
else if($values[3]==50)
{
$finalweek4=$weeks50;
$weekno4="Week 50";
}
else if($values[3]==51)
{
$finalweek4=$weeks51;
$weekno4="Week 51";
}
else if($values[3]==52)
{
$finalweek4=$weeks52;
$weekno4="Week 52";
}
else if($values[3]==53)
{
$finalweek4=$weeks53;
$weekno4="Week 53";
}
?>

<?php
$values=array_values($countweeks);
if($values[4]==1)
{
$finalweek5=$weeks1;
$weekno5="Week 1";
}
if($values[4]==2)
{
$finalweek5=$weeks2;
$weekno5="Week 2";
}
if($values[4]==3)
{
$finalweek5=$weeks3;
$weekno5="Week 3";
}
if($values[4]==4)
{
$finalweek5=$weeks4;
$weekno5="Week 4";
}
else if($values[4]==5)
{
$finalweek5=$weeks5;
$weekno5="Week 5";
}
else if($values[4]==6)
{
$finalweek5=$weeks6;
$weekno5="Week 6";
}
else if($values[4]==7)
{
$finalweek5=$weeks7;
$weekno5="Week 7";
}
else if($values[4]==8)
{
$finalweek5=$weeks8;
$weekno5="Week 8";
}
else if($values[4]==9)
{
$finalweek5=$weeks9;
$weekno5="Week 9";
}
else if($values[4]==10)
{
$finalweek5=$weeks10;
$weekno5="Week 10";
}
else if($values[4]==11)
{
$finalweek5=$weeks11;
$weekno5="Week 11";
}
else if($values[4]==12)
{
$finalweek5=$weeks12;
$weekno5="Week 12";
}
else if($values[4]==13)
{
$finalweek5=$weeks13;
$weekno5="Week 13";
}
else if($values[4]==14)
{
$finalweek5=$weeks14;
$weekno5="Week 14";
}
else if($values[4]==15)
{
$finalweek5=$weeks15;
$weekno5="Week 15";
}
else if($values[4]==16)
{
$finalweek5=$weeks16;
$weekno5="Week 16";
}
else if($values[4]==17)
{
$finalweek5=$weeks17;
$weekno5="Week 17";
}
else if($values[4]==18)
{
$finalweek5=$weeks18;
$weekno5="Week 18";
}
else if($values[4]==19)
{
$finalweek5=$weeks19;
$weekno5="Week 19";
}
else if($values[4]==20)
{
$finalweek5=$weeks20;
$weekno5="Week 20";
}
else if($values[4]==21)
{
$finalweek5=$weeks21;
$weekno5="Week 21";
}
else if($values[4]==22)
{
$finalweek5=$weeks22;
$weekno5="Week 22";
}
else if($values[4]==23)
{
$finalweek5=$weeks23;
$weekno5="Week 23";
}
else if($values[4]==24)
{
$finalweek5=$weeks24;
$weekno5="Week 24";
}
else if($values[4]==25)
{
$finalweek5=$weeks25;
$weekno5="Week 25";
}
else if($values[4]==26)
{
$finalweek5=$weeks26;
$weekno5="Week 26";
}
else if($values[4]==27)
{
$finalweek5=$weeks27;
$weekno5="Week 27";
}
else if($values[4]==28)
{
$finalweek5=$weeks28;
$weekno5="Week 28";
}
else if($values[4]==29)
{
$finalweek5=$weeks29;
$weekno5="Week 29";
}
else if($values[4]==30)
{
$finalweek5=$weeks30;
$weekno5="Week 30";
}
else if($values[4]==31)
{
$finalweek5=$weeks31;
$weekno5="Week 31";
}
else if($values[4]==32)
{
$finalweek5=$weeks32;
$weekno5="Week 32";
}
else if($values[4]==33)
{
$finalweek5=$weeks33;
$weekno5="Week 33";
}
else if($values[4]==34)
{
$finalweek5=$weeks34;
$weekno5="Week 34";
}
else if($values[4]==35)
{
$finalweek5=$weeks35;
$weekno5="Week 35";
}
else if($values[4]==36)
{
$finalweek5=$weeks36;
$weekno5="Week 36";
}
else if($values[4]==37)
{
$finalweek5=$weeks37;
$weekno5="Week 37";
}
else if($values[4]==38)
{
$finalweek5=$weeks38;
$weekno5="Week 38";
}
else if($values[4]==39)
{
$finalweek5=$weeks39;
$weekno5="Week 39";
}
else if($values[4]==40)
{
$finalweek5=$weeks40;
$weekno5="Week 40";
}
else if($values[4]==41)
{
$finalweek5=$weeks41;
$weekno5="Week 41";
}
else if($values[4]==42)
{
$finalweek5=$weeks42;
$weekno5="Week 42";
}
else if($values[4]==43)
{
$finalweek5=$weeks43;
$weekno5="Week 43";
}
else if($values[4]==44)
{
$finalweek5=$weeks44;
$weekno5="Week 44";
}
else if($values[4]==45)
{
$finalweek5=$weeks45;
$weekno5="Week 45";
}
else if($values[4]==46)
{
$finalweek5=$weeks46;
$weekno5="Week 46";
}
else if($values[4]==47)
{
$finalweek5=$weeks47;
$weekno5="Week 47";
}
else if($values[4]==48)
{
$finalweek5=$weeks48;
$weekno5="Week 48";
}
else if($values[4]==49)
{
$finalweek5=$weeks49;
$weekno5="Week 49";
}
else if($values[4]==50)
{
$finalweek5=$weeks50;
$weekno5="Week 50";
}
else if($values[4]==51)
{
$finalweek5=$weeks51;
$weekno5="Week 51";
}
else if($values[4]==52)
{
$finalweek5=$weeks52;
$weekno5="Week 52";
}
else if($values[4]==53)
{
$finalweek5=$weeks53;
$weekno5="Week 53";
}
?>
<?php

$values=array_values($countweeks);
if($values[5]==1)
{
$finalweek5=$weeks1;
}
if($values[5]==2)
{
$finalweek5=$weeks2;
}
if($values[5]==3)
{
$finalweek5=$weeks3;
}
if($values[5]==4)
{
$finalweek5=$weeks4;
}
else if($values[5]==5)
{
$finalweek5=$weeks5;
}
else if($values[5]==6)
{
$finalweek5=$weeks6;
}
else if($values[5]==7)
{
$finalweek5=$weeks7;
}
else if($values[5]==8)
{
$finalweek5=$weeks8;
}
else if($values[5]==9)
{
$finalweek5=$weeks9;
}
else if($values[5]==10)
{
$finalweek5=$weeks10;
}
else if($values[5]==11)
{
$finalweek5=$weeks11;
}
else if($values[5]==12)
{
$finalweek5=$weeks12;
}
else if($values[5]==13)
{
$finalweek5=$weeks13;
}
else if($values[5]==14)
{
$finalweek5=$weeks14;
}
else if($values[5]==15)
{
$finalweek5=$weeks15;
}
else if($values[5]==16)
{
$finalweek5=$weeks16;
}
else if($values[5]==17)
{
$finalweek5=$weeks17;
}
else if($values[5]==18)
{
$finalweek5=$weeks18;
}
else if($values[5]==19)
{
$finalweek5=$weeks19;
}
else if($values[5]==20)
{
$finalweek5=$weeks20;
}
else if($values[5]==21)
{
$finalweek5=$weeks21;
}
else if($values[5]==22)
{
$finalweek5=$weeks22;
}
else if($values[5]==23)
{
$finalweek5=$weeks23;
}
else if($values[5]==24)
{
$finalweek5=$weeks24;
}
else if($values[5]==25)
{
$finalweek5=$weeks25;
}
else if($values[5]==26)
{
$finalweek5=$weeks26;
}
else if($values[5]==27)
{
$finalweek5=$weeks27;
}
else if($values[5]==28)
{
$finalweek5=$weeks28;
}
else if($values[5]==29)
{
$finalweek5=$weeks29;
}
else if($values[5]==30)
{
$finalweek5=$weeks30;
}
else if($values[5]==31)
{
$finalweek5=$weeks31;
}
else if($values[5]==32)
{
$finalweek5=$weeks32;
}
else if($values[5]==33)
{
$finalweek5=$weeks33;
}
else if($values[5]==34)
{
$finalweek5=$weeks34;
}
else if($values[5]==35)
{
$finalweek5=$weeks35;
}
else if($values[5]==36)
{
$finalweek5=$weeks36;
}
else if($values[5]==37)
{
$finalweek5=$weeks37;
}
else if($values[5]==38)
{
$finalweek5=$weeks38;
}
else if($values[5]==39)
{
$finalweek5=$weeks39;
}
else if($values[5]==40)
{
$finalweek5=$weeks41;
}
else if($values[5]==42)
{
$finalweek5=$weeks42;
}
else if($values[5]==43)
{
$finalweek5=$weeks43;
}
else if($values[5]==44)
{
$finalweek5=$weeks44;
}
else if($values[5]==45)
{
$finalweek5=$weeks45;
}
else if($values[5]==46)
{
$finalweek5=$weeks46;
}
else if($values[5]==47)
{
$finalweek5=$weeks47;
}
else if($values[5]==48)
{
$finalweek5=$weeks48;
}
else if($values[5]==49)
{
$finalweek5=$weeks49;
}
else if($values[5]==50)
{
$finalweek5=$weeks50;
}
else if($values[5]==51)
{
$finalweek5=$weeks51;
}
else if($values[5]==52)
{
$finalweek5=$weeks52;
}
else if($values[5]==53)
{
$finalweek5=$weeks53;
}
?>


<?php
//fetching date to display it when print is taken
$pdfdate=date("YmdHis");
?>


<?php 
//fetching company details
$querycom=mysql_query("select * from company order by id desc limit 1");
while($rowcompany=mysql_fetch_array($querycom)) 
{
$companyname=$rowcompany['name'];
$address1=$rowcompany['address1'];
$address2=$rowcompany['address2'];
$address3=$rowcompany['address3'];
$city=$rowcompany['city'];
$state=$rowcompany['state'];
$country=$rowcompany['country'];
$pincode=$rowcompany['pincode'];
$logo=$rowcompany['logo'];
$gstno=$rowcompany['gstno'];
$bankname=$rowcompany['bankname'];
$branch=$rowcompany['branch'];
$accno=$rowcompany['accno'];
$ifsc=$rowcompany['ifsc'];
$micr=$rowcompany['micr'];
}
?> 

<input type="text" id="pdfdate" value="<?php echo $pdfdate; ?>" style="display:none;">
<input type="text" id="pdfmonth" value="<?php echo $monthvalue; ?>" style="display:none;">


<?php   
$queryde = mysql_query("SELECT * FROM preventivemaint_setting");
$numberde=mysql_num_rows($queryde);
if ( $numberde== '0' ) 
{ ?>   
<br> <br>
<h6 style="font-weight:500;">To view the Preventive Maintenance Calendar please Go to Settings and set the Department for Preventive Maintenance or Contact to Admin</h6>

<?php }

else
{ ?>

<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>Select Year</label>
<select class="form-control" id="DigitalBush" name="year">
<option value="<?php echo $_GET['year']; ?>"><?php echo $_GET['year']; ?></option>
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
<div class="col-md-2">
<div class="form-group">
<label>Select Month</label>
<select class="form-control" name="month">
<option value="<?php echo $_GET['month']; ?>"><?php echo $monthvalue; ?></option>
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>
</div>
</div>

<div class="col-md-2" style="margin-top:24px;">
<div class="form-group">
<label></label>
 <input type="submit" class="btn btn-primary" name="machineadd" value="GO">
</div>
</div>

<div class="col-sm-4" style="margin-top:10px;margin-left:140px;">
<a id="reportprint3" target="_blank" style="font-size:30px;"><button type="submit" class="btn btn-default btn-outline" style="margin-top:7px;"><span class="text-muted"><i class="fa fa-print"></i>&nbsp;Print</span></button></a>
&nbsp;&nbsp;&nbsp;

<a style="font-size:16px;color:grey;font-weight:400;" class="text-muted" href="preventivemaint_exportdb.php?year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>"><i class="fa fa-table"></i>&nbsp;&nbsp;Export</a>
&nbsp;&nbsp;&nbsp;

<a style="font-size:16px;color:grey;font-weight:400;" class="text-muted" href="preventivemaint_exportdball.php"><i class="fa fa-database"></i>&nbsp;&nbsp;Export All</a>
</div>
</div>


<?php
$querydd =mysql_query("SELECT * FROM preventivemaint_reg where planyear='$yr' AND month='$mon' limit 1");
while($rowdd=mysql_fetch_array($querydd))
{  ?>

<div id="printreport"> 
<div class="firstheader" style="display:none;">
<table class="table table-sm">
<tr>
<td style="width:200px;border:none;text-align:left;vertical-align:middle;">
<img style='width:75px;height:60px;' src='complaintdocs/<?php echo htmlentities($logo);?>'>
</td>
<td style="width:900px;border:none;vertical-align:middle;text-align:center;">
<div style="margin-left:40px;">
<label style="color:black;font-weight:600;font-size:20px;margin-left:10px;margin-top:0px;"><?php echo htmlspecialchars_decode($companyname); ?></label><br>
<label style="color:black;font-weight:400;">GSTIN : <?php echo $gstno; ?></label>
</div>
</td>
<td style="text-align:right;width:350px;font-weight:400;color:black;font-size:12px;border:none;">
<?php echo $address1; ?>,<?php echo $address2; ?>,<br><?php echo $address3; ?>,<br>
<?php echo $city; ?>&nbsp;-&nbsp;<?php echo $pincode; ?><br>
<?php echo $state; ?>,&nbsp;<?php echo $country; ?><br>
</td>
</tr>
</table>
</div>

<br>

<div class="row">
<div class="col-md-12">
<h4 style="font-family:Poppins;color:black;font-weight:500;">Preventive Maintenance Calendar for <?php echo $monthvalue; ?> <?php echo $yr; ?></h4>
</div>
</div>


<div class="tableFixHead">
<table class="table table-sm myTable" id="tabledetails">
<thead>	
<tr style="background-color: #0080ff;color: white;border-color:white;text-align:center;">
<th style="width:120px;border-bottom:solid 2px black;">
<span style="font-size:11px;">Machine Code</span><br>
<span style="font-size:9px;">[Machine Name]</span><br>
<span style="font-size:9px;">[Location]</span><br>
<span style="font-size:9px;">[Installation Date]</span>
</th>
<th style="width:150px;font-size:11px;border-bottom:solid 2px black;">Activity</th>
<th style="width:180px;font-size:11px;border-bottom:solid 2px black;">
<?php echo $weekno; ?> <br>
<span style="font-size:10px;"><?php echo $finalweek1; ?></span>
</th>
<th style="width:180px;font-size:11px;border-bottom:solid 2px black;">
<?php echo $weekno2; ?>
<br>
<span style="font-size:10px;"><?php echo $finalweek2; ?></span>
</th>
<th style="width:180px;font-size:11px;border-bottom:solid 2px black;">
<?php echo $weekno3; ?>
<br>
<span style="font-size:10px;"><?php echo $finalweek3; ?></span>
</th>
<th style="width:180px;font-size:11px;border-bottom:solid 2px black;">
<?php echo $weekno4; ?>
	<br>
<span style="font-size:10px;"><?php echo $finalweek4; ?></span>
</th>
<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<th style="width:180px;font-size:11px;border-bottom:solid 2px black;">
<?php echo $weekno5; ?>
	<br>
<span style="font-size:10px;"><?php echo $finalweek5; ?></span>
</th>
<?php } ?>
</tr>
</thead>
<?php } ?>

<tbody>
<?php
$querydept1 =mysql_query("SELECT * FROM preventivemaint_reg where planyear='$yr' AND month='$mon' AND machine_status='1'");
while($row=mysql_fetch_array($querydept1))
{  
$autoid=$row['id'];
$machine_id=$row['machine_id'];
 ?>
<!-- <input type="text" name="planmonth" id="mon<?php echo $row['id'];?>" value="01" style="display:none;"> -->
<input type="text" name="planyear" id="yr<?php echo $row['id'];?>" value="<?php echo $yr;?>" style="display:none;">
<!-- <input type="text" name="machinecode" id="code<?php echo $row['id'];?>" value="<?php echo $row['machine_code'];?>" style="display:none;">
<input type="text" name="machineid" id="macid<?php echo $row['id'];?>" value="<?php echo $row['machine_id'];?>" style="display:none;">  -->

<input type="text" name="mcplanid" id="mcplanid<?php echo $row['id'];?>" value="<?php echo $row['id'];?>" style="display:none;">
<!--machine code-->  

<tr>
<td style="text-align:left;border-bottom:solid 2px black;" rowspan="7">
<?php echo $row['machine_code']; ?><br>
[<?php echo $row['machine_name']; ?>]<br>

<?php 
$machine_location=$row['machine_location'];
if($row['machine_location']=="")
{
  echo "[Unknown]";
}
else
{
  echo "[$machine_location]"; 
}
?>
<br>
<?php 
$querymc=mysql_query("SELECT * FROM machine where id='$machine_id'");
while($rowmc=mysql_fetch_array($querymc)) 
{ 
$yearofin=$rowmc['year_install'];
echo "[$yearofin]";
}
?>

</td>
</tr>
<tr>
<td style="text-align:left;">PM Planning / Status
</td>


<td>
<?php 
if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Done"))
{
echo'<span style="font-size:11px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:#008b00;font-size:11px;font-weight:800;">' ." Done".'</span>';
}
else if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Not Done"))
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:red;font-size:10px;font-weight:500;">' ." Not Done".'</span>';
}
else if($row['pmstatus1']=="")
{
echo'<span style="color:#104e8b;font-size:10px;font-weight:500;">' ."TBD".'</span>';
}
else if($row['pmstatus1']=="Not Applicable")
{
echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Applicable".'</span>';
}
else if($row['pmstatus1']=="Planned")
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
}

?>


<a href="preventivemaint_week1.php?macid=<?php echo $row['machine_id'];?>&week=<?php echo "1";?>&mon=<?php echo htmlentities($mon);?>&year=<?php echo htmlentities($yr);?>&autoid=<?php echo htmlentities($autoid);?>&sessionid=<?php echo htmlentities($_SESSION['id']);?>" class='li-modal' data-toggle="tooltip" title="Edit Activity">
<i class="fa fa-pencil" style="color:blueviolet"></i></a>

<!-- check access for which users can delete the PM activity-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_verifiedby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('takeactionpreventive',$comarr1)))
{  ?>
<button type="button" class="deletedetails1" value="<?php echo $autoid;?>" data-toggle="tooltip" data-original-title="Delete all activity details" style="font-size:20px;background-color:white;color:white;border:white;padding: 0px;"><i class="mdi mdi-delete" style="color:indianred;font-size:12px;"></i></button>

<?php } } } } ?>
<!--take action end -->
</td>
<div id="theModal" class="modal fade text-center">
<div class="modal-dialog">
<div class="modal-content">
</div>
</div>
</div>


<td>
<?php 
if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Done"))
{
echo'<span style="font-size:11px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:#008b00;font-size:11px;font-weight:800;">' ." Done".'</span>';
}
else if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Not Done"))
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:red;font-size:10px;font-weight:500;">' ." Not Done".'</span>';
}
else if($row['pmstatus2']=="")
{
echo'<span style="color:#104e8b;font-size:10px;font-weight:500;">' ."TBD".'</span>';
}
else if($row['pmstatus2']=="Not Applicable")
{
echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Applicable".'</span>';
}
else if($row['pmstatus2']=="Planned")
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
}
?>

<a href="preventivemaint_week2.php?macid=<?php echo $row['machine_id'];?>&week=<?php echo "2";?>&mon=<?php echo htmlentities($mon);?>&year=<?php echo htmlentities($yr);?>&autoid=<?php echo htmlentities($autoid);?>&sessionid=<?php echo htmlentities($_SESSION['id']);?>" class='li-modal' data-toggle="tooltip" title="Edit Activity">
<i class="fa fa-pencil" style="color:blueviolet"></i></a>

<!-- check access for which users can delete the PM activity-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_verifiedby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('takeactionpreventive',$comarr1)))
{  ?>
<button type="button" class="deletedetails2" value="<?php echo $autoid;?>" data-toggle="tooltip" data-original-title="Delete all activity details" style="font-size:20px;background-color:white;color:white;border:white;padding: 0px;"><i class="mdi mdi-delete" style="color:indianred;font-size:12px;"></i></button>

<?php } } } } ?>
<!--take action end -->



</td>

<td>
<?php 
if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Done"))
{
echo'<span style="font-size:11px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:#008b00;font-size:11px;font-weight:800;">' ." Done".'</span>';
}
else if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Not Done"))
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:red;font-size:10px;font-weight:500;">' ." Not Done".'</span>';
}
else if($row['pmstatus3']=="")
{
echo'<span style="color:#104e8b;font-size:10px;font-weight:500;">' ."TBD".'</span>';
}
else if($row['pmstatus3']=="Not Applicable")
{
echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Applicable".'</span>';
}
else if($row['pmstatus3']=="Planned")
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
}
?>

<a href="preventivemaint_week3.php?macid=<?php echo $row['machine_id'];?>&week=<?php echo "2";?>&mon=<?php echo htmlentities($mon);?>&year=<?php echo htmlentities($yr);?>&autoid=<?php echo htmlentities($autoid);?>&sessionid=<?php echo htmlentities($_SESSION['id']);?>" class='li-modal' data-toggle="tooltip" title="Edit Activity">
<i class="fa fa-pencil" style="color:blueviolet"></i></a>

<!-- check access for which users can delete the PM activity-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_verifiedby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('takeactionpreventive',$comarr1)))
{  ?>
<button type="button" class="deletedetails3" value="<?php echo $autoid;?>" data-toggle="tooltip" data-original-title="Delete all activity details" style="font-size:20px;background-color:white;color:white;border:white;padding: 0px;"><i class="mdi mdi-delete" style="color:indianred;font-size:12px;"></i></button>

<?php } } } } ?>
<!--take action end -->

</td>

<td>
<?php 
if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Done"))
{
echo'<span style="font-size:11px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:#008b00;font-size:11px;font-weight:800;">' ." Done".'</span>';
}
else if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Not Done"))
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:red;font-size:10px;font-weight:500;">' ." Not Done".'</span>';
}
else if($row['pmstatus4']=="")
{
echo'<span style="color:#104e8b;font-size:10px;font-weight:500;">' ."TBD".'</span>';
}
else if($row['pmstatus4']=="Not Applicable")
{
echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Applicable".'</span>';
}
else if($row['pmstatus4']=="Planned")
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
}
?>

<a href="preventivemaint_week4.php?macid=<?php echo $row['machine_id'];?>&week=<?php echo "2";?>&mon=<?php echo htmlentities($mon);?>&year=<?php echo htmlentities($yr);?>&autoid=<?php echo htmlentities($autoid);?>&sessionid=<?php echo htmlentities($_SESSION['id']);?>" class='li-modal' data-toggle="tooltip" title="Edit Activity">
<i class="fa fa-pencil" style="color:blueviolet"></i></a>

<!-- check access for which users can delete the PM activity-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_verifiedby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('takeactionpreventive',$comarr1)))
{  ?>
<button type="button" class="deletedetails4" value="<?php echo $autoid;?>" data-toggle="tooltip" data-original-title="Delete all activity details" style="font-size:20px;background-color:white;color:white;border:white;padding: 0px;"><i class="mdi mdi-delete" style="color:indianred;font-size:12px;"></i></button>

<?php } } } } ?>
<!--take action end -->

</td>


<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<td>
<?php 
if(($values[4]!="")||($values[5]!=""))
{

if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Done"))
{
echo'<span style="font-size:11px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:#008b00;font-size:11px;font-weight:800;">' ." Done".'</span>';
}
else if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Not Done"))
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
echo "/";
echo'<span style="color:red;font-size:10px;font-weight:500;">' ." Not Done".'</span>';
}
else if($row['pmstatus5']=="")
{
echo'<span style="color:#104e8b;font-size:10px;font-weight:500;">' ."TBD".'</span>';
}
else if($row['pmstatus5']=="Not Applicable")
{
echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Applicable".'</span>';
}
else if($row['pmstatus5']=="Planned")
{
echo'<span style="font-size:10px;font-weight:500;">' ."Planned ".'</span>';
}

}
else
{
echo'<div style="color:red;font-size:10px;font-weight:500;background-color:#b3b3b3;height:20px;">' ."".'</div>';
}
?>

<?php
if(($values[4]!="")||($values[5]!=""))
{
?>
<a href="preventivemaint_week5.php?macid=<?php echo $row['machine_id'];?>&week=<?php echo "2";?>&mon=<?php echo htmlentities($mon);?>&year=<?php echo htmlentities($yr);?>&autoid=<?php echo htmlentities($autoid);?>&sessionid=<?php echo htmlentities($_SESSION['id']);?>" class='li-modal' data-toggle="tooltip" title="Edit Activity">
<i class="fa fa-pencil" style="color:blueviolet"></i></a>

<!-- check access for which users can delete the PM activity-->
<?php 
$queryacc=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($rowacc=mysql_fetch_array($queryacc)) 
{
?> 
<?php
$query21=mysql_query("select * from users where id='".$_SESSION['id']."'");
while($row21=mysql_fetch_array($query21)) 
{  
$complaintarr1=$row21['preventiveaccess'];
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
$querydays1=mysql_query("select * from preventivemaint_setting order by id desc limit 1");
while($rowdays1=mysql_fetch_array($querydays1)) 
{ 
$quadept1=$rowdays1['pm_verifiedby'];
$qua1=explode(',',trim($quadept1));
$result1 = array_intersect($secarr1,$qua1);
if((($result1!=array())||(in_array($row21['department'],$qua1))) && (in_array('takeactionpreventive',$comarr1)))
{  ?>
<button type="button" class="deletedetails5" value="<?php echo $autoid;?>" data-toggle="tooltip" data-original-title="Delete all activity details" style="font-size:20px;background-color:white;color:white;border:white;padding: 0px;"><i class="mdi mdi-delete" style="color:indianred;font-size:12px;"></i></button>

<?php } } } } ?>
<!--take action end -->

<?php } ?>
</td>
<?php } ?> <!--if week exists closing -->


</tr>
<tr>
<td style="text-align:left;">Machine Health</td>
<?php
if(($row['pmstatus1']=="Not Applicable")||($row['pm_updatestatus1']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:500;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Not Done"))
{?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:500;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else
{
if($row['machinehealth1']=="Good")
{ ?>
<td style="background-color:#66cd00;color:white;"><?php echo $row['machinehealth1']; ?></td>
<?php }
else if($row['machinehealth1']=="OK with Observation")
{ ?>
<td style="background-color:#f5e431;color:black;"><?php echo $row['machinehealth1']; ?></td>
<?php }
else if($row['machinehealth1']=="Need Attention")
{ ?>
<td style="background-color:#F38330;color:white;"><?php echo $row['machinehealth1']; ?></td>
<?php }
else if($row['machinehealth1']=="Under Breakdown")
{ ?>
<td style="background-color:#ff0000;color:white;"><?php echo $row['machinehealth1']; ?></td>
<?php } 
else if($row['machinehealth1']=="")
{ ?>
<td></td>
<?php } } ?>

<?php
if(($row['pmstatus2']=="Not Applicable")||($row['pm_updatestatus2']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else
{
if($row['machinehealth2']=="Good")
{ ?>
<td style="background-color:#66cd00;color:white;"><?php echo $row['machinehealth2']; ?></td>
<?php }
else if($row['machinehealth2']=="OK with Observation")
{ ?>
<td style="background-color:#f5e431;color:black;"><?php echo $row['machinehealth2']; ?></td>
<?php }
else if($row['machinehealth2']=="Need Attention")
{ ?>
<td style="background-color:#F38330;color:white;"><?php echo $row['machinehealth2']; ?></td>
<?php }
else if($row['machinehealth2']=="Under Breakdown")
{ ?>
<td style="background-color:#ff0000;color:white;"><?php echo $row['machinehealth2']; ?></td>
<?php } 
else if($row['machinehealth2']=="")
{ ?>
<td></td>
<?php } } ?>

<?php
if(($row['pmstatus3']=="Not Applicable")||($row['pm_updatestatus3']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else
{
if($row['machinehealth3']=="Good")
{ ?>
<td style="background-color:#66cd00;color:white;"><?php echo $row['machinehealth3']; ?></td>
<?php }
else if($row['machinehealth3']=="OK with Observation")
{ ?>
<td style="background-color:#f5e431;color:black;"><?php echo $row['machinehealth3']; ?></td>
<?php }
else if($row['machinehealth3']=="Need Attention")
{ ?>
<td style="background-color:#F38330;color:white;"><?php echo $row['machinehealth3']; ?></td>
<?php }
else if($row['machinehealth3']=="Under Breakdown")
{ ?>
<td style="background-color:#ff0000;color:white;"><?php echo $row['machinehealth3']; ?></td>
<?php } 
else if($row['machinehealth3']=="")
{ ?>
<td></td>
<?php } } ?>

<?php
if(($row['pmstatus4']=="Not Applicable")||($row['pm_updatestatus4']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else
{
if($row['machinehealth4']=="Good")
{ ?>
<td style="background-color:#66cd00;color:white;"><?php echo $row['machinehealth4']; ?></td>
<?php }
else if($row['machinehealth4']=="OK with Observation")
{ ?>
<td style="background-color:#f5e431;color:black;"><?php echo $row['machinehealth4']; ?></td>
<?php }
else if($row['machinehealth4']=="Need Attention")
{ ?>
<td style="background-color:#F38330;color:white;"><?php echo $row['machinehealth4']; ?></td>
<?php }
else if($row['machinehealth4']=="Under Breakdown")
{ ?>
<td style="background-color:#ff0000;color:white;"><?php echo $row['machinehealth4']; ?></td>
<?php } 
else if($row['machinehealth4']=="")
{ ?>
<td></td>
<?php } } ?>

<?php
if(($values[4]!="")||($values[5]!=""))
{

if(($row['pmstatus5']=="Not Applicable")||($row['pm_updatestatus5']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Not Done"))
{ ?>
<td><?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?></td>
<?php }
else
{
if($row['machinehealth5']=="Good")
{ ?>
<td style="background-color:#66cd00;color:white;"><?php echo $row['machinehealth5']; ?></td>
<?php }
else if($row['machinehealth5']=="OK with Observation")
{ ?>
<td style="background-color:#f5e431;color:black;"><?php echo $row['machinehealth5']; ?></td>
<?php }
else if($row['machinehealth5']=="Need Attention")
{ ?>
<td style="background-color:#F38330;color:white;"><?php echo $row['machinehealth5']; ?></td>
<?php }
else if($row['machinehealth5']=="Under Breakdown")
{ ?>
<td style="background-color:#ff0000;color:white;"><?php echo $row['machinehealth5']; ?></td>
<?php } 
else if($row['machinehealth5']=="")
{ ?>
<td></td>
<?php } } }
else
{ ?>

<?php } ?>
</tr>



<tr>
<td style="text-align:left;">Points Noticed</td>
<td style="text-align:justify;">
<?php 
 echo htmlspecialchars_decode($row['points1']);
?>
</td>

<td style="text-align:justify;">
<?php 
 echo htmlspecialchars_decode($row['points2']); 
?>
</td>

<td style="text-align:justify;">
<?php  
 echo htmlspecialchars_decode($row['points3']);
?>
</td>

<td style="text-align:justify;">
<?php 
 echo htmlspecialchars_decode($row['points4']);
?>
</td>


<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<td style="text-align:justify;">
<?php
if(($values[4]!="")||($values[5]!=""))
{ 
 echo htmlspecialchars_decode($row['points5']);
}
else
{
echo'<div style="color:red;font-size:10px;font-weight:500;background-color:#b3b3b3;height:20px;">' ."".'</div>';
}
?>
</td>
<?php } ?><!--if week exits closing -->

</tr>


<!--verified dept start -->
<tr>
<td style="text-align:left;">Verified by [ Dept ]</td>
<td>
<?php 
if(($row['pmstatus1']=="Not Applicable")||($row['pm_updatestatus1']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedyesno1']=="yes")
{
$verifieddept1=$row['verifieddept1'];
echo $row['verifiedname1']." "; 
echo "[$verifieddept1]";
}
else if(($row['pmstatus1']!="")||($row['machinehealth1']!="")||($row['points1']!=""))
{
  echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Checked".'</span>';
}
} 
?>
</td>


<td>
<?php 
if(($row['pmstatus2']=="Not Applicable")||($row['pm_updatestatus2']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedyesno2']=="yes")
{
$verifieddept2=$row['verifieddept2'];
echo $row['verifiedname2']." "; 
echo "[$verifieddept2]";
}
else if(($row['pmstatus2']!="")||($row['machinehealth2']!="")||($row['points2']!=""))
{
  echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Checked".'</span>';
}
} 
?>
</td>


<td>
<?php 
if(($row['pmstatus3']=="Not Applicable")||($row['pm_updatestatus3']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{  
if($row['verifiedyesno3']=="yes")
{
$verifieddept3=$row['verifieddept3'];
echo $row['verifiedname3']." "; 
echo "[$verifieddept3]";
}
else if(($row['pmstatus3']!="")||($row['machinehealth3']!="")||($row['points3']!=""))
{
  echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Checked".'</span>';
}
} ?>
</td>

<td>
<?php 
if(($row['pmstatus4']=="Not Applicable")||($row['pm_updatestatus4']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedyesno4']=="yes")
{
$verifieddept4=$row['verifieddept4'];
echo $row['verifiedname4']." "; 
echo "[$verifieddept4]";
}
else if(($row['pmstatus4']!="")||($row['machinehealth4']!="")||($row['points4']!=""))
{
  echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Checked".'</span>';
}
} ?>
</td>


<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<td>
<?php
if(($values[4]!="")||($values[5]!=""))
{
if(($row['pmstatus5']=="Not Applicable")||($row['pm_updatestatus5']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedyesno5']=="yes")
{
$verifieddept5=$row['verifieddept5'];
echo $row['verifiedname5']." "; 
echo "[$verifieddept5]";
}
else if(($row['pmstatus5']!="")||($row['machinehealth5']!="")||($row['points5']!=""))
{
  echo'<span style="color:red;font-size:10px;font-weight:500;">' ."Not Checked".'</span>';
}
} 
}
else
{ 
echo'<div style="color:red;font-size:10px;font-weight:500;background-color:#b3b3b3;height:20px;">' ."".'</div>';
}
?>
</td>
<?php } ?> <!--if week exists closing -->

</tr>
<tr>
<td class="verified" style="text-align:left;">Verified On</td>
<td>
<?php 
if(($row['pmstatus1']=="Not Applicable")||($row['pm_updatestatus1']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedname1']!="")
{
echo $row['verifieddate1']; 
}
} 
?>
</td>

<td>
<?php 
if(($row['pmstatus2']=="Not Applicable")||($row['pm_updatestatus2']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedname2']!="")
{
echo $row['verifieddate2']; 
}
} 
?>
</td>

<td>
<?php 
if(($row['pmstatus3']=="Not Applicable")||($row['pm_updatestatus3']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedname3']!="")
{
echo $row['verifieddate3']; 
}
} 
?>
</td>

<td>
<?php 
if(($row['pmstatus4']=="Not Applicable")||($row['pm_updatestatus4']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedname4']!="")
{
echo $row['verifieddate4']; 
}
} 
?>
</td>


<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<td>
<?php 
if(($values[4]!="")||($values[5]!=""))
{
if(($row['pmstatus5']=="Not Applicable")||($row['pm_updatestatus5']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Not Done"))
{ 
echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>';
}
else
{ 
if($row['verifiedname5']!="")
{
echo $row['verifieddate5']; 
}
} 
}
else
{
echo'<div style="color:red;font-size:10px;font-weight:500;background-color:#b3b3b3;height:20px;">' ."".'</div>';	
}
?>
</td>
<?php } ?><!--if week exists closing -->


</tr>
<tr>
<td class="hidetd" style="text-align:left;border-bottom:solid 2px black;">Attachment</td>

<td class="hidetd" style="border-bottom:solid 2px black;">
<?php 
if(($row['pmstatus1']=="Not Applicable")||($row['pm_updatestatus1']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else if(($row['pmstatus1']=="Planned")&&($row['pm_updatestatus1']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else
{ ?>
<?php 
$cfile1=$row['attachment1'];
if($row['pmstatus1']!="")
{
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span>File Not Attached</span>
<?php }
else
{ ?>
<span class="fileattach" style="display:none;">File Attached</span>	
<?php 
$cfile2=pathinfo($row['attachment1']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment1']);?>" target="_blank">View Report</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile"> 
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment1']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment1']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment1']);?>" target="_blank">View Report</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment1']);?>" target="_blank">View Report</a>
</div>
<?php } } } } ?>
</td>

<td class="hidetd" style="border-bottom:solid 2px black;">
<?php 
if(($row['pmstatus2']=="Not Applicable")||($row['pm_updatestatus2']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else if(($row['pmstatus2']=="Planned")&&($row['pm_updatestatus2']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else
{ ?>

<?php 
$cfile1=$row['attachment2'];
if($row['pmstatus2']!="")
{
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span>File Not Attached</span>
<?php }
else
{ ?>
<span class="fileattach" style="display:none;">File Attached</span>	
<?php 
$cfile2=pathinfo($row['attachment2']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment2']);?>" target="_blank">View Report</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile"> 
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment2']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment2']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment2']);?>" target="_blank">View Report</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment2']);?>" target="_blank">View Report</a>
</div>
<?php } } } }?>
</td>


<td class="hidetd" style="border-bottom:solid 2px black;">
<?php 
if(($row['pmstatus3']=="Not Applicable")||($row['pm_updatestatus3']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else if(($row['pmstatus3']=="Planned")&&($row['pm_updatestatus3']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else
{ ?>
<?php 
$cfile1=$row['attachment3'];
if($row['pmstatus3']!="")
{
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span>File Not Attached</span>
<?php }
else
{ ?>
<span class="fileattach" style="display:none;">File Attached</span>	
<?php 
$cfile2=pathinfo($row['attachment3']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment3']);?>" target="_blank">View Report</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile"> 
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment3']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment3']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment3']);?>" target="_blank">View Report</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment3']);?>" target="_blank">View Report</a>
</div>
<?php } } } }?>
</td>

<td class="hidetd" style="border-bottom:solid 2px black;">
<?php 
if(($row['pmstatus4']=="Not Applicable")||($row['pm_updatestatus4']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else if(($row['pmstatus4']=="Planned")&&($row['pm_updatestatus4']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else
{ ?>
<?php 
$cfile1=$row['attachment4'];
if($row['pmstatus4']!="")
{
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span>File Not Attached</span>
<?php }
else
{ ?>
<span class="fileattach" style="display:none;">File Attached</span>	
<?php 
$cfile2=pathinfo($row['attachment4']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment4']);?>" target="_blank">View Report</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile"> 
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment4']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment4']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment4']);?>" target="_blank">View Report</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment4']);?>" target="_blank">View Report</a>
</div>
<?php } } } }?>
</td>


<?php
if(($values[4]!="")||($values[5]!=""))
{ ?>
<td class="hidetd" style="border-bottom:solid 2px black;">
<?php
if(($values[4]!="")||($values[5]!=""))
{ 
if(($row['pmstatus5']=="Not Applicable")||($row['pm_updatestatus5']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else if(($row['pmstatus5']=="Planned")&&($row['pm_updatestatus5']=="Not Done"))
{ ?>
<?php echo'<div style="color:white;font-size:10px;font-weight:400;background-color:grey;height:18px;text-align:center;">' ."Not Applicable".'</div>'; ?>
<?php }
else
{ ?>
<?php 
$cfile1=$row['attachment5'];
if($row['pmstatus5']!="")
{
if($cfile1=="NULL" || $cfile1=="default.png" || $cfile1=="")
{ ?>
<span>File Not Attached</span>
<?php }
else
{ ?>
<span class="fileattach" style="display:none;">File Attached</span>	
<?php 
$cfile2=pathinfo($row['attachment5']);
$cfile2['extension'];
$cool_extensions = Array('doc','docx','DOCX','DOC');
$cool_extensions1 = Array('pdf','PDF');
$cool_extensions2=Array('xls','xlsx','XLS','XLSX');
$cool_extensions3=Array('jpg','png','jpeg','JPG','JPEG','PNG');
if (in_array($cfile2['extension'], $cool_extensions))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment5']);?>" target="_blank">View Report</a>
</div>
<?php
}
else if(in_array($cfile2['extension'], $cool_extensions1))
{ ?>
<div class="viewfile"> 
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment5']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions2))
{ ?>
<div class="viewfile">
&nbsp;<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment5']);?>" target="_blank">View Report</a>
</div>
<?php }
else if(in_array($cfile2['extension'], $cool_extensions3))
{
?> 
<div class="viewfile"> 
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment5']);?>" target="_blank">View Report</a>
</div>
<?php 
}else{ ?>
<div class="viewfile">
<a href="Attachments/Production/Preventive_Maintenance/<?php echo htmlentities($row['attachment5']);?>" target="_blank">View Report</a>
</div>
<?php } }  } } }
else
{ ?>
<?php echo'<div style="color:red;font-size:10px;font-weight:500;background-color:#b3b3b3;height:20px;">' ."".'</div>'; ?>
<?php } ?>
</td>
<?php } ?><!--if week exists closing -->

</tr>

<?php } ?><!--end of $row while loop -->

<?php } ?>
</tbody>
</table>
</div>
<?php 
$setting=mysql_query("select * from preventivemaint_setting");
while($rowset=mysql_fetch_array($setting))
{ 
$isonoreg=$rowset['isonoreg'];
$isorevnoreg=$rowset['isorevnoreg'];
?>
<hr style="background-color:lightgray">
<div class="row">
<label style="color:black;font-family:'Poppins',sans-serif;margin-left:15px;"></label><span style="color:black;font-weight:bold;font-family:'Poppins',sans-serif"><?php echo htmlspecialchars_decode($rowset['isonoreg']);?></span>
<label style="color:black;font-family:'Poppins',sans-serif">&nbsp;|&nbsp;Rev. No.</label>&nbsp;<span style="color:black;font-weight:bold;font-family:'Poppins',sans-serif"><?php echo htmlspecialchars_decode($rowset['isorevnoreg']);?></span>
</div>
<?php  } ?>

</div>

<br><br>

</form> 
</div>




</div><!--  monthlyplanner container end -->

</div> 
</div> <!--p-20 container end -->
</div><!-- /tab-pane -->
</div> <!-- /content-panel -->
</div><!-- /col-lg-4 -->     
</div><!-- /row -->       
</div></div></div>

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

<!-- script for Fixed Header scroll NavBar-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/2.2.1/jquery.floatThead.js"></script> -->


<script>
$('.li-modal').on('click', function(e){
e.preventDefault();
$('#theModal').modal('show').find('.modal-content').load($(this).attr('href'));
});
</script>


<script>
$('.deletedetails1').click(function() {
currLoc = $(this).val(); 
var month=document.getElementById('mon').value;
var year=document.getElementById('yr').value;
swal({
title: "You want to delete this complete Activity ?",
text: "If deleted, All activity data will be permanently lost",
type: "warning",
showCancelButton: true,
confirmButtonColor: "Green",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {

window.location.href ="preventivemaint_delete1.php?id="+currLoc+"&year="+year+"&mon="+month;

} else {
swal("Your Activity data is safe !", "", "success");
}
});
});
</script>

<script>
$('.deletedetails2').click(function() {
currLoc = $(this).val(); 
var month=document.getElementById('mon').value;
var year=document.getElementById('yr').value;
swal({
title: "You want to delete this complete Activity ?",
text: "If deleted, All activity data will be permanently lost",
type: "warning",
showCancelButton: true,
confirmButtonColor: "Green",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {

window.location.href ="preventivemaint_delete2.php?id="+currLoc+"&year="+year+"&mon="+month;

} else {
swal("Your Activity data is safe !", "", "success");
}
});
});
</script>

<script>
$('.deletedetails3').click(function() {
currLoc = $(this).val(); 
var month=document.getElementById('mon').value;
var year=document.getElementById('yr').value;
swal({
title: "You want to delete this complete Activity ?",
text: "If deleted, All activity data will be permanently lost",
type: "warning",
showCancelButton: true,
confirmButtonColor: "Green",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {

window.location.href ="preventivemaint_delete3.php?id="+currLoc+"&year="+year+"&mon="+month;

} else {
swal("Your Activity data is safe !", "", "success");
}
});
});
</script>

<script>
$('.deletedetails4').click(function() {
currLoc = $(this).val(); 
var month=document.getElementById('mon').value;
var year=document.getElementById('yr').value;
swal({
title: "You want to delete this complete Activity ?",
text: "If deleted, All activity data will be permanently lost",
type: "warning",
showCancelButton: true,
confirmButtonColor: "Green",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {

window.location.href ="preventivemaint_delete4.php?id="+currLoc+"&year="+year+"&mon="+month;

} else {
swal("Your Activity data is safe !", "", "success");
}
});
});
</script>

<script>
$('.deletedetails5').click(function() {
currLoc = $(this).val(); 
var month=document.getElementById('mon').value;
var year=document.getElementById('yr').value;
swal({
title: "You want to delete this complete Activity ?",
text: "If deleted, All activity data will be permanently lost",
type: "warning",
showCancelButton: true,
confirmButtonColor: "Green",
confirmButtonText: "Yes",
cancelButtonText: "No",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {

window.location.href ="preventivemaint_delete5.php?id="+currLoc+"&year="+year+"&mon="+month;

} else {
swal("Your Activity data is safe !", "", "success");
}
});


});
</script>



<!-- only print -->
<script>
$('#reportprint3').click(function(){

var children = $('#printreport tr.child').length;
var visibleChildren = $('#printreport tr.child:visible').length;

var style = "<style>";
style = style + "footer {page-break-after: always;}";

style = style + "table {font-family:'Poppins',sans-serif;}";
style = style + "div.viewfile{ display:none;}";
style = style + "table, th, td {border-collapse:collapse;padding:2px 3px;}";
style = style + "#tabledetails td{border:solid 0.5px black;font-size:9px;color:black;font-weight:500;}";
style = style + "#tabledetails th{border: solid 0.5px white;font-size:11px;color:white;font-weight:500;}";

// style = style + ".myTable thead th{vertical-align: middle;}";
// style = style + ".myTable th{position: sticky;top: 0;border: 1px solid #C0C0C0;}";
// style = style + ".myTable.floatThead-table{border-top: none;border-bottom: none;background-color: #FFF;border: solid 0.5px white;}";


// style = style + "td.hidetd{ display:none;}";

style = style + "</style>";

var pdfdate = document.getElementById("pdfdate").value;
var mon = document.getElementById("pdfmonth").value;
var yr = document.getElementById("yr").value;

$('.fileattach').show(); 
$('.firstheader').show(); 
var divToPrint=document.getElementById("printreport");
var win = window.open('', '', 'height=900,width=1200');


win.document.write('<html><head>');
win.document.write('<title> Preventive_Maintenance.'+'_'+mon+yr+'_'+pdfdate+'</title>');
win.document.write(style); 
win.document.write('</head>');
win.document.write('<body>');
win.document.write(divToPrint.outerHTML);
win.document.write('</body></html>');


win.print();
win.close();  // AUTO CLOSE THE CURRENT WINDOW.
location.reload();
$('#printreport tr.child').hide();  
});
</script>


<!-- <script src="assets/plugins/jquery-floatthread/2.2.1/jquery.floatThead.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("table").floatThead({
  top: $(".topbar").height()
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
