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

1. **Seminari** (poput Meetup-a)
	* pregled dostupnih seminara
	* korisnik se može prijaviti na seminar, organizirati svoj seminar
	* administrator može brisati seminare

## Dodijeljeni projekti

1. **Videoteka** - **Antoni Dragun**
	* pretraživanje filmova po naslovu, godini, žanru
	* prijavljeni korisnik može rezervirati filmove
	* administrator može brisati ili dodati filmove
10. **Oglasnik** (mobiteli/nekretnine/vozila) - **Zvonimir Maglica**
	* pretraživanje oglasa
	* prijavljeni korisnik može dodati nove i uređivati svoje postojeće oglase
	* administrator može izbrisati bilo koji oglas ili korisnika
20. **Kviz** - **Ivan Šimić**
	* korisnik odgovara na niz pitanja sa ponuđenim odgovorima
	* prijavljeni korisnik može vidjeti rezultate svih svojih kvizova
	* administrator može dodati nova pitanja i brisati postojeća
30. **Budget Watcher** - **Tončica Buličić**
	* aplikacija u kojoj korisnik unosi potrošnju za određenu kategoriju (hrana, odjeća, putovanja, režije)
	* svaki korisnik vidi samo svoju potrošnju
	* korisniku omogućeno da ima mjesečni prikaz, u smislu u tom mjesecu je najviše potrošio na putovanja, prikaz njegove statistike
	* administrator dodaje kategorije (mogućnost dodavanja i podkategorija)
	* administratoru je vidljiva i statistika potrošnje za kategorije i podkategorije
40. **Školski imenik** - **Angela Bašić-Šiško**
	* učitelj unosi ocjene za učenike,
	* svi korisnici mogu vidjeti unešene ocjene
	* učitelj može unositi i brisati nove učenike u sustav
50. **Foto galerija** - **Marin Ćapeta**
	* pretraživanje uploadanih slika
	* prijavljeni korisnik može dodati/brisati svoje slike
	* administrator može urediti parametre za upload slika (max. veličina, rezolucija)
60. **Unos putnih naloga** - **Ani Šore**
	* formi moze pristupiti prijavljeni korisnik
	* preko forme se unosi više nalog odjednom
	* administrator moze dodavati još zaposlenika i slično
	* ispis putnih naloga sumiranih po mjesecu i zaposleniku
70. **Blog** - **Igor Šušić**
	* pretraživanje članaka po tagovima
	* komentari članaka
	* korisnik može pisati članke na svom blogu i dodavati tagove
	* korisnik može brisati (samo) svoje članke i prateće komentare
80. **Baza filmova** (poput IMDB-a) - **Tereza Karabatić**
	* pretraživanje filmova po naslovu, godini, žanru
	* korisnici mogu ocjenjivati filmove
	* pregled najbolje ocjenjenih filmova
	* administrator dodaje i briše filmove
90. **Poliklinika** - **Petar Perišić**
	* pretraživanje doktora i njihovih specijalizacija
	* prijavljeni korisnik se može naručiti kod doktora
	* administrator može mijenjati podatke o doktorima
100. **News portal** - **Nikolina Pečnjak**
	* prikaz vijesti preko layouta
	* pretraživanje po naslovu i/ili datumu
	* korisnici mogu komentirati članke
	* administrator unosi nove članke, briše komentare korisnika
110. **Forum** (poput Reddit-a) - **Ante Todorić**
	* pretraživanje postova
	* korisnik može otvoriti temu, pisati postove,
	* upvote/downvote postova
	* administrator može brisati i uređivati sve postove
120. **Obračun i evidencija plaća zaposlenika** - **Ivana Krivić**
	* pregled svih zaposlenika, tko je na poslu a tko nije
	* zaposlenik može kliknuti početak i kraj rada, vidjeti vlastitu satnicu, vidjeti plaću za cijeli mjesec na osnovi odrađenih sati
	* administrator unosi zaposlenika, postavlja satnicu, briše zaposlenika
150. **Knjižara** - **Ante Domjanović**
	* korisnik može pregledavati ponudu, dodavati artikle u shopping cart, ocijeniti artikle
	* administrator može dodati nove artikle ili ukloniti postojeće iz ponude, brisati korisnika
160. **Rentacar/bike/boat** - **Fani Bajić**
	* pretraživanje vozila u ponudi
	* prijavljeni korisnik može rezervirati vozilo
	* administrator može dodati, izmijeniti ili ukloniti vozila iz ponude
170. **Knjižnica** - **Tomislav Parčina**
	* pregled i pretraživanje knjiga po nazivu ili autoru
	* korisnik može posuditi neku knjigu na određeni period
	* administrator dodaje ili briše knjige
180. **Social Network** - **Vladimir Buktenica**
190. **Rezervacija događaja** (na primjer vjenčanje) - **Ivan Pandžić**
200. **Radni nalozi** (ticketing sustav) - **Ivana Žaper**
	* korisnik može izraditi radni nalog
	* korisnici mogu komentirati naloge
	* korisnici mogu mijenjati stanje naloga (primjer stanja: u tijeku, u redu čekanja, zatvoreno, potrebna povratna informacija)
	* administrator dodaje nove vrste naloga, može brisati naloge
210. **Sportska liga** - **Ivan Brković**
	* pregled tablice lige, sortiranje po npr. gol razlici
	* pregled rasporeda utakmica
	* korisnik prati omiljenu ekipu,
	* administrator unosi ekipe, raspored utakmica, rezultate
220. **Aplikacija za pronalazak dobavljača** - **Nina Marić**
	* proizvođač ili trgovac (veleprodaja) definira svoju ponudu
	* korisnik (tvrtka koja traži proizvode) može pretraživati ponudu svih proizvođača
	* korisnik također može poslati zahtjev za ponudu ili odmah naručiti željeni proizvod u nekoj količini od nekog dobavljača
	* administrator može vidjeti statistiku ponuda i narudžbi
230. **Sportski TV program** - **Stjepan Puača**
	* pretraživanje programa po danu ili nazivu
	* korisnik može zatražiti snimanje programa
	* administrator dodaje nove programe u raspored ili briše stare
240. **Organizacija nogometnih utakmica** - **Vanja Dobrijević**
	* pozivi igračima za pojedine utakmice
	* slaganje momčadi prije utakmice
	* bilježenje rezultata utakmica
	* prikaz rezultata i popratne statistike
	* administrator može uređivati popis igrača, rezultate i termine igranja utakmica, kreirati profile koje igrači koriste i organizirati utakmice
	* korisnici odgovaraju na pozive organizatora i uređuju svoje kontakt podatke
