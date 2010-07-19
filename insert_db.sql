
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


insert into property (prop_id,address,price,offer_type,area,user_id) values
(1,'matzarou 15',45000,'S',35,'konstantina'),
(2,'aliartou 19',65000,'S',59,'vasilakis'),
(3,'kwsth palama 5',75000,'S',78,'alex'),
(4,'kefallhnias 20-24',70000,'S',72,'guest'),
(5,'satwmvriandou 35-37',300,'L',22,'mits'),
(6,'ageirou 8',480,'L',75,'vassis');


insert into facilities (fac_id,facility) values
(1,'proedriko mpanio'),
(2,'mpaniera'),
(3,'ntouz'),
(4,'epiplwmeno');

insert into fac_prop (prop_id,fac_id) values
(2,1),
(1,2),
(3,2),
(6,2),
(4,2),
(5,4),
(5,3);

insert into categories (cat_id,category) values
(1,'studio'),
(2,'gkarsoniera'),
(3,'duari'),
(4,'triari');

insert into cat_prop (prop_id,cat_id) values
(5,1),
(1,2),
(2,3),
(4,4),
(5,4),
(6,4);

