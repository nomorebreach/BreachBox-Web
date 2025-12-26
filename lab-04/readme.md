## Build the image

```docker build -t upload-lab .
```

## Run the container
```docker run -d -p 8082:80 --name upload-challenge upload-lab
```

Verify Access http://localhost:8082.

