create database JP;
use JP;

CREATE TABLE Empresa (
    ID_Empresa INT PRIMARY KEY AUTO_INCREMENT,
    links_Empresa VARCHAR(255),
    nome_Empresa VARCHAR(255),
    CNPJ_Empresa VARCHAR(255),
    particularidades TEXT,
    endereco_Empresa VARCHAR(255)
);

CREATE TABLE Usuário(
   ID_Usuario INT PRIMARY KEY AUTO_INCREMENT,
   login_Usuario VARCHAR(255),
   senha_Usuário VARCHAR(255),
   tag_Usuario VARCHAR(255)
);

CREATE TABLE Formas_Importacao(
   ID_FormasImportacao INT primary Key auto_increment,
   Tipo_FormaImportacao Varchar (255)
);

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Entradas por sped');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Saídas por Sped');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('NFCe por sped');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Entradas por Xml');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Saídas por Xml');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('NFCe por Xml - SIEG');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Entradas pelo SAT');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Saídas por SIEG');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('NFCe por XML - Copiado do Cliente');

insert INTO Formas_Importacao(Tipo_FormaImportacao) values ('Entradas pelo SIEG');

CREATE TABLE Empresa_Forma_Importacao(
   ID_EmpresaImportacao INT PRIMARY KEY AUTO_INCREMENT,
   ID_FormasImportacao INT,
   ID_Empresa INT,
   CONSTRAINT fk_FormasImp FOREIGN KEY (ID_FormasImportacao) REFERENCES Formas_Importacao (ID_FormasImportacao),
   CONSTRAINT fk_EmpresaI FOREIGN KEY (ID_Empresa) REFERENCES Empresa (ID_Empresa)
);

CREATE TABLE Formas_Recebimento (
   ID_FormaRecebimento INT PRIMARY KEY AUTO_INCREMENT,
   tipo_FormaRecebimento VARCHAR(255) NOT NULL
);

CREATE TABLE Subformas_Recebimento (
   ID_SubformaRecebimento INT PRIMARY KEY AUTO_INCREMENT,
   ID_FormaRecebimento INT,
   subformaRecebimento VARCHAR(255) NOT NULL,
   CONSTRAINT fk_FormaRecebimento FOREIGN KEY (ID_FormaRecebimento) REFERENCES Formas_Recebimento(ID_FormaRecebimento)
);

INSERT INTO Formas_Recebimento (Tipo_FormaRecebimento)
VALUES ('Digital'), ('Física'), ('Digital e Física');

INSERT INTO Subformas_Recebimento (ID_FormaRecebimento, SubformaRecebimento)
VALUES
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital'), 'email'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital'), 'whatsapp'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital'), 'skype'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital'), 'acessorias');

INSERT INTO Subformas_Recebimento (ID_FormaRecebimento, SubformaRecebimento)
VALUES
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Física'), 'malote');

INSERT INTO Subformas_Recebimento (ID_FormaRecebimento, SubformaRecebimento)
VALUES
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital e Física'), 'email'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital e Física'), 'whatsapp'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital e Física'), 'skype'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital e Física'), 'acessorias'),
   ((SELECT ID_FormaRecebimento FROM Formas_Recebimento WHERE Tipo_FormaRecebimento = 'Digital e Física'), 'malote');

CREATE TABLE Empresa_recebimento (
   ID_EmpresaformaRecebimento INT PRIMARY KEY AUTO_INCREMENT,
   ID_Empresa INT,
   ID_SubformaRecebimento INT,
   CONSTRAINT fk_Empresa FOREIGN KEY (ID_Empresa) REFERENCES Empresa(ID_Empresa),
   CONSTRAINT fk_SubformaRecebimento FOREIGN KEY (ID_SubformaRecebimento) REFERENCES Subformas_Recebimento(ID_SubformaRecebimento)
);
