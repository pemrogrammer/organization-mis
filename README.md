# MIS Organization

Is a web based management information system app for managing an organization.

## Main Features

Manage:

- Member
- Recruitments
- Accounting
- Presences
- in-out letters
- Files

## Tech

- Laravel v8.x ([documentation](https://laravel.com/docs/8.x))
- Bootstrap v5.2 ([documentation](https://getbootstrap.com/docs/5.2/getting-started/introduction/))

## Deployment

1. Clone this repository.
2. Create `.env` file based on `.env.example` file. (create a new database if it's nessesary)
3. run `composer install` on terminal.
4. run `php artisan key:generate` on terminal.
5. run `php artisan migrate` on terminal.
6. run `php artisan serve` on terminal.
7. open browser then go to `[domain]/initialize-app` (example: `http://localhost:8000/initialize-app`) for initializing this app.

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

## License

The code is released under the MIT license.

## Contact

Email - [pemrogrammer@gmail.com](mailto:pemrogrammer@gmail.com?subject=[GitHub]%20Organization%20MIS)
