DROP TABLE Latogatas;
DROP TABLE Komment;
DROP TABLE Forum;
DROP TABLE Bejegyzesek;
DROP TABLE Blog;
DROP TABLE Felhasznalok;
DROP TABLE Csomagok;

create table Csomagok(
    Nev VARCHAR2(40) PRIMARY KEY NOT NULL,
    Leiras VARCHAR2(250),
    Ar NUMBER(7)
);

create table Felhasznalok(
    UserID NUMBER(6) PRIMARY KEY NOT NULL,
    Telefonszam VARCHAR2(14),
    Jelszo VARCHAR2(40),
    Nev VARCHAR2(40),
    Email VARCHAR2(40),
    Lakcim VARCHAR2(100),
    Jog NUMBER(1)
	--Előfizetést NEM TÁROLJUK
);

create table Blog(
    BlogID NUMBER(6) PRIMARY KEY NOT NULL,
	TulajdonosID NUMBER(6), -- ÚJ tárolandó
    Nev VARCHAR2(40),
    Kategoria VARCHAR2(14),    
    Leiras VARCHAR2(250),
    Csomagnev VARCHAR2(40),
    Link_r VARCHAR2(200),
    Cim_r VARCHAR2(40),
    Banner_r VARCHAR2(250),
    FOREIGN KEY(Csomagnev) REFERENCES Csomagok(Nev),
	FOREIGN KEY(TulajdonosID) REFERENCES Felhasznalok(UserID)
);

create table Bejegyzesek(
    BejegyzesID NUMBER(6) PRIMARY KEY NOT NULL,
    LetrehozasDatuma DATE,
    Cim VARCHAR2(100), -- Új
    Szoveg VARCHAR2(3000),
    Kep VARCHAR2(100),
    BlogID NUMBER(6),
    FOREIGN KEY(BlogID) REFERENCES Blog(BlogID)
);

create table Forum(
    TopicID NUMBER(6) PRIMARY KEY NOT NULL, 
    Tema VARCHAR2(100)
);

create table Komment(
    KommentID NUMBER(6) PRIMARY KEY NOT NULL,
    Szoveg VARCHAR2(150),
    LetrehozasDatuma DATE,
    UserID NUMBER(6),
    BejegyzesID NUMBER(6),
    TopicID NUMBER(6), 
    FOREIGN KEY(UserID) REFERENCES Felhasznalok(UserID),
    FOREIGN KEY(BejegyzesID) REFERENCES Bejegyzesek(BejegyzesID),
    FOREIGN KEY(TopicID) REFERENCES Forum(TopicID) 
);

create table Latogatas(
    UserID NUMBER(6), 
    BlogID NUMBER(6),
    Datum DATE,
    FOREIGN KEY(UserID) REFERENCES Felhasznalok(UserID),
    FOREIGN KEY(BlogID) REFERENCES Blog(BlogID)
);


-- A Csomagok tábla feltöltése.
INSERT INTO Csomagok VALUES('Kezdő csomag', '10 bejegyzés megenegedett, a bologon megjelennek hírdetések, de nincsen időkorlát rajta.', 1000);
INSERT INTO Csomagok VALUES('Alap csomag', '30 bejegyzés megenegedett, nincsen időkorlát rajta.', 2000);
INSERT INTO Csomagok VALUES('Közép csomag', '100 bejegyzés megenegedett, nincsen időkorlát rajta.', 4000);
INSERT INTO Csomagok VALUES('Prémium csomag', '1000 bejegyzés megenegedett, nincsen időkorlát rajta.', 10000);

