# TP3 Architecture MVC

## Architecture MVC – Administrateur - Client

### Les objectifs du TP3
- Ajouter les tables /champs nécessaires dans votre base de données pour pouvoir gérer les utilisateurs.
- Les mots de passe doivent être chiffrés.
- Créer une session sécurisée pour les clients et les administrateurs.
- Gérer les privilèges d'accès aux pages
- L'administrateur doit pouvoir ajouter du contenu au site à l'aide de l'interface.
- Gérer la connexion de l'utilisateur, le journal de bord, avec l'adresse IP, la date, le nom d'utilisateur (si l'utilisateur est connecté, sinon s'inscrire en tant que visiteur) et la page visitée.
- Le journal de bord doit être accessible à partir du menu de navigation de votre site.

#### Description du projet 
Le projet utilise une base de données tp2_mvc avec plusieurs tables principales :

artists : Contient des informations sur les artistes (ID, nom, biographie).

artworks : Contient les œuvres d'art (ID, titre, description, ID de l'artiste, ID de la catégorie, et une image associée).

exhibitions : Enregistre les expositions des œuvres (ID, nom de l'exposition, date, ID de l'artiste).

categories : Liste les catégories d'art (ex. Impressionnisme, Renaissance, Cubisme, etc.).
La table artworks est liée aux autres tables par des clés étrangères (artists_id, category_id).

users : Gère les informations des utilisateurs.
        Colonnes : id, name, username, password (chiffré), email, privilege_id (clé étrangère).
        Relations : Liée à la table privilege via privilege_id.

privilege : Définit les privilèges des utilisateurs.
            Colonnes : id.

logs :  Journal de bord enregistrant les visites du site.
        Colonnes : id, user_id (clé étrangère), username (par défaut "Visitor"), ip_address, visited_page, visit_date.
        Relations : Liée à la table users via user_id.


Nom d'utilsateur : test@gmail.com
Mot de passe : test1234

- Auteur : Pamela Limoges
- GitHub : https://github.com/PamelaL17/TP3_MVC
- Adresse URL du site sur WebDev : https://e2495515.webdev.cmaisonneuve.qc.ca/TP3_MVC/login
