-- Create the database
CREATE DATABASE scheduling_platform;

-- Use the database
USE scheduling_platform;

-- Create the 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create the 'schedules' table
CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    food_preferences TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
