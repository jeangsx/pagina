# Chenati Sports - Diseño Premium Apple 2026

## ✨ Visión General
Rediseño completo de tu tienda online con estilo **ultra minimalista** inspirado en **apple.com** y **iPhone 2026**. Lujo tecnológico, espacios en blanco generosos, tipografía premium y experiencia fluida.

---

## 📱 Cómo Acceder
```
http://localhost/pagina/public/chenati-landing.php
```

---

## 🎨 Características de Diseño

### Navegación
- **Fija en la parte superior** con fondo transparente (blur effect)
- Logo "Chenati Sports" en negro puro
- Menú derecha: Hombre | Mujer | Niños | Ofertas | Contacto
- Sin hover agresivo, transiciones suaves

### Hero Section (Full-Screen)
- Altura: 100vh (pantalla completa)
- Imagen zapatilla centrada, enorme, alta calidad
- **Títulos**: "Chenati Pro Max" o "Chenati Ultra"
  - Tamaño: 96px en desktop
  - Peso: Bold 700
  - Letter-spacing: -0.03em (Apple style)
- **Subtítulo**: "Rendimiento élite. Comodidad superior. Diseñada para durar."
  - Tamaño: 36px
  - Peso: Light 300
  - Color: Gris oscuro (#555)
- **Botones CTA**:
  - Primario: Fondo negro con texto blanco "Comprar ahora"
  - Secundario: Borde negro con fondo transparente "Ver colección"
  - Border-radius: 12px
  - Hover: Elevación sutil (-2px)

### Feature Sections (3 secc.)
- Layout alternado: imagen + contenido
- Muchísimo white space vertical (120px)
- **Títulos**: 48px bold, letra spacing negativa
- **Descriptivos**: 18px gris oscuro, máx ancho 500px
- **Links**: Azul Apple (#0066CC) con animación flecha "Saber más"
- Sombras drop-shadow suaves (8-60px, 6-8% opacidad)

### Colección de Productos
- **Grid**: 3 columnas en desktop, 2 en tablet, 1 en mobile
- **Spacing**: 60px entre tarjetas
- **Tarjetas**:
  - Imagen sin borde (border-radius 12px)
  - Hover: zoom ligero (1.05x)
  - Nombre modelo + Precio bold negro
  - Link "Comprar" en azul
  - Sin sombras duras

### Footer
- Fondo gris claro (#F5F5F7)
- Links pequeños (14px) en gris
- Copyright centrado
- Espaciado: 80px top/bottom padding

---

## 🎯 Paleta de Colores (Exacta)
| Color | Código | Uso |
|-------|--------|-----|
| Blanco Puro | #FFFFFF | Fondo principal |
| Negro | #000000 | Títulos, logo |
| Gris Oscuro | #1C1C1E | Body text principal |
| Gris Body | #555555 | Párrafos, descripciones |
| Gris Claro | #F5F5F7 | Fondo footer |
| Azul Apple | #0066CC | Links, acentos |

---

## 🔤 Tipografía
**Font Stack**: `-apple-system, BlinkMacSystemFont, "SF Pro Display", Segoe UI, Roboto, sans-serif`

| Elemento | Tamaño | Peso | Tracking |
|----------|--------|------|----------|
| Hero Title | 96px | 700 Bold | -0.03em |
| Hero Subtitle | 36px | 300 Light | -0.01em |
| Feature Title | 48px | 700 Bold | -0.02em |
| Colección Title | 56px | 700 Bold | -0.02em |
| Body Text | 18px | 400 Regular | 0.01em |
| Links | 17px | 500 Medium | 0.01em |

---

## 🔄 Responsive (Mobile-First)
- **Desktop** (1200px+): Grid 3 columnas
- **Tablet** (768px-1023px): Grid 2 columnas, font sizes reducidos
- **Mobile** (<768px): Single column, layouts apilados, fonte mas pequeña

---

## ⚡ Interactividad (JavaScript)
✓ **Smooth scroll** en navegación
✓ **Navbar dinámico** (sombra en scroll)
✓ **Lazy loading** de imágenes con fade-in
✓ **Button ripple effect** subtle
✓ **Feature animations** al scrollear (Intersection Observer)
✓ **Keyboard navigation** accesible
✓ **Performance optimized** (RAF para scroll)

---

## 📁 Archivos Incluidos
```
/public/
├── chenati-landing.php     # Estructura HTML
├── chenati-styles.css       # Estilos completos (2000+ líneas)
├── chenati-script.js        # Interactividad (400+ líneas)
└── index.php [original]     # Estructura MVC existente
```

---

## 🚀 Características Premium
✨ **Ultra minimalista** - Sin clutter, sin distracción  
✨ **Espacios generosos** - 80-120px white space  
✨ **Transiciones suaves** - ease 0.3s en todo  
✨ **Sombras sutiles** - Drop shadows con 4-8% opacidad  
✨ **Tipografía perfecta** - Apple San Francisco + letter-spacing negativo  
✨ **Accesibilidad** - Keyboard nav, focus states, ARIA labels  
✨ **Performance** - Lazy loading, intersection obs, RAF optimization  
✨ **Responsive** - Desktop/tablet/mobile totalmente adaptable  

---

## 🎬 Próximos Pasos
1. Reemplazar imágenes placeholder con tus zapatillas reales
2. Conectar botones CTA a tu carrito/sistema de compra
3. Agregar más productos en la sección colección
4. Implementar formulario de contacto en footer
5. Integrar sistema de pagos
6. Agregar analytics (Google Analytics, Hotjar)
7. Optimizar imágenes (WebP, srcset responsivo)
8. Agregar certificado SSL (https)

---

## 📞 Contacto & Soporte
Las clases CSS están documentadas y son fáciles de customizar.  
Todos los colores, tamaños y espaciados se definen en variables CSS `:root`

Modificar en `chenati-styles.css`:
```css
:root {
    --font-family: /* cambiar fuente */
    --color-white: /* cambiar blanco */
    --color-black: /* cambiar negro */
    --spacing-xl: /* cambiar espacios grandes */
    /* ... etc */
}
```

---

**Diseño creado**: 9 de marzo 2026  
**Versión**: 1.0 Premium  
**Estilo**: Apple.com iPhone 2026 Official Style
