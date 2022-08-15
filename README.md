

# STARTERKIT - Laravel Personal Starterkit

## Instalation 
 - Instal starterkit package <br>
 <code>composer require laililmahfud/starterkit</code>
 - Setting database connection on .env
 - Adds starterkit provider on config/app.php <br>
 <code>\laililmahfud\starterkit\LaililMahfudStarterkitServiceProvider::class</code>
 - Install Startertkit <br>
  <code>php artisan starterkit:install</code>
 - Open browser and go to project root url
 - Login access <br>
  <code>username : admin@starterkit.com</code><br>
  <code>password : 12345678</code>

## Note
- All of table primary key must use uuid and name is id


## API Starterkit
- run command <br>
<code>php artisan starterkit:api --path=api-url --controller=ApiNameController</code>