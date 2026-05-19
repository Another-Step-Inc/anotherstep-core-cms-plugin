# WordPress Core CMS Plugin

## 🧞 Commands

All commands are run where the `package.js` files are. Must run commands in a docker container.

There are two methods to run this project:

### Method 1: Run Docker in Powershell

```
docker run --rm -v "${PWD}:/app" -w /app node:20-alpine npm run build
```

```
docker run --rm -v "${PWD}:/app" -w /app node:20-alpine npm start
```

### Method 2: Run Docker Compose and Run in Docker Container

Start the containers.

```
docker compose up -d
```

Exec into the container just started. The name builder comes from the `docker-compose` file

```
docker compose exec builder sh
```

Once in the container, and have changes to the blocks directory, from /app/blocks which is the working directory.

```
npm run build
```