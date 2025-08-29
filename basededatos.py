import sqlite3

conexion = sqlite3.connect("refistros")
cursor = conexion.cursor()

cursor.execute("""CREATE TABLE IF NOT EXISTS usuario(
id_pesona INTEGER PRIMARY KEY,
nombre TEXT,
apellido TEXT
)""")

