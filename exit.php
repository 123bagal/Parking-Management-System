<?php
require 'db.php';
$plate=$_POST['plate'];
$q=$conn->query("SELECT t.txn_id,t.entry_time,t.slot_id FROM transactions t JOIN vehicles v ON t.vehicle_id=v.vehicle_id WHERE v.plate_number='$plate' AND t.exit_time IS NULL LIMIT 1");
if($q->num_rows==0) die("No Active Record Found");
$r=$q->fetch_assoc();
$txn_id=$r['txn_id']; $slot_id=$r['slot_id'];
$entry=new DateTime($r['entry_time']); $exit=new DateTime();
$hrs=ceil(($exit->getTimestamp()-$entry->getTimestamp())/3600); if($hrs<=0) $hrs=1;
$amount=20+($hrs-1)*10;
$conn->query("UPDATE transactions SET exit_time=NOW(),amount=$amount,paid=1 WHERE txn_id=$txn_id");
$conn->query("UPDATE slots SET is_occupied=0 WHERE slot_id=$slot_id");
echo "<div style='font-family:Arial;padding:20px'>✅ Exit Processed. Amount: ₹$amount</div>";
?>