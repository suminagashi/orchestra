# WIP: Orchestra

![orchestra](public/img/orchestra.png)

Sleek symfony admin boilerplate



## Install the bundle :

Register the bundle :

`Suminagashi\OrchestraBundle\Orchestra::class => ['all' => true],`

Register the route :

`orchestra:
  resource: "@Orchestra/Controller/DefaultController.php"
  prefix: /
  type: annotation
`
