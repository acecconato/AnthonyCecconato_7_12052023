sequenceDiagram
title Generate login token

Client->>+API: POST /auth/login

API->>Database: Verify credentials

alt Correct credentials
    API->>API: Generate tokens
    API-->>Client: Return json web token and refresh token
else Wrong credentials
    API-->>-Client: 401 Unauthorized
end
