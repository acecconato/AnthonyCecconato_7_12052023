sequenceDiagram
title Get the details of a registered user linked to a customer

Client->>+API: DELETE /users/{ulid}/customers/{customer_ulid}

API->>API: Verify json web token

API->>Database: Delete user

API-->>-Client: 204 No Content
