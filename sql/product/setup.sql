--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
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
-- Create table for my own product database
--
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `price` INT DEFAULT NULL,             -- Retail-price
    `stock` INT DEFAULT NULL,             -- Amount in stock
    `brand` VARCHAR(100),
    `time` VARCHAR(15) DEFAULT NULL,      -- Est. playing time in min, ex 40-70
    `players` VARCHAR(6) DEFAULT NULL,    -- amount of players, ex 1-5
    `year` INT NOT NULL DEFAULT 1900,
    `language` CHAR(3) DEFAULT NULL,      -- swe, fin, en, etc
    `description` TEXT,                   -- Short intro to the product
    `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
    `type` VARCHAR(100) DEFAULT NULL,     -- type of game, ex card game
    `rating` VARCHAR(20) DEFAULT NULL     -- rating, ex 8/10
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `product`;
INSERT INTO `product` (`name`, `price`, `stock`, `brand`, `time`, `players`, `year`,
    `language`, `description`, `image`, `type`, `rating`) VALUES
    ('Wingspan', 595, 2, 'Stonemaier Games', '40-70', '1-5', 2019,
        'eng', 'Kan du dina fåglar? Wingspan är ett sällskapsspel för familjer där varje spelare
        försöker få de flesta och bästa fåglarna att flytta in i sitt naturskyddsområde.
        Spelet spelas i fyra rundor som blir kortare för varje gång och där målen är slupmässigt olika.
        Här handlar det om att väga matförsörjning, fågelkort och äggläggning i en fin balansgång för att i
        slutändan skapa den bästa boplatsen för fåglarna!', 'img/wingspan.jpg', 'strategi, kortspel, PvP', '9/10'),
    ('Scythe', 695, 4, 'Stonemaier Games', '90-150', '1-5', 2016,
        'eng', 'Scythe utspelar sig i en alternativ verklighet efter första världskriget där utvecklingen tog en helt annan vändning.
        Med hjälp av stora stridsmaskiner och robotar slåss de olika stormakterna om vem som ska styra området.
        Genom att ta över mark, samla mer resurser, arbetskraft, popularitet och stridsmakt samt lyckas med andra
        bedrifter är det den som i spelets slut har mest pengar som vinner. Är det du?',
        'img/scythe.jpg', 'strategi, PvP', '7/10'),
    ('Terraforming Mars', 529, 6, 'Fryxgames', '120-150', '1-5', 2016,
        'eng', 'Du och ditt företag har lämnat jorden för att kolonisera Mars.
        Genom att höja nivåerna av vatten, syre, och temperatur kommer ni allt närmare en beboelig planet,
        men vem är det som kommer att dra mest nytta av exploateringen?',
        'img/terraformingmars.jpg', 'strategi, kortspel, PvP', '8.5/10'),
    ('Yatzy', 39, 3, 'Kärnan', '20-30', '1-6', 1950,
        'sve', 'Det klassiska spelet lever vidare! I Yatzy turas spelarna om att kasta 5 tärningar,
        som mest tre gånger, för att försöka uppnå de olika målen och få så mycket poäng som möjligt',
         'img/yatzy.jpg', 'familj, tärningspel, PvP', '6/10'),
    ('Sagrada', 395, 4, 'Floodgate Games', '30-45', '1-4', 2017,
        'eng', 'Vem är den bästa på att skapa vackra kyrkofönster och får äran att sätta dem i en berömd byggnad?
        I sagrada bygger spelarna kyrkofönster med hjälp av färgade tärningar, som draftas och placeras ut enligt
        bestämda regler på spelarnas egen bricka. Du har ett hemligt mål att försöka på så mycket poäng på som möjligt
        men även tre publika mål som alla eftersträvar. I slutändan är det den som byggt sitt fönster på bästa sätt som kommer att koras som vinnare!',
        'img/sagrada.jpg', 'strategi, tärningsspel, PvP', '7/10'),
    ('Mysterium', 385, 3, 'Lautapelit', '42', '2-7', 2015,
        'sve', 'I mysterium har spelarna tillkallats till ett gammalt hus där ägaren behöver
        hjälp av medium (spelarna) för att tyda den mystiska andens (spelledaren) visioner och på så sätt lösa det brott som begåtts. Vem utförde det,
        var och med vad? Spelarnas gemensamma mål är att lyckas lista ut allt innan tiden tar slut och morgonen nalkats.',
        'img/mysterium.jpg', 'strategi, familj, PvE', '9/10')
;

SELECT * FROM `product`;
