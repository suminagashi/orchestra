<h1 style="text-align:center">Orchestra</h1>

![orchestra](public/img/orchestra.png)

**Sleek symfony admin boilerplate**


## Install the bundle :

> Flex recipe incoming...

### Register the bundle :

``` php
// config/bundles.php

return [
    ...
    Suminagashi\OrchestraBundle\OrchestraBundle::class => ['all' => true],
];
```

### Register the route :

``` yaml
// config/routes/orchestra.yaml

orchestra_admin:
  resource: "@OrchestraBundle/Resources/config/routes.xml"
  prefix: /admin

_orchestra_resources:
  resource: .
  type: orchestra
```

### Usage :

- Orchestra provide 2 new annotations : 
    - `@Resource` for class
    - `@Field` for properties
- The data validation is provided by `Symfony\Component\Validator\Constraints` annotation


### Examples :

``` php
// src/Entity/Dummy.php

<?php

namespace App\Entity;

use Suminagashi\OrchestraBundle\Annotation\Resource;
use Suminagashi\OrchestraBundle\Annotation\Field;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Resource(
 *  name="Dummy"
 * )
 */
class Dummy
{
    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     * @Field(label="Test")
     * @Assert\NotNull()
     */
    private $test;

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(string $test): self
    {
        $this->test = $test;

        return $this;
    }
}
```
