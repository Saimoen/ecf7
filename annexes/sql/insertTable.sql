-- Active: 1690835284933@@127.0.0.1@3306@webappsaler
INSERT INTO application (nom, modules, id_client) VALUES
('App1', 2, 100),
('App2', 4, 101),
('App3', 1, 102),
('App4', 3, 103),
('App5', 2, 104),
('App6', 1, 105),
('App7', 3, 106),
('App8', 2, 107),
('App9', 4, 108),
('App10', 1, 109);

INSERT INTO client (raison_sociale, ridet, ss2i) VALUES
('Client A', '1234567890', 1),
('Client B', '9876543210', 0),
('Client C', '5678901234', 1),
('Client D', '0987654321', 0),
('Client E', '2345678901', 1),
('Client F', '5432109876', 0),
('Client G', '6789012345', 1),
('Client H', '0123456789', 0),
('Client I', '7890123456', 1),
('Client J', '3456789012', 0);

INSERT INTO collaborateur (nom, prenom, niveau_competence, prime_embauche) VALUES
('Smith', 'John', '3', '1000'),
('Johnson', 'Emma', '2', '800'),
('Brown', 'Michael', '3', '1100'),
('Lee', 'Sophia', '1', '600'),
('Miller', 'Daniel', '2', '850'),
('Wilson', 'Ava', '3', '1050'),
('Anderson', 'Oliver', '1', '550'),
('Taylor', 'Mia', '2', '900'),
('Thomas', 'Noah', '3', '1000'),
('Harris', 'Isabella', '1', '600');

INSERT INTO chefdeprojet (boost_production, id_collaborateur) VALUES
(5, 1),
(3, 3),
(2, 5),
(4, 7),
(6, 9),
(4, 2),
(3, 4),
(5, 6),
(2, 8),
(1, 10);

INSERT INTO developpeur (competence, indice_production, composants, modules, applications, id_collaborateur) VALUES
('3', 80, 'CompA, CompB', 'ModuleA', 'App1', 2),
('1', 60, 'CompC, CompD', 'ModuleB', 'App2', 4),
('2', 70, 'CompE, CompF', 'ModuleC', 'App3', 1),
('3', 85, 'CompG, CompH', 'ModuleD', 'App4', 3),
('2', 75, 'CompI, CompJ', 'ModuleE', 'App5', 2),
('1', 50, 'CompK, CompL', 'ModuleF', 'App6', 1),
('3', 80, 'CompM, CompN', 'ModuleG', 'App7', 3),
('2', 70, 'CompO, CompP', 'ModuleH', 'App8', 2),
('1', 65, 'CompQ, CompR', 'ModuleI', 'App9', 4),
('2', 75, 'CompS, CompT', 'ModuleJ', 'App10', 1);

INSERT INTO equipe (idChef, libelle) VALUES
(1, 'Equipe 1'),
(3, 'Equipe 2'),
(5, 'Equipe 3'),
(7, 'Equipe 4'),
(9, 'Equipe 5'),
(2, 'Equipe 6'),
(4, 'Equipe 7'),
(6, 'Equipe 8'),
(8, 'Equipe 9'),
(10, 'Equipe 10');

INSERT INTO equipe_members (id_equipe, id_developpeur) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

INSERT INTO module (libelle, composants, id_application) VALUES
('ModuleA', 5, 1),
('ModuleB', 3, 2),
('ModuleC', 2, 3),
('ModuleD', 4, 4),
('ModuleE', 3, 5),
('ModuleF', 6, 6),
('ModuleG', 4, 7),
('ModuleH', 2, 8),
('ModuleI', 3, 9),
('ModuleJ', 5, 10);

INSERT INTO composant (id_module, libelle, charge, progression, type) VALUES
(1, 'CompA', 80, 40, '1'),
(1, 'CompB', 50, 25, '2'),
(2, 'CompC', 70, 30, '3'),
(2, 'CompD', 60, 45, '1'),
(3, 'CompE', 85, 55, '2'),
(3, 'CompF', 90, 70, '3'),
(4, 'CompG', 75, 65, '1'),
(4, 'CompH', 80, 80, '2'),
(5, 'CompI', 95, 90, '3'),
(5, 'CompJ', 70, 60, '1');

INSERT INTO projet (id_developpeur, id_application, id_module, id_composant, id_chef_de_projet, type, id_client, prix, statut) VALUES
(1, 1, 1, 1, 1, '1', 100, 500, '2'),
(2, 2, 2, 2, 3, '2', 101, 700, '3'),
(3, 3, 3, 3, 5, '3', 102, 900, '4'),
(4, 4, 4, 4, 4, '1', 103, 600, '1'),
(5, 5, 5, 5, 5, '2', 104, 900, '2'),
(6, 6, 6, 6, 6, '3', 105, 1200, '3'),
(7, 7, 7, 7, 7, '1', 106, 700, '1'),
(8, 8, 8, 8, 8, '2', 107, 1000, '2'),
(9, 9, 9, 9, 9, '3', 108, 1500, '3'),
(10, 10, 10, 10, 10, '1', 109, 800, '1'),
(1, 1, 1, 1, 1, '2', 100, 1100, '2'),
(2, 2, 2, 2, 2, '3', 101, 1300, '3'),
(3, 3, 3, 3, 3, '1', 102, 900, '1');

