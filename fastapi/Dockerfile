FROM python:3.10

# Establece el directorio de trabajo en el contenedor
WORKDIR /app

# Copia los archivos de tu aplicación FastAPI al contenedor
COPY /app /app

COPY requirements.txt /app/requirements.txt

# Instala las dependencias de tu aplicación FastAPI
RUN pip install -r /app/requirements.txt

# Expone el puerto en el que se ejecutará tu aplicación FastAPI
EXPOSE 8000

# Comando para ejecutar tu aplicación FastAPI con auto-reload
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]