<?php
require 'functions.php';
// date_default_timezone_set('Asia/Makassar');
function hapus_parkir_masuk($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM data_parkir_masuk WHERE id_karcis = '$id'");
    return mysqli_affected_rows($conn);
}
function tambah($data)
{
    global $conn;
    $id_karcis = $data["id_karcis"];

    // Ambil data parkir masuk
    $parkir_masuk = query("SELECT * FROM data_parkir_masuk WHERE id_karcis = '$id_karcis'")[0];

    if ($parkir_masuk) {
        $jenis_kendaraan = $parkir_masuk["jenis_kendaraan"];

        // Ambil data tarif berdasarkan jenis kendaraan
        $data_tarif = query("SELECT tarif FROM data_jenis_kendaraan WHERE jenis_kendaraan = '$jenis_kendaraan'")[0];
        $tarif = $data_tarif['tarif'];

        $no_plat = $parkir_masuk["no_plat"];
        $tanggal_jam_masuk = $parkir_masuk["tanggal_jam_masuk"];
        $jenis_kendaraan = $parkir_masuk["jenis_kendaraan"];
        $tanggal_jam_keluar = date("Y-m-d H:i:s");

        // Hitung lama parkir
        $lama_parkir = (abs(strtotime($tanggal_jam_keluar) - strtotime($tanggal_jam_masuk)));
        $lama_parkir = ($lama_parkir <= 0) ? 1 : ceil($lama_parkir / 3600);
        // var_dump(($lama_parkir));

        // Hitung total bayar
        $total_bayar = ($lama_parkir) * $tarif;

        // Hapus data parkir masuk
        $queryDelete = "DELETE FROM data_parkir_masuk WHERE id_karcis = '$id_karcis'";
        mysqli_query($conn, $queryDelete);

        // Tambahkan data parkir keluar
        $queryInsert = "INSERT INTO data_parkir_keluar (id_karcis, no_plat, tanggal_jam_masuk, tanggal_jam_keluar, jenis_kendaraan, lama_parkir, tarif, total_bayar) 
                        VALUES ('$id_karcis', '$no_plat', '$tanggal_jam_masuk', '$tanggal_jam_keluar', '$jenis_kendaraan', '$lama_parkir', '$tarif', '$total_bayar')";
        mysqli_query($conn, $queryInsert);

        return mysqli_affected_rows($conn);
    }

    return 0;
}

if (isset($_POST["submit"]) || isset($_POST["barcode"])) {
    if (tambah($_POST) > 0) {
        echo "
                <script>
                    alert('Data berhasil dimasukkan')
                </script>
            ";
    } else {
        echo "
        <script>
            alert('Data GAGAL dimasukkan !!!')
        </script>
        ";
    }
}

// Hapus semua file gambar di folder
$folder_path = "images/qrcode/";
$files = glob($folder_path . "*.png");
foreach ($files as $file) {
    unlink($file);
}

function hapus_parkir_keluar($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM data_parkir_keluar WHERE `data_parkir_keluar`.`id_karcis` = '$id'");
    return mysqli_affected_rows($conn);
}
$parkir_keluar = query("SELECT * FROM data_parkir_keluar");
