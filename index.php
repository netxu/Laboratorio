<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulario de Registro Persona</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="group">
            <form method="POST" action="">
                <h2><em>Formulario de Registro Persona<em></h2>
                <div class="inputContainer">
                    <label for="name" class="label">Nombre*</label>
                    <input onkeyup="changeInput('nombre')" type="text" class="input" name="nombre" id="nombre">
                    <div class="error-message error-empty">Rellene este campo</div>
                </div>

                <div class="inputContainer">
                    <label for="primer_apellido" class="label">Primer Apellido*</label>
                    <input onkeyup="changeInput('primer_apellido')" type="text" class="input" name="primer_apellido" id="primer_apellido">
                    <div class="error-message error-empty">Rellene este campo</div>
                </div>

                <div class="inputContainer success">
                    <label for="segundo_apellido" class="label">Segundo Apellido</label>
                    <input type="text" class="input" name="segundo_apellido" id="segundo_apellido">
                </div>
  
                <div class="inputContainer">
                    <label for="email" class="label">Email*</label>
                    <input onkeyup="changeInputEmail()" type="email" class="input" name="email" id="email">
                    <div class="error-message error-empty">Rellene este campo</div>
                    <div class="error-message error-email">Email Inválido</div>
                </div>

                <div class="inputContainer">
                    <label for="login" class="label">Login*</label>
                    <input onkeyup="changeInput('login')" type="text" class="input" name="login" id="login">
                    <div class="error-message error-empty">Rellene este campo</div>
                </div>

  
                <div class="inputContainer">
                    <label for="password" class="label">Contraseña*</label>
                    <input onkeyup="changeInputPassword()" type="password" class="input" name="password" id="password" >
                    <div class="error-message error-empty">Rellene este campo</div>
                    <div class="error-message error-password">La contraseña debe tener entre 4 y 8 caracteres</div>
                </div>
  
                <div class="inputContainer">
                    <label for="repeat-password" class="label">Confirme su contraseña</label>
                    <input onkeyup="changeInputRepeatPassword()" type="password" class="input" name="repeat-password" id="repeat-password">
                    <div class="error-message error-empty">Rellene este campo</div>
                    <div class="error-message error-repeat">Las contraseñas no coinciden</div>
                </div>

                <input class="form-btn" id="add" name="submit" type="submit" value="Suscribirse" disabled/>
            </form>
            <?php
            if ($_POST) {
                $nombre = $_POST['nombre'];
                $primer_apellido = $_POST['primer_apellido'];
                $segundo_apellido = $_POST['segundo_apellido'];
                $email = $_POST['email'];
                $login = $_POST['login'];
                $password = $_POST['password'];

                $dbservername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "cursosql";

                $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT CORREO FROM PERSONA WHERE CORREO LIKE '$email'");
                
                if ( $result->num_rows > 0 ) {
                    echo "El email introducido ya existe.";
                } else {
                    $sql = "INSERT INTO PERSONA (NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, CORREO, LOGIN, PASSWORD) 
                            VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$email', '$login', '$password')";
            
                    if ($conn->query($sql) === TRUE) {
                        echo "Registro completado con éxito";
                        header('Location: ./results.php?registro=ok');
                        $conn->close();
                        exit;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                $conn->close();
            }
        ?>
        <script src="validate.js"></script>
        </div>
    </body>
</html>