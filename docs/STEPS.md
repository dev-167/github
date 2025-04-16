1. Ordnerstruktur erstellt. Check.

#####################################################################################

2. Datenbank erstellen. 

Datenbankmodell: (Rawversion 1.0)

employee_db (1.0)

    Tabelle users (für Mitarbeiterdaten).
    Tabelle roles (für Rechte und Rollen).
    Tabelle tasks (für Aufgaben).




#####################################################################################
                        Infos am Rande  :  
    Passwörter
        // var_dump(password_hash("findus92$",PASSWORD_DEFAULT));
        //var_dump(password_hash("Franz Beispiel12",PASSWORD_DEFAULT));
        // var_dump(password_hash("admin123$",PASSWORD_DEFAULT));
        ot0192939812, tim.obiant@outlook.com

    Mails:
        findus@example.com
        admin@test.com


    Weniger Code:
        Um weniger Code im Bereich HTML zu benutzen zb bei einer Form mit einer Methode zb  :  
        <?php form_text("title", "Title: $entry->title); >
#####################################################################################



////////////////////////////////Admin Login////////////////////////////////
    a.)LoginService.php->attempt function->password_verify abfrage ("Sobald die Abfrage des Passwort gültig ist bekommt der Login eine weitere $_SESSION namens "team"")
    b.)LoginController.php->login()->nach der attempt($user,$password) Abfrage wird eine weitere Abfrage gestellt, ob es sich um das team "Administration" handelt. Dann wird via header auf das admin/dashboard verwiesen.

    Update 10.03. 
    Eine Dynamische dashboard.php erstellen:
                <?php if ($role === 'admin'): ?>
                <!-- Admin-spezifische Links -->
                <li><a href="/dashboardAdmin">Admin-Dashboard</a></li>
                <li><a href="/user-management">User Management</a></li>
            <?php endif; ?>


UPDATE  :  dashboardAdmin im View Ordner in User Ordner erstellt. 

Fragen:
 echo "Dein Profil: " . json_encode($user); geht das wenn keine json datei vorhanden ist? Oder wie könnte ich die dort erstellen ansonsten?
 Ja, json_encode($user) funktioniert auch ohne eine JSON-Datei! 🚀!

///////////////////////////////
///////////////////////////////
///////////////////////////////
//////////////Ganz genau lesen was ein JSON macht in chat!///////////////
///////////////////////////////
///////////////////////////////


Falls du ein MVC-Framework oder eine eigene Controller-Logik verwendest, muss ein AdminController existieren, der die admin/dashboard-Route verarbeitet:

////////////////////////////////Admin Login////////////////////////////////
Row Avatar bearbeiten. 
Avatar soll als Image genutzt werden um ein Mitarbeiter Foto hochladen zu können


5. 
    adminLogin function erstellen.
    abfrage, dass anhand der Fachabteilung



////////////////////////////////Aktive Todos////////////////////////////////



Folgende Pages für den User sind aktiv unter  :  
Resources/views/user

Login ins User Dashboard des Mitarbeiters
    login.php -> dashboard.php
Dashboard
    dashboard.php
Dashboard Subpages
    -> home.php
    -> profil.php
    -> settings.php
    -> user-details.php
Admin
    -> login.php
    -> dashboard.php

