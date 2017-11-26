See: 
	http://localhost/giusi/help.htm
	web/help.htm
	
-----

Was willst du machen?

X) Lokal entwickeln.

A) neuen Jahresplan importieren

B) Das Projekt backupen

C) Files auf den Server FTPlen

D) Datenbank ansehen/manipulieren

E) Datenbank dump erstellen


-----

So funktioniert's:


X) Lokal entwickeln.

Dank dem Eintrag 
  Alias /giusi "K:/workspace_eclipse_php/giusi/web"
im apache config, kann man auf die lokalen files über die URL 
  http://localhost/giusi/
zugreifen.

Möglich macht's XAMPP! 
  (http://www.apachefriends.org/de/xampp-windows.html)
Installiert ist es bei mir unter 
  Start > Alle Programme > apachefriends > xampp

Der Installer befindet sich auf: 
  L:\SOFTWARE\_Development\xampp-win32-1.5.2-installer.exe


Trouble-Shooting: 

Q: Die localhost URL funktioniert nicht. Apache will nicht starten.
A: Jemand anders (z.B. Ruby) blockiert den Port. --> Klick das rote I unten rechts und stoppe Apache und MySQL



A) neuen Jahresplan importieren

--> Um den Jahresplan zu generieren, benutze die Klasse ch.hyperraum.giusi.CalendarGenerator.java im Java-Projekt tools! (Location: F:\workspace_eclipse_java\tools)

0. Mach zur Sicherheit erst mal einen Datenbank dump! (Siehe Punkt E!)

1. Öffne in einem Browser die URL 
    giusi/initjahr.php

   Source-code der Seite: initjahr.php

2. Gib dort das gewünschte Jahr sowie den korrekt formatierten Jahresplan ein! 
   Beispiel: 
    15,07.4. - 14.4.,Ruedi;
    16,14.4. - 21.4.,Ruedi;
    17,21.4. - 28.4.,Hanspi;
    18,28.4. - 05.5.,Hanspi;
    ...
   siehe auch z.B.:
    giusi/data-import/2006.txt

3. Eingabe prüfen (Punkt D) und z.B.
   SELECT * FROM `giusiwochen` WHERE jahr=2007
   
4. giusi.php anpassen:

	<?php printYear(2010, true, true, "giusi.php"); ?>

   Solange der alte Plan noch aktuell ist, kannst du den neuen in giusi.php verlinken mit (Bsp. für 2007):
   
   	<a href="history.php?jahr=2007">Belegungsplan für das Jahr 2007</a>
				
5. giusi.php auf den server per FTP (siehe Punkt C)

Trouble-Shooting: 

Q: Kann nicht zur DB verbinden.
A: Das Passwort mag sich geändert haben. Kopiere die Funktion getDB() aus kalender.php!

Q: Hab vergessen, das Jahr zu setzen...
A: Dann lösche alle Einträge mit Jahr=null von Hand, über den PhpMyAdmin!
   SQL: 
     DELETE from giusiwochen WHERE jahr=0

Q: Es wird nur eine Woche gesetzt, obwohl ich alle eingegeben habe
A: Wetten du hast das Semikolon (;) am Ende jeder Zeile vergessen?



C) Files auf den Server FTPlen

Zugangsdaten siehe: admin/login.txt
FTP-URL: 
  ftp://login-1.hoststar.ch/html/giusi/ (im Browser eingeben!)
URL von PHPMyAdmin:
  http://login-1.hoststar.ch/user/index.php


D) Datenbank ansehen/manipulieren

goto:
	http://login-1.hoststar.ch/phpMyAdmin/?db=usr_web119_2

oder:
	1. Log dich auf hoststar ein: 
	    http://login-1.hoststar.ch/user/index.php (web119/uranus)
	2. Wähle MySQL und log dich ein (web119/calopterix)
	3. Wähle die Datenbank usr_web119_2 und die Tabelle "giusiwochen"
	4. Wähle im horizontalen Menu "Anzeigen", "Struktur" oder "SQL"


E) Datenbank dump erstellen

1. Zum Einloggen sehe Punkt D!
2. Wähle im horizontalen Menu "Exportieren"
3. Alle Einstellungen sind ok so, einfach unten "OK" klicken
4. Den dump per copy/paste sichern: 
   1. CTRL-A (alles auswählen)
   2. CTRL-C (copy)
   3. das file data-import/SQL_dump.txt öffnen.
   4. CTRL-A (alles auswählen)
   5. CTRL-V (einfügen) 
   6. CTRL-S (speichern)


