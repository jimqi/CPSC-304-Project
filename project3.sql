SET FOREIGN_KEY_CHECKS=0;

drop table if exists Item;
 create table Item
	(upc int not null PRIMARY KEY,
	title varchar(20),
	type char(3) null,
	category char(12) null,
	company char(40) null,
	year int null,
	price float null,
	stock int null,
	-- CHECK (category='rock' OR category='pop' OR category='rap' OR category='country'
	-- OR category='classical' OR category='new age' OR category='instrumental'),
	CHECK (type='cd' OR type='dvd'));

drop table if exists LeadSinger; 
create table LeadSinger
	(upc int not null,
    FOREIGN KEY (upc) REFERENCES Item(upc),
	name varchar(20) not null PRIMARY KEY);

drop table if exists HasSong;
create table HasSong
	(upc int not null, 
    FOREIGN KEY (upc) REFERENCES Item(upc),
	title varchar(25) not null PRIMARY KEY);

drop table if exists Customer;
create table Customer
	(cid int not null PRIMARY KEY,
	password varchar(20),
	name char(20) null,
	address varchar(40) null,
	phone char(10) null);

drop table if exists Orderr;
create table Orderr
	(receiptId int not null PRIMARY KEY,
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
values('468791534685', 'CeeLos Greatest Hits', 'cd', 'pop', 'Brick Records', '2012', '19.99', '10');

insert into Item
values('981564587122', '1989', 'cd', 'pop', 'Universal Music Group', '2014', '19.99', '15');
 
insert into Item
values('485465791264', 'Reclassified', 'cd', 'rap', 'Sony Media', '2013', '22.50', '10');

insert into Item
values('234511256485', 'The London Sessions', 'cd', 'classical', 'Sony Media', '2013', '18.99', '10');

insert into Item
values('894516725312', 'Live in Dublin', 'cd', 'instrumental', 'Brick Records', '2012', '19.99', '10');

insert into Item
values('871546565123', 'BobMarley', 'cd', 'new age', 'Universal Music Group', '2001', '15.99', '10');
 
insert into Item
values('897451462354', 'Slaves to the Grave', 'cd', 'rock', 'Sony Media', '2015', '17.99', '10');

insert into Item
values('796451235124', 'Atonement', 'dvd', 'null', 'NewAge Media', '2005', '15.98', '10');

insert into Item
values('751365214893', 'Finding Nemo', 'dvd', 'null', 'Disney', '2004', '9.99', '10');

insert into Item
values('152435278659', 'Perks of Being a Wallflower', 'dvd', 'null', 'NewAge Media', '2011', '21.99', '10');

insert into Item
values('825421367542', 'The Lego Movie', 'dvd', 'null', 'NewAge Media', '2014', '22.99', '10');

insert into Item
values('645512356489', 'Aladdin', 'dvd', 'null', 'Disney', '1992', '12.99', '10');

insert into Item
values('486719375432', 'Shrek 2', 'dvd', 'null', 'Sony Media', '2004', '13.99', '10');

insert into Item
values('572635485728', 'Children of Men', 'dvd', 'null', 'NewAge Media', '2012', '19.99', '10');
 
insert into Item
values('475629387543', 'Unideal Ape', 'cd', 'rap', 'Universal Music Group', '2003', '14.99', '10');
 
insert into Item
values('485726399384', 'The Dark Knight', 'dvd', 'null', 'Warner Bros.', '2008', '16.99', '10');
 
insert into Item
values('295734573849', 'Set You Free', 'cd', 'country', 'Universal Music Group', '2013', '13.99', '10');
 
insert into Item
values('049581783948', 'Mamma Mia!', 'dvd', 'null', 'Warner Bros.', '2009', '14.99', '10');


insert into LeadSinger
values('468791534685', 'Cee Lo Green');

insert into LeadSinger
values('981564587122', 'Taylor Swift');
 
insert into LeadSinger
values('485465791264', 'Iggy Azaelea');

insert into LeadSinger
values('234511256485', 'Brian Larson');

insert into LeadSinger
values('894516725312', 'Chris Paine');

insert into LeadSinger
values('871546565123', 'Bob Marley');
 
insert into LeadSinger
values('897451462354', 'Ten Degrees of Boredom');
 
insert into LeadSinger
values('475629387543', 'The Raw Suckers');
 
insert into LeadSinger
values('295734573849', 'Kevin Hardy');


insert into HasSong
values('468791534685', 'Forget You');

insert into HasSong
values('468791534685', 'If Only');

insert into HasSong
values('468791534685', 'Bawse');

insert into HasSong
values('468791534685', 'Crazy');

insert into HasSong
values('981564587122', 'Shake It Off');

insert into HasSong
values('981564587122', 'Blank Space');

insert into HasSong
values('981564587122', 'New You Were Trouble');

insert into HasSong
values('981564587122', 'Basic Girls');

insert into HasSong
values('485465791264', 'Fancy');

insert into HasSong
values('485465791264', 'Basic Girls');

insert into HasSong
values('485465791264', 'Three Dumb Things');

insert into HasSong
values('485465791264', 'Iggy Eh');

insert into HasSong
values('234511256485', 'Who Cares');

insert into HasSong
values('234511256485', 'House Not Building');

insert into HasSong
values('234511256485', 'Crew');

insert into HasSong
values('234511256485', 'Gotcha Back');

insert into HasSong
values('894516725312', 'What If You And I');

insert into HasSong
values('894516725312', 'Honey Baby');

insert into HasSong
values('894516725312', 'Crooning For Ya');

insert into HasSong
values('871546565123', 'No Woman, No Cry');

insert into HasSong
values('871546565123', 'Redemption Song');

insert into HasSong
values('871546565123', 'Three Little Birds');

insert into HasSong
values('871546565123', 'Stir It Up');
 
insert into HasSong
values('897451462354', 'Hatred of the Devil');

insert into HasSong
values('897451462354', 'Revenge of Kosta');

insert into HasSong
values('897451462354', 'Korra the Brave');

insert into HasSong
values('897451462354', 'Cracked Glasses');

insert into HasSong
values('475629387543', 'Blame the Socialists');

insert into HasSong
values('475629387543', 'Yeah');

insert into HasSong
values('475629387543', 'Sucking');

insert into HasSong
values('475629387543', 'BAM');
 
insert into HasSong
values('295734573849', 'Nobody Like You');

insert into HasSong
values('295734573849', 'Hard Hitting');

insert into HasSong
values('295734573849', 'Push Shove Pull');

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