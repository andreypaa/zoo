<?php

namespace App\Entity;

use App\Exception\ZooException;
use App\Repository\CellRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CellRepository::class)
 */
class Cell
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Zoo::class, inversedBy="cells")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zoo;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="cell")
     */
    private $animals;

    /**
     * @ORM\Column(type="smallint")
     */
    private $animalType;


    /**
     * функция отвечает за очистку клетки
     */
    public function clear(): void
    {
        // TODO: реализовать
    }

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZoo(): ?Zoo
    {
        return $this->zoo;
    }

    public function setZoo(?Zoo $zoo): self
    {
        $this->zoo = $zoo;

        return $this;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    /**
     * можем добавлять животное только соответствующего типа
     *
     * @param Animal $animal
     * @return $this
     * @throws ZooException
     */
    public function addAnimal(Animal $animal): self
    {
        if ($animal->getType() !== $this->getAnimalType()) {
            throw new ZooException(sprintf(
                'Cant`t add animal with type %s to cell with type %s',
                Animal::TYPES[$animal->getType()], Animal::TYPES[$this->getAnimalType()]
            ));
        }
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setCell($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getCell() === $this) {
                $animal->setCell(null);
            }
        }

        return $this;
    }

    public function getAnimalType(): ?int
    {
        return $this->animalType;
    }

    public function setAnimalType(int $animalType): self
    {
        $this->animalType = $animalType;

        return $this;
    }
}
