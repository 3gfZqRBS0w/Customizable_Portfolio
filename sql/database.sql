-- Création de la base de donnée du site web


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



INSERT INTO primaryData_tbl(lastName, surName, nameOfWebsite, websiteSubtitble, summaryPath,profilePath, libellePortrait, endTextPath ) VALUES ("LASTNAME", "FIRSTNAME", "PORTFOLIO OF LASTNAME FIRSTNAME","SUBTITLE", "markdown/default_summary.md", "images/default_portrait.png","markdown/libellePortrait.md","markdown/default_endtext.md"); 