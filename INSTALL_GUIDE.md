# Install Guide Local Development Concept500

## Windows
- download PHP 8.X of hoger ( https://windows.php.net/download#php-8.3 ) ( Thread Safe version, ZIP )
- Om concept te kunnen starten zul je de volgende PHP extensies aan moeten zetten in je php.ini file
    - extension=curl
    - extension=fileinfo
    - extension=gd
    - extension=intl
    - extension=mbstring
    - extension=openssl
    - extension=pdo_mysql
- Zorg dat docker desktop geïnstalleerd is, voer dan het commando `docker-compose up -d of klik op dubbele pijl bij services in docker-compose.yml` uit in de root van het project
- Open een terminal in de root van het project en voer het commando `composer install` uit
- Voer ook het commando `npm install` uit in de root van het project
- Maak een `.env` bestand aan in de root van het project en kopieer de inhoud van `gedeelde .env` hierin.
- Voer het command `php artisan migrate:fresh` uit in de root van het project (voert alle migrations uit en leegt de database als deze er is)
- Voer het commando `php artisan db:seed` uit in de root van het project (voert alle seeders uit)
- voer het commando `npm run dev` uit in de root van het project (compileert de assets)
- voer het commando `php artisan serve` uit in de root van het project (start de server)
- Als het goed is draait de website nu op `localhost:8000 of 127.0.0.1`

## commands
- het commando `php artisan` geeft een lijst van alle commands die je kunt uitvoeren
- het commando `php artisan make:controller ControllerName` maakt een nieuwe controller aan, dit geldt ook voor de andere commando's (controller is een voorbeeld)
- het commando `php artisan optimize:clear` cleared de cache van de website
- het commando `php artisan migrate` voert de laatste migratie uit
- het commando `php artisan migrate:rollback` rolt de laatste migratie terug
- het commando `php artisan migrate:refresh` rolt alle migraties terug en voert ze opnieuw uit
- het commando `php artisan db:seed` voert alle seeders uit
- het commando `npm run dev` compileert de assets
- het commando `php artisan serve` start de server

### voor formatting
- het commando `./vendor/bin/pint` uit in de de root van het project om de code te formatten

## composer, npm
- `composer install` en `npm install` installeren alle benodigde packages voor het project wanneer er nieuwe packages zijn toegevoegd
