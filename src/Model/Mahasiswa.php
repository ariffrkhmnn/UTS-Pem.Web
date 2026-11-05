<?php
declare(strict_types=1);

namespace UMM\Pemweb\Model;

class Mahasiswa
{
    public function __construct(
        private string $nim,
        private string $nama,
        private string $prodi,
        private ?int $id = null,
    ) {
    }

    public function id(): ?int { return $this->id; }
    public function nim(): string { return $this->nim; }
    public function nama(): string { return $this->nama; }
    public function prodi(): string { return $this->prodi; }
}
