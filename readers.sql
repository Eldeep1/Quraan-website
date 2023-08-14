CREATE DATABASE IF NOT EXISTS `quran` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quran`;
drop table IF EXISTS Readers;
create table Readers(
ID int NOT NULL auto_increment,
`name` text NOT NULL , 
primary key(ID) 
);
insert into Readers (name) values("عبد الرحمن السديس");
insert into Readers (name) values("سعود الشريم");
insert into Readers (name) values("ماهر المعيقلي");
insert into Readers (name) values("عبد الله عواد الجهني");
insert into Readers (name) values("علي جابر");
insert into Readers (name) values("عبد الباسط عبد الصمد");
insert into Readers (name) values("الحصري");
select name from readers;

create table quotes(
`index` int auto_increment NOT NULL,
quote_text text,
primary key(`index`)
);
select * from quotes;
select quote_text from quotes where `index`=1;
SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = 'quran' AND table_name = 'quotes'
SELECT COUNT(*)  as rownum FROM quotes;

insert into