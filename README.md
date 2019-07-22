Thanks for taking interest to this project. It is a student work from my learn at Wild Code School. 

The purpose of this application is to manage your own library. 
The site is developed for mobile use only.

I hope you'll enjoy it !

## Getting Started

### Prerequisites

1. Check that `composer` is installed
2. Check that `yarn` & `node` are installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`

### Development

1. Run `yarn run dev --watch` to launch the asset compiler server
2. Run `php bin/console server:run` to launch your local php web server

## Deployment

1. Install the project
2. Copy the `.env` file and paste it as `.env.local` 
Find the line: `db_user:db_password@127.0.0.1:3306/db_name`. 
Replace `db_user` with the user of the database. 
Replace `db_password` with the password of the user of the database. 
Replace `db_name` with your choice of name for the database. 
3. Run `php bin/console doctrine:database:create`
4. Run `php bin/console doctrine:schema:update --force`
5. Run `php bin/console doctrine:migrations:migrate` this will INSERT the minimum of data needed to make the database work
6. Run the command `yarn encore prod`
7. Use the application

## Built With

* [Symfony](https://github.com/symfony/symfony)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

v1.0

## Author

Wild Code School student:
Julien Rousseau


## License

MIT License

Copyright (c) 2019 aurelien@wildcodeschool.fr

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

