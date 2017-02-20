Obavijesti
==========

Ovdje će se objavljivati obavijesti vezane uz PHP akademiju, npr. promjene termina predavanja. Najnovije i aktualne obavijesti će biti na vrhu.

Obavijest o završetku PHP akademije
===================================

Poštovani polaznici PHP akademije, želimo se zahvaliti svima na sudjelovanju. Nadamo se da ćete znanja i vještine koje ste stekli nastaviti proširivati i da će vam koristiti u daljnjoj karijeri.

Za one koji žele preuzeti zadnju verziju svog projekta, ```phpacademy``` server će opet biti **otvoren za sve polaznike do utorka 28.02.2017** (preko korisničkog imena i šifre koje ste dobili na početku akademije). Nakon ovog datuma server će biti ugašen.

Srdačan pozdrav,
Adriatic.hr

### 06.02.2017

#### Poštovani polaznici akademije

Sa zadovoljstvom pozivamo sve polaznike koji su prezentirali projekte da nam se pridruže **8.2.2017 u 17:00 sati** na uručenju potvrda.
Molimo da potvrdite svoj dolazak na e-mail hr@adriatic.hr do utorka 7.2.2017. u 16:00 sati.

Srdačan pozdrav, Adriatic.hr

Hvala

### 01.02.2017

#### Dragi polaznici

Kako smo imali nekoliko molbi za odgodom, obavještavamo sve koji nisu iz bilo kojeg razloga stigli prezentirati svoj projekt kako ga mogu prezentirati u ponedjeljak 06.01.2017. u 13:30 sati. Potrebno se prethodno prijaviti na [mail](mailto:danko.lucic@adriatic.hr) do  ponedjeljaka 06.01.2017. u 10:00 sati. Uspješnom prezentacijom ostvarujete pravo na potvrdu da ste uspješno završili Adriatic.hr PHP Akademiju. U ovu svrhu opet je omogućen pristup ```phpacademy``` serveru do utorka 07.02.2017. Nakon ovog roka, na žalost, neće biti moguće prezentirati projekt.

### 24.01.2017

* Prezentacija završnih projekata će se održati u ponedjeljak 30.01.2017 sa početkom u 17h.
* Dodane su [upute za deploy](DEPLOY.md) projektne aplikacije.

### 21.01.2017 

* Predavanje u ponedjeljak 23.01.2017 će se održati u standardnom terminu (17h). Neke teme predavanja: Symfony parametri, AJAX primjer i pitanja i odgovori u vezi projekta i Symfony-ja.

### 19.01.2017

* Polaznicima koji uspješno prezentiraju projekt uručiti ćemo potvrde da su pohađali akademiju. U tu svrhu trebati će nam vaš OIB koji možete poslati na [ovaj mail](mailto:danko.lucic@adriatic.hr).
* Domain Driven Design izmjene za booking aplikaciju su postavljene online, ali u zaseban [branch](https://github.com/adriatichr/php-academy/tree/ddd_branch). Prezentacije su na [master branchu](predavanja).

### 18.01.2017

* Materijali REST predavanja su [online](https://github.com/adriatichr/php-academy/commit/44e604576c081868e3ed99c8fe0235a1f33a5fad). Da bi ste mogli testirati [PATCH metodu za dostupnost smještaja](https://github.com/adriatichr/php-academy/blob/ff483257728880ef912bab3b6de4dd4897d8087a/booking/src/AppBundle/Controller/RestController.php#L93) morate ažurirati tablicu rezervacija na način da ```customer_id``` polje [može biti](https://github.com/adriatichr/php-academy/commit/ff483257728880ef912bab3b6de4dd4897d8087a#diff-69c8c87e785c5e8b37d5a30ed4fb7727) ```NULL```.
* Primjer unit testa za Availability servis je online.

### 16.01.2017 

* Omogućeno je slanje maila iz Symfony aplikacije, upute za konfiguraciju možete vidjeti [ovdje](/ENVIRONMENT-SETUP.md#konfiguracija-i-korištenje-mail-servera-u-symfony-ju). Login podaci za mailhog web sučelje su isti kao i za SSH i Sambu.

### 14.01.2017

* Primjeri [design patterna](example/src/DesignPattern) i [SOLID principa](example/src/SolidPrinciples) su sada na master branchu. Primjere korištenja možete vidjeti u [unit](example/test/DesignPattern) [testovima](example/test/SolidPrinciples).

### 13.01.2017 Obavijest za one koji su imali izostanke sa predavanja: 

* Preporučamo vam da pogledate snimke predavanja koja ste propustili, jer se tu uče stvari koje će vam trebati u projektu, a smatramo da vam online materijali neće biti dovoljni. Za one koji žele pogledati predavanja omogućiti ćemo da to naprave u prostorijama firme bilo kada radnim danom između 8-21h. U svakom slučaju ćete moći prezentirati vaš projekt na kraju akademije.

### 09.01.2017

* Primjeri za [redirect nakon uspješnog submita forme i flash poruka](https://github.com/adriatichr/php-academy/commit/eff96916f5e3c57b997202abdd8180f48c41025f) i primjeri korištenja loggera i translator komponente su sada online.

### 06.01.2017

* *Preporuka za predavanje u ponedjeljak:* stavite svježu kopiju booking aplikacije sa ovog repozitorija u ```//phpacademy/booking.{inicijali}``` direktorij

### 04.01.2017 

* Predavanja se nastavljaju 09.01.2017. Od tada pa do kraja akademije predavanja počinju **točno u 17:00h**.

### 30.12.2016 

* Napravljen je primjer definiranja [Doctrine repozitorija kao servisa](https://github.com/adriatichr/php-academy/commit/1ac013a00b516bb6016575a9ecb20e3a3c2c78ac). Konfiguraciju možete vidjeti u [services.xml](https://github.com/adriatichr/php-academy/commit/1ac013a00b516bb6016575a9ecb20e3a3c2c78ac#diff-ba87dd91ea6711fefbc06152a8cdd3e6R40) datoteci.

### 29.12.2016 

* Primjeri JavaScripta i Ajaxa sa predavanja od Blagog su sada online (nalaze se na master branchu)

### 24.12.2016

* HTTP Cache primjeri su postavljeni online (sa dodatnim objašnjenjima) i nalaze se u [ExampleController-u](booking/src/AppBundle/Controller/ExampleController.php#L115)
* Accommodation entity sada sadrži i [primjer](https://github.com/adriatichr/php-academy/commit/c802d730be720dfc54691090b9ee57f2359fc37a) Doctrine [događaja](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html)

### 22.12.2016

* U dogovoru sa polaznicima i HR-om predavanje od petka (23.12.2016) će se održati dogodine
* Božićni domjenak počinje u petak u 14:30h. Svi ste pozvani :)

### 21.12.2016

* **Priprema za predavanje u srijedu:** stavite svježu kopiju booking aplikacije sa ovog repozitorija u ```//phpacademy/booking.{inicijali}``` direktorij
* Izmjene kôda od security predavanja su online

### 19.12.2016

* Izmjene kalendara u pripremi za JavaScript predavanje su online (tj. commit-ane u *master* branch)
* Popravljen je query za dohvaćanje rezervacija unutar nekog mjeseca i godine za neki smještaj
* Promjene vezane za današnje **Symfony Security predavanje** će biti online **sutra nakon predavanja** (sutra nastavljamo gdje smo danas stali)
