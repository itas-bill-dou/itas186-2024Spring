-- DDL for Creating Tables
CREATE TABLE customer (
    customer_id INT PRIMARY KEY,
    title VARCHAR(10),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address VARCHAR(100),
    city VARCHAR(50),
    postal_code VARCHAR(10),
    phone VARCHAR(20)
);

CREATE TABLE item (
    item_id INT PRIMARY KEY,
    description VARCHAR(100),
    cost_price DECIMAL(10, 2),
    sell_price DECIMAL(10, 2)
);

CREATE TABLE stock (
    item_id INT,
    quantity_in_stock INT,
    FOREIGN KEY (item_id) REFERENCES item(item_id)
);

CREATE TABLE `order` (
    order_id INT PRIMARY KEY,
    customer_id INT,
    order_date DATE,
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
);

CREATE TABLE order_details (
    order_id INT,
    item_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES `order`(order_id),
    FOREIGN KEY (item_id) REFERENCES item(item_id)
);

-- Inserting Data into Tables

-- Insert data into 'customer' table
INSERT INTO customer (customer_id, title, first_name, last_name, address, city, postal_code, phone) VALUES
(1, 'Mr', 'John', 'Doe', '123 Elm Street', 'Springfield', 'SPF123', '555-1234'),
(2, 'Ms', 'Jane', 'Smith', '456 Oak Avenue', 'Shelbyville', 'SHV456', '555-5678'),
(3, 'Mrs', 'Mary', 'Johnson', '789 Pine Road', 'Ogdenville', 'OGD789', '555-9012'),
(4, 'Dr', 'Susan', 'Lee', '321 Maple Lane', 'North Haverbrook', 'NHB321', '555-3456'),
(5, 'Mr', 'Robert', 'Brown', '234 Cedar St', 'Springfield', 'SPF234', '555-6789'),
(6, 'Ms', 'Emily', 'Davis', '567 Birch St', 'Shelbyville', 'SHV567', '555-1011'),
(7, 'Mr', 'William', 'Miller', '890 Spruce St', 'Ogdenville', 'OGD890', '555-1213'),
(8, 'Mrs', 'Patricia', 'Wilson', '654 Palm Rd', 'North Haverbrook', 'NHB654', '555-1415');

-- Insert data into 'item' table
INSERT INTO item (item_id, description, cost_price, sell_price) VALUES
(1, 'Widget', 2.50, 5.00),
(2, 'Gadget', 3.75, 7.50),
(3, 'Thingamajig', 1.25, 2.50),
(4, 'Doohickey', 4.00, 8.00),
(5, 'Thingamabob', 0.75, 1.50),
(6, 'Whatchamacallit', 5.00, 10.00);

-- Insert data into 'stock' table
INSERT INTO stock (item_id, quantity_in_stock) VALUES
(1, 100),
(2, 50),
(3, 75),
(4, 200),
(5, 150),
(6, 80);

-- Insert data into 'order' table
INSERT INTO `order` (order_id, customer_id, order_date) VALUES
(1, 1, '2024-02-15'),
(2, 2, '2024-02-17'),
(3, 3, '2024-02-20'),
(4, 4, '2024-03-01'),
(5, 5, '2024-03-03'),
(6, 6, '2024-03-05');

-- Insert data into 'order_details' table
INSERT INTO order_details (order_id, item_id, quantity) VALUES
(1, 1, 2),
(1, 3, 1),
(2, 2, 3),
(3, 1, 1),
(3, 3, 2),
(4, 2, 1),
(4, 4, 2),
(5, 5, 3),
(5, 1, 1),
(6, 6, 2),
(6, 3, 1);