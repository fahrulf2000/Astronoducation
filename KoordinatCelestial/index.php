<html>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<label>pilih Object</label><br>
<select name="Nama" id="Nama" onchange="detail()">
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
<input type="text" name="vasensiorekta" id="vasensiorekta">
<br>

<label>Deklinasi</label><br>
<input type="text" name="vdeklinasi" id="vdeklinasi">
<br>

<script>
    function detail(){
        var id = $("#Nama").val();
        $.ajax({
            url :"data.php",
            method :"POST",
            data : {id:id},
            dataType : "json",
            success:function(data){
                $('#vasensiorekta').val(data.Asensiorekta);
                $('#vdeklinasi').val(data.Deklinasi);
                
            }
        })
    }
</script>

</html>