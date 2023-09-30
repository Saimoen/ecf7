CREATE DATABASE webappsaler;

use webappsaler;

create table application
(
    id        int auto_increment
        primary key,
    nom       varchar(45) null,
    modules   int         null,
    id_client int         null
)
    engine = InnoDB;

create index application_application_id_fk
    on application (modules);

create index id_client
    on application (id_client);

create index index_idApplication
    on application (id);

create table client
(
    id             int auto_increment
        primary key,
    raison_sociale varchar(50) not null,
    ridet          varchar(10) not null,
    ss2i           tinyint(1)  null
)
    engine = InnoDB;

create table collaborateur
(
    id                int auto_increment
        primary key,
    nom               varchar(45)          null,
    prenom            varchar(45)          null,
    niveau_competence enum ('1', '2', '3') null,
    prime_embauche    varchar(45)          null
)
    engine = InnoDB;

create table chefdeprojet
(
    id               int auto_increment
        primary key,
    boost_production int null,
    id_collaborateur int null,
    constraint chefdeprojet_collaborateur_id_fk
        foreign key (id_collaborateur) references collaborateur (id)
)
    engine = InnoDB;

create index index_chefdeprojet
    on chefdeprojet (id);

create index index_idEquipe
    on chefdeprojet (id_collaborateur);

create index index_id_chef_de_projet
    on chefdeprojet (id);

create index index_id_collaborateur
    on collaborateur (id);

create table developpeur
(
    id                int auto_increment
        primary key,
    competence        enum ('1', '2', '3') null,
    indice_production int                  null,
    composants        varchar(45)          null,
    modules           varchar(45)          null,
    applications      varchar(45)          null,
    id_collaborateur  int                  null,
    constraint iddeveloppeur_UNIQUE
        unique (id),
    constraint developpeur_collaborateur_id_fk
        foreign key (id_collaborateur) references collaborateur (id)
)
    engine = InnoDB;

create table equipe
(
    idChef  int         null,
    id      int auto_increment
        primary key,
    libelle varchar(45) null,
    constraint equipe_chefdeprojet_id_fk
        foreign key (idChef) references chefdeprojet (id)
)
    engine = InnoDB;

create table equipe_members
(
    id             int auto_increment
        primary key,
    id_equipe      int null,
    id_developpeur int null,
    constraint equipe_members_developpeur_id_fk
        foreign key (id_developpeur) references developpeur (id),
    constraint equipe_members_equipes__fk
        foreign key (id_equipe) references equipe (id)
)
    engine = InnoDB;

create index id_developpeur
    on equipe_members (id_developpeur);

create index id_equipe
    on equipe_members (id_equipe);

create table module
(
    id             int auto_increment
        primary key,
    libelle        varchar(45) null,
    composants     int         null,
    id_application int         null,
    constraint module_application_id_fk
        foreign key (id_application) references application (id)
)
    engine = InnoDB;

create table composant
(
    id          int auto_increment
        primary key,
    id_module   int                  null,
    libelle     varchar(25)          null,
    charge      int                  null,
    progression int                  null,
    type        enum ('1', '2', '3') null,
    constraint composant_module_id_fk
        foreign key (id_module) references module (id)
)
    engine = InnoDB;

create index index_id_module
    on composant (id_module);

create index index_idModule
    on module (id);

create index index_id_du_module
    on module (id);

create index index_id_module
    on module (id);

create index index_module_composants
    on module (composants);

create table projet
(
    id                int auto_increment
        primary key,
    id_developpeur    int                                        null,
    id_application    int                                        null,
    id_module         int                                        null,
    id_composant      int                                        null,
    id_chef_de_projet int                                        null,
    type              enum ('1', '2', '3')                       not null,
    id_client         int                                        not null,
    prix              int                                        not null,
    statut            enum ('0', '1', '2', '3', '4') default '0' not null,
    name              varchar(255)                               null
)
    engine = InnoDB;

create index projet_chefdeprojet_id_fk
    on projet (id_chef_de_projet);

create index projet_developpeur_id_fk
    on projet (id_developpeur);

