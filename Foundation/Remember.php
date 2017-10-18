<?php


namespace Ignite\Core\Foundation;

/**
 * Trait Rememberable
 * @package Ignite\Core\Foundation
 */
trait Remember
{
    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();
        $grammar = $conn->getQueryGrammar();
        $builder = new MyBuilder($conn, $grammar, $conn->getPostProcessor());
        if (isset($this->rememberFor)) {
            $builder->remember($this->rememberFor);
        }
        if (isset($this->rememberCacheTag)) {
            $builder->cacheTags($this->rememberCacheTag);
        }
        if (isset($this->rememberCachePrefix)) {
            $builder->prefix($this->rememberCachePrefix);
        }
        if (isset($this->rememberCacheDriver)) {
            $builder->cacheDriver($this->rememberCacheDriver);
        }
        return $builder;
    }
}