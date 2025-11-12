<?php
// ============================================================================
// ARCHIVO DE CONEXIÓN A LA BASE DE DATOS
// Sistema de Riego Inteligente
// ============================================================================

// Configuración de la base de datos
define("DB_HOST", "localhost");
define("DB_USER", "root");          // Cambia según tu configuración
define("DB_PASS", "");              // Cambia según tu configuración
define("DB_NAME", "sistema_riego");
define("DB_CHARSET", "utf8mb4");

// Crear conexión usando mysqli
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar si hay error en la conexión
if ($conn->connect_error) {
    // En producción, NO mostrar detalles del error
    die("
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error de Conexión</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .error-box {
                    background: white;
                    padding: 3rem;
                    border-radius: 20px;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                    text-align: center;
                    max-width: 500px;
                }
                .error-icon {
                    font-size: 4rem;
                    margin-bottom: 1rem;
                }
                h1 {
                    color: #e53e3e;
                    margin-bottom: 1rem;
                }
                p {
                    color: #4a5568;
                    line-height: 1.6;
                    margin-bottom: 1.5rem;
                }
                .error-details {
                    background: #fff5f5;
                    border: 1px solid #fc8181;
                    border-radius: 8px;
                    padding: 1rem;
                    margin: 1rem 0;
                    color: #742a2a;
                    font-family: monospace;
                    font-size: 0.9rem;
                }
                .btn {
                    display: inline-block;
                    padding: 0.8rem 1.5rem;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: 600;
                    transition: transform 0.3s ease;
                }
                .btn:hover {
                    transform: translateY(-2px);
                }
            </style>
        </head>
        <body>
            <div class='error-box'>
                <div class='error-icon'>🚫</div>
                <h1>Error de Conexión</h1>
                <p>No se pudo establecer conexión con la base de datos.</p>
                <div class='error-details'>
                    Error: " . $conn->connect_error . "
                </div>
                <p><strong>Posibles soluciones:</strong></p>
                <ul style='text-align: left; color: #4a5568;'>
                    <li>Verifica que el servidor MySQL esté ejecutándose</li>
                    <li>Revisa las credenciales en <code>db_connect.php</code></li>
                    <li>Asegúrate de que la base de datos 'sistema_riego' exista</li>
                    <li>Verifica los permisos del usuario de MySQL</li>
                </ul>
                <a href='javascript:location.reload()' class='btn'>🔄 Reintentar</a>
            </div>
        </body>
        </html>
    ");
}

// Establecer el conjunto de caracteres
$conn->set_charset(DB_CHARSET);

// Configurar zona horaria (opcional)
date_default_timezone_set('America/Bogota');

// Función auxiliar para escapar datos (prevenir SQL injection)
function limpiar_datos($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Función para ejecutar consultas de forma segura
function ejecutar_consulta($sql) {
    global $conn;
    $resultado = mysqli_query($conn, $sql);
    
    if (!$resultado) {
        error_log("Error en consulta SQL: " . mysqli_error($conn));
        return false;
    }
    
    return $resultado;
}

// Función para obtener un solo resultado
function obtener_fila($sql) {
    $resultado = ejecutar_consulta($sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    }
    return null;
}

// Función para obtener múltiples resultados
function obtener_filas($sql) {
    $resultado = ejecutar_consulta($sql);
    $filas = array();
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $filas[] = $fila;
        }
    }
    
    return $filas;
}

// Mensaje de éxito en conexión (solo para desarrollo - comentar en producción)
// echo "<!-- Conexión exitosa a la base de datos -->";
?>