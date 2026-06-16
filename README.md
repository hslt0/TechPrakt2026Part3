Generated documents:

[Symfony](generated_open_api_docs/symfony_openapi.json)

[Laravel](generated_open_api_docs/laravel_openapi.json)

Prompt:

Act as an experienced system architect and API designer. Write a detailed, valid, and fully completed OpenAPI 3.0 specification document in JSON format for {name of your API or service}.

Analyze the provided controller code below to understand the available endpoints, routes, HTTP methods, request bodies, and parameters before writing the specification.

The specification must include the following sections and rules:

1. General Information (info):
    - API Name: {Name}
    - Version: 1.0.0
    - Description: {Short description of what this service does}

2. Servers (servers):
    - Add a local development URL (http://localhost:{port}/api/videos) and a production URL.

3. Authorization:
    - Do not include any security schemes or authorization requirements. This API currently has no authentication.

4. Endpoints (paths):
    - Generate detailed descriptions for all the routes and HTTP methods found in the provided controller code.

5. Endpoint Details:
    - Ensure "summary", "description", and "operationId" are provided for each route.
    - For query, path, and request body parameters, explicitly define the data type (string, integer, uuid), format, and whether they are required based on the controller method signatures.
    - Define response types for each request: successful (200 OK or 201 Created) and errors (400 Bad Request, 404 Not Found, 500 Internal Server Error).

6. Data Models (components/schemas):
    - Move all data structures (requests and responses) into separate schemas under components.
    - Add validation properties for each field in the schemas (e.g., minLength/maxLength or format for strings; minimum/maximum for integers; enum values where applicable).
    - Provide realistic examples for each field or the entire schema object.

Important: Ensure the JSON is strictly valid (all brackets closed, no trailing commas, adhering to the RFC 8259 standard). Do not include any comments or placeholders like "... etc.". Write the complete document from scratch so it can be saved as a .json file and imported into Postman without any parsing errors. Provide your response strictly as a JSON code block.

Here is the controller code to analyze:
{Paste your controller code here}