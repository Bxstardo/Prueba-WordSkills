create database Room_911;
use Room_911;

create table Users
(
Id int primary key,
FirstName varchar(30),
LastName varchar(30),
Access varchar(4),
Rol varchar(15),
StatusUser varchar(15),
PasswordUser varchar(60),
DepartmentId int
);

create table LogAccess
(
Id int primary key auto_increment,
AccessDate date,
Access tinyint,
UserId int
);

create table Departments
(
Id int primary key auto_increment,
Department varchar(20)
);


alter table LogAccess add
Constraint FK_LogAccess_Users
Foreign key (UserId)
References Users(Id);

alter table Users add
Constraint FK_Users_Departments
Foreign key (DepartmentId)
References Departments(Id);

-- Administrativo / Usuario : 12345 , Contraseña : 12345
insert into users values(12345,"Brayan","Martinez Ayala", "on","Administrator","Active",12345,null);

insert into Departments values (null,"Production");
insert into Departments values (null,"Tests");



SELECT * FROM Users where Rol = 'Emplooye'
