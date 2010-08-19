
use akinita;

insert into users (username,password,email,user_type) values
('vasilakis','19881988','vasilakis@gmail.com','A'),
('mits','1234','dklisiaris@hotmail.com','A'),
('konstantina','1234','konstkar@hotmail.com','A'),
('vassis','ntavas','esaamitisforever@hotmail.com','U'),
('guest','guestpass','guest@guest.gr','U'),
('alex','11072007','alenumber11@hotmail.com','U');

insert into telephone (mobile1,user_id) values
('6932735244','vasilakis'),
('3983742883','guest'),
('3928423987','vassis'),
('9823428838','mits'),
('9823479283','konstantina'),
('6666666666','alex');


insert into property (prop_id,address,price,offer_type,area,user_id,propState) values
(1,'Ματζαρου 4',45000,'S',35,'konstantina','T'),
(2,'Αλιάρτου 19',65000,'S',59,'vasilakis','T'),
(3,'Κωστή Παλαμά 5',75000,'S',78,'alex','T'),
(4,'Κεφαλληνίας 20-24',70000,'S',72,'guest','T'),
(5,'Σατωμβριάνδου 35-37',300,'L',22,'mits','T'),
(6,'Αγείρου 8',480,'L',75,'vassis','T');


insert into facilities (fac_id,facility) values
(1,'Μπανιέρα'),
(2,'Air-Codition'),
(3,'Ντουζ'),
(4,'Επιπλωμενο');

insert into fac_prop (prop_id,fac_id) values
(2,1),
(1,2),
(3,2),
(6,2),
(4,2),
(5,4),
(5,3);

insert into categories (cat_id,category) values
(1,'Studio'),
(2,'Γκαρσονιέρα'),
(3,'Δυάρι'),
(4,'Τριάρι');

insert into cat_prop (prop_id,cat_id) values
(5,1),
(1,2),
(2,3),
(4,4),
(3,4),
(6,4);

