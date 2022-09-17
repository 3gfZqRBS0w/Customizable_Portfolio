CREATE TABLE IF NOT EXISTS tbl_actions (
    id_action INT NOT NULL AUTO_INCREMENT,
    titre_action VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_action)
) ;


CREATE TABLE IF NOT EXISTS tbl_owner (
    lastName VARCHAR(50) NOT NULL,
    surName VARCHAR(50) NOT NULL,
    secretCode CHAR(255),
    nameOfWebsite VARCHAR(50) NOT NULL,
    websiteSubtitble VARCHAR(50) NOT NULL
) ;

CREATE TABLE IF NOT EXISTS tbl_logs (
    logsID INT PRIMARY KEY AUTO_INCREMENT,
    horodatage DATETIME NOT NULL,
    addr_ip VARCHAR(15) NOT NULL,
    user_agent VARCHAR(255) NOT NULL,
    actionid_fk INT NOT NULL,
    FOREIGN KEY (actionid_fk) REFERENCES tbl_actions (id_action)
) ;

INSERT INTO tbl_actions(titre_action) VALUES("Installation du site Internet"),("Tentative échouée de connexion"),("Connexion au Panel Réussis"), ("Visite de la page"),("Mise a jour du profil utilisateur"), ("Changement de la photo de profil"), ("Mise a jour du contene statique") ;

CREATE TABLE IF NOT EXISTS tbl_careers (
    careerID INT PRIMARY KEY AUTO_INCREMENT,
    typeOfCareer VARCHAR(50) NOT NULL, 
    titleOfEvent VARCHAR(50) NOT NULL,
    eventTextPath VARCHAR(255) NOT NULL,
    ImagesPath VARCHAR(255) NOT NULL,
    fk_logsID INT,
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID)
) ;

CREATE TABLE IF NOT EXISTS tbl_articles (
    articleID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    publicationDate DATETIME,
    imagesPath VARCHAR(255) NOT NULL,
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
    FOREIGN KEY (fk_logsID) REFERENCES tbl_logs (logsID),
    FOREIGN KEY (fk_careerID) REFERENCES tbl_careers (careerID),
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


-- Insert default values 
INSERT INTO tbl_owner(lastName, surName, nameOfWebsite, websiteSubtitble) VALUES ("LASTNAME", "FIRSTNAME", "PORTFOLIO OF LASTNAME FIRSTNAME","SUBTITLE");

