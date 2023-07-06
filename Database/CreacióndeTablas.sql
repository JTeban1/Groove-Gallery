CREATE TABLE "venta" (
  "idventa" int NOT NULL AUTO_INCREMENT,
  "idpersona" int NOT NULL,
  "idusuario" int NOT NULL,
  "idFacturacion" int NOT NULL,
  "idMedioPago" int NOT NULL,
  "tipo_comprobante" varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "num_comprobante" varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "fecha_hora" datetime NOT NULL,
  "total" decimal(11,2) NOT NULL,
  PRIMARY KEY ("idventa"),
  KEY "FK_Persona_Venta" ("idpersona"),
  KEY "FK_Usuario_Venta" ("idusuario"),
  KEY "fk_facturacion" ("idFacturacion"),
  KEY "medioPago_venta" ("idMedioPago"),
  CONSTRAINT "fk_facturacion" FOREIGN KEY ("idFacturacion") REFERENCES "personafacturacion" ("idFacturacion"),
  CONSTRAINT "fk_persona" FOREIGN KEY ("idpersona") REFERENCES "persona" ("idpersona"),
  CONSTRAINT "Fk_usuario" FOREIGN KEY ("idusuario") REFERENCES "usuario" ("idusuario"),
  CONSTRAINT "medioPago_venta" FOREIGN KEY ("idMedioPago") REFERENCES "mediopago" ("idMedioPago")
);

CREATE TABLE "usuario" (
  "idusuario" int NOT NULL AUTO_INCREMENT,
  "idpersona" int NOT NULL,
  "idrol" int NOT NULL,
  "nombre" varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "password" varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "estado" int DEFAULT '1',
  "conexionReceptor" int NOT NULL,
  PRIMARY KEY ("idusuario"),
  KEY "idrol" ("idrol"),
  KEY "fk_usuario_persona" ("idpersona"),
  CONSTRAINT "fk_usuario_persona" FOREIGN KEY ("idpersona") REFERENCES "persona" ("idpersona"),
  CONSTRAINT "usuario_ibfk_1" FOREIGN KEY ("idrol") REFERENCES "rol" ("idrol")
);

CREATE TABLE "rol" (
  "idrol" int NOT NULL AUTO_INCREMENT,
  "nombre" varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "estado" int NOT NULL,
  PRIMARY KEY ("idrol")
);

CREATE TABLE "articulo" (
  "idarticulo" int NOT NULL AUTO_INCREMENT,
  "idcategoria" int NOT NULL,
  "codigo" varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  "nombre" varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "precio_venta" decimal(11,2) NOT NULL,
  "stock" int NOT NULL,
  "descripcion" text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  "imagen" varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "estado" int DEFAULT NULL,
  PRIMARY KEY ("idarticulo"),
  KEY "fk_articulo_categoria" ("idcategoria"),
  CONSTRAINT "articulo_ibfk_1" FOREIGN KEY ("idcategoria") REFERENCES "categoria" ("idcategoria")
);

CREATE TABLE "categoria" (
  "idcategoria" int NOT NULL AUTO_INCREMENT,
  "nombre" varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "estado" bit(1) DEFAULT b'1',
  PRIMARY KEY ("idcategoria"),
  UNIQUE KEY "nombre" ("nombre")
);

CREATE TABLE "chat" (
  "idmensaje" int NOT NULL AUTO_INCREMENT,
  "idusuario" int NOT NULL,
  "idrol" int NOT NULL,
  "nombre" varchar(100) NOT NULL,
  "mensaje" text NOT NULL,
  "fecha" datetime NOT NULL,
  "receptor" int NOT NULL,
  "estado" int NOT NULL,
  PRIMARY KEY ("idmensaje"),
  KEY "idrol" ("idrol"),
  KEY "idusuario" ("idusuario"),
  CONSTRAINT "chat_ibfk_1" FOREIGN KEY ("idrol") REFERENCES "rol" ("idrol"),
  CONSTRAINT "chat_ibfk_2" FOREIGN KEY ("idusuario") REFERENCES "usuario" ("idusuario")
);

CREATE TABLE "detalle_venta" (
  "iddetalle_venta" int NOT NULL AUTO_INCREMENT,
  "idventa" int NOT NULL,
  "idarticulo" int NOT NULL,
  "cantidad" int NOT NULL,
  "precio" decimal(11,2) NOT NULL,
  PRIMARY KEY ("iddetalle_venta"),
  KEY "FK_Articulo_DetalleVenta" ("idarticulo"),
  KEY "FK_Venta_DetalleVenta" ("idventa"),
  CONSTRAINT "FK_Venta_DetalleVenta" FOREIGN KEY ("idventa") REFERENCES "venta" ("idventa")
);

CREATE TABLE "mediopago" (
  "idMedioPago" int NOT NULL AUTO_INCREMENT,
  "nombre" varchar(100) NOT NULL,
  "tarjeta" int NOT NULL,
  "cvc" int NOT NULL,
  "fecha" varchar(20) NOT NULL,
  PRIMARY KEY ("idMedioPago")
);

CREATE TABLE "persona" (
  "idpersona" int NOT NULL AUTO_INCREMENT,
  "nombre" varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "apellido" varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "tipo_documento" varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "num_documento" varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "email" varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  "direccion" varchar(70) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  "telefono" varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY ("idpersona")
);

CREATE TABLE "personafacturacion" (
  "idFacturacion" int NOT NULL AUTO_INCREMENT,
  "nombre" varchar(150) NOT NULL,
  "apellido" varchar(150) NOT NULL,
  "email" varchar(150) NOT NULL,
  "direccion" varchar(200) NOT NULL,
  "telPrincipal" varchar(20) NOT NULL,
  "telOpcional" varchar(20) DEFAULT NULL,
  "region" varchar(50) NOT NULL,
  "barrio" varchar(50) NOT NULL,
  "postalCode" varchar(20) DEFAULT NULL,
  PRIMARY KEY ("idFacturacion")
);
