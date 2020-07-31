<h1 style="text-align:center">Orchestra</h1>

![orchestra](public/img/orchestra.png)

**Sleek symfony admin boilerplate**


## Install the bundle :

**Register the bundle :**

```
Suminagashi\OrchestraBundle\Orchestra::class => ['all' => true],
```

**Register the route :**

```
orchestra:
  resource: "@Orchestra/Controller/DefaultController.php"
  prefix: /orchestra
  type: annotation
```

**Register the services :**

```
Suminagashi\OrchestraBundle\Controller\OrchestraController:
  autoconfigure: true

Suminagashi\OrchestraBundle\Service\AnnotationParser:
  autowire: true

Suminagashi\OrchestraBundle\Service\EntityParser:
  autowire: true

Suminagashi\OrchestraBundle\Service\PropertyParser:
  autowire: true
```

**Examples :**

Orchestra provide 2 new annotations : `Resource & Fields`

The data validation is provided by `Symfony\Component\Validator\Constraints` annotation

Dummy.php example :

```
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
     *
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"read", "write"})
     *
     * @Field(label="Test")
     *
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
