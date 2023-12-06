<!-- forget_password.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-image: url("../login-signup/image/background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            margin: 0;
        }

        .w-450 {
            width: 450px;
        }

        .hv-100 {
            min-height: 100px;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">

        <form class="shadow w-450 p-3" style="background-color: rgba(255, 255, 255, 0.9);" action="php/reset_password.php" method="post">

            <img src="../login-signup/image/logo.png" alt="Logo" class="img-fluid mx-auto d-block mb-3" style="max-width: 150px;">

            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="uname" value="<?php echo isset($_GET['uname']) ? $_GET['uname'] : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_pass">
            </div>

            <div class="mb-3">
                <label class="form-label">Token</label>
                <input type="text" class="form-control" name="token">
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Reset Password</button>
            <a href="login.php" class="link-secondary">Login</a>
        </form>
    </div>

</body>

</html>