drop table myclientsession cascade constraints;
drop table myclient cascade constraints;


create table myclient (
    clientid varchar2(28) primary key,
    studentFlag varchar2(1),
    administratorFlag varchar2(1),
    password varchar2(12)
);

create table myclientsession (
    sessionid varchar2(32) primary key,
    clientid varchar2(28),
    sessiondate date,
    foreign key (clientid) references myclient(clientid)
);

insert into myclient values('john', '1', '0', 'doe');
insert into myclient values('mary', '0', '1', 'jane');
insert into myclient values('peter', '1', '1', 'parker');

select * from myclient;

commit;