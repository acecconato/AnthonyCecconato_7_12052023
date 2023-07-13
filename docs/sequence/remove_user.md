```mermaid
sequenceDiagram
title Delete a user

Client->>+API: DELETE /users/{user_ulid}

API->>API: Verify json web token

API->>Database: Delete user

API-->>-Client: 204 No Content
```
