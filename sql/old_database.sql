CREATE TABLE IF NOT EXISTS primaryData_tbl(
    -- Information sur l'administrateur
    lastName VARCHAR(255) NOT NULL,
    surName VARCHAR(255) NOT NULL,
    secretCode CHAR(255),
    -- Information de base pour l'accueil 
    nameOfWebsite VARCHAR(255) NOT NULL,
    websiteSubtitble VARCHAR(255) NOT NULL,
    libellePortrait VARCHAR(255) NOT NULL,
    summaryPath VARCHAR(255) NOT NULL,
    profilePath VARCHAR(255) NOT NULL,
    endTextPath VARCHAR(255) NOT NULL
);

 CREATE TABLE IF NOT EXISTS project_tbl(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    textPath VARCHAR(255) NOT NULL,
    folderOfImagePath VARCHAR(255) NOT NULL
);

 CREATE TABLE IF NOT EXISTS article_tbl(
    idOfArticle INT,
    title VARCHAR(255) NOT NULL,
    dateOfPublish DATE NOT NULL,
    articleTextPath VARCHAR(255) NOT NULL,
    folderOfImagePath VARCHAR(255) NOT NULL,
    FOREIGN KEY (idOfArticle) REFERENCES project_tbl(id)
);

CREATE TABLE IF NOT EXISTS career_tbl(
    idOfProject INT,
    typeOfCareer VARCHAR(255) NOT NULL,
    titleOfEvent VARCHAR(255) NOT NULL,
    eventTextPath VARCHAR(255) NOT NULL,
    startDateOfEvent DATE,
    endDateOfEvent DATE,
    FOREIGN KEY (idOfProject) REFERENCES project_tbl(id)
);

CREATE TABLE IF NOT EXISTS action_tbl (
    id_action INT NOT NULL AUTO_INCREMENT,
    titre_action VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_action)
) ;

CREATE TABLE IF NOT EXISTS contact_tbl (
    id_contact INT NOT NULL AUTO_INCREMENT,
    nomPrenom VARCHAR(255) NOT NULL,
    adresseMail VARCHAR(255) NOT NULL,
    num CHAR(10) NOT NULL,
    message TEXT,
)



CREATE TABLE IF NOT EXISTS logs_tbl (
    horodatage DATETIME,
    addr_ip VARCHAR(15),
    useragent VARCHAR(255),
    actionid_fk INT NOT NULL, 
    contactid_fk INT,
    FOREIGN KEY (actionid_fk) REFERENCES action_tbl (id_action),
    FOREIGN KEY (contactid_fk) REFERENCES contact_tbl (id_contact)
) ;


-- Insert default values 
INSERT INTO primaryData_tbl(lastName, surName, nameOfWebsite, websiteSubtitble, summaryPath,profilePath, libellePortrait, endTextPath ) VALUES ("LASTNAME", "FIRSTNAME", "PORTFOLIO OF LASTNAME FIRSTNAME","SUBTITLE", "markdown/default_summary.md", "images/default_portrait.png","markdown/libellePortrait.md","markdown/default_endtext.md");

INSERT INTO action_tbl(titre_action) VALUES("Installation du site Internet"),("Echec de connexion au Panel"),("Connexion au Panel Réussis"), ("Visite de la page") ;