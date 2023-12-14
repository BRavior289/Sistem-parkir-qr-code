<?php
// ambil baju dari dalam lemari
// ambil data tabel (fetch) dari object result, ada beberapa cara seperti :
// mysqli_fetch_row(); // Mengembalikan array numerik yg indeksnya angka
// mysqli_fetch_assoc(); // Mengembalikan array asosiatif yang indeksnya key string
// mysqli_fetch_array(); // Mengembalikan keduanya jdi double (num dan assoc)
// mysqli_fetch_object();?>

<?php
$conn = mysqli_connect("localhost", "root", "", "aplikasikonsentrasi");

function query($query)
{
    global $conn;
    // Lemari
    $result = mysqli_query($conn, $query);
    // wadah baju
    $data = [];

    // row = baju, data = wadah baju
    // Mengambil data dan memasukkannya ke dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    // kembalikan wadah
    return $data;
}
