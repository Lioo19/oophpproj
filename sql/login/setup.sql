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
  `password` VARCHAR(120) UNIQUE,
  `admin` CHAR(1), -- Y or N

   -- MySQL version 5.6 and higher
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `login` (`username`, `password`, `admin`) VALUES
    ("admin", "admin", "Y"),
    ("test", "test", "N");
    
SELECT `username`, `password`, `admin` FROM `login`;


--
--
--
--   ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
