<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contacto</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --primario: rgb(53, 152, 38);
      --primario-oscuro: rgba(69, 189, 50, 0.63);
      --secundario: #192a56;
      --oscuro: #1e272e;
      --claro: #f5f6fa;
      --error: #e84118;
      --exito: #4cd137;
      --borde-radio: 8px;
    }

    body {
      background-color: rgb(24, 34, 41);
      color: var(--claro);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .sombra-lateral-inferior {
      box-shadow:
        5px 15px 25px rgba(53, 152, 38, 0.2),
        15px 15px 15px rgba(53, 152, 38, 0.2);
    }

    

    .imagen-contacto {
      width: 250px;
      height: auto;
      border-radius: 12px;
    }

    .contenedor-texto {
      margin-top: 20px;
    }

    p {
      font-size: 1rem;
    }

    .subtitulo {
      font-size: 2rem;
      color: var(--primario);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .animacion-fadeIn {
      animation: fadeIn 0.3s ease-out;
    }
  </style>
</head>

<div id="alerta-personalizada" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
  <div class="bg-[var(--oscuro)] border border-[var(--primario)] text-[var(--claro)] px-6 py-4 rounded-lg shadow-xl max-w-md w-full text-center animacion-fadeIn">
    <p id="mensaje-alerta" class="mb-2"></p>
    <button onclick="ocultarAlerta()" class="mt-2 px-4 py-1 bg-[var(--primario)] text-[--oscuro] rounded hover:bg-[var(--primario-oscuro)] transition">Cerrar</button>
  </div>
</div>

<body>
  <div class="rounded-xl max-w-5xl w-full p-8 flex flex-col md:flex-row md:justify-between md:items-center gap-8 md:gap-0 border border-[var(--primario)] sombra-lateral-inferior bg-[--oscuro]">
    <form id="formulario-contacto" class="flex flex-col gap-4 max-w-md w-full">
      <h2 class="subtitulo">¡Hablemos!</h2>
      <p class="text-[var(--claro)] leading-tight mb-4">
        Envíanos un mensaje si tienes preguntas, sugerencias o simplemente deseas saludarnos!
      </p>
      <label class="text-[var(--primario)] text-xs font-semibold" for="campo-nombre">Nombre</label>
      <input class="bg-[--oscuro] border border-[var(--primario)] rounded-md px-3 py-2 text-xs text-[var(--claro)] placeholder-[var(--claro)]/60 focus:outline-none" id="campo-nombre" placeholder="Nombre..." type="text" />
      
      <label class="text-[var(--primario)] text-xs font-semibold" for="campo-correo">Correo electrónico</label>
      <input class="bg-[--oscuro] border border-[var(--primario)] rounded-md px-3 py-2 text-xs text-[var(--claro)] placeholder-[var(--claro)]/60 focus:outline-none" id="campo-correo" placeholder="Correo..." type="email" />
      
      <label class="text-[var(--primario)] text-xs font-semibold" for="campo-mensaje">Mensaje</label>
      <textarea class="bg-[--oscuro] border border-[var(--primario)] rounded-md px-3 py-2 text-xs text-[var(--claro)] placeholder-[var(--claro)]/60 resize-none focus:outline-none" id="campo-mensaje" placeholder="Mensaje..." rows="4"></textarea>
      
      <button class="boton-sombra bg-[var(--primario)] text-[--oscuro] rounded-md py-2 w-36 mt-2 self-start hover:bg-[var(--primario-oscuro)]" type="submit">
        Enviar Mensaje
      </button>
    </form>

    <div class="flex flex-col items-center md:items-start text-[var(--claro)] max-w-sm w-full">
      <img src="assets/images/Basura.png" class="imagen-contacto" alt="Reciclaje">

      <div class="contenedor-texto">
        <div class="flex items-center gap-2">
          <i class="fas fa-map-marker-alt text-sm text-[var(--primario)]"></i>
          <span>Boca Chica, La Caleta</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-envelope text-sm text-[var(--primario)]"></i>
          <span>contacto@email.com</span>
        </div>
        <div class="flex items-center gap-2">
          <i class="fas fa-phone-alt text-sm text-[var(--primario)]"></i>
          <span>+1 (111) 1111</span>
        </div>
      </div>

      <div class="flex gap-6 mt-6 text-[var(--primario)] text-lg">
        <a aria-label="Facebook" class="hover:text-[var(--primario-oscuro)]" href="#"><i class="fab fa-facebook-f"></i></a>
        <a aria-label="Twitter" class="hover:text-[var(--primario-oscuro)]" href="#"><i class="fab fa-twitter"></i></a>
        <a aria-label="Instagram" class="hover:text-[var(--primario-oscuro)]" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>

  <a href="home.php" class="group fixed bottom-4 left-4 bg-[var(--primario)] text-[--oscuro] pl-4 pr-4 py-3 rounded-full shadow-lg hover:bg-[var(--primario-oscuro)] transition-all duration-300 flex items-center overflow-hidden max-w-[48px] hover:max-w-[200px]">
    <i class="fas fa-arrow-left mr-2"></i>
    <span class="whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300">Volver al inicio</span>
  </a>

  <script>
    const formulario = document.getElementById('formulario-contacto');
    const alerta = document.getElementById('alerta-personalizada');
    const mensajeAlerta = document.getElementById('mensaje-alerta');

    formulario.addEventListener('submit', function (e) {
      e.preventDefault();

      const nombre = document.getElementById('campo-nombre').value.trim();
      const correo = document.getElementById('campo-correo').value.trim();
      const mensaje = document.getElementById('campo-mensaje').value.trim();
      const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      let errores = [];

      if (nombre === '') errores.push('El nombre es obligatorio.');
      if (!patronCorreo.test(correo)) errores.push('El correo electrónico no es válido.');
      if (mensaje === '') errores.push('El mensaje no puede estar vacío.');

      if (errores.length > 0) {
        mostrarAlerta(errores.join('<br>'));
      } else {
        mostrarAlerta('Formulario enviado correctamente. ¡Gracias por contactarnos!');
        formulario.reset();
      }
    });

    function mostrarAlerta(mensaje) {
      mensajeAlerta.innerHTML = mensaje;
      alerta.classList.remove('hidden');
    }

    function ocultarAlerta() {
      alerta.classList.add('hidden');
    }
  </script>
</body>
</html>
