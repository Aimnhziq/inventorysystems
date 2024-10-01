1st Intership Project

Vanilla PHP

Database (phpmyadmin)
-- Create the admins table
CREATE TABLE admins (
    adminid INT AUTO_INCREMENT PRIMARY KEY,
    adminusername VARCHAR(50) NOT NULL,
    adminpassword VARCHAR(255) NOT NULL
);

-- Create the customers table
CREATE TABLE customers (
    customerid INT AUTO_INCREMENT PRIMARY KEY,
    customername VARCHAR(100) NOT NULL,
    customercontact VARCHAR(15) NOT NULL,
    customeraddress TEXT NOT NULL,
    customerpostalcode VARCHAR(10) NOT NULL,
    customerstate VARCHAR(50) NOT NULL
);

-- Create the category table
CREATE TABLE category (
    categoryid INT AUTO_INCREMENT PRIMARY KEY,
    categoryname VARCHAR(100) NOT NULL
);

-- Create the product table
CREATE TABLE product (
    productid INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(100) NOT NULL,
    productimage VARCHAR(255),
    quantityinstock INT NOT NULL,
    categoryid INT NOT NULL,
    FOREIGN KEY (categoryid) REFERENCES category(categoryid)
);

-- Create the orders table
CREATE TABLE `order` (
    orderid INT AUTO_INCREMENT PRIMARY KEY,
    customerid INT NOT NULL,
    orderdate DATE NOT NULL,
    FOREIGN KEY (customerid) REFERENCES customers(customerid)
);

-- Create the orderproduct table
CREATE TABLE orderproduct (
    orderproductid INT AUTO_INCREMENT PRIMARY KEY,
    orderid INT NOT NULL,
    productid INT NOT NULL,
    quantityorder INT NOT NULL,
    FOREIGN KEY (orderid) REFERENCES `order`(orderid),
    FOREIGN KEY (productid) REFERENCES product(productid)
);

-- Create the warranty table
CREATE TABLE warranty (
    warrantyid INT AUTO_INCREMENT PRIMARY KEY,
    orderid INT NOT NULL,
    warrantystartdate DATE NOT NULL,
    warrantyenddate DATE NOT NULL,
    warrantyperiod VARCHAR(50),
    warrantydetails TEXT,
    FOREIGN KEY (orderid) REFERENCES `order`(orderid)
);
