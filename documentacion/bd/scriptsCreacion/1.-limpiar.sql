BEGIN;

-- Permite que los procedimientos se puedan crear (REVISAR)
-- SET GLOBAL log_bin_trust_function_creators = 1;

SET @OLD_default_storage_engine=@@default_storage_engine, default_storage_engine=InnoDB;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ALLOW_INVALID_DATES';

-- DROP SCHEMA IF EXISTS @DB_DATABASE;
-- CREATE SCHEMA IF NOT EXISTS @DB_DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci ;
-- USE @DB_DATABASE;

