## Instalacija na phpacademy server

Upute za instalaciju example aplikacije na *phpacademy* server:

1. Skinuti php-academy repozitorij na računalo
10. Kopirati **example** folder u ```\\phpacademy\example.{inicijali polaznika akademije}```
20. Unijeti podatke za pristup vašoj *example* bazi na *phpacademy* serveru u [app/mysql_config.json](app/mysql_config.json)
30. Spojiti se preko PuTTY klijenta na server i pokrenuti redom:
  * ```cd example```
  * ```composer install``` za instalaciju dependency paketa
  * ```vendor/bin/phpunit``` za unit testove
40. Unutar [web](web) direktorija sada možemo dodavati datoteke kojima se može pristupiti preko preglednika:
  * adresa ```http://phpacademy.example.{inicijali polaznika akademije}``` pokazuje na *web* direktorij
