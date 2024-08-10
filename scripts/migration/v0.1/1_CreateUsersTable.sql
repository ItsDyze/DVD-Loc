USE C218;

CREATE TABLE Users (
    Id              INT             NOT NULL    UNIQUE AUTO_INCREMENT,
    LastName        VARCHAR(250)    NOT NULL,
    FirstName       VARCHAR(250)    NOT NULL,
    Email           VARCHAR(512)    NOT NULL,
    PhoneNumber     VARCHAR(12),
    Password        VARCHAR(128),
    PRIMARY KEY (Id)
);