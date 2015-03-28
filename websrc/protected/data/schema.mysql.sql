USE zombier1_bottletrade;

/*
	Drop Tables - Start
	NOTE: must drop in reverse order of adding
*/
DROP TABLE IF EXISTS iso;
DROP TABLE IF EXISTS hashtag;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS trademessage;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS bottletrade;
DROP TABLE IF EXISTS bottleoffer;
DROP TABLE IF EXISTS offer;
DROP TABLE IF EXISTS usertradeinfo;
DROP TABLE IF EXISTS trade;
DROP TABLE IF EXISTS bottle;

/* Beer Tables */
DROP TABLE IF EXISTS beer;
DROP TABLE IF EXISTS brewery;
DROP TABLE IF EXISTS beerstyle;
DROP TABLE IF EXISTS beercategory;

/* Wine Tables */
DROP TABLE IF EXISTS wine;
DROP TABLE IF EXISTS winery;
DROP TABLE IF EXISTS winestyle;

/* Spirit Tables */
DROP TABLE IF EXISTS spirit;
DROP TABLE IF EXISTS distillery;
DROP TABLE IF EXISTS spiritstyle;

/* Remainder of Tables */
DROP TABLE IF EXISTS friendrequest;
DROP TABLE IF EXISTS friend;
DROP TABLE IF EXISTS user;
/*
	Drop Tables - End
*/

/*
	Create Tables - Start
*/
CREATE TABLE user (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(20) NOT NULL,
    Password VARCHAR(128) NOT NULL,
    Email VARCHAR(64) NOT NULL,
    FirstName VARCHAR(64) NOT NULL,
    LastName VARCHAR(64) NOT NULL,
    Birthday DATE NOT NULL,
    Address VARCHAR(64) NOT NULL DEFAULT '',
    City VARCHAR(64) NOT NULL DEFAULT '',
    DisplayCity VARCHAR(64) NOT NULL DEFAULT '',
    State VARCHAR(64) NOT NULL DEFAULT '',
    Country VARCHAR(64) NOT NULL DEFAULT '',
    Zip INTEGER NOT NULL DEFAULT 0,
    Links VARCHAR(300) NOT NULL DEFAULT '',
    About VARCHAR(500) NOT NULL DEFAULT '',
    ImagePath VARCHAR(255),
    IsActive BOOLEAN NOT NULL DEFAULT TRUE,
    IsPrivate BOOLEAN NOT NULL DEFAULT FALSE,
	EmailPreferences INTEGER NOT NULL DEFAULT 0,
    ForgotPasswordToken VARCHAR(128),
    ForgotPasswordTokenExpiration DATETIME,
    CreatedTime DATETIME NOT NULL,
    CONSTRAINT UNIQUE (Username),
    CONSTRAINT UNIQUE (Email)
);

CREATE TABLE friend (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	User1 INTEGER NOT NULL,
	User2 INTEGER NOT NULL,
    CreatedTime DATETIME NOT NULL,
	CONSTRAINT FOREIGN KEY (User1) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (User2) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT UNIQUE (User1, User2)
);

CREATE TABLE friendrequest (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	UserTo INTEGER NOT NULL,
	UserFrom INTEGER NOT NULL,
    SentTime DATETIME NOT NULL,
	CONSTRAINT FOREIGN KEY (UserTo) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (UserFrom) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT UNIQUE (UserTo, UserFrom)
);

/* Beer Tables */
CREATE TABLE brewery (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(60) NOT NULL,
    Address1 VARCHAR(64),
    Address2 VARCHAR(64),
    City VARCHAR(64),
    State VARCHAR(64),
    Code VARCHAR(25),
    Country VARCHAR(64),
    Phone VARCHAR(48),
	Established DATETIME,
	Website VARCHAR(255),
    ImagePath VARCHAR(255),
	Description TEXT,
	UserAdded INT,
	CreatedTime DATETIME NOT NULL,
	LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserAdded) REFERENCES user (ID)
);

