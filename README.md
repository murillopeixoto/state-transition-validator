# State Transition Validator
## Start the application
`docker-compose up -d`
## Validate the Transition
`docker-compose exec php php app/bin/console New Active`
## Run the tests
`docker-compose exec php php app/vendor/bin/phpunit -c app/phpunit.dist.xml app/tests`