from typing import Union
import base64
import requests
from fastapi import FastAPI, Depends, HTTPException, status
from jwt import jwt
from fastapi.security import OAuth2PasswordBearer 
from dotenv import load_dotenv
import os
from fastapi import Form
from fastapi.middleware.cors import CORSMiddleware
from openai import OpenAI
from pydantic import BaseModel
from openai import OpenAI
# Carregar les variables d'entorn des de l'arxiu .env
load_dotenv()

app = FastAPI()



origins = [
    "http://php-apache:8003",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

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

        cursor = conn.cursor()

        cursor.execute("""DROP TABLE IF EXISTS productos""")
        cursor.execute("""DROP TABLE IF EXISTS imagenes""")
        # Crear tabla de productos (ajusta según la estructura de tus productos)
        cursor.execute("""
            CREATE TABLE IF NOT EXISTS productos (
                id INTEGER PRIMARY KEY,
                name VARCHAR(255) NULL,
                price DOUBLE NULL,
                description VARCHAR(255) NULL,
                sku VARCHAR(255) NULL,
                type VARCHAR(255) NULL,
                variants INTEGER NULL,
                dpi INTEGER NULL
                )
        """)
        # Insertar productos en la tabla
        for producto in productos['data']:
            sql = "INSERT INTO productos(id, name, sku, type, variants, dpi) VALUES (%s, %s, %s, %s, %s, %s)"
            val = (producto['id'], producto['name'], producto['sku'], producto['type'], producto['variants'], producto['dpi'])
            cursor.execute(sql,val)
       
        # Confirmar los cambios
        conn.commit()

        cursor.execute("""
            CREATE TABLE IF NOT EXISTS imagenes (
                id INTEGER PRIMARY KEY,
                producto_id INT,
                original VARCHAR(255),
                thumb VARCHAR(255)
                )
        """)
        for producto in productos['data']:
            sql = "INSERT INTO imagenes (id, producto_id, original, thumb) VALUES (%s, %s, %s, %s)"
            val = (producto['images'][0]['id'], producto['id'], producto['images'][0]['thumb'], producto['images'][0]['original'])
            cursor.execute(sql,val)
        
        conn.commit()

        conn.close()
        print("Productos insertados en la base de datos con éxito.")
    except Exception as e:
        print(f"Error al insertar productos en la base de datos: {e}")




# Class para el body de la request
class RequestData(BaseModel):
    topic: str

# Funcion que recibe un topic y devuelve 3 imagenes generadas por la API de OpenAI
@app.post("/generateImages")
async def generateImages(request_data: RequestData):
    # API CALL
    try:
        client = OpenAI()
        topic = request_data.topic
        response = client.images.generate(
            prompt=topic,
            n=3,
            size="256x256"
        )

        image_urls = [image.url for image in response.data]
        print(image_urls)
        return image_urls

    except Exception as e:
    # API RESPONSE SIMULATION
        print(e)
        response = {
            "created": 1699298517,
            "data": [
                {
                    "url": "data:image/jpeg;base64,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"
                },
                {
                    "url": "https://img.freepik.com/premium-photo/mountain-lake-with-mountain-background_931553-20878.jpg?size=626&ext=jpg&ga=GA1.1.1826414947.1699228800&semt=sph"
                },
                {
                    "url": "https://cdn.pixabay.com/photo/2015/04/19/08/32/rose-729509_640.jpg"
                }
            ]
        }
    return response["data"]


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