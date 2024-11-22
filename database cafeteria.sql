create database cafeteria;

use cafeteria;

create table empleados(
    rfc varchar(13) primary key,
    numero_empleado int,
    nombre varchar(20),
    apellido_paterno varchar(20),
    apellido_materno varchar(20),
    correo_electronico varchar(50),
    passwd varchar(30),
    telefono bigint,
    direccion varchar(60),
    puesto varchar(45),
    fecha_contratacion DATETIME
);

create table horario_empleados(
    id_horario int primary key auto_increment, 
    entrada DATETIME,
    salida DATETIME,
    rfc varchar(13),
    FOREIGN key rfc references empleados(rfc)
);

create table productos(
    id_producto int primary key auto_increment,
    nombre varchar(80),
    precio float, 
    id_categoria int,
    stock float,
    stock_minimo float,
    stock_maximo float,    
    FOREIGN KEY id_categoria references categorias(id_categoria)
);

create table categorias(
    id_categoria int primary key auto_increment,
    descripcion varchar(200)    
);

create table proveedores(
    id_proveedor int primary key auto_increment,
    nombre varchar(60),
    telefono bigint,
    correo_electronico varchar(50),
    direccion varchar(60)
);

create table compras(
    id_compras int primary key auto_increment,
    id_proveedor int,
    fecha_compra date,
    total float,
    FOREIGN key id_proveedor references proveedores(id_proveedor)
);

create table detalle_compras(
    id_detalle_compra int primary key auto_increment,
    id_compra int,
    id_producto int,
    cantidad float,
    precio_unitario float,
    FOREIGN key id_compra references compras(id_compra),
    FOREIGN key id_producto references productos(id_producto)
);

create table ventas(
    id_venta int primary key auto_increment,
    fecha_venta date,
    total float
);

create table detalle_ventas(
    id_detalle_venta int primary key auto_increment,
    id_venta int,
    id_producto int,
    cantidad double,
    precio_unitario float,
    FOREIGN KEY id_venta references ventas(id_venta),
    FOREIGN key id_producto references productos(id_producto)
);

create table estatus_pedidos(
    id_estatus_pedido int primary key auto_increment,
    descripcion varchar(20),   
);

create table pedidos(
    id_pedido int primary key auto_increment,
    id_estatus_pedido int,
    fecha_pedido date,
    total float,
    FOREIGN key id_estatus_pedido references estatus_pedido(id_estatus_pedido)
);


create table detalle_pedidos(
    id_detalle_pedido int primary key auto_increment,
    id_pedido int,
    id_producto int,
    cantidad float,
    precio_unitario float,
    ingrediente_extra varchar(30),
    costo_ingrediente_extra float,
    FOREIGN key id_pedido references pedidos(id_pedido),
    FOREIGN key id_producto references productos(id_producto)
);

