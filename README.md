# PokemonAPI
An API base of the [Pokemon API](https://pokeapi.co/)

# Getting Started

To get started using the PokemonAPI, 

1. first you need to have install [XAMPP](https://www.apachefriends.org/es/download.html) with a PHP version of 8.0.14.

2. Make sure you have [Composer](https://getcomposer.org/download/) install in your machine.

3. Next clone the repository inside the htdocs file of the XAMPP folder.

4. Once the repository is set in the corresponding folder, in the terminal go to the api folder and execute the following command to get the composer dependencies of the project

```
php composer.phar update
```

5. Once that is set, open XAMPP and run the Apache server.

And with that, you are all set to starting working on the project, in a browser go to http://localhost/PokemonAPI so you can see the api.

# API Documentation

You can find API documention of the project with OpenApi at http://localhost/PokemonAPI created with swagger.

# Docker Image

There is a docker image of the project that you can download and execute in your local docker. You can view at [alexcg12/pokemon-api](https://hub.docker.com/r/alexcg12/pokemon-api)

# Testing

To start testing, open the terminal in the root of the project and execute the following command.

```
composer dump-autoload -o 
```

After that, you are ready to use PHPUnit and look at the testing by executing the following command in terminal at the root level of the project.

```
./vendor/bin/phpunit api/v1/tests 
```

# Troubleshooting

An issue that may occur at the moment of testing the API with PHPUnit in a mac, is that the computer might be using the PHP interpreter of the OS instead of XAMPP.

To solve this create a bash_profile

```
sudo nano ~/.bash_profile

```

And add the next lines to the file.

```
export XAMPP_HOME=/Applications/XAMPP
export PATH=${XAMPP_HOME}/bin:${PATH}
export PATH
```

Close the file and execute the following command.

```
source ~/.bash_profile
```

To confirm that you are using the correct interpreter execute the next command:

```
which php
```

You should see the path /Applications/XAMPP/bin/php
