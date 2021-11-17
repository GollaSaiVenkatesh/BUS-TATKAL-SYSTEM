create table driver(driver_id varchar(6) not null unique primary key, driver_name char(20) not null, driver_password varchar(10) not null);
create table bus(bus_no varchar(6) not null unique primary key, bus_type char(10)NOT NULL, source_city char(15)NOT NULL,dst_city char(15)NOT NULL,no_of_seats integer(2)NOT NULL,driver_id varchar(6) references driver);
create table seats(bus_no varchar(6) references bus, seat_no integer(2) NOT NULL, seat_type char(2)NOT NULL,primary key(bus_no,seat_no) );
create table stops(bus_no varchar(6) references bus, stop_id integer(10) NOT NULL, stop_name char(15)NOT NULL, stop_time varchar(5) check(stop_time like '__:__'), stop_amnt integer(4), primary key(bus_no,stop_id) );
create table customers(booking_id varchar(20) not null primary key,c_name char(20) not null,gender char(1) check(gender='F' or gender='M'),age integer(3) not null,cst_mailid varchar(30) check(cst_mailid like '%_@__%.__%'),j_date varchar(10) CHECK (j_date LIKE '__/__/____'),source_city char(15), dst_city char(15), bus_no varchar(6) REFERENCES bus, seat_no integer(2) REFERENCES seats);
insert into driver values('1234','sai','pass');
insert into bus values('A1','luxury','kavali','bengaluru',4,'1234');
insert into seats values('A1',01,'w');
insert into seats values('A1',02,'nw');
insert into seats values('A1',03,'w');
insert into seats values('A1',04,'nw');
insert into stops values('A1',01,'kavali','06:00',0);
insert into stops values('A1',02,'nellore','07:30',150);
insert into stops values('A1',03,'tirupathi','10:30',200);
insert into stops values('A1',04,'bengaluru','15:30',300);
insert into customers values('b01','venky','M',20,'gollasaivenkatesh@gmail.com','22/10/2020','kavali','tirupathi','A1',03);
insert into customers values('b02','veky','M',20,'golenkatesh@gmail.com','22/10/2020','tirupathi','bengaluru','A1',03);
insert into customers values('b03','vy','M',20,'gonkatesh@gmail.com','22/10/2020','kavali','nellore','A1',01);
insert into customers values('b04','y','M',20,'gokatesh@gmail.com','22/10/2020','nellore','tirupathi','A1',01);
select *from driver;
select *from bus;
select *from seats;
select *from stops;
select *from customers;
insert into driver values('1235','samba','pass');
insert into bus values('A2','luxury','kavali','guntur',4,'1235');
insert into seats values('A2',01,'w');
insert into seats values('A2',02,'nw');
insert into seats values('A2',03,'w');
insert into seats values('A2',04,'nw');
insert into stops values('A2',01,'kavali','06:00',0);
insert into stops values('A2',02,'ongole','07:30',100);
insert into stops values('A2',03,'chilkaluripeta','10:30',50);
insert into stops values('A2',04,'guntur','15:30',75);
insert into driver values('1236','venky','pass');
insert into bus values('A3','luxury','bengaluru','kavali',4,'1236');
insert into seats values('A3',01,'w');
insert into seats values('A3',02,'nw');
insert into seats values('A3',03,'w');
insert into seats values('A3',04,'nw');
insert into stops values('A3',01,'bengaluru','06:00',0);
insert into stops values('A3',02,'tirupathi','07:30',100);
insert into stops values('A3',03,'nellore','10:30',50);
insert into stops values('A3',04,'kavali','15:30',75);

