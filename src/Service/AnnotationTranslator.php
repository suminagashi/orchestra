<?php

namespace Suminagashi\OrchestraBundle\Service;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * Load entities & call Annotation & Property parser
 */
class AnnotationTranslator
{

    const ASSERTS = [
        'Symfony\Component\Validator\Constraints\NotBlank' => ['message'],
        'Symfony\Component\Validator\Constraints\Blank' => ['message'],
        'Symfony\Component\Validator\Constraints\NotNull' => ['message'],
        'Symfony\Component\Validator\Constraints\IsNull' => ['message'],
        'Symfony\Component\Validator\Constraints\IsTrue'=> ['message'],
        'Symfony\Component\Validator\Constraints\IsFalse' => ['message'],
        'Symfony\Component\Validator\Constraints\Email' => ['message'],
        'Symfony\Component\Validator\Constraints\ExpressionLanguageSyntax' => ['message'],
        'Symfony\Component\Validator\Constraints\Length' => ['min', 'max', 'maxMessage', 'minMessage'],
        'Symfony\Component\Validator\Constraints\Url' => ['message'],
        'Symfony\Component\Validator\Constraints\Regex' => ['message'],
        'Symfony\Component\Validator\Constraints\Hostname' => ['message'],
        'Symfony\Component\Validator\Constraints\Ip',
        'Symfony\Component\Validator\Constraints\Json',
        'Symfony\Component\Validator\Constraints\Uuid',
        'Symfony\Component\Security\Core\Validator\Constraints\UserPassword',
        'Symfony\Component\Validator\Constraints\NotCompromisedPassword',
        'Symfony\Component\Validator\Constraints\EqualTo',
        'Symfony\Component\Validator\Constraints\NotEqualTo',
        'Symfony\Component\Validator\Constraints\IdenticalTo',
        'Symfony\Component\Validator\Constraints\NotIdenticalTo',
        'Symfony\Component\Validator\Constraints\LessThan',
        'Symfony\Component\Validator\Constraints\LessThanOrEqual',
        'Symfony\Component\Validator\Constraints\GreaterThan',
        'Symfony\Component\Validator\Constraints\GreaterThanOrEqual',
        'Symfony\Component\Validator\Constraints\Range',
        'Symfony\Component\Validator\Constraints\DivisibleBy',
        'Symfony\Component\Validator\Constraints\Unique',
        'Symfony\Component\Validator\Constraints\Positive',
        'Symfony\Component\Validator\Constraints\PositiveOrZero',
        'Symfony\Component\Validator\Constraints\Negative',
        'Symfony\Component\Validator\Constraints\NegativeOrZero',
        'Symfony\Component\Validator\Constraints\Date',
        'Symfony\Component\Validator\Constraints\DateTime',
        'Symfony\Component\Validator\Constraints\Time',
        'Symfony\Component\Validator\Constraints\Timezone',
        'Symfony\Component\Validator\Constraints\Choice' => ['message', 'choices', 'multipleMessage','minMessage','maxMessage'],
        'Symfony\Component\Validator\Constraints\Language',
        'Symfony\Component\Validator\Constraints\Locale',
        'Symfony\Component\Validator\Constraints\Country',
        'Symfony\Component\Validator\Constraints\File',
        'Symfony\Component\Validator\Constraints\Image',
    ];

    public function translate($annotation){
        $class = get_class($annotation);

        if ($class === 'Doctrine\ORM\Mapping\Column')
        {
            return self::translateORM($annotation);
        }
        else if(array_key_exists($class, self::ASSERTS)){
            return self::translateValidation($annotation);
        }
        else if($class === 'Suminagashi\OrchestraBundle\Annotation\Field'){
            return self::translateField($annotation);
        }
        return false;
    }

    private static function translateValidation($annotation){
        $form = [];
        foreach (self::ASSERTS[get_class($annotation)] as $filterFormInfo) {
            $form[$filterFormInfo] = $annotation->$filterFormInfo;
        }
        return ['validation' => $form];
    }

    private static function translateField($annotation){
        return ['field' => $annotation->label];
    }

    private static function translateORM($annotation){
        return ['type' => $annotation->type];
    }

}
