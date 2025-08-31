CREATE DATABASE IF NOT EXISTS sorteio;

USE sorteio;

CREATE TABLE apostador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) unique NOT NULL
);

CREATE TABLE apostador_cartela (
    id INT AUTO_INCREMENT PRIMARY KEY,
    apostador_id INT,
    numeros VARCHAR(50) NOT NULL,
    FOREIGN KEY (apostador_id) REFERENCES apostador(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE apostador_cartela_resultado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cartela_id INT,
    numeros_sorteados VARCHAR(50) NOT NULL,
    numeros_acertos VARCHAR(50),
    quantidade_acertos INT,
    FOREIGN KEY (cartela_id) REFERENCES apostador_cartela(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO apostador (nome) VALUES
('Libis da Silva'),
('Freira Oliveira'),
('Mafalda Pereira'),
('Marcelo Santos'),
('Marcos Costa');

INSERT INTO apostador_cartela (apostador_id, numeros) VALUES
(1, '1,2,3,4,5,6'),
(2, '6,7,8,9,10,66'),
(3, '11,12,13,14,15,67'),
(4, '16,17,18,19,20,80'),
(5, '21,22,23,24,25,90');
