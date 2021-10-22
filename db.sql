DROP DATABASE IF EXISTS todolist;
CREATE DATABASE todolist CHARACTER SET utf8;
USE todolist;

CREATE TABLE user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR (25) NOT NULL,
    password VARCHAR (255) NOT NULL,
    email VARCHAR (255) NOT NULL UNIQUE,
    secret_phrase VARCHAR (255) NOT NULL,
    role BOOLEAN NOT NULL DEFAULT 1
);

CREATE TABLE status (
    status_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR (100) NOT NULL
);

CREATE TABLE task (
    task_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    title VARCHAR (255) NOT NULL,
    description TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    deadline DATETIME,
    status_id INT NOT NULL DEFAULT 4,
    FOREIGN KEY (author_id) REFERENCES user(id),
    FOREIGN KEY (status_id) REFERENCES status(status_id)
);

INSERT INTO status(label) VALUES
('Success'),
('Late'),
('Aborted'),
('Work in progress');