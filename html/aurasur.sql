/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     04/06/2015 10:53:45                          */
/*==============================================================*/


drop table if exists categories;

drop table if exists category;

drop table if exists gallery;

drop table if exists race;

drop table if exists racer;

drop table if exists sport;

drop table if exists user;

/*==============================================================*/
/* Table: categories                                            */
/*==============================================================*/
create table categories
(
   category_id          int not null,
   race_id              int not null,
   primary key (category_id, race_id)
);

/*==============================================================*/
/* Table: category                                              */
/*==============================================================*/
create table category
(
   id                   int not null auto_increment,
   name                 varchar(40) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: gallery                                               */
/*==============================================================*/
create table gallery
(
   id                   int not null auto_increment,
   race_id              int not null,
   picture              varchar(255) not null,
   primary key (id)
);

/*==============================================================*/
/* Table: race                                                  */
/*==============================================================*/
create table race
(
   id                   int not null auto_increment,
   sport_id             int not null,
   name                 varchar(100) not null,
   place                varchar(100) not null,
   date                 datetime not null,
   cost                 float(8,2) not null,
   description          text not null,
   attachment1          varchar(255),
   attachment2          varchar(255),
   picture              varchar(255) not null,
   status               enum('PENDING','FINISHED','INACTIVE') not null,
   creation_date        datetime not null,
   primary key (id)
);

/*==============================================================*/
/* Table: racer                                                 */
/*==============================================================*/
create table racer
(
   id                   int not null auto_increment,
   category_id          int not null,
   race_id              int not null,
   user_id              int not null,
   position_category    bigint,
   position_general     bigint not null,
   time1                time not null,
   time2                time,
   creation_date        datetime not null,
   primary key (id)
);

/*==============================================================*/
/* Table: sport                                                 */
/*==============================================================*/
create table sport
(
   id                   int not null auto_increment,
   name                 varchar(30) not null,
   picture              varchar(255) not null,
   status               enum('ACTIVE','INACTIVE') not null,
   primary key (id)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   id                   int not null auto_increment,
   name                 varchar(60) not null,
   lastname             varchar(60) not null,
   email                varchar(255) not null,
   sex                  enum('MALE','FEMALE') not null,
   birthdate            date not null,
   identity             varchar(15) not null,
   cellphone            varchar(10) not null,
   address              varchar(255) not null,
   size                 enum('XS','S','M','L','XL') not null,
   password             varchar(25) not null,
   contact_name         varchar(60),
   contact_phone        varchar(10),
   insurance            varchar(50),
   policy               varchar(30),
   blood_type           varchar(4),
   medical_history      varchar(255),
   recent_injuries      varchar(200),
   surgeries            varchar(200),
   allergies            varchar(200),
   status               enum('ACTIVE','INACTIVE') not null,
   creation_date        datetime not null,
   primary key (id)
);

alter table categories add constraint fk_categories foreign key (category_id)
      references category (id) on delete restrict on update restrict;

alter table categories add constraint fk_categories2 foreign key (race_id)
      references race (id) on delete restrict on update restrict;

alter table gallery add constraint fk_pictures foreign key (race_id)
      references race (id) on delete restrict on update restrict;

alter table race add constraint fk_has_many foreign key (sport_id)
      references sport (id) on delete restrict on update restrict;

alter table racer add constraint fk_category_race foreign key (category_id)
      references category (id) on delete restrict on update restrict;

alter table racer add constraint fk_race_inscribed foreign key (race_id)
      references race (id) on delete restrict on update restrict;

alter table racer add constraint fk_user_races foreign key (user_id)
      references user (id) on delete restrict on update restrict;

