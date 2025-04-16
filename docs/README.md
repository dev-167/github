Projekt Titel: employee-portal

# BESCHREIBUNG
Das Mitarbeiter-Portal ist eine Webanwendung zur Verwaltung von Benutzern, Produkten und anderen Ressourcen.

# INSTALLATION
1. Klone das Repository.
2. Installiere die Abhängigkeiten mit `composer install`.
3. Konfiguriere die Datenbank in `/config/database.php`.
4. Führe die Migrationen aus.
5. Starte den Server.

# LINKS
- [Anforderungen](docs/ANFORDERUNGEN.md)
- [Architektur](docs/ARCHITEKTUR.md)
- [API-Dokumentation](docs/api/API.md)


# VERZEICHNISSTRUKTUR


Ordnerstruktur:

employee-portal/
├── app/                 # PHP-Logik (Controller, Models)
├── public/              # Öffentlich zugängliche Dateien (index.php, CSS, JS)
├── resources/           # Views (HTML, Blade-Templates bei Laravel)
├── database/            # Datenbank-Migrations- und Seeder-Dateien
├── tests/               # Tests (Unit-Tests und Feature-Tests)
├── config/              # Konfigurationsdateien
└── README.md            # Beschreibung des Projekts

Verzeichnisstruktur:

/projekt_root
    ├── /public            <-- (Öffentliche Dateien) (z. B. index.php, Assets)
    ├── /resources         <-- (HTML-Templatesviews)
    │   ├── /views         <-- admin,layout,user
    │   |––––––––admin     <-- admin pages
    │   |––––––––layout    <-- Template layouts header,footer etc
    │   |––––––––user      <-- user pages
    ├── /src               <-- Haupt-Quellcode
    │   ├── /Core          <-- (Kernfunktionalitäten) AbstractRepository, AbstractModel,AbstractController)
    │   ├── /Model         <-- Klassen (AnnouncementsModel)
    │   ├── /Repository    <-- Repository-Klassen (AnnouncementsRepository)
    │   ├── /Controllers   <-- Controller
    │   ├── /User          <-- DashboardController,DashboardService,LoginController,LoginService,UserModel,UserRepository
    │   ├── /Admin         <-- AdminController,AdminService
    ├── /config            <-- database(Datenbankverbindung),config, routes
    ├── /tests             <-- Unit-Tests und andere Tests
    ├── /vendor            <-- Abhängigkeiten (z. B. Composer Libraries)
    ├── composer.json      <-- Composer Konfigurationsdatei
    └── init.php           <-- Initialisierung des Projekts



# INSTALLATION


# TESTANLEITUNG



### Erläuterungen:
- **Überschriften**: `#` für die Hauptüberschrift, `##` für Unterüberschriften.
- **Code-Blöcke**: Dreifache Backticks (`` ``` ``) für mehrzeilige Code-Blöcke, einfache Backticks (`` ` ``) für einzelne Befehle.
- **Trennlinien**: `---` oder `***` für visuelle Trennung zwischen Abschnitten.
- **Listen**: Einfache Aufzählungen mit `-` oder `*`.