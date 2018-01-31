<?php

namespace Matryoshka;

trait Cacheable
{
    /**
     * Calculate a unique cache key for the model instance
     *
     * @return string
     */
    public function getCacheKey()
    {
        return sprintf("%s/%s-%s", get_class($this), $this->id, is_string($this->updated_at) ? $this->updated_at : $this->updated_at->timestamp);
    }
}