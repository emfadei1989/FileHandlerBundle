<?php

namespace EFA\FileHandlerBundle\Service;

class FindStringService implements IFindStringService
{
    /**
     * @param string $pattern
     * @param string $string
     *
     * @return array
     */
    public function findByRex(string $pattern, string $string): array
    {
        $results = [];
        preg_match_all("/$pattern/", $string, $matches, PREG_OFFSET_CAPTURE);
        if (!empty($matches)) {
            foreach ($matches[0] as $key => $val) {
                $results[] = $val[1];
            }
        }

        return $results;
    }

    /**
     * @param string $substring
     * @param string $string
     *
     * @return array
     */
    public function findByPos(string $substring, string $string): array
    {
        $offset = 0;
        $results = [];
        while (false !== ($pos = mb_strpos($string, $substring, $offset))) {
            $offset = $pos + 1;
            $results[] = $pos;
        }

        return $results;
    }
}
