--
-- Setup for the article:
-- https://dbwebb.se/kunskap/lagra-innehall-i-databas-for-webbsidor-och-bloggposter-v2
--

--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
-- USE oophp;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for blog
--
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `path` CHAR(120) UNIQUE,
  `slug` CHAR(120) UNIQUE,

  `title` VARCHAR(120),
  `data` TEXT,
  `filter` VARCHAR(80) DEFAULT NULL,
  `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
  `image2` VARCHAR(100) DEFAULT NULL,    -- Link to an image

  -- MySQL version 5.6 and higher
  `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

  `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `blog` (`path`, `slug`, `title`, `data`, `filter`, `image`, `image2`) VALUES
    ("blogpost-6", "mysterium", "Mysterium", "Andarna kallar på er och ni behöver hjälpas åt för att tolka dess vision! <br> I Mysterium spelar en av deltagarna anden, vars uppgift är att guida mediumen (de övriga spelarna) till rätt vision. Alla spelare har en individuell vision bestående av ett personkort, ett platskort och ett vapenkort. Anden kommunicerar endast med hjälp ar tarotkort som hen delar ut i varje runda, för att försöka guida spelarna till rätt beslut. <br> Med den begränsade tiden och de begränsade korten kan detta visa sig svårare än det verkar! \n Innan klockan hunnit slå sju och solen går upp behöver ni ha gissat rätt på era individuella kort och om alla lyckas med det ska ni var och en för sig, utan att prata med varandra, gissa vilken av spelarnas kombinationer som är den skyldige. <br> *Mysterium* är ett magiskt vackert spel men mycket känsla som ställer er kommunikation och tolkningsförmåga på sin spets. Det verkliga underhållvärdet är just att försöka förstå hur anden har tänkt och vad hen vill förmedla, och att som ande verkligen försöka hitta det bästa sättet att få de olika spelarna att förstå vilket kort som är deras. <br><br>**Spelets höjdpunkt:**<br> De extremt vackra korten är en glädje att spela med och detaljrikedomen i dem låter verkligen spelarnas fantasi flöda. <br><br> **Spelets Miss:** <br>Regelboken är krångligt skriven och om ni vill lära er detta spel rekommenderar jag starkt en sökning på youtube som första steg. <br> **Betyg:** <br>9/10", "markdown", "img/mysterium.jpg", "img/mysterium2.jpg"),

    ("blogpost-5", "terraforming-mars", "Terraforming Mars", "Koloniseringen av Mars är i full gång och era företag tävlar om vem som kan dra mest nytta och skapa mest värde för planeten. Genom att höja temperaturen, plantera träd och höja syrgasnivån samt expandera haven kommer ni allt närmare målet, att skapa en beboling planet. Spelaren som vinner har skapat sig mest resurser och hittat flest synnergier bland de olika kort de har tillgång till. Det finns även möjlighet att bygga städer och andra landmärken. <br> *Terraforming Mars* är ett slående smart spel med högt omspelsvärde. Den stora mängden kort och den snyggt designade planen gör spelet ständigt intressant och stratergierna många. <br> <br>**Spelets höjdpunkt:**<br> den stora mängden unika spelkort. <br><br> **Spelets Miss:**<br>Incitamentet att bygga vatten kan ibland vara lite väl lågt, och detta gör spelet aningens obalanserat. <br><br> **Betyg:** <br>8/10", "markdown", "img/terraformingmars.jpg", "img/terraformingmars2.jpg"),

    ("blogpost-4", "sagrada", "Sagrada", "I Sagrada tävlar spelarna om vem som kan bygga det vackraste kyrkofönstret med hjälp av färgade glasbitar, representerade av färgade tärningar. Varje runda kommer alla spelare på plocka två tärningar av de slumpmässigt slagna färgerna, och försöka placera dem i sitt fönster. Både färgen och siffran spelar roll, då du inte får placera något tärning som är lika i någon av dem, direkt brevid en annan. <br> Till sin hjälp har spelarna tre olika sorters verktyg att använda, om tärningarna mot all förmodan inte skulle rulla precis som man vill. <br> Förutom det individuella målkortet alla spelare har, finns även tre stycken gemensamma mål, som anvgör vilken typ av glasfönster som ses som vackrast just nu, och därmed ger högst poäng. <br> *Sagrada* är ett strålande spel som verkligen utmanar spelarna att tänka till en gång extra för att kunna bygga sitt kyrkofönster och som låter alla fundera över hur detta ens ska ha en chans att gå ihop. <br><br>**Spelets höjdpunkt:** <br>De smart och snyggt byggda spelkomponenterna är verkligen väl designade för sina ändamål och tillåter även fumliga fingrar att spela. <br><br> **Spelets Miss:** <br>De individuella målen saknar variation och bygger alla på samma koncept, åtminstone i grundpaketet. Även här finns flertalet expansioner, med fler på väg, där detta problem åtgärdas. <br><br> **Betyg:** <br>8/10", "markdown", "img/sagrada.jpg", "img/sagrada2.jpg"),

    ("blogpost-3", "imaginarium", "Imaginarium", "Imaginarium välkomnar dig in i drömfabriken. Därinne stöter du på de mest fantastiska maskiner, maskiner som du kan kombinera, reparera och ta isär, allt för att din egen maskinpark ska bli såsom du själv vill ha den. Med begränsat utrymme gäller det att producera rätt råvaror och se till att du har plats för nästa maskin som kommer hjälpa dig mot ditt mål, att producera alla dessa magiska råvaror. <br> Imaginarium har onekligen sin charm med rika illustrationer som verkligen måste ha uppkommit i drömmar. I spelet medföljer fem spelarfigurer som du kan sätta din egen prägel på genom att måla dem efter din egen fantasi (färg medföljer ej). Denna typ av detalj ger spelet lite extra djup då spelarna får chansen att göra det egna spelet unikt. <br> Imaginarium är ett spel där det gäller att tänka sig för vilka fabriker man väljer och även vilka medarbetares man köper in, då dessa i stor utsträckning kan påverka din produktion. Första gången kan spelet vara svårt att komma in i och se vitsen i de olika fabrikerna och deras synnergier, men ge spelet ett par chanser till så kommer en magisk fabrik välkomna dig in genom sina portar. <br> <br>**Spelets höjdpunkt:**<br> de rikt illustrerade korten låter verkligen fantsin gå igång och ger spelet hög känsla. <br><br> **Spelets Miss:** <br> tempot känns ibland långsamt och vid två spelare kan en del av möjligheterna kännas begränsade, vilket gör det aningens förutsägbart. <br><br> **Betyg:**<br> 7/10", "markdown", "img/imaginarium.jpg", "img/imaginarium2.jpg"),

    ("blogpost-2", "wingspan", "Wingspan", "Wingspan är ett workerplacementspel för 1-5 personer där målsättningen är att skapa ett så bra naturskyddsområde som möjligt för fåglarna att leva i. Detta gör du genom att under fyra rundor välja mellan fyra olika actions: spela ut en ny fågel, hämta mat, lägga ägg eller dra nya fågelkort. Ju fler fåglar du har ute, desto mer mat/ägg/kort kan du få tag i. Alla fåglar har olika förmågor och samverkar olika bra. <br> [Wingspan på BoardGameGeek](https://boardgamegeek.com/boardgame/266192/wingspan). Spelet spelas i fyra rundor blir kortare och kortare och efter den fjärde rundan räknar ni poäng från de kort ni lyckats spela ut och de andra värdefulla saker som din fåglar kan ha tänkas samlat på sig. <br> <br>**Spelets höjdpunkt:**<br> den söta tärningskastaren som följer med som ser ut som en liten fågelholk glädjer alla vid bordet. <br><br> **Spelets Miss:** <br>att det inte finns med fåglar utför Amerikas kontinent. Tur att det finns expansioner för det. <br><br> **Betyg:**<br> 9/10", "markdown, nl2br", "img/wingspan.jpg", "img/wingspan2.jpg"),

    ("blogpost-1", "valkommen-till-gme", "Välkommen till Gme!", "Då var det dags, då drar vi igång! <br> Välkommen till Gme, din källa till nyheter i brädspelsvärlden. Jag som driver den här sidan heter Linnéa och som du kanske kan gissa spelar jag oförskämt mycket brädspel, vilket jag såklart vill dela med mig av! <br> Jag kommer att i kommande inlägg recensera flertalet olika spel, ett i taget. Om du skulle vara nyfiken på vad flera personer tycker om spelet går det alldeles utmärkt att ta sig in på [BoardGameGeek](https://boardgamegeek.com/) där du bland annat kan hitta användarrecensioner och komplexitetsangivelser för spelen, vilket jag tyvärr inte kommer att kunna tillhandahålla. Däremot kan du köpa de spel som recenseras via oss, det är så enkelt som att klicka sig in under produkter och välja det eller de spel du är intresserad av! <br> Det var nog allt för mig för denna gång, men vi hörs ju snart igen. Tills dess, Game Over!", "markdown", "img/gme.jpg", "img/gme2.jpg");

SELECT `id`, `path`, `slug`, `filter`, `title`, `created` FROM `blog`;


--
--
--
--   ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
