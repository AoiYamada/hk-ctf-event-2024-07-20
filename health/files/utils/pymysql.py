import pymysql

class Database:
    _instance = None

    def __new__(cls, *args, **kwargs):
        if cls._instance is None:
            cls._instance = super(Database, cls).__new__(cls)
            cls._instance.conn = None
            cls._instance.cursor = None
            cls._instance.connect()
        return cls._instance

    def connect(self):
        if self.conn is None:
            self.conn = pymysql.connect(host='127.0.0.1', user='rdg', password='123456', db='healthy')
            self.cursor = self.conn.cursor()

    def close(self):
        if self.conn:
            self.cursor.close()
            self.conn.close()

    def query(self, query, params=None):
        try:
            self.connect()
            self.cursor.execute(query, params)
            result = self.cursor.fetchall()
            return result
        except Exception as e:
            self.conn.rollback()
            raise e
        finally:
            self.conn.commit()

    def insert(self, query, params=None):
        try:
            self.connect()
            self.cursor.execute(query, params)
        except Exception as e:
            self.conn.rollback()
            raise e
        finally:
            self.conn.commit()

    def update(self, query, params=None):
        try:
            self.connect()
            self.cursor.execute(query, params)
        except Exception as e:
            self.conn.rollback()
            raise e
        finally:
            self.conn.commit()
