# RestoGuru


## Rühma liikmed
* Alari Verev
* Siim Hütsi

## Eesmärk
Veebirakenduse eesmärk on inimestele pakkuda teenust millega saab hinnata erinevaid restorane. Kasutaja saab lisada hinnanguid endi käidud restoranist. Kasutaja saabv vaadata teiste poolt lisatuid hinnanguid. See rakendus on kindlasti paljudele kasuks, kellel tekkib probleem, kuhu minna sööma või kust leiab mingit toitu ja kuidas teised seda hinnannud on.

## Kirjeldus
Meie poolt loodud rakenduse sihtrühmaks on enamasti noortest kuni eakateni välja. Kindlasti on see rakendus, mida inimene kasutaks umbes 1-2 korda päevas. Samalaadsete rakendustega meie rakendus erineb oma lihtsuse poolest, samuti Eestis puudub taoline rakendus. Talolised rakendused: Yelp, TripAdvidor.

## Funktsionaalsuse loetelu
* v1.0 Kasutaja loomine ja sisselogimine
* v2.0 Restoranide lisamine ja hindamine
* v2.5 Kõikide hinnangute nägemine
* v3.0 Restoranide grupeerimine restorani nime järgi ja ainult antud restorani hinnete nägemine
* v3.5 Sisse logitud kasuaja informatsiooni kuvamine
* v4.0 Kasutaja poolt loodud restoranide hinnangute nägemine
* v4.5 Kasutaja poolt loodud restoranide hinnangute muutmine
* v4.6 Kasutaja poolt loodud restoranide hinnangute kustutamine
* v5.0 Veebirakenduse esindlikumaks muutmine

## Andmebaasi skeem + laused
![alt tag](http://i.imgur.com/O7eQoYL.png)

* user_sample - CREATE TABLE `user_sample` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(255) NOT NULL,
 `password` varchar(128) DEFAULT NULL,
 `name` varchar(50) NOT NULL,
 `lastname` varchar(50) NOT NULL,
 `age` varchar(100) DEFAULT NULL,
 `phonenr` int(15) DEFAULT NULL,
 `gender` varchar(50) DEFAULT NULL,
 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
)

* restoranid - CREATE TABLE `restoranid` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `restoName` varchar(100) NOT NULL,
 `grade` varchar(1) NOT NULL,
 `food` varchar(150) NOT NULL,
 `food_rating` varchar(2) NOT NULL,
 `service_rating` varchar(2) NOT NULL,
 `comment` varchar(300) DEFAULT NULL,
 `customer_sex` text,
 `customer_name` varchar(150) NOT NULL,
 `customer_id` int(11) NOT NULL,
 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `deleted` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
)

* user_restos - CREATE TABLE `user_restos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) DEFAULT NULL,
 `resto_id` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 KEY `resto_id` (`resto_id`),
 FOREIGN KEY (`user_id`) REFERENCES `user_sample` (`id`),
 FOREIGN KEY (`resto_id`) REFERENCES `restoranid` (`id`)
)

* resto_restos - CREATE TABLE `resto_restos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `restoName` varchar(255) NOT NULL,
 `resto_id` int(11) NOT NULL,
 `deleted` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
)

* resto_facts - CREATE TABLE `resto_facts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `fact` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
)

## Kokkuvõte
* Siim - Põhiline suur erinevus mis üksi arenduse juures erineb grupitööst on kindlasti tööde jagamine. Kindel on see, et kunagi ei saa täiesti 100% võrdseks, et kõigil oleks samapalju koodiridu. Samuti oli ka sellise suurema projekti juures väga suur vajadus koodi classideks jagamine, see säästis palju aega ja ebavajalike koodiridu, samuti mida rohkem koodi juurde tuleks, seda suurem kasu klassidest. Ebaõnnestumine oli suurelt vahepealsed pühad mis minul enadal röövisid võimalust antud projektiga tegeleda. Samuti jäid ära ka osad teisejärgulised funktionaalsused mis ajapuududse tõttu jäid välja. Keeruline oli ka meil kahekesi leida aeg kuna koos asju ülevaadata ja arutada. Selleks kasutasime Skype abi.
* Alari -
