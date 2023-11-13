<!DOCTYPE html>
<html>
<head>
    <title>Celestial Coordinate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .result {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        img {
            max-width: 300px;
            max-height: 300px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Mengubah data asensiorekta dan deklinasi saat pilihan Combo Box berubah
            $('#star').change(function(){
                var star_id = $(this).val();
                if(star_id){
                    $.ajax({
                        type: 'POST',
                        url: 'get_data.php',
                        data: {star_id: star_id},
                        success: function(data){
                            var result = JSON.parse(data);
                            $('#ascension').text(result.ascension);
                            $('#declination').text(result.declination);
                            $('#image').attr('src', result.image);
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>CELESTIAL COORDINATE</h1>
        <div class="form-group">
            <label for="star">Pilih Benda Langit:</label>
            <select id="star" name="star">
                <option value="">Pilih</option>
                <?php
                // Koneksi ke database
                $koneksi = mysqli_connect('localhost', 'root', '', 'koordinat');

                // Query untuk mendapatkan data benda langit
                $query = "SELECT * FROM celestial_objects";
                $result = mysqli_query($koneksi, $query);

                // Menampilkan pilihan benda langit dalam Combo Box
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="result">
            <table>
                <tr>
                    <th>Asensiorekta</th>
                    <th>Deklinasi</th>
                    <th>Gambar</th>
                </tr>
                <tr>
                    <td id="ascension"></td>
                    <td id="declination"></td>
                    <td><img id="image" src="" alt="Gambar Benda Langit"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
