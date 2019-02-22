<?php

namespace EFA\FileHandlerBundle\Service;

interface IFindStringService
{
    /**
     * @param string $pattern
     * @param string $string
     *
     * @return array
     */
    public function findByRex(string $pattern, string $string): array;

    /**
     * @param string $substring
     * @param string $string
     *
     * @return array
     */
    public function findByPos(string $substring, string $string): array;
}
