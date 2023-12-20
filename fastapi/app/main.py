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

# Carregar les variables d'entorn des de l'arxiu .env
load_dotenv()

# Configurar la URL de la API externa
url = "https://api.picanova.com/api/beta"

# Inicializar la aplicación FastAPI
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


# Obtener las variables de entorno (definides al arxiu .env)
SECRET_KEY = os.getenv("SECRET_KEY")
ALGORITHM = os.getenv("ALGORITHM")

# Configurar el esquema de autenticación OAuth2 con contraseña
oauth2_scheme = OAuth2PasswordBearer(tokenUrl="token")

# Definir las credenciales de la API externa (la de picanova) (també l'usem com a usuari y contrasenya propis, s'haurà de canviar)
external_api_user = "virtual-vision"
external_api_password = "2b8af5289aa93fc62eae989b4dcc9725"

# Codificar las credenciales en Base64 para el encabezado de autorización que haremos a picanova
encriptacio =  base64.b64encode(f"{external_api_user}:{external_api_password}".encode("utf-8")).decode("utf-8")
headerspica = {
    "Authorization": f"Basic {encriptacio}"
}

# Funciones auxiliares

# Función para generar un token JWT
def create_token(data: dict):
    return jwt.encode(data, SECRET_KEY, algorithm=ALGORITHM)

# Función para obtener el usuario actual a partir del token JWT 
def get_current_user(token: str = Depends(oauth2_scheme)):
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Invalid credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        # Decodificar el token y obtener la información del usuario
        payload = jwt.decode(token, SECRET_KEY, algorithms=[ALGORITHM])
        return payload
    except JWTError:
        # Capturar errores relacionados con el token
        raise credentials_exception
    
# Función para verificar las credenciales de usuario (usuario propio)
def verify_credentials(username: str, password: str):
    return username == external_api_user and password == external_api_password

# Definir la ruta para autenticar y obtener un token (ruta per obtenir token) les probes s'han de realitzar amb postman
@app.post("/token")
def login(username: str = Form(...), password: str = Form(...)):
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Invalid credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        # Verificar las credenciales proporcionadas
        if verify_credentials(username, password):
            # Credenciales válidas, generar un token
            data = {"sub": username}
            access_token = create_token(data)
            return {"access_token": access_token, "token_type": "bearer"} #retornar token en cas que estigue correcte
        else:
            # Credenciales inválidas, lanzar una excepción
            raise credentials_exception
    except Exception as e:
        # Capturar otros errores
        return {"message": f"Error: {str(e)}"}

# Definir la ruta para obtener productos (requiere autenticación)
@app.get("/products")
def get_products(current_user: dict = Depends(get_current_user)):
    try:
        # Realizar una solicitud a la API externa con el encabezado de autorización
        response = requests.get(url + "/products", headers=headerspica)
        
        if response.status_code == 200:
            # Si la solicitud es exitosa, devolver los productos
            products = response.json()
            return {"data": products}
        else:
            # Si la solicitud no es exitosa, devolver un mensaje de error
            return {"message": f"Error al obtener productos. Código de estado: {response.status_code}"}

    except Exception as e:
        # Capturar otros errores
        return {"message": f"Error: {str(e)}"}
    
class RequestData(BaseModel):
    topic: str

@app.post("/generateImages")
async def generateImages(request_data: RequestData):
    # API CALL
    # load_dotenv()
    # client = OpenAI()
    # topic = request_data.topic
    # response = client.images.generate(
    #     prompt=topic,
    #     n=3,
    #     size="256x256"
    # )

    # API RESPONSE SIMULATION
    response = {
        "created": 1699298517,
        "data": [
            {
                "url": "https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg?size=626&ext=jpg&ga=GA1.1.1880011253.1699833600&semt=sph"
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