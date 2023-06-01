```mermaid
sequenceDiagram
title Get users linked to a client

Client->>+API: GET /clients/{ulid}/users

API->>API: Verify json web token

API->>Database: Get the users linked to the user
Database-->>API: Return users 

API-->>-Client: Return json containing the users
```
