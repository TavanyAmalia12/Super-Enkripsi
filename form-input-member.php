<?php
session_start();

// Check if the 'fname' key exists in the $_SESSION array
$fname = isset($_SESSION['fname']) ? htmlspecialchars($_SESSION['fname']) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        label {
            display: inline-block;
            width: 200px;
            /* Adjust the width as needed */
            text-align: left;
        }

        input,
        textarea {
            width: 350px;
            /* Adjust the width as needed */
            margin-bottom: 10px;
        }
        select{
            width: 70px;
        }

        input[type="radio"] {
            text-align: left;
            width: 50px;
            /* Adjust the margin as needed */
        }

        .container {
            border: 3px solid black;
            padding: 10px;
            width: 700px;
            margin: 150px auto;
            text-align: center;
            /* Center-align the container */
            background-color: white;
        }

        #memberForms {
            text-align: left;
            /* Align member forms to the left */
        }

        .form-group {
            margin-bottom: 10px;
            margin-top: 10px;
            /* Adjust the margin as needed */
        }

        .form-group label {
            display: inline-block;
            width: 170px;
            /* Adjust the width as needed */
            margin-right: 10px;
            /* Adjust the margin as needed */
        }

        #inputButton {
            margin-top: 20px;
            /* Add margin space above the button */
        }
    </style>
</head>

<body style="background-color: #F6FFFF;">
    <?php include("navbar.php"); ?>
    <div class="container">
        <h2 style="color: #042331; font-family: sans-serif; font-size: 16;">Form Input Member</h2>

        <label for="memberCount">Set Number of Members:</label>
        <input style="width: 50px;" type="number" id="memberCount" min="1" value="1">
        <button type="button" class="btn btn-secondary btn-sm" onclick="setMemberCount()">Set</button>

        <form action="member/input-member.php" method="post" name="form-input-member" enctype="multipart/form-data">
            <div id="memberForms">
                <!-- Member forms will be dynamically added here -->
            </div>
            <br>
            <div id="inputButton" style="display: none; margin-top: 2px;"> <!-- Hide initially -->
                <input style="width: 70px" ; type="submit" class="btn btn-primary" name="submit" value="Input">
            </div>
            <!-- Remove the duplicate ID from the hidden input field -->
<input type="hidden" name="memberCount" id="hiddenMemberCount" value="1">

        </form>
    </div>

    <script>
       function setMemberCount() {
    var count = document.getElementById("memberCount").value;
    var memberFormsContainer = document.getElementById("memberForms");
    memberFormsContainer.innerHTML = ""; // Clear previous forms

    for (var i = 1; i <= count; i++) {
                memberFormsContainer.innerHTML +=
                    `<div style="text-align: center; font-size: 18px; font-weight: bold;">Member ${i}
                    </div>
                    <div style="margin-left: 60px; margin-bottom: 20px;">
                    <label for="username${i}">Username</label>
                    <input type="text" name="username${i}" /><br>
                    <label for="nama${i}">Nama</label>
                    <input type="text" name="nama${i}" /><br>
                    <label for="nik${i}">NIK</label>
                    <input type="text" name="nik${i}" /><br>
                    <label for="tgl_lahir${i}">Tanggal Lahir</label>
                    <select name="tgl_lahir${i}">
                        <?php
                        for ($j = 1; $j <= 31; $j++) {
                            $tg = ($j < 10) ? "0$j" : $j;
                            echo "<option value='$tg'>$tg</option>";
                        }
                        ?>
                    </select> -
                    <select name="bln_lahir${i}">
                        <?php
                        for ($bln = 1; $bln <= 12; $bln++) {
                            $nama_bln = array(1 => "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des");
                            echo "<option value='$bln'>$nama_bln[$bln]</option>";
                        }
                        ?>
                    </select> -
                    <select name="thn_lahir${i}">
                        <?php
                        for ($j = 1945; $j <= 2020; $j++) {
                            echo "<option value='$j'>$j</option>";
                        }
                        ?>
                    </select><br>
                    <div class="form-group">
                    <label for="jenis_kelamin${i}">Jenis Kelamin</label>
                    <input type="radio" name="jenis_kelamin${i}" value="L" checked> Laki-laki 
                    <input type="radio" name="jenis_kelamin${i}" value="P"> Perempuan
                    </div>
                    <label for="pekerjaan${i}">Pekerjaan</label>
                    <input type="text" name="pekerjaan${i}" /><br>
                    <div>
                    <label for="alamat${i}" style="vertical-align: top;">Alamat</label>
                    <textarea style="width: 350px;" name="alamat${i}" rows="2" cols="50"></textarea>
                    </div>          
                    <label for="no_hp${i}">Nomor HP</label>
                    <input type="text" name="no_hp${i}" maxlength="12" /><br>
                    <label for="foto${i}">Foto</label>
                    <input type="file" name="foto${i}" id="foto${i}" /><br>
                    <label for="ktp${i}">KTP</label>
                    <input type="file" name="ktp${i}" id="ktp${i}" /><br>
                    <label for="kk${i}">Kartu Keluarga</label>
                    <input type="file" name="kk${i}" id="kk${i}" />
                    </div>`
            }

            document.getElementById("hiddenMemberCount").value = count;

    // Show the input button after setting the member count
    var inputButton = document.getElementById("inputButton");
    inputButton.style.display = "block";
        }
    </script>
</body>

</html>