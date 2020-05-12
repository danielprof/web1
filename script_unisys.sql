create database unisys;

use unisys;

create table Categoria(
	idCategoria int not null primary key auto_increment,
	nomeCategoria varchar(30) unique) type=InnoDB;
	
create table Produto(
	idProduto int not null primary key auto_increment,
	nomeProduto varchar(30) unique,
	idCategoria int,	
	preco numeric(10,2) check (preco >= 0),
	estoque int check(estoque >= 0),
	FOREIGN KEY (idCategoria) references Categoria(idCategoria) ON UPDATE CASCADE ON DELETE RESTRICT) type=InnoDB;

create table Vendedor(
	idVendedor int not null primary key auto_increment,
	nomeVendedor varchar(30),
	comissao numeric(10,2)) type=InnoDB;
	
create table Cliente(
	idCliente int not null primary Key auto_increment,
	nomeCliente varchar(30),
	cpf char(11) unique,
	telefone varchar(12),
	sexo char(1) check(sexo='M' or sexo='F')) type=InnoDB;

create table Venda(
	idVenda int not null primary Key auto_increment,
	idCliente int,
	idVendedor int,
	dataVenda datetime,
	FOREIGN KEY (idCliente) references Cliente(idCliente) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY (idVendedor) references Vendedor(idVendedor) ON UPDATE RESTRICT ON DELETE RESTRICT) type=InnoDB;

create table ItemVenda(
	idItemVenda int not null primary Key auto_increment,
	idVenda int,
	idProduto int,
	quant int,
	precoVenda numeric(10,2),
	desconto numeric(10,2),
	FOREIGN KEY (idVenda) references Venda(idVenda)	ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY (idProduto) references Produto(idProduto) ON UPDATE RESTRICT ON DELETE RESTRICT) type=InnoDB;
	
--Insert

insert into Categoria(nomeCategoria) values('Bebidas');	
insert into Categoria(nomeCategoria) values('Brinquedos');	

insert into Produto(nomeProduto,idCategoria, preco, estoque) values('Coca-Cola',1,5.50,100);	
insert into Produto(nomeProduto,idCategoria, preco, estoque) values('Bola Jabulani',2,100,10);	

insert into Vendedor(nomeVendedor,comissao) values('Juvenal',3.5);
insert into Vendedor(nomeVendedor,comissao) values('Mesquita',2.5);
insert into Vendedor(nomeVendedor,comissao) values('Raphael Dias Oliveira',3.5);	
insert into Vendedor(nomeVendedor,comissao) values('Adibe Dias Martins',2.5);	

insert into Cliente(nomeCliente,cpf,telefone,sexo) values('Maria Clara','93135505633','96310205','F');	
insert into Cliente(nomeCliente,cpf,telefone,sexo) values('Jorge Ribeiro','93135505634','99919876','M');
insert into Cliente(nomeCliente,cpf,telefone,sexo) values('Raphael Dias Oliveira','08588427699','03432248887','M');	
insert into Cliente(nomeCliente,cpf,telefone,sexo) values('Gabriela Caetano Gontijo','12345678911','03499939984','F');	

insert into Venda(idCliente,idVendedor,dataVenda) values(1,1,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(1,2,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(1,3,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(1,4,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(2,1,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(2,2,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(2,3,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(2,4,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(3,1,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(3,2,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(3,3,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(3,4,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(4,1,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(4,2,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(4,3,now());
insert into Venda(idCliente,idVendedor,dataVenda) values(4,4,now());


insert into ItemVenda(idVenda,idProduto,quant,precoVenda,desconto) values(1,24,10,14,0);
insert into ItemVenda(idVenda,idProduto,quant,precoVenda,desconto) values(1,15,2,21,2);












create table usuario(
	idUsuario int primary key auto_increment,
	nomeUsuario varchar(15),
	senha varchar(150) 
)type=InnoDB;


CREATE TABLE logradouro(
	idLogradouro int primary key auto_increment,
	cep char(8),
	tipo varchar(10),
	logradouro varchar(45),
	bairro varchar(75),
	cidade varchar(60),
	uf char(2)
)  type=InnoDB;

select idVenda,dataVenda,nomeVendedor,nomeCliente
from venda,cliente,vendedor
where venda.idCliente = cliente.idCliente and
      venda.idVendedor = vendedor.idVendedor
order by dataVenda,nomeVendedor,nomeCliente desc;	  
	  

select idVenda,dataVenda,nomeVendedor,nomeCliente
from venda inner join cliente on venda.idCliente = cliente.idCliente
        inner join vendedor on venda.idVendedor = vendedor.idVendedor
order by dataVenda,nomeVendedor,nomeCliente desc 	  
	  

insert into itemVenda(idVenda,idProduto,precoVenda,quant,desconto)
values(1,1,4.5,10,5);


SELECT idVenda,dataVenda,nomeVendedor,nomeCliente
FROM venda 
     INNER JOIN vendedor ON venda.idVendedor = vendedor.idVendedor
	 INNER JOIN cliente ON venda.idCliente = cliente.idCliente;
	 
	 




select idItemVenda,nomeProduto,
          (precoVenda*quant-desconto) total
from itemVenda 
  inner join produto on produto.idProduto=itemVenda.idProduto;


select dataVenda from venda 
where dataVenda between concat('2019-05-08',' 00:00:00')
                    and concat('2019-05-08',' 23:59:59');

























