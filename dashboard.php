<?php
require 'db.php';
$res=$conn->query("SELECT s.slot_label,s.is_occupied,v.plate_number,t.entry_time,t.exit_time,t.amount FROM slots s LEFT JOIN transactions t ON s.slot_id=t.slot_id AND t.txn_id=(SELECT txn_id FROM transactions WHERE slot_id=s.slot_id ORDER BY entry_time DESC LIMIT 1) LEFT JOIN vehicles v ON t.vehicle_id=v.vehicle_id ORDER BY s.slot_label");
echo "<div class='dashboard'>";
while($row=$res->fetch_assoc()){
  $status=$row['is_occupied']?"occupied":"free";
  echo "<div class='card $status'><h4>Slot {$row['slot_label']}</h4><p>Status: ".($row['is_occupied']?"Occupied":"Free")."</p><p>Plate: {$row['plate_number']}</p><p>Entry: {$row['entry_time']}</p><p>Exit: {$row['exit_time']}</p><p>Amount: {$row['amount']}</p></div>";
}
echo "</div>";
?>