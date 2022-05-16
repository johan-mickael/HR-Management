<?php

/**
 * Author: Johan Mickaël
 * Description: This is the Employee Category entity class
 */

namespace App\Entity;

use App\Repository\EmployeeCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployeeCategoryRepository::class)]
class EmployeeCategory
{
    // We are using "hour" as the time unit here
    const TIME_SUFFIX = 'h';

    // We are using "euro" as the money unit here
    const MONEY_SUFFIX = '€';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit avoir au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit avoir au plus {{ limit }} caractères',
    )] // The name must contains between 2 and 50 character
    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[Assert\Positive(
        message: 'Le salaire doit être supérieur à 0' . self::MONEY_SUFFIX
    )]
    #[Assert\LessThanOrEqual(
        value: 50000,
        message: 'Le salaire doit être inférieur à {{ compared_value }}' . self::MONEY_SUFFIX
    )] // The salary must be positive and less than 50,000€
    #[ORM\Column(type: 'decimal', precision: 7, scale: 2)]
    private $base_salary;

    #[Assert\Positive(
        message: 'L\' heure de travail doit être supérieur à 0' . self::TIME_SUFFIX
    )]
    #[Assert\LessThanOrEqual(
        value: 48,
        message: 'L\' heure de travail doit être inférieur à {{ compared_value }}' . self::TIME_SUFFIX
    )] // The default hour mus be positive and less then 48h
    #[ORM\Column(type: 'float')]
    private $default_hour;

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

    public function getBaseSalary(): ?string
    {
        return $this->base_salary;
    }

    public function setBaseSalary(string $base_salary): self
    {
        $this->base_salary = $base_salary;

        return $this;
    }

    public function getDefaultHour(): ?float
    {
        return $this->default_hour;
    }

    public function setDefaultHour(float $default_hour): self
    {
        $this->default_hour = $default_hour;

        return $this;
    }
}
