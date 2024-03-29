from flask import Flask

PORT = 8765
MESSAGE = "Hello World from PYTHON!"

app = Flask(__name__)

@app.route('/', defaults={'path': ''})
@app.route('/<path:path>')
def catch_all(path):
    result = MESSAGE.encode(encoding="utf-8")
    return result

if __name__ == "__main__":
    app.run(debug=True, host="0.0.0.0", port=PORT)
