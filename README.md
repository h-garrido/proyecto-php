# Próxima Película de Marvel (MCU)

Esta es una aplicación web simple que muestra información sobre la próxima película del Universo Cinematográfico de Marvel (MCU). La aplicación obtiene datos en tiempo real de una API externa y los presenta en una interfaz limpia y minimalista.

## Características

- Muestra la próxima película del MCU
- Indica los días restantes hasta el estreno
- Muestra la fecha exacta de estreno
- Exhibe el póster oficial de la película
- Informa sobre la siguiente película programada
- Diseño responsivo y minimalista

## Tecnologías Utilizadas

- **PHP**: Para el manejo de la lógica del servidor y las peticiones a la API
- **cURL**: Para realizar las peticiones HTTP a la API externa
- **PicoCSS**: Framework CSS minimalista para el estilizado
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

## Estructura del Proyecto

```
proyecto-php/
│
├── index.php      # Archivo principal que maneja la lógica y la visualización
└── README.md      # Este archivo
```

## Cómo Funciona

1. La aplicación realiza una petición a la API de whenisthenextmcufilm.com
2. Los datos se reciben en formato JSON y se procesan
3. La información se muestra en una interfaz limpia y fácil de leer
4. Los estilos se aplican usando PicoCSS para una presentación minimalista

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
