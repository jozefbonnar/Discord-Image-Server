# -*- coding: UTF-8 -*-
from flask import Flask, request, json, render_template
from PIL import Image
import random
import string
import os
from os.path import splitext
import secrets
import datetime
from werkzeug.utils import send_from_directory
from models import imageModel,db
storage_folder = 'static'
secret_key = 'SECRET'
allowed_extension = ['.png', '.jpeg', '.jpg']
app = Flask(__name__, static_folder='static')
appurl = "https://DOMAIN.COM/"

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://USERNAME:PASSWORD@HOST:PORT/DATABASE?use_unicode=1&charset=utf8'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db.init_app(app)

@app.before_first_request
def create_all():
    db.create_all()

@app.route('/<string:IMAGE_ID>', methods=['GET'])
def index(IMAGE_ID):
    imageid = db.session.query(imageModel).filter(imageModel.unicodename.op('regexp')(IMAGE_ID)).first()
    if imageid:
        return render_template("index.html", imageid=imageid)
    imageid = imageModel.query.filter_by(id=IMAGE_ID).first()
    if imageid:
        return render_template("index.html", imageid=imageid)


    return "Image not found"




@app.route('/upload', methods=['POST'])
def upload():
    if request.method == 'POST':
        if request.form.to_dict(flat=False)['secret_key'][0] == secret_key:
            '''Get file object from POST request, extract and define needed variables for future use.'''
            file = request.files['image']
            extension = splitext(file.filename)[1]
            file.flush()
            size = os.fstat(file.fileno()).st_size
            '''Check for file extension and file size.'''
            if extension not in allowed_extension:
                return 'File type is not supported', 415

            elif size > 6000000:
                return 'File size too large', 400

            else:
                '''Remove metadata of the file.'''
                image = Image.open(file)
                data = list(image.getdata())
                file_without_exif = Image.new(image.mode, image.size)
                file_without_exif.putdata(data)

                '''Save the image with a new randomly generated filename in the desired path, and return URL info.'''
                char_set = "\u200c\u200b"
                random_name = secrets.token_urlsafe(5).lower()
                while os.path.isfile(os.path.join(storage_folder, random_name + extension)) == True:
                    random_name = secrets.token_urlsafe(5).lower()
                filename = ''.join(random.sample(char_set*64, 64))
                while db.session.query(imageModel).filter(imageModel.unicodename.op('regexp')(filename)).first():
                    filename = ''.join(random.sample(char_set*64, 64))

                user = imageModel(id=random_name, unicodename=filename, extension=extension, filename=file.filename)
                db.session.add(user)
                db.session.commit()
                
                filename.encode("utf-8")
                file_without_exif.save(os.path.join(storage_folder, random_name + extension))
                #fakeurl = f"<https://test.uk>||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||{appurl + random_name}"
                return json.dumps({"filename": appurl + filename, "extension": extension}), 200

        else:
            return 'Unauthorized use', 401


if __name__ == '__main__':
    app.run(host="0.0.0.0", port=8081)