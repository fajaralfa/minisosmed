DROP DATABASE galeri_fajar_xiirpl2;
CREATE DATABASE galeri_fajar_xiirpl2;

USE galeri_fajar_xiirpl2;

CREATE TABLE users (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(35) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL
);

CREATE TABLE posts (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    users_id INTEGER NOT NULL,
    gambar VARCHAR(300) NOT NULL UNIQUE,
    caption TEXT NOT NULL,
    waktu TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(id)
);

CREATE TABLE likes (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    users_id INTEGER NOT NULL,
    posts_id INTEGER NOT NULL,
    waktu TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (users_id) REFERENCES users(id),
    FOREIGN KEY (posts_id) REFERENCES posts(id)
);

INSERT INTO users (name, username, password) VALUES
('Fajar Ilham Alfarizi', 'fajar', 'rahasia');