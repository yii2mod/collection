<?php

namespace yii2mod\collection\interfaces;

/**
 * Interface Arrayable
 *
 * @package yii2mod\collection\interfaces
 */
interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
