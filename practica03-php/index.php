<html lang="<?php echo 'es'; ?>'">
<head>
    <title>Ejercicio 03 - PHP - GET / POST</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        ul {
            padding:0;
        }
        ul li{
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div id="res">
        <?php
            if($_GET){
                if(isset($_GET['res']) && !empty($_GET['res'])){
                    echo $res = $_GET['res'];
                }
            }
        ?>
    </div>

    <form class="form-control" method="post" action="controller-toni.php">
        <ul>
            <li>
                <label for="user">User</label>
                <input id="user" class="form-control" type="text" name="user">
            </li>
            <li class="mt-2">
                <label for="pass">Pass</label>
                <input id="pass" class="form-control" type="password" name="pass">  
            </li>
            <li>
                <input type="hidden" name="action" value="validar">  
            </li>
            <li class="mt-2">
                <button class="btn btn-info" type="submit">Entrar</button>
            </li>
        </ul>
    </form>

    <a class="btn btn-primary" href="index.php?user=dato&pass=123">GET forzado</a>

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!--propio-->
    <script src="js/script.js"></script>

</body>
</html>