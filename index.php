<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dictionary</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body background="background.png" class="d-flex align-items-center justify-content-center bg-image img-fluid" style="height: 100vh;">
    <div class="container">
        <form method="post">
            <div class="form-group d-flex">
                <input type="text" class="form-control" name="word" placeholder="Enter a word">
                <button type="submit" class="btn btn-primary ml-2" name="search">Search</button>
            </div>
        </form>
        <div class="mt-4 text-white">
            <?php include("dictionary.php"); ?>
        </div>
    </div>
</body>
</html>
