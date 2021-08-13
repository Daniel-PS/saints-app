
-- Qualquer arquivo .sql que estiver nessa pasta vai ser executado no bdd sempre que vc fizer um "up"

CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (name) VALUES ('Daniel');
INSERT INTO users (name) VALUES ('Gabriel');
INSERT INTO users (name) VALUES ('Ieda');
