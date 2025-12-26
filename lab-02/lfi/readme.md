# LFI Lab: Dockerized CTF Challenge

A minimal, self-contained environment for practicing **Local File Inclusion (LFI)** exploitation.  
This container spins up a vulnerable PHP application with a hidden flag, designed strictly for **educational use and CTF training**.

---

## Overview

- **Vulnerability:** Unsanitized `include()` in PHP  
- **Objective:** Read the `/flag.txt` file located at the system root  
- **Port:** `8080` (default)

---

## Prerequisites

- Docker  
- A web browser or `curl`

---

## Installation

### Build the Image

Run the following command in the directory containing the `Dockerfile`:

```bash
docker build -t lfi-lab .
```

### Run the Container

Start the service on port `8080`:

```bash
docker run -d -p 8080:80 --name lfi-challenge lfi-lab
```

---

## Verify

Navigate to:

```
http://localhost:8080
```

You should see the **File Viewer** interface.

---

## Usage Guide

The application accepts a `page` parameter via **GET** requests.

### Standard Usage

```
http://localhost:8080/?page=about.php
```

### The Challenge

The application does **not validate user input** before passing it to the filesystem.  
Your goal is to traverse out of the web root (`/var/www/html`) and read the flag file located at:

```
/flag.txt
```

---

## Hints

- The application is running on a standard **Linux filesystem**
- `../` moves you up one directory
- PHP’s `include()` will:
  - Execute code if possible
  - Print file contents if execution is not possible

---

## Solution (Spoiler)

<details>
<summary>Click to view payload</summary>

Since the web root is typically `/var/www/html` (three levels deep), you need **at least 3 directory traversals** to reach the filesystem root.

### Payload

```
../../../../flag.txt
```

### Full URL

```
http://localhost:8080/?page=../../../../flag.txt
```

</details>

---

## Teardown

To stop the lab and clean up resources:

```bash
docker stop lfi-challenge
docker rm lfi-challenge

# Optional: remove the image
docker rmi lfi-lab
```

---

## Disclaimer

⚠️ **Intentional Vulnerabilities Ahead**

This software contains deliberate security flaws.  
**Do NOT** deploy this container on public-facing networks or production environments.
