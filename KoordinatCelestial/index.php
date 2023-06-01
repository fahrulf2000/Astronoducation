<html>
<label>pilih Object</label><br>
<select name="" id="">
<?php
    include "koneksi.php";

    $query = mysqli_query($koneksi,"select * from koordinat");
    while($data = mysqli_fetch_array($query)){
    ?>
        <option value="<?php echo $data['id']; ?>"><?php echo $data['Nama']; ?></option>
    <?php
    }
    ?>
</select>
<br>

<label>Asensiorekta</label><br>
<input type="text" name="" id="">
<br>

<label>Deklinasi</label><br>
<input type="text" name="" id="">
</html>