<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>register</title>
</head>
<body>

<div class="container w-50 mt-5">
    <h1 class="display-4 text-center">Add User</h1>

        <!-- FORM -->
        <form action="../actions/register.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="male" value="male" name="gender" class="custom-control-input">
                    <label class="custom-control-label" for="male">male</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="female" value="female" name="gender" class="custom-control-input">
                    <label class="custom-control-label" for="female">female</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="username" class="form-control" placeholder="username" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_of_birth">date of birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="image">profile photo</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea name="introduction" cols="30" rows="10" class="form-control" placeholder="self-introduction"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="password" name="password" class="form-control" min="6" placeholder="password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" value="register" name="register" class="form-control btn btn-success">
                </div>
            </div>
        </form>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>