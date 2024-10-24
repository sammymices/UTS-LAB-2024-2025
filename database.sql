CREATE DATABASE todo_app;

USE todo_app;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    task VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE lists (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    list_id INT(11),
    task VARCHAR(255) NOT NULL,
    status ENUM('completed', 'incomplete') DEFAULT 'incomplete',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (list_id) REFERENCES lists(id)
);

ALTER TABLE lists
ADD COLUMN description TEXT,
ADD COLUMN deadline DATETIME,
ADD COLUMN is_completed BOOLEAN DEFAULT 0;

CREATE TABLE completed_tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    deadline DATETIME NOT NULL,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
