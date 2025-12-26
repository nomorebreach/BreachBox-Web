# BreachBox-Web

**BreachBox-Web** is a curated collection of **self-contained, Dockerized vulnerable web applications** built for CTF training and hands-on security education.

Each lab focuses on **one specific vulnerability**, intentionally stripped of unnecessary frameworks and distractions. The goal is simple: **learn exploitation by doing**, not by fighting boilerplate.

Repository: https://github.com/nomorebreach/BreachBox-Web

---

## 📦 What’s Inside

- Each challenge lives in its **own directory**
- Every lab includes:
  - A dedicated `Dockerfile`
  - A vulnerable web application
  - A `README.md` with setup instructions and objectives
- No shared dependencies. No cross-contamination. One lab = one vulnerability.

---

## 🚀 Quick Start

Clone the repository:

```bash
git clone https://github.com/nomorebreach/BreachBox-Web.git
cd BreachBox-Web
```

Navigate to any lab directory:

```bash
cd lfi-lab
```

Build and run the container:

```bash
docker build -t lfi-lab .
docker run -d -p 8080:80 lfi-lab
```

Access the challenge in your browser:

```
http://localhost:8080
```

👉 **Always follow the `README.md` inside each lab** for exact details, flags, and objectives.

---

## ⚠️ Legal Disclaimer

These applications are **intentionally vulnerable**.

- ❌ Do **NOT** deploy on public servers  
- ❌ Do **NOT** expose containers to the internet  
- ❌ Do **NOT** use against systems you don’t own or have permission to test  

This project is strictly for **educational and training purposes**.  
The author(s) take **no responsibility for misuse**.

---

## 🔐 About Us

BreachBox-Web is maintained by **NoMoreBreach** — a security-focused initiative aimed at practical learning through real-world vulnerabilities.

Learn more: https://nomorebreach.com
