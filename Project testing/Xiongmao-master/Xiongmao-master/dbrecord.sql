/* Database SQL record */
CREATE TABLE users (
    user_firstName VARCHAR(20),
    user_lastName VARCHAR(20),
    user_email VARCHAR(30) NOT NULL UNIQUE,
    user_password VARCHAR(50),
    CONSTRAINT users_PK PRIMARY KEY (user_email)
);

CREATE TABLE menu (
    product_id INT NOT NULL,
    product_name VARCHAR(50),
    product_price FLOAT,
    product_cat VARCHAR(20),
    CONSTRAINT menu_PK PRIMARY KEY (product_id)
);

INSERT INTO menu VALUES
    (0, "Sliced Beef with Black Pepper Sauce", 20, "meat"),
    (1, "Double Cooked Pork with Chinese Leek", 16, "meat"),
    (2, "Spicy Chicken", 18, "meat"),
    (3, "Fish Filets in Hot Chili Oil", 22, "meat"),
    (4, "Egg Plant with Minced Chicken and Sichuan Chilli Sauce", 10, "vege"),
    (5, "Lettuce in Oyster Sauce", 8, "vege"),
    (6, "Bai Mu Dan White Peony Tea", 5, "drink"),
    (7, "Oolong Tea", 4.5, "drink"),
    (8, "Sweet-sour Plum Juice", 3.5, "drink"),
    (9, "Traditional Chinese Liquor", 11, "drink");

CREATE TABLE reserve (
    rsv_id INT NOT NULL AUTO_INCREMENT,
    rsv_salulation CHAR(3),
    rsv_name VARCHAR(30),
    rsv_phone VARCHAR(15),
    rsv_email VARCHAR(30),
    rsv_date DATE,
    rsv_time VARCHAR(10),
    rsv_pax INT(1),
    rsv_comment VARCHAR(100),
    CONSTRAINT reserve_PK PRIMARY KEY (rsv_id)
);

CREATE TABLE contact (
    ctt_id INT NOT NULL AUTO_INCREMENT,
    ctt_salulation CHAR(3),
    ctt_name VARCHAR(30),
    ctt_email VARCHAR(30),
    ctt_comment VARCHAR(100),
    CONSTRAINT contact_PK PRIMARY KEY (ctt_id)
);

CREATE TABLE foodDelivery_transactions (
  trans_id INT(11) NOT NULL AUTO_INCREMENT,
  trans_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  trans_dollars FLOAT NOT NULL,
  user_email VARCHAR(20) NOT NULL,
  delivery_name VARCHAR(20) NOT NULL,
  delivery_phone VARCHAR(10) NOT NULL,
  delivery_email VARCHAR(20) NOT NULL,
  delivery_address VARCHAR(50) NOT NULL,
  delivery_postcode VARCHAR(20) NOT NULL,
  food_ordered VARCHAR(150) NOT NULL,
  CONSTRAINT foodDelivery_transactions_PK PRIMARY KEY (trans_id),
  CONSTRAINT foodDelivery_transactions_FK FOREIGN KEY (user_email) REFERENCES users(user_email)
);

CREATE TABLE eventBooking_transactions (
  trans_id INT(10) NOT NULL AUTO_INCREMENT,
  trans_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  trans_dollars FLOAT NOT NULL,
  user_email VARCHAR(20) NOT NULL,
  delivery_name VARCHAR(20) NOT NULL,
  delivery_phone VARCHAR(10) NOT NULL,
  delivery_email VARCHAR(20) NOT NULL,
  delivery_address VARCHAR(50) NOT NULL,
  delivery_postcode VARCHAR(20) NOT NULL,
  events_booked VARCHAR(60) NOT NULL,
  CONSTRAINT eventBooking_transactions_PK PRIMARY KEY (trans_id),
  CONSTRAINT eventBooking_transactions_FK FOREIGN KEY (user_email) REFERENCES users(user_email)
);
