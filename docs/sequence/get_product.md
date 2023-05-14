sequenceDiagram
title Get the details of a product

Client->>+API: GET /products/{ulid}

API->>API: Verify json web token

API->>Database: Get the details of the product

API-->>-Client: Return the details of the product
