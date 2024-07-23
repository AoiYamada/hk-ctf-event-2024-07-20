import uuid
from urllib.request import urlopen
from flask import Flask, render_template, request

SECRET_KEY = str(uuid.uuid4())

app = Flask(__name__)
app.config.update(dict(
    SECRET_KEY=SECRET_KEY,
))


@app.route('/', methods=['GET'])
def index():
    return render_template("index.html")


@app.route('/api/ConnectTest', methods=["GET", 'POST'])
def ConnectTest():
    url = request.args.get('url', "http://baidu.com/")
    if "127.0.0.1" in url:
        return "Forbidden"
    return urlopen(url).read()


if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=False, port=8888)
