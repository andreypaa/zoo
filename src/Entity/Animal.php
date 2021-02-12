<?php

namespace App\Entity;

use App\Exception\ZooException;
use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    public const LION = 1;
    public const CROCODILE = 2;
    public const ELEPHANT = 3;

    // возможные типы животных
    public const TYPES = [
        self::LION      => 'Lion',
        self::CROCODILE => 'Crocodile',
        self::ELEPHANT  => 'Elephant',
    ];

    // специфические действия животных
    private const METHODS = [
        'growl' => [self::LION],
        'pour'  => [self::ELEPHANT],
        'swim'  => [self::CROCODILE],
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Cell::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cell;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCell(): ?Cell
    {
        return $this->cell;
    }

    public function setCell(?Cell $cell): self
    {
        $this->cell = $cell;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Отвечает за реализацию метода покушать.
     */
    public function eat(): void
    {
        // TODO: придумать что тут сделать
    }

    /**
     * @param $name
     * @param $arguments
     * @throws ZooException
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (
            isset(self::METHODS[$name])
            && in_array($this->getType(), self::METHODS[$name], true)
        ) {
            $methodName = 'action'.ucfirst($name);
            return $this->$methodName(...$arguments);
        }

        throw new ZooException(sprintf(
            'Animal with type %s can`t action %s',
            self::TYPES[$this->getType()], $name
        ));
    }

    private function actionGrowl()
    {
        // TODO: реализовать
    }

    private function actionPour()
    {
        // TODO: реализовать
    }

    private function actionSwim()
    {
        // TODO: реализовать
    }
}
