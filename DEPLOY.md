Priprema projekta za prezentaciju 
=================================

Na ovoj stranici se nalaze upute kako pripremiti projektnu aplikaciju za prezentaciju projekta.

## Upload projekta

Ovo su upute za brzi upload aplikacije na ```phpacademy``` server za one koji su aplikaciju razvijali lokalno. 
Ako ste aplikaciju razvijali na ```phpacademy``` serveru, možete odmah prijeći na [idući korak](#priprema-projekta-za-prezentaciju).
Na lokalnoj aplikaciji:

1. Pobrisati cijeli ```vendor``` direktorij, kao i sve iz ```var/cache```, ```var/logs``` i ```var/sessions``` direktorija.
2. Ako koristite [npm](https://www.npmjs.com/), potrebno je pobrisati i node_modules direktorij.
3. Kopirati aplikaciju na ```\\phpacademy\project.{inicijali polaznika akademije}```
4. Spojiti se preko SSH na ```phpacademy``` server i pokrenuti ```composer install``` (ako koristite npm, instalirati i npm pakete)
5. Postaviti bazu podataka ```project_{inicijali polaznika akademije}``` na ```phpacademy``` serveru

## Priprema projekta za prezentaciju

Projekt će se prezentirati u produkcijskom načinu rada, stoga je prije prezentacije potrebno pripremiti projekt za produkciju:

1. Ukloniti sve pozive Symfony ```dump()``` funkcije iz kôda.
16. Počistiti produkcijski cache konzolnom naredbom ```php bin\console cache:clear --env=prod```
15. Provjeriti je li aplikacija dostupna na ```http://phpacademy.project.{inicijali polaznika akademije}```
