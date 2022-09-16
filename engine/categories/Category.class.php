<?php

class Category
{
    private int $id;
    private string $name;
    private int $parent_id;
    private array $params;

    private string $display_name;

    private array $parents_array = [];
    private array $children_array = [];

    /**
     * @param int $id
     * @param string $name
     * @param int $parent_id
     * @param array $params
     * @param ?string $display_name
     */
    public function __construct(int   $id, string $name, int $parent_id,
                                array $params, ?string $display_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent_id = $parent_id;
        $this->params = $params;
        $this->display_name = $display_name ?? 'undefined';
    }

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     */
    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
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

    function addParent(Category $category)
    {
        array_unshift($this->parents_array, $category);
    }

    /**
     * @return array
     */
    public function getParentsArray(): array
    {
        return $this->parents_array;
    }

    /**
     * @return array
     */
    public function getChildrenArray(): array
    {
        return $this->children_array;
    }

    public function addChild(Category $category)
    {
        $this->children_array[] = $category;
    }
}