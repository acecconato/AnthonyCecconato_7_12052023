sequenceDiagram
title Get the details of a registered user linked to a customer

Client->>+API: GET /users/{ulid}/customers/{customer_ulid}

API->>API: Verify json web token

API->>Database: Get the customer details

API-->>-Client: Return the customer details
