# Fuel Receipts storage, Model-View-Controller (MVC) Project

## Description

The Fuel Receipts Management System is a simple web application built using the Model-View-Controller (MVC) architecture in vanilla PHP. It allows users to manage fuel receipts, including creating, updating, and deleting entries.

## Features

- Using Model-View-Controller (MVC) approach.
- Create, update, and delete fuel receipts.
- Database connectivity using PDO (PHP Data Objects) for MySQL databases
- Model management implemented with automatic management of timestamps.
- View a filtered list of fuel receipts.

## Getting Started

1. **Clone the Repository**: Clone this repository to your local machine using Git (read-only).

    ```shell
    git clone https://github.com/Citadaskola-2023/Roberts-Degvielas_ceki.git
    ```
   
2. **Development domains**: Add development domains to local environment

    ```shell
    echo "127.0.0.1    phpmyadmin.fuel.local fuel.local" >> /etc/hosts
    ```

3. **Set Up Environment Variables**: Copy the `.env.example` file to `.env` and update the database configuration settings.

4. **Install Dependencies**: Install project dependencies using Composer.

    ```shell
    docker run --rm --interactive --tty \
    --volume /$PWD:/app \
    composer install
    ```

5. **Start the Development Server**: Start the PHP and mysql containers.

    ```shell
    docker compose up -d
    ```

6. **Database Migration**: Create the necessary database tables by running migrations.

    ```shell
    ./migrate.sh
    ```

7. **Access the Application**: Open your web browser and navigate to `https://fuel.local` to access the application.

## Usage
- Register for a new account or log in if you already have one.
- Once logged in, navigate to the fuel receipts section.
- Create new fuel receipts by providing the necessary details (e.g., license plate, date, odometer reading, etc.).
- View, update, or delete existing fuel receipts as needed.
- Log out when finished.

## For Developers

- **Creating Models**: Extend the base `Model` class for your models and define table names and field properties as needed.
- **Defining Routes**: Define routes in the `public/index.php` file to map HTTP requests to controller methods.
- **Implementing Controllers**: Create controller files to handle incoming requests, interact with models, and return responses.
- **Creating Views**: Create view files in the `views` directory to render HTML content.

## License

This project is licensed under the Unlicense - see the [LICENSE](LICENSE) file for details.
