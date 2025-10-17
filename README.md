Esta práctica implementa un sistema básico de autenticación (Registro y Login) utilizando **PHP puro** y gestionando el almacenamiento de usuarios mediante un **arreglo en memoria** almacenado en la variable de sesión (`$_SESSION['users']`).

Se han aplicado buenas prácticas de seguridad, incluyendo el **hashing de contraseñas** (`password_hash` y `password_verify`), y la protección de rutas mediante el manejo de sesiones.

Pasos para Ejecutar Localmente

Necesitas tener instalado PHP en tu sistema para ejecutar la aplicación.

1.  **Organizar los Archivos:** Coloca todos los archivos (`.php` y `style.css`) en un mismo directorio.

2.  **Abrir la Terminal:** Navega hasta el directorio raíz del proyecto en tu línea de comandos (usando el terminal integrado de VS Code, por ejemplo).

3.  **Iniciar el Servidor de Desarrollo de PHP:** Ejecuta el siguiente comando:

    ```bash
    php -S localhost:8000
    ```

4.  **Accede a la Aplicación:** Abre tu navegador web y dirígete a la URL:

    ```
    http://localhost:8000/
    ```

 Flujo de Prueba de Autenticación

1.  **Registro:** Crea un nuevo usuario en `/register.php`.
2.  **Login:** Inicia sesión con las nuevas credenciales. Serás redirigido a `/dashboard.php`.
3.  **Dashboard (Ruta Protegida):** Verifica que se muestre tu información. Intenta acceder a esta ruta sin iniciar sesión (debería fallar y redirigir al login)
4.  **Cerrar Sesión:** Usa el enlace de "Cerrar Sesión" (`/logout.php`). El usuario registrado persistirá en la "base de datos" en memoria
5.  **Re-Login:** Vuelve a iniciar sesión con el mismo usuario para confirmar que la persistencia y la autenticación funcionan correctamente después de un *logout*