-- A Felhasználók tábla feltöltése.
INSERT INTO Felhasznalok VALUES(1, '451891718', 'jelszo123', 'Vass Alexander', 'vass.alexander1@email.com', '4285 Álmosd, Tompa u. 81.', 0);
INSERT INTO Felhasznalok VALUES(2, '550740408', 'jelszo321', 'Halász Ármin', 'halász.armin@email.com', '5400 Pusztabánréve, Veres Pálné u. 56.', 0);
INSERT INTO Felhasznalok VALUES(3, '903689037', 'jelszo231', 'Oláh Balázs', 'olah.balazs@email.com', '7960 Baranya, Agip u. 27.', 0);
INSERT INTO Felhasznalok VALUES(4, '264775726', 'jelszo234', 'Bálint Csanád', 'balint.csanad@email.com', '3467 Ároktô, Dózsa György út 47.', 0);
INSERT INTO Felhasznalok VALUES(5, '613641491', 'asd', 'Fábián Valentin', 'fabian.valentin@email.com', '6235 Bócsa, Dayka Gábor u. 10.', 0);
INSERT INTO Felhasznalok VALUES(6, '212143639', 'asdasd', 'Sípos István', 'sipos.istvan@email.com', '8097 Nadap, Teréz krt. 10.', 0);
INSERT INTO Felhasznalok VALUES(7, '921808062', 'asd123', 'Tóth Pál', 'toth.pal@email.com', '7542 Kisbajom, Eötvös út 76.', 0);
INSERT INTO Felhasznalok VALUES(8, '483707410', 'asd321', 'Barna Márton', 'barna.marton@email.com', '3943 Bodrogolaszi, Hegyalja út 79.', 0);
INSERT INTO Felhasznalok VALUES(9, '262153398', 'asd231', 'Antal Rajmund', 'antal.rajmund@email.com', '7757 Babarc, Piroska u. 19.', 0);
INSERT INTO Felhasznalok VALUES(10, '391077109', 'asdasd213', 'Márton János', 'marton.janos@email.com', '7763 Szôkéd, Piroska u. 61.', 0);
INSERT INTO Felhasznalok VALUES(11, '799247756', 'xM6a7XEP', 'Kapolcs Mária', 'kapolcs.maria@email.com', '4633 Lövôpetri, Bem rakpart 53.', 0);
INSERT INTO Felhasznalok VALUES(12, '277315918', '4dmhH5LN', 'Deák Tamara', 'deak.tamara@email.com', '2151 Fót, Síp utca 79.', 0);
INSERT INTO Felhasznalok VALUES(13, '477381068', 'qtLsAKhN', 'Boros Kamilla', 'boros.kamilla@email.com', '9672 Gérce, Victor Hugo u. 63.', 0);
INSERT INTO Felhasznalok VALUES(14, '403693563', 'rKcsdj6x', 'Márton Kíra', 'marton.kira@email.com', '2086 Tinnye, Síp utca 72.', 0);
INSERT INTO Felhasznalok VALUES(15, '764011914', 'JQym8R5M', 'Fodor Éva', 'fodor.eva@email.com', '2694 Magyarnándor, Hegedûs Gyula utca 77.', 0);
INSERT INTO Felhasznalok VALUES(16, '809794031', 'bET4EB2m', 'Németh Virág', 'nemeth.virag@email.com', '6511 Bácsszentgyörgy, Dayka Gábor u. 6.', 0);
INSERT INTO Felhasznalok VALUES(17, '845310935', '5QXd5Cd3', 'Csonka Vivien', 'csonka.vivien@email.com', '7072 Diósbéreny, Tas vezér u. 24', 0);
INSERT INTO Felhasznalok VALUES(18, '296179611', 'wUptqVyj', 'Mezei Szimonetta', 'mezei.szimonetta@email.com', '4735 Szamossályi, Bem rakpart 10.', 0);
INSERT INTO Felhasznalok VALUES(19, '428094638', '8ssFhTJ4', 'Egyed Laura', 'egyed.laura@email.com', '7521 Kaposújlak,  Eötvös út 23.', 0);
INSERT INTO Felhasznalok VALUES(20, '318796855', 'DExe2Xzv', 'Jakab Viktória', 'jakab.viktoria@email.com', '9533 Nemesszalók, Victor Hugo u. 13.', 0);
INSERT INTO Felhasznalok VALUES(21, '132121286', 'paXebXNM', 'Jónás Emese', 'jonas.emese@email.com', '8432 Fenyôfô, Izabella u. 63.', 0);
INSERT INTO Felhasznalok VALUES(22, '518832848', 'SB6D7jBV', 'Szücs Adél', 'Szücs Adél@email.com', '9912 Molnaszecsôd, Kis Diófa u. 14.', 0);
INSERT INTO Felhasznalok VALUES(23, '876765491', 'VLEyGdag', 'Somogyi Rebeka', 'somogyi.rebeka@email.com', '8882 Eszteregnye, Csavargyár u. 26.', 0);
INSERT INTO Felhasznalok VALUES(24, '702812866', 'Spee72vq', 'Vászoly Anett', 'vaszoly.anett@email.com', '5064 Csataszög, Apor Péter u. 5.', 0);
INSERT INTO Felhasznalok VALUES(25, '189825368', 'xAaM8bbz', 'Sípos Adrienn', 'sipos.adrienn@email.com', '4337 Papos, Budaörsi út 12.', 0);
INSERT INTO Felhasznalok VALUES(26, '971756661', 'e4f9kACQ', 'Máté Renáta', 'mate.renata@email.com', '1214 Budapest, Árpád fejedelem útja 68.', 0);
INSERT INTO Felhasznalok VALUES(27, '725114045', 'XLbFNdNP', 'Jakab Szabina', 'jakab.szabina@email.com', '7911 Botykapeterd,  Agip u. 65..', 0);
INSERT INTO Felhasznalok VALUES(28, '624046059', '8sQEUHtV', 'Orsós Dominika', 'orsos.dominika@email.com', '8711 Szegerdô, Nánási út 66.', 0);
INSERT INTO Felhasznalok VALUES(29, '459080667', 'm3qksDPx', 'Szabó Noémi', 'szabo.noemi@email.com', '3955 Kenézlô, Hegyalja út 80.', 0);
INSERT INTO Felhasznalok VALUES(30, '203954751', 'ZwWdHGGk', 'Surány Szimonetta', 'surany.szimonetta@email.com', '3588 Hejôkürt, Szent Gellért tér 96.', 0);
INSERT INTO Felhasznalok VALUES(31, '979256427', 'hWYvpYfe', 'Hajdú Boldizsár', 'hajdu.boldizsar@email.com', '8066 Pusztavám, Teréz krt. 31', 0);
INSERT INTO Felhasznalok VALUES(32, '778416629', '94e6DR5d', 'Szekeres Csaba', 'szekeres.csaba@email.com', '7017  Mezôszilas, Nagytétényi út 62.', 0);
INSERT INTO Felhasznalok VALUES(33, '656723667', 'TGCcpkah', 'Faragó Roland', 'farago.roland3@email.com', '8500 Pápa, Kárpát u. 9.', 0);
INSERT INTO Felhasznalok VALUES(34, '933946759', 'Y7Ff5UzX', 'Márton Attila', 'marton.attila@email.com', '4484 Ibrány, Budaörsi út 21.', 0);
INSERT INTO Felhasznalok VALUES(35, '180455085', 'Ndd5d5av', 'Novák Szilárd', 'novak.sziláard@email.com', '4065 Újszentmargita, Hegyalja út 67.', 0);
INSERT INTO Felhasznalok VALUES(36, '330431929', 'ZGhhXLYF', 'Szilágyi József', 'szilagyi.jozsef@email.com', '2800 Tatabánya, Munkácsy Mihály út 88.', 0);
INSERT INTO Felhasznalok VALUES(37, '996286431', 'GgtvKycs', 'Jakab Benedek', 'jakab.benedek@email.com', '3078 Bátonyterenye, Apáczai Csere János u. 11.', 0);
INSERT INTO Felhasznalok VALUES(38, '784507513', 'STFpgRXb', 'Takács Ármin', 'takacs.armin@email.com', '9081 Gyôrújbarát, Bécsi utca 61.', 0);
INSERT INTO Felhasznalok VALUES(39, '936008551', 'PgGxe3Zs', 'Magyar Adrián', 'magyar.adrian@email.com', '8771 Hahót, Kálmán Imre u. 94.', 0);
INSERT INTO Felhasznalok VALUES(40, '809318400', 'GuYxyWzt', 'Lukács Vanda', 'lukacs.vanda@email.com', '3053 Kozárd, Apáczai Csere János u. 80.', 0);
INSERT INTO Felhasznalok VALUES(41, '809318401', 'GuYxXWzt', 'Sípos Vivien', 'sipos.vivien@email.com', '4552 Napkor, Budaörsi út 33.', 0);
INSERT INTO Felhasznalok VALUES(42, '931288210', 'kUSMu95y', 'Bodnár Réka', 'bodnar.reka@email.com', '5650 Mezôbereny, Veres Pálné u. 81.', 0);
INSERT INTO Felhasznalok VALUES(43, '646076708', 'pvtx2c5t', 'Kelemen Szilvia', 'kelemen.szilvia@email.com', '3185 Egyházasgerge, Apáczai Csere János u. 9.', 0);
INSERT INTO Felhasznalok VALUES(44, '767478496', 'KP2T7Gr6', 'Veres Mónika', 'veres.monika@email.com', '9226 Gibárt, Bem rkp. 94.', 0);
INSERT INTO Felhasznalok VALUES(45, '658097880', 'GPURk4Wh', 'Fülöp Fruzsina', 'fulop.fruzsina@email.com', '3554 Dunasziget, Wesselényi u. 8.', 0);
INSERT INTO Felhasznalok VALUES(46, '671942864', 'nbzajFSR', 'Kovács Ágnes', 'kovacs.agnes@email.com', '3909 Mád, Bem rkp. 60.', 0);
INSERT INTO Felhasznalok VALUES(47, '595881138', 'bG8FFyEC', 'László Flóra', 'laszlo.flora@email.com', '3786 Szakácsi, Baross tér 96.', 0);
INSERT INTO Felhasznalok VALUES(48, '319799704', 'vPjvK9fA', 'Balla Boglárka', 'balla.boglarka@email.com', '7718 Udvar, Kossuth Lajos u. 62.', 0);
INSERT INTO Felhasznalok VALUES(49, '142697253', 'ZJVHJ7xL', 'Gáspár Kamilla', 'gaspar.kamilla@email.com', '5135 Jászivány, Apor Péter u. 5.', 0);
INSERT INTO Felhasznalok VALUES(50, '612000246', '54YRwJcd', 'Fodor József', 'fodor.jozsef@email.com', '3817 Gagybátor, Baross tér 81.', 0);

