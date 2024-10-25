

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h1, h2 {
            color: #007BFF;
        }
        p {
            margin: 1em 0;
        }
    </style>
</head>
<body>
<?php
include 'navbar.php';
include 'db.php';
$values = [
            "Gabriel Imanullah Putra Pribowo" => "00000100492",
            "Samgar Sammy Napitupulu" => "00000109993",
            "Muhammad Thomas Pangukir" => "00000109875",
            "Rafael Gading Samoda" => "00000090472"
        ];
    ?>
<div class="container">
    <h1>About Us</h1>

    <section>
        <h2>Member Kelompok 9</h2>
        <ul>
            <?php foreach ($values as $key => $value): ?>
                <li><strong><?php echo $key; ?></strong>  (<?php echo $value; ?>)</li>
            <?php endforeach; ?>
        </ul>
    </section>

   

</body>
</html>
