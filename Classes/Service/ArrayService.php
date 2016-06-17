<?php

/**
 * ArrayService
 */

namespace HDNET\OnpageIntegration\Service;

/**
 * Class ArrayService
 */
class ArrayService extends AbstractService
{

    /**
     * Replace a key $replaceKey with $replaceItem
     *
     * @param array $array
     * @param       $replaceItem
     * @param       $replaceKey
     *
     * @return array
     */
    public function replaceRecursiveByKey(array $array, $replaceItem, $replaceKey)
    {
        foreach ($array as $key => &$item) {
            if ($key === $replaceKey) {
                $item = $replaceItem;
            } elseif (is_array($item)) {
                $item = $this->replaceRecursiveByKey($item, $replaceItem, $replaceKey);
            }
        }
        return $array;
    }

    /**
     * @param array $array
     * @param string $searchKey
     * @return array
     */
    public function findByContainedKey(array $array, $searchKey)
    {
        $keyChains = $this->findKeyChainsContainingKey($array, $searchKey, [], []);
        $results   = [];

        foreach ($keyChains as $chain) {
            $results[] = implode('_', $chain);
        }

        return $results;
    }

    /**
     * @param array $array
     * @param string $searchKey
     * @param array $keyChains
     * @return array
     */
    protected function findKeyChainsContainingKey(array $array, $searchKey, array $keyChains, $keyChain)
    {
        $a = 1;

        foreach ($array as $key => $value) {
            if ($key !== $searchKey) {
                if (!is_array($value)){
                    continue;
                }
                $keyChain[] = $key;
                $keyChains  = $this->findKeyChainsContainingKey($value, $searchKey, $keyChains, $keyChain);
                array_pop($keyChain);
            } else {
                $keyChains[] = $keyChain;
                return $keyChains;
            }
        }

        return $keyChains;
    }
}
