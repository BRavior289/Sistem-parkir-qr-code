<?php 
$nama = $_GET['fungsi'];
require 'data_'.$nama.'.php';

$fungsiHapus = 'hapus_'.$nama;

$id = $_GET['id'];
if ($fungsiHapus($id) > 0) {
    $redirectURL = 'data_'.$nama.'.php';
    echo "
    <script>
        alert('Data berhasil dihapus')
        document.location.href = '$redirectURL';
    </script>
        ";
    } else {
    echo "
    <script>
        alert('Data GAGAL dihapus !!!')
        document.location.href = '$redirectURL';
    </script>
    ";
}
