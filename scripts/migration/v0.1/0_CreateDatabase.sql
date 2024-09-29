START TRANSACTION;

CREATE DATABASE IF NOT EXISTS c218 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE c218;

CREATE TABLE addresses (
                           Id int NOT NULL,
                           PostCode varchar(10)  DEFAULT NULL,
                           AddressLine varchar(250)  DEFAULT NULL,
                           CountryId int DEFAULT NULL,
                           UserId int DEFAULT NULL
) ;

CREATE TABLE articles (
                          Id int NOT NULL,
                          DVDId int NOT NULL,
                          Price decimal(10,0) NOT NULL,
                          OrderQuantity int NOT NULL,
                          ReturnedQuantity int NOT NULL
) ;

CREATE TABLE countries (
                           Id int NOT NULL,
                           Name varchar(50) NOT NULL,
                           CustomOrder int DEFAULT NULL
) ;

CREATE TABLE dvds (
                      Id int NOT NULL,
                      Title varchar(250)  NOT NULL,
                      LocalTitle varchar(250)  DEFAULT NULL,
                      Image longtext,
                      OriginCountryId int DEFAULT NULL,
                      Synopsis text,
                      Notation int DEFAULT NULL,
                      Note text,
                      Certification varchar(250)  DEFAULT NULL,
                      IsOffered tinyint(1) NOT NULL,
                      Quantity int NOT NULL,
                      Price decimal(10,0) NOT NULL,
                      TypeId int DEFAULT NULL,
                      ExternalKey varchar(10) DEFAULT NULL,
                      Year int DEFAULT NULL,
                      GenreId int DEFAULT NULL
) ;

CREATE TABLE genres (
                        Id int NOT NULL,
                        Name varchar(50) NOT NULL,
                        CustomOrder int DEFAULT NULL,
                        NameLocal varchar(50) DEFAULT NULL
) ;

CREATE TABLE orders (
                        Id int NOT NULL,
                        UserId int NOT NULL,
                        StatusId int NOT NULL,
                        TotalPrice decimal(10,0) DEFAULT NULL,
                        DeliveryDate datetime DEFAULT NULL,
                        PlannedReturnDate datetime DEFAULT NULL,
                        ReturnedDate datetime DEFAULT NULL
) ;

CREATE TABLE roles (
                       Id int NOT NULL,
                       Name varchar(50) NOT NULL,
                       ActorId int DEFAULT NULL,
                       DVDId int DEFAULT NULL
) ;

CREATE TABLE statuses (
                          Id int NOT NULL,
                          Name varchar(25)  NOT NULL,
                          CustomOrder int DEFAULT NULL
) ;

CREATE TABLE `types` (
                         Id int NOT NULL,
                         Name varchar(50) NOT NULL,
                         CustomOrder int DEFAULT NULL,
                         NameLocal varchar(50) DEFAULT NULL
) ;

CREATE TABLE users (
                       Id int NOT NULL,
                       LastName varchar(250) NOT NULL,
                       FirstName varchar(250) NOT NULL,
                       Email varchar(512) NOT NULL,
                       PhoneNumber varchar(12) DEFAULT NULL,
                       Password varchar(128) DEFAULT NULL
) ;


ALTER TABLE addresses
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id),
    ADD KEY FK_Address_User (UserId),
    ADD KEY FK_Address_Country (CountryId);

ALTER TABLE articles
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id),
    ADD KEY FK_Article_DVD (DVDId);

ALTER TABLE countries
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id);

ALTER TABLE dvds
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id),
    ADD KEY FK_DVD_Country (OriginCountryId),
    ADD KEY FK_DVD_Type (TypeId),
    ADD KEY IX_DVDs_ExternalKey (ExternalKey),
    ADD KEY IX_DVDs_IsOffered (IsOffered),
    ADD KEY FK_DVD_Genre (GenreId);

ALTER TABLE genres
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id);

ALTER TABLE orders
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id),
    ADD KEY FK_Order_User (UserId),
    ADD KEY FK_Order_Statuses (StatusId);

ALTER TABLE roles
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id),
    ADD KEY FK_Role_Actor (ActorId),
    ADD KEY FK_Role_DVD (DVDId);

ALTER TABLE statuses
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id);

ALTER TABLE types
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id);

ALTER TABLE users
    ADD PRIMARY KEY (Id),
    ADD UNIQUE KEY Id (Id);


ALTER TABLE addresses
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE articles
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE countries
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE dvds
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE genres
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE orders
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE roles
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE statuses
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE types
    MODIFY Id int NOT NULL AUTO_INCREMENT;

ALTER TABLE users
    MODIFY Id int NOT NULL AUTO_INCREMENT;
COMMIT;