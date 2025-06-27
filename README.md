# Real-Time Orders

A modern Laravel application for real-time order management and tracking. This open-source project allows businesses to manage orders, track shipment statuses in real-time, and provide customers with up-to-date information about their purchases.

## Features

- **Real-time Order Tracking**: Monitor order status updates in real-time using Laravel Echo and Pusher
- **Order Management**: Create, view, and manage orders with associated products
- **Invoice Generation**: Automatically generate invoices for orders
- **User Authentication**: Secure user authentication and authorization
- **Responsive Dashboard**: Modern UI built with Tailwind CSS
- **Real-time Notifications**: Instant updates when order status changes

## Technologies Used

- **Backend**:
  - Laravel 12.0
  - PHP 8.2+
  - Laravel Livewire
  - Laravel Pulse
  - Laravel Reverb
  - Laravel Echo

- **Frontend**:
  - Tailwind CSS 4.0
  - Alpine.js
  - Livewire Flux
  - Livewire Volt

- **Real-time**:
  - Pusher
  - Laravel Echo

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL or another database supported by Laravel

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/real-time-orders.git
   cd real-time-orders
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create a copy of the environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=real_time_orders
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Configure Pusher for real-time functionality in the `.env` file:
   ```
   PUSHER_APP_ID=your-pusher-app-id
   PUSHER_APP_KEY=your-pusher-app-key
   PUSHER_APP_SECRET=your-pusher-app-secret
   PUSHER_HOST=
   PUSHER_PORT=443
   PUSHER_SCHEME=https
   PUSHER_APP_CLUSTER=your-pusher-cluster
   ```

8. Run database migrations:
   ```bash
   php artisan migrate
   ```

9. Seed the database (optional):
   ```bash
   php artisan db:seed
   ```

10. Build assets:
    ```bash
    npm run build
    ```

## Usage

1. Start the development server:
   ```bash
   php artisan serve
   ```

2. For real-time functionality, start the queue worker:
   ```bash
   php artisan queue:work
   ```

3. For development with hot reloading:
   ```bash
   npm run dev
   ```

4. Access the application at `http://localhost:8000`

## Development

You can use the built-in development script that starts the server, queue worker, and Vite:

```bash
composer dev
```

## Testing

Run the tests with:

```bash
composer test
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgements

- [Laravel](https://laravel.com)
- [Livewire](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Pusher](https://pusher.com)
