# 🧪 XSS Message Board — CTF Challenge

A simple, intentionally vulnerable **Flask-based web application** designed to teach and practice **Cross-Site Scripting (XSS)**.  
This challenge is ideal for beginners learning client-side attacks or for CTFs focusing on web exploitation.

---

## 🚀 Overview

This application stores and displays user-submitted messages **without any sanitization**.  
Your goal as an attacker is simple:

> **Trigger a JavaScript alert box using an XSS payload.**

If you can do that, you successfully complete the challenge!

---

## 📂 Project Structure

```
/xss-ctf
 ├── app.py
 └── README.md
```

---

## ⚙️ Setup Instructions

### **1️⃣ Install Dependencies**

Make sure you have **Python 3.7+** installed, then run:

```bash
pip install flask
```

### **2️⃣ Run the Application**

```bash
python app.py
```

By default, the web app will start at:

```
http://localhost:5000
```

### **3️⃣ Optional: Run on a Public Network**

To expose it to your LAN (for friends/CTF participants):

```bash
python app.py --host 0.0.0.0 --port 5000
```

Or modify:

```python
app.run(debug=True, host="0.0.0.0", port=5000)
```

---

# 🕹️ Challenge Details

## 🎯 **Goal**
Submit a payload that triggers:

```
alert(1)
```

If you see a popup, you solved the challenge.

---

## 🧩 **The Vulnerability**

Inside `app.py`, user input is rendered like this:

```python
{{ m|safe }}
```

`|safe` tells Flask/Jinja2 **not to escape HTML**, making the app vulnerable to **Stored XSS**.

---

## 💣 Example Payloads

### **Basic**
```
<script>alert(1)</script>
```

### **Onerror XSS**
```
<img src=x onerror=alert('XSS')>
```

### **SVG Payload**
```
<svg/onload=alert('pwned')>
```

### **Event Handler**
```
<div onclick="alert(1337)">Click me</div>
```
 

# 🛡️ Disclaimer

This app is **intentionally vulnerable** and must only be used for security learning, research, or CTF competitions.  
**Never deploy in production.**

---

Happy hacking! 🔥