-- A Blog tábla feltöltése.
INSERT INTO Blog VALUES(1, 4, 'Világ körül', 'Utazás', '80 nap altt a világ körül', 'Alap csomag', '', '', '');
INSERT INTO Blog VALUES(2, 45, 'Kék bolygó', 'Természet', 'Mentsük meg eggyütt a bolygónkat', 'Közép csomag', '', '', '');
INSERT INTO Blog VALUES(3, 32, 'Gázfröccs', 'Autók', 'Az autók szerelmeseinek', 'Kezdő csomag', '', '', '');
INSERT INTO Blog VALUES(4, 8, 'Kezdo5', 'Sport', 'A sportblogok nem csak a férfiak kiváltságai! Az Anya sport blog', 'Prémium csomag', '', '', '');
INSERT INTO Blog VALUES(5, 19, 'Laszti', 'Sport', 'Ez a blog nagyszerű leírása', 'Alap csomag', '', '', '');
INSERT INTO Blog VALUES(6, 17, 'Mémes Élet', 'Vicc', 'One does not simply create a meme blog', 'Prémium csomag', '', '', '');
INSERT INTO Blog VALUES(7, 22, 'Természetes', 'Tudomány', 'Természettudomány közérthető formában', 'Kezdő csomag', '', '', '');



-- A Csomagok tábla feltöltése.

