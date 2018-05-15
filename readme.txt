Konfigurācijas dati

/etc/apache2/sites-available/000-default.conf failā ieraksts

<VirtualHost *:80>
    ServerName uzd.local
    DocumentRoot /mana/uzdevuma/root/direktorija
	
	DirectoryIndex index.php
	
	<Directory />
            Options Indexes FollowSymLinks
		    AllowOverride all
		    Require all granted
    </Directory>
</VirtualHost>


etc/hosts failā ieraksts

127.0.0.1	uzd.local

mySql
server version: 5.7.21-0ubuntu0.16.04.1 - (Ubuntu)

php
version: 7.2.4-1+ubuntu16.04.1+deb.sury.org+1

Papildus jāsagatavo fails uzdevuma root direktorijā
config/config.php