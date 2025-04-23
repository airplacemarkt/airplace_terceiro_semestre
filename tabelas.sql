CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    descricao TEXT NOT NULL,
    estoque INT NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT(11) DEFAULT NULL,  
    imagem VARCHAR(255) NOT NULL,  
    categoria VARCHAR(255) NOT NULL, 
    preco_promocional DECIMAL(10, 2) DEFAULT NULL, 
    FOREIGN KEY (user_id) REFERENCES users(id)  
);




-- Tabela de pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    nome_cliente VARCHAR(100),
    endereco TEXT,
    cep VARCHAR(10),
    entrega VARCHAR(20),
    pagamento VARCHAR(20),
    total DECIMAL(10,2),
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de itens dos pedidos
CREATE TABLE itens_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    nome_produto VARCHAR(100),
    valor DECIMAL(10,2),
    quantidade INT,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id)
);
