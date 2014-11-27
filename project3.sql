SET FOREIGN_KEY_CHECKS=0;

drop table if exists Item;
 create table Item
	(upc int not null PRIMARY KEY,
	title varchar(30),
	type char(3) null,
	category char(12) null,
	company char(40) null,
	year int null,
	price float null,
	stock int null,
	CHECK (category='rock' OR category='pop' OR category='rap' OR category='country'
	OR category='classical' OR category='new age' OR category='instrumental'),
	CHECK (type='cd' OR type='dvd'));

drop table if exists LeadSinger; 
create table LeadSinger
	(upc int not null,
    FOREIGN KEY (upc) REFERENCES Item(upc),
	name varchar(30) not null PRIMARY KEY);

drop table if exists HasSong;
create table HasSong
	(upc int not null, 
    FOREIGN KEY (upc) REFERENCES Item(upc),
	title varchar(30) not null PRIMARY KEY);

drop table if exists Customer;
create table Customer
	(cid int not null PRIMARY KEY,
	password varchar(20),
	name char(20) null,
	address varchar(40) null,
	phone char(10) null);

drop table if exists Orderr;
create table Orderr
	(receiptId int not null PRIMARY KEY AUTO_INCREMENT,
	date date null,
	cid int null,
    FOREIGN KEY (cid) REFERENCES Customer(cid),
	card int null,
	expiryDate date null,
	expectedDate date null,
	deliveredDate date null);

drop table if exists PurchaseItem;
create table PurchaseItem
	(receiptId int not null,
    FOREIGN KEY (receiptId) REFERENCES Orderr(receiptId),
	upc int not null,
    FOREIGN KEY (upc) REFERENCES Item(upc),
	quantity int null);

drop table if exists Returnn;
create table Returnn
	(retid int not null PRIMARY KEY,
	date date null,
	receiptId int null,
    FOREIGN KEY (receiptId) REFERENCES Orderr(receiptId));
 
drop table if exists ReturnItem;
create table ReturnItem
	(retid int not null,
    FOREIGN KEY (retid) REFERENCES Returnn(retid),
	upc int not null,
    FOREIGN KEY (upc) REFERENCES Item(upc),
	quantity int null);
 

insert into Item
values('468791534', 'CeeLos Greatest Hits', 'cd', 'pop', 'Brick Records', '2012', '19.99', '10');

insert into Item
values('981564587', '1989', 'cd', 'pop', 'Universal Music Group', '2014', '19.99', '15');
 
insert into Item
values('485465791', 'Reclassified', 'cd', 'rap', 'Sony Media', '2013', '22.50', '10');

insert into Item
values('234511256', 'The London Sessions', 'cd', 'classical', 'Sony Media', '2013', '18.99', '10');

insert into Item
values('894516725', 'Live in Dublin', 'cd', 'instrumental', 'Brick Records', '2012', '19.99', '10');

insert into Item
values('871546565', 'BobMarley', 'cd', 'new age', 'Universal Music Group', '2001', '15.99', '10');
 
insert into Item
values('897451462', 'Slaves to the Grave', 'cd', 'rock', 'Sony Media', '2015', '17.99', '10');

insert into Item
values('796451235', 'Atonement', 'dvd', 'null', 'NewAge Media', '2005', '15.98', '10');

insert into Item
values('751365214', 'Finding Nemo', 'dvd', 'null', 'Disney', '2004', '9.99', '10');

insert into Item
values('152435278', 'Perks of Being a Wallflower', 'dvd', 'null', 'NewAge Media', '2011', '21.99', '10');

insert into Item
values('825421367', 'The Lego Movie', 'dvd', 'null', 'NewAge Media', '2014', '22.99', '10');

insert into Item
values('645512356', 'Aladdin', 'dvd', 'null', 'Disney', '1992', '12.99', '10');

insert into Item
values('486719375', 'Shrek 2', 'dvd', 'null', 'Sony Media', '2004', '13.99', '10');

insert into Item
values('572635485', 'Children of Men', 'dvd', 'null', 'NewAge Media', '2012', '19.99', '10');
 
insert into Item
values('475629387', 'Unideal Ape', 'cd', 'rap', 'Universal Music Group', '2003', '14.99', '10');
 
insert into Item
values('485726399', 'The Dark Knight', 'dvd', 'null', 'Warner Bros.', '2008', '16.99', '10');
 
insert into Item
values('295734573', 'Set You Free', 'cd', 'country', 'Universal Music Group', '2013', '13.99', '10');
 
insert into Item
values('049581783', 'Mamma Mia!', 'dvd', 'null', 'Warner Bros.', '2009', '14.99', '10');


insert into LeadSinger
values('468791534', 'Cee Lo Green');

insert into LeadSinger
values('981564587', 'Taylor Swift');
 
insert into LeadSinger
values('485465791', 'Iggy Azaelea');

insert into LeadSinger
values('234511256', 'Brian Larson');

insert into LeadSinger
values('894516725', 'Chris Paine');

insert into LeadSinger
values('871546565', 'Bob Marley');
 
insert into LeadSinger
values('897451462', 'Ten Degrees of Boredom');
 
insert into LeadSinger
values('475629387', 'The Raw Suckers');
 
insert into LeadSinger
values('295734573', 'Kevin Hardy');


insert into HasSong
values('468791534', 'Forget You');

insert into HasSong
values('468791534', 'If Only');

insert into HasSong
values('468791534', 'Bawse');

insert into HasSong
values('468791534', 'Crazy');

insert into HasSong
values('981564587', 'Shake It Off');

insert into HasSong
values('981564587', 'Blank Space');

insert into HasSong
values('981564587', 'New You Were Trouble');

insert into HasSong
values('981564587', 'Basic Girls');

insert into HasSong
values('485465791', 'Fancy');

insert into HasSong
values('485465791', 'Three Dumb Things');

insert into HasSong
values('485465791', 'Iggy Eh');

insert into HasSong
values('234511256', 'Who Cares');

insert into HasSong
values('234511256', 'House Not Building');

insert into HasSong
values('234511256', 'Crew');

insert into HasSong
values('234511256', 'Gotcha Back');

insert into HasSong
values('894516725', 'What If You And I');

insert into HasSong
values('894516725', 'Honey Baby');

insert into HasSong
values('894516725', 'Crooning For Ya');

insert into HasSong
values('871546565', 'No Woman, No Cry');

insert into HasSong
values('871546565', 'Redemption Song');

insert into HasSong
values('871546565', 'Three Little Birds');

insert into HasSong
values('871546565', 'Stir It Up');
 
insert into HasSong
values('897451462', 'Hatred of the Devil');

insert into HasSong
values('897451462', 'Revenge of Kosta');

insert into HasSong
values('897451462', 'Korra the Brave');

insert into HasSong
values('897451462', 'Cracked Glasses');

insert into HasSong
values('475629387', 'Blame the Socialists');

insert into HasSong
values('475629387', 'Yeah');

insert into HasSong
values('475629387', 'Sucking');

insert into HasSong
values('475629387', 'BAM');
 
insert into HasSong
values('295734573', 'Nobody Like You');

insert into HasSong
values('295734573', 'Hard Hitting');

insert into HasSong
values('295734573', 'Push Shove Pull');

commit;


/* SQL templates for select, insert, delete.

SELECT ...
FROM ...
WHERE ...

// insert only used for new customers
INSERT INTO ...
VALUES ...

DELETE FROM ...
WHERE ...

*/