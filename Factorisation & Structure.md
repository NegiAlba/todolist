# Factorisation d'un projet procédural

La factorisation d'un projet procédural passe par plusieurs réflexions et pose la question de l'abstraction de notre code. Factoriser ne va pas simplement abréger les noms des variables et autres parties superflues, mais va accorder une importance particulère à l'abstraction et le fait de rendr ele cocde "générique".

## Qu'est-ce que l'abstraction ?

Rendre abstrait notre code signifie que l'on va le modifier de façon a ce qu'il soit agnostique du contexte (tant que possible). C'est une démarche qui vise à rendre chaque partie du code réutilisable et exportable d'un projet à un autre.
Pour le rendre abstrait il faudra supprimer toutes les valeurs en "dur" et les remplacer par leurs références. Toutes les valeurs en "dur" qui ont une raison d'exister seront à la place des constantes.

## Comment faire ?

Il faut se poser la question de structuration.
Si l'on veut factoriser il faut "nettoyer" le code en profondeur et cela passe par la structuration.

** Il n'y a pas qu'une seule façon de faire ** et par conséquent je préfère proposer une liste de recommendations.

### Structuration

Pour structurer votre projet, je recommande l'approche du projet dans un dossier à la racine (dans un dossier app/ par exemple). 

- Dossier app/ à la racine du projet : Va nous permettre de gérer des données importantes qui ne doivent pas être partagé côté client (les variables d'environnement par exemple).

- Dossier séparé pour le code source, et un fichier public pour les fichiers servis (src/ et public/) : C'est notamment le cas pour le CSS et le JS que vous compilerez/minifierez souvent et qui peuvent avoir un écart de taille non négligeables. La compilation aura aussi tendance à rendre le code moins **verbose** au niveau du client. N'oubliez pas : *Moins le client en sait, et mieux tout le monde se porte*.

- Séparer la logique et l'affichage : Beaucoup d'approches considèrent cet aspect/ Il vaut mieux avoir 4 fichiers php avec des **requires** qu'un seul avec un bloc de code incassable (et intimidant). Par conséquent on va s'atteler à séparer les inputs et leur processing.

- Créez (ou copiez) une connexion à la base de données générique qui soit dépendante de constantes définies à la racine du serveur/projet. Cet étape va de soi : Le but est de ne pas avoir à refaire une nouvelle connexion à chaque fois et à la place exporter une ancienne.

Il existe d'autres recommendations mais elles ne s'appliqueront pas à votre champ d'action pour le moment, donc il conviendra d'en discuter plus tard.

De notre côté la factorisation et structuration aura entrâiné certaines modifications :

- Dossier app/ à la racine du projet : ** C'était déja le cas**

- Dossier séparé pour le code source, et un fichier public pour les fichiers servis (src/ et public/) : **Pas le cas ici, donc pas besoin**

- Séparer la logique et l'affichage : Nous avons profité pour séparer la logique et l'affichage a de nombreuses reprises. Cela a aussi valu de séparer la config et le header.
    - **Déplacer le fichier d'import des variables d'environnement depuis le header jusqu'à la config**
    - **Création de fichier $$$$_post aux fichier où il y avait des données postées afin de déplacer la logique de requêtes post dans un fichier à part** : Le processing prend une place importante du code pour au final ne pas avoir beaucoup de lien avec l'affichage

- Créez (ou copiez) une connexion à la base de données générique qui soit dépendante de constantes définies à la racine du serveur/projet. : **C'était déja le cas ici** 


