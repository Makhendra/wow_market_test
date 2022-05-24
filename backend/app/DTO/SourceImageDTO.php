<?php

namespace App\DTO;

class SourceImageDTO
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var int
     */
    private $modelId;

    /**
     * @param string $type
     * @param int $modelId
     */
    private function __construct(string $type, int $modelId)
    {
        $this->type = $type;
        $this->modelId = $modelId;
    }

    /**
     * @param string $type
     * @param int $modelId
     * @return static
     */
    public static function create(string $type, int $modelId): self
    {
        return new self($type, $modelId);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getModelId(): int
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getDirectoryPath(): string
    {
        return "/images/{$this->type}/{$this->modelId}";
    }

}