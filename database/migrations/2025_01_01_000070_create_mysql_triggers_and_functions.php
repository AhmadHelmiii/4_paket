<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Function: hitung_denda(hari_terlambat)
        DB::unprepared('DROP FUNCTION IF EXISTS hitung_denda');
        DB::unprepared('
            CREATE FUNCTION hitung_denda(hari INT)
            RETURNS DECIMAL(12,2)
            DETERMINISTIC
            BEGIN
                DECLARE denda DECIMAL(12,2);
                IF hari <= 0 THEN
                    SET denda = 0;
                ELSE
                    SET denda = hari * 5000;
                END IF;
                RETURN denda;
            END
        ');

        // Trigger: kurangi stok_tersedia saat peminjaman disetujui (status -> dipinjam)
        DB::unprepared('DROP TRIGGER IF EXISTS after_peminjaman_approved');
        DB::unprepared('
            CREATE TRIGGER after_peminjaman_approved
            AFTER UPDATE ON peminjaman
            FOR EACH ROW
            BEGIN
                IF NEW.status = "dipinjam" AND OLD.status = "menunggu" THEN
                    UPDATE alat a
                    INNER JOIN detail_peminjaman dp ON dp.alat_id = a.id
                    SET a.stok_tersedia = a.stok_tersedia - dp.jumlah
                    WHERE dp.peminjaman_id = NEW.id;
                END IF;
            END
        ');

        // Trigger: tambah stok_tersedia saat pengembalian diproses (status -> dikembalikan)
        DB::unprepared('DROP TRIGGER IF EXISTS after_peminjaman_returned');
        DB::unprepared('
            CREATE TRIGGER after_peminjaman_returned
            AFTER UPDATE ON peminjaman
            FOR EACH ROW
            BEGIN
                IF NEW.status = "dikembalikan" AND (OLD.status = "dipinjam" OR OLD.status = "menunggu_konfirmasi") THEN
                    UPDATE alat a
                    INNER JOIN detail_peminjaman dp ON dp.alat_id = a.id
                    SET a.stok_tersedia = a.stok_tersedia + dp.jumlah
                    WHERE dp.peminjaman_id = NEW.id;
                END IF;
            END
        ');

        // Stored Procedure: proses_pengembalian dengan ROLLBACK
        DB::unprepared('DROP PROCEDURE IF EXISTS proses_pengembalian');
        DB::unprepared('
            CREATE PROCEDURE proses_pengembalian(
                IN p_peminjaman_id BIGINT,
                IN p_petugas_id BIGINT,
                IN p_tgl_kembali DATE,
                IN p_keterangan TEXT
            )
            BEGIN
                DECLARE v_tgl_rencana DATE;
                DECLARE v_hari_terlambat INT;
                DECLARE v_denda DECIMAL(12,2);
                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    RESIGNAL;
                END;

                START TRANSACTION;

                SELECT tgl_kembali_rencana INTO v_tgl_rencana
                FROM peminjaman WHERE id = p_peminjaman_id FOR UPDATE;

                SET v_hari_terlambat = GREATEST(0, DATEDIFF(p_tgl_kembali, v_tgl_rencana));
                SET v_denda = hitung_denda(v_hari_terlambat);

                INSERT INTO pengembalian (peminjaman_id, petugas_id, tgl_kembali_aktual, hari_terlambat, denda, keterangan, created_at, updated_at)
                VALUES (p_peminjaman_id, p_petugas_id, p_tgl_kembali, v_hari_terlambat, v_denda, p_keterangan, NOW(), NOW());

                UPDATE peminjaman SET status = "dikembalikan" WHERE id = p_peminjaman_id;

                COMMIT;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_peminjaman_returned');
        DB::unprepared('DROP TRIGGER IF EXISTS after_peminjaman_approved');
        DB::unprepared('DROP PROCEDURE IF EXISTS proses_pengembalian');
        DB::unprepared('DROP FUNCTION IF EXISTS hitung_denda');
    }
};
