# Mini-CRM
Mini-CRM is a system for collecting applications and obtaining statistics. Below is a complete launch instruction, an example of inserting a widget (iframe) and examples of using the API.

**Installation and Startup**

* Cloning the repository:

git clone https://github.com/DariiaSliusar/mini-crm.git && cd mini-crm

* Installing PHP dependencies:

composer install

* Installing JS dependencies:

npm install

* Creating an .env file:

cp .env.example .env

Edit the .env if necessary (e.g., configure a database connection).

* Generating an application key:

php artisan key:generate

* Migrating and seeding the database:

php artisan migrate --seed

* Starting the server:

php artisan serve

The server will be available at http://127.0.0.1:8000

* Starting the frontend (Vite):

npm run dev

**Inserting a widget (iframe)**

You can insert a widget into any page using an iframe:

<iframe src="http://127.0.0.1:8000/widget" width="100%" height="600" frameborder="0"></iframe>
