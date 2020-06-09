# Backend Case Study

1. [Installation](#installation)  
2. [Usage](#usage)  
3. [Save Tasks To Database](#saving-tasks-to-database)  

## Installation

```bash
$ git clone https://github.com/oguz-yilmaz/Backend-Case-Study.git
$ cd docker
$ docker-compose build
$ docker-compose exec php php bin/console doctrine:migrations:migrate
$ docker-compose exec php composer install
```

if you get version error here when you try to install dependencies via composer, then please try to use your local composer installation to 
install dependencies, like:

```bash
$ cd case_study

#locally installed in your PC
$ composer install
```

Or the one comes with the `git clone`. 
```bash 
$ cd case_study
$ cp ../composer.phar ./composer
$ php composer install
```

Either way, you need an local php installation.  
After installation you can go ahead and run the [command](#saving-tasks-to-database) to save tasks to database and eventually have them appear at the homepage.
## Usage

### Option 1

**Using  Classes Directly**:  
There are 3 things you need to define in provider classes.  
* Provider Name
* Provider API Endpoint
* The `parse()` method: defines how endpoint output should be parsed
```php
use App\Service\Todo\Node;
use App\Service\Todo\Providers\AbstractProvider;

class CustomProvider extends AbstractProvider {

	protected $name = "my_provider";
	protected $endpoint = "http://provider.tasks.url";

	public function parse( $data ): Node {
		$node = new Node();
		$node->setId( $data->id );
		$node->setDuration( $data->sure );
		$node->setDifficultyLevel( $data->zorluk );

		return $node;
	}

}

$todo = new Todo();

$myProvider = new CustomProvider();
$results = $todo->addProvider($myProvider)
                ->parse();
```

You can also use `setName()` to set the name of the provider and `constructor` of the Provider class to set endpoint. An example is shown below:  
```php
$myProvider = new CustomProvider('http://custom.endpoint');
$myProvider->setName('my_provider');
```
### Option 2

**To Save Tasks To Database Directly:**  
If you want to add new provider and save it to database, you can add custom provider class directly
under `src/Service/Todo/Providers/Concrete` folder.   

After adding the class, there is no need for additional initialization
to save data from the provider to database. You can simple run the [command](#saving-tasks-to-database) afterwards.

## Saving Tasks To Database

cd into the **docker** folder then run the following command

```bash
docker-compose exec php php bin/console todo:save
```

