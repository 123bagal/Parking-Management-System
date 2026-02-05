<?php
require 'db.php';
$plate = $_POST['plate']; $type = $_POST['vehicle_type']; $owner = $_POST['owner'];
$res = $conn->query("SELECT slot_id, slot_label FROM slots WHERE is_occupied=0 LIMIT 1");
if ($res->num_rows==0) { die("Parking Full!"); }
$slot=$res->fetch_assoc(); $slot_id=$slot['slot_id']; $slot_label=$slot['slot_label'];
$conn->query("INSERT INTO vehicles(plate_number,vehicle_type,owner_name) VALUES('$plate','$type','$owner') ON DUPLICATE KEY UPDATE owner_name='$owner'");
$veh_id=$conn->insert_id?$conn->insert_id:$conn->query("SELECT vehicle_id FROM vehicles WHERE plate_number='$plate'")->fetch_assoc()['vehicle_id'];
$conn->query("INSERT INTO transactions(vehicle_id,slot_id,entry_time) VALUES($veh_id,$slot_id,NOW())");
$conn->query("UPDATE slots SET is_occupied=1 WHERE slot_id=$slot_id");
echo "<div style='font-family:Arial;padding:20px'>✅ Vehicle Parked in Slot $slot_label</div>";
?>