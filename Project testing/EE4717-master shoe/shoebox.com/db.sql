USE shoebox;
DROP TABLE cart_items;
DROP TABLE orders;
DROP TABLE product_variants;
DROP TABLE products;

CREATE TABLE products (
    product_id SMALLINT UNSIGNED AUTO_INCREMENT,
    product_name VARCHAR(64) NOT NULL,
    description VARCHAR(200),
    brand VARCHAR(20) NOT NULL,
    gender ENUM('men','women','kids') NOT NULL,
    price FLOAT(6,2) NOT NULL,
    pic_url VARCHAR(64),
    CONSTRAINT pk_product_id PRIMARY KEY (product_id)
);

CREATE TABLE product_variants (
    product_variant_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id SMALLINT UNSIGNED NOT NULL,
    size TINYINT UNSIGNED NOT NULL,
    color VARCHAR(20) NOT NULL,
    CONSTRAINT fk_product_id FOREIGN KEY (product_id) REFERENCES products (product_id)
);

CREATE TABLE orders (
    order_id VARCHAR(17) NOT NULL,
    user_id VARCHAR(36),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_order_id PRIMARY KEY (order_id),
    CONSTRAINT fk_user_id_order FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE cart_items (
    item_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id VARCHAR(36),
    order_id VARCHAR(17),
    product_id SMALLINT UNSIGNED,
    product_variant_id SMALLINT UNSIGNED,
    quantity TINYINT UNSIGNED,
    CONSTRAINT pk_item_id PRIMARY KEY (item_id),
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT fk_order_id FOREIGN KEY (order_id) REFERENCES orders(order_id),
    CONSTRAINT fk_product_id_cart FOREIGN KEY (product_id) REFERENCES products(product_id),
    CONSTRAINT fk_product_variant_id FOREIGN KEY (product_variant_id) REFERENCES product_variants(product_variant_id)
);

CREATE TABLE users (
    user_id VARCHAR(36) NOT NULL,
    username VARCHAR(16) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(64) NOT NULL,
    CONSTRAINT pk_user_id PRIMARY KEY (user_id),
    CONSTRAINT uc_username UNIQUE (username),
    CONSTRAINT uc_email UNIQUE (email)
);
