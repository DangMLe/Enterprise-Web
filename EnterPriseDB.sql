use master
drop database Enterprise
create database Enterprise
use Enterprise
go
create table Roles (
	RoleID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	RoleName varchar(20) NOT NULL
);
create table Genders (
	GenderID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	GenderName varchar(20) NOT NULL
);
create table Departments(
	DepartmentID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	DepartmentName varchar(20)
);
Create table Users (
	UserID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	UserName varchar(50) NOT NULL,
	UserPassword varchar(50) NOT NULL,
	RoleID int NOT NULL FOREIGN KEY REFERENCES Roles(RoleID),
	UserGender int NOT NULL FOREIGN KEY REFERENCES Genders(GenderID),
	UserAge int,
	UserBday date,
	UserEmail varchar(30) NOT NULL,
	DepartmentID int FOREIGN KEY REFERENCES Departments(DepartmentID)
);
create table FileTypes(
	FileTypeID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	FileType varchar(10)
);
Create table Sections(
	SectionID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	SectionName varchar(20),
	DateStart date Not Null,
	DateEnd date,
	DateEnd2 date
);
Create table Submition(
	SubmitID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	SectionID int FOREIGN KEY REFERENCES Sections(SectionID),
	UserID int NOT NULL FOREIGN KEY REFERENCES Users(UserID)
);
Create table SubmitFiles (
	FileID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	FileTypeID int NOT NULL FOREIGN KEY REFERENCES FileTypes(FileTypeID),
	SubmitID int NOT NULL FOREIGN KEY REFERENCES Submition(SubmitID),
	FilePath text
);


Create table NotificationLogs (
	NLID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	NLDate Date NOT NULL,
	UserFromID int NOT NULL FOREIGN KEY REFERENCES Users(UserID),
	UserToID int NOT NULL FOREIGN KEY REFERENCES Users(UserID),
	SubmitID int NOT NULL FOREIGN KEY REFERENCES Submition(SubmitID),
	Content text
);
Create table Comments (
	CommentID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	SubmitID int NOT NULL FOREIGN KEY REFERENCES Submition(SubmitID),
	Comment text
);