#to get buses for given source and destination
create table t1(stop_name char(15) NOT NULL);
insert into t1 values('nellore');
insert into t1 values('tirupathi');
create table bus1 as SELECT DISTINCT s1.bus_no AS bus_no FROM stops s1 WHERE NOT EXISTS(SELECT t1.stop_name FROM t1 WHERE t1.stop_name NOT IN (SELECT s2.stop_name FROM stops s2 WHERE s2.bus_no = s1.bus_no)); 
ALTER TABLE bus1 ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE bus1 ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
update bus1 inner join stops on bus1.bus_no = stops.bus_no set bus1.src_id=stops.stop_id where stop_name='nellore';
update bus1 inner join stops on bus1.bus_no = stops.bus_no set bus1.dst_id=stops.stop_id where stop_name='tirupathi'; 
select bus_no from bus1 where src_id<dst_id;


 
#to get seats available
create table t2(bus_no varchar(10),src_city char(15),dst_city char(15));
insert into t2 values('A1','tirupathi','bengaluru');
select * from t2;
CREATE view src as SELECT t2.bus_no,t2.src_city,t2.dst_city,stops.stop_id "src_id" FROM t2 INNER JOIN stops ON stops.bus_no =t2.bus_no and t2.src_city=stops.stop_name;
CREATE view dst as SELECT t2.bus_no,t2.src_city,t2.dst_city,stops.stop_id "dst_id" FROM t2 INNER JOIN stops ON stops.bus_no =t2.bus_no and t2.dst_city=stops.stop_name;
ALTER TABLE t2 ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE t2 INNER JOIN dst ON t2.bus_no=dst.bus_no SET t2.dst_id = dst.dst_id;
ALTER TABLE t2 ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE t2 INNER JOIN src ON t2.bus_no=src.bus_no SET t2.src_id = src.src_id;
select * from t2;
CREATE VIEW booked AS SELECT seats.bus_no,seats.seat_no,customers.source_city,customers.dst_city FROM customers INNER JOIN seats ON customers.seat_no=seats.seat_no where customers.bus_no=seats.bus_no;
CREATE TABLE booke select * from booked;
ALTER TABLE booke ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE booke INNER JOIN stops ON booke.bus_no=stops.bus_no and booke.source_city=stops.stop_name SET booke.src_id = stops.stop_id;
ALTER TABLE booke ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE booke INNER JOIN stops ON booke.bus_no=stops.bus_no and booke.dst_city=stops.stop_name SET booke.dst_id = stops.stop_id;
select * from booke;
create view book as SELECT booke.bus_no, booke.seat_no FROM booke INNER JOIN t2 ON booke.bus_no=t2.bus_no and  (t2.src_id = booke.src_id or (t2.src_id > booke.src_id and t2.src_id<booke.dst_id));
create view book1 as select seats.* from seats left join book on seats.seat_no =book.seat_no and seats.bus_no=book.bus_no  where book.seat_no IS NULL;
select seat_no,seat_type from book1 inner join t2 on t2.bus_no=book1.bus_no;

 
 
 #to calculate fare
create table t3(bus_no varchar(10),src_city char(15),dst_city char(15));
insert into t3 values('A1','nellore','bengaluru');
CREATE view src as SELECT t3.bus_no,t3.src_city,t3.dst_city,stops.stop_id "src_id" FROM t3 INNER JOIN stops ON stops.bus_no =t3.bus_no and t3.src_city=stops.stop_name;
CREATE view dst as SELECT t3.bus_no,t3.src_city,t3.dst_city,stops.stop_id "dst_id" FROM t3 INNER JOIN stops ON stops.bus_no =t3.bus_no and t3.dst_city=stops.stop_name;
ALTER TABLE t3 ADD COLUMN src_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE t3 INNER JOIN src ON t3.bus_no=src.bus_no SET t3.src_id = src.src_id;
ALTER TABLE t3 ADD COLUMN dst_id TINYINT UNSIGNED NOT NULL DEFAULT 0;
UPDATE t3 INNER JOIN dst ON t3.bus_no=dst.bus_no SET t3.dst_id = dst.dst_id;
select * from t3;
create table fare1 as select stop_amnt from stops inner join t3 where t3.bus_no =stops.bus_no and(stops.stop_id>src_id and stops.stop_id<=dst_id);
select sum(stop_amnt) "total fare" from fare1;

drop table t1;
drop table bus1;

drop table customers;
drop table driver;
drop table bus;
drop table seats;
drop table stops;
drop view booked;
drop table booke;
drop view book;
drop table t2;
drop view src;
drop view dst;
drop view book1;

drop table t3;
drop table fare1;
drop view src;
drop view dst;