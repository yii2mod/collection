<?php

namespace yii2mod\collection\interfaces;

/**
 * Interface Jsonable
 *
 * @package yii2mod\collection\interfaces
 */
interface Jsonable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson(int $options = 0): string;
}
