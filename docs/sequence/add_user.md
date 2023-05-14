sequenceDiagram
title Get the details of a registered user linked to a customer

Client->>+API: POST /users/{ulid}/customers

API->>API: Verify json web token
API->>API: Validate datas sent

API->>Database: Add a new customer

API-->>-Client: 201 Created
