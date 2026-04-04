DROP TRIGGER IF EXISTS after_peminjaman_returned;
CREATE TRIGGER after_peminjaman_returned
AFTER UPDATE ON peminjaman
FOR EACH ROW
BEGIN
    IF NEW.status = 'dikembalikan' AND (OLD.status = 'dipinjam' OR OLD.status = 'menunggu_konfirmasi') THEN
        UPDATE alat a
        INNER JOIN detail_peminjaman dp ON dp.alat_id = a.id
        SET a.stok_tersedia = a.stok_tersedia + dp.jumlah
        WHERE dp.peminjaman_id = NEW.id;
    END IF;
END;
