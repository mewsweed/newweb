from flask import Flask, request, send_file, render_template

app = Flask(__name__)

@app.route('/')
def upload_form():
    return render_template('upload.html')

@app.route('/upload', methods=['POST'])
def upload_file():
    if 'file' not in request.files:
        return 'No file part'
    
    file = request.files['file']
    
    if file.filename == '':
        return 'No selected file'
    
    return send_file(file.stream, mimetype='image/jpeg')

if __name__ == '__main__':
    app.run(debug=True)
