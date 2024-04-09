CREATE TABLE users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name varchar(150),
    lastname varchar(150),
    username varchar(150),
    email varchar(150),
    biographie varchar(255),
    passwd varchar(150),
    ddn DATE
);

CREATE TABLE amis (
    id integer auto_increment primary key,
    user_id INT,
    ami_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (ami_id) REFERENCES users(id)  
);

CREATE TABLE demande_ami (
    id integer auto_increment primary key,
    user_id int,
    addedUser_id int,
    status enum ('En attente', 'Accepté !', 'Refusé !'),
    message varchar(255) default 'Voudrais-tu être mon ami ?',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (addedUser_id) REFERENCES users(id)
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    sender_id int,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (sender_id) REFERENCES users(id)
);
