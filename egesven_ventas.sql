CREATE TABLE Clientes (
    usuario_cliente VARCHAR(50) PRIMARY KEY, 
    nombre_cliente VARCHAR(50) NOT NULL,             
    apellidos_cliente VARCHAR(50) NOT NULL,          
    email_cliente VARCHAR(100) UNIQUE NOT NULL,     
    telefono_cliente VARCHAR(20),                  
    direccion_cliente VARCHAR(150),                 
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE Productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,             
    nombre_producto VARCHAR(50) NOT NULL,            
    descripcion_producto TEXT,                       
    precio_producto DECIMAL(10, 2) NOT NULL,          
    stock INT NOT NULL,                               
    categoria VARCHAR(50) NOT NULL                   
);

CREATE TABLE Pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,              
    usuario_cliente VARCHAR(50) NOT NULL,            
    fecha_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,  
    estado VARCHAR(20) NOT NULL,                     
    total DECIMAL(10, 2) NOT NULL,                    
    FOREIGN KEY (usuario_cliente) REFERENCES Clientes(usuario_cliente)
);

CREATE TABLE Detalle_pedido (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,            
    id_pedido INT NOT NULL,                           
    id_producto INT NOT NULL,                         
    cantidad INT NOT NULL,                          
    subtotal DECIMAL(10, 2) NOT NULL,               
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

CREATE TABLE Pagos (
    id_pago INT PRIMARY KEY AUTO_INCREMENT, 
    id_pedido INT NOT NULL,                                       
    metodo_pago VARCHAR(50) NOT NULL,                            
    estado VARCHAR(20) NOT NULL,                                
    fecha_pago DATE,                                              
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido)
);

CREATE TABLE Despacho (
    id_despacho INT PRIMARY KEY AUTO_INCREMENT, 
    id_pedido INT NOT NULL,                                           
    direccion_entrega VARCHAR(255) NOT NULL,                
    estado VARCHAR(20) NOT NULL,                             
    fecha_despacho DATE,                                        
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido)
);

CREATE TABLE Carrito (
    id_carrito INT PRIMARY KEY AUTO_INCREMENT, 
    usuario_cliente VARCHAR(50) NOT NULL,                                        
    id_producto INT NOT NULL,                                      
    cantidad INT NOT NULL,                                          
    fecha_agregado DATE NOT NULL,                                    
    FOREIGN KEY (usuario_cliente) REFERENCES Clientes(usuario_cliente),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);
