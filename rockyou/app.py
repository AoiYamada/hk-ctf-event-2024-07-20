import uuid

from flask import Flask, render_template, request, jsonify

SECRET_KEY = str(uuid.uuid4())

app = Flask(__name__)
app.config.update(dict(
    SECRET_KEY=SECRET_KEY,
))

users = {"admin": {"password": "Super_123StrongPassword123!", "flag": "flag{f5426a1f-edf3-4a43-bb7e-d6530a158eb5}"}}


@app.route('/', methods=['GET'])
def index():
    return render_template("index.html")


@app.route('/login', methods=['POST'])
def login():
    username = request.form.get('username')
    password = request.form.get('password')

    if not username or not password:
        return jsonify({'message': 'Username and password are required'}), 400

    user = users.get(username)
    if user and user.get("password") == password:
        return open('./app.py').read()
    else:
        return jsonify({'message': 'Invalid username or password'}), 401


if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=False, port=8888)