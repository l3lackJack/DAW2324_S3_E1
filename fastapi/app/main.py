from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List
import mysql.connector
import requests



app = FastAPI()

# Definir el modelo de datos para un producto
class Image(BaseModel):
    id: int
    original: str
    thumb: str

class Producto(BaseModel):
    id: int
    name: str
    variants: int
    sku: str
    dpi: int
    type: str
    images: List[Image]

    class Config:
        orm_mode = True
    


api_url = "https://api.picanova.com/api/beta/products"
usuario = "customaize"
contrasena = "cfe994bf273c9d4eefcfc1c652e772ee"

# Función para obtener productos de la API (simulada)
def obtener_productos():
    # Simular una lista de productos
    try:
        # Hacer una solicitud GET a la API con autenticación básica
        response = requests.get(api_url, auth=(usuario, contrasena))
        response.raise_for_status()  # Lanza una excepción si la solicitud no fue exitosa

        # Mostrar la respuesta en formato JSON
        productos = response.json()
        print("Datos recuperados de la API:")

        return productos

    except requests.exceptions.RequestException as e:
        print(f"Error al hacer la solicitud a la API: {e}")


# Función para insertar productos en la base de datos
def insertar_en_base_de_datos(productos):
    try:
        # Conexión a mula base de datos
        conn = mysql.connector.connect(
            user="alumne",
            password="alumne1234",
            database="projectx",
            host = "localhost",
            port = "3306"
            )
        print("Conexion correcta")

        cursor = conn.cursor()

        cursor.execute("""DROP TABLE IF EXISTS productos""")
        cursor.execute("""DROP TABLE IF EXISTS imagenes""")
        print("Eliminando tablas")
        # Crear tabla de productos (ajusta según la estructura de tus productos)
        cursor.execute("""
            CREATE TABLE IF NOT EXISTS productos (
                id INTEGER PRIMARY KEY,
                name VARCHAR(255) NULL,
                price DOUBLE NULL,
                sku VARCHAR(255) NULL,
                type VARCHAR(255) NULL,
                variants INTEGER NULL,
                dpi INTEGER NULL
                )
        """)
        print("Create correcto")
        # Insertar productos en la tabla
        for producto in productos['data']:
            print(producto['id'], producto['name'], producto['sku'], producto['type'], producto['variants'], producto['dpi'])
            sql = "INSERT INTO productos(id, name, sku, type, variants, dpi) VALUES (%s, %s, %s, %s, %s, %s)"
            val = (producto['id'], producto['name'], producto['sku'], producto['type'], producto['variants'], producto['dpi'])
            cursor.execute(sql,val)

        # Confirmar los cambios
        conn.commit()

        # cursor.execute("""
        #     CREATE TABLE IF NOT EXISTS imagenes (
        #         id INTEGER PRIMARY KEY AUTO_INCREMENT,
        #         producto_id INT
        #         original VARCHAR(255),
        #         thumb VARCHAR(255)
        #         )
        # """)
        
        # for producto in productos:
        #     cursor.execute("""
        #         INSERT INTO imagenes (id, id_producto, original, thumb)
        #         VALUES (?, ?, ?, ?)
        #     """, (producto['images']['id'], producto['id'], producto['images']['thumb'], producto['images']['original']))
        
        conn.close()
        print("Productos insertados en la base de datos con éxito.")
    except Exception as e:
        print(f"Error al insertar productos en la base de datos: {e}")

# Ruta para obtener productos de la API y luego insertarlos en la base de datos
@app.get("/obtener_productos_y_guardar")
def obtener_productos_y_guardar():
    # Obtener productos de la API
    productos = obtener_productos()

    if productos:
        # Insertar productos en la base de datos
        insertar_en_base_de_datos(productos)
        return {"mensaje": "Productos obtenidos de la API e insertados en la base de datos con éxito."}
    else:
        raise HTTPException(status_code=500, detail="Error al obtener productos de la API.")

# Puedes ejecutar la aplicación con el siguiente comando
# uvicorn nombre_del_archivo:app --reload
