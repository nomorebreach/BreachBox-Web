## Build the Image
Hint: RCE
Run this command in the same directory as your Dockerfile:

```bash
docker build -t lab03
```

2. Run the Container
This maps port 80 inside the container to port 8080 on your machine (you can change 8080 to any open port):

```bash
docker run -d -p 8080:80 --name rce-container lab03
```