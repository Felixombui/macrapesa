<?php
include 'headers.php';
//view all payments
set_time_limit(0);
$Transdate=date('d-m-Y');
$qry=mysqli_query($config,"SELECT * FROM mpesa_payments WHERE TransDate='$Transdate' ORDER BY id DESC");
if(isset($_POST['find'])){
    $searchtext=addslashes($_POST['search']);
    $qry=mysqli_query($config,"SELECT * FROM mpesa_payments WHERE TransID='$searchtext' AND TransDate='$Transdate' OR MSISDN LIKE '%$searchtext%' AND TransDate='$Transdate' or FirstName LIKE '%$searchtext%' AND TransDate='$Transdate' or LastName LIKE '%$searchtext%' AND TransDate='$Transdate' ORDER BY id DESC");
}
?>
<meta http-equiv="refresh" content="10">
<form action="" method="post">
    <table width="100%"><tr><td width="70%">
    <input type="text" name="search" placeholder="Enter Phone number, any names or transaction id" style="width: 100%; padding:5px; margin-top:5px;" required="required">
    </td><td width="15%">
        <input type="submit" name="find" value="Search" style="width: 100%; padding:5px;margin-top:5px;">
    </td><td><a href="index.php">View All</a></td></tr></table>
    
</form>
<table width="100%">
    <?php
    $total=0;
    while($row=mysqli_fetch_assoc($qry)){
    $transid=$row['TransID'];
    $phoneno=$row['MSISDN'];
    $names=$row['FirstName'].' '.$row['LastName'];
    $amount=$row['TransAmount'];
    $total=$total+$amount;
    echo '<tr class="transaction" style="border-collapse:collapse;"><td>'.$transid.'</td><td align="left">'.$names.'</td><td>'.$phoneno.'</td><td align="right">'.number_format($amount,0).'</td></tr></div>';
}
echo '<table width="100%"><tr class="transaction" style="width:100%; background-color:blue; color:white;font-weight:bolder;"><td>Total</td><td align="right">'.number_format($total,0).'</td></tr>';
?>
</table>
<?php
include 'styles.html';
?>