CREATE DATABASE IF NOT EXISTS parking; USE parking;
CREATE TABLE IF NOT EXISTS slots(slot_id INT AUTO_INCREMENT PRIMARY KEY,slot_label VARCHAR(20),is_occupied TINYINT(1) DEFAULT 0);
CREATE TABLE IF NOT EXISTS vehicles(vehicle_id INT AUTO_INCREMENT PRIMARY KEY,plate_number VARCHAR(20) UNIQUE,vehicle_type VARCHAR(20),owner_name VARCHAR(100));
CREATE TABLE IF NOT EXISTS transactions(txn_id INT AUTO_INCREMENT PRIMARY KEY,vehicle_id INT,slot_id INT,entry_time DATETIME,exit_time DATETIME,amount DECIMAL(10,2),paid TINYINT(1) DEFAULT 0,FOREIGN KEY(vehicle_id) REFERENCES vehicles(vehicle_id),FOREIGN KEY(slot_id) REFERENCES slots(slot_id));
INSERT INTO slots(slot_label,is_occupied) VALUES('A1',0),('A2',0),('A3',0),('B1',0),('B2',0);