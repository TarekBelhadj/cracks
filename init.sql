
create table users(
id integer not null primary key autoincrement,
login varchar(200) not null unique,
pwd varchar(200) not null,
isadmin boolean not null default 0
);

create table cracks(
id integer not null primary key autoincrement,
content text not null,
owner int not null,
datesend int not null
);

create table votes(
crack integer not null,
voter integer not null,
val integer not null
);

insert into users (login, pwd, isadmin)
values('admin', '21232f297a57a5a743894a0e4a801fc3', 1);
