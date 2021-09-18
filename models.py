from flask_sqlalchemy import SQLAlchemy
import datetime
db = SQLAlchemy()
 
 
class imageModel(db.Model):
    __tablename__ = 'images'
    id = db.Column(db.VARCHAR(11), primary_key=True)
    unicodename = db.Column(db.VARCHAR(576, collation='utf8_unicode_ci'))
    extension = db.Column(db.VARCHAR(4))
    filename = db.Column(db.TEXT)
    date = db.Column(db.DateTime, default=datetime.datetime.now)

