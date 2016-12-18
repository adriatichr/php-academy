# Inicijalne tablice za booking aplikaciju
CREATE TABLE IF NOT EXISTS place (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	postal_code VARCHAR(10) NOT NULL,
	PRIMARY KEY(id)
) COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS accommodation (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(100) NOT NULL,
	price_per_day DECIMAL(10,2) UNSIGNED NOT NULL,
	place_id INT UNSIGNED NOT NULL,
	category TINYINT UNSIGNED,
	description MEDIUMTEXT,
	created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id),
	CONSTRAINT accommodation_place FOREIGN KEY (place_id) REFERENCES place (id)
) COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS customer (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	email VARCHAR(100) NOT NULL,
	password CHAR(60) NOT NULL,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE INDEX email (email)
) COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS reservation (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	accommodation_id BIGINT UNSIGNED NOT NULL,
	customer_id BIGINT UNSIGNED NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	CONSTRAINT reservation_accommodation FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT reservation_customer FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE RESTRICT
) COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS shortlist (
	accommodation_id BIGINT UNSIGNED NOT NULL,
	customer_id BIGINT UNSIGNED NOT NULL,
	PRIMARY KEY (accommodation_id, customer_id),
	CONSTRAINT shortlist_accommodation FOREIGN KEY (accommodation_id) REFERENCES accommodation (id) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT shortlist_customer FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE CASCADE ON DELETE CASCADE
) COLLATE utf8_general_ci;

# Punjenje tablica dummy podacima
START TRANSACTION;
INSERT INTO place (id, name, postal_code) VALUES
	(1, 'Split', '21000'), (3, 'Omiš', '21310'), (4, 'Kaštel Sućurac', '21212'), (5, 'Solin', '21210');
INSERT INTO accommodation (id, name, price_per_day, place_id, category, description) VALUES
	(1, 'Split Luxury Rentals', 349.99, 1, 5, 'Luxury accommodation near Split city center, with a swimming pool, vine cellar, all that good stuff.'),
	(2, 'Happy Sunny Verygood apartments', 19.99, 4, 2, 'Spacious apartments located in the middle of Kaštel Sućurac\'s historic Jugovinil district.'),
	(3, 'Pirate\'s Bed & Breakfast', 29.99, 3, NULL, 'Spend your vacation on an actual restored pirate ship moored in the Omiš harbour.'),
	(4, 'Generic rooms and studios', 29.99, 1, 3, 'Lorem ipsum dolor sit amet, duo viderer vituperatoribus no. Eos ne ullum volumus, saperet detracto aliquando vix ne.'),
	(5, 'Solin Heights', 50, 5, 3, 'Lovely apartment with a glorious view over the entire Kaštela bay.');
INSERT INTO customer (id, email, password, name, surname) VALUES
	(1, 'alice@gmail.com', 'swordfish', 'Alice', 'Smith'),
	(2, 'bob.customer@yahoo.com', '123456', 'Robert', 'Customer');
INSERT INTO reservation (accommodation_id, customer_id, start_date, end_date) VALUES
	(3, 1, '2017-07-16', '2017-07-28'),
	(2, 2, '2017-09-01', '2017-09-15');
INSERT INTO shortlist (accommodation_id, customer_id) VALUES (3, 1),	(2, 2),	(1, 2),	(2, 1),	(5, 1),	(5, 2);
COMMIT;
