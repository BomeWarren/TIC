                                 Cahier des Charges Réseau Social (Tech)

1. Présentation du projet
 Le projet consiste à concevoir et développer un réseau social thématique dédié au domaine de la technologie. Cette plateforme permettra aux utilisateurs de partager des informations, articles, tutoriels et discussions autour des innovations technologiques, du développement web, mobile, de l’intelligence artificielle, du cloud et d’autres sujets connexes.
Objectifs :
- Favoriser l’échange de connaissances entre passionnés de technologie.                                 	           - Créer une communauté dynamique autour de thèmes tech.					           - Offrir une expérience fluide et moderne, avec messagerie, likes, commentaires et notifications

2. Public cible
 Le réseau s’adresse à :                                                                                                                                            - Développeurs web et mobile                                                                                                                               - Étudiants en informatique                                                                                                                                     - Passionnés de nouvelles technologies                                                                                                                 - Startups et professionnels du numérique

3. Fonctionnalités principales 
1. Authentification et profils utilisateurs : création de compte, connexion, gestion du profil (photo, bio, spécialité).                                                                                                                                                         2. Publications : texte, images, vidéos, tutoriels ou articles partagés par les utilisateurs.                         3. Commentaires et likes : interaction sociale classique pour réagir aux publications.                              4. Messagerie instantanée : communication directe entre membres, notifications en temps réel. 

4. Contraintes techniques 

Élément	Technologie
Frontend	React + Tailwind CSS
Backend	Node.js (Express.js)
Base de données	PostgreSQL
ORM	Prisma
Authentification	JWT (JSON Web Token)
Messagerie temps réel 	Socket.IO
Stockage des fichiers	AWS S3 / équivalent
Hébergement	Docker + Vercel / Render

6. Livrables
 1. Cahier des charges détaillé (présent document).                                                                                            2. Maquettes UX/UI (Figma ou équivalent).                                                                                                       3. Modélisation de la base de données (MCD & MLD).                                                                                   4. Code source complet (frontend + backend).                                                                                                  5. Documentation technique et guide d’installation.

7. Conclusion 
Ce réseau social technologique vise à fédérer une communauté autour du partage et de l’innovation. Son architecture full-stack moderne permettra une évolutivité et une expérience fluide pour les utilisateurs passionnés de tech.

--------------------------------------------------------Modélisation---
model Utilisateur {
  id              Int       @id @default(autoincrement())
  nom             String
  prenom          String
  email           String    @unique
  motDePasse      String
  photoProfil     String?
  bio             String?
  specialite      String?
  dateInscription DateTime  @default(now())
  publications    Publication[]
  commentaires    Commentaire[]
  likes           Like[]
  messagesEnvoyes Message[] @relation("MessagesEnvoyes")
  messagesRecus   Message[] @relation("MessagesRecus")
  notifications   Notification[]
}

model Publication {
  id              Int          @id @default(autoincrement())
  contenuTexte    String?
  imageURL        String?
  videoURL        String?
  type            String
  datePublication DateTime     @default(now())
  auteur          Utilisateur  @relation(fields: [idAuteur], references: [id])
  idAuteur        Int
  commentaires    Commentaire[]
  likes           Like[]
  fichiers        Fichier[]
}

model Commentaire {
  id              Int         @id @default(autoincrement())
  contenu         String
  dateCommentaire DateTime    @default(now())
  auteur          Utilisateur @relation(fields: [idAuteur], references: [id])
  idAuteur        Int
  publication     Publication @relation(fields: [idPublication], references: [id])
  idPublication   Int
}

model Like {
  id            Int         @id @default(autoincrement())
  utilisateur   Utilisateur @relation(fields: [idUtilisateur], references: [id])
  idUtilisateur Int
  publication   Publication @relation(fields: [idPublication], references: [id])
  idPublication Int
}

model Message {
  id             Int         @id @default(autoincrement())
  contenu        String
  dateEnvoi      DateTime    @default(now())
  expediteur     Utilisateur @relation("MessagesEnvoyes", fields: [idExpediteur], references: [id])
  idExpediteur   Int
  destinataire   Utilisateur @relation("MessagesRecus", fields: [idDestinataire], references: [id])
  idDestinataire Int
}

model Notification {
  id              Int         @id @default(autoincrement())
  type            String
  contenu         String
  estLue          Boolean     @default(false)
  dateNotification DateTime  @default(now())
  utilisateur     Utilisateur @relation(fields: [idUtilisateur], references: [id])
  idUtilisateur   Int
}

model Fichier {
  id            Int         @id @default(autoincrement())
  url           String
  type          String
  publication   Publication @relation(fields: [idPublication], references: [id])
  idPublication Int
}







