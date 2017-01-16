Razvojna okolina
=============================

Za polaznike Adriatic.hr PHP akademije pripremljen je posebni server na kojem će moći testirati programe u PHP i pisati svoj završni projekt.

Ovom serveru polaznici će moći pristupiti na predavanjima i sa svojih kućnih računala.

Na prvom predavanju svi će polaznici od predavača dobiti podatke potrebne za pristup serveru PHP akademije:
* korisničko ime u obliku **ime.prezime**
* inicijala polaznika
* nasumično generirana lozinka

Koristeći ove podatke svaki polaznik će moći pristupiti svojim datotekama, spojiti se preko SSH na server, spojiti se na MySQL server i otvoriti stranice svojih projekata u web pregledniku.

Svaki korisnik će na serveru imati tri direktorija, po jedan za svaku web aplikaciju koju će trebati raditi:
* **booking.{inicijali polaznika akademije}** - namijenjen za oglednu booking aplikaciju koju će razvijati kroz predavanja
* **example.{inicijali polaznika akademije}** - sve primjere koje ne možemo ugraditi u oglednu booking aplikaciju raditi ćemo ovdje
* **project.{inicijali polaznika akademije}** - direktorij gdje će polaznik raditi završni projekt koji odabere na početku akademije

## Uputstva za inicijalno postavljanje razvojne okoline:

1. Na računalu na kojem ćemo raditi otvoriti Windows **hosts** datoteku (*C:\Windows\System32\drivers\etc\hosts*) i dodati sljedeći tekst:
	```
  35.156.154.147 phpacademy
35.156.154.147 phpacademy.booking.{inicijali polaznika akademije}
35.156.154.147 phpacademy.example.{inicijali polaznika akademije}
35.156.154.147 phpacademy.project.{inicijali polaznika akademije}
  ```

	Ovo je potrebno kako bi mogli otvoriti stranice web aplikacija u pregledniku sa tog računala.
5. Sada možemo pristupiti direktorijima svake web aplikacije preko address bar-a od windows file explorera:
	* \\\\phpacademy\booking.{inicijali polaznika akademije}
	* \\\\phpacademy\example.{inicijali polaznika akademije}
	* \\\\phpacademy\project.{inicijali polaznika akademije}

	Windowsi će od nas tražiti da unesemo korisničko ime i lozinku koje smo dobili na početku akademije.
10. Za prijavu na MySQL server se koriste isti login podaci:
	* host: **phpacademy**
	* port: **3306**
	* username: **ime.prezime**
	* password: **lozinka dobivena na početku akademije**

	Svaki korisnik će imati pristup i mogućnost uređivanja triju baza podataka:
	* **booking_{inicijali polaznika akademije}**
	* **example_{inicijali polaznika akademije}**
	* **project_{inicijali polaznika akademije}**

	Za uređivanje baze može se koristiti [HeidiSQL](http://www.heidisql.com/download.php) ili [phpMyAdmin](http://phpacademy/phpmyadmin/).
15. Podaci za SSH pristup:
	* host name: **ime.prezime@phpacademy**
	* port: **22**
	* connection type: **SSH**

	Za SSH pristup serveru preporuča se korištenje [PuTTY klijenta](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html).

20. Web aplikacijama *booking*, *example* i *project* će se sa računala na kojem smo izmijenili *hosts* datoteku po uputama iz prvog koraka moći pristupiti preko URL-a:
	* ``` http://phpacademy.booking.{inicijali polaznika akademije} ```
	* ``` http://phpacademy.project.{inicijali polaznika akademije} ```
	* ``` http://phpacademy.example.{inicijali polaznika akademije} ```

	Ovi URL-ovi pokazuju na *web* direktorij unutar direktorija odgovarajuće web aplikacije, npr. za polaznika Peru Perića
	stranica ``` http://phpacademy.booking.pp ``` pokazuje na ``` \\\\phpacademy\\booking.pp\\web\ ``` direktorij na serveru.

	**VAŽNO**: Nikada nemojte podatke za prijavu spremati unutar *web* direktorija, jer je **sve** što se nalazi u njemu **vidljivo svima**.

## Konfiguracija i korištenje mail servera u Symfony-ju

Na ```phpacademy``` server instaliran je Mailhog mail server koji omogućava pregled svih izlaznih mailova preko [web sučelja](http://phpacademy:8025/). 

Symfony aplikaciju možemo jednostavno konfigurirati da koristi Mailhog server:

1. Postaviti sljedećih pet mailer_* parametara u ```app/config/parameters.yml.dist``` datoteku:
```
mailer_transport:  smtp
mailer_host:       phpacademy
mailer_user:       ~
mailer_password:   ~
mailer_port:       1025
```

2. Izbrisati sve mailer_* parametre iz ```app/config/parameters.yml``` datoteke. Ako nemate tu datoteku u ```app/config/``` direktoriju, preskočite ovaj korak.

3. Pokrenuti ```composer install``` naredbu iz roota aplikacije i kada Symfony zatraži mailer parametre samo prihvatiti zadane vrijednosti.

4. Za slanje mail-a iz Symfony-ja vidjeti službenu [dokumentaciju](http://symfony.com/doc/current/email.html). Primjer akcije za slanje email-a može se vidjeti i unutar [booking aplikacije](https://github.com/adriatichr/php-academy/commit/16751989933601437f99c1cde8d3fbdda523ba40#diff-e1223b33055e8c06db399471f0172ef5).

5. Svi mailovi koje pošaljete se mogu vidjeti na ovoj [stranici](http://phpacademy:8025/). Korisničko ime i lozinka su isti kao i podaci koje su polaznici dobili na početku akademije.