CREATE TABLE beercategory (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(60) NOT NULL,
	LastUpdateTime DATETIME NOT NULL
);

CREATE TABLE beerstyle (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	CategoryID INTEGER NOT NULL,
    Name VARCHAR(60) NOT NULL,
	LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (CategoryID) REFERENCES beercategory (ID)
);

CREATE TABLE beer (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	BreweryID INT,
	Name VARCHAR(60) NOT NULL,
	StyleID INT,
	ABV FLOAT NOT NULL DEFAULT 0,
	IBU FLOAT NOT NULL DEFAULT 0,
	SRM FLOAT NOT NULL DEFAULT 0,
	UPC INT(40) NOT NULL DEFAULT 0,
	Availability VARCHAR(63),
    ImagePath VARCHAR(255),
	Description TEXT,
	UserAdded INT,
	CreatedTime DATETIME NOT NULL,
	LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (BreweryID) REFERENCES brewery (ID),
    CONSTRAINT FOREIGN KEY (StyleID) REFERENCES beerstyle (ID),
    CONSTRAINT FOREIGN KEY (UserAdded) REFERENCES user (ID)
);

/* Wine Tables */
CREATE TABLE winery (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(60) NOT NULL,
    Address1 VARCHAR(64),
    Address2 VARCHAR(64),
    City VARCHAR(64),
    State VARCHAR(64),
    Code VARCHAR(25),
    Country VARCHAR(64),
    Phone VARCHAR(48),
	Established DATETIME,
	Website VARCHAR(255),
    ImagePath VARCHAR(255),
	Description TEXT,
	UserAdded INT,
	CreatedTime DATETIME NOT NULL,
	LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserAdded) REFERENCES user (ID)
);

CREATE TABLE winestyle (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(60) NOT NULL,
    CONSTRAINT UNIQUE (Name)
);

CREATE TABLE wine (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    WineryID INT,
	StyleID INT,
    CONSTRAINT FOREIGN KEY (WineryID) REFERENCES winery (ID),
    CONSTRAINT FOREIGN KEY (StyleID) REFERENCES winestyle (ID)
);

/* Spirit Tables */
CREATE TABLE distillery (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(60) NOT NULL,
    Address1 VARCHAR(64),
    Address2 VARCHAR(64),
    City VARCHAR(64),
    State VARCHAR(64),
    Code VARCHAR(25),
    Country VARCHAR(64),
    Phone VARCHAR(48),
	Established DATETIME,
	Website VARCHAR(255),
    ImagePath VARCHAR(255),
	Description TEXT,
	UserAdded INT,
	CreatedTime DATETIME NOT NULL,
	LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserAdded) REFERENCES user (ID)
);

CREATE TABLE spiritstyle (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(60) NOT NULL,
    CONSTRAINT UNIQUE (Name)
);

CREATE TABLE spirit (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	DistilleryID INT,
	StyleID INT,
    CONSTRAINT FOREIGN KEY (DistilleryID) REFERENCES distillery (ID),
    CONSTRAINT FOREIGN KEY (StyleID) REFERENCES spiritstyle (ID)
);

CREATE TABLE bottle (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserID INTEGER NOT NULL,
    BeerID INTEGER,
    WineID INTEGER,
	SpiritID INTEGER,
    Quantity INTEGER NOT NULL,
    FluidAmount VARCHAR(20) NOT NULL,
    BottledOnDate DATETIME NOT NULL,
    Description VARCHAR(1000) NOT NULL DEFAULT '',
    PurchasePrice DOUBLE,
    IsTradeable BOOLEAN NOT NULL,
    IsPrivate BOOLEAN NOT NULL,
    IsSearchable BOOLEAN NOT NULL,
    IsActive BOOLEAN NOT NULL,
    ImagePath VARCHAR(255),
    CreatedTime DATETIME NOT NULL,
    LastUpdateTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserID) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (BeerID) REFERENCES beer (ID),
    CONSTRAINT FOREIGN KEY (WineID) REFERENCES wine (ID),
    CONSTRAINT FOREIGN KEY (SpiritID) REFERENCES spirit (ID)
);

