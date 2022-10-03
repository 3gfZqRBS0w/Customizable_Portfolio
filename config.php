<?php

// database configuration

$config["db"] = [
    "username" => "admin",
    "password" => "password",
    "bddName" => "customportfolio8",
    "host" => "127.0.0.1"
];

$config["stockage"] = [
    "maxProfileSize" => 500000,

];


// captcha configuration

$config["captcha"] = [
    "SECRET_KEY" => "6LefGvIhAAAAAB5gEFSRpx95F5mabhWQDpUtFRcw",
    "CLIENT_KEY" => "6LefGvIhAAAAAMLWdRYA-cnDH5EwF4Dksq1n05m0"
];


// password recovery and setup
$config["recuperation"] = [
    "email" => "lombres@lombres.fr",
];




/*
Full translation in progress 
*/
$config["translations"]["en"] = [
    "lastName" => "Last Name",
    "firstName" => "First Name",
    "latestProject" => "My Projects",
    "schoolCareer" => "My school career",
    "professionalExperience" => "My professional experiences",
    "skillAndQualification" => "My skills and qualifications",
    "submit" => "Submit",
    "email" => "E-mail Address",

    "pdoErrors" => [
        1045 => "<h1>Wrong username or password.</h1><p>To configure the access to the database go to config.php where the panel is located.</p>",
        1049 => "<h1>The database does not exist.</h1><p>It must be created for the system to fill it.</p>"
    ],
    "phpFileUploadErrors" => [
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ],

    "notification" => [
        "projectAdded" => "Ajout d'un project",
        "projectAlreadyExists" => "The project already exists",
        "limitFile" => "50MB max",
        "fileNotRecognized" => "File not recognized",
    ],

    "mail" => [
        "setup" => [
            "subject" => "The installation is a success",
            "message" => "You can now configure your portfolio by adding /mastermind to the url of your site. Your autogenerated secret code is :"
        ]
    ],

    "tab_logs" => [
        "timestamp" => "Timestamp",
        "userAgent" => "User Agent",
        "action" => "Action",
    ],

    "logs" => [
        1 => "Installation of the website",
        2 => "Failed connection attempt",
        3 => "Login to the Successful Panel",
        4 => "Visit the page",
        5 => "Update of the user profile",
        6 => "Change your profile picture",
        7 => "Update of the presentation",
        8 => "Add a project",
        9 => "Editing a project",
        10 => "Updated project",
        11 => "Project deleted",
        12 => "Mot de passe reset"
    ],
    "navBar" => [
        "return" => "return",
        // user navigation bar
        "presentation" => "Presentation",
        "myprojects" => "My Projects",
        "skills" => "My Skills",
        "article" => "My Articles",
        "contact" => "Contact",

        // admin navigation bar and dashboard
        "panel" => "Panel",
        "dashboard" => "Dashboard",
        "profile" => "Profile",
        "projects" => "Projects",
        "career" => "Career",
        "articles" => "Articles",
        "skills" => "Skills",
        "setting" => "Setting",
        "portfolio" => "Home",
        "disconnect" => "Log off"
    ],
    "admin" => [
        "adminArea" => "ADMIN AREA",
        "loginSubtitle" => "Login Page",
        "secretCode" => "Secret Code",
        "forgotPassword" => "Forgot Password",
    ],
    "dashboard" => [
        "visitor" => "Visitor",
        "projects" => "Projects",
        "career" => "Career",
        "articles" => "Articles",
        "websiteOverview" => "Website Overview",
        "latestLogs" => "Latest Logs",

        "changeProfile" => "Changing the profile image",
        "profileSettings" => "Profile Settings",
        "welcomeMessage" => "Welcome Message",
        "underImage" => " Under the image",
        "endMessage" => "End Message",
        "addProject" => "Add Project",
        "projectName" => "Project Name",
        "projectImage" => "Project Image",
        "chooseProject" => "Choose your Project",
        "panelSettings" => "Panel Settings",
        "nameWebsite" => "Name Of Website",
        "websiteSubtitle" => "Website Subtitle",
        "edit" => "Edit",
        "projectTitle" => "Project Title",
        "changeImageProject" => "Change Image of this project (it is optional)",
        "projectContent" => "Project Content",
        "cancel" => "Cancel",
        "delete" => "Delete",

    ]
];

