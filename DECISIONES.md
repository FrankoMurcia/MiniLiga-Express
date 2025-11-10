\# 📋 Decisiones Técnicas - Mini Liga



\## 🎯 Decisiones de Arquitectura



\### 1. Backend: Laravel

\*\*Decisión\*\*: Usar Laravel como framework backend.



\*\*Por qué\*\*:

\- ✅ ORM Eloquent facilita las consultas a la base de datos

\- ✅ Sistema de rutas API muy simple

\- ✅ Migraciones para control de versiones de BD

\- ✅ Comunidad grande y muchos tutoriales



\*\*Trade-offs\*\*:

\- ❌ Laravel es más pesado que frameworks como Lumen

\- ❌ Requiere más recursos del servidor

\- ⚖️ \*\*Conclusión\*\*: Para un MVP, la velocidad de desarrollo es más importante que la optimización extrema



---



\### 2. Frontend Web: Angular

\*\*Decisión\*\*: Usar Angular en lugar de React o Vue.



\*\*Por qué\*\*:

\- ✅ TypeScript obligatorio = menos errores

\- ✅ Todo incluido (routing, HTTP, forms)

\- ✅ Buena integración con Ionic



\*\*Trade-offs\*\*:

\- ❌ Curva de aprendizaje más alta

\- ❌ Archivos de configuración complejos

\- ⚖️ \*\*Conclusión\*\*: Angular es mejor para proyectos grandes que crecerán



---



\### 3. Mobile: Ionic

\*\*Decisión\*\*: Ionic en lugar de React Native o Flutter.



\*\*Por qué\*\*:

\- ✅ Reutilizamos código de Angular

\- ✅ Una sola base de código para iOS y Android

\- ✅ Componentes UI listos para usar



\*\*Trade-offs\*\*:

\- ❌ Performance no tan buena como apps nativas

\- ❌ Dependemos de WebView

\- ⚖️ \*\*Conclusión\*\*: Para un MVP, rapidez > performance nativa



---



\### 4. Base de Datos: MySQL

\*\*Decisión\*\*: MySQL en lugar de PostgreSQL o MongoDB.



\*\*Por qué\*\*:

\- ✅ Más fácil de instalar localmente

\- ✅ Laravel lo soporta por defecto

\- ✅ Hosting gratis más común



\*\*Trade-offs\*\*:

\- ❌ Menos features avanzados que PostgreSQL

\- ⚖️ \*\*Conclusión\*\*: Suficiente para el MVP



---



\### 5. Sin Autenticación (MVP)

\*\*Decisión\*\*: No implementar login en la primera versión.



\*\*Por qué\*\*:

\- ✅ Enfoque en funcionalidad principal

\- ✅ Más rápido de desarrollar

\- ✅ Fácil de probar



\*\*Trade-offs\*\*:

\- ❌ No es seguro para producción

\- ❌ Cualquiera puede modificar datos

\- ⚖️ \*\*Conclusión\*\*: Será la primera feature post-MVP



---



\## 🚀 Próximos Pasos



\### Versión 1.1 (2 semanas)

\- \[ ] Autenticación con JWT

\- \[ ] Roles (admin, capitán, jugador)

\- \[ ] Recuperar contraseña



\### Versión 1.2 (1 mes)

\- \[ ] Subir fotos de equipos

\- \[ ] Gráficas de estadísticas

\- \[ ] Sistema de notificaciones



\### Versión 2.0 (3 meses)

\- \[ ] Chat entre equipos

\- \[ ] Transmisión en vivo de partidos

\- \[ ] Sistema de pagos (cuotas)

\- \[ ] App para árbitros



---



\## 🐛 Problemas Conocidos



1\. \*\*CORS en producción\*\*: Actualmente configurado para desarrollo (`allowed\_origins: \*`). Debe configurarse correctamente en producción.



2\. \*\*Sin validación de formularios\*\*: Los formularios no validan bien los datos. Agregar validaciones en backend y frontend.



3\. \*\*Imágenes\*\*: Las URLs de logos están hardcodeadas. Implementar subida de archivos.



4\. \*\*Performance\*\*: La tabla de posiciones hace una consulta por cada equipo. Optimizar con una sola query.



---



\## 📚 Recursos Consultados



\- \[Documentación Laravel](https://laravel.com/docs)

\- \[Documentación Angular](https://angular.io/docs)

\- \[Documentación Ionic](https://ionicframework.com/docs)

\- \[Tutorial CORS Laravel](https://laravel.com/docs/cors)



---




\*\*Última actualización\*\*: 11 Noviembre 2025

