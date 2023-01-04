
# Deezer notification test

This is a mini test

## Run Locally

Clone the project

```bash
  git clone https://github.com/jasserYahyaoui/notification
```

Go to the project directory

```bash
  cd notification
```

run docker

```bash
  docker-compose build --no-cache
  docker-compose up -d
```

Access to symfony project

```bash
  http://deezer.localhost/
```
Access to database deezer

```bash
  http://localhost:8080/
```
Access kibana to check logs

```bash
  http://localhost:81/app/logs/stream
```

## API Reference

#### Browse all of my notifications, sorted from the newest to the oldest

```http
  GET /api/notification/user/{userId}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `userId`  | `string` | **Required**. Id of user must be a number |

#### know how many notifications I have in my notification center, and how many of them are unread

```http
  GET /api/stat/notification/user/{userId}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `userId`  | `string` | **Required**. Id of user must be a number |


#### Know whether a notification is read or unread

```http
  GET /api/check/notification/{notificationId}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `notificationId`  | `string` | **Required**. Id of notification must be a number |


#### Mark a notification as Read (from false to true)

```http
  GET /api/read/notification/{notificationId
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `notificationId`  | `string` | **Required**. Id of notification must be a number |

## BDD Schema

![alt text](https://github.com/jasserYahyaoui/notification/blob/master/bdd.png?raw=true)


## SQL DUMP

https://github.com/jasserYahyaoui/notification/blob/master/deezer.sql

