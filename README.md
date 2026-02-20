# Mini-CRM

---

Mini-CRM is a system for collecting applications and obtaining statistics. Below is a complete launch instruction, an example of inserting a widget (iframe) and examples of using the API.

## 1. Installation and Startup

- **Cloning the repository:**

git clone https://github.com/DariiaSliusar/mini-crm.git && cd mini-crm

- **Installing PHP dependencies:**

composer install

- **Installing JS dependencies:**

npm install

- **Creating an .env file:**

cp .env.example .env

Edit the .env if necessary (e.g., configure a database connection).

- **Generating an application key:**

php artisan key:generate

- **Migrating and seeding the database:**

php artisan migrate --seed

- **Starting the server:**

php artisan serve

The server will be available at http://127.0.0.1:8000

- **Starting the frontend (Vite):**

npm run dev

---

## 2. Inserting a widget (iframe)

You can insert a widget into any page using an iframe:

<iframe src="http://127.0.0.1:8000/widget" width="100%" height="600" frameborder="0"></iframe>

---

## 3. API

- **Create a ticket**

POST /api/tickets

Content-Type: multipart/form-data

Parameters:
        name (string, required)
        email (string, email, required)
        phone (string, E.164, required)
        subject (string, required)
        message (string, required)
        file[] (array of files, optional, jpg/jpeg/png/pdf/doc/docx, max 10MB each)

Example cURL:

        curl -X POST http://127.0.0.1:8000/api/tickets \
        -F "name=John Doe" \
        -F "email=john@example.com" \
        -F "phone=+380501234567" \
        -F "subject=Support request" \
        -F "message=I need help with my account." \
        -F "file[]=@/path/to/file1.jpg" \
        -F "file[]=@/path/to/file2.pdf"
        
Successful response (201):
        Ticket created successfully

Validation error (422):
{
"message": "The given data was invalid.",
"errors": {
"email": ["The email must be a valid email address."]
}
}

---

- **Get ticket statistics**

GET /api/tickets/statistics

Example cURL:
    curl http://127.0.0.1:8000/api/tickets/statistics

Successful response (200):
    {
    "data": {
        "periodStatistics": {
            "last24Hours": 5,
            "last7Days": 23,
            "last30Days": 100
            },
        "totalTickets": 150,
        "generatedAt": "2026-02-20T12:34:56Z"
        }
    }
    
---

## 4. API documentation
More details in the swagger.yaml file.
    
---

## 5. Test Data (Admin Panel)
To test the manager functionality, use the following data:
- **URL:** `http://127.0.0.1:8000/login`
- **Email:** `manager@manager.com`
- **Password:** `password123`

*Note: This data is automatically generated when you run the `php artisan db:seed` command.*

## 6. License
This project is licensed under the MIT License.
