import mysql.connector

class DatabaseConnection:
    def __init__(self, host, user, password, database):
        self.host = host
        self.user = user
        self.password = password
        self.database = database
        self.connection = None

    def connect(self):
        try:
            self.connection = mysql.connector.connect(
                host=self.host,
                user=self.user,
                password=self.password,
                database=self.database
            )
            print("La connexió ha tingut exit")
        except mysql.connector.Error as err:
            print(f"Error al connectar: {err}")

    def disconnect(self):
        if self.connection and self.connection.is_connected():
            self.connection.close()
            print("Connexió tancada.")

    def execute_query(self, query, values=None):
        if not self.connection or not self.connection.is_connected():
            print("No hi ha connexió.")
            return

        cursor = self.connection.cursor(dictionary=True)
        cursor.execute(query, values)
        result = cursor.fetchall()
        cursor.close()
        return result


