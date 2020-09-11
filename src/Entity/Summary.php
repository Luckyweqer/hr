<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Summary
 *
 * @ORM\Table(name="summary")
 * @ORM\Entity(repositoryClass="App\Repository\SummaryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Summary
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="first_name" , type="string", length=120)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="last_name", type="string", length=120)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="patronymic", type="string", length=140, nullable=true)
     */
    private $patronymic;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=false)
     */
    private $dateCreated;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="interview_date", type="datetime", nullable=true)
     */
    private $interviewDate;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="integer", nullable=true)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=140, nullable=true)
     */
    private $comment;


    /**
     * @ORM\ManyToOne(targetEntity="Category",  inversedBy="summaries")
     */
    private $category;

    /**
     * @Assert\File(
     *     mimeTypes = {
     *         "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *         "application/vnd.ms-excel",
     *         "application/msword",
     *         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *         "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
     *         "application/vnd.ms-excel.sheet.macroEnabled.12",
     *         "application/vnd.ms-excel.template.macroEnabled.12",
     *         "application/vnd.ms-word.document.macroEnabled.12",
     *         "application/vnd.openxmlformats-officedocument.presentationml.presentation",
     *         "application/vnd.ms-powerpoint"
     *     },
     *     mimeTypesMessage = "Please upload a valid PDF, excel or word"
     * )
     *
     * @Vich\UploadableField(mapping="summary_images", fileNameProperty="fileName", size="fileSize")
     *
     * @var File
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $fileName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var integer
     */
    private $fileSize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPatronymic(): string
    {
        return $this->patronymic;
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic(string $patronymic)
    {
        $this->patronymic = $patronymic;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return \DateTime
     */
    public function getInterviewDate(): ?\DateTime
    {
        return $this->interviewDate;
    }

    /**
     * @param \DateTime $interviewDate
     */
    public function setInterviewDate(?\DateTime $interviewDate)
    {
        $this->interviewDate = $interviewDate;
    }

    /**
     * @return string
     */
    public function getSalary(): ?string
    {
        return $this->salary;
    }

    /**
     * @param string $salary
     */
    public function setSalary(?string $salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(?string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @throws \Exception
     */
    public function setFile(?File $file = null): void
    {
        $this->file = $file;
        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(?int $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Set dateCreated.
     * @ORM\PrePersist)
     * @throws \Exception
     */
    public function prePersist()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getFullName()
    {
        return "$this->lastName $this->firstName $this->patronymic";
    }
}