<p align="center"><img alt="orchestra" src="./src/Resources/public/img/orchestra.png" width="500"/></p>

<p align="center">
<b>Sleek symfony admin boilerplate</b>
</p>

<p align="center">
    <img src="https://github.com/suminagashi/orchestra/workflows/Build/badge.svg?branch=master" alt="Build">
    <a href="https://packagist.org/packages/suminagashi/orchestra"><img src="https://poser.pugx.org/suminagashi/orchestra/version" alt="Version"></a>
    <a href="https://packagist.org/packages/suminagashi/orchestra"><img src="https://poser.pugx.org/suminagashi/orchestra/downloads" alt="Total Download"></a>
    <a href="https://packagist.org/packages/suminagashi/orchestra"><img src="https://poser.pugx.org/suminagashi/orchestra/license" alt="License"></a>
</p>

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
```

### Usage :

- Orchestra provide 2 new annotations :
    - `@Resource` for class
    - `@Field` for properties
- The data validation use `Symfony\Component\Validator\Constraints` annotation


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
