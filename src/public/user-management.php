<?php
session_start();
include '../connection/conn.php';
checkUserPermissions('admin');


// Obtener usuarios de la base de datos usando PDO
try {
    $stmt = $pdo->prepare("SELECT user_id, 
        CONCAT(user_real_name, ' ', user_last_name) AS name, 
        user_name, 
        user_password, 
        is_online, 
        is_restricted,
        user_restriction_reason AS restrictionReason, 
        user_email AS email, 
        user_country AS country, 
        user_phone_number AS phone, 
        user_points AS points,
        user_register_time AS joinDate
        FROM users");

    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Obtener historial de transacciones
    $stmt = $pdo->prepare("SELECT user_id, 
        history_id, 
        date, 
        type, 
        description, 
        points 
        FROM user_history");

    $stmt->execute();
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Combinar historial con usuarios
    foreach ($users as &$user) {
        $user['history'] = array_filter($history, function ($item) use ($user) {
            return $item['user_id'] == $user['user_id'];
        });
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $users = [];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="styles/user-management.css"> 
    <style>

    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar" style="background:#1a1a2e;">
                <div class="logo-container">
                    <a href="index-admin.php">
                        <img src="assets/images/logo-trashcicle-new.png" alt="TrashCicle Logo" class="w-full trashcicle-logo">
                    </a>
                </div>
            <nav>
                <ul>

                    <li>
                        <div class="nav-item active" data-filter="todos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                <path d="M15 19l2 2l4 -4" />
                            </svg>Todos
                        </div>
                    </li>
                    <li>
                        <div class="nav-item" data-filter="conectado">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wifi">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 18l.01 0" />
                                <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
                                <path d="M6.343 12.343a8 8 0 0 1 11.314 0" />
                                <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0" />
                            </svg>Conectado
                        </div>
                    </li>
                    <li>
                        <div class="nav-item" data-filter="desconectado">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wifi-off">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 18l.01 0" />
                                <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
                                <path d="M6.343 12.343a7.963 7.963 0 0 1 3.864 -2.14m4.163 .155a7.965 7.965 0 0 1 3.287 2" />
                                <path d="M3.515 9.515a12 12 0 0 1 3.544 -2.455m3.101 -.92a12 12 0 0 1 10.325 3.374" />
                                <path d="M3 3l18 18" />
                            </svg>Desconectado
                        </div>
                    </li>
                    <li>
                        <div class="nav-item" data-filter="restringidos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M5.7 5.7l12.6 12.6" />
                            </svg>Restringidos
                        </div>
                    </li>
                    <li>
                        <a href="home.php" class="">
                            <div class="nav-item-return">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l14 0" />
                                    <path d="M5 12l6 6" />
                                    <path d="M5 12l6 -6" />
                                </svg>
                                Volver 
                            </div>
                        </a>
                    </li>
                </ul>

            </nav>
        </aside>

        <main class="main-content">
            <h1>Gestión de usuarios</h1>
            <div class="search-container">
                <input type="text" class="search-box" placeholder="Buscar usuario por nombre o correo electrónico" id="searchInput">
            </div>
            <div class="users-list" id="usersList">
            </div>
        </main>
    </div>

    <div class="modal" id="infoModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Información del usuario</h2>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body" id="infoModalContent">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>

    <div class="modal" id="restrictModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Restringir usuario</h2>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div id="restrictModalContent"></div>
                <div class="user-details">
                    <h3>Motivo de restricción</h3>
                    <p>Este usuario fue restringido debido a una infracción de las normas del sistema. Razón: Envío de mensajes inapropiados a otros usuarios. Puedes levantar esta restricción si consideras que se han tomado las medidas necesarias para evitar futuras infracciones.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="button button-restrict">Habilitar</button>
            </div>
        </div>
    </div>


    <script>
        const users = <?php echo json_encode($users); ?>;
    </script>
    <script src="scripts/user-management.js"></script>
</body>

</html>