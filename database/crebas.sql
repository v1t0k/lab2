/*==============================================================*/
/* DBMS name:      PostgreSQL 9.x                               */
/* Created on:     31.03.2020 17:29:32                          */
/*==============================================================*/


drop index "Photos-Comments_FK";

drop index "User-Comments_FK";

drop index Comments_PK;

drop table Comments;

drop index "Users-Photos_FK";

drop index Photos_PK;

drop table Photos;

drop index "Users-Ratings_FK";

drop index "Photos-Retings_FK";

drop index Ratings_PK;

drop table Ratings;

drop index Users_PK;

drop table Users;

/*==============================================================*/
/* Table: Comments                                              */
/*==============================================================*/
create table Comments (
   Comment_id           SERIAL               not null,
   Login                VARCHAR(500)         not null,
   Photo_id             INT4                 not null,
   Comment_text         TEXT                 not null,
   constraint PK_COMMENTS primary key (Comment_id)
);

/*==============================================================*/
/* Index: Comments_PK                                           */
/*==============================================================*/
create unique index Comments_PK on Comments (
Comment_id
);

/*==============================================================*/
/* Index: "User-Comments_FK"                                    */
/*==============================================================*/
create  index "User-Comments_FK" on Comments (
Login
);

/*==============================================================*/
/* Index: "Photos-Comments_FK"                                  */
/*==============================================================*/
create  index "Photos-Comments_FK" on Comments (
Photo_id
);

/*==============================================================*/
/* Table: Photos                                                */
/*==============================================================*/
create table Photos (
   Photo_id             SERIAL               not null,
   Login                VARCHAR(500)         not null,
   Photo_way            VARCHAR(500)         not null,
   constraint PK_PHOTOS primary key (Photo_id)
);

/*==============================================================*/
/* Index: Photos_PK                                             */
/*==============================================================*/
create unique index Photos_PK on Photos (
Photo_id
);

/*==============================================================*/
/* Index: "Users-Photos_FK"                                     */
/*==============================================================*/
create  index "Users-Photos_FK" on Photos (
Login
);

/*==============================================================*/
/* Table: Ratings                                               */
/*==============================================================*/
create table Ratings (
   Rating_id            SERIAL               not null,
   Login                VARCHAR(500)         not null,
   Photo_id             INT4                 not null,
   Rating_point         INT4                 not null,
   constraint PK_RATINGS primary key (Rating_id)
);

/*==============================================================*/
/* Index: Ratings_PK                                            */
/*==============================================================*/
create unique index Ratings_PK on Ratings (
Rating_id
);

/*==============================================================*/
/* Index: "Photos-Retings_FK"                                   */
/*==============================================================*/
create  index "Photos-Retings_FK" on Ratings (
Photo_id
);

/*==============================================================*/
/* Index: "Users-Ratings_FK"                                    */
/*==============================================================*/
create  index "Users-Ratings_FK" on Ratings (
Login
);

/*==============================================================*/
/* Table: Users                                                 */
/*==============================================================*/
create table Users (
   Name                 VARCHAR(500)         not null,
   Login                VARCHAR(500)         not null,
   Password             VARCHAR(500)         not null,
   Email                VARCHAR(500)         not null,
   constraint PK_USERS primary key (Login)
);

/*==============================================================*/
/* Index: Users_PK                                              */
/*==============================================================*/
create unique index Users_PK on Users (
Login
);

alter table Comments
   add constraint "FK_COMMENTS_PHOTOS-CO_PHOTOS" foreign key (Photo_id)
      references Photos (Photo_id)
      on delete restrict on update restrict;

alter table Comments
   add constraint "FK_COMMENTS_USER-COMM_USERS" foreign key (Login)
      references Users (Login)
      on delete restrict on update restrict;

alter table Photos
   add constraint "FK_PHOTOS_USERS-PHO_USERS" foreign key (Login)
      references Users (Login)
      on delete restrict on update restrict;

alter table Ratings
   add constraint "FK_RATINGS_PHOTOS-RE_PHOTOS" foreign key (Photo_id)
      references Photos (Photo_id)
      on delete restrict on update restrict;

alter table Ratings
   add constraint "FK_RATINGS_USERS-RAT_USERS" foreign key (Login)
      references Users (Login)
      on delete restrict on update restrict;

