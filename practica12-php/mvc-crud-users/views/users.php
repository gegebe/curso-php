<section class="container">
    <div class="row">
        <div class="col-lg-6">
            <!--Formulario de login-->
            <?php
                $users = new Usuarios();
                echo $users->getFormLogin();
            ?>
        </div>
        <div class="col-lg-6">
            <!--Formulario de registro-->
            <?php
                $users = new Usuarios();
                echo $users->getFormReg();
            ?>

        </div>
    </div>
</section>

<script>
    let formReg = document.querySelector('#registro');

    formReg.addEventListener("submit", (evento)=>{
         if(!Validar()){
            evento.preventDefault();
        }
    });

    function Validar(){
        let user = document.querySelector("#user");
        let pass1 = document.querySelector("#pass1");
        let pass2 = document.querySelector("#pass2");
        let mail1 = document.querySelector("#email1");
        let mail2 = document.querySelector("#email2");
        let conectado = document.querySelector('input[name="conectado"]');
        let estado = document.querySelector('input[name="estado"]');
        let validar = false;
        
        if(user.value.length >= 2 && user.value.length <= 10){
            if(pass1.value === pass2.value){
                console.log(pass1.value === pass2.value);

                if(mail1.value === mail2.value){
                console.log((mail1.value === mail2.value));
                    if(conectado.value === "0" && estado.value === "0"){
                        validar = true;
                    } else {
                        console.log("Conectado no es válido");
                        mail1.style.border = "1px solid red"
                    }

                } else {
                    console.log("Email no es válido");
                }

            } else {
                console.log("Pass no es válido");
            }
            
        } else {
            console.log("usuario no válido");
        }

        return validar;

    }
</script>