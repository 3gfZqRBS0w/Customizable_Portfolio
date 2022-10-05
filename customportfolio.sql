START TRANSACTION;

CREATE TABLE IF NOT EXISTS tbl_actions (
    id_action INT NOT NULL AUTO_INCREMENT,
    titre_action VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_action)
) ;


CREATE TABLE IF NOT EXISTS tbl_owner (
    lastName VARCHAR(50) NOT NULL,
    surName VARCHAR(50) NOT NULL,
    secretCode CHAR(255),
    secretQrCode VARCHAR(255) NOT NULL,
    nameOfWebsite VARCHAR(50) NOT NULL,
    websiteSubtitble VARCHAR(50) NOT NULL,
    qrcodeCheck BOOLEAN DEFAULT 0,
    mailCheck BOOLEAN DEFAULT 0
) ;

CREATE TABLE IF NOT EXISTS tbl_logs (
    logsID INT PRIMARY KEY AUTO_INCREMENT,
    horodatage DATETIME NOT NULL,
    addr_ip VARCHAR(15) NOT NULL,
    user_agent VARCHAR(255) NOT NULL,
    actionid_fk INT NOT NULL,
    FOREIGN KEY (actionid_fk) REFERENCES tbl_actions (id_action)
) ;


CREATE TABLE IF NOT EXISTS tbl_careers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    typeOfCareer VARCHAR(50) NOT NULL, 
    fk_logsID INT,
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID)
) ;

CREATE TABLE IF NOT EXISTS tbl_carreersEvent (
     titleOfEvent VARCHAR(50) NOT NULL,
     eventText VARCHAR(255) NOT NULL,
     startDate DATE,
     endDate DATE,
     fk_idCareer INT NOT NULL,
     FOREIGN KEY (fk_idCareer) REFERENCES tbl_careers(id) 
) ; 

CREATE TABLE IF NOT EXISTS tbl_articles (
    articleID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    publicationDate DATETIME,
    fullTextOfArticles TEXT NOT NULL,
    fk_logsID INT,
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID)
);

CREATE TABLE IF NOT EXISTS tbl_projects (
    fk_careerID INT,
    fk_articleID INT,
    fk_logsID INT,
    title VARCHAR(50) NOT NULL,
    photoName VARCHAR(255) NOT NULL,
    fullTextOfProject TEXT NOT NULL,
    PRIMARY KEY(title),
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID),
    FOREIGN KEY (fk_careerID) REFERENCES tbl_careers (id),
    FOREIGN KEY (fk_articleID) REFERENCES tbl_articles(articleID)
);

CREATE TABLE IF NOT EXISTS tbl_contacts (
    fullName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    num CHAR(10) NOT NULL,
    fk_logsID INT NOT NULL,
    message MEDIUMTEXT,
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID)
) ;

COMMIT;
