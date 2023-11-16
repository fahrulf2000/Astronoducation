<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CELESTIAL COORDINATE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #555;
        }

        .result {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        img {
            width: 300px;
            height: 250px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style for the description column */
        #description {
            white-space: pre-wrap;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Mengubah data asensiorekta, deklinasi, dan deskripsi saat pilihan Combo Box berubah
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
                            $('#description').text(result.description);
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
                    <th>Asensiorekta (R.A)</th>
                    <th>Deklinasi (Dec)</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                </tr>
                <tr>
                    <td id="ascension"></td>
                    <td id="declination"></td>
                    <td id="description"></td>
                    <td><img id="image" src="" alt="Gambar Benda Langit"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
