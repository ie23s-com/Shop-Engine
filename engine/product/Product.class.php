<?php

namespace ie23s\shop\engine\product;

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

    /**
     * @param int $id
     * @param float $cost
     * @param int $art
     * @param int $code
     * @param int $sold
     * @param int $balance
     * @param int $category
     * @param array $photos
     */
    public function __construct(int $id, float $cost, int $art, int $code,
                                int $sold, int $balance, int $category, array $photos = [])
    {
        $this->id = $id;
        $this->cost = $cost;
        $this->art = $art;
        $this->code = $code;
        $this->sold = $sold;
        $this->balance = $balance;
        $this->category = $category;
        $this->photos = $photos;
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
     * @return int
     */
    public function getArt(): int
    {
        return $this->art;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getSold(): int
    {
        return $this->sold;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @param int $art
     */
    public function setArt(int $art): void
    {
        $this->art = $art;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @param int $sold
     */
    public function setSold(int $sold): void
    {
        $this->sold = $sold;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @param array $photos
     */
    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }


}