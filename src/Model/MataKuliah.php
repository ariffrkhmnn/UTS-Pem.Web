<?php
declare(strict_types=1);

namespace UMM\Pemweb\Model;

class MataKuliah
{
    public function __construct(
        private string $kode,
        private string $nama,
        private int $sks,
        private ?int $id = null,
    ) {
    }

    public function id(): ?int { return $this->id; }
    public function kode(): string { return $this->kode; }
    public function nama(): string { return $this->nama; }
    public function sks(): int { return $this->sks; }
}
