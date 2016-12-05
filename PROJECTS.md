Završni projekti
========================

Svaki polaznik akademije mora odabrati projekt koji će raditi dok traje akademija i prezentirati na posljednjem predavanju.

### Minimalni zahtjevi za završni projekt:
- mora biti napisan u [Symfony 3](http://symfony.com) frameworku
- PHP kôd mora biti dokumentiran koristeći [PHPDoc](https://phpdoc.org/docs/latest/getting-started/your-first-set-of-documentation.html)
- mora koristiti [Doctrine](http://www.doctrine-project.org/) za pristup [MySQL](http://dev.mysql.com/doc/refman/5.7/en/) bazi
- mora koristiti  [HTML5](https://en.wikipedia.org/wiki/HTML5) i [Twig](http://twig.sensiolabs.org/) kao templating engine
- mora imati barem jednu GET i POST formu (koristeći [Symfony form](http://twig.sensiolabs.org) komponentu)
- mora imati server side [validaciju](https://symfony.com/doc/current/validation.html) za barem jednu formu
- mora podržavati dvije vrste korisnika, običnog korisnika i administratora (preko [Symfony Security](http://symfony.com/doc/current/security.html) komponente)

Kao bonus projekt može sadržavati nešto od sljedećeg:
- kôd napisan koristeći [PSR-1](http://www.php-fig.org/psr/psr-1/) i [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standard
- client side validaciju preko JavaScript-a, ili [AJAX](https://en.wikipedia.org/wiki/Ajax_(programming)) pozive
- jednostavni REST servis
- primijenjen neki od design patterna
- unit i/ili funkcionalne testove pisane u [PHPUnit-u](https://phpunit.de/)
- implementiran neki oblik [HTTP cachiranja](http://symfony.com/doc/current/http_cache.html) stranice

Popis završnih projekata
========================

Za svaki projekt predložen je kratki popis značajki koje se može implementirati, ali radi se samo o prijedlozima. Polaznici mogu ako žele napraviti nešto drugačije ili predložiti vlastitu ideju za završni projekt, bitno je jedino da projekt zadovoljava tražene [minimalne zahtjeve](PROJECTS.md#minimalni-zahtjevi-za-završni-projekt).

1. **Foto galerija**
	* pretraživanje uploadanih slika
	* prijavljeni korisnik može dodati/brisati svoje slike
	* administrator može urediti parametre za upload slika (max. veličina, rezolucija)
10. **Blog**
	* pretraživanje članaka po tagovima
	* komentari članaka
	* korisnik može pisati članke na svom blogu i dodavati tagove
	* korisnik može brisati (samo) svoje članke i prateće komentare
20. **Školski imenik**
	* učitelj unosi ocjene za učenike,
	* svi korisnici mogu vidjeti unešene ocjene
	* učitelj može unositi i brisati nove učenike u sustav
30. **Poliklinika**
	* pretraživanje doktora i njihovih specijalizacija
	* prijavljeni korisnik se može naručiti kod doktora
	* administrator može mijenjati podatke o doktorima
40. **Oglasnik** (mobiteli/nekretnine/vozila)
	* pretraživanje oglasa
	* prijavljeni korisnik može dodati nove i uređivati svoje postojeće oglase
	* administrator može izbrisati bilo koji oglas ili korisnika
50. **News portal**
	* prikaz vijesti preko layouta
	* pretraživanje po naslovu i/ili datumu
	* korisnici mogu komentirati članke
	* administrator unosi nove članke, briše komentare korisnika
60. **Rentacar/bike/boat**
	* pretraživanje vozila u ponudi
	* prijavljeni korisnik može rezervirati vozilo
	* administrator može dodati, izmijeniti ili ukloniti vozila iz ponude
70. **Radni nalozi** (ticketing sustav)
	* korisnik može izraditi radni nalog
	* korisnici mogu komentirati naloge
	* korisnici mogu mijenjati stanje naloga (primjer stanja: u tijeku, u redu čekanja, zatvoreno, potrebna povratna informacija)
	* administrator dodaje nove vrste naloga, može brisati naloge
80. **Sportski TV program**
	* pretraživanje programa po danu ili nazivu
	* korisnik može zatražiti snimanje programa
	* administrator dodaje nove programe u raspored ili briše stare
90. **Sportska liga**
	* pregled tablice lige, sortiranje po npr. gol razlici
	* pregled rasporeda utakmica
	* korisnik prati omiljenu ekipu,
	* administrator unosi ekipe, raspored utakmica, rezultate
100. **Videoteka** (Antoni Dragun)
	* pretraživanje filmova po naslovu, godini, žanru
	* prijavljeni korisnik može rezervirati filmove
	* administrator može brisati ili dodati filmove
110. **Baza filmova** (poput IMDB-a)
	* pretraživanje filmova po naslovu, godini, žanru
	* korisnici mogu ocjenjivati filmove
	* pregled najbolje ocjenjenih filmova
	* administrator dodaje i briše filmove
120. **Seminari** (poput Meetup-a)
	* pregled dostupnih seminara
	* korisnik se može prijaviti na seminar, organizirati svoj seminar
	* administrator može brisati seminare
130. **Forum** (poput Reddit-a)
	* pretraživanje postova
	* korisnik može otvoriti temu, pisati postove,
	* upvote/downvote postova
	* administrator može brisati i uređivati sve postove
140. **Obračun i evidencija plaća zaposlenika**
	* pregled svih zaposlenika, tko je na poslu a tko nije
	* zaposlenik može kliknuti početak i kraj rada, vidjeti vlastitu satnicu, vidjeti plaću za cijeli mjesec na osnovi odrađenih sati
	* administrator unosi zaposlenika, postavlja satnicu, briše zaposlenika
150. **Knjižara**
	* korisnik može pregledavati ponudu, dodavati artikle u shopping cart, ocijeniti artikle
	* administrator može dodati nove artikle ili ukloniti postojeće iz ponude, brisati korisnika
160. **Knjižnica**
	* pregled i pretraživanje knjiga po nazivu ili autoru
	* korisnik može posuditi neku knjigu na određeni period
	* administrator dodaje ili briše knjige
170. **Kviz**
	* korisnik odgovara na niz pitanja sa ponuđenim odgovorima
	* prijavljeni korisnik može vidjeti rezultate svih svojih kvizova
	* administrator može dodati nova pitanja i brisati postojeća
