<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $title;?></h1>
    <h3><?php echo $name;?></h3>

    <?php foreach ($user_data as $val ): ?>

        <label style="width: 60px;display: block">ID</label>

        <input type="text" value="<?php echo $val['id'] ?>">
        <br>


        <label style="width: 60px;display: block">Name</label>

        <input type="text" value="<?php echo $val['name'] ?>">

        <br>


        <label style="width: 60px;display: block">Email</label>
        <input type="text" value="<?php echo $val['email'] ?>">
        <br>

    <hr>

    <?php endforeach; ?>
    </div>

</body>
</html>