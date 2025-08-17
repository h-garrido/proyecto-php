# Próxima Película de Marvel (MCU)

Esta es una aplicación web moderna que muestra información sobre la próxima película del Universo Cinematográfico de Marvel (MCU). La aplicación obtiene datos en tiempo real de una API externa y los presenta en una interfaz atractiva con efectos visuales modernos.

## 🚀 Características Principales

- Muestra la próxima película del MCU
- Indica los días restantes hasta el estreno
- Muestra la fecha exacta de estreno
- Exhibe el póster oficial de la película
- Informa sobre la siguiente película programada
- Diseño responsivo y minimalista

## 🎨 Características de Diseño

- Header con efecto glassmórfico y título con gradiente
- Gradientes animados con 5 colores (incluyendo escarlata)
- Efecto glassmórfico en las tarjetas y header
- Modo claro/oscuro automático
- Animaciones suaves y transiciones
- Efectos de hover interactivos
- Diseño totalmente responsivo
- Sistema de color coherente en toda la aplicación

## 🛠 Tecnologías Utilizadas

- **PHP 8+**: Para el manejo de la lógica del servidor
- **cURL**: Para realizar las peticiones HTTP a la API
- **PicoCSS**: Framework CSS minimalista
- **CSS Moderno**: Variables CSS, animaciones, gradientes
- **API**: [whenisthenextmcufilm.com](https://whenisthenextmcufilm.com/api)

## Requisitos

- PHP 7.0 o superior
- Extensión cURL habilitada en PHP
- Servidor web (Apache, Nginx, etc.)

## Instalación

1. Clona este repositorio en tu servidor web:
   ```bash
   git clone [url-del-repositorio]
   ```

2. Asegúrate de que el servidor web tenga permisos de lectura sobre los archivos.

3. Accede al proyecto a través de tu navegador web:
   ```
   http://localhost/[ruta-al-proyecto]
   ```

## 📁 Estructura del Proyecto

```
proyecto-php/
│
├── cache/              # Directorio para el caché de la API
│
├── templates/          # Componentes modulares de la interfaz
│   ├── head.php       # Metadatos y enlaces CSS
│   ├── header.php     # Encabezado de la aplicación
│   ├── main.php       # Contenido principal
│   └── footer.php     # Pie de página
│
├── consts.php         # Constantes de configuración
├── functions.php      # Funciones auxiliares y de API
├── index.php          # Punto de entrada principal
├── styles.css         # Estilos y animaciones
└── README.md          # Esta documentación
```

### Componentes Principales

1. **Header (header.php)**
   - Título de la aplicación con efecto de gradiente
   - Subtítulo informativo
   - Diseño glassmórfico

2. **Contenido Principal (main.php)**
   - Póster de la película
   - Información de estreno
   - Contador de días
   - Datos de la siguiente película

3. **Estilos (styles.css)**
   - Sistema de colores dinámico (claro/oscuro)
   - Gradientes animados
   - Efectos glassmórficos
   - Diseño responsivo

## ⚙️ Configuración

Las principales configuraciones se encuentran en `consts.php`:

- `API_URL`: URL de la API de Marvel
- `CACHE_DURATION`: Duración del caché (por defecto 1 hora)
- `CACHE_FILE`: Ubicación del archivo de caché

## 🔐 Seguridad

- Escape de datos HTML para prevenir XSS
- Validación de respuestas de la API
- Manejo de errores y excepciones
- Sistema de caché para evitar sobrecarga de la API
- Verificación SSL en peticiones

## 🎯 Próximas Mejoras

- [ ] Implementar sistema de logs
- [ ] Agregar tests unitarios
- [ ] Mejorar el manejo de errores
- [ ] Agregar más efectos visuales
- [ ] Implementar PWA

## Contribuir

Si deseas contribuir al proyecto:

1. Haz un Fork del repositorio
2. Crea una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Haz commit de tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## Créditos

- API proporcionada por [whenisthenextmcufilm.com](https://whenisthenextmcufilm.com/)
- Estilos por [PicoCSS](https://picocss.com/)# proyecto-php