CREATE TABLE trade (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Status INTEGER NOT NULL,
    CreatedTime DATETIME NOT NULL,
    CompletedTime DATETIME,
    LastUpdateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE usertradeinfo (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	TradeID INTEGER NOT NULL,
    UserOwnerID INTEGER NOT NULL /* owner the trade info */,
    UserOtherID INTEGER NOT NULL /* user trading with the owner */,
	Status INTEGER NOT NULL,
	ShipDate DATETIME,
    CompletedTime DATETIME,
    CONSTRAINT FOREIGN KEY (TradeID) REFERENCES trade (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (UserOwnerID) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (UserOtherID) REFERENCES user (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT UNIQUE (TradeID, UserOwnerID)
);

CREATE TABLE offer (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserTo INTEGER NOT NULL,
    UserFrom INTEGER NOT NULL,
    Message VARCHAR(1000),
    IsRead BOOLEAN NOT NULL DEFAULT FALSE,
    SentTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserTo) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (UserFrom) REFERENCES user (ID)
);

CREATE TABLE bottleoffer (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    OfferID INTEGER NOT NULL,
    BottleID INTEGER NOT NULL,
    Quantity INTEGER NOT NULL,
    CONSTRAINT FOREIGN KEY (OfferID) REFERENCES offer (ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (BottleID) REFERENCES bottle (ID)
);

CREATE TABLE bottletrade (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    TradeID INTEGER NOT NULL,
    BottleID INTEGER NOT NULL,
    Quantity INTEGER NOT NULL,
    CONSTRAINT FOREIGN KEY (TradeID) REFERENCES trade (ID),
    CONSTRAINT FOREIGN KEY (BottleID) REFERENCES bottle (ID)
);

CREATE TABLE message (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserTo INTEGER NOT NULL,
    UserFrom INTEGER NOT NULL,
    Subject VARCHAR(60) NOT NULL,
    Body VARCHAR(1000) NOT NULL,
    IsRead BOOLEAN NOT NULL,
    IsLeaf BOOLEAN NOT NULL,
    SentTime DATETIME NOT NULL,
	DeletedBySender BOOLEAN NOT NULL,
	DeletedByReceiver BOOLEAN NOT NULL,
    CONSTRAINT FOREIGN KEY (UserTo) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (UserFrom) REFERENCES user (ID)
);

CREATE TABLE trademessage (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserTo INTEGER NOT NULL,
    UserFrom INTEGER NOT NULL,
    Body VARCHAR(200) NOT NULL,
    IsRead BOOLEAN NOT NULL DEFAULT FALSE,
	TradeID INTEGER NOT NULL,
    SentTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FOREIGN KEY (UserTo) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (UserFrom) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (TradeID) REFERENCES trade (ID)
);

CREATE TABLE review (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    TradeID INTEGER NOT NULL,
    UserTo INTEGER NOT NULL,
    UserFrom INTEGER NOT NULL,
    Rating INTEGER NOT NULL,
    Message VARCHAR(1000) NOT NULL,
    CONSTRAINT FOREIGN KEY (TradeID) REFERENCES trade (ID),
    CONSTRAINT FOREIGN KEY (UserTo) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (UserFrom) REFERENCES user (ID),
    CONSTRAINT UNIQUE (TradeID, UserTo)
);

CREATE TABLE hashtag (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Tag VARCHAR(60) NOT NULL,
    BottleID INTEGER,
    SentTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FOREIGN KEY (BottleID) REFERENCES bottle (ID)
);

CREATE TABLE iso (
    ID INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    UserID INTEGER NOT NULL,
    BeerID INTEGER,
    BreweryID INTEGER,
    BeerStyleID INTEGER,
    WineID INTEGER,
    WineryID INTEGER,
    WineStyleID INTEGER,
    SpiritID INTEGER,
    DistilleryID INTEGER,
    SpiritStyleID INTEGER,
    CreatedTime DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (UserID) REFERENCES user (ID),
    CONSTRAINT FOREIGN KEY (BeerID) REFERENCES beer (ID),
    CONSTRAINT FOREIGN KEY (BreweryID) REFERENCES brewery (ID),
    CONSTRAINT FOREIGN KEY (BeerStyleID) REFERENCES beerstyle (ID),
    CONSTRAINT FOREIGN KEY (WineID) REFERENCES wine (ID),
    CONSTRAINT FOREIGN KEY (WineryID) REFERENCES winery (ID),
    CONSTRAINT FOREIGN KEY (WineStyleID) REFERENCES winestyle (ID),
    CONSTRAINT FOREIGN KEY (SpiritID) REFERENCES spirit (ID),
    CONSTRAINT FOREIGN KEY (DistilleryID) REFERENCES distillery (ID),
    CONSTRAINT FOREIGN KEY (SpiritStyleID) REFERENCES spiritstyle (ID)
);
/*
	Create Tables - End
*/

/*
	Create Views - Start
*/
CREATE OR REPLACE VIEW event AS
SELECT 'B' AS Type, CreatedTime AS Time, UserID AS OwnerID, 0 AS ReceiverID, ID AS BottleID, 0 AS TradeID
FROM   bottle
WHERE  IsActive=1 AND IsPrivate=0

UNION  ALL
SELECT 'T' AS Type, CompletedTime AS Time,
	UserOwnerID AS OwnerID,
	UserOtherID AS ReceiverID,
	0 AS BottleID,
	/* 	
		Randomize which trade we take, this is needed so we don't
		always associate trades with the user proposing the trade
	*/
	CASE 
		WHEN (TradeID % 2) = 0 THEN MAX(ID)
		WHEN (TradeID % 2) <> 0 THEN MIN(ID)
	END 
	AS TradeID
FROM usertradeinfo
WHERE  CompletedTime IS NOT NULL
GROUP BY TradeID;

CREATE OR REPLACE VIEW feed AS
SELECT
	event.Type AS EventType, event.Time AS EventTime, event.OwnerID AS EventOwnerID, event.ReceiverID AS EventReceiverID, event.TradeID, event.BottleID,
	/* bottle fields */
	bottle.UserID,
	bottle.BeerID,
    bottle.WineID,
	bottle.SpiritID,
    bottle.Quantity,
    bottle.FluidAmount, 
    bottle.BottledOnDate, 
    bottle.Description,
    bottle.PurchasePrice ,
    bottle.IsTradeable,
    bottle.IsPrivate,
    bottle.IsSearchable,
    bottle.IsActive,
    bottle.ImagePath
FROM
	event 
	LEFT JOIN bottle ON event.BottleID = bottle.ID;
/*
	Create Views - End
*/

/*
	Create Indexes - Start
*/
CREATE INDEX User_Username ON user (Username);
CREATE INDEX User_FirstName ON user (FirstName);
CREATE INDEX User_LastName ON user (LastName);
CREATE INDEX User_City ON user (City);
CREATE INDEX User_State ON user (State);

CREATE INDEX Brewery_Name ON brewery (Name);
CREATE INDEX Brewery_City ON brewery (City);
CREATE INDEX Brewery_State ON brewery (State);

CREATE INDEX Winery_Name ON winery (Name);
CREATE INDEX Winery_City ON winery (City);
CREATE INDEX Winery_State ON winery (State);
CREATE INDEX WineStyle_Name ON winestyle (Name);

CREATE INDEX Distillery_Name ON distillery (Name);
CREATE INDEX Distillery_City ON distillery (City);
CREATE INDEX Distillery_State ON distillery (State);
CREATE INDEX SpiritStyle_Name ON spiritstyle (Name);
/*
	Create Indexes - End
*/