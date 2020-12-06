<?php
class Service
{
    private $noServ;
    private $service;
    private $ville;

    // NoServ
    public function getNoServ(): int
    {
        return $this->noServ;
    }

    public function setNoServ(int $newNoServ): self
    {
        $this->noServ = $newNoServ;
        return $this;
    }

    // Service
    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(?string $newService): self
    {
        $this->service = $newService;
        return $this;
    }

    // Ville
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $newVille): self
    {
        $this->ville = $newVille;
        return $this;
    }

    // Affichage
    public function __toString(): string
    {
        return "[NoServ] : " . $this->noServ .
            " [Service] : " . $this->service .
            " [Ville] : " . $this->ville;
    }
}
