[![Build Status](https://travis-ci.org/WebChemistry/widgets.svg?branch=master)](https://travis-ci.org/WebChemistry/widgets)

## Installation
config.neon:
```yaml
extensions:
	widgets: WebChemistry\Widgets\DI\WidgetsExtension
```

## Registration
config.neon
```yaml
widgets:
	firstWidget: FirstWidget
	secondWidget: # With multiplier
		multiplier: yes
		class: SecondWidget
	thirdWidget: @third # As service
	
services:
	third: ThirdWidget
```

## Using
Presenter:
```php
class BasePresenter extends Nette\Application\UI\Presenter {
	use WebChemistry\Widgets\Traits\TPresenter;

}
```

Template:
```html
{widget firstWidget}
{widget secondWidget-1}
{widget secondWidget-2}
{widget thirdWidget}
```