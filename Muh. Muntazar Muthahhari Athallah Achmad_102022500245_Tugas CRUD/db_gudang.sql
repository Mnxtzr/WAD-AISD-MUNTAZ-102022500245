CREATE DATABASE IF NOT EXISTS db_gudang;
USE db_gudang;

DROP TABLE IF EXISTS rak;

CREATE TABLE rak (
    kode      VARCHAR(10) PRIMARY KEY,
    lorong    VARCHAR(20) NOT NULL,
    kapasitas INT NOT NULL,
    terisi    INT NOT NULL,
    tipe      VARCHAR(30) NOT NULL
);

INSERT INTO rak (kode, lorong, kapasitas, terisi, tipe) VALUES
('A101', 'Lorong A', 1000, 820,  'Shelving'),
('A102', 'Lorong A', 1000, 350,  'Shelving'),
('A103', 'Lorong A', 1000, 1000, 'Pallet Rack'),
('B101', 'Lorong B', 1000, 600,  'Cold Storage'),
('B102', 'Lorong B', 1000, 200,  'Pallet Rack'),
('C101', 'Lorong C', 1000, 1000, 'Cold Storage');
