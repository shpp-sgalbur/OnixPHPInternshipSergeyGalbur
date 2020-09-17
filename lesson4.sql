Создать пользователя intern, разрешить пользователю вход по паролю
CREATE USER intern;

Создать базу данных market
CREATE DATABASE market;

Создать таблицу users c полями реализованными для объекта из предыдущего задания (типы выбрать самостоятельно исходя из самого поля)
CREATE TABLE users(
id bigserial not null,
name text UNIQUE,
balance money,
products integer[]
);

Создать таблицу products c полями реализованными для объекта из предыдущего задания (типы выбрать самостоятельно исходя из самого поля)
Реализовать связь между таблицами products и users по тому же принципу как и в предыдущем задании (у продукта есть хозяин)
CREATE TABLE products(
id bigserial not null,
name text,
price money,
prop1 text,
prop2 text,
prop3 text,
owner text REFERENCES users (name) NOT NULL,
idInOwner integer
);

Заполнить базу несколькими пользователями и товарами для них
INSERT INTO users(name,balance)
VALUES('Vasia', 3000);
INSERT INTO users(name,balance)
VALUES('Olga', 100);
INSERT INTO users(name,balance)
VALUES('Lena', 100);

INSERT INTO products(name, price, owner, prop1)
VALUES ('proc', 2000, 'Olga', 1200);
INSERT INTO products(name, price, owner, prop1)
VALUES ('proc', 2000, 'Olga', 1200);
INSERT INTO products(name, price, owner, prop1, prop2)
VALUES ('ram', 3000, 'Olga','DDR', '8GB');
INSERT INTO products(name, price, owner, prop1, prop2)
VALUES ('ram', 3000, 'Vasia','DDR', '8GB');
INSERT INTO products(name, price, owner, prop1, prop2)
VALUES ('ram', 3000, 'Lena','DDR', '8GB');

Сделать выборку из двух таблиц (users left join products) но вывести только имя пользователя и имя продукта
SELECT users.name, products.name FROM users left join products ON users.name = products.owner;

Написать запрос изменения хозяина у продукта
BEGIN;
UPDATE products SET owner = 'Vasia' WHERE id = (select id from products WHERE name = 'proc' AND owner = 'Olga' limit 1) ;
UPDATE users SET balance = balance + '2000' WHERE name = 'Olga';
UPDATE users SET balance = balance - '2000' WHERE name = 'Vasia';
COMMIT;


Удалить одного пользователя
BEGIN;
delete from products where owner = 'Lena';
delete from users where name = 'Lena';
COMMIT;

Посчитать количество всех товаров у каждого пользователя одним запросом, вывести Имя пользователя и количество товаров
select owner, count(*) from products group by owner;


Добавить в таблицу users поле email, сделать его уникальным
ALTER TABLE users ADD COLUMN email text UNIQUE;

Сделать так чтобы айди пользователя начинались с 10000 при добавлении
CREATE SEQUENCE serial START 10000;
ALTER TABLE users ADD COLUMN  id integer DEFAULT nextval('serial') NOT NULL;
INSERT INTO users(id, name, balance)
VALUES(nextval('serial'),'Lena', 100);

Добавить в таблицу users поле birthday типа date, ограничить его чтобы возможно было добавить только дату в прошлом
ALTER TABLE users ADD COLUMN birthday date CHECK (birthday < NOW());


Добавить поле age которое будет хранить количество лет пользователя
ALTER TABLE users ADD COLUMN age integer;



Добавить триггер который срабатывает при добавлении или обновлении записи в таблицу users и будет на основании значения в поле birthday 
вычислять сколько полных лет пользователю и устанавливать значение в поле age
CREATE FUNCTION get_age() RETURNS trigger AS $get_age$
BEGIN
IF OLD.birthday IS NULL THEN
RAISE EXCEPTION 'birthday cannot be null';
ELSEIF THEN
INSERT INTO users(age) VALUES (AGE(NOW(), OLD.birthday));
ENDIF;
END;
RETURN NEW;

$get_age$ LANGUAGE plpgsql;
CREATE TRIGGER get_age AFTER INSERT OR UPDATE ON users FOR EACH ROW EXECUTE FUNCTION get_age();
INSERT INTO users(name,balance,birthday)
VALUES('Lena', 100,'20/01/10');
