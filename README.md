### Install
`git clone https://github.com/lisiy50/swilv-web.git swivl-test-oleg`

`cd swivl-test-oleg` 

`composer install`

#### Configuration
copy `.env` to `.env.local` file and change DATABASE_URL configuration:

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name`

Then run command `php bin/console doctrine:database:create` to create DB
and `php bin/console doctrine:migrations:migrate` to create DB structure.

#### Run project
`php bin/console server:run`
default host http://127.0.0.1:8000

#### Requests
GET /api/school_classes/

POST /api/school_classes/ data example: `{"name":"new name","isActive":true}`

PUT /api/school_classes/{id} data example: `{"name":"new name","isActive":false}`

DELETE /api/school_classes/{id}



# TASK 2 SQL queries
[https://gist.github.com/lisiy50/e3abdcc3dd9550c9d8efbef26e274543](https://gist.github.com/lisiy50/e3abdcc3dd9550c9d8efbef26e274543)

##### 1.a
`select f.name, if (p.phone is not null, p.phone, '-') phoneNumber from firm f
left join phone p on f.id = p.firmid
group by f.id;`

##### 1.b
`select f.* from firm f
left join phone p on f.id = p.firmid and p.firmid is null;`

##### 1.c
`select f.* from firm f
join phone p on f.id = p.firmid
group by f.id
having count(f.id) > 1;`

##### 1.d
`select f.* from firm f
left join phone p on f.id = p.firmid
group by f.id
having count(f.id) < 2;`

##### 1.e
`select f.*, count(f.id) countPhones from firm f
left join phone p on f.id = p.firmid
group by f.id
order by countPhones desc
limit 1;`

##### 2.a
`select c.name companyName, g.name productName, if (sum(s.quantity), sum(s.quantity), 'No Data') totalQuantity, date_format(s.shipdate, '%d/%m/%Y') lastShipmentDate from company c
left join shipment s on c.compid = s.compid
left join goods g on s.goodid = g.goodid
group by c.compid, g.goodid
order by c.name, g.name, s.shipdate desc;`

##### 2.b
`select c.name companyName, g.name productName, if (sum(s.quantity), sum(s.quantity), 'No Data') totalQuantity, date_format(s.shipdate, '%d/%m/%Y') lastShipmentDate from company c
left join shipment s on c.compid = s.compid
left join goods g on s.goodid = g.goodid
where s.shipdate >= (date(now()) - interval 40 day)
group by c.compid, g.goodid
order by c.name, g.name, s.shipdate desc;`