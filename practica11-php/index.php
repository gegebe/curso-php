<!DOCTYPE html>
<html lang="<?php echo 'es' ?>">
    <head>
        <title>AJAX con jQuery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--bootstrap descargado para mejorar tiempos de carga y evitar que la cdn se quede ahí en produccción-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.rtl.min.css" rel="stylesheet">
        <!--css propio-->
        <link href="css/estils.css" rel="stylesheet">
    </head>
    <body>

        <main class="container">
            <div id="respuesta">

            </div>
            <ul>
                <li>
                    <label for="user">User</label>
                    <input id="user" type="text" class="form-control">
                </li>
                <li>
                    <label for="pass" class="mt-2">Password</label>
                    <input id="pass" type="password" class="form-control">
                </li>
                <li>
                    <button id="boton" class="btn btn-primary mt-4">Enviar</button>
                </li>
            </ul>
        </main>
        

        <!--bootstrap descargado para mejorar tiempos de carga y evitar que la cdn se quede ahí en produccción-->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <!--jquery-->
        <script src="js/jquery-3.7.1.min.js"></script>
        <!--js propio-->
        <script src="js/script.js"></script>
        <script>
            let user;
            let pass;
            let btn;
            let response;


            btn = document.querySelector("#boton");
            response = document.querySelector("#respuesta");

            btn.addEventListener("click", ()=>{
                user = document.querySelector("#user").value;
                pass = document.querySelector("#pass").value;

                /*jQuery - Objeto JSON*/ 
                Datos = {
                    'user': user,
                    'pass': pass,
                    'action':'VALIDAR_USER'
                } 
                /*Donde tiene que ir, que pasamos y función callback (res) de respuesta*/
                $.get('controller.php', Datos, (res)=>{
                    //1. res recibe la cadena de texto
                    //2. JSON.parse convierte la string a objeto JS
                    let respuesta = JSON.parse(res);
                    alert(res);
                    alert(respuesta.estado);
                    alert(respuesta.msn);

                    if(respuesta.estado == 1){
                        response.innerHTML = respuesta.msn;
                        response.style.backgroundColor = "var(--bs-success-bg-subtle)";
                        response.classList.add("text-center","m-4", "p-4");
                    } else {
                        response.innerHTML = respuesta.msn;
                        response.style.backgroundColor = "var(--bs-danger-bg-subtle)";
                        response.classList.add("text-center","m-4", "p-4");
                    }
                });
            });

        </script>
    </body>
</html>

<?php

?>