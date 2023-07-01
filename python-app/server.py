from flask import Flask

PORT = 8765
MESSAGE = "Hello World from PYTHON!"

app = Flask(__name__)

@app.route("/")
def root():
    result = MESSAGE.encode(encoding="utf-8")
    return result

if __name__ == "__main__":
    app.run(debug=True, host="0.0.0.0", port=PORT)
