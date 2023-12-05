<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Barlito\Utils\Traits\IdUuidTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    use IdUuidTrait;
    use TimestampableEntity;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'documentName', size: 'documentSize')]
    private ?File $documentFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $documentName = null;

    #[ORM\Column(nullable: true)]
    private ?int $documentSize = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resource $resource = null;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setDocumentFile(?File $imageFile = null): void
    {
        $this->documentFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
    }

    public function setDocumentName(?string $imageName): void
    {
        $this->documentName = $imageName;
    }

    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }

    public function setDocumentSize(?int $imageSize): void
    {
        $this->documentSize = $imageSize;
    }

    public function getDocumentSize(): ?int
    {
        return $this->documentSize;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): static
    {
        $this->resource = $resource;

        return $this;
    }
}
