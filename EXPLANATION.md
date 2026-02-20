# Explanation of Architectural Decisions

---

## 1. Architectural Patterns & SOLID Principles

The project strictly follows SOLID, MVC, KISS, DRY, and PSR-12 standards:

- **Service Layer (`TicketService`)**: All business logic (client creation, request binding, file processing) is moved from controllers to services. This ensures the Single Responsibility Principle (SRP) and keeps controllers thin.
- **FormRequests**: Input data validation is separated from request processing logic, avoiding code duplication and ensuring data validity before entering the service.
- **Eloquent Scopes**: Filtering by time intervals (day, week, month) is encapsulated in the `Ticket` model, making database queries clear and reusable in both API and admin panel.
- **API Resources**: Used to transform models into JSON responses, guaranteeing a stable API structure regardless of internal database changes.

---

## 2. Selection of Libraries & Tools

Industry-standard packages were chosen:

- **propaganistas/laravel-phone**: Professional phone number validation, ensuring E.164 compliance and checking number existence for different countries.
- **Spatie Laravel MediaLibrary**: Reliable file management, automatically handling file associations via polymorphic tables and simplifying upload/download of attachments.
- **Spatie Laravel Permission**: Flexible role management (admin/manager) and access protection for the administrative part.
- **Carbon**: Accurate calculations of time periods for statistics generation.

---

## 3. Implementation Features

- **Universal Widget**: A standalone Blade page (`/widget`) ready to be embedded via `<iframe>` on any site.
- **AJAX (REST API)**: Widget form submission uses `fetch` to the API endpoint `/api/tickets`, enabling page reload-free operation and proper validation error handling.
- **Spam Protection**: `withValidator` logic in FormRequest prohibits more than one request per day from a single email or phone number.
- **Admin Panel**: Built on Blade UI with real-time filtering. Managers can view request details, upload attached files, and change statuses.

---

## 4. Technical Details

- **PHP 8.4 & Laravel 12**: Latest versions used for maximum performance and security.
- **SQLite**: Chosen as the primary database for easy local startup and testing without deploying a full-fledged DB server.

---

