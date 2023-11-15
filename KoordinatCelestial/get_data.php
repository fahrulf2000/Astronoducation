<?php
// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'root', '', 'koordinat');

// Mendapatkan ID benda langit yang dipilih
$star_id = $_POST['star_id'];

// Query untuk mendapatkan data benda langit berdasarkan ID
$query = "SELECT * FROM celestial_objects WHERE id = $star_id";
$result = mysqli_query($koneksi, $query);

// Mendapatkan hasil query
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

    // Menghasilkan JSON dengan data asensiorekta, deklinasi, dan gambar
    $data = array(
        'ascension' => $row['ascension'],
        'declination' => $row['declination'],
        'description' => $row['description'],
        'image' => $row['image']
    );
    echo json_encode($data);
}
?>

