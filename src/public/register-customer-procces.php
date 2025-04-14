<?php
// Conexión a la base de datos con PDO
include '../connection/conn.php'; // Asegúrate de que aquí se use $pdo y no $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtener los datos del formulario
    $user_real_name = $_POST['name_customer'];
    $user_last_name = $_POST['lastname_customer'];
    $user_name = $_POST['username_customer'];
    $user_country = $_POST['country_customer'];
    $user_email = $_POST['email_customer'];
    $user_password = $_POST['password_customer'];
    $user_phone_number = $_POST['phone_customer'];

    // Hashear la contraseña
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

    // Valores por defecto
    $is_online = 0;
    $is_restricted = 0;
    $user_points = 0;
    $user_register_time = date("Y-m-d H:i:s");
    $user_restriction_reason = null;

    try {
        // Preparar la consulta
        $stmt = $pdo->prepare("
            INSERT INTO users (
                user_real_name, user_last_name, user_name, user_password,
                is_online, is_restricted, user_email, user_country,
                user_phone_number, user_points, user_register_time, user_restriction_reason
            ) VALUES (
                :user_real_name, :user_last_name, :user_name, :user_password,
                :is_online, :is_restricted, :user_email, :user_country,
                :user_phone_number, :user_points, :user_register_time, :user_restriction_reason
            )
        ");

        // Ejecutar con array asociativo
        $stmt->execute([
            ':user_real_name' => $user_real_name,
            ':user_last_name' => $user_last_name,
            ':user_name' => $user_name,
            ':user_password' => $user_password_hash,
            ':is_online' => $is_online,
            ':is_restricted' => $is_restricted,
            ':user_email' => $user_email,
            ':user_country' => $user_country,
            ':user_phone_number' => $user_phone_number,
            ':user_points' => $user_points,
            ':user_register_time' => $user_register_time,
            ':user_restriction_reason' => $user_restriction_reason
        ]);

        echo "✅ Usuario registrado correctamente";
    } catch (PDOException $e) {
        echo "❌ Error al registrar: " . $e->getMessage();
    }
}
?>
