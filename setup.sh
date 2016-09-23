sqlite3 db.sq3 "DROP TABLE IF EXISTS items"

sqlite3 db.sq3 "CREATE TABLE items (
  id INTEGER PRIMARY KEY NOT NULL,
  name CHAR(50) NOT NULL,
  quality INTEGER NOT NULL,
  sell_in INTEGER NOT NULL
);"
