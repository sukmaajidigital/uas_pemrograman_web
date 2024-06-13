<?php
include 'config.php';
// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Fungsi untuk menghasilkan kode otomatis
function generateKode($koneksi) {
    $sql = "SELECT id FROM kategoribahanbaku ORDER BY id DESC LIMIT 1";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastKode = $row['id'];
        $lastNumber = intval(substr($lastKode, 3));
        $newNumber = $lastNumber + 1;
        return "KBB" . $newNumber;
    } else {
        return "KBB1";
    }
}

// Mengambil input dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kode = generateKode($koneksi);

    $sql = "INSERT INTO kategoribahanbaku (id, nama) VALUES ('$kode', '$nama')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan dengan kode: " . $kode;
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Kategori Bahan Baku</title>
</head>
<body>
    <h2>Input Kategori Bahan Baku</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nama: <input type="text" name="nama" required>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>