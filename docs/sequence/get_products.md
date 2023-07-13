```mermaid
sequenceDiagram
title Get the list of products

Client->>+API: GET /products

API->>API: Verify json web token

API->>Database: Get the list of products
Database-->>API: Returns datas

API-->>-Client: Return the list of products
```
