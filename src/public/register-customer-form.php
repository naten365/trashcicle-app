<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #3e8e41;
            --bg-color: #121212;
            --card-bg: #1a1a2e;
            --text-color: #ffffff;
            --input-bg: #2a2a32;
            --accent-color: #6fcf97;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color:#0a0a16;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            height: 100vh;
            overflow: hidden;
        }
        
        .container {
            width: 100%;
            max-width: 900px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.5rem;
        }
        
        .card {
            background-color: #1a1a2e;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-height: 95vh;
            overflow-y: auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 1rem;
        }
        
        h1 {
            font-size: 1.8rem;
            margin-bottom: 0.25rem;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .subtitle {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 0.25rem;
        }
        
        .form-layout {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .column {
            flex: 1;
            min-width: 280px;
        }
        
        .form-group {
            margin-bottom: 0.75rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        input, select {
            width: 100%;
            padding: 0.6rem 0.75rem;
            font-size: 0.95rem;
            background-color: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: var(--text-color);
            transition: all 0.3s ease;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }
        
        .btn-container {
            margin-top: 1rem;
            width: 100%;
        }
        
        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 0.75rem;
            font-size: 0.85rem;
        }
        
        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .column {
                flex: 1 0 100%;
            }
            
            .card {
                padding: 1rem;
                border-radius: 8px;
                max-height: 98vh;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .subtitle {
                font-size: 0.8rem;
            }
            
            .form-group {
                margin-bottom: 0.5rem;
            }
            
            input, select, .btn {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Registro de Usuarios</h1>
                <p class="subtitle">Completa el formulario para acceder al sistema</p>
            </div>
            
            <form id="registerForm" method="POST" action="register-customer-procces.php">
                <div class="form-layout">
                    <div class="column">
                        <div class="form-group">
                            <label for="firstName">Nombre</label>
                            <input type="text" id="firstName" name="name_customer" placeholder="Ingresa tu nombre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="lastName">Apellido</label>
                            <input type="text" id="lastName" name="lastname_customer" placeholder="Ingresa tu apellido" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" id="username" name="username_customer" placeholder="Elige un usuario" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="country">País</label>
                            <select id="country"  name="country_customer" required>
                                <option value="" disabled selected>Selecciona un país</option>
                                <option value="rd">Republica Dominicana</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="column">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email_customer" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password_customer" placeholder="Contraseña segura" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Número de teléfono</label>
                            <input type="tel" id="phone" name="phone_customer" placeholder="+34 123 456 789">
                        </div>
                        
                        <div class="form-group btn-container">
                            <button type="submit" class="btn">Crear cuenta</button>
                        </div>
                        
                        <div class="login-link">
                            ¿Ya tienes cuenta? <a href="login-form.php">Iniciar sesión</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    // ENVIAR FORMULARIO POR FETCH
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        fetch('register-customer-procces.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // Si el PHP responde con echo
        .then(data => {
            alert(data); // Muestra lo que respondió el servidor
            form.reset(); // Limpia el formulario
            window.location.href = 'login-form.php'; // Redirige a la página de inicio de sesión
        })
        .catch(error => {
            alert('❌ Error al enviar el formulario');
            console.error(error);
        });
    });

    // SCROLL DINÁMICO (NO SE TOCA)
    function checkFit() {
        const card = document.querySelector('.card');
        const windowHeight = window.innerHeight;
        const cardHeight = card.scrollHeight;

        if (cardHeight > windowHeight * 0.95) {
            card.style.overflowY = 'auto';
            card.style.maxHeight = '95vh';
        } else {
            card.style.overflowY = 'hidden';
        }
    }

    window.addEventListener('load', checkFit);
    window.addEventListener('resize', checkFit);
</script>

</body>
</html>