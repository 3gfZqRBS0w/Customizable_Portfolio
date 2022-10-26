

START TRANSACTION ;



CREATE TABLE IF NOT EXISTS tbl_actions (
    id_action INT NOT NULL,
    titre_action VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_action)
) ;


CREATE TABLE IF NOT EXISTS tbl_owner (
    lastName VARCHAR(50) NOT NULL,
    surName VARCHAR(50) NOT NULL,
    secretCode CHAR(255),
    secretQrCode VARCHAR(255) NOT NULL,
    profilPath VARCHAR(255) DEFAULT 'presentation/portrait.png',
    nameOfWebsite VARCHAR(50) NOT NULL,
    websiteSubtitble VARCHAR(50) NOT NULL,
    qrcodeCheck BOOLEAN DEFAULT 0,
    mailCheck BOOLEAN DEFAULT 0
) ;

CREATE TABLE IF NOT EXISTS tbl_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    timestamp DATETIME NOT NULL,
    ipAddress VARCHAR(15) NOT NULL,
    userAgent VARCHAR(255) NOT NULL,
    actionid_fk INT NOT NULL,
    FOREIGN KEY (actionid_fk) REFERENCES tbl_actions (id_action)
) ;


CREATE TABLE IF NOT EXISTS tbl_careers (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL

) ;

CREATE TABLE IF NOT EXISTS tbl_carreersEvent (
    id INT PRIMARY KEY AUTO_INCREMENT,
     title VARCHAR(50) NOT NULL,
     eventText TEXT NOT NULL,
     startDate DATE,
     endDate DATE,
     fk_idCareer INT NOT NULL,
     FOREIGN KEY (fk_idCareer) REFERENCES tbl_careers(id)
) ;



CREATE TABLE IF NOT EXISTS tbl_skillType(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL
) ;

CREATE TABLE IF NOT EXISTS tbl_skill (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    fk_idSkillType INT NOT NULL, 
    activationPercentage BOOLEAN DEFAULT 1,
    Percentage INT(1),
    FOREIGN KEY (fk_idSkillType) REFERENCES tbl_skillType(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    publicationDate DATETIME,
    fullTextOfArticles TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_projects (
    fk_careerID INT,
    fk_articleID INT,
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    photoName VARCHAR(255) NOT NULL,
    fullTextOfProject TEXT NOT NULL,
    FOREIGN KEY (fk_careerID) REFERENCES tbl_careers(id),
    FOREIGN KEY (fk_articleID) REFERENCES tbl_articles(id)
);



CREATE TABLE IF NOT EXISTS tbl_contacts (
    fullName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    num CHAR(10) NOT NULL,
    fk_logsID INT,
    message MEDIUMTEXT,
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs(id)
) ;

/* LOGS LINK */

CREATE TABLE IF NOT EXISTS tbl_projectLogs(
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_projects(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_articlesLogs(
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_articles(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_careerTypeLogs(
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_careers(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_careerLogs(
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_careers(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_skillLogs (
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_skill(id)
) ;

CREATE TABLE IF NOT EXISTS tbl_skillTypesLogs (
    idPost INT,
    idLog INT NOT NULL,
    FOREIGN KEY (idLog) REFERENCES tbl_logs(id),
    FOREIGN KEY (idPost) REFERENCES tbl_skillType(id)
) ;


/*
CREATE TABLE IF NOT EXISTS tbl_category (
    id INT NOT NULL AUTO_INCREMENT,

    PRIMARY KEY (id)
) ; 
*/
COMMIT;