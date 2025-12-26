## Installation

Build the image

```docker build -t sqli-lab .```


Run the container

```docker run -d -p 8083:80 --name sqli-challenge sqli-lab```


Verify
Access http://localhost:8083.