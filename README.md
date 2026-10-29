# ReciclaCDMX

## Versión actual
0.5.0

## Cambios incorporados en v0.5.0 (Tarea 5)
- Integración de inicio de sesión mediante `session_start()` e interrupción de acceso en páginas protegidas
- Guardado del estado temporal del usuario a través de la variable superglobal `$_SESSION`
- Implementación de la función `setcookie()` para recordar el correo de acceso en el formulario, recuperándolo con `$_COOKIE`
- Adaptación dinámica de la barra de navegación dependiendo del rol del usuario (Visitante vs. Registrado vs. Administrador)
- Bloques de código documentados con comentarios breves descriptivos.

## Usuarios de prueba temporales 
Utiliza los siguientes datos ficticios para comprobar los roles y el inicio de sesión del portal:

| Usuario / Correo | Contraseña de prueba | Rol en el sistema |
| :--- | :--- | :--- |
| `ciudadano@recicla.com` | `12345` | Ciudadano (Acceso a portal de registro) |
| `admin@recicla.com` | `admin2026` | Administrador (Acceso a portal y vista Admin) |

## Base de datos propuesta (Preparación Fase 2)
Para escalar este proyecto a un entorno con persistencia de datos, se requerirán las siguientes tablas fundamentales:

**1. Tabla: `usuarios`**
- **Información a almacenar:** Credenciales de acceso, datos personales y perfiles de los ciudadanos y administradores del portal.
- **Campos principales:** `id_usuario` (PK), `nombre_completo`, `correo_electronico`, `contrasena_hash`, `rol_usuario`, `fecha_registro`.

**2. Tabla: `centros_acopio`**
- **Información a almacenar:** El catálogo oficial de los módulos de recepción, su ubicación física y su capacidad operativa en tiempo real.
- **Campos principales:** `id_centro` (PK), `nombre_sede`, `alcaldia`, `materiales_aceptados`, `estado_operativo` (boolean), `nivel_capacidad`.

**3. Tabla: `registros_entregas`**
- **Información a almacenar:** El historial de todos los aportes ciudadanos programados, enlazando al usuario con el centro de recolección.
- **Campos principales:** `id_registro` (PK), `id_usuario` (FK), `id_centro` (FK), `tipo_residuo`, `peso_kg`, `huella_co2_mitigada`, `fecha_entrega`.