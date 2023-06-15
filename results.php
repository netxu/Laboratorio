<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Listado Persona</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
            if ($_GET && isset($_GET['registro'])) {
        ?>
            <div id="success">Registro completado con éxito</div>
        <?php
            }
        ?>
        <div class="container">
            <div class="forms">
                <form method="POST" action="">
                    <input class="form-btn" name="submit" type="submit" value="Consulta"/>
                </form>
                <form method="POST" action="">
                    <input type="text" name="back" value="back" hidden />
                    <input class="form-btn" name="submit" type="submit" value="Añadir nuevo"/>
                </form>
            </div>
            <div class="results">
                <?php
                    if ($_POST) {
                        if(isset($_POST['back'])) {
                            header("Location: ./");
                        }
                ?>
                    <h2>Listado Persona</h2>
                <?php
                        $dbservername = "localhost";
                        $dbusername = "root";
                        $dbpassword = "";
                        $dbname = "cursosql";
                
                        $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
                
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                
                        $result = $conn->query("SELECT * FROM PERSONA");
                        if ( $result->num_rows > 0 ) {
                ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Correo</th>
                                    <th>Login</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                ?>
                                <tr>
                                    <td><?=$row['NOMBRE']?></td>
                                    <td><?=$row['PRIMER_APELLIDO']?></td>
                                    <td><?=$row['SEGUNDO_APELLIDO']?></td>
                                    <td><?=$row['CORREO']?></td>
                                    <td><?=$row['LOGIN']?></td>
                                    <td><?=$row['PASSWORD']?></td>
                                </tr>
                <?php
                            }
                ?>
                            </tbody>
                        </table>
                <?php
                        } else {
                            echo "Todavía no hay datos";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>