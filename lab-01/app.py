from flask import Flask, request, render_template_string

app = Flask(__name__)

messages = []  # In‑memory storage (resets on restart)

TEMPLATE = """
<!DOCTYPE html>
<html>
<head>
    <title>XSS CTF - Message Board</title>
</head>
<body>
    <h2>Simple XSS Challenge</h2>
    <p>Submit a message. It will appear below.</p>

    <form method="POST">
        <input type="text" name="msg" placeholder="Enter message" style="width:300px;">
        <button type="submit">Submit</button>
    </form>

    <h3>Messages</h3>
    <ul>
        {% for m in messages %}
            <li>{{ m|safe }}</li>   <!-- VULNERABLE on purpose -->
        {% endfor %}
    </ul>

    <hr>
    <p><b>Goal:</b> Trigger an alert box using XSS.</p>
</body>
</html>
"""

@app.route("/", methods=["GET", "POST"])
def index():
    if request.method == "POST":
        msg = request.form.get("msg", "")
        messages.append(msg)  # No sanitization — intended
    return render_template_string(TEMPLATE, messages=messages)

if __name__ == "__main__":
    app.run(debug=True, host="0.0.0.0", port=5000)
