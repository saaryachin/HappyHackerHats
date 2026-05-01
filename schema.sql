CREATE DATABASE IF NOT EXISTS whitehat;
USE whitehat;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL
);

INSERT INTO products (product_name, price) VALUES
('Black Hat', 50.00),
('Red Hat', 60.00),
('White Hat', 100.00);
