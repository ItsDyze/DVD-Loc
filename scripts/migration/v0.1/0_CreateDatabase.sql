CREATE DATABASE IF NOT EXISTS `c218` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `c218`;

CREATE TABLE Users
(
    Id          INT          NOT NULL UNIQUE AUTO_INCREMENT,
    LastName    VARCHAR(250) NOT NULL,
    FirstName   VARCHAR(250) NOT NULL,
    Email       VARCHAR(512) NOT NULL,
    PhoneNumber VARCHAR(12),
    Password    VARCHAR(128),
    PRIMARY KEY (Id)
);

CREATE TABLE Countries
(
    Id          INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name        VARCHAR(50) NOT NULL,
    CustomOrder INT,
    PRIMARY KEY (Id)
);

CREATE TABLE Addresses
(
    Id          INT NOT NULL UNIQUE AUTO_INCREMENT,
    PostCode    NVARCHAR(10),
    AddressLine NVARCHAR(250),
    CountryId   INT,
    UserId      INT,
    FOREIGN KEY FK_Address_User (UserId) REFERENCES Users (Id),
    FOREIGN KEY FK_Address_Country (CountryId) REFERENCES Countries (Id),
    PRIMARY KEY (Id)
);

CREATE TABLE Types
(
    Id          INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name        VARCHAR(50) NOT NULL,
    NameLocal   VARCHAR(50) NOT NULL,
    CustomOrder INT,
    PRIMARY KEY (Id)
);

CREATE TABLE Genres
(
    Id          INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name        VARCHAR(50) NOT NULL,
    NameLocal   VARCHAR(50) NOT NULL,
    CustomOrder INT,
    PRIMARY KEY (Id)
);

CREATE TABLE Directors
(
    Id   INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Scenarists
(
    Id   INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Producers
(
    Id   INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Composers
(
    Id   INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Actors
(
    Id   INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    PRIMARY KEY (Id)
);

CREATE TABLE Roles
(
    Id      INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Name    VARCHAR(50) NOT NULL,
    ActorId INT,
    DVDId   INT,
    FOREIGN KEY FK_Role_Actor (ActorId) REFERENCES Actors(Id),
    FOREIGN KEY FK_Role_DVD (DVDId) REFERENCES DVDs(Id),
    PRIMARY KEY (Id)
);

CREATE TABLE DVDs
(
    Id              INT         NOT NULL UNIQUE AUTO_INCREMENT,
    Title           NVARCHAR(250) NOT NULL,
    LocalTitle      NVARCHAR(250),
    Image           BLOB,
    OriginCountryId INT,
    Synopsis        TEXT,
    Notation        INT,
    Note            TEXT,
    Year            INT,
    Certification   NVARCHAR(10),
    IsOffered       BOOL NOT NULL,
    Quantity        INT NOT NULL,
    Price           DECIMAL NOT NULL,
    TypeId          INT,
    FOREIGN KEY FK_DVD_Country (OriginCountryId) REFERENCES Countries(Id),
    FOREIGN KEY FK_DVD_Type (TypeId) REFERENCES Types(Id),
    PRIMARY KEY (Id)
);

CREATE TABLE DVDsGenres
(
    DVDId INT NOT NULL,
    GenreId INT NOT NULL,
    PRIMARY KEY (DVDId, GenreId),
    FOREIGN KEY FK_DVDsGenres_DVD(DVDId) REFERENCES DVDs(Id),
    FOREIGN KEY FK_DVDsGenres_Genre(GenreId) REFERENCES Genres(Id)
);

CREATE TABLE DVDsProducers
(
    DVDId INT NOT NULL,
    ProducerId INT NOT NULL,
    PRIMARY KEY (DVDId, ProducerId),
    FOREIGN KEY FK_DVDsProducers_DVD(DVDId) REFERENCES DVDs(Id),
    FOREIGN KEY FK_DVDsProducers_Producer(ProducerId) REFERENCES Producers(Id)
);

CREATE TABLE DVDsDirectors
(
    DVDId INT NOT NULL,
    DirectorId INT NOT NULL,
    PRIMARY KEY (DVDId, DirectorId),
    FOREIGN KEY FK_DVDsDirectors_DVD(DVDId) REFERENCES DVDs(Id),
    FOREIGN KEY FK_DVDsDirectors_Director(DirectorId) REFERENCES Directors(Id)
);

CREATE TABLE DVDsScenarists
(
    DVDId INT NOT NULL,
    ScenaristId INT NOT NULL,
    PRIMARY KEY (DVDId, ScenaristId),
    FOREIGN KEY FK_DVDsScenarists_DVD(DVDId) REFERENCES DVDs(Id),
    FOREIGN KEY FK_DVDsScenarists_Scenarist(ScenaristId) REFERENCES Scenarists(Id)
);

CREATE TABLE DVDsComposers
(
    DVDId INT NOT NULL,
    ComposerId INT NOT NULL,
    PRIMARY KEY (DVDId, ComposerId),
    FOREIGN KEY FK_DVDsComposers_DVD(DVDId) REFERENCES DVDs(Id),
    FOREIGN KEY FK_DVDsComposers_Composer(ComposerId) REFERENCES Composers(Id)
);

CREATE TABLE Statuses
(
    Id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Name NVARCHAR(25) NOT NULL,
    CustomOrder INT,
    PRIMARY KEY (Id)
);

CREATE TABLE Articles
(
    Id INT NOT NULL UNIQUE AUTO_INCREMENT,
    DVDId INT NOT NULL,
    Price DECIMAL NOT NULL,
    OrderQuantity INT NOT NULL,
    ReturnedQuantity INT NOT NULL,
    FOREIGN KEY FK_Article_DVD (DVDId) REFERENCES DVDs(Id),
    PRIMARY KEY (Id)
);

CREATE TABLE Orders
(
    Id INT NOT NULL UNIQUE AUTO_INCREMENT,
    UserId INT NOT NULL,
    StatusId INT NOT NULL,
    TotalPrice DECIMAL,
    DeliveryDate DATETIME,
    PlannedReturnDate DATETIME,
    ReturnedDate DATETIME,
    PRIMARY KEY (Id),
    FOREIGN KEY FK_Order_User (UserId) REFERENCES Users(Id),
    FOREIGN KEY FK_Order_Statuses (StatusId) REFERENCES Statuses(Id)
);

COMMIT;