--Világ körül
INSERT INTO Bejegyzesek VALUES(1, TO_DATE('2021 03 05', 'yyyy mm dd'), 'Utazó bloggerek, akik engem is inspirálnak', 'Sokszor kérdezik tőlem, hogy mi alapján választjuk ki a következő úti célunkat, ki és mi inspirálja ezeket. Mosolyogva röviden csak annyi a válaszom, hogy maga a világ a sokszínűségével, folyamatos változásával. Bővebben nagyon sok minden. Könyvek, online és offline magazinok, blogok és bloggerek összessége, amelyeket nap mint nap olvasok, figyelek, érdekesek számomra valamitől és cselekvésre ösztönöznek. 

Van egy utazós fesztivál, ahol évente kétszer összegyűlik egy hétvégére az utazók színe-java, backpackerektől kezde a családos utazókon át a külföldi ösztöndíjasokig, az utazó bloggerek és utazós blogot írók “nagy családi összejövetele” ez. Ezen mi már több alkalommal részt vettünk kerekasztal beszélgetéseken külfönféle témákban. Itt is örök téma az utazó bloggerkedés, és visszatérő kérdés, hogy követjük-e egymás munkásságát. Személy szerint nagyon szeretem ezeket a találkozókat, és igen, követek más utazó bloggereke. Leginkább olyanokat, akik valamiért számomra értéket adnak. Szeretem azok blogjait, amik informatívak, érdekesek, aktívak. Jó érzés tölt el, amikor olvasom írásaikat, mesélnek már önmagukban a képeik és videóik, tudok velük bizonyos mértékben azonosulni, szívügyük az utazás, és szenvedéllyel csinálják az egész blog ezt az egészet.', '',1);
INSERT INTO Bejegyzesek VALUES(2, TO_DATE('2020 06 23', 'yyyy mm dd'), 'Élet a válság után - Vendéglátás emberi kapcsolatokra épülve', 'Azt hiszem, a válság és a vendéglátás közöshalmazának mélypontja volt a legsikeresebb éttermes, Zsiday Roy nemrégiben tett kifakadása azon vendéglátósok ellen, akik jótékonysággal, házhoz szállítással és hasonlókkal próbáltak talpon maradni úgy, hogy a munkavállalók nagy részét megtartják, és nem engedik el a kezüket. Persze, volt vendéglátós, aki úgy hazaküldött mindenkit, mint a sicc, ők aztán a válság után nyilván fizetett hirdetésekben reklámozzák majd az összetartó csapatba, a komplex gasztronómiai élményekbe és az emberi összefogás nagyságába vetett hitüket, és gyere hozzánk dolgozni, mert megbecsülnek. Közben nagyon várják a turistákat, de várhatóan azok nem jönnek, úgyhogy megy a fejvakarás. Most mit csináljunk?

A vendégek nem hülyék. Most azért elvált a búza az ocsútól, és ennek már nincs köze ahhoz, hogy mennyire számolta ki a belsőépítész a lámpák dimmelési fokát, hogy mennyire hajol meg a főpincér téged üdvözölve vagy hogy mit jelent az éttermi élmény, a tulajdonos szerint.', '',1);
INSERT INTO Bejegyzesek VALUES(3, TO_DATE('2020 04 30', 'yyyy mm dd'), '
Mennyire elvetemült ötlet a 30 km/h-s Budapest-belváros?', 'Na jó, itt még nem tartunk. Karácsony Gergely és csapata a tegnapi napon indították be a forgalomcsillapítási projektet Budapesten, ami egyelőre annyit takar, hogy megfontolják, és lakossági és szakértői egyeztetést indítanak (ritkaság manapság mindezt nem csak papíron megtenni, hogy “megvolt, a többség támogatta”) arról, hogy a város teljes területén 50 km/h lenne a megengedett maximális sebesség, a főutakon kívül viszont egységesen 30 km/h lenne tartandó, lakó-pihenő övezetekben meg 20.

Szóval ez még korántsem döntés, csak annak előkészítése. És nem is a 30-as belvárosról szól.

Az előkészítés okára a főpolgármester a halálos balesetek visszaszorítását jelölte meg. Nem véletlen, hogy a számos előny közül épp ezt emelte ki, hiszen ezt a legkönnyebb megértetni a teljes lakossággal, a biztonság mindig jó hívószó. És nem is lehetetlen, legalábbis a 30 km/órás övezetekben világszerte tapasztalható, hogy halálos baleset alig (30 km/h-s ütközésnél, tehát fékezés nélkül 5-10 százalékban halálos az ütközés), de még súlyos is csak elvétve fordul elő. Mások a bringások, bringautak, valamint a közösségi közlekedés fejlődését várják ennek következményeként, újra előjött Budapest, mint bringaváros víziója. Ez is egy szelete a tortának, igen.', '',1);

--Kék bolygó
INSERT INTO Bejegyzesek VALUES(4, TO_DATE('2020 05 22', 'yyyy mm dd'), 'Ha megvédjük a természetet, a természet is megvéd minket', 'Hogyan maradhatunk egészségesek? Hogyan védhet meg minket a járványoktól az egészséges környezet? Mi köze a természetnek, vagy éppen a nagyüzemi állattenyésztésnek a koronavírushoz? Hogyan okozhat járványt a természet pusztítása? Hatással van-e a járványok kitörésére a klímaváltozás? Mit kellene tennünk egy biztonságosabb, igazságosabb, tisztább világért? Mivel nem könnyű lépést tartani a mostani információáradattal, ezért összegyűjtöttük a válaszokat, hogy segítsünk a tájékozódásban.', '',2);
INSERT INTO Bejegyzesek VALUES(5, TO_DATE('2021 02 08', 'yyyy mm dd'), 'Tiszta levegőt!', 'A kipufogógázból, valamint a tüzelőanyagok és szemét égetéséből származó légszennyezés világszerte veszélyezteti az egészségünket. Együtt véget tudunk vetni a légszennyezésnek. Elfogadhatatlan, hogy életveszélyes az a levegő, amit belélegzünk! Felszólítjuk a magyar kormányt, hogy tegye fenntarthatóvá a közlekedést, szorítsa vissza a légszennyező tüzelési, fűtési módokat, valamint akadályozza meg, hogy Magyarországot elárasszák a súlyosan szennyező, Nyugat-Európából hamarosan kitiltásra kerülő használt autók.', '',2);
INSERT INTO Bejegyzesek VALUES(6, TO_DATE('2021 04 07', 'yyyy mm dd'), 'Élhető városok', 'Te is olyan városban szeretnél élni, ahol tiszta a levegő, olcsó és kényelmes a tömegközlekedés, az utak biztonságosak a gyalogosok és kerékpárosok számára, és számos park, közkert teszi még szerethetőbbé a környezetet? Mi ilyen városokat szeretnénk. Csatlakozz, hogy együtt elérjük a változást!', '',2);

--Gázfröccs
INSERT INTO Bejegyzesek VALUES(7, TO_DATE('2021 04 20', 'yyyy mm dd'), 'A tökéletes BMW nem létezik', 'A BMW Z3 alapmotorral sokak szerint nem ad akkora élményt, mint a hozzá hasonló MX-5. Viszont amikor már rendes hathengeres van az orrában, hirtelen nagyon megváltozik az egyenlet - innentől a gyengécske Mazdának kellene kapaszkodnia. Már ha ellenfelek lennének, de inkább harcostársak, hiszen a roadster kategória annyira feledésbe merült, hogy már az autószeretők se mindig értik pontosan. Szerencsére e kocsi gazdája érzi.
Tavasz van, az ég kék, a fű zöld, a vezetés élménye összeköt. Soma az egyik Mini blog után írt rám Angliából, hogy esetleg segíthet-e onnan alkatrésszel, de a levelezés pillanatok alatt átkanyarodott egy BMW Z3-ra. Arra a roadsterre, amivel 2019 telén hazahozta állatorvoshoz a kutyáját, ám a koronavírus lezárásai miatt a kocsi azóta is itthon áll, édesapja garázsában, és borzalmasan hiányzik neki. Viszont az ő vesztesége a mi nyereségünk, hogy egy angol szófordulat fordításával borzoljam az Internetes Nyelvvédelmi Szövetség idegeit. Úgyhogy ha már szereztem egy kis gyakorlatot a jobboldali kormány, bal kézre eső váltókar témában a Miniben, és végre a nap is kisütött, Csepreghy Danival elvittük egy körre a mai szemmel kifejezetten apró BMW-t. Ami, minő szerencse, ideiglenesen a Bakony lábánál lakik.', '',3);
INSERT INTO Bejegyzesek VALUES(8, TO_DATE('2021 04 15', 'yyyy mm dd'), 'Aranyszínben búcsúzik a Polestar 1', 'Mindössze három éves pályafutást terveztek a Polestar 1-es számára, és ez az idő el is telt. A gyártás 2019-es beindítása óta elkészült a tervezett évi 500 autó, így most búcsúzik a típus.
Eredetileg Volvo tanulmánynak indult az S90 orrú kupé: ezzel az autóval kezdték bevezetni a márka új stílusát. Ám az érdeklődés olyan nagy volt, hogy évek múltán ezt a formát választották az önálló Polestar márka bevezetéséhez.
Az 1-esnek elnevezett autót Kínában gyártották, az S90-es elemeinek felhasználásával, és egy 608 lóerős hibrid hajtásrendszerrel, amely egy 304 lóerős kétliteres benzinmotorból, egy 69 lóerős indítómotor-generátorból, és két, egyenként 118 lóerős villanymotorból áll. A 2,34 tonnás kétajtós ezzel a hajtásrendszerrel akár 4,2 másodperc alatt elérheti a százas tempót, és WLTP szabvány szerint mérve akár 124 km-t is megtehet tisztán elektromos hajtással.', '',3);
INSERT INTO Bejegyzesek VALUES(9, TO_DATE('2021 04 20', 'yyyy mm dd'), 'A Föld napja: csütörtökön ingyen utazhatsz a BKK-val, ha nálad van az autód forgalmija', 'A Föld napja alkalmából csütörtökön ingyenesen utazhat a fővárosban a Budapesti Közlekedési Központ (BKK) járatain (beleértve a HÉV-vonalak budapesti szakaszait is), aki fel tud mutatni egy érvényes forgalmi engedélyt. A társaság hétfői, az MTI-hez eljuttatott közleménye szerint a lehetőséget azok vehetik igénybe, akik a jegyellenőrzéskor Magyarországon kiállított érvényes forgalmi engedélyt mutatnak fel. A díjmentes utazást egy forgalmi engedéllyel egy utas veheti igénybe egész nap - tették hozzá. A társaság arra szeretné ösztönözni az autóval közlekedőket, hogy a környezet és saját egészségük megóvásáért válasszanak egyéb, alternatív közlekedési eszközt, vagy használják a közösségi közlekedést úticéljuk eléréséhez. 

Ismertették: a BKK a fővárosi önkormányzattal szorosan együttműködve igyekszik megteremteni annak a feltételét, hogy a közlekedők a legmegfelelőbb közlekedési eszközt választhassák Budapesten. A főváros közlekedési fejlesztéseit összefoglaló Budapesti mobilitási terv 2030 célja a közösségi, kerékpáros és gyalogos közlekedés előtérbe helyezése, hogy a főváros a jelenleginél élhetőbb, még inkább ember- és környezetbarát város legyen - hangsúlyozták.

Kitértek arra is, hogy a közösségi közlekedés a koronavírus-járvány ellenére is folyamatos, a biztonságos utazás feltételeinek megteremtéséért pedig rendszeresen és alaposan fertőtlenítik a teljes utasteret, a járművek vezetőállásait, a metróállomások utasforgalmi területeit, valamint a mozgólépcsők korlátait. Emellett továbbra is kötelező a szájat és az orrot eltakaró maszk használata a járműveken és a megállókban. A BKK munkatársai folyamatosan ellenőrzik ennek betartását - olvasható a közleményben.', '',3);

--Kezdo5
INSERT INTO Bejegyzesek VALUES(10, TO_DATE('2021 04 20', 'yyyy mm dd'), '35 éves Jordan 63 pontos PO-rekordja', '35 évvel ezelőtt dobta 63 pontos, azóta is fennálló PO-rekordját Michael Jordan - Allen Iverson 55 ponttal terhelte meg a Hornets gyűrűjét 18 évvel ezelőtt - 50 éves Allan Houston, Danny Granger 38. 1986. április 20-án találkozott egymással az első kiemelt Boston Celtics és a keleti nyolcadik helyen rangsorolt Chicago Bulls. A Celtics a korszak legjobb csapataként érkezett a találkozóra, hiszen 84-es bajnoki címe után 1985-ben a döntőben kapott csak ki a Los Angeles Lakerstől, ebben az idényben pedig 67-15-ös alapszakasz után végül bajnok lett - minden idők egyik legjobb csapataként tartják számon ezt a gárdát. Ezen az estén, az első kör második összecsapásán azonban annak ellenére sem ők voltak a középpontban, hogy kétszeri hosszabbítás után 135-131-re nyerni tudtak - végül 3-0-lal mentek tovább. A Bullsnál ugyanis Michael Jordan 53 perc játék alatt 63 pontot szerzett - ez mind a mai napig PO-rekord a liga történetében. A Chicago legendája 22/41-es mezőny, illetve 19/21-es büntetőmutatóval érte el ezt a teljesítményt - emellett volt 6 gólpassza, 5 pattanója, 3 szerzett labdája, 2 blokkja és 4 eladott labdája is. Április 20-hoz még egy nagy teljesítmény tartozik, méghozzá 2003-ból, amikor a rájátszás első körének első meccsén a negyedik kiemelt Philadelphia Sixers az ötödik New Orleans Hornetset fogadta. A Baron Davis, Jamaal Magloire-féle Hornets a két évvel korábbi döntőssel csapott össze, amelyből azért ekkorra már hiányzott többek között Dikembe Mutombo. A reflektorfénybe természetesen Allen Iverson került, aki végül 55 pontig jutott nagyon hatékony dobóteljesítménnyel: 21/32 mezőny, 3/5 tripla, 10/11 büntető - ez Iverson PO-karriercsúcsa.', '',4);
INSERT INTO Bejegyzesek VALUES(11, TO_DATE('2021 04 20', 'yyyy mm dd'), 'Hírmorzsák', 'Anthony Davisnek erősítenie kell, LeBron James könnyített munkát végez. LaMelo Ball hamarosan visszatérhet. Myles Turner határozatlan időre kidőlt. Sterling Brownt vasárnap megtámadták. Stephen Curry és Julius Randle a Hét Játékosai. Lejárt Kobe Bryant és a Nike megállapodása. Jalen Suggs bejelentkezett a draftra. Frank Vogel a Los Angeles Lakers két sérült sztárjáról osztott meg némi információt. Elmondása alapján Anthony Davis közel áll a visszatéréshez, már teljesen egészséges, de az erőnlétén még kell dolgoznia, és még időbe fog telni, mire ismét olyan állapotban lesz, mint a sérülése előtt. Nagyon óvatosak lesznek vele, mert nem akarják kockáztatni, hogy visszaessen az állapota, és várhatóan az első két meccsén 15 perc körüli limiten lesz. Vogel hozzátette, hogy nem érzik még úgy, hogy kint lennének a vízből, még a következő időszakban is nagyrészt sztárjaik nélkül kell meccseket nyerniük, elvégre Davis nem lesz sokat pályán, LeBron James pedig egyelőre könnyített munkát végez csak, és igyekszik minden nap kicsivel több mindent csinálni. Az ESPN forrásai szerint James még hetekre van a visszatéréstől.', '',4);
INSERT INTO Bejegyzesek VALUES(12, TO_DATE('2021 04 18', 'yyyy mm dd'), 'A Celtics ötödik bajnoki címe és Stockton gólpassz-rekordja', '85 éves Don Ohl - 59 éve nyerte ötödik bajnoki címét a Boston, Bill Russell beállította döntő-rekordját - Russell 55 éve lett az amerikai major sportok történetének első afro-amerikai vezetőedzője - Rick Barry 54 éve 55 pontot szórt a Sixers elleni döntő harmadik meccsén - 30 éves John Stockton gólpassz-rekordja - 20 éve vonult vissza AC Green egy máig fennálló NBA csúccsal. 1936. április 18-án, tehát 85 évvel ezelőtt született korának egyik legjobb shooter dobóhátvédje, Don Ohl. A Philadelphia Warriors az 1960-as draft 5. körének 36. helyén draftolta, de azonnal eladta őt a Detroit Pistonshoz. Butaságot csinált a Philly, hiszen Ohl 10 évet töltött a ligában, ebből 5-ször All-Star volt - kétszer a Detroitnál, majd 1964-es cseréjét követően 3-szor Baltimore-ban. Játszott még a St.Louis/Atlanta Hawksnál is, mielőtt 1970-ben visszavonult, miután a Cleveland Cavaliers elvitte az expanziós drafton. Isten éltesse sokáig! 59 esztendővel ezelőtt, 1962. április 18-án ért véget az 1962-es NBA döntő. A Boston Celtics hosszabbítás után 110-107-re verte a Los Angeles Lakerst, így 4-3-mal húzta be a bajnoki címet egy emlékezetes fináléban. A döntő második mérkőzésén az aranysárga-lilák elvették a Celtics pályaelőnyét, amit a Boston a negyedik találkozón visszavett. A Lakers az ötödik összecsapást is megnyerte idegenben, így a bajnoki cím kapujába került. Nem sikerült azonban feltenni az i-re pontot Jerry Westéknek, 119-105-re kikaptak Los Angelesben, a hetedik meccsen pedig otthon nyert a Celtics. Ez a bizonyos hetedik mérkőzés két érdekes statisztikát is hozott. Elgin Baylor sorozatban 11. alkalommal jutott el legalább 30 pontig (41-gyel zárt), ez NBA rekord. Másrészt Bill Russell 40 lepattanót szedett le, ezzel beállította saját Finals-csúcsát.', '',4);

--Laszti
INSERT INTO Bejegyzesek VALUES(13, TO_DATE('2021 01 07', 'yyyy mm dd'), 'Az UEFA és a FIFA sem tilthatja el a játékosokat a válogatottól', 'Továbbra is a sportvilág, kiváltképp a labdarúgás legforróbb témája a vasárnap éjjel létrehozott Európai Szuperliga. Miközben az új szervezet vezetősége próbálja védeni a döntését, addig a Nemzetközi (FIFA) és az Európai Labdarúgó-szövetség (UEFA) szankciókat helyezett kilátásba. Csak a játékosokat nem kérdezte senki, akik tehetetlenül keveredtek bele a történetbe, miközben azzal fenyegetik őket, hogy nem léphetnek pályára a válogatottjukban. Az ő helyzetükről és érdekvédelmükről dr. Horváth Gáborral, a FIFPRO (Hivatásos Labdarúgók Nemzetközi Szervezete) magyarországi tagszervezetének főtitkárával beszélgettünk.
Az induló Szuperligával kapcsolatban már több érintett csapat játékosa is megszólalt, sőt ellenezte az új sorozatot. A közelmúltban láthattunk olyat, hogy egy klub azért küldött egy el alkalmazottat, mert annak értékrendjével ellentétes véleményt formált meg. Büntethetőek emiatt?
Minden hivatásos játékosnak munkaszerződése van, amiben részletesen szabályozzák a játékosok kötelezettségeit. Ha ezeket megszegik, akkor természetesen szankcionálhatja a klub. Korábban a Petry-ügyben és most a Szuperliga tekintetében is elmondható, hogy nagyon kevés információ áll rendelkezésünkre ahhoz, hogy korrekt véleményt tudjunk formálni. Lehetséges, hogy Petry Zsolt szerződésében, vagy a Hertha belső szabályzatában szerepel olyan pont, amelyet nyilatkozatával megszeghetett, azzal együtt, hogy a véleménynyilvánítás szabadsága mindenkit megillet. Ugyanígy a Szuperliga esetében sem tudunk minden releváns információt, ezért óvatosan kell véleményt alkotnunk. A SZUPERLIGA ÉLETRE HÍVÁSA A MAI SPORTBAN NEM PÉLDA NÉLKÜLI, AZ SEM BIZTOS, HOGY ALAPVETŐEN ROSSZ, VALÓSZÍNŰLEG NÉPSZERŰ ÉS PROFITÁBILIS LENNE, DE AZ ELLENÉRVEKET IS MEG LEHET ÉRTENI, HOGY MI LESZ A JÖVEDELMEK ARÁNYOS ELOSZTÁSÁVAL, AZ EGYMÁS IRÁNTI SZOLIDARITÁSSAL, A VERSENYSEMLEGESSÉG ELVÉVEL VAGY A KISEBB KLUBOK VÉDELMÉVEL.', '',5);
INSERT INTO Bejegyzesek VALUES(14, TO_DATE('2021 01 07', 'yyyy mm dd'), '„Veszélyben a futball” – „van, amit pénzzel nem lehet megvenni”', 'A korábban az Arsenal és az Inter alkalmazásában is álló Lukas Podolski nem tudta visszafogni dühét.

Őrült hírre ébredtem. A meggyőződésemmel szembeni sértés ez: a labdarúgás a boldogságról, a szabadságról, a szenvedélyről, a szurkolókról szól, és a játék mindenkié. Ez egy undorító, igazságtalan projekt, és csalódott vagyok, amikor látom a bevont klubokat. Harcoljunk ez ellen!

A Liverpool korábbi védője, Dejan Lovren szerint közel a vég.

„A futball a közeljövőben a teljes összeomlás szélére kerül. Senki sem gondol a nagyobb képre, csak a pénzügyi oldalra. Még mindig hiszem, hogy meg tudjuk oldani ezt a kellemetlen helyzetet.”

A korábban az MU-nál, a Villarrealnál és a Fiorentinánál is játszó Giuseppe Rossi kicsit erősebb hangot ütött meg.

Ki gondolja még, hogy ez a Szuperliga-lósz.r egy vicc? Remélem, a világon minden futballszurkoló felismeri, mennyire kártékony ez a játékunk számára.', '',5);
INSERT INTO Bejegyzesek VALUES(15, TO_DATE('2021 01 07', 'yyyy mm dd'), 'Kloppot elragadták az érzelmei, hitet tett a futball és a szurkolók mellett', 'Jürgen Kloppot, a Liverpool menedzserét is derült égből villámcsapásként érte az Európai Szuperliga vasárnap éjszakai bejelentésének híre, ahogy az a hétfő esti Leeds United–Liverpool (1–1) Premier League-mérkőzés utáni nyilatkozatából kiderül. A német szakember életében nem volt még ilyen kényelmetlen helyzetben, megható volt, ahogy két malomkő között őrlődött.
„FOOTBALL IS FOR THE FANS. EARN IT.” „A FUTBALL A SZURKOLÓKÉRT VAN. ÉRDEMELD KI!”

Ilyen feliratú pólóban melegítettek a Leeds United játékosai hétfő este az Elland Roadon, a Liverpool elleni PL-mérkőzés előtt, és félreérthetetlenül ellenfelüknek címezték a szlogent, hiszen a Mersey-parti egyesület is csatlakozott vasárnap éjjel az új szakadársorozathoz, az Európai Szuperligához, sőt nemcsak csatlakozott, hanem amerikai tulajdonosai révén alapító tagja is a zárt körű elitsorozatnak. 

Érdemeld ki, mármint a Bajnokok Ligája-indulás jogát, és ne alanyi jogon juss hozzá, ahogy az a Szuperliga-szerepléssel együtt jár.

A HÁZIGAZDÁK A LIVERPOOL ÖLTÖZŐJÉBEN IS KIRAKTAK MINDEN JÁTÉKOS SZEKRÉNYE ELÉ EGY ILYEN PÓLÓT, DE AZOK NEM VETTÉK FEL A MEGLEHETŐSEN PROVOKATÍV, A SZUPERLIGA GONDOLATA ELLEN HITET TÉVŐ RUHADARABOT. 

Az 1–1-re végződő mérkőzés után Klopp csaknem negyedórán keresztül állta az újságírók kérdéseit, és látszott rajta, életében nem volt még ilyen kínos helyzetben. Egyfelől kötötte őt a lojalitás munkaadóihoz, másfelől minden gesztusán látszott, hogy egyetlen porcikája sem kívánja a Szuperligát.

Néhány erős mondat Klopp válaszaiból:

„Amikor délután sétáltunk a játékosokkal a városban, az emberek válogatott szidalmakat szórtak ránk. Mi ezt nem érdemeltük meg, mi a klub alkalmazottai vagyunk, nem mi találtuk ki a Szuperligát.”', '',5);

--Mémes Élet
INSERT INTO Bejegyzesek VALUES(16, TO_DATE('2021 01 07', 'yyyy mm dd'), 'Mise', 'A falusi templomba betéved egy parasztbácsi. Leül, és elkezd nézelődni. Amikor elérkezik a mise ideje, a pap megkérdi tőle:
- Csak egyedül van itt, azért megtartsam a misét?
Erre a bácsi:
- Én nem vagyok nagyon okos, de ha kimegyek az ólba, és csak az egyik disznó jön a vályúhoz, azért megetetem azt az egyet is!
A pap erre megtartja a misét, egészen belelkesedik, cifrázza kedvére.
Két óra múlva megszólal az öreg paraszt:
- Hát atyám, én nem vagyok egy okos ember, de azt tudom, hogy ha csak egy disznó jön a vályúhoz, azért nem adom neki az összes moslékot...', '',6);
INSERT INTO Bejegyzesek VALUES(17, TO_DATE('2021 02 04', 'yyyy mm dd'), 'Profilkép', 'A rendőrök vizsgáznak. Bemegy az első, elétesznek egy profilképet, amin oldalról van az arc fényképezve, és kérik, hogy sorolja fel az ismertetőjeleit.
- Fekete göndör haj és egy füle van.
Azonnal kirúgják. Bemegy a másik is, neki is ugyanaz a feladata.
- Széles száj és egy füle van.
Öt is kirúgják. Mikor megy ki az ajtón, a harmadik jelentkezőnek odasúgja, hogy csak azt ne mondja, hogy egy füle van, mert akkor megbuktatják. Bemegy ő is, a feladat ugyanaz.
- Széles száj és kontaktlencsét visel.
- Bravó, bravó, ilyen rendőr kell nekünk! Most már csak azt árulja el, hogy miképpen jött rá a kontaktlencsére?
- Nagyon egyszerű volt, ugyanis akinek egy füle van, az nem tudsz szemüveget hordani.', '',6);
INSERT INTO Bejegyzesek VALUES(18, TO_DATE('2020 10 14', 'yyyy mm dd'), 'Matektanár megmentője', 'Egy matektanár megy az úton. Megtámadja egy bűnöző, de hirtelen a bokorból előbukkan egy fekete köpegyes, maszkos ember és megmenti.
Ekkor a tanár megszólal:
- Ki vagy te?
A megmentő nem válaszol, csak egy nagy Z betűt vés a falba a kardjával.
- ÁÁÁ! Köszönöm, hogy megmentettél, egész számok halmaza!', '',6);

--Természetes
INSERT INTO Bejegyzesek VALUES(19, TO_DATE('2020 12 06', 'yyyy mm dd'), 'Erdős Pál és Szekeres György nyomában', 'Ashwin Sah (MIT) 21 éves korára olyan teljesítményt tett le az asztalra, amely vezető matematikusok szerint szinte példa nélküli egy egyetemi hallgató esetén, s már most elegendő lenne ahhoz, hogy kari pozíciót szerezzen.
Május 19-én Ashwin Sah a kombinatorika egyik legfontosabb kérdésével kapcsolatban az eddigi legjobb eredményt tette közzé. Ilyen pillanathoz ünnepi ital dukál, csakhogy Sah még nem volt elég idős ahhoz, hogy rendelhessen egyet.

Sah, aki novemberben töltötte be a 21. évét, a MIT hallgatójaként már e bizonyítás előtt is egy sor matematikai eredményt publikált. Ritka koraérettség ez még egy ilyen területen is, amelyre általában véve jellemző a zsenialitás fiatal kori megjelenése.

A májusi bizonyítás a kombinatorikában fontos szerepet betöltő ún. Ramsey-számokra összpontosít (névadójuk a szintén koraérett, és sajnos korán elhunyt Frank P. Ramsey brit matematikus, filozófus, közgazdász). Ezek azt számszerűsítik, hogy mekkora lehet egy gráf az előtt, hogy szükségszerűen tartalmazna egy bizonyos fajta alstruktúrát.', '',7);
INSERT INTO Bejegyzesek VALUES(20, TO_DATE('2020 04 19', 'yyyy mm dd'), 'Analogika - rendhagyó interjú Roska Tamás akadémikussal', '2002. március 2-án a Budapest Kongresszusi Központban második alkalommal adták át a legrangosabb, civil alapítású tudományos kitüntetést, a Bolyai-díjat. Ez évben a Bolyai-díjat Roska Tamás kapta.

Roska Tamás (1940) a Magyar Tudományos Akadémia rendes tagja. Az MTA Számítástechnikai és Automatizálási Kutatóintézet (SZTAKI) Analogikai és Neurális Számítógépek Laboratóriumának vezetője, a Pázmány Péter Katolikus Egyetem Információs Technológia Karának alapítója, dékánja. Iskolateremtő egyéniség.

Számos kitüntetés tulajdonosa a Széchenyi-díjtól a Szent-Györgyi Albert-díjon át a Pro Renovanda Cultura Hungariae fődíjáig.

Szakterülete az elektronika, a számítástechnika, az új információtechnikai eszközök és módszerek, beleértve a neuromorférzékelő számítógépeket. Úttörője a modern csúcstechnológiák két fontos területének, az információs technológiák és a biotechnológiák összekapcsolására irányuló törekvéseknek. Társfeltalálója a forradalmian új, programozható analogikai szuperszámítógép-elvnek (CNN1 Univerzális Számítógép), illetve csipnek (Leon O. Chua professzorral), valamint a CNN bionikus szemnek (F. S. Werblin és L. O. Chua professzorokkal).

A Természet Világa olvasóinak arról beszélnék először, hogy ez az új elv, a tér-időbeli számítógép, ez a hullámszámítógép, az analogikai celluláris (CNN) számítógép miben jelent többet és mást az eddigieknél. Mik a következményei, részben az algoritmusos világra, részben a számítási komplexitás világára, függetlenül attól, hogy fizikailag milyen módon van megoldva. Azok a számítógépek, amelyeket ma használunk, lényegében mind az egész számokra értelmezett számítógépek. Számítási komplexitásuk klasszikus mértéke, hogy ha növeljük a feladat méretét, hogyan nő a szükséges számítási szükséglet, műveletszám (négyzetesen, vagy köbösen stb.). Az évek során ez a fajta gondolkodásmód annyira belénk ivódott, hogy el sem tudjuk képzelni, vannak olyan esetek, amikor a probléma mérete nem is számít!', '',7);
INSERT INTO Bejegyzesek VALUES(21, TO_DATE('2020 03 20', 'yyyy mm dd'), 'A matematika ötletek tárháza és valódi élethelyzetek közvetítője', 'A minket körülvevő nagy hálózatok matematikájának feltárására nyert 2018-ban körülbelül 3 milliárd forintos támogatást az Európai Kutatási Tanács (ERC) szinergiapályázatán Lovász László és két kutatótársa, Barabási Albert-László és Jaroslav Nešetřil. Az interjú március 14-én, röviddel a matematika világnapja után készült. (A Nemzetközi Matematikai Unió (IMU) vezetésével jött létre az a kezdeményezés, hogy az UNESCO – első alkalommal – 2020. március 14-ét a matematika világnapjának nyilvánítsa, ez alkalommal a „Matematika mindenütt” mottóval. Március 14 azért is különösen alkalmas erre, mivel már eddig is Pi napnak hívták.)

Mint sokan mások Európában, jelenleg Nešetřil is otthonról folytatja munkáját a kontinenst elárasztó közegészségügyi válság miatt. Egyeteme zárva van, az órákat felfüggesztették. Ennek ellenére továbbra is optimista a kutatásait illetően; ékesszóló hangfelvételeket készít tárgyáról és a tanítás új megközelítésének szükségességéről.

 „Ha azt szeretnénk, hogy az emberek meglássák a matematika szépségét és hasznosságát, teljesen új módon kell hozzáállnunk a matematika tanításához”, mondja Nešetřil, az Elméleti Számítástechnikai Intézet Kiválósági Központjának igazgatója (Károly Egyetem, Prága), 55 éves matematikatanári tapasztalattal a háta mögött, amelyet főleg egyetemi professzorként szerzett.

„Amikor a gyerekeket művészetre oktatjuk, mutatunk nekik Van Gogh-ot, Picassót, Michelangelót, vagyis a múlt nagyjait. A matematikában ez jóval nehezebb lenne, ezért nem teszünk így. Csak azt mutatjuk meg a gyerekeknek, hogyan kell falat festeni”.

A művészet tanításához való hasonlításkor Nešetřil a neves matematikus, Edward Frenkel Love and Math: The Heart of Hidden Reality (Csók és matek: a világ rejtett szíve, Typotex) című 2013-as könyvére hivatkozik. Nešetřil számára a matematika tanításakor legalább törekedni kellene arra, hogy az a nagy eszmékről szóljon, s az emberi teljesítményeket a lehető legszélesebb látókörben, úgymond a hegycsúcsokról nézve mutassa be.', '',7);

-- A Forum tábla feltöltése.
INSERT INTO Forum VALUES(1, 'Általános');
INSERT INTO Forum VALUES(2, 'Autók');
INSERT INTO Forum VALUES(3, 'Szuper Liga');

-- A Komment tábla feltöltése.
INSERT INTO Komment VALUES(1, 'Minden a pénzről szól már... :(', TO_DATE('2021 04 20', 'yyyy mm dd'), 41, '', 3);
INSERT INTO Komment VALUES(2, 'Én várom! :)', TO_DATE('2021 04 20', 'yyyy mm dd'), 11, '', 3);
INSERT INTO Komment VALUES(3, 'Engem így már nem is érdekel a foci :(', TO_DATE('2021 04 20', 'yyyy mm dd'), 42, '', 3);
INSERT INTO Komment VALUES(5, '#notosuperleague', TO_DATE('2021 04 20', 'yyyy mm dd'), 17, '', 3);
INSERT INTO Komment VALUES(6, 'Már vártam erre!', TO_DATE('2021 04 20', 'yyyy mm dd'), 44, '', 3);
INSERT INTO Komment VALUES(7, 'Eladták magukat :(', TO_DATE('2021 04 20', 'yyyy mm dd'), 3, '', 3);

INSERT INTO Komment VALUES(8, 'BMW a legjobb :P', TO_DATE('2021 04 23', 'yyyy mm dd'), 44, '', 2);
INSERT INTO Komment VALUES(9, 'Mercedes a legjobb :D', TO_DATE('2021 04 23', 'yyyy mm dd'), 32, '', 2);
INSERT INTO Komment VALUES(10, 'Mazda a legjobb :O', TO_DATE('2021 04 23', 'yyyy mm dd'), 12, '', 2);
INSERT INTO Komment VALUES(11, 'Trabant a legjobb :X', TO_DATE('2010 07 1', 'yyyy mm dd'), 2, '', 2);

INSERT INTO Komment VALUES(12, 'Tetszenek ezek a blogok!', TO_DATE('2021 03 22', 'yyyy mm dd'), 5, '', 1);
INSERT INTO Komment VALUES(13, 'Boldog újévet!', TO_DATE('2021 01 1', 'yyyy mm dd'), 2, '', 1);


-- A Csomagok tábla feltöltése.
INSERT INTO Latogatas VALUES(1, 2, TO_DATE('2020 05 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(1, 4, TO_DATE('2020 05 1', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(5, 4, TO_DATE('2020 02 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(1, 4, TO_DATE('2020 05 5', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(6, 4, TO_DATE('2020 05 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(45, 1, TO_DATE('2020 05 23', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(23, 1, TO_DATE('2020 03 11', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(7, 3, TO_DATE('2020 10 1', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(34, 3, TO_DATE('2020 05 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(1, 2, TO_DATE('2020 05 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(21, 4, TO_DATE('2020 05 9', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(12, 6, TO_DATE('2020 07 13', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(8, 1, TO_DATE('2020 05 8', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(3, 5, TO_DATE('2020 09 22', 'yyyy mm dd'));
INSERT INTO Latogatas VALUES(3, 2, TO_DATE('2020 05 22', 'yyyy mm dd'));









