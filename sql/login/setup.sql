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
-- Create table for Login
--
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(120) UNIQUE,
  `password` VARCHAR(120),
  `name` VARCHAR(120),
  `email` VARCHAR(150),
  `admin` CHAR(1), -- Y or N

   -- MySQL version 5.6 and higher
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `login` (`username`, `password`, `name`, `email`, `admin`) VALUES
    ("admin", "admin", "Admina Admin", "admin@admin.com", "Y"),
    ("test", "test", "Förnamn Efternamn", "test@test.com", "N");

SELECT `username`, `password`, `name`, `email`, `admin` FROM `login`;


--
--
--
--   ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
