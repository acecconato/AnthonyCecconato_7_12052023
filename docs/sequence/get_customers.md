sequenceDiagram
title Get registered users linked to a customer

Client->>+API: GET /users/{ulid}/customers

API->>API: Verify json web token

API->>Database: Get the customers linked to the user

API-->>-Client: Return customers linked to the user
