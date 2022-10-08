<?php

namespace ie23s\shop\engine\utils\breadcrumbs\product;

class Product
{

    private int $id;

    private float $cost;
    private int $art;
    private int $code;
    private int $sold;
    private int $balance;
    private int $category;
    private array $photos;

    private string $display_name;
    private string $description;

    /**
     * @param int $id
     * @param float $cost
     * @param int $art
     * @param int $code
     * @param int $sold
     * @param int $balance
     * @param int $category
     * @param array $photos
     * @param string $display_name
     * @param string $description
     */
    public function __construct(int    $id, float $cost, int $art, int $code,
                                int    $sold, int $balance, int $category, array $photos = [],
                                string $display_name = 'undefined', string $description = 'undefined')
    {
        $this->id = $id;
        $this->cost = $cost;
        $this->art = $art;
        $this->code = $code;
        $this->sold = $sold;
        $this->balance = $balance;
        $this->category = $category;

        if (empty($photos))
            $photos[] = 'no-product-photo';
        $this->photos = $photos;
        $this->display_name = $display_name;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getArt(): int
    {
        return $this->art;
    }

    /**
     * @param int $art
     */
    public function setArt(int $art): void
    {
        $this->art = $art;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getSold(): int
    {
        return $this->sold;
    }

    /**
     * @param int $sold
     */
    public function setSold(int $sold): void
    {
        $this->sold = $sold;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    /**
     * @param array $photos
     */
    public function setPhotos(array $photos): void
    {
        if (empty($photos))
            $photos[] = 'no-product-photo';
        $this->photos = $photos;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    /**
     * @param string $display_name
     */
    public function setDisplayName(string $display_name): void
    {
        $this->display_name = $display_name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}