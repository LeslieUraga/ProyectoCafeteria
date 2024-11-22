--TABLAS DE AUDITORIA

create table audi_empleados(
    id int primary key auto_increment,    
    nombre varchar(20),
    apellido_paterno varchar(20),
    apellido_materno varchar(20),
    numero_empleado_antiguo int,
    correo_electronico_antiguo varchar(50),
    passwd_antiguo varchar(30),
    telefono_antiguo bigint,
    direccion_antiguo varchar(60),
    puesto_antiguo varchar(45),
    fecha_contratacion_antiguo DATETIME,
    numero_empleado_nuevo int,
    correo_electronico_nuevo varchar(50),
    passwd_nuevo varchar(30),
    telefono_nuevo bigint,
    direccion_nuevo varchar(60),
    puesto_nuevo varchar(45),
    fecha_contratacion_nuevo DATETIME,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    rfc varchar(13)
);

create table audi_horario(
    id int primary key auto_increment,    
    entrada_antiguo DATETIME,
    salida_antiguo DATETIME,
    rfc_antiguo varchar(13),
    entrada_nuevo DATETIME,
    salida_nuevo DATETIME,
    rfc_nuevo varchar(13),
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_horario int
);


create table audi_productos(
    id int primary key auto_increment,  
    nombre_antiguo varchar(80),
    precio_antiguo float, 
    id_categoria_antiguo int,
    stock_antiguo float,
    stock_antiguo_minimo float,
    stock_antiguo_maximo float,
    nombre_nuevo varchar(80),
    precio_nuevo float, 
    id_categoria_nuevo int,
    stock_nuevo float,
    stock_nuevo_minimo float,
    stock_nuevo_maximo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),  
    id_producto int
);

create table audi_categorias(
    id int primary key auto_increment, 
    descripcion_antiguo varchar(200),
    descripcion_nuevo varchar(200),
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),  
    id_categoria int
);

create table audi_proveedores(
    id int primary key auto_increment, 
    nombre_antiguo varchar(60),
    telefono_antiguo bigint,
    correo_electronico_antiguo varchar(50),
    direccion_antiguo varchar(60),
    ombre_nuevo varchar(60),
    telefono_nuevo bigint,
    correo_electronico_nuevo varchar(50),
    direccion_nuevo varchar(60),
    usuario varchar(20), 
    modificado date, 
    accion varchar(15), 
    id_proveedor int
);

create table audi_compras(
    id int primary key auto_increment, 
    id_proveedor_antiguo int,
    fecha_compra_antiguo date,
    total_antiguo float,
    id_proveedor_nuevo int,
    fecha_compra_nuevo date,
    total_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_compras int
);


create table audi_detalle_compras(
    id int primary key auto_increment, 
    id_compra_antiguo int,
    id_producto_antiguo int,
    cantidad_antiguo float,
    precio_unitario_antiguo float,
    id_compra_nuevo int,
    id_producto_nuevo int,
    cantidad_nuevo float,
    precio_unitario_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_detalle_compra int
);

create table audi_ventas(
    id int primary key auto_increment, 
    fecha_venta_antiguo date,
    total_antiguo float,
    fecha_venta_nuevo date,
    total_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_venta int
);

create table audi_detalle_venta(
    id int primary key auto_increment, 
    id_venta_antiguo int,
    id_producto_antiguo int,
    cantidad_antiguo double,
    precio_unitario_antiguo float,
    id_venta_nuevo int,
    id_producto_nuevo int,
    cantidad_nuevo double,
    precio_unitario_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_detalle_venta int
);



create table audi_estatus_pedido(
    id int primary key auto_increment, 
    descripcion_antiguo varchar(20),  
    descripcion_nuevo varchar(20),  
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_estatus_pedido int

);
    
create table audi_pedidos(
    id int primary key auto_increment, 
    id_estatus_pedido_antiguo int,
    fecha_pedido_antiguo date,
    total_antiguo float,
    id_estatus_pedido_nuevo int,
    fecha_pedido_nuevo date,
    total_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_pedido int
);


create table audi_detalle_pedido(
    id int primary key auto_increment, 
    id_pedido_antiguo int,
    id_producto int,
    cantidad float,
    precio_unitario_antiguo float,
    ingrediente_extra_antiguo varchar(30),
    costo_ingrediente_extra_antiguo float,
    id_pedido_nuevo int,
    id_producto int,
    cantidad float,
    precio_unitario_nuevo float,
    ingrediente_extra_nuevo varchar(30),
    costo_ingrediente_extra_nuevo float,
    usuario varchar(20), 
    modificado date, 
    accion varchar(15),
    id_detalle_pedido int
);