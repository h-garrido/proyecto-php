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

- **PHP 7.4+**: Para el manejo de la lógica del servidor y tipos estrictos
- **cURL**: Para realizar las peticiones HTTP a la API
- **PicoCSS 2.0**: Framework CSS minimalista y moderno
- **CSS Moderno**: Variables CSS, animaciones, gradientes, glassmorphism
- **API**: [whenisthenextmcufilm.com](https://whenisthenextmcufilm.com/api)
- **HTML5**: Estructura semántica y accesible
- **Sistema de Caché**: Optimización de rendimiento
- **Responsive Design**: Mobile-first approach

## Requisitos

- PHP 7.4 o superior (recomendado PHP 8+)
- Extensión cURL habilitada en PHP
- Servidor web (Apache, Nginx, etc.)
- Permisos de escritura en el directorio `/cache`
- Navegador moderno con soporte para CSS Grid y Variables CSS

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
│   └── api_response.json  # Archivo de caché de respuestas
│
├── config/            # Configuraciones del sistema
│   ├── consts.php    # Constantes y configuraciones
│   └── functions.php # Funciones auxiliares y de API
│
├── css/              # Estilos de la aplicación
│   └── styles.css    # Estilos y animaciones CSS
│
├── templates/        # Componentes modulares de la interfaz
│   ├── head.php     # Metadatos y enlaces CSS
│   ├── header.php   # Encabezado de la aplicación
│   ├── main.php     # Contenido principal
│   ├── navbar.php   # Barra de navegación
│   └── footer.php   # Pie de página
│
├── index.php        # Punto de entrada principal
└── README.md        # Esta documentación
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
- Timeout configurado para peticiones API
- Headers HTTP seguros
- Protección contra inyección de código
- Manejo seguro de archivos de caché

## 🌐 Accesibilidad

- Roles ARIA implementados
- Alto contraste y modo oscuro
- Estructura HTML semántica
- Focus visible en elementos interactivos
- Textos alternativos para imágenes
- Navegación por teclado
- Mensajes de error claros

## 🎯 Próximas Mejoras

- [ ] Implementar sistema de logs detallado
- [ ] Agregar tests unitarios y de integración
- [ ] Mejorar el manejo de errores y logging
- [ ] Agregar más efectos visuales y animaciones
- [ ] Implementar PWA para uso offline
- [ ] Optimización de rendimiento y compresión de assets
- [ ] Integración con CI/CD
- [ ] Panel de administración
- [ ] Caché con Redis/Memcached
- [ ] Dockerización del proyecto

## 🔄 Performance

- Sistema de caché eficiente
- Carga lazy de imágenes
- CSS y HTML optimizados
- Compresión de respuestas HTTP
- Minimización de peticiones a la API
- Assets optimizados
- Tiempo de respuesta rápido

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
