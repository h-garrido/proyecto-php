<?php
// Configuración de la aplicación
const API_URL = 'https://whenisthenextmcufilm.com/api';  // URL de la API que proporciona los datos
const CACHE_FILE = __DIR__ . '/cache/api_response.json';  // Ubicación del archivo de caché
const CACHE_DURATION = 3600;  // Duración del caché en segundos (1 hora)