$config["translations"]["fr"] = [
    "lastName" => "Nom de famille",
    "firstName" => "Prénom",
    "latestProject" => "Mes projets",
    "schoolCareer" => "Mes formations",
    "professionalExperience" => "Mes expériences professionnels",
    "skillAndQualification" => "Mes compétences et qualifications",
    "email" => "Adresse E-Mail",
    "submit" => "Soumettre",
    "pdoErrors" => [
        1045 => "<h1>Mauvais nom d'utilisateur ou mot de passe.</h1><p> Pour configurer l'accès à la base de donnée rendez vous dans config.php là ou se trouve le panel</p> ",
        1049 => "<h1>La base de donnée n'existe pas</h1><p>Il faut la crée pour que le site la remplisse</p>"
    ],

    "phpFileUploadErrors" => [
        0 => 'Le fichier a été télécharger avec succès',
        1 => 'Le fichier est trop lourd (php.ini)',
        2 => 'Le fichier est trop lourd (html)',
        3 => 'Le fichier téléchargé na été que partiellement téléchargé',
        4 => 'Aucun fichier na été téléchargé',
        6 => 'Il manque un dossier temporaire',
        7 => 'Échec de lécriture du fichier sur le disque.',
        8 => 'Une extension PHP a arrêté le téléchargement du fichier.',
    ],

    "notification" => [
        "projectAdded" => "Ajout d'un projet",
        "projectAlreadyExists" => "Le projet existe déjà ",
        "limitFile" => "50MB max",
        "fileNotRecognized" => "Fichier n'est pas reconnue",
    ],

    "mail" => [
        "setup" => [
            "subject" => "L'installation de votre Portfolio est un succès",
            "message" => " Vous pouvez maintenant configurer votre portfolio en accédant au panel par l'ajout de /mastermind a votre url.Le code auto-générer est :"
        ]
    ],
    "logs" => [
        1 => "Installation du site internet",
        2 => "Echec de la tentative de connexion",
        3 => "Réussite de la connexion",
        4 => "Consulte une page",
        5 => "Mise a jour du profil utilisateur",
        6 => "Modification de la photo de profil",
        7 => "Mise à jour du message de bienvenue",
        8 => "Ajout d'un nouveau projet",
        9 => "Edition d'un projet",
        10 => "Mise a jour d'un projet",
        11 => "Un projet a été supprimer",
        12 => "Mot de passe reset"
    ],
    "tab_logs" => [
        "timestamp" => "Horodatage",
        "userAgent" => "Agent de l'utilisateur",
        "action" => "Action",
    ],
    "navBar" => [
        "return" => "Retour",
        // user navigation bar
        "presentation" => "Présentation",
        "myprojects" => "Mes Projets",
        "skills" => "Mes Compétences",
        "article" => "Mes Articles",
        "contact" => "Me Contacter",

        // admin navigation bar and dashboard
        "panel" => "Administration",
        "dashboard" => "Tableau de bord",
        "profile" => "Profile",
        "projects" => "Projects",
        "career" => "Carrière",
        "articles" => "Articles",
        "skills" => "Compétences",
        "setting" => "Paramètres",
        "portfolio" => "Retour",
        "disconnect" => "Déconnexion"
    ],
    "admin" => [
        "adminArea" => "ZONE ADMIN",
        "loginSubtitle" => "Page de connexion",
        "secretCode" => "Code secret",
        "forgotPassword" => "Mot de passe oublié ?"
    ],

    "dashboard" => [
        "visitor" => "Visiteurs",
        "projects" => "Projets",
        "career" => "Carrières",
        "articles" => "Articles",

        "changeProfile" => "Changer la photo de profil",
        "latestLogs" => "Derniers journaux",

        "websiteOverview" => "Aperçu du site web",
        "profileSettings" => "Paramètres du profile",
        "welcomeMessage" => "Message de bienvenue",
        "underImage" => "en dessous de la photo de profil",
        "endMessage" => "Message de fin",
        "addProject" => "Ajouter un projet",
        "projectName" => "Nom du projet",
        "projectImage" => "image du projet",
        "chooseProject" => "Choisis ton projet",
        "panelSettings" => "Paramètre de l'administration",
        "nameWebsite" => "Nom du site",
        "websiteSubtitle" => "Sous-titre du site",
        "edit" => "Modifier",
        "projectTitle" => "Nom du projet",
        "changeImageProject" => "Changer l'image du projet (c'est pas obligatoire)",
        "projectContent" => "Contenue du projet",
        "cancel" => "Annuler",
        "delete" => "Supprimer",
        
    ]
];

/*

for the German language ( example )
$config["translations"]["de"] = [
    to be completed with same keys
];

or custom translations

$config["translations"]["custom"] = [
    to be completed with same keys
];
*/
$config["translations"]["selected"] = $config["translations"]["en"];
