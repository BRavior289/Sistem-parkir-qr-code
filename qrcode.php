<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* Menyusun elemen secara vertikal */
            height: 100vh;
            margin: 0;
        }

        img {
            width: 250px;
            height: auto;
            display: block;
            margin-bottom: 20px;
            /* Menambah ruang di bawah gambar */
        }

        .image-caption {
            font-size: 25px;
            color: #555;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    $file_path = "images/qrcode/" . $_GET["id_karcis"] . ".png";
    ?>
    <img src="<?= $file_path; ?>" alt="<?= $_GET["id_karcis"] ?>.png">
    <p class="image-caption">ID Karcis : KC-<?= $_GET["id_karcis"] ?></p>


    <script>
        // window.print();
    </script>
</body>

</html>
