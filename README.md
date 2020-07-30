# orchestra
Sleek symfony admin boilerplate


Register the bundle :

`Suminagashi\OrchestraBundle\Orchestra::class => ['all' => true],`

Register the route :

`orchestra:
  resource: "@Orchestra/Controller/DefaultController.php"
  prefix: /
  type: annotation
`
