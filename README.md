# Diversworld Theme Bundle für Contao CMS

[![License](https://img.shields.io/badge/license-LGPL--3.0--or--later-blue)](LICENSE)
[![Contao](https://img.shields.io/badge/Contao-5.7%2B%20%7C%206.0%2B-green)](https://contao.org)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-purple)](https://www.php.net)

Ein modernes, Contao-konformes Theme-Bundle mit responsivem Design, Theme Helper Integration und vollständiger Barrierefreiheit (WCAG 2.1 AA).

## Features

- ✅ **Responsive Header** mit Logo und Multi-Level-Navigation
- ✅ **SASS-basierte Stylesheets** mit automatischer Optimierung
- ✅ **Contao 5.7+ & 6.0+ Support** vollständig getestet
- ✅ **Accessibility (a11y)** WCAG 2.1 AA Best-Practices
- ✅ **Theme Helper Integration** für Tag-basierte Inhaltsverwaltung
- ✅ **Performance-optimiert** mit statischen CSS-Flags
- ✅ **Modern PHP Stack** PSR-4, Strict Types, Symfony 7.x

## Installation

### 1. Via Composer

```bash
composer require diversworld/contao-diversworld-theme-bundle
```

### 2. Dependencies installieren

```bash
npm install
npm run build
```

### 3. Contao aktualisieren

```bash
php bin/console cache:clear
```

### 4. Theme im Backend auswählen

Im Contao Backend unter **Design → Layouts** das Theme "Diversworld" auswählen und den Layout-Typ konfigurieren.

## Entwicklung

### CSS im Watch-Modus kompilieren

```bash
npm run dev
```

Dies startet SASS im Watch-Modus und kompiliert SCSS-Änderungen automatisch zu `public/css/diversworld.css`.

### Nur einmalig build

```bash
npm run build
```

Erstellt die komprimierten CSS-Dateien für Production.

## Projektstruktur

```
contao-diversworld-theme-bundle/
├── src/
│   ├── ContaoDiversworldThemeBundle.php      # Bundle-Klasse
│   ├── ContaoManager/
│   │   └── Plugin.php                        # Contao Manager Integration
│   └── EventListener/
│       └── LayoutEventListener.php           # CSS-Loading via Event
├── config/
│   └── services.yaml                         # Dependency Injection
├── contao/
│   ├── config/
│   │   └── config.php                        # Theme-Tags & Globale Config
│   └── templates/
│       ├── page/layout/
│       │   └── diversworld.html.twig         # Master Layout
│       ├── mod_navigation_diversworld.html.twig   # Navigation Wrapper
│       └── nav_diversworld.html.twig         # Rekursive Navlisten
├── assets/
│   ├── scss/                                 # SASS Source Files
│   ├── js/                                   # JavaScript (optional)
│   └── css/                                  # Kompilierte CSS (nicht committen)
└── public/
    └── css/
        └── diversworld.css                   # Veröffentlichte CSS

```

## Konfiguration

### Theme-Tags registrieren

In `contao/config/config.php` können Theme-Tags für die Inhaltsorganisation definiert werden:

```php
$GLOBALS['tl_config']['theme_tags'] = [
    'DW01/01',  // Kategorie 1.1
    'DW01/02',  // Kategorie 1.2
    'DW02/01',  // Kategorie 2.1
];
```

Diese Tags erscheinen im Contao Backend in Artikel-Bearbeitungsfeldern, wenn das **Theme Helper Bundle** installiert ist.

### CSS Loading

Das Bundle lädt CSS automatisch via `LayoutEventListener`:

```php
// In src/EventListener/LayoutEventListener.php
$GLOBALS['TL_CSS'][] = 'bundles/contaodiversworldtheme/css/diversworld.css|static';
```

Das `|static` Flag optimiert Browser-Caching.

## Layout-Struktur

Das Master-Layout (`contao/templates/page/layout/diversworld.html.twig`) definiert folgende Slots:

| Slot | Zweck | Optionen |
|------|-------|----------|
| `header` | Logo + Navigation | Responsive Flex-Layout |
| `hero` | Hero-Sektion | Full-Width Container |
| `left` | Linke Sidebar | Optional |
| `main` | Hauptinhaltsbereich | Responsive Grid |
| `right` | Rechte Sidebar | Optional |
| `footer` | Footer-Bereich | Multi-Column Layout |

## Navigation

Das Bundle enthält spezialisierte Navigation-Templates:

- **mod_navigation_diversworld.html.twig**: Frontend-Modul-Wrapper mit Barrierefreiheit
- **nav_diversworld.html.twig**: Rekursive Navigation-Liste mit Multi-Level-Support

Beide Templates nutzen Contao's Standard-Datenvertrag:
- `items|raw` für vorgenerierte HTML-Navigation
- `level_1`, `level_2`, `level_3` CSS-Klassen
- `active`, `trail`, `submenu` State-Klassen

## CSS Classes

### Navigation

```html
<!-- Level 1 Navigation -->
<ul class="level_1">
  <li class="active">
    <strong>Aktive Seite</strong>
    <!-- Level 2 Submenu -->
    <ul class="level_2">
      <li class="trail"><a href="#">Aktueller Pfad</a></li>
    </ul>
  </li>
</ul>
```

Verfügbare Klassen:
- `.level_1`, `.level_2`, `.level_3` - Navigations-Ebene
- `.active` - Aktuelle Seite
- `.trail` - Pfad zur aktuellen Seite
- `.submenu` - Hat Untermenü

## Barrierefreiheit (Accessibility)

Das Bundle implementiert WCAG 2.1 AA Standards:

- ✅ **Skip-Links**: `<a href="#main" class="invisible">Navigation überspringen</a>`
- ✅ **ARIA-Labels**: `aria-label`, `aria-current="page"`, `aria-haspopup`
- ✅ **Semantic HTML**: `<nav>`, `<main>`, `<footer>`, `<aside>`, `<header>`
- ✅ **Kontrastverhalten**: Optimierte Farben (s. SCSS)
- ✅ **Fokus-Management**: Sichtbare Focus-States

## Anforderungen

- **PHP**: ≥ 8.2
- **Contao**: ≥ 5.7 oder ≥ 6.0
- **Node.js** (für SASS-Builds): ≥ 18.x

### Optional
- **pdir/contao-theme-helper-bundle**: Für erweiterte Tag-Funktionalität
- **contao-themes-net/theme-components-bundle**: Für zusätzliche Components

## Kompatibilität

| Version | Contao 5.7 | Contao 6.0+ | Status |
|---------|-----------|-----------|--------|
| 1.0.0 | ✅ | ✅ | Stabil |

Alle APIs sind Forward-Compatible. Das Bundle wurde gegen beide Versionen getestet.

## Lizenz

Dieses Bundle unterliegt der **LGPL-3.0-or-later** Lizenz.

```
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Lesser General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later version.
```

Siehe [LICENSE](LICENSE) für vollständigen Text.

## Support & Entwicklung

Probleme oder Feature-Requests:

```bash
# Repository auschecken
git clone https://github.com/diversworld/contao-diversworld-theme-bundle.git

# Entwicklung starten
npm install
npm run dev  # SASS Watch-Modus
```

## Credits

Entwickelt für **Diversworld** als moderne Theme-Lösung für Contao CMS.

---

**Dokumentation zuletzt aktualisiert**: 2026-08-31  
**Bundle-Version**: 1.0.0  
**Autor**: Diversworld
