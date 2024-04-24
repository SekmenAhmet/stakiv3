CREATE TABLE IF NOT EXISTS users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    lastname VARCHAR(150) NOT NULL,
    username VARCHAR(150) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    biographie VARCHAR(255),
    passwd VARCHAR(150) NOT NULL,
    ddn DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS amis (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ami_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (ami_id) REFERENCES users(id)  
);

CREATE TABLE IF NOT EXISTS demande_ami (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    addedUser_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (addedUser_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS notifications (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message VARCHAR(255),
    sender_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
);

CREATE TABLE logs (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    action varchar(255),
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE staks (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    text varchar(255),
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);