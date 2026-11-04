CREATE DATABASE IF NOT EXISTS pemweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pemweb;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nim        VARCHAR(20)  NOT NULL UNIQUE,
    nama       VARCHAR(100) NOT NULL,
    prodi      VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS mata_kuliah (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    kode       VARCHAR(10)  NOT NULL UNIQUE,
    nama       VARCHAR(100) NOT NULL,
    sks        TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO mahasiswa (nim, nama, prodi) VALUES
('20240001', 'Contoh Mahasiswa', 'Informatika');
INSERT IGNORE INTO mata_kuliah (kode, nama, sks) VALUES
('IF101', 'Pemrograman Web', 3);
