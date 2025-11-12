<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Definir título por defecto si no existe
if (!isset($titulo_pagina)) {
    $titulo_pagina = "Sistema de Riego Inteligente";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_pagina; ?> - Sistema de Riego</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #7cea66ff 0%, #153e0eff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #15e133ff 0%, #0f6329ff 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(39, 200, 93, 0.4);
        }

        .logo-text h1 {
            font-size: 1.5rem;
            color: #2d3748;
            font-weight: 700;
        }

        .logo-text p {
            font-size: 0.85rem;
            color: #718096;
        }

        /* NAVEGACIÓN */
        nav ul {
            list-style: none;
            display: flex;
            gap: 0.5rem;
        }

        nav ul li a {
            text-decoration: none;
            color: #4a5568;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: block;
        }

        nav ul li a:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        nav ul li a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* USER INFO */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1rem;
            background: #f7fafc;
            border-radius: 25px;
        }

        .user-info span {
            color: #2d3748;
            font-weight: 500;
        }

        .user-info .badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            max-width: 1400px;
            width: 100%;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .content-wrapper {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-height: 400px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            nav ul {
                flex-direction: column;
                width: 100%;
            }

            nav ul li a {
                text-align: center;
            }

            .content-wrapper {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-section">
                <div class="logo">💧</div>
                <div class="logo-text">
                    <h1>Sistema de Riego</h1>
                    <p>Inteligente</p>
                </div>
            </div>

            <nav>
                <ul>
                    <li><a href="index.php">🏠 Inicio</a></li>
                    <li><a href="zonas.php">🌱 Zonas</a></li>
                    <li><a href="sensores.php">📊 Sensores</a></li>
                    <li><a href="programacion.php">⏰ Programación</a></li>
                    <li><a href="historial.php">📋 Historial</a></li>
                    <li><a href="alertas.php">🔔 Alertas</a></li>
                    <li><a href="reportes.php">📈 Reportes</a></li>
                </ul>
            </nav>

            <div class="user-info">
                <?php if(isset($_SESSION['nombre_usuario'])): ?>
                    <span>👤 <?php echo $_SESSION['nombre_usuario']; ?></span>
                    <span class="badge"><?php echo strtoupper($_SESSION['rol'] ?? 'Usuario'); ?></span>
                <?php else: ?>
                    <a href="login.php" style="color: #667eea; text-decoration: none; font-weight: 600;">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <div class="content-wrapper"></div>