## Decisions

- Since this was code agnostic I just went with Laravel for speed.

- Since the spec is suggestions I might use JSON for data, I'm assuming Postgres triggers are not the intended way of
handling derivate data. I prefer to keep business logic at application level, so we are handling **total_duration** and **total_time** that way.

- API shouldn't be responsible for formatting money. To avoid rounding errors all money are store in cents, same way Stripe does it. Front end should be responsible for formatting. So US150,25 is just stored as 15025.

- Spec didn't mention API authentication, so I decided to go with a simple token based auth.

- I TDD the process so it would server as a documentation and also a means of easier assessment of what I did.

- I struggled a little bit trying to decide if I was gonna go with a more idiomatic API design (ie: *POST medspas/{id}/services*), but decided to go with a top level approach for consistency sake. Hitting *GET medspas/{id}/services/{id}* instead of *GET services/{id}* is too cumbersome.

## How to run

- Make sure you have [Composer](https://getcomposer.org/) installed.
- Make sure your PHP version is at least 8.2
- On the project root directory run ```composer install```
- To run tests, run ```php artisan test```

If you wish to actually run the API: 

- Make sure you copy **.env.example** to **.env**
- Run ```php artisan migrate```
- Run ```php artisan serve```
- Add a user to the database (password is Bcrypt hashed)
- Hit /api/v1/login to retrieve your token
- Hit the rest of the API using the token on your Authorization header