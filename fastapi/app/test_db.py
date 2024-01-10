from database import DatabaseConnection

if __name__ == "__main__":
    # Configura la conexión a la base de datos
    host = "mariadb"
    user = "alumne"
    password = "alumne1234"
    database = "projectx"

    # Crea una instancia de DatabaseConnection
    db = DatabaseConnection(host, user, password, database)

    # Conecta a la base de datos
    db.connect()

    # Ejecuta una consulta de prueba
    query = "SELECT * FROM users"
    results = db.execute_query(query)

    # Muestra los resultados
    for row in results:
        print(row)

    # Desconecta de la base de datos
    db.disconnect()
