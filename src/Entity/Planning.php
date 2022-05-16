<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use DateInterval;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use function PHPUnit\Framework\isNull;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $start;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $end;

    #[ORM\Column(type: 'string', length: 100)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $color;

    #[ORM\Column(type: 'boolean')]
    private $allDay;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $textColor;


    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    // This will set the date start property by a date in string format
    public function setStartByDateString(string $start): self
    {
        $start = explode(" ", $start, 2)[0];
        $this->start = new \DateTime($start);
        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end = null): self
    {
        if (isNull($end))
            $this->setEndDefault($end);
        else
            $this->end = $end;

        return $this;
    }

    // This will set the date end property by a date in string format
    public function setEndByDateString(string $end): self
    {
        if (strcmp("undefined", $end) == 0 || strcmp("null", $end) == 0)
            $this->setEndDefault($end);
        else {
            $end = explode(" ", $end, 2)[0];
            $this->end = new \DateTime($end);
        }
        return $this;
    }

    private function setEndDefault($end)
    {
        $end = \DateTime::createFromInterface($this->start);
        $end->add(new DateInterval('PT1H'));
        $this->end = $end;
    }

    public function gettitle(): ?string
    {
        return $this->title;
    }

    public function settitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getAllDay(): ?bool
    {
        return $this->allDay;
    }

    public function setAllDay(string $allDay): self
    {
        if (strcmp($allDay, "true") == 0) {
            $this->allDay = true;
            $this->end = null;
        } else
            $this->allDay = false;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getAttendees(): Collection
    {
        return $this->attendees;
    }

    public function addAttendee(Employee $attendee): self
    {
        if (!$this->attendees->contains($attendee)) {
            $this->attendees[] = $attendee;
        }

        return $this;
    }

    public function removeAttendee(Employee $attendee): self
    {
        $this->attendees->removeElement($attendee);

        return $this;
    }
}
