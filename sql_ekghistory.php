<?php 
header('Content-Type: application/json;charset=TIS-620');
// Create connection
$servername = "192.168.xx.xx";
$username = "root";
$password = "";
$dbname = "ekg";

// POST Variable

$hn = sprintf("%07s",$_POST['hn']);
$output['message'] = '';


// function
function thaidate($date2){

	$thaimonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$date1 	= substr($date2, 8,2);
	$month	= substr($date2, 5,2);
	$year	= substr($date2, 0,4) + 543;

	return $date1.' '.$thaimonth[$month-1].' '.$year;

}



$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset( $conn, 'utf8');
$sql 	= "SELECT * FROM ekg.pb_ekg a WHERE a.hn = '".$hn."' ORDER BY a.create_at DESC";
$sql2 	= "SELECT pttitle,ptfname,ptlname,CONCAT(YEAR(FROM_DAYS(DATEDIFF(NOW(),ptdob))),' ปี ',MONTH(FROM_DAYS(DATEDIFF(NOW(),ptdob))),'เดือน') AS age FROM pt.pt WHERE hn = '".$hn."'";

$result 			= $conn->query($sql);
$query_patien_name	= $conn->query($sql2);

$row_patien = mysqli_fetch_array($query_patien_name);
if ($query_patien_name->num_rows > 0) {
	$output['name'] = $row_patien['pttitle'].$row_patien['ptfname'].' '.$row_patien['ptlname'].' อายุ '.$row_patien['age'];  // เรียกเฉพาะชื่ออายุ
}else{
	$output['name'] = 'ไม่พบ HN';
}

if ($result->num_rows > 0) {

	$output['status']	= 1;
	$i = 0;
	while($row = $result->fetch_array())
	{	
		if ($i == 0) { // ดึงค่าเริ่มต้น
			$output['last_ekg'] = $row['filename'];
		}
		$output['message'] .= '<li class="nav-item border-bottom" data-file="'.$row['filename'].'">
            <a class="nav-link';

        // เซ็ตค่าเริ่มต้นให้ตัวแรกแอคทีฟ แสดงสีน้ำเงินบนข้อความ
        if ($i == 0) {
        	$output['message'] .= ' active';
        }
        else {
        	$output['message'] .= '';
        }

        $output['message'] .= '">'.thaidate($row['create_at']).'</a>
          </li>';
        $i++;
	}
}
else
{
	$output['status']	= 0;
	$output['message']	.= '<span class="p-3" style="color:crimson;">ไม่มีประวัติ EKG</span>';
}
$conn->close();

// $output['name'] = $rows;

echo json_encode($output);
